@extends('layouts.admin')

@section('content')



    <div class="card">
        <div class="d-sm-flex align-items-center justify-content-between">
        <h5 class=" mb-0 text-gray-800 pl-3">{{ __('Edit List') }}</h5>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.link.edit',$link->id) }}">{{ __('Edit Links') }}</a></li>
        </ol>
        </div>
    </div>

    <form  action="{{ route('admin.link.update',$link->id) }}" method="POST" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-8">
            <div class="card mt-3 p-4">


                    @include('includes.admin.form-both')

                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="inp-name">{{ __('Long URL') }}</label>
                        <input type="text" class="form-control" name="url"  placeholder="{{ __('Enter URL') }}" value="{{ $link->url }}" required>
                    </div>

                    <div class="form-group">
                        <label for="meta_title">{{ __('Meta Title') }}</label>
                        <input type="text" class="form-control"  name="meta_title"  placeholder="{{ __('Enter Meta Title') }}" value="{{ $link->meta_title }}">
                    </div>

                    <div class="form-group">
                        <label for="inp-phone">{{ __('Meta Description') }}</label>
                        <textarea class="form-control summernote" name="meta_description" id="" placeholder="Enter Meta Description">{{ $link->meta_description }}</textarea>
                    </div>

                    <button type="submit"  class="btn btn-primary">{{ __('Submit') }}</button>

            </div>
        </div>
        <div class="col-md-4">
            <div class="card mt-3 p-4">

                <div class="form-group">
                    <label for="inp-name">{{ __('Alias') }}</label>
                    <input type="text" class="form-control" name="alias"  placeholder="{{ __('Enter Alias') }}" value="{{ $link->alias }}" required>
                </div>

                <div class="form-group">
                    <label for="inp-name">{{ __('Link Expiration') }}</label>
                    <input type="text" class="form-control" name="expire_day"  placeholder="{{ __('Enter Expire Day') }}" value="{{ $link->expire_day }}" required>
                </div>


            </div>
        </div>
    </div>
</form>






@endsection
@section('scripts')
<script type="text/javascript">

</script>

@endsection

