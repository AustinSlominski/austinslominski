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
			<p>Today I had a chance to mess around with some simple colorizing and anaglyph stuff, enjoying that way that some of that looks.</p>
			<img class="notebook-img" src="{{ asset('img/note-img/anaglyph.png') }}">
			<p>It's nothing much but since I've been out of Photoshop any time I spend with GIMP is worth it to even just get the hotkeys down again</p>
			<p>Worked on my variable-rate looper in Max as well, hoping I can incorporate it into plenty of other sound projects. Working on smoothing out the sound, making sure it's accurate, and just making it overall more flexible. I need kind of an insert version and an instrument version.</p>
			<p>A little slip up in productivity for the last few days, but I've been glad to get a new focus on sound right now.</p>
		</div>
	</div>
	@stop