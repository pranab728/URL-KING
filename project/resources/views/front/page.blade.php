@extends('layouts.front')

@push('css')

@endpush

@section('content')


<!-- Banner -->
<section class="hero-section inner-hero">
    <div class="container">
      <div class="inner-hero-text">
        <h2 class="title">{{ $page->title }}</h2>
        <ul class="breadcrumb">
          <li>
            <a href="index.html">@lang('Home')</a>
          </li>
          <li>
           {{$page->title}}
          </li>
        </ul>
      </div>
    </div>
  </section>
  <!-- Banner -->
  <!-- Account -->
  <section class="account-section pt-100 pb-100">
      <div class="container">
          <div class="">

            {!! $page->details !!}
              
          </div>
      </div>
  </section>
  <!-- Account -->


@endsection
@push('js')

@endpush
