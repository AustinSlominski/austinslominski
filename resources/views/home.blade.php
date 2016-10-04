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
	<a name="statement" class="anchor"></a>
	<div class="content-block statement">
		<p>
			I am a programmer, designer, and systems administrator. Every day we demand more from our technology and <br> <strong>I am here to help you adapt.</strong>
		</p>
	</div>

	<a name="programming" class="anchor"></a>
	<div class="content-block programming">
		<div class="col-md-6">
			<h2>Programming</h2>
			<p>
				It's important for me to understand and work with current technologies and languages.
				You can usually find me working in <strong>HTML, CSS, javascript, and PHP</strong>, 
				all of which I used to build this site. I am also capable with c++ and a variety of
				frameworks.
			</p>
			<p>
				Over the last five years, I have been involved with the construction and maintenance
				of dozens of sites for the University of Montana and have spent time maintaining
				The Society of Historical Archaeology, configuring and managing their back-end code and
				database. I have built and managed databases in <strong>MySQL</strong> and <strong>MSSQL</strong>.
			</p>
		</div>
		<div class="col-md-6 hidden-sm hidden-xs skills-list">
			<ul>
				<li><strong>PHP</strong></li>
				<li><strong>HTML</strong></li>
				<li><strong>CSS</strong></li>
				<li><strong>Javascript</strong></li>
				<li><strong>MySQL</strong></li>
				<li><strong>MSSQL</strong></li>
			</ul>
		</div>
	</div>
	<div class="col-sm-12 hidden-lg hidden-md content-block contact-list text-center">
			<ul>
				<li><strong>PHP</strong></li>
				<li><strong>HTML</strong></li>
				<li><strong>CSS</strong></li>
				<li><strong>Javascript</strong></li>
				<li><strong>MySQL</strong></li>
				<li><strong>MSSQL</strong></li>
			</ul>
	</div>
	
	<div class="portfolio-block">

	</div>
	
	<a name="design" class="anchor"></a>
	<div class="content-block design">
		<div class="col-md-6">
			<h2>Design</h2>
			<p>
				Users want a consistent experience across all of their devices, whether they are viewing it on 
				their laptop, their phone, or tablet. A solid, clean design is important to give your content
				the attention it needs.
			</p>
			<p>
				Try this site on your phone, resize your window, I've tried to make it work on as many platforms
				as possible.
			</p>
		</div>
		<div class="col-md-6 hidden-sm hidden-xs">
		</div>
	</div>

	<a name="administration" class="anchor"></a>
	<div class="content-block administration">
		<div class="col-md-6">
			<h2>Administration</h2>
		<p>
			It's important to have somebody available to fix a problem when the server goes down, or
			manage your mail server, or have the skills necessary to debug and resolve issues wherever 
			your site is being hosted.
		</p>
	</div>
		<div class="col-md-6">
		</div>
	</div>

	<a name="contact" class="anchor"></a>
	<div class="content-block contact">
		<div class="col-md-6">

			<h2>Contact</h2>
			<p>
				I'm available for web development and other programming roles. Send me an email or give me a call.
	<br><br>
			</p>

			<h2>About</h2>
			<p>
				This site was written in PHP, using the Laravel framework. I used paper.js to create the background,
				as part of an ongoing study of generative art. I have my site on an Ubuntu server that I have 
				configured and manage.
			</p>
			<p>
				I'm a programmer and artist based out of Missoula, MT. While I'm building my site for my art, 
				you can find my work <a href="https://www.facebook.com/aceslowman/">here</a>.	
			</p>

		</div>

		<div class="col-md-6 hidden-sm hidden-xs contact-list">
			<ul>
				<li>Phone : 406.207.2708</li>
				<li>Email : austin.slominski@gmail.com</li>
				<li>Github:<strong> <a href="https://github.com/AustinSlominski">AustinSlominski</a></strong></li>
			</ul>
		</div>
	</div>

		<div class="col-sm-12 hidden-lg hidden-md content-block contact-list text-center">
			<ul>
				<li><strong>Phone :</strong><br> 406.207.2708</li>
				<li><strong>Email :</strong><br> austin.slominski@gmail.com</li>
				<li><strong>Github:</strong><br><strong><a href="https://github.com/AustinSlominski">AustinSlominski</a></strong></li>
			</ul>		
		</div>
	@stop
