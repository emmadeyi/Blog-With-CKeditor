@if ($posts->count() > 0)    
    <section class="quick-read section">
        <div class="container">
            <h2 class="title section-title" data-name="Quick read">
                Quick Read
            </h2>

            <div class="swiper">
                <div class="swiper-wrapper">
                    @foreach ($posts as $item)
                        <a href="{{route('post.details', $item->slug)}}" class="article swiper-slide">
                            <img src="{{asset('./storage/'.$item->thumbnail)}}" alt="#" class="article-image">

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
                            </div>
                        </a>
                    @endforeach
                </div>
                <div class="swiper-button-prev swiper-controls"></div>
                <div class="swiper-button-next swiper-controls"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>
@endif