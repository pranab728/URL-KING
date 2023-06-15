<div class="container">
    <div class="header-wrapper">
        <div class="logo">
            <a href="{{ route('front.index') }}">
                <img src="{{$gs->logo ? asset('assets/images/'.$gs->logo): asset('assets/front/images/logo/logo.png') }}" alt="logo">
            </a>
        </div>
        <div class="nav-toggle ms-auto me-md-5 d-lg-none">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <div class="nav-menu">
            <div class="inner-div">
                <div class="sub-nav-item">
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
                            <a href="{{ route('front.contact') }}">@lang('Contact Us')</a>
                        </li>
                        @foreach ($pages as $page)
                        <li>
                            <a href="{{ route('front.page',$page->slug) }}">{{ $page->title }}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="header-buttons">

            <a href="{{ route('user.package') }}" class="cmn--btn d-none d-sm-block {{ request()->path() == 'subscriptions/plan' ? 'btn-outline':''}}">@lang('Pricing')</a>

            @if (Auth::user())
            <a href="{{ route('user.dashboard') }}" class="cmn--btn {{ request()->path() == 'user/dashboard' ? 'btn-outline':''}}">@lang('Dashboard')</a>

            @else
            <a href="{{ route('user.loginform') }}" class="cmn--btn {{ request()->path() == 'user/login' ? 'btn-outline':''}}">@lang('Sign In')</a>
            <a href="{{ route('user.registerform') }}" class="cmn--btn {{ request()->path() == 'user/registerform' ? 'btn-outline':''}}">@lang('Sign Up')</a>
            @endif
            <select class="language selectors nice language" name="language">
                @foreach (DB::table('languages')->get() as $language)
                <option value="{{route('front.language',$language->id)}}" {{ Session::has('language') ? ( Session::get('language') == $language->id ? 'selected' : '' ) : (DB::table('languages')->where('is_default','=',1)->first()->id == $language->id ? 'selected' : '') }}>
                    {{$language->language}}
                    </option>
                @endforeach
                
               
            </select>

            
               
                <select name="currency" class="currency selectors nice language">
                @foreach(DB::table('currencies')->get() as $currency)
                <option value="{{route('front.currency',$currency->id)}}" {{ Session::has('currency') ? ( Session::get('currency') == $currency->id ? 'selected' : '' ) : (DB::table('currencies')->where('is_default','=',1)->first()->id == $currency->id ? 'selected' : '') }}>
                {{$currency->name}}
                </option>
                @endforeach
                </select>
             
        </div>
    </div>
</div>
