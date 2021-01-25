<!DOCTYPE html>
<html lang="en">
<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>Informasi Toko Komputer</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- bootstrap css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}css/bootstrap.min.css">
    <!-- style css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}css/style.css">
    <!-- Responsive-->
    <link rel="stylesheet" href="{{ asset('/') }}css/responsive.css">
    <!-- fevicon -->
    <link rel="icon" href="{{ asset('/') }}img/user/fevicon.png" type="image/gif"/>
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="{{ asset('/') }}css/jquery.mCustomScrollbar.min.css">
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <!-- owl stylesheets -->
    <link rel="stylesheet" href="{{ asset('/') }}css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}css/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css"
          media="screen">
    <!-- Leaflet Files -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
          integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
          crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
            integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
            crossorigin=""></script>
</head>
<!-- body -->
<body>

<div class="header">
    <div class="container">
        <!--  header inner -->
        <div class="col-sm-12">
            <div class="menu-area">
                <nav class="navbar navbar-expand-lg ">
                    <!-- <a class="navbar-brand" href="#">Menu</a> -->
                    <button class="navbar-toggler collapsed" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa fa-bars"></i>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="{{ route('user') }}">HOME<span
                                        class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('about') }}">ABOUT</a></li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('maps') }}">MAPS</a></li>
                            <li class="#" href="#">
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- end header end -->
@yield('content')
<!--services start -->
<div class="contact_main">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="touch_text">Contact Us</h1>
            </div>
        </div>
    </div>
    <div class="contact_section_2">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="map_icon">
                        <img src="{{ asset('/') }}img/user/map-icon.png" style="max-width: 100%;padding-left: 30px; ">
                        <p class="email-text"><a href="#">Pekanbaru<br></a></p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="map_icon">
                        <img src="{{ asset('/') }}img/user/call-icon.png" style="max-width: 100%;padding-left: 30px;">
                        <p class="email-text"><a href="#">+812283810382</a></p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="map_icon">
                        <img src="{{ asset('/') }}img/user/email-icon.png" style="max-width: 100%; padding-left: 30px;">
                        <p class="email-text"><a href="#">PusarKomputer@gmail.com</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Contact_section end -->
    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <p class="copyright_text">© {{ date('Y') }} All Rights Reserved. <a href="https://html.design">Free
                            Website
                            Templates</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Javascript files-->
<script src="{{ asset('/') }}js/jquery.min.js"></script>
<script src="{{ asset('/') }}js/popper.min.js"></script>
<script src="{{ asset('/') }}js/bootstrap.bundle.min.js"></script>
@stack('js')
</body>
</html>
