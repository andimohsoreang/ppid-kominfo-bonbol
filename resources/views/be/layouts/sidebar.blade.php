<div id="sidebar" class='active'>
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <img src={{ asset('be/assets/images/ppidbonebol.png') }} alt="logo" srcset="">
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class='sidebar-title'>Main Menu</li>
                @role('admin')
                <li class="sidebar-item @if(request()->routeIs('admin.dashboard')) active @endif">
                    <a href="{{ route('admin.dashboard') }}" class='sidebar-link'>
                        <i data-feather="home" width="20"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item @if(request()->routeIs('admin.informasipublik', 'admin.informasipublik.create', 'admin.informasipublik.show', 'admin.informasipublik.edit')) active @endif">
                    <a href={{ route('admin.informasipublik') }} class='sidebar-link'>
                        <i data-feather="triangle" width="20"></i>
                        <span>Informasi Publik</span>
                    </a>
                </li>
                <li class="sidebar-item @if(request()->routeIs('admin.permohonaninformasi')) active @endif">
                    <a href="{{ route('admin.permohonaninformasi') }}" class='sidebar-link'>
                        <i data-feather="file-text" width="20"></i>
                        <span>Permohonan Informasi</span>
                    </a>
                </li>
                <li class="sidebar-item @if(request()->routeIs('admin.pengajuankeberatan')) active @endif">
                    <a href="{{ route('admin.pengajuankeberatan') }}" class='sidebar-link'>
                        <i data-feather="alert-circle" width="20"></i>
                        <span>Pengajuan Keberatan</span>
                    </a>
                </li>
                @endrole
                

                @role('petugas')
                <li class="sidebar-item @if(request()->routeIs('petugas.dashboard')) active @endif">
                    <a href="{{ route('petugas.dashboard') }}" class='sidebar-link'>
                        <i data-feather="home" width="20"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item @if(request()->routeIs('petugas.informasipublik', 'petugas.informasipublik.create', 'petugas.informasipublik.show', 'petugas.informasipublik.edit')) active @endif">
                    <a href={{ route('petugas.informasipublik') }} class='sidebar-link'>
                        <i data-feather="triangle" width="20"></i>
                        <span>Informasi Publik</span>
                    </a>
                </li>
                <li class="sidebar-item @if(request()->routeIs('petugas.permohonaninformasi')) active @endif">
                    <a href="{{ route('petugas.permohonaninformasi') }}" class='sidebar-link'>
                        <i data-feather="file-text" width="20"></i>
                        <span>Permohonan Informasi</span>
                    </a>
                </li>
                <li class="sidebar-item @if(request()->routeIs('petugas.pengajuankeberatan')) active @endif">
                    <a href="{{ route('petugas.pengajuankeberatan') }}" class='sidebar-link'>
                        <i data-feather="alert-circle" width="20"></i>
                        <span>Pengajuan Keberatan</span>
                    </a>
                </li>
                @endrole

                @role('user')
                <li class="sidebar-item @if(request()->routeIs('user.dashboard')) active @endif">
                    <a href="{{ route('user.dashboard') }}" class='sidebar-link'>
                        <i data-feather="home" width="20"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item @if(request()->routeIs('user.permohonaninformasi')) active @endif">
                    <a href="{{ route('user.permohonaninformasi') }}" class='sidebar-link'>
                        <i data-feather="file-text" width="20"></i>
                        <span>Permohonan Informasi</span>
                    </a>
                </li>
                <li class="sidebar-item @if(request()->routeIs('user.pengajuankeberatan')) active @endif">
                    <a href="{{ route('user.pengajuankeberatan') }}" class='sidebar-link'>
                        <i data-feather="alert-circle" width="20"></i>
                        <span>Pengajuan Keberatan</span>
                    </a>
                </li>
                @endrole
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>