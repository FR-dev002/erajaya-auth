
<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials.header')

    @include('partials.style')
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-footer-fixed">
<div class="wrapper">

    @include('partials.navbar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    @yield('breadcrumb')

    <!-- Main content -->
    <section class="content pt-5">
      <div class="container-fluid">

      @yield('content')
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>

    @include('partials.footer')
</div>
<!-- ./wrapper -->
    @include('partials.script')
</body>
</html>
