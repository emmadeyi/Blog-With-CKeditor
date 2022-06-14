@extends('website.template.master')

@section('content')
{{-- Posts --}}
<section class="older-posts section">
    <div class="container">
        <h2 class="title section-title" data-name="{{$category->name}}">{{$category->name}} </h2>
        @if ($category_posts->count() > 0)            
            <div class="older-posts-grid-wrapper d-grid">
                @foreach ($category_posts as $item)
                    <a href="{{route('post.details', $item->slug)}}" class="article d-grid">
                        <div class="older-posts-article-image-wrapper">
                            <img src="{{asset('./storage/'.$item->thumbnail)}}" alt="#" class="article-image">
                        </div>
                        
                        <div class="article-data-container">
                            <div class="article-data">
                                <span>{{ date('d, M, Y', strtotime($item->created_at))}}</span>
                                <span class="article-data-spacer"></span>
                                <span>
                                    @if ($item->Categories->first())
                                    {{ $item->Categories->first()->name}}
                                    @endif
                                    </span>
                            </div>
        
                            <h3 class="title article-title">
                                {{$item->title}}
                            </h3>
                            <p class="article-description">
                                <?php $details = strip_tags($item->details); ?>
                                {{ \Illuminate\Support\Str::limit($details, 100, $end='...') }}
                                {{-- {!! $item->details !!} --}}
                            </p>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="blog-posts-pagination-container">
                {{$category_posts->links()}}
            </div>
        @endif
    </div>
</section>

{{-- categories --}}
<div class="popular-tags section">

    <div class="container">
        <h2 class="title section-title" data-name="Popular Tags"> Popular Tags</h2>
        <div class="popular-tags-container d-grid">
            @foreach ($categories as $item)
                <a href="{{route('category.details', $item->slug)}}" class="article">
                    <span class="tag-name">#{{$item->name}}</span>
                    <img src="{{asset('./storage/'.$item->thumbnail)}}" alt="" class="article-image">
                </a>
            @endforeach            
        </div>
    </div>
</div>

@endsection