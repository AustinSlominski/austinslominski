@include('layouts.partials.header')
<div class="container-fluid">
	<div class="topBanner">
	   @include('layouts.partials.topBanner')
	</div>
	<div class="clear"></div>

	<div class="content-container"> 
		<div class="navigation-wrapper">
			@include('layouts.partials.navigation')
		</div>
  		<div class="content-wrapper">
			@yield('content')
		</div>
		@yield('canvas')
	</div>
	<div class="clear"></div>
</div>
@include('layouts.partials.footer')
