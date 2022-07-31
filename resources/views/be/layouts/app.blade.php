<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> {{ $title ?? '' }} | PPID BonBol</title>

    <link rel="stylesheet" href={{ asset('be/assets/css/bootstrap.css') }}>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <link rel="stylesheet" href={{ asset('be/assets/vendors/chartjs/Chart.min.css') }}>
    <link rel="stylesheet" href={{ asset('be/assets/vendors/simple-datatables/style.css') }}>
    <link rel="stylesheet" href={{ asset('be/assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}>
    <link rel="stylesheet" href={{ asset('be/assets/css/app.css') }}>
    <link rel="shortcut icon" href={{ asset('be/assets/images/favicon.svg') }} type="image/x-icon">
</head>

<body>
    <div id="app">
        <div id="sidebar" class='active'>
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <img src={{ asset('be/assets/images/logo.svg') }} alt="" srcset="">
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class='sidebar-title'>Main Menu</li>
                        <li class="sidebar-item {{ ($title === "Dashboard") ? 'active' : ''}} "> 
                            <a href="/dashboard" class='sidebar-link'>
                                <i data-feather="home" width="20"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-item {{ ($title === "Informasi Publik") ? 'active' : ''}}">
                            @role('petugas')
                            <a href={{ route('petugas.informasipublik') }} class='sidebar-link'>
                                <i data-feather="triangle" width="20"></i>
                                <span>Informasi Publik</span>
                            </a>
                            @endrole
                        </li>
                        <li class="sidebar-item {{ ($title === "Permohonan Informasi") ? 'active' : '' }} ">
                            <a href="/perinfo" class='sidebar-link'>
                                <i data-feather="briefcase" width="20"></i>
                                <span>Permohonan Informasi</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="#" class='sidebar-link'>
                                <i data-feather="briefcase" width="20"></i>
                                <span>Pengajuan Keberatan</span>
                            </a>
                        </li>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        <div id="main">
            <nav class="navbar navbar-header navbar-expand navbar-light">
                <a class="sidebar-toggler" href="#"><span class="navbar-toggler-icon"></span></a>
                <button class="btn navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav d-flex align-items-center navbar-light ms-auto">
                        <li class="dropdown nav-icon">
                            <a href="#" data-bs-toggle="dropdown"
                                class="nav-link  dropdown-toggle nav-link-lg nav-link-user">
                                <div class="d-lg-inline-block">
                                    <i data-feather="bell"></i>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-large">
                                <h6 class='py-2 px-4'>Notifications</h6>
                                <ul class="list-group rounded-none">
                                    <li class="list-group-item border-0 align-items-start">
                                        <div class="avatar bg-success me-3">
                                            <span class="avatar-content"><i data-feather="shopping-cart"></i></span>
                                        </div>
                                        <div>
                                            <h6 class='text-bold'>New Order</h6>
                                            <p class='text-xs'>
                                                An order made by Ahmad Saugi for product Samsung Galaxy S69
                                            </p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="dropdown">
                            <a href="#" data-bs-toggle="dropdown"
                                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                                <div class="avatar me-1">
                                    <img src={{ asset('be/assets/images/avatar/avatar-s-1.png') }} alt="" srcset="">
                                </div>
                                <div class="d-none d-md-block d-lg-inline-block">Hi, Saugi</div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#"><i data-feather="user"></i> Account</a>
                                <a class="dropdown-item active" href="#"><i data-feather="mail"></i> Messages</a>
                                <a class="dropdown-item" href="#"><i data-feather="settings"></i> Settings</a>
                                <div class="dropdown-divider"></div><form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <button type="submit">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="main-content container-fluid">
                @yield('container')
            </div>

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2022 &copy; PPID -Bone Bolango</p>
                    </div>
                    <div class="float-end">
                        <p>Crafted with <span class='text-danger'><i data-feather="heart"></i></span> by <a
                                href="https://instagram.com/holaandy_">Andi Mohamad Soreang</a></p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src={{ asset('be/assets/js/feather-icons/feather.min.js') }}></script>
    <script src={{ asset('be/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}></script>
    <script src={{ asset('be/assets/js/app.js') }}></script>
    <script src={{ asset('be/assets/vendors/simple-datatables/simple-datatables.js') }}></script>
    <script src={{ asset('be/assets/vendors/chartjs/Chart.min.js') }}></script>
    <script src={{ asset('be/assets/vendors/apexcharts/apexcharts.min.js') }}></script>
    <script src={{ asset('be/assets/js/pages/dashboard.js') }}></script>
    <script src={{ asset('be/assets/js/vendors.js') }}></script>

    <script src={{ asset('be/assets/js/main.js') }}></script>
   



</body>

</html>