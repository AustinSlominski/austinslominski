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
		<h2>Notebook</h2>
		<p><em>This notebook contains both my daily notes about whatever, and also my references for what I work on and learn. Some of this might be useful, some useless, I'll try to make it useful to others when I can.</em></p><hr>
	</div>

		<div class="col-md-6">
			<h3>Daily Notes</h3>
			<ul>
				<li><a href="/notebook/2016-10-04">2016-10-04</a></li>
				<li><a href="/notebook/2016-10-07">2016-10-07</a></li>
				<li><a href="/notebook/2016-10-10">2016-10-10</a></li>
			</ul>
		</div>
		<div class="col-md-6">
			<h3>openFrameworks</h3>
			<ul>
				<li><a href="/notebook/openframeworks-general">2016-10-04 General oF</a></li>
				<li><a href="/notebook/openframeworks-renaming">2016-10-04 Renaming Projects</a></li>
				<li><a href="/notebook/openframeworks-shadersetup">2016-10-07 Shader Setup</a></li>
				<li><a href="/notebook/openframeworks-framebyframe">2016-10-07 ofVideoGrabber frame-by-frame rendering</a></li>				
			</ul>
		</div>


		<div class="col-md-6">
			<h3>Max/MSP</h3>
			<ul>
				<li><a href="/notebook/max-groove">[groove~]</a></li>
			</ul>
		</div>
		<div class="col-md-6">
			<h3>Jitter</h3>
			<ul>
	
			</ul>
		</div>

	</div>
	@stop
