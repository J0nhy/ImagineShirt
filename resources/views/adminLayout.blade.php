
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard - NiceAdmin Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  @vite('resources/sass/app.scss')

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: May 30 2023 with Bootstrap v5.3.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body style="background-color:#171923">

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="{{ route('admin.index')}}" class="logo d-flex align-items-center">
        @if (Auth::user()->user_type == 'A' )
        <span class="d-none d-lg-block">ImagineShirtAdmin</span>
        @else
        <span class="d-none d-lg-block">ImagineShirtEmpregado</span>
        @endif
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>

      </ul>
      <div class="wrap-icon-header flex-w flex-r-m">



        <div style="padding-left: 13px;">
            @if (Auth::user())
                <?php
                    $nameParts = explode(' ', Auth::user()->name);
                    $firstName = $nameParts[0];
                ?>
                {{ $firstName }}
            @else
                <img src="/img/avatar_unknown.png" alt="Avatar" class="bg-dark rounded-circle" width="45"
                height="45">
            @endif
        </div>

        <ul class="navbar-nav me-1 me-lg-3">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    @if (Auth::user())
                        <img src="{{Auth::user()->fullPhotoUrl}}" alt="Avatar"
                            class="bg-dark rounded-circle" width="45" height="45">
                    @endif
                </a>

                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    @if (Auth::user())
                        <li><a class="dropdown-item" href="">Perfil</a>
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
                        <li><a class="dropdown-item" href="{{ route('pedidos.orders') }}">Pedidos</a>
                        </li>
                    @else
                        <li><a class="dropdown-item" href="{{ route('login') }}">Login</a>
                        </li>
                        <li><a class="dropdown-item" href="{{ route('register') }}">Registar</a>
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
                </ul>
            </li>
        </ul>
    </div>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
        @can('viewAny', \App\Models\Category::class)
      <li class="nav-item">
        <a class="nav-link  collapsed" href="{{ route('admin.index')}}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->
        @endcan

      @can('viewAny', \App\Models\users::class)
      <li class="nav-item">
        <a class="nav-link  collapsed" href="{{ route('users.index')}}">
            <i class="bi bi-grid"></i>
            <span>Users</span>
          </a>
      </li><!-- End Components Nav -->
      @endcan

      @can('viewAny', \App\Models\Category::class)
      <li class="nav-item">
        <a class="nav-link  collapsed" href="{{ route('categorias.index')}}">
            <i class="bi bi-grid"></i>
            <span>Categorias</span>
          </a>
      </li>
      @endcan

        @can('viewAny', \App\Models\colors::class)
      <li class="nav-item">
        <a class="nav-link  collapsed" href="{{ route('cores.index')}}">
            <i class="bi bi-grid"></i>
            <span>Cores</span>
          </a>
      </li>
        @endcan

        @can('viewAny', \App\Models\orders::class)
      <li class="nav-item">
        <a class="nav-link  collapsed" href="{{ route('encomendas.index')}}">
            <i class="bi bi-grid"></i>
            <span>Encomendas</span>
          </a>
      </li>
        @endcan

    </ul>

  </aside>

  <main id="main" class="main">

    <div class="pagetitle">
        @yield('main')


    </div>





  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
  </footer>
  <!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->

  <!-- Template Main JS File -->
  @vite('resources/js/app.js')
</body>

</html>
