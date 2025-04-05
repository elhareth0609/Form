<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="lang" content="{{ app()->getLocale() }}">
    <meta name="theme" content="system">
    <meta name="url" content="{{ url('/') }}">
    <title>Form @hasSection('title') - @yield('title') @endif</title>

    <!-- Custom fonts for this template-->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Enter:wght@400;500;700&display=swap" rel="stylesheet">

    @include('layouts.app.header')

</head>
<body id="page-top">
    <div class="dropdown position-fixed bottom-0 end-0 mb-3 me-3 bd-mode-toggle">
        <button class="btn btn-bd-primary py-2 dropdown-toggle d-flex align-items-center"
                id="bd-theme"
                type="button"
                aria-expanded="false"
                data-bs-toggle="dropdown"
                aria-label="Toggle theme (auto)">
          <svg class="bi my-1 theme-icon-active" width="1em" height="1em"><use href="#circle-half"></use></svg>
          <span class="visually-hidden" id="bd-theme-text">Toggle theme</span>
        </button>
        <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bd-theme-text">
          <li>
            <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light" aria-pressed="false">
              <svg class="bi me-2 opacity-50" width="1em" height="1em"><use href="#sun-fill"></use></svg>
              Light
              <svg class="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
            </button>
          </li>
          <li>
            <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark" aria-pressed="false">
              <svg class="bi me-2 opacity-50" width="1em" height="1em"><use href="#moon-stars-fill"></use></svg>
              Dark
              <svg class="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
            </button>
          </li>
          <li>
            <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="auto" aria-pressed="true">
              <svg class="bi me-2 opacity-50" width="1em" height="1em"><use href="#circle-half"></use></svg>
              Auto
              <svg class="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
            </button>
          </li>
        </ul>
    </div>


    @php
        $isNavbar = isset($isNavbar) ? $isNavbar : true;
        $isSidebar = isset($isSidebar) ? $isSidebar : true;
        $isFooter = isset($isFooter) ? $isFooter : true;
        $isContainer = isset($isContainer) ? $isContainer : true;
    @endphp
    <!-- Main Content -->
    <div class="content">
        <div id="wrapper">

            <!-- Sidebar -->
            @if (isset($isSidebar) && $isSidebar)
                @include('layouts.app.menu.menu')
            @endif


            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content">
                    @if (isset($isNavbar) && $isNavbar)
                    @include('layouts.app.nav.nav')
                    @endif
                    @if (isset($isContainer) && $isContainer)
                        <div class="container-fluid">
                    @endif
                        @yield('content')
                    @if (isset($isContainer) && $isContainer)
                        </div>
                    @endif
                </div>


                @if (isset($isFooter) && $isFooter)
                    <footer class="sticky-footer">
                        <div class="container my-auto">
                            <div class="copyright text-center my-auto">
                                <span>Copyright &copy; Dashboard {{ date('Y') }}</span>
                            </div>
                        </div>
                    </footer>
                @endif

            </div>

            <div id="overlay"></div>

        </div>
                <!-- Scroll to Top Button-->
            <a class="scroll-to-top rounded" href="#page-top">
                <i class="mdi mdi-arrow-up"></i>
            </a>

            <!-- Logout Modal-->
            <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            <a class="btn btn-primary" href="login.html">Logout</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Footer -->
        @include('layouts.app.footer')
        <!-- End of Footer -->


        <script>

        </script>
</body>
</html>
