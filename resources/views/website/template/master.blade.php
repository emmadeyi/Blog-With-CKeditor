<!DOCTYPE html>
<html lang="en">
<!-- business-4.html 42:40-->
@include('website.template.header')
    <body>
        <div id="fb-root"></div>
        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v13.0&appId=692732915416152&autoLogAppEvents=1" nonce="EdCx4aF7"></script>
        {{-- Header --}}
        <header class="header" id="header">
            @include('website.component.navbar')
        </header>

        {{-- Search --}}
        @include('website.component.search')

        {{-- Yield pages contents --}}
        @yield('content')   

        {{-- Footer --}} 

        @include('website.component.footer')

        @include('website.template.scripts')
    </body>

</html>