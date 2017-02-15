<!doctype html>

<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <!-- Bootstrap core CSS -->
    <link href="../../../../evolunt/public/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../../../evolunt/public/css/font-awesome.min.css" rel="stylesheet">
    <link href="../../../../evolunt/public/css/animate.min.css" rel="stylesheet">
    <link href="../../../../evolunt/public/css/timeline.css" rel="stylesheet">
    <link href="../../../../evolunt/public/css/cover.css" rel="stylesheet">
    <link href="../../../../evolunt/public/css/buttons.css" rel="stylesheet">
    <link href="../../../../evolunt/public/css/friends.css" rel="stylesheet">
    <link href="../../../../evolunt/public/css/messages.css" rel="stylesheet">
    <link href="../../../../evolunt/public/css/fullcalendar.min.css" rel="stylesheet">

    <script src="../../../../evolunt/public/js/jquery.1.11.1.min.js"></script>
    <script src="../../../../evolunt/public/js/font.js"></script>
    <script src="../../../../evolunt/public/js/bootstrap.min.js"></script>
    <script src="../../../../evolunt/public/js/moment.min.js"></script>
    <script src="../../../../evolunt/public/js/fullcalendar.min.js"></script>

    <script>
        $(".nav li").on("click", function () {
            $(".nav li").removeClass("active");
            $(this).addClass("active");
        });
    </script>

    <title>eVolunt</title>
</head>
<body class="animated fadeIn" marginwidth="0">
@include('templates.partials.navigation')
        <!-- Begin page content -->
@yield('whole')
<div class="container page-content ">
    <div class="row">
        <div class="col-md-3">
            @include('templates.partials.left_post')
        </div>
        <div class="col-md-6">
            @include('templates.partials.alerts')
            @yield('center_post')
        </div>
        <div class="col-md-3">
            @yield('right_post')
        </div>
    </div>
</div>
<footer class="footer">
    <div class="container">
        <p class="text-muted">Copyright © eVolunt 2017 - All rights reserved </p>
    </div>
</footer>
</body>
</html>