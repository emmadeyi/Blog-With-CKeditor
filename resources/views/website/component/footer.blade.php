<div class="footer section" id="contact">
    <div class="footer-container container d-grid">
        <div class="company-data">
            <a  href="{{route('index')}}">
                <h2 class="logo">
                    <img src="{{asset('template/img/logo/logo.png')}}" alt="{{ env('APP_NAME') }}" class="logo">
                </h2>
            </a>

            <p class="company-description">
                Wado City Reporters is an online news breaking platform published by Jay Jay De Bells Limited, a Communication outfit based in the oil city of Warri. WCR is primed to be a leading voice in the Niger Delta struggle for a better deal from the Nigeria nation.  Therefore we are concerned with politics, community affairs, religion, business, technology, arts and culture, entertainment, marketing, economy and other sectors of the society.
                
                <p>
                    Contact Details
                    <p><strong>GSM numbers: </strong> 07068259162
                    09057641912
                    08024099767</p>
                    Email address: 
                    
                    <p>Office Address: Suite 2, Favour Plaza, Udu road along DSC Express Way, Ovwian, Delta State.</p>
                </p>
                    
            </p>

            <ul class="list social-media">
                <li class="list-item">
                    <a href="#" class="list-link">
                        <i class="ri-instagram-line"></i>
                    </a>
                    <a href="#" class="list-link">
                        <i class="ri-facebook-circle-line"></i>
                    </a>
                    <a href="#" class="list-link">
                        <i class="ri-twitter-line"></i>
                    </a>
                    <a href="#" target="blank" class="list-link">
                        <i class="ri-youtube-line"></i>
                    </a>
                </li>
            </ul>

            <span class="copyright-notice">
                &copy; {{ now()->year }} Blog With CKEditor. All rights reserved.
            </span>
        </div>

        <div>
            @if ($categories->count() > 0)                
                <h6 class="title footer-title">Tags</h6>
                <ul class="list footer-list">
                    @foreach ($categories as $item)
                        <li class="list-item">
                            <a href="{{route('category.details', $item->slug)}}" class="list-link">#{{$item->name}}</a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>