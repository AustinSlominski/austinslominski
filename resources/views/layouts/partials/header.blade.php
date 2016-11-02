@section('header')
<!DOCTYPE html>
<html>
<head>
<title>
@section('title')
@show
</title> 
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

<link rel="stylesheet" href="{{ asset('js/bootstrap-3.3.7-dist/css/bootstrap.css') }}">

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.7.0/styles/default.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.7.0/highlight.min.js"></script>
<!-- <link href="{{ asset('css/default.css') }}" rel="stylesheet">  -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet"> 
<link rel="stylesheet" href="{{ asset('css/agate.css') }}">
<script>hljs.initHighlightingOnLoad();</script>
@section('customScript')

@show
</head>	
<body>
@show
