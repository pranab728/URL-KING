
    <span class="line-1"></span>
    <span class="line-2"></span>
    <div class="footer-top">
        <div class="container">
            <div class="footer-wrapper">
                <div class="footer-logo">
                    <a href="{{ route('front.index') }}">
                        <img src="{{$gs->footer_logo ? asset('assets/images/'.$gs->footer_logo): asset('assets/front/images/logo/logo.png') }}" alt="logo">
                    </a>
                </div>
                <div class="footer-links">
                    <h5 class="title">@lang('All Pages')</h5>
                    <ul>
                        <li>
                            <a href="{{ route('front.index') }}">@lang('Home')</a>
                        </li>
                        <li>
                            <a href="{{ route('front.blog') }}">@lang('Blogs')</a>
                        </li>
                        <li>
                            <a href="{{ route('front.faq') }}">@lang('FAQ')</a>
                        </li>
                        <li>
                            <a href="{{ route('front.contact') }}">@lang('Contact US')</a>
                        </li>
                        @foreach ($pages as $page)
                        <li>
                            <a href="{{ route('front.page',$page->slug) }}">{{ $page->title }}</a>
                        </li>
                        @endforeach
                       
                    </ul>
                </div>
                <div class="footer-links mobile-second-item">
                    <h5 class="title">@lang('Contact')</h5>
                    <ul>
                        <li>
                            <a href="#0"> {{ $ps->street }}</a>
                        </li>
                        <li>
                            <a href="Mailto:info@example.com">{{ $ps->email }}</a>
                        </li>
                        <li>
                            <a href="Tel:0123456789">{{ $ps->phone }}</a>
                        </li>
                    </ul>
                </div>
                <div class="my-4 social-linkss social-sharing a2a_kit a2a_kit_size_32 footer-comunity">
                    <h5 class="mb-2 title">{{ __('Share Now') }}</h5>
                    <ul class="social-icons py-1 share-product social-linkss py-md-0">
                        @if ($socialsetting->f_status==1)
                        <li>
                            <a class="facebook a2a_button_facebook" href="">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            </li>
                        @endif
                        @if ($socialsetting->t_status==1)
                        <li>
                            <a class="twitter a2a_button_twitter" href="">
                                <i class="fab fa-twitter"></i>
                            </a>
                            </li>
                            
                        @endif
                        @if ($socialsetting->l_status==1)
                        <li>
                            <a class="linkedin a2a_button_linkedin" href="">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            </li>
                        @endif

                        @if ($socialsetting->g_status==1)
                        <li>
                            <a class="google a2a_button_google" href="">
                                <i class="fab fa-google"></i>
                            </a>
                        </li>
                        @endif
                    </ul>

                </div>
                <script async src="https://static.addtoany.com/menu/page.js"></script>
                
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
             {!! $gs->copyright !!}
        </div>
    </div>
    @if(isset($visited))

@if($gs->is_cookie == 1)
<div class="cookie-bar-wrap show">
    <div class="container d-flex justify-content-center">
        <div class="col-xl-10 col-lg-12">
            <div class="row justify-content-center">
                @include('cookieConsent::index')
            </div>
        </div>
    </div>
</div>
@endif
@endif

