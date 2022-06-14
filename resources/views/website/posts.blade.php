@extends('website.template.master')

@section('content')

{{-- Posts --}}
<section class="older-posts section">
    <div class="container">
        <h2 class="title section-title" data-name="All Posts">All Posts</h2>
        <div class="older-posts-grid-wrapper d-grid">
            @foreach ($posts as $item)
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
                        </p>
                    </div>
                </a>
            @endforeach
        </div>

        <div class="blog-posts-pagination-container">
            {{$posts->links()}}
        </div>
    </div>
</section>

{{-- categories --}}

@include('website.component.popular-tags')

@endsection