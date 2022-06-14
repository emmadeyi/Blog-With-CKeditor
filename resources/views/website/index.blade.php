@extends('website.template.master')

@section('content')

{{-- Featured Articles --}}
@include('website.component.articles')

{{-- Quick Reads --}}
{{-- @include('website.component.quick-read') --}}

{{-- Older Post --}} 

@include('website.component.older-post')

{{-- Popular tags --}}

@include('website.component.popular-tags')

{{-- Newsletter --}}

{{-- @include('website.component.newsletter') --}}

@endsection