<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link bg-primary">
        <img src="{{ asset('AdminLTE/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3 bg-light" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
        {{-- <span class="brand-text font-weight-light">{{ $setting->company_name }}</span> --}}
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                @if (Storage::disk('public')->exists(auth()->user()->avatar))
                    <img src="{{ Storage::url(auth()->user()->avatar) }}" alt="" class="img-circle elevation-2" style="width: 40px; height:40px ">
                @else
                    <img src="{{ asset('AdminLTE/dist/img/user1-128x128.jpg') }}" alt=""
                        class="img-circle elevation-2">
                @endif
            </div>
            <div class="info">
                <a href="{{ route('profile.show') }}" class="d-block" data-toggle="tooltip" data-placement="top"
                    title="Edit Profil">
                    {{ auth()->user()->name }}
                    <i class="fas fa-pencil-alt ml-2 text-sm text-primary"></i>
                </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-compact nav-child-indent" data-widget="treeview"
                role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}"
                        class="nav-link {{ request()->is('dashboard*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-header">MASTER DATA</li>
                <li class="nav-item">
                    <a href="{{ route('sensor.index') }}"
                        class="nav-link {{ request()->is('sensor') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Monitoring
                        </p>
                    </a>
                </li>
                <li class="nav-item {{ request()->is(['category', 'posts']) ? 'menu-is-opening menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is(['category', 'posts']) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-file"></i>
                        <p>
                            Konten Web
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('category.index') }}"
                                class="nav-link {{ request()->is('category') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kategori</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('posts.index') }}"
                                class="nav-link {{ request()->is('posts*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Postingan</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-header">MANAJEMEN AKUN</li>
                <li class="nav-item">
                    <a href="{{ route('profile.show') }}"
                        class="nav-link {{ request()->is('user/profile*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Profil
                        </p>
                    </a>
                </li>
                {{-- <li class="nav-header">PENGATURAN APLIKASI</li>
                <li class="nav-item">
                    <a href="{{ route('setting.index') }}"
                        class="nav-link {{ request()->is('setting') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            Setting
                        </p>
                    </a>
                </li> --}}
                <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link"
                        onclick="document.querySelector('#form-logout').submit()">
                        <i class="nav-icon fas fa-sign-in-alt"></i>
                        <p>
                            Keluar
                        </p>
                    </a>

                    <form action="{{ route('logout') }}" method="post" id="form-logout">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
    </div>
</aside>
