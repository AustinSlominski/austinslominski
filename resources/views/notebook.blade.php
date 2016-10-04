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
	<h2>Notebook</h2>
		<div class="col-md-6">
			<h3>Daily Notes</h3>
			<ul>
				<li><a href="/notebook/2016-10-04">2016-10-04</a></li>
			</ul>
			<h3>Music</h3>
			<ul>

			</ul>
		</div>
		<div class="col-md-6">
			<h3>openFrameworks</h3>
			<ul>
				<li><a href="/notebook/openframeworks-general">2016-10-04 General oF</a></li>
				<li><a href="/notebook/openframeworks-renaming">2016-10-04 Renaming Projects</a></li>
			</ul>
			<h3>Music</h3>
			<ul>

			</ul>
		</div>		
	</div>
	@stop
