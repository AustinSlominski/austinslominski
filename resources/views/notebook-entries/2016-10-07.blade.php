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
			<p>I need to put at least some effort into this notebook every day for it to be useful to me. If I can't explain something well, I don't understand it well.</p>
			<p>I want to stop sharing so many work-in-progress updates. They come from a place of excitement, but it's hollow. The reward is so much greater if I can see the value in something and keep it to myself until it's really finished. It's a junk-food approach to sharing that is easy to fall into, but you lose depth. I always told myself I don't want to make tech-art toys. I don't want to make things just to say "Hey, check out what I can do with this thing I bought.". If I was to play that game, I'd lose, I don't have the money to make things just to show off the newest consumer electronics. So, when something is just "cool", I'll hold onto it for a while and see if it can do something a little more than that.</p>
		</div>
	</div>
	@stop
