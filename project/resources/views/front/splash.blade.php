<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <title>{{ $gs->title }}</title>

  <!-- CSS Files  -->
  <link rel="stylesheet" href="{{ asset('assets/front/css/bootstrap.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/front/css/animate.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/front/css/all.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/front/css/lightbox.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/front/css/odometer.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/front/css/owl.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/front/css/main.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/front/css/toastr.min.css') }}" />
  

  <!-- Favicon -->
  <link rel="shortcut icon" href="{{ asset('assets/front/images/favicon.png') }}" type="image/x-icon" />

  @stack('css')

  @if ($link->pixel  != null)
    @if($px->type == 'facebook')
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '1193334787923539');
        fbq('track', 'PageView');
        </script>
     @elseif($px->type == 'google')
     <!-- Google Tag Manager -->
     <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-MGXCXL8');</script>
        <!-- End Google Tag Manager -->
    @endif 
  @endif

</head>

<body>
    @if ($px->type == 'google')
    <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MGXCXL8"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
@endif

    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <div class="banner">
                    

                    <img class="img-fluid " src="{{$splash->banner ?  asset('assets/images/splash/'.$splash->banner) : '' }}" alt="">
                </div>

                <div class="content mt-5">
                    <div class="row ">
                        <div class="col-md-8 d-flex justify-content-between ">
                            <div class="image 2">
                                <img class="img-fluid " src="{{ $splash->avatar ? asset('assets/images/splash/'.$splash->avatar) :'' }}" alt="">
                            </div>
                            <div class="content ml-4">
                                <h4 class="mb-4">{{ $spdata->title }}</h4>
                                <a class="btn btn-primary" href="{{ $spdata->product }}">@lang('Visit Website')</a>
                            </div>

                            <input type="hidden" value="{{ $spdata->counter }}" id="timeset">
                            <input type="hidden" value="{{ $link->url}}" id="urls">
                          
                            <div id="wait">
                                <button class="skip-button btn btn-primary btn-lg">@lang <span id="countdown">{{ $gs->ad_timeset }}</span>S</button>
                            </div>
                        </div>

                        
                            
                        

                    </div>
                </div>
               
            </div>
        </div>
    </div>

<!-- Header -->
{{-- <section class="shorted-link-section">
    <div class="shorted-link-header">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <div class="logo">
                <a href="{{ route('front.index') }}">
                    <img src="{{ asset('assets/front/images/logo/logo.png') }}" alt="logo">
                </a>
            </div>
            
        </div>

    </div>
</div>
    
<div class="shorted-link-wrapper">
    <iframe src="{{ $ads->ad_url }}" id="" frameborder="0" ></iframe>
</div>
</section> --}}



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
 

    let mainurl = $('#urls').val();
     var loader = {{ $gs->is_loader }};
     var gs      = {!! json_encode(DB::table('generalsettings')->where('id','=',1)->first(['is_cookie'])) !!};


var countdown=$('#timeset').val();
function counter() {
				countdown -= 1;

			    $('#countdown').html(countdown);

				if (countdown <= 0) {
					$('#continue').removeClass('d-none');
					$('#wait').addClass('d-none');
					clearInterval(t);
                    window.location.href = mainurl;
				}
			}
            $(document).ready(function() {
				t = setInterval("counter()", 1000);
			});





</script>
@stack('js')


</body>

</html>
