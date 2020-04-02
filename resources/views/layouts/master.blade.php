
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>{{ $title ?? 'Welcome' }} - NCI Social</title>

  <!-- Bootstrap core CSS -->
  <link href="{{url('main/vendor/bootstrap/css/bootstrap.min.cs')}}s" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="{{url('main/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
  <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
  <!-- Custom styles for this template -->
  <link href="{{url('main/css/clean-blog.css')}}" rel="stylesheet">
  <link href="{{url('main/css/pop.css')}}" rel="stylesheet">

  @yield('style')

</head>

<body>

  @include('shared.nav')

  @yield('content')

  <hr>

  @include('shared.footer')

  <!-- Bootstrap core JavaScript -->
  <script src="{{url('main/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{url('main/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

  <!-- Custom scripts for this template -->
  <script src="{{url('main/js/clean-blog.min.js')}}"></script>
  <script src="{{url('main/js/pop.js')}}"></script>
  <script src="{{url('js/pagination.js')}}"></script>

  <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

  @yield('script')

</body>

</html>
