<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Http;
use App\Models\Announcement;
use Exception;

class DuyurularController extends Controller
{
    public function CheckForNewAnnouncement()
    {
        Http::get('http://127.0.0.1:5001/api/scrape');
        $announcements = Announcement::all();
        return view('duyurular', ['announcements' => $announcements->reverse()]);
    }

    public function AnnouncementDetails(Request $request)
    {
        $url = $request->input('url');
        $id = $request->input('id');
        $client = new Client();

        try {
            $response = $client->request('GET', 'http://127.0.0.1:5001/api/fetchdata', [
                'json' => [
                    'url' => $url
                ]
            ]);

            $statusCode = $response->getStatusCode();
            $data = json_decode($response->getBody(), true);

            // Assuming you want to display the scraped data in a view
            return view('share', ['data' => $data, 'id' => $id]);
        } catch (Exception $e) {
            // Handle exceptions
            return back()->withError('Error: ' . $e->getMessage());
        }
    }



    public function instagramPost(Request $request)
    {
        set_time_limit(150);
        // Retrieve the text data from the request
        $text = $request->input('post_text');

        // Retrieve the image URLs from the request
        $imageUrls = $request->input('image_urls');

        $id = $request->input('id');

        $client = new Client();

        try {
            $client->request('POST', 'http://127.0.0.1:5001/instagram_post', [
                'json' => [
                    'text' => $text,
                    'images' => $imageUrls
                ]
            ]);
            session()->flash('success_message', 'Duyuru başarlı bir şekilde paylaşıldı');
            $announcement = Announcement::where('id', $id)->first();
            $announcement->posted_on_instagram = 1;
            $announcement->save();
            // Redirect back to the previous page
            return redirect()->back();

        } catch (Exception $e) {
            session()->flash('error_message', 'Bir hata oluştu');

            // Redirect back to the previous page
            return redirect()->back();
        }

    }



    public function TwitterPost(Request $request)
    {
        // Retrieve the text data from the request
        $text = $request->input('post_text');
        $id = $request->input('id');
        if (strlen($text) > 280) {
            #dd($text);
            // If it exceeds 280 characters, return with an error message
            return back()->withErrors(['twitter_error' => 'Twitter için karakter sınırı 280 karakterdir.']);

        }
        // Retrieve the image URLs from the request
        $imageUrls = $request->input('image_urls');

        $client = new Client();

        try {
            $client->request('POST', 'http://127.0.0.1:5001/twitter_post', [
                'json' => [
                    'text' => $text,
                    'images' => $imageUrls
                ]
            ]);
            session()->flash('success_message', 'Duyuru başarlı bir şekilde paylaşıldı');
            $announcement = Announcement::where('id', $id)->first();
            $announcement->posted_on_twitter = 1;
            $announcement->save();
            // Redirect back to the previous page
            return redirect()->back();

        } catch (Exception $e) {
            session()->flash('error_message', 'Bir hata oluştu');

            // Redirect back to the previous page
            return redirect()->back();
        }

    }


    public function FacebookPost(Request $request)
    {
        // Retrieve the text data from the request
        $text = $request->input('post_text');

        // Retrieve the image URLs from the request
        $imageUrls = $request->input('image_urls');

        $id = $request->input('id');

        $client = new Client();

        try {
            $client->request('POST', 'http://127.0.0.1:5001/facebook_post', [
                'json' => [
                    'text' => $text,
                    'images' => $imageUrls
                ]
            ]);
            session()->flash('success_message', 'Duyuru başarlı bir şekilde paylaşıldı');

            $announcement = Announcement::where('id', $id)->first();
            $announcement->posted_on_facebook = 1;
            $announcement->save();

            // Redirect back to the previous page
            return redirect()->back();

        } catch (Exception $e) {
            session()->flash('error_message', 'Bir hata oluştu');

            // Redirect back to the previous page
            return redirect()->back();
        }

    }

    public function ShareForm(Request $request)
    {
        $imageUrls = $request->input('image_urls');
        $action = $request->input('action');
        if (!isset($imageUrls)) {
            return back()->withErrors(['NoImageSelected' => 'En az bir fotoğraf seçilmeli']);
        }
        switch ($action) {
            case 'Instagram':
                // Call function 1
                return $this->instagramPost($request);
            case 'Twitter':
                // Call function 2
                return $this->TwitterPost($request);
            case 'Facebook':
                #    // Call function 2
                return $this->FacebookPost($request);
        }
    }

    public function DeleteDuyuru(Request $request)
    {
        $id = $request->input('id');
        $announcement = Announcement::find($id);
        $announcement->delete();
        return redirect()->back();
    }


}
