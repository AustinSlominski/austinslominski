@include('layouts.partials.header')
<div class="container-fluid">

	<div class="row topBanner">
	   @include('layouts.partials.topBanner')
	</div>
	<div class="clear"></div>

	<div class="row content-container"> 
		<div class="col-md-2 col-sm-2 navigation-wrapper">
			@include('layouts.partials.navigation')
		</div>
  		<div class="col-md-10 col-sm-10 content-wrapper">
			<div class="content">
				@yield('content')
			</div>
		</div>
		@yield('canvas')
	</div>
	<div class="clear"></div>
</div>
@include('layouts.partials.footer')
