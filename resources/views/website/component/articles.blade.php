<section class="featured-articles section-header-offset">
    <div class="featured-articles-container container d-grid">
        <div class="featured-content d-grid">
            <div class="headline-banner">
                <h3 class="headline fancy-border">
                    <span class="place-item-center">Breaking News</span>
                </h3>
                @if ($posts->count() > 0)
                    <span class="headline-description">{{$posts->first()->title}}</span>
                @endif
            </div>
            @if ($posts->count() > 0)
                
                @foreach ($posts as $item)
                    <a href="{{route('post.details', $item->slug)}}" class="article featured-article featured-article-{{$loop->iteration}}">
                        <img src="{{asset('./storage/'.$item->thumbnail)}}" alt="#" class="article-image">
                        <span class="article-category">@if ($item->Categories->first())
                            {{ $item->Categories->first()->name}}
                            @endif</span>
                        <div class="article-data-container">
                            <div class="article-data-container-content">
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
                            </div>
                        </div>
                    </a>
                @endforeach
            @endif
        </div>

        {{-- sidebar --}}
        <div class="sidebar d-grid">
            <h3 class="title featured-content-title">Trending News</h3>
            @if ($posts->count() > 0)
                @foreach ($posts as $item)                    
                    <a href="{{route('post.details', $item->slug)}}" class="trending-news-box">
                        <div class="trending-news-image-box">
                            <span class="trending-number place-items-center">{{ $loop->iteration }}</span>
                            <img src="{{asset('./storage/'.$item->thumbnail)}}" alt="#" class="article-image">
                        </div>
                        <div class="trending-news-data">
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
                        </div>
                    </a>
                @endforeach                
            @endif
        </div>
    </div>
</section>