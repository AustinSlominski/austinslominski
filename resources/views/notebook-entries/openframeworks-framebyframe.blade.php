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
			<h2>Frame by Frame Rendering with ofVideoPlayer</h2>
			<p>There are a lot of situations in which running everything realtime is not necessary. I've been looking for more methods to do this, but here is what is working for me right now.</p>
			<p>Once you have your videos loaded and everything, usually you will call ofVideoPlayer::update() within ofApp::update(). If you want to force it to go frame-by-frame, do this:</p>
<pre><code>video.nextFrame();
video.update();</code></pre>
			<p>As an alternative, <a href="https://forum.openframeworks.cc/t/processing-a-qt-video-frame-by-frame/2547/5">memo suggests using this:</a></p>
<pre><code>video.setPosition(currentFrame * 1.0f/video.getTotalNumFrames());
currentFrame++;</code></pre>		
<p>Following this, you want to save an image. You can use ofSaveImage() for this.</p>	
<pre><code>if(capture_frames){
    ofPixels tmpPixels;
    vid.getPixels( tmpPixels );
    ofSaveImage( tmpPixels, ofToString(ofGetFrameNum())+".png" );
}</code></pre>
<p>I use 'capture_frames' as a bool to toggle the recording on and off, which you can just go ahead and bind to whatever event you want.</p>
<h3>What about video format?</h3>
<p>I had a lot of issues getting the right video format. Sometimes you will get skipped frames, or the nextFrame() command doesn't work how you want it to. I've found that h.264 can be somewhat problematic. What I have done is format my videos as Apple Prores 422, and added a keyframe for every frame. You can achieve this with the following ffmpeg command through the terminal. If you don't have ffmpeg, get it <a href="https://ffmpeg.org"> here:</a></p>
<pre><code>ffmpeg -y -i input.mov -keyint_min 1 -c:v prores -profile:v 2 output.mov</code></pre>
		</div>
	</div>
	@stop
