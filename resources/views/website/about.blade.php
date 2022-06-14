@extends('website.template.master')

@section('content')
<!-- HOME START-->
<section class="bg-half" style="background-image: url({{asset('template/img/dredging/01.jpg')}});  
background-position: center; background-size:cover;">
    <div class="bg-overlay"></div>
    <div class="home-center">
        <div class="home-desc-center">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="page-next-level text-white">
                            <h4 class="text-uppercase">About Us</h4>
                            <div class="page-next"> <a href="{{route('index')}}">Home</a> <i class="mdi mdi-chevron-right"></i> &nbsp;<span class=" text-white">About Us</span> </div>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
    </div>
</section>
<!-- HOME END--> 

<!-- ABOUT US START -->
<section class="section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7 col-md-6">
                <div class="about-section text-right mr-lg-3">
                    <h4 class="text-uppercase">Uyoyo Maritime Energy Limited</h4>
                    <div class="spacer-15"></div>
                    <p class="text-muted">An offshore contracting company. It was founded to provide the offshore services to the oil and gas industry with competent, cost-efficient services, skilled personnel and state of the art equipment.</p>
                    <p class="text-muted">UYOYO MARITIME ENERGY LIMITED is engaged in three core activities in which it has a strong position. Uyoyo Maritime Energy Limited are happy to introduce to you our marine services and encourage you to partner with us, we deal with various selections of marine services including Ship Management, Ship Brokering, Ship Crewing, Spare Part Supply, Chandelling and Inward/Outward Clearance, among others. Uyoyo Maritime Energy Limited has behind it a cumulative years of experience has vast experience in all our services that we provide. The company strives to satisfy requests of ship owners, charterers, and employers in a fast and high-quantity manner</p>
                </div>
            </div>

            <div class="col-lg-5 col-md-6">
                <div class="about-pic mt-sm-30">
                    <img src="{{asset('template/img/home/bg/04.jpg')}}" class="img-fluid" alt="">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ABOUT US END -->

<!-- FEATURE-TWO START -->
<section class="section bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="feature-two p-20 text-center">
                    <div class="feat-icon">
                        <i class="fas fa-hands"></i>
                    </div>

                    <div class="feat-head">
                        <h4>Our Vision</h4>
                        <p class="text-muted mb-0">Is to be a major player in the Marine sector within Nigeria and West Africa sub-region while maintaining the highest achievable level of Quality and Safety in compliance with all applicable international codes and standards and other regulatory requirements</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="feature-two p-20 text-center">
                    <div class="feat-icon">
                        <i class="fab fa-sketch"></i>
                    </div>

                    <div class="feat-head">
                        <h4>Our Mission</h4>
                        <p class="text-muted mb-0">Is to effectively transfer technology and Empower Nigerians by liaisons and relationship with technically competent oversea partners in the Maritime, Oil and Gas sector, while ensuring that the acquisition of knowledge is achieved and transferred with high level of competency for the ever-growing Marine industry.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-two p-20 text-center">
                    <div class="feat-icon">
                        <i class="fa fa-clipboard-list"></i>
                    </div>

                    <div class="feat-head">
                        <h4>Our Strategy</h4>
                        <p class="text-muted mb-0"> Is to continuously improve on the quality and efficiency of our service delivery &nbspby leveraging on our competitive advantages and adherence to industry best standards.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- FEATURE-TWO END -->

<!-- COUNTER START -->
<section class="section bg-counter">
    <div class="bg-overlay"></div>
    <div class="container">
        <div class="row" id="counter">            
        </div>
    </div>
</section>
<!-- COUNTER END -->

<!-- FAQ & CHART START -->
<section class="section bg-light">
    <div class="container">
        <div class="row">
            <p class="text-muted text-center"> <span class="text-uppercase">Uyoyo Maritime Energy Limited</span> recognizes quality, Health and Safety as most essential and is therefore committed strict adherence to applicable codes, specifications and standards as specified in the contract and in line with company’s general QHSE policy
            </p>
            <div class="col-md-6">
                <div class="faq-chart-section">
                    <h4>HSE Policy Statement</h4>
                    <div class="spacer-15"></div>
                    <p class="text-muted">It is the policy of Uyoyo Maritime Energy to carry out all activities in such a way that the Health and Safety of personnels and facilities that may be affected by our operations are safeguarded</p>                   
                </div>
            </div>

            <div class="col-md-6">
                <div class="faq-chart-section">
                    <h4>Quality Policy Statement</h4>
                    <div class="spacer-15"></div>
                    <p class="text-muted">It is the policy of Uyoyo Maritime Energy to execute its entire Operations at all times to meet all relevant Legal requirements/agreed client requirements at a cost effective manner</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- FAQ & CHART END -->
@include('website.clients_logo')
@endsection