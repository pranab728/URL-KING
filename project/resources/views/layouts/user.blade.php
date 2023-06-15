<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <title>URL Shortner</title>

  <!-- CSS Files  -->
  <link rel="stylesheet" href="{{ asset('assets/front/css/bootstrap.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/front/css/animate.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/front/css/all.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/front/css/lightbox.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/front/css/odometer.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/front/css/owl.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/front/css/main.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/front/css/toastr.min.css') }}" />
  <link href="{{ asset('assets/admin/css/summernote.css') }}" rel="stylesheet">

  <!-- Favicon -->
  <link rel="shortcut icon" href="{{ asset('assets/front/images/favicon.png') }}" type="image/x-icon" />

  @stack('css')

  <!-- Meta Pixel Code -->

  <noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=1193334787923539&ev=PageView&noscript=1"
  /></noscript>
  <!-- End Meta Pixel Code -->

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

<!-- Header -->
<!-- Hero -->

<main class="dashboard-section">

    @includeIf('partials.user.sidebar')


@yield('content')
</main>
<!-- JS Files -->
<script src="{{ asset('assets/front/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/front/js/bootstrap.bundle.js') }}"></script>
<script src="{{ asset('assets/front/js/viewport.jquery.js') }}"></script>
<script src="{{ asset('assets/front/js/wow.min.js') }}"></script>
<script src="{{ asset('assets/front/js/odometer.min.js') }}"></script>
<script src="{{ asset('assets/front/js/lightbox.min.js') }}"></script>
<script src="{{ asset('assets/front/js/owl.min.js') }}"></script>
<script src="{{ asset('assets/front/js/main.js') }}"></script>
<script src="{{ asset('assets/front/js/custom.js') }}" ></script>
<script src="{{ asset('assets/front/js/toastr.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/summernote.js') }}"></script>
{!! Toastr::message() !!}
<script>
    let mainurl = '{{ url('/') }}';
     var loader = {{ $gs->is_loader }};
     var gs      = {!! json_encode(DB::table('generalsettings')->where('id','=',1)->first(['is_cookie'])) !!};

</script>
<script>
	$(document).ready(function() {
	$('.summernote').summernote()
	$('.note-codable').on('blur', function() {
	var codeviewHtml        = $(this).val();
	var $summernoteTextarea = $(this).closest('.note-editor').siblings('textarea');
	$summernoteTextarea.val(codeviewHtml);})
});
</script>
@stack('js')


</body>

</html>
