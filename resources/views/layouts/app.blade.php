<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="{{url('assets/img/logo.png')}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport'
    />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title> Dictionary Management </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <link href="{!! url('assets/css/bootstrap.min.css" rel="stylesheet')!!}" />
    <link href="{!! url('assets/css/paper-dashboard.min790f.css?v=2.0.1')!!}" rel="stylesheet" />
    <link href="{!! url('assets/demo/demo.css')!!}" rel="stylesheet" />

    <link rel="stylesheet" href="{!! url('css/custom.css') !!}">
    <!-- jquery file -->

    <link href="{!! url('assets/js/jquery/jquery-ui.css') !!}" rel="stylesheet"type="text/css"/>
</head>

<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKDMSK6" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <div class="wrapper">
        @include('layouts.sidebar') 

        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
                <div class="container-fluid">
                    <div class="navbar-wrapper">
                        <div class="navbar-minimize">
                            <button id="minimizeSidebar" class="btn btn-icon btn-round">
                      <i class="nc-icon nc-minimal-right text-center visible-on-sidebar-mini"></i>
                      <i class="nc-icon nc-minimal-left text-center visible-on-sidebar-regular"></i>
                    </button>
                        </div>
                        <div class="navbar-toggle">
                            <button type="button" class="navbar-toggler">
                      <span class="navbar-toggler-bar bar1"></span>
                      <span class="navbar-toggler-bar bar2"></span>
                      <span class="navbar-toggler-bar bar3"></span>
                    </button>
                        </div>
                        <a class="navbar-brand" href="#pablo">Dictionary Management</a>
                    </div>
                    @if(Session::has('message'))
                    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                    @endif
                    <div class="collapse navbar-collapse justify-content-end">
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="https://example.com/" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                <i class="nc-icon nc-bullet-list-67"></i>
                            </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                   <a class="dropdown-item" href="{{url('profile')}}">
                                        <i class="nc-icon nc-single-02"></i> {{Auth::user()->name}}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                              document.getElementById('logout-form').submit();">
                                    <i class="nc-icon nc-button-power"></i> Log out</a>
                                   
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            {{-- Content --}}
            <div class="content">
                @yield('content')
            </div>
            {{-- End Content --}}
            <footer class="footer footer-black  footer-white ">
                <div class="container-fluid">
                    <div class="row">
                        <div class="credits ml-auto">
                            <span class="copyright">
                      Copy Right © By PassApp Developer
                    </span>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <!--   jquery JS Files   -->
    <script src="{!! url('assets/js/validate_number.js') !!}"></script>
    <!--   Core JS Files   -->
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
    <script src="{!! url('assets/js/core/popper.min.js') !!}"></script>
    <script src="{!! url('assets/js/core/bootstrap.min.js') !!}"></script>
    <script src="{!! url('assets/js/plugins/perfect-scrollbar.jquery.min.js') !!}"></script>
    <script src="{!! url('assets/js/plugins/moment.min.js') !!}"></script>





    <script src="{!! url('assets/js/plugins/jquery.validate.min.js') !!}"></script>
    <!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
    <script src="{!! url('assets/js/plugins/jquery.bootstrap-wizard.js') !!}"></script>

    <!--    Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
    <script src="{!! url('assets/js/plugins/bootstrap-selectpicker.js') !!}"></script>
    <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
    <script src="{!! url('assets/js/plugins/bootstrap-datetimepicker.js') !!}"></script>

    <!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
    <script src="{!! url('assets/js/plugins/jquery.dataTables.min.js') !!}"></script>
    <!--  Notifications Plugin    -->
    <script src="{!! url('assets/js/plugins/bootstrap-notify.js') !!}"></script>
    <script src="{!! url('assets/js/plugins/jasny-bootstrap.min.js') !!}"></script>
    <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{!! url('assets/js/paper-dashboard.min790f.js?v=2.0.1') !!}" type="text/javascript"></script>
    <!-- Paper Dashboard DEMO methods, don't include it in your project! -->
    <script src="{!! url('assets/demo/demo.js') !!}"></script>
    <!-- Sharrre libray -->
    <script src="{!! url('assets/demo/jquery.sharrre.js') !!}"></script>

    <script>
        $(document).ready(function() {
            // initialise Datetimepicker and Sliders
            demo.initDateTimePicker();
            if ($('.slider').length != 0) {
            demo.initSliders();
            }
            // hide alert-success & danger
            $(".alert-success").delay(5000).slideUp(300);
            $(".alert-danger").delay(5000).slideUp(300);
        });
    </script>
    @stack('scripts')
</body>

</html>