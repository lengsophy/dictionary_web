<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <link rel="icon" type="image/png" href="{{url('assets/img/logo.png')}}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title> Coupon MS </title>
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="{!! url('assets/css/bootstrap.min.css" rel="stylesheet')!!}" />
  <link href="{!! url('assets/css/paper-dashboard.min790f.css?v=2.0.1')!!}" rel="stylesheet" />
  <link href="{!! url('assets/demo/demo.css')!!}" rel="stylesheet" />
</head>
<body>
  <div class="wrapper">
    <div class="full-page section-image" filter-color="black" data-image=" {{ url('assets/img/bg/david-marcu.jpg') }}">
      <div class="content">
        @yield('content')
      </div>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="{!! url('assets/js/core/jquery.min.js') !!}"></script>
  <script src="{!! url('assets/js/core/bootstrap.min.js') !!}"></script>
  <script src="{!! url('assets/demo/demo.js') !!}"></script>
    <script>
        $(document).ready(function() {
          demo.checkFullPageBackgroundImage();
        });
    </script>
</body>

</html>