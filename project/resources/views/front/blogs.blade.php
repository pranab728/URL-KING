@extends('layouts.front')

@push('css')

@endpush

@section('content')

<!-- Banner -->
<section class="hero-section inner-hero">
    <div class="container">
      <div class="inner-hero-text">
        <h2 class="title">@lang('Blogs')</h2>
        <ul class="breadcrumb">
          <li>
            <a href="index.html">@lang('Home')</a>
          </li>
          <li>
            @lang('Blogs')
          </li>
        </ul>
      </div>
    </div>
  </section>
  <!-- Banner -->
 

    <!-- Blog -->
    <section class="blog-section overflow-hidden pb-100 pt-100">
        <div class="container">
            <div class="row g-4 g-lg-3 g-xl-4 justify-content-center">

                @foreach($blogs as $blog)
                <div class="col-lg-4 col-md-6 col-sm-10">
                    <div class="blog__item">
                        <a href="{{ route('front.blog.single',$blog->slug) }}" class="blog-link">&nbsp;</a>
                        <div class="blog__item-img">
                            <img src="{{ asset('assets/images/'.$blog->photo) }}" alt="blog">
                            <span class="date">
                                <span> {{ $blog->created_at->format('F') }} </span>
                                <span>{{ $blog->created_at->format('d') }}</span>
                            </span>
                        </div>
                        <div class="blog__item-cont">
                            <h5 class="blog__item-cont-title line--2">
                                {{$blog->title}}
                            </h5>
                            <p class="line--3">
                                {!! Str::words($blog->details, 20, ' ...') !!}
                            </p>
                            <div class="blog__author">
                                <div class="author">
                                    <img src="{{  asset('assets/images/'.$blog->photo) }}" alt="blog">
                                    <h6>@lang('By Admin')</h6>
                                </div>
                                <a href=""><span class="read--more">@lang('Read More')</span></a>
                                
                            </div>
                        </div>
                    </div>
                </div>
               @endforeach
            </div>
        </div>
    </section>
    <!-- Blog -->

@endsection
@push('js')

@endpush
