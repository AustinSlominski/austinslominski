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
		<div class="col-md-8 notebook-content">
			<h2>[groove~]</h2>
			<p><em><b>"The groove~ object is a variable-rate, looping, sample-playback object which references the audio information stored in a buffer~ object with the same name."</b></em></p>
			<p>The groove object is the foundation of most audio looping mechanisms in Max.</p> 
			<h3>Basic Usage</h3>
			<p><b>[groove~ {symbol buffer-name} {int number-of-channels}]</b></p>
			<img class="notebook-img" src="{{ asset('img/note-img/groove-1.png') }}">
			<p>Above is a basic example of how groove will be used. In this example we have a 2-channel buffer, "my-sound", that is being referenced by our groove~. Our groove~ is sending two values, the output of our first and second channels.</p>
			<p>
				Groove accepts a signal to control playback and speed. Send a float that represents the speed of your sound (1=normal,0=stopped) into a sig~, and then to the first inlet of groove~.
			</p>
			<h3>Loop Sync</h3>
			<p>Sometimes you want to use the loop as a trigger for something else. To do this, use the final outlet. The last outlet will send a signal from 0.0 - 1.0, with 1.0 being the end of the loop. You might want to use this signal as it is, or you might want to trigger a bang.</p>
			<p>To trigger a bang at the beginning or end of a loop, -- note to self: pick this apart and finish section --</p>
			<img class="notebook-img" src="{{ asset('img/note-img/groove-2.png') }}">
			<h3>Smoothing a Loop</h3>
			<p>You might notice a clicking sound when your loop is running. This is because the end of your loop immediately jumps to the beginning, causing a sudden change in volume. There are a few different ways we can approach smoothing this out.</p>
			<p>A typical approach might be using something like a line~ object. Another method I just <a href="https://cycling74.com/forums/topic/groove-loop-with-no-clicks/#.V_1HeKOZN0w">recently came across</a> is using the trapezoid~ object to smooth the beginning and end of the sample. The execution is simple:</p>
			<img class="notebook-img" src="{{ asset('img/note-img/groove-3.png') }}">			
			<p>The float labeled "Smoothness" sets the speed at which it ramps up and ramps down. You can of course set these individually if you have a sample that needs precise tweaking.</p>
		</div>
	</div>
	@stop
