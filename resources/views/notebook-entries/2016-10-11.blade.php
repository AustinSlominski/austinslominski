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
		<div class="col-md-6">
			<h2>{{$title}}</h2>
			<p>I've been thinking about what teaching would do for me. Which is probably the wrong way to think about teaching, but just the effort of trying to write things down in a way that can be understood by others means a lot to me. Honestly I don't really imagine anyone is going to be coming to this site, using these pages, etc, so they have to be useful to me, first and foremost.</p>
			<p>Whenever I feel confident in a topic, I'm humbled quickly when I actually try to explain it. Sometimes I chalk it up to not having much skill in explaining or speaking, but it's also because I don't understand it well enough yet myself. I remember something we used to do in a highschool biology class of mine, when we were forced to write something down step by step in a way that anyone could follow along with. It usually ended up in some disaster when the teacher would try to follow what you wrote step by step. It's hard to explain things.</p>
			<p>If I'm going to invest time in my life to learning, I need to invest time to teaching, because I'm not going to remember the things that I learn today in five years, but hopefully my notebooks will be like that of a teacher that knows me better than anybody.</p>
		</div>
	</div>
	@stop