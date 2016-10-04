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
			<p>So I guess this is the first entry into this notebook. I've been keeping notes in this way for a while now but with this it'll be a lot easier to add and remove information from certain entries.</p> 
			<p>I've been thinking a lot about how permanent study is, or really just how little I seem to remember when I jump in and out of certain projects. Like while setting up the notebook page, I was sitting there wondering whether or not I wanted to make a full system out of it. I guess that would be fine, but I'd rather just get up and going with it, I'm not in the mood for much web work right now</p>
			<p>I'm in between a few projects, most of them mainly dealing with openFrameworks and Kinect, but also looking to get into some SuperCollider stuff, just because it's always interested me. I am better with Max though, which makes me think it's a waste of time to just learn a new language. Every year I look back and think about the fact that I have no longer videos, no longer sound pieces, I spend a lot of time learning different things, and relearning them.</p>
		</div>
	</div>
	@stop
