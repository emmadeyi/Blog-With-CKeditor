@if ($categories->count() > 0)   
    @foreach ($categories as $category) 
        @if ($category->posts->count() > 0)            
            <section class="older-posts section">
                <div class="container">
                    <h2 class="title section-title" data-name="{{ $category->name }}">{{ $category->name }}</h2>
                    <div class="older-posts-grid-wrapper d-grid">
                        @foreach ($category->posts->take(6) as $item)
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
                    @if ($category->posts->count() > 6)
                        <div class="see-more-container">
                            <a href="{{route('category.details', $category->slug)}}" class="btn see-more-btn place-items-center">
                                See more... 
                            </a>            
                        </div>
                    @endif
                </div>
            </section>                
        @endif               
    @endforeach         
@endif