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
    <link href="../../../../evolunt/public/css/forms.css" rel="stylesheet">
    <link href="../../../../evolunt/public/css/buttons.css" rel="stylesheet">
    <link href="../../../../evolunt/public/css/agency.css" rel="stylesheet">

    <script src="../../../../evolunt/public/js/jquery.1.11.1.min.js"></script>
    <script src="../../../../evolunt/public/js/bootstrap.min.js"></script>

    <title>eVolunt</title>
</head>
<body class="animated fadeIn" marginwidth="0">
@include('templates.partials.navigation')
<header>
    <div class="container">
        <div class="intro-text">
            <div class="intro-lead-in">Welcome To eVolunt</div>
            <div class="intro-heading">A place to find local volunteers</div>
            <a href="{{ route('auth.signup') }}" class="page-scroll btn btn-azure btn-xl">Join</a>
        </div>
    </div>
</header>
<footer class="footer">
    <div class="container">
        <p class="text-muted"> Copyright © eVolunt 2017 - All rights reserved </p>
    </div>
</footer>
</body>
</html>
