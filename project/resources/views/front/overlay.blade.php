

    

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
        <iframe src="{{ $link->url }}" style="width: 100%; height: 700px; position:absolute; z-index:1;"></iframe>


        
     
    @if($overlay->type=='contact' )

    

        <div class="card" style="position: relative;" id="label_text">
            <div class="card-body">
                <h5 class="card-text" style="position: fixed; z-index:99999; min-width:100px;bottom: 10px; right:15px; background-color:aliceblue; padding: 10px 15px; border-radius:10px; cursor:pointer" ><i class="fa fa-question-circle" aria-hidden="true"></i> <span ></span>Hello</h5>
            </div>
        </div> 
        
        <form class="contact-form row g-3 gx-xxl-4 contactform overcontact" id="contactform" action="{{route('overlay.contact')}}" method="POST">
        @csrf

        <div class="card" id="form" style="position: relative;">
            <div class="card-body" style="position: fixed; z-index:99999; bottom: 10px; right:15px; min-width:300px ;background-color:aliceblue;  border-radius:10px; padding: 30px 20px">

                <div class="d-flex justify-content-between">
                    <h5 class="card-title " id="form-title">@lang('Email Form')</h5>
                    <span class="h5" id="cross" style="margin-top:-20px; cursor:pointer"><i class="fa fa-times" aria-hidden="true"></i></span>
                </div>
               

                
                <div class="form-group mt-2">
                    <label for="name" class="form-label">@lang('Name')</label>
                    <input type="text" id="name" name="name" class="form-control form--control bg--section"
                        value="" required="" placeholder="{{ __('Jhon Doe') }}">
                </div>
                <div class="form-group mt-2">
                    <label for="email" class="form-label">@lang('Email')</label>
                    <input type="text" id="email" name="email" class="form-control form--control bg--section"
                        value="" required="" placeholder="{{ __('Enter Email Here..') }}">
                </div>
                <div class="form-group mt- mb-4">
                    <label for="demo-email" class="form-label">@lang('Message')</label>
                    <textarea class="form-control" id="message" name="message" ></textarea>
                </div>
                <input type="hidden" name="to" value="{{ $ps->email }}">

                <button type="submit" class="cmn--btn bg--base submit-btn">
                    @lang('Send Message')
                </button>
                
            </div>
        </div>
        </form>
    @endif

   

    @if ($overlay->type=='poll'){
        <form class="contact-form row g-3 gx-xxl-4 contactform overcontact" id="contactform" action="{{route('overlay.poll')}}" method="POST">
        @csrf
        <div class="card"  style="position: relative;">
            <div class="card-body" style="position: fixed; z-index:99999; bottom: 10px; right:15px; min-width:300px ;background-color:aliceblue;  border-radius:10px; padding: 30px 20px">
                
                <div class="d-flex justify-content-between">
                    <h5 class="card-title " id="form-title">{{ $overlay_data->question }}</h5>
                   
                </div>
                    @foreach ($overlay_data->options as $key=>$data)
                    
                    <div class="form-check mt-2">
                        <input class="form-check-input" value="{{ $data }}" type="radio" name="answer" id="{{ $data }}">
                        <label class="form-check-label" for="{{ $data}}">
                          {{ $data }}
                        </label>
                    </div>
                    @endforeach
                    <input type="hidden" name="ipaddress" value="{{ request()->ip() }}">
                    <input type="hidden" name="link_id" value="{{ $link->id }}">
                    <input type="hidden" name="question" value="{{ $overlay_data->question }}">
                    <input type="hidden" name="poll_id" value="{{ $overlay->id }}">


                    <button type="submit" class="btn btn-info btn-sm mt-3">
                        @lang('Vote')
                    </button>

                   
                      
                
            </div>
        </div>    
    </form>
    }
        
    @endif




    @if ($overlay->type=='message')

    <div class="card mt-3" id="fine_tag" class="bg-primary" style="position: relative;">
        <div class="card-body bg-primary text-light" style="position: fixed; z-index:99999; bottom: 10px; right:15px; min-width:300px ;background-color:aliceblue; overflow:hidden;  border-radius:10px; padding: 30px 20px">
            
            <div class="tag-label" id="tag_label">Promo</div>

            <div class="form-group mt-2 d-flex ">
                <div class="image-review mb-1  mr-2" >
                <img class="h-100 img-fluid ml-4  " src="{{ $overlay_data->image ? asset('assets/images/'.$overlay_data->image) : asset('assets/images/placeholder.jpg') }}" alt="" id="show">
                </div>
                <div class="content">
                    <p class="mt-1" id="form-title">@lang('Your Question Here? ')</p>
                    <a class="btn btn-sm mt-1 bg-light mes" href="{{ $overlay_data->link }}">Learn More</a>
                </div>
                
            </div>
        </div>
    </div>

    @endif
    
    
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
    
      

    @stack('js')

<script>
       $(document).ready(function(){
        $('#form').hide();
        $('#cross').click(function(){
            $('#form').hide();
        })
        $('#label_text').click(function(){
            $('#form').show();
        })

        $('.mes').on('click',function(){
            $('#fine_tag').hide();
            window.location= '{{ $link->url }}';
        })

        
    })

    var link = '{{ $link->url }}'

</script>
 
    
    
    </body>
    
    </html>
    

