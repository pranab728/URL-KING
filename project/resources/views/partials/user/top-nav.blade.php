<div class="navbar-top">
    <div class="container-fluid">
        <ul class="d-flex align-items-center justify-content-between py-1 py-md-0">
            <li>
                <div class="nav-toggle me-3">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </li>
            <li class="me-3">
                <div class="change-language">
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
            </li>
            <li class="ms-auto position-relative">
                <a href="javascript:void(0)" class="dashboard-header-profile">
                    <img src="{{ $user->photo ? asset('assets/images/user/'.$user->photo) : asset('assets/images/placeholder.jpg') }}" alt="clients">
                    <div class="name d-none d-sm-block">
                        {{ $user->name }}
                    </div>
                </a>
                <div class="user-toggle-menu">
                    <ul>
                        <li>
                            <a href="{{ route('user.profile') }}">
                                <i class="fas fa-user"></i>
                                @lang('Profile Settings')
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('user.reset') }}">
                                <i class="fas fa-unlock"></i>
                                @lang('Change Password')
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('user.show2faForm') }}">
                                <i class="fas fa-user-check"></i>
                                @lang('2FA Verification')
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('user.logout') }}">
                                <i class="fas fa-sign-out-alt"></i>
                                @lang('Logout')
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>
