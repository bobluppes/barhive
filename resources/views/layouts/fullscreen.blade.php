<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Demo of the BarHive POS System">
    <meta name="author" content="BarHive">

    <title>BarHive POS - Demo</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{ asset('css/metisMenu.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('css/sb-admin-2.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    <!-- Morris Charts CSS -->
    <link href="{{ asset('css/morris.css') }}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{ asset('css/font-awesome.css') }}" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

@yield('content')


<!-- /#wrapper -->

<!-- jQuery -->
<script src="{{ asset('js/jquery.js') }}"></script>

<!-- Bootstrap Core JavaScript -->
<script src="{{ asset('js/bootstrap.js') }}"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="{{ asset('js/metisMenu.js') }}"></script>

<!-- Morris Charts JavaScript -->
<script src="{{ asset('js/raphael.js') }}"></script>
<script src="{{ asset('js/morris.js') }}"></script>
<script src="{{ asset('js/morris-data.js') }}"></script>

<!-- Custom Theme JavaScript -->
<script src="{{ asset('js/sb-admin-2.js') }}"></script>
<script src="{{ asset('js/Page.js') }}"></script>

</body>

</html>
