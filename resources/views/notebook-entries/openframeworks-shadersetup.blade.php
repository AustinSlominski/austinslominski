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
			<h2>Shader Setup</h2>
			<p>In the past I've been reliant on writing and testing shaders in Jitter, but I've begun to do it much more in openFrameworks, it feels more natural and portable.</p>
			<p>To enable any kind of shader, initialize it within <b>ofApp.h</b><pre><code>ofShader shader;</code></pre></p> 
			<p>Now, load the shader within ofApp.cpp:<pre><code>shader.load("shadername")</code></pre></p>
			<p>The name that you pass into load() is parsed from the filenames of your shader. For your vertex shader, use <b>shadername.vert</b>, and for your fragment shader, <b>shadername.frag</b>.</p>
			<p>Now you want to enter the appropriate data into your shader. </p>
			<pre>
<code>shader.begin();
	shader.ofSetUniformTexture("tex1", input2.getTexture(), 1);
	shader.ofSetUniform1f("float_name",float myFloat);
	shader.ofSetUniform1i("int_name",float myInt);
	shader.ofSetUniform2f("vec2_name", vec2 myVec);
	input1.draw(0,0);
shader.end();</code></pre>
<p>As you can see above, this is when you enter your uniform variables into your shader, as well as input the textures the shader will be using. The above example is just one way of handling multiple textures. "tex0" is assumed to be what is drawn (input.draw(0,0)), but you can also explicitly set tex0.</p>
			<pre>
<code>shader.begin();
	shader.ofSetUniformTexture("tex0", input1.getTexture(), 0);
	shader.ofSetUniformTexture("tex1", input2.getTexture(), 1);
	shader.ofSetUniform1f("float_name",float myFloat);
	shader.ofSetUniform1i("int_name",float myInt);
	shader.ofSetUniform2f("vec2_name", vec2 myVec);
	input1.draw(0,0);
shader.end();</code></pre>
<h3>Main.cpp</h3>
<p>Your shaders still won't run without setting up the openGL window settings. Within <b>main.cpp</b>:</p>
			<pre>
<code>ofGLWindowSettings settings;
settings.setGLVersion(2,1);
ofCreateWindow(settings);
ofSetFullscreen(true);

ofRunApp(new ofApp());</code></pre>
<p>This will set your openGL version to 2.1. I am currently using 2.1 exclusively because the Syphon framework is not working with openGL 3. If you would like to use openGL 3, change that to (3,2).</p>
<small><em>Note: explain this better, I still don't really understand what's going on behind the scenes with this.</em> </small>
			
		</div>
	</div>
	@stop
