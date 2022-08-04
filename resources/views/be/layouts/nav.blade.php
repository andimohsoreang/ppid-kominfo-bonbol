<nav class="navbar navbar-header navbar-expand navbar-light">
    <a class="sidebar-toggler" href="#"><span class="navbar-toggler-icon"></span></a>
    <button class="btn navbar-toggler" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav d-flex align-items-center navbar-light ms-auto">
            <li class="dropdown nav-icon border-end pe-3">
                <p class="h6 my-3">{{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y') }}</p>
            </li>
            <li class="dropdown">
                <a href="#" data-bs-toggle="dropdown"
                    class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                    <div class="d-flex align-items-center gap-2">
                        <i data-feather="smile"></i>
                        <?php
                            $firstname = explode(" ", Auth::user()->name);
                        ?>
                        <div class="d-none d-md-block d-lg-inline-block">Hi, {{ $firstname[0] }}</div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    @role('admin')
                    <a class="dropdown-item" href="{{ route('admin.akun') }}"><i data-feather="user"></i> Akun</a>
                    @endrole
                    @role('petugas')
                    <a class="dropdown-item" href="{{ route('petugas.akun') }}"><i data-feather="user"></i> Akun</a>
                    @endrole
                    @role('user')
                    <a class="dropdown-item" href="{{ route('user.akun') }}"><i data-feather="user"></i> Akun</a>
                    @endrole
                    <div class="dropdown-divider"></div>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit" class="dropdown-item">
                            <i data-feather="log-out"></i>Logout
                        </button>
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>