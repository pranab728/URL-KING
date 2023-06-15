<div class="ctas-section">
    <div class="container">
        <div class="ctas-wrapper">
            <div class="ctas-inner">
                <div class="section-title mb-0 text-center">
                    <h2 class="title">@lang('Link Management Platform')</h2>
                    <div class="btn__grp">
                        <a href="{{ route('user.loginform') }}" class="cmn--btn">@lang('Sign Up')</a>
                        @if (Auth::user())
                        <a href="{{ route('user.package') }}" class="cmn--btn btn-outline">@lang('Pricing')</a>
                        @else
                        <a href="{{ route('user.loginform') }}" class="cmn--btn btn-outline">@lang('Pricing')</a>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
