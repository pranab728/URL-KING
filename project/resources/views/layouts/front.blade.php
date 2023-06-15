<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="{{$gs->title}}">

  @if(isset($page->meta_keywords) && isset($page->meta_description))
  <meta property="og:title" content="{{$page->title}}" />
  <meta property="og:description" content="{{ $page->meta_description != null ? $page->meta_description : strip_tags($page->meta_description) }}" />
	<meta name="keywords" content="{{ $page->meta_keywords }}">
	<meta name="description" content="{{ $page->meta_description }}">
	<title>{{$gs->title}}</title>

	@elseif(isset($blog->meta_tag) && isset($blog->meta_description))

		<meta property="og:title" content="{{$blog->title}}" />
		<meta property="og:description" content="{{ $blog->meta_description != null ? $blog->meta_description : strip_tags($blog->meta_description) }}" />
		<meta property="og:image" content="{{asset('assets/images/blogs/'.$blog->photo)}}" />
		<meta name="keywords" content="{{ $blog->meta_tag }}">
		<meta name="description" content="{{ $blog->meta_description }}">
		<title>{{substr($blog->title, 0,11)."-"}}{{$gs->title}}</title>

	@elseif(isset($link))

		<meta name="title" content="{{ !empty($link->meta_title) ?  $link->meta_title : ''}}">
		<meta name="description" content="{{ $link->meta_description != null ? $link->meta_description : strip_tags($link->description) }}">
		<meta property="og:title" content="{{$link->meta_title}}" />
		<meta property="og:description" content="{{ $link->meta_description != null ? $link->meta_description : strip_tags($link->description) }}" />
		<title>{{$gs->title}}</title>

	@else

		<meta property="og:title" content="{{$gs->title}}" />
		<meta property="og:image" content="{{asset('assets/images/'.$gs->logo)}}" />
		<meta name="title" content="{{ $seo->meta_title }}">
		<meta name="description" content="{{ $seo->meta_description }}">
		<meta name="author" content="GeniusOcean">
		<title>{{$gs->title}}</title>

	@endif

  

  <title>{{$gs->title}}</title>

  <!-- CSS Files  -->
  <link rel="stylesheet" href="{{ asset('assets/front/css/bootstrap.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/front/css/animate.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/front/css/all.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/front/css/lightbox.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/front/css/odometer.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/front/css/owl.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/front/css/main.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/front/css/toastr.min.css') }}" />
 
  @if(!empty($seo->google_analytics))
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag() {
				dataLayer.push(arguments);
		}
		gtag('js', new Date());
		gtag('config', '{{ $seo->google_analytics }}');
	</script>
	@endif

  @if ($default_font->font_value)
			<link href="https://fonts.googleapis.com/css?family={{ $default_font->font_value }}&display=swap" rel="stylesheet">
		@else
			<link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
		@endif

    @if ($default_font->font_family)
			<link rel="stylesheet" id="colorr" href="{{ asset('assets/front/css/font.php?font_familly='.$default_font->font_family) }}">
		@else
			<link rel="stylesheet" id="colorr" href="{{ asset('assets/front/css/font.php?font_familly='."Open Sans") }}">
		@endif
  

  <!-- Favicon -->
  <link rel="shortcut icon" href="{{ asset('assets/front/images/favicon.png') }}" type="image/x-icon" />

  @stack('css')

</head>

<body>
  <!-- Overlay Loader & ScrollToTop Button -->
  <span class="toTopBtn">
    <i class="fas fa-angle-up"></i>
  </span>
  <div class="overlay"></div>
  <div class="loader"></div>
  <!-- Overlay Loader & ScrollToTop Button -->
<!-- Header -->
<header>
   @includeIf('partials.front.navbar')
</header>
<!-- Header -->
<!-- Hero -->
@yield('content')

@includeIf('partials.front.linkmanagement');

<footer>
    @include('partials.front.footer')
</footer>
<!-- JS Files -->
<script src="{{ asset('assets/front/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/front/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/front/js/viewport.jquery.js') }}"></script>
<script src="{{ asset('assets/front/js/wow.min.js') }}"></script>
<script src="{{ asset('assets/front/js/odometer.min.js') }}"></script>
<script src="{{ asset('assets/front/js/lightbox.min.js') }}"></script>
<script src="{{ asset('assets/front/js/owl.min.js') }}"></script>
<script src="{{ asset('assets/front/js/main.js') }}"></script>
<script src="{{ asset('assets/front/js/custom.js') }}" ></script>
<script src="{{ asset('assets/front/js/toastr.min.js') }}"></script>

  {!! Toastr::message() !!}
<script>
    let mainurl = '{{ url('/') }}';
     var loader = {{ $gs->is_loader }};
     var gs      = {!! json_encode(DB::table('generalsettings')->where('id','=',1)->first(['is_cookie'])) !!};
	
</script>


@stack('js')


</body>

</html>
