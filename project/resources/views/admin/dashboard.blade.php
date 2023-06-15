@extends('layouts.admin')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">{{ __('Dashboard') }}</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
    </ol>
  </div>
  @if(Session::has('cache'))

  <div class="alert alert-success validation">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
              aria-hidden="true">×</span></button>
      <h3 class="text-center">{{ Session::get("cache") }}</h3>
  </div>


@endif

  <div class="row mb-3">

    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-uppercase mb-1">{{ __('Active Users') }}</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">{{ \DB::table('users')->where('ban',0)->count() }}</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-user fa-2x text-success"></i>
            </div>
          </div>
        </div>
      </div>
    </div> 
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-uppercase mb-1">{{ __('Blocked Users') }}</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ \DB::table('users')->where('ban',1)->count() }}</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-user fa-2x text-danger"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
       <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-uppercase mb-1">{{ __('Total Users') }}</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ \DB::table('users')->count() }}</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-user-tie fa-2x text-primary"></i>
              </div>
            </div>
          </div>
        </div>
      </div> 
       <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-uppercase mb-1">{{ __('Total Links') }}</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ \DB::table('links')->where('status',0)->count() }}</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-file fa-2x text-success"></i>
              </div>
            </div>
          </div>
        </div>
      </div> 
       <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-uppercase mb-1">{{ __('Total Advertisement') }}</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ \DB::table('advertisements')->where('status',0)->count() }}</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-file fa-2x text-primary"></i>
              </div>
            </div>
          </div>
        </div>
      </div> 
       <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-uppercase mb-1">{{ __('Deactive Links') }}</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ \DB::table('links')->where('status',1)->count() }}</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-file fa-2x text-warning"></i>
              </div>
            </div>
          </div>
        </div>
      </div> 
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-uppercase mb-1">{{ __('Total Advertisement profit given') }}</div>
                <div class="h6 mb-0 mt-2 font-weight-bold text-gray-800"><i class='fas fa-dollar-sign'></i> {{ \DB::table('advertisements')->sum('expression')*$gs->ad_reward }}</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-money-check-alt fa-2x text-success"></i>
              </div>
            </div>
          </div>
        </div>
      </div> 
        <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-uppercase mb-1">{{ __('Pending Withdraw Request') }}</div>
                <div class="h6 mb-0 mt-2 font-weight-bold text-gray-800"> {{ \DB::table('withdraws')->where('status','pending')->count() }}</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-money-check-alt fa-2x text-success"></i>
              </div>
            </div>
          </div>
        </div>
      </div>  

    

       <div class="col-xl-12 col-md-12 mt-5 mb-5">
        <h5 class=" mb-3 text-gray-800">{{ __('Top visited link') }}</h5>
        <div class="card h-100">
          <div class="card-body">
              <table class="table  table-striped ">
                <thead class="thead-dark">
                    <tr>
                      <th >@lang('SL')</th>
                      <th >@lang('User Name')</th>
                      <th class="w-25">@lang('Email')</th>
                      <th >@lang('Link')</th>
                      <th >@lang('Visited')</th>

                    </tr>
                  </thead>
                  <tbody>

                      @foreach (DB::table('links')->orderBy('click','DESC')->get() as $link)
                      @php
                          $user=DB::table('users')->where('id',$link->user_id)->first()
                      @endphp

                      <tr>
                        <th>{{ $loop->iteration }}</th>
                        <td>{{  $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ url('/'.$link->alias) }}</td>
                        <td>{{ $link->click }}</td>
                      </tr>
                     
                      @endforeach
                  </tbody>
              </table>
          </div>
        </div>
      </div> 




  </div>
  <!--Row-->

@endsection

@section('scripts')


@endsection

