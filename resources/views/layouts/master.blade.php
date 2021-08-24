@extends('master')
@section('content')
    <div>
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- SEARCH FORM -->
            <form class="form-inline ml-3">
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="/" class="brand-link">
                <img src="{{ asset('images/book.png') }}" alt="pdfself logo" class="brand-image img-circle elevation-3"
                     style="opacity: .8">
                <span class="brand-text font-weight-light">Pdf | Shelf</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('images/profile.png') }}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <span class="mute d-block">Admin</span>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                             with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <router-link to="/admin-panel/dashboard" class="nav-link admin-panel-menu-link">
                                <i class="fas fa-columns nav-icon blue"></i>
                                <p>
                                    Dashboard
                                </p>
                            </router-link>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="" class="nav-link">
                                <i class="fas fa-cog nav-icon orange"></i>
                                <p>
                                    management
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <router-link to="/admin-panel/books" class="nav-link admin-panel-menu-link pl-4">
                                        <i class="fas fa-circle-notch nav-icon"></i>
                                        <p>Books</p>
                                    </router-link>
                                </li>
                                <li class="nav-item">
                                    <router-link to="/admin-panel/users" class="nav-link admin-panel-menu-link pl-4">
                                        <i class="fas fa-circle-notch nav-icon"></i>
                                        <p>Users</p>
                                    </router-link>
                                </li>
                                <li class="nav-item">
                                    <router-link to="/admin-panel/categories" class="nav-link admin-panel-menu-link pl-4">
                                        <i class="fas fa-circle-notch nav-icon"></i>
                                        <p>Category</p>
                                    </router-link>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <router-link :to="{ name: 'amin-profile', params: { id: {{ \Illuminate\Support\Facades\Auth::id()  }} }}" class="nav-link admin-panel-menu-link">
                                <i class="fas fa-user nav-icon"></i>
                                <p>
                                    Profile
                                </p>
                            </router-link>
                        </li>

                        <li class="nav-item">
                            <a href="/" target="_blank" class="nav-link admin-panel-menu-link">
                                <i class="fas fa-globe nav-icon green"></i>
                                <p>
                                    Visit site
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                <i class="fas fa-power-off nav-icon red"></i>
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <app-authenticate-user></app-authenticate-user>
            <router-view></router-view>
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
    {{--    <aside class="control-sidebar control-sidebar-dark">--}}
    {{--        <!-- Control sidebar content goes here -->--}}
    {{--        <div class="p-3">--}}
    {{--            <h5>Title</h5>--}}
    {{--            <p>Sidebar content</p>--}}
    {{--        </div>--}}
    {{--    </aside>--}}
    <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                feel the world read more
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2021 Pdf | Shelf.</strong> All rights reserved.
        </footer>
    </div>
@endsection
