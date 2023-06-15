@extends('layouts.front')

@push('css')

@endpush

@section('content')


<!-- Banner -->
<section class="hero-section inner-hero">
    <div class="container">
      <div class="inner-hero-text">
        <h2 class="title">@lang('Blog')</h2>
        <ul class="breadcrumb">
          <li>
            <a href="index.html">@lang('Home')</a>
          </li>
          <li>
            @lang('Single Blog')
          </li>
        </ul>
      </div>
    </div>
  </section>
  <!-- Banner -->
 

  <!-- Blog -->
<section class="blog-section overflow-hidden pb-100 pt-100">
    <div class="container">
        <div class="row gy-5">
            <div class="col-lg-8">
                <div class="blog__item blog__item-details">
                    <div class="blog__item-img">
                        <img src="{{ asset('assets/images/'.$blog->photo) }}" alt="blog"><span class="date">
                            <span> {{ $blog->created_at->format('F') }} </span>
                            <span>{{ $blog->created_at->format('d') }}</span>
                        </span>
                    </div>
                    <div class="blog__item-cont">
                        <div class="blog__author mb-4 mt-3">
                            <div class="author w-auto">
                                <img src="{{ asset('assets/images/'.$blog->photo) }}" alt="blog">
                                <h6>@lang('By Admin')</h6>
                            </div>
                            <a href="#0" class="text--base">{{ $blog->views }} @lang('Views')</a>
                        </div>
                        <div class="blog__details">
                            <h5 class="subtitle">
                               {{$blog->title}}
                            </h5>
                            <p>
                                {!! $blog->details!!}
                            </p>
                            <div class="d-flex align-items-center flex-wrap">
                                <h6 class="m-0 me-2 align-items-center">@lang('Share Now')</h6>
                                <ul class="social-icons social-icons-dark">
                                    <li>
                                        <a class="a2a_dd plus" href="https://www.addtoany.com/share">
                                            <i class="fas fa-plus"></i>
                                            </a>
                                    </li>
                                     <script async src="https://static.addtoany.com/menu/page.js"></script>
                                    {{-- DISQUS START --}}
                                        @if($gs->is_disqus == 1)
                                        <div class="comments">
                                            <div id="disqus_thread">
                                                <script>
                                                    (function() {
                                                    var d = document, s = d.createElement('script');
                                                    s.src = 'https://{{ $gs->disqus }}.disqus.com/embed.js';
                                                    s.setAttribute('data-timestamp', +new Date());
                                                    (d.head || d.body).appendChild(s);
                                                    })();
                                                </script>
                                                <noscript>{{ __('Please enable JavaScript to view the') }} <a href="https://disqus.com/?ref_noscript">{{ __('comments powered by Disqus.') }}</a></noscript>
                                            </div>
                                        </div>
                                        @endif
                                    {{-- DISQUS ENDS --}}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <aside class="blog-sidebar ps-xxl-5">
                    <div class="widget bg--section">
                        <div class="widget-header text-center">
                            <h5 class="m-0 text-white">@lang('Latest Blog Posts')</h5>
                        </div>
                        <div class="widget-body">
                            <ul class="latest-posts">

                                 @foreach ($latest_blog as $lblog)

                                 <li>
                                    <a href="{{ route('front.blog.single',$blog->slug) }}">
                                        <div class="img">
                                            <img src="{{ asset('assets/images/'.$lblog->photo) }}" alt="blog">
                                        </div>
                                        <div class="cont">
                                            <h5 class="subtitle">{{$lblog->title}}</h5>
                                            <span class="date">{{ $lblog->created_at->format('Y-m-d') }}</span>
                                        </div>
                                    </a>
                                </li>
                                     
                                 @endforeach
                                
                             
                            </ul>
                        </div>
                    </div>
                    <div class="widget bg--section">
                        <div class="widget-header text-center">
                            <h5 class="m-0 text-white">@lang('Category')</h5>
                        </div>
                        <div class="widget-body">
                            <ul class="archive-links">

                                @foreach ($blog_category as $cat)

                                <li>
                                    <a href="{{ route('front.blogcategory',$cat->slug) }}">
                                        <span>{{ $cat->name }}</span>
                                        <span>({{ DB::table('blogs')->where('category_id',$cat->id)->count() }})</span>
                                    </a>
                                </li>
                                    
                                @endforeach
                                
                                
                            </ul>
                        </div>
                    </div>
                    
                    <div class="widget bg--section">
                        <div class="widget-header text-center">
                            <h5 class="m-0 text-white">@lang('Tags')</h5>
                        </div>
                        <div class="widget-body">
                            <ul class="widget-tags">
                                @foreach ($tags as $tag)
                                <li>
                                    <a href="{{ route('front.blogtags',$tag) }}">
                                       {{ $tag}}
                                    </a>
                                </li>
                                @endforeach
                                
                                
                            </ul>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</section>
<!-- Blog -->
@endsection
@push('js')

@endpush
