@extends('layouts.app')

@section('content')
<div class="content">  
    <div class="row">
        <div class="col">
            @if (session('success-message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> {{session('success-message')}}.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>                
            @endif
        </div>    
    </div>  
    <div class="row">        
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title d-inline-block">Gallery</h4> <a href="{{route('galleries.create')}}" class="btn btn-primary float-right"> <i class="fa fa-plus"></i> Add to Gallery</a>
                </div>
            </div>
            <div class="row">
                @foreach ($galleries as $item)                        
                    <div class="col-md-3">
                        <!-- IMG START -->
                        <article class="card post p-2 blog-post">
                            <div class="post-preview">
                                <a href="#"><img src="{{asset('./storage/'.$item->image_url)}}" alt="" class="img-fluid mx-auto d-block"></a>
                            </div>

                            <div class="post-header">
                                <div class="post-content mt-2">
                                    <p class="text-muted">Added By - {{$item->user->name}} on - {{ $item->created_at}} </p>
                                </div>
                                <a href="{{route('galleries.edit', $item->id)}}" class="btn btn-outline-primary"> <i class="fa fa-pencil"></i> </a>    
                                <form action="{{ route('galleries.destroy', $item->id) }}" method="post" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger"><i class="fa fa-trash"></i> </button>  
                                </form>
                            </div>
                        </article>
                        <!-- IMG END -->
                    </div>
                @endforeach                        
            </div>
        </div>
    </div> 
</div>
@endsection
