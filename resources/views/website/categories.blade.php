@extends('website.template.master')

@section('content')

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
        {{$categories->links()}}
    </div>
</div>

@endsection