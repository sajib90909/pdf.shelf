@extends('master')
@section('content')
    <div class="container">
        <nav class="navbar navbar-light justify-content-between bg-brand-light">
            <router-link class="navbar-brand" to="/">Pdf | Shelf</router-link>
            <div class="d-flex justify-content-sm-end">
                <app-top-search></app-top-search>
                <div class="ml-1">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('profile', [ 'id' => \Illuminate\Support\Facades\Auth::id()]) }}" class="btn btn-outline-primary ml-1 btn-sm">My Account</a>
                            <a class="btn btn-outline-dark ml-1 btn-sm" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline-primary ml-1 btn-sm">Log in</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-outline-dark ml-1 btn-sm">Register</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </nav>
        <div>
            <app-authenticate-user></app-authenticate-user>
            <router-view></router-view>
        </div>

        {{--            footer --}}
        <footer class="d-flex justify-content-between text-white bg-dark">
            <!-- Grid container -->
            <div class="">
                <!-- Section: Social media -->
                <section class="">
                    <!-- Facebook -->
                    <a
                        class="btn btn-link btn-floating btn-lg text-light m-1"
                        href="https://facebook.com"
                        role="button"
                        target="_blank"
                        data-mdb-ripple-color="dark"
                    ><i class="fab fa-facebook-f"></i
                        ></a>

                    <!-- Twitter -->
                    <a
                        class="btn btn-link btn-floating btn-lg text-light m-1"
                        href="https://twitter.com"
                        role="button"
                        target="_blank"
                        data-mdb-ripple-color="dark"
                    ><i class="fab fa-twitter"></i
                        ></a>

                    <!-- Instagram -->
                    <a
                        class="btn btn-link btn-floating btn-lg text-light m-1"
                        href="https://www.instagram.com/"
                        role="button"
                        target="_blank"
                        data-mdb-ripple-color="dark"
                    ><i class="fab fa-instagram"></i
                        ></a>
                </section>
                <!-- Section: Social media -->
            </div>
            <!-- Grid container -->

            <!-- Copyright -->
            <div class="text-light p-3">
                © 2020 Copyright Pdf | shelf
            </div>
            <!-- Copyright -->
        </footer>
    </div>
@endsection
