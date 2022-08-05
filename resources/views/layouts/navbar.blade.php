@if(request()->routeIs('infopub','pemohon.register','lembaga.register','perorangan.register', 'statistik'))
<nav id="scrollspy" class="navbar navbar-dark bg-dark navbar-expand-lg fixed-top">
@else 
<nav id="scrollspy" class="navbar navbar-light bg-light navbar-expand-lg fixed-top" data-spy="affix" data-offset-top="20">
@endif
    <div class="container">
        <a class="navbar-brand" href="#"><img src="{{ asset('be/assets/images/ppidbonebol.png') }}" alt="" class="brand-img" style="width: 80px;"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('infopub') }}">Informasi Publik</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('pemohon.register') }}">Permohonan Informasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('statistik') }}">Statistik</a>
                </li>
                <li class="nav-item ml-0 ml-lg-4">
                    @auth
                    <a class="nav-link btn btn-primary" href="{{ route('login') }}"><i class="ti-login"></i>Hi, {{ Auth::user()->name }}</a>
                    @else
                    <a class="nav-link btn btn-primary" href="{{ route('login') }}"><i class="ti-login"></i> Login</a>
                    @endauth
                </li>
            </ul>
        </div>
    </div>
</nav>