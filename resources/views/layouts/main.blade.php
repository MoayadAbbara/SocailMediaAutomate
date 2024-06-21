<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>@yield('title')</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark" style="background: #9e3733">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{route('NewAnnouncement')}}"><img src="https://bilecik.edu.tr/dosya/SiteLogo_de3f_bseul_tr_ogo.png" alt="Bşeü Logo" style="width: 50px"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/">Ana Sayfa</a>
                </li>
                </li>
                <li class="nav-item">
                </li>
                <li class="nav-item">
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <a class="nav-link" href="{{ route('logout') }}"
           onclick="event.preventDefault();
                    this.closest('form').submit();">
            Çıkış Yap
        </a>
    </form>
</li>

            </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>

    <div style="background: #9e3733; margin-top:25px;">
      <footer class="py-3">
        {{-- <ul class="nav justify-content-center border-bottom pb-3 mb-3">
          <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Home</a></li>
          <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Features</a></li>
          <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Pricing</a></li>
          <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">FAQs</a></li>
          <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">About</a></li>
        </ul> --}}
        <p class="text-center" style="color: white">Bilecik Şeyh Edebali Üniversitesi - Bilgisayar Mühendisliği Bölümü</p>
        <p class="text-center" style="color: white">© Tüm Haklar Saklı 2024 - <a href="https://tr.linkedin.com/in/moayad-abbara-742812243" style="color: #000000">Moayad Abbara</a> Tarafından Geliştirilmiştir.</p>
      </footer>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/61da615d84.js" crossorigin="anonymous"></script>
</body>
</html>