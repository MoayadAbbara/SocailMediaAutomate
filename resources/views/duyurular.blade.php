@extends('layouts.main')

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
@section('content')
    <h1>Bilgisayar Mühendisliği Duyuruları</h1>
    {{-- <p></p>
    @if (session('success_message'))
    <div class="alert alert-success">
        {{ session('success_message') }}
    </div>
    @endif --}}
    <table id="myTable" class="display">
    <thead>
        <tr>
            <th>Fotoğraf</th>
            <th>Başlık</th>
            <th class="text-center">Paylaş</th>
            <th>Sil</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($announcements as $duyuru)
        <tr>
            <td><img src="{{ $duyuru['image_url'] }}" alt="" style="max-width: 100px; display:block; margin-left:auto;margin-right:auto;"></td>
            <td><a href="{{ $duyuru['url'] }}" target="_blank">{{ $duyuru['title'] }}</a></td>
            <td class="text-center">
                <!-- Form to send URL to the controller -->
                <form method="GET" action="{{route('AnnouncementDetails')}}">
                    @csrf
                    <input type="hidden" id="url" name="url" value="{{ $duyuru['url'] }}">
                    <input type="hidden" id="id" name="id" value="{{ $duyuru['id'] }}">
                    <button type="submit" class="btn btn-primary">Paylaş</button>
                </form>
                <p>Paylaşılan Platformlar : </p>
                @if ($duyuru['posted_on_instagram'])
                <i class="fa-brands fa-instagram" style="font-size: 20px;"></i>
                @endif
                @if ($duyuru['posted_on_twitter'])
                <i class="fa-brands fa-x-twitter" style="font-size: 20px;"></i> 
                @endif
                @if ($duyuru['posted_on_facebook'])
                <i class="fa-brands fa-facebook" style="font-size: 20px;"></i>
                @endif
            </td>
            <td>
                <form method="POST" action="{{route('DeleteAnnouncement')}}">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" id="id" name="id" value="{{ $duyuru['id'] }}">
                    <button type="submit" style="background:transparent; border: none;"><i class="fa-solid fa-xmark" style="color: #ff0000;font-size:32px;"></i></button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
    </table>
@endsection


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        let table = new DataTable('#myTable');
        
        // When paylas button is clicked, update modal body and show modal
        $('.paylas-btn').click(function() {
            var link = $(this).data('link');
            //$('#myModal .modal-body').html('<textarea name="" id="" cols="80" rows="10"></textarea>');
        });
    });
</script>
