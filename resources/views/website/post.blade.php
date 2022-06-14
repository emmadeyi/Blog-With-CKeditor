@extends('website.template.master')

@section('content')

@section('title', $post->title)

<?php $details = strip_tags($post->details); ?>
@section('share_meta')
    <meta property="og:url" content="{{Request::url()}}">
    <meta property="og:image" content="{{asset('./storage/'.$post->thumbnail)}}">
    <meta property="og:description" content="{{\Illuminate\Support\Str::limit($details, 100, $end='...')}}">
@endsection

{{-- Post Details --}}

<section class="blog-post section-header-offset">
    <div class="blog-post-container container">
        <div class="blog-post-data">
            <h3 class="title blog-post-title">
                {{$post->title}}
            </h3>
            <div class="article-data">
                <span>{{ date('d, M, Y', strtotime($post->created_at))}}</span>
                <span class="article-data-spacer"></span>
                <span>
                    @if ($post->Categories->first())
                    {{ $post->Categories->first()->name}}
                    @endif
                </span>
            </div>
            <img src="{{asset('./storage/'.$post->thumbnail)}}" alt="">
        </div>

        <div class="container">
            {!! $post->details !!}
            
            <div class="author d-grid">
                <div class="author-image-box">
                    <img src="{{asset('template/img/logo/logo.png')}}" alt="" class="article-image">
                </div>

                <div class="author-about">
                    <h3 class="author-name">{{$post->user->name}}</h3>
                    <ul class="list social-media">
                        <li class="list-item">
                            <a href="#" class="list0link">
                                <i class="ri-instagram-line"></i>
                            </a>
                            <a href="#" class="list0link">
                                <i class="ri-facebook-circle-line"></i>
                            </a>
                            <a href="#" class="list0link">
                                <i class="ri-twitter-line"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="fb-comments" data-href="{{Request::url()}}" data-width="" data-numposts="5" data-colorscheme="light"></div>
            <p>Related #Tags</p>
            @if ($post->Categories->first())
                @foreach ($post->Categories as $item)
                    <a href="{{route('category.details', $item->slug)}}">
                        <span>
                            {{$item->name}}
                        </span>
                    </a>
                @endforeach
            @endif

            

            
        </div>

    </div>
</section>

{{-- Quick Read --}}
@include('website.component.quick-read')

@endsection