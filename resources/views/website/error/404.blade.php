@extends('website.template.master')

@section('content')
<!-- ERROR PAGE -->
<section class="section bg-home" style="background-image: url('{{asset('./template/images/home/404.jpg')}}');">
    <div class="bg-overlay"></div>
    <div class="home-center">
        <div class="home-desc-center">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center error-page">
                        <h4 class="text-white">Error 404: Resource Not Found</h4>
                        <h1 class="text-white">404!</h1>
                        <h4 class="text-white">Please Check Back Again Later</h4>
                        <p class="text-white mt-3">Use the navigation above or the button below to get back and track.</p>
                        <a href="{{route('index')}}" class="btn btn-custom mt-4">Go Back Home</a>
                    </div>
                </div>
            </div> <!-- end container -->
        </div>
    </div>
</section>
<!-- ERROR PAGE -->
@endsection