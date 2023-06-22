<!DOCTYPE html>
<html lang="en">

<head>
    <title>ImagineShirt</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/sass/app.scss')

</head>

<body class="animsition">

    <!-- Header -->
    <header class="header-v4 Paddingbt5">
        <!-- Header desktop -->
        <div class="wrap-menu-desktop how-shadow1" style="top: 0px;">
            <nav class="limiter-menu-desktop container">

                <!-- Logo desktop -->
                <a href="/" class="logo">
                    <img src="/img/image2.png" alt="IMG-LOGO">
                </a>

                <!-- Menu desktop -->
                <div class="menu-desktop">
                    <ul class="main-menu">
                        <li>
                            <a href="/">Home</a>
                        </li>

                        <li class="label1" data-label1="hot">
                            <a href="{{ route('catalogo.index') }}">Catalogo</a>
                        </li>

                        <li>
                            <a href="#">Sobre Nós</a> <!-- /*route('about')*/ -->
                        </li>

                        <li>
                            <a href="#">Contactos</a> <!-- /*route('contacts')*/ -->
                        </li>
                        @if (!Auth::user() || Auth::user()->user_type == 'C')
                            <li>
                                <a href="{{ route('carrinho.cart') }}">Carrinho</a>
                            </li>
                        @endif
                        @if (Auth::user()->user_type == 'A' || Auth::user()->user_type == 'E')
                            <li><a class="dropdown-item" href="{{ route('admin.index') }}">Menu Admin</a>
                            </li>
                        @endif

                    </ul>

                </div>

                <!-- Icon header -->
                <div class="wrap-icon-header flex-w flex-r-m">
                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
                        <i class="zmdi zmdi-search"></i>
                    </div>
                    <?php

                    ?>
                    @if (!Auth::user() || Auth::user()->user_type == 'C')
                        <a href="{{ route('carrinho.cart') }}"
                            class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart"
                            data-notify="{{ Session::has('itemCount') ? Session::get('itemCount') : 0 }}">
                            <i class="zmdi zmdi-shopping-cart"></i>
                        </a>

                        <a href="#" class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti"
                            data-notify="0">
                            <i class="zmdi zmdi-favorite-outline"></i>
                        </a>
                    @endif
                    <div style="padding-left: 13px;">
                        @if (Auth::user())
                            <?php
                            $nameParts = explode(' ', Auth::user()->name);
                            $firstName = $nameParts[0];
                            ?>
                            {{ $firstName }}
                        @else
                            <img src="/img/avatar_unknown.png" alt="Avatar" class="bg-dark rounded-circle"
                                width="45" height="45">
                        @endif
                    </div>

                    <ul class="navbar-nav me-1 me-lg-3">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                @if (Auth::user())
                                    <img src="{{ Auth::user()->fullPhotoUrl }}" alt="Avatar"
                                        class="bg-dark rounded-circle" width="45" height="45">
                                @endif
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                @if (Auth::user())
                                    <li><a class="dropdown-item" href="{{ route('perfil.index') }}">Perfil</a>
                                    </li>
                                    @if(Auth::user()->user_type == 'A')
                                    <li><a class="dropdown-item" href="{{ route('admin.index') }}">Menu Admin</a>
                                    </li>
                                    @endif
                                    @if(Auth::user()->user_type == 'E')
                                    <li><a class="dropdown-item" href="{{ route('admin.index') }}">Menu Empregado</a>
                                    </li>
                                    @endif
                                    <li><a class="dropdown-item" href="{{ route('password.change.show') }}">Alterar
                                            Senha</a></li>
                                    @if (Auth::user()->user_type == 'C')
                                        <li><a class="dropdown-item" href="{{ route('pedidos.orders') }}">Pedidos</a>
                                        </li>
                                    @endif
                                    <li>
                                        <hr class="dropdown-divider" />
                                    </li>
                                    <li>
                                        <a class="dropdown-item"
                                            onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            Sair
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                @else
                                    <li><a class="dropdown-item" href="{{ route('login') }}">Login</a>
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('register') }}">Registar</a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>

        <!-- Header Mobile -->
        <div class="wrap-header-mobile">
            <!-- Logo moblie -->
            <div class="logo-mobile">
                <a href="index.html"><img src="/icons/logo-01.png" alt="IMG-LOGO"></a>
            </div>

            <!-- Icon header -->
            <div class="wrap-icon-header flex-w flex-r-m m-r-15">
                <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
                    <i class="zmdi zmdi-search"></i>
                </div>
                @if (!Auth::user() || Auth::user()->user_type == 'C')
                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart"
                        data-notify="2">
                        <i class="zmdi zmdi-shopping-cart"></i>
                    </div>


                    <a href="#"
                        class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti"
                        data-notify="0">
                        <i class="zmdi zmdi-favorite-outline"></i>
                    </a>
                @endif
            </div>

            <!-- Button show menu -->
            <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </div>
        </div>


        <!-- Menu Mobile -->
        <div class="menu-mobile">
            <ul class="topbar-mobile">
                <li>
                    <div class="right-top-bar flex-w h-full">
                        @if (Auth::user())
                            @if (Auth::user()->user_type != 'E')
                                <a class="dropdown-item" href="#">Perfil</a>
                            @endif
                            <a class="dropdown-item" href="{{ route('password.change.show') }}">Alterar Senha</a>
                            @if (Auth::user()->user_type == 'C')
                                <a class="dropdown-item" href="{{ route('pedidos.orders') }}">Pedidos</a>
                            @endif
                        @else
                            <a class="dropdown-item" href="{{ route('login') }}">Login</a>

                            <a class="dropdown-item" href="{{ route('register') }}">Registar</a>
                        @endif
                    </div>
                </li>
            </ul>

            <ul class="main-menu-m">
                <li>
                    <a href="/">Home</a>
                </li>

                <li class="label1" data-label1="hot">
                    <a href="{{ route('catalogo.index') }}">Catalogo</a>
                </li>

                <li>
                    <a href="#">Sobre Nós</a> <!-- /*route('about')*/ -->
                </li>

                <li>
                    <a href="#">Contactos</a> <!-- /*route('contacts')*/ -->
                </li>
                @if (!Auth::user() || Auth::user()->user_type == 'C')
                    <li>
                        <a href="{{ route('carrinho.cart') }}">Carrinho</a>
                    </li>
                @endif
                @if (Auth::user()->user_type == 'A' || Auth::user()->user_type == 'E')
                    <li><a class="dropdown-item" href="{{ route('admin.index') }}">Menu Admin</a>
                    </li>
                @endif
            </ul>
        </div>
    </header>


    <div class="content background">
        @yield('main')
    </div>


    <!-- Back to top -->
    <div class="btn-back-to-top" id="myBtn">
        <span class="symbol-btn-back-to-top">
            <i class="zmdi zmdi-chevron-up"></i>
        </span>
    </div>

    @vite('resources/js/app.js')
</body>


</html>
