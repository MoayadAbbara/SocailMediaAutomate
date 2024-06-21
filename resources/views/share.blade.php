@extends('layouts.main')
@section('title', 'Duyuru Paylaşma')
@section('content')

@if (session('success_message'))
    <div class="alert alert-success">
        {{ session('success_message') }}
    </div>
@elseif (session('error_message'))
    <div class="alert alert-danger">
        {{ session('error_message') }}
    </div>
@elseif($errors->has('twitter_error'))
    <div class="alert alert-danger">
        {{ $errors->first('twitter_error') }}
    </div>
@elseif($errors->has('NoImageSelected'))
    <div class="alert alert-danger">
        {{ $errors->first('NoImageSelected') }}
    </div>
@endif

<div class="container mt-5" style="width:70%;">
    <h1 class="text-center">Duyuru Paylaş</h1>
    <form action="{{ route('ShareForm') }}" method="post">
        @csrf
        <div class="form-group">
            <textarea name="post_text" class="form-control" rows="8" id="textArea" oninput="countChars()">{{ $data['text'] }}</textarea>
            <input type="hidden" name="id" value='{{ $id }}'>
            <div class="text-right mt-2">
                <span id="charCount">0</span>
            </div>
        </div>

        <div class="row">
            {{-- @foreach ($data['images'] as $image)
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="img-wrapper">
                    <div class="img-container">
                        <input type="checkbox" id="image-{{ $loop->index }}" name="image_urls[]" value="{{ $image }}" />
                        <label for="image-{{ $loop->index }}">
                            <img src="{{ $image }}" alt="Image" class="img-fluid">
                        </label>
                    </div>
                </div>
            </div>
            @endforeach --}}
        </div>
        <div class="row">
        @foreach ($data['images'] as $image)
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="img-wrapper">
                    <div class="img-container">
                        {{-- <input type="hidden" name="image_urls[]" value="{{ $image }}"> --}}
                        <input type="checkbox" name="image_urls[]" value="{{ $image }}" checked>
                        <img src="{{ $image }}" alt="Nature" style="max-height: 250px;">
                    </div>
                </div>
            </div>
        @endforeach
        </div>
        <div class="text-center mt-5">
            <div class="d-flex flex-column  justify-content-center">
                <button class="btn btn-primary mb-2" type="submit" name="action" value="Facebook"><i class="fa-brands fa-facebook"></i> Facebook'de Paylaş</button>
                <button class="btn btn-primary mb-2" type="submit" name="action" value="Twitter"><i class="fa-brands fa-x-twitter"></i> Twitter'de Paylaş</button>
                <button class="btn btn-primary mb-2" type="submit" name="action" value="Instagram"><i class="fa-brands fa-instagram"></i> Instagram'da Paylaş</button>
                <a href="{{route('NewAnnouncement')}}" class="btn btn-secondary mb-2"><i class="fa-solid fa-arrow-left"></i> Geri Dön</a>
            </div>
        </div>
    </form>    
</div>

<style>
    .img-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .img-container {
        background-color: #ffffff;
        box-shadow: 0 0 25px rgba(17, 1, 68, 0.08);
        border-radius: 8px;
        position: relative;
        cursor: pointer;
        width: 100%;
        padding-top: 100%; /* 1:1 Aspect Ratio */
        overflow: hidden;
    }

    .img-container img {
        position: absolute;
        width: 70%;
        height: auto;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .img-container input[type="checkbox"] {
        position: absolute;
        top: 10px;
        left: 10px;
        z-index: 10;
    }
</style>

<script>
    window.onload = function() {
        countChars();
    };

    function countChars() {
        var text = document.getElementById("textArea").value;
        var charCount = text.length;
        document.getElementById("charCount").innerText = "Harf Sayısı: " + charCount;
    }
</script>

@endsection
