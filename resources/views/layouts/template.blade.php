<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Development</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        @yield('csstambahan')
    </head>
    <body class="hold-transition sidebar-mini">
        <div class="wrapper">

            <!-- Memasukan layout header  -->
            @include('layouts.header')

            <!-- memasukan layout sidebar  -->
            @include('layouts.sidebar')   

            <!-- memasukan konten wrapper  -->
            @include('layouts.mainkonten')

            <!-- Main content -->
            <div class="content">
            <div class="container-fluid">

                <!-- untuk konten -->
                @yield('konten')        

            </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <!-- memasukan layout footer  -->
            @include('layouts.footer')

        </div>
        
    </body>
</html>