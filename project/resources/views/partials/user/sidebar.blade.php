<aside class="dashboard-sidebar">
    <div class="bg--gradient">&nbsp;</div>
    <div class="dashboard-sidebar-inner">
        <div class="user-sidebar-header">
            <a target="__blank" href="{{ route('front.index') }}">
                <img src="{{ $gs->logo ? asset('assets/images/'.$gs->logo) : asset('assets/images/placeholder.jpg') }}" alt="logo">
            </a>
            <div class="sidebar-close">
                <span class="close">&nbsp;</span>
            </div>
        </div>
        <div class="user-sidebar-body">
            <ul class="user-sidbar-link">

                <li>
                    <a href="{{ route('user.dashboard') }}">
                        <span class="icon"><i class="fas fa-home"></i></span>
                        @lang('Dashboard')
                    </a>
                </li>

                <li>
                    <span class="subtitle">@lang('Link Management')</span>
                </li>

                <li>
                    <a href="{{ route('all.short.link') }}">
                        <span class="icon"><i class="fas fa-link"></i></span>
                        @lang('All Shorted URL')
                    </a>
                </li>

                <li>
                    <a href="{{ route('all.expired.link') }}">
                        <span class="icon"><i class="fas fa-link"></i></span>
                        @lang('Expired URL')
                    </a>
                </li>
                <li>
                    <a href="{{ route('all.deactive.link') }}">
                        <span class="icon"><i class="fas fa-link"></i></span>
                        @lang('Deactivated URL')
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.custom-splash') }}">
                        <span class="icon"><i class="fas fa-link"></i></span>
                        @lang('Custom Splash')
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.overlay') }}">
                        <span class="icon"><i class="fas fa-link"></i></span>
                        @lang('CTA Overlay')
                    </a>
                </li>

               

                <li>
                    <a href="{{ route('user.custom-domain') }}">
                        <span class="icon"><i class="fas fa-link"></i></span>
                        @lang('Custom Domain')
                    </a>
                </li>

                <li>
                    <a href="{{ route('user.tracking-pixel') }}">
                        <span class="icon"><i class="fas fa-link"></i></span>
                        @lang('Tracking Pixel')
                    </a>
                </li>

                <li>
                    <a href="{{ route('user.qr-code') }}">
                        <span class="icon"><i class="fas fa-link"></i></span>
                        @lang('QR Code')
                    </a>
                </li>


                <li>
                    <span class="subtitle">@lang('Currency & Plan Information')</span>
                </li>

                <li>
                    <a href="{{ route('user.plan.log') }}">
                        <span class="icon"><i class="fas fa-dollar-sign"></i></span>
                        @lang('Plan Log')
                    </a>
                </li>


                
                <li>
                    <a href="{{ route('user.transaction') }}">
                        <span class="icon"><i class='fas fa-arrow-up'></i></span>
                        @lang('Transactions')
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.deposit') }}">
                        <span class="icon"><i class="fas fa-sync-alt"></i></span>
                        @lang('Deposit')
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.deposit.log') }}">
                        <span class="icon"><i class="fas fa-sync-alt"></i></span>
                       @lang(' Deposit History')
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.withdraw') }}">
                        <span class="icon"><i class="fas fa-file-invoice-dollar"></i></span>
                        @lang('Withdraw')
                    </a>
                </li>
                
                <li>
                    <span class="subtitle">@lang('Perosnal Information')</span>
                </li>
                <li>
                    <a href="{{ route('user.profile') }}">
                        <span class="icon"><i class="fas fa-user-circle"></i></span>
                        @lang('Profile')
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.message.index') }}">
                        <span class="icon"><i class="fas fa-question-circle"></i></span>
                        @lang('Support')
                    </a>
                </li>
                <li>
                    <span class="subtitle">@lang('Account Information')</span>
                </li>
                <li>
                    <a href="{{route('user.show2faForm')}}">
                        <span class="icon"><i class="fas fa-question-circle"></i></span>
                        @lang('Two Factor')
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.reset') }}">
                        <span class="icon"><i class="fas fa-question-circle"></i></span>
                        @lang('Change Password')
                    </a>
                </li>
               
                <li>
                    <a href="{{ route('user.logout') }}">
                        <span class="icon"><i class="fas fa-sync-alt"></i></span>
                        @lang('Logout')
                    </a>
                </li>
            </ul>
        </div>
    </div>
</aside>
