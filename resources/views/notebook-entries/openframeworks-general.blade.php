@extends('layouts.master')
	@section('customScript')
		<script type="text/javascript" src="{{ asset('js/paperjs/dist/paper-full.js') }}"></script>
		<script type="text/paperscript" src="{{asset('js/paperjs/autorotor.js')}}" canvas="canvas"></script>
	@stop
	
	@section('title') @parent {{ $title }} @stop
	
	@section('canvas')	
		<canvas id="canvas" resize="true"></canvas>
	@stop
	
	@section('content')
	<div class="content-block">
		<div class="col-md-12">
			<h2>General openFrameworks</h2>
			<p>openFrameworks is an open source C++ toolkit. If you've used Processing in the past or something, it's similar to that. I end up thinking of it as a more buff Processing based in C++ instead of Java. openFrameworks is a great place to create interactive installation pieces, find clever way of messing with video or data, etc. It's also what I prefer for testing GLSL shaders.</p>
		</div>
	</div>
	@stop
