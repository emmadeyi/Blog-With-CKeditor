@extends('layouts.app')

@section('content')
<div class="content">   
    <div class="row">
        <div class="col">
            @if (session('error-message'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> {{session('error-message')}}.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>                
            @endif
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
    <div class="row justify-content-center">        
        <div class="col-lg-8 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title d-inline-block">Update Post Details</h4> <a href="{{route('posts.index')}}" class="btn btn-primary float-right"> <i class="fa fa-list"></i> post List</a>
                </div>
            </div>
            <div class="card">            
                <div class="card-body p-0">
                    <div class="col-md-12">
                        <div class="card-box">
                            <form method="POST" action="{{route('posts.update', $post->id)}}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <div class="post-preview">
                                        <a href="#"><img src="{{asset('./storage/'.$post->thumbnail)}}" alt="" style="max-height: 400px;" class="img-fluid mx-auto d-block"></a>
                                    </div>
                                </div>
                                <div class="form-group @if($errors->has('thumbnail')) has-error @endif">
                                    <label>Thumbnail</label>
                                    <input type="file" name="thumbnail" class="form-control" placeholder="Select file">
                                    @if($errors->has('thumbnail')) 
                                        <span class="help-block text-danger">{{$errors->first('thumbnail')}}</span>
                                    @endif
                                </div>
                                <div class="form-group @if($errors->has('title')) has-error @endif">
                                    <label>Title</label>
                                    <input type="text" name="title" class="form-control" placeholder="post Title" value="{{$post->title}}">
                                    @if($errors->has('title')) 
                                        <span class="help-block text-danger">{{$errors->first('title')}}</span>
                                    @endif
                                </div>
                                <div class="form-group @if($errors->has('sub_title')) has-error @endif">
                                    <label>Sub Title</label>
                                    <input type="text" name="sub_title" class="form-control" placeholder="post Sub Title" value="{{$post->sub_title}}">
                                    @if($errors->has('sub_title')) 
                                        <span class="help-block text-danger">{{$errors->first('sub_title')}}</span>
                                    @endif
                                </div>
                                <div class="form-group @if($errors->has('details')) has-error @endif">
                                    <label>Details</label>
                                    <textarea name="details" id="details" cols="30" rows="10" class="form-control" style="resize: none;" placeholder="post Details...">{{str_replace( '&', '&amp;', $post->details)}}</textarea>
                                    @if($errors->has('details')) 
                                        <span class="help-block text-danger">{{$errors->first('details')}}</span>
                                    @endif
                                </div>
                                <div class="form-group @if($errors->has('category_id')) has-error @endif">
                                    <label>category Item</label>
                                    <select class="select form-control" id="category_id" name="category_id[]" multiple>
                                        @foreach ($category as $id=>$name)
                                            <option value="{{$id}}">{{$name}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('category_id')) 
                                        <span class="help-block text-danger">{{$errors->first('category_id')}}</span>
                                    @endif
                                </div>
                                <div class="form-group @if($errors->has('is_published')) has-error @endif">
                                    <label>Publish</label>
                                    <select class="select form-control" name="is_published">
                                        <option value="1" {{ $post->is_published ? 'selected' : null}}>Publish</option>
                                        <option value="0" {{ !$post->is_published ? 'selected' : null}}>Draft</option>
                                    </select>
                                    @if($errors->has('is_published')) 
                                        <span class="help-block text-danger">{{$errors->first('is_published')}}</span>
                                    @endif
                                </div>
                                
                                <div class="text-right">
                                    <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Update</button>                                    
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</div>
@endsection
@section('script')
    <script defer>
        $(document).ready(function(){
            ClassicEditor
            .create( document.querySelector( '#details' ), {
            ckfinder: {
                uploadUrl: '{{route('ckeditor.upload').'?_token='.csrf_token()}}'
            }})
            .catch( error => {
                console.error( error );
            } );
            if($('.select').length > 0) {
                $('.select').select2({
                    minimumResultsForSearch: -1,
                    width: '100%'
                });
            }
            $('#category_id').select2({
                placeholder: " Select category Item"
            }).val({!! json_encode($post->categories()->allRelatedIds()) !!}).trigger('change')
        })
    </script>
@endsection