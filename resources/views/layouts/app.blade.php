<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'UMVA GEO') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    <div id="app">
        <div class="header">
            <div class="container">
                <div class="row">

                    <div class="col-md-12">
                        <img src="/images/logo.png" width="80px" class="pull-left" style="margin:5px" />
                        <p class="logo">UMVA GEO
                        <span style="font-size:18px;"><?php  $route = Route::current();
                                if( array_key_exists('country',$route->parameters))
                                    {
                                        echo ' - '.$route->parameters['country'];
                                    }
                            ?>
                            </span>
                        </p>
                    </div>



                </div> <!-- closes .row -->
            </div> <!-- closes .container-fluid -->
            <div class="breadcrumb-container">
                <div class="container">
                   <ol class="breadcrumb">
                            <li><a href="/">home</a> </li>
                       <?php  $route = Route::current();
                       foreach($route->parameters as $key=>$value)
                           {
                               ?>
                               <li><a href="/<?php echo $value; ?>"><?php echo $value; ?></a> </li>
                       <?php
                           }
                       ?>

                   </ol>
                </div>
            </div> <!-- closes .country-title -->
        </div> <!-- closes .header -->

        <div class="container">
            @yield('content')
        </div>

        <div class="footer">
            <div class="container clearfix">
                <div class="pull-left">
                    <span>{{Date('Y')}}</span>
                </div>

            </div>
        </div>

    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
