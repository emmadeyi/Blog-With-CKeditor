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
                    <h4 class="card-title d-inline-block">Update Category</h4> <a href="{{route('categories.index')}}" class="btn btn-primary float-right"> <i class="fa fa-list"></i> categories</a>
                </div>
            </div>
            <div class="card">
                
                <div class="card-body p-0">
                    <div class="col-md-12">
                        <div class="card-box">
                            <form method="POST" action="{{route('categories.update', $category->id)}}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <div class="post-preview">
                                        <a href="#"><img src="{{asset('./storage/'.$category->thumbnail)}}" alt="" style="max-height: 400px;" class="img-fluid mx-auto d-block"></a>
                                    </div>
                                </div>
                                <div class="form-group @if($errors->has('thumbnail')) has-error @endif">
                                    <label>Thumbnail</label>
                                    <input type="file" name="thumbnail" class="form-control" placeholder="Select file">
                                    @if($errors->has('thumbnail')) 
                                        <span class="help-block text-danger">{{$errors->first('thumbnail')}}</span>
                                    @endif
                                </div>
                                <div class="form-group @if($errors->has('name')) has-error @endif">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Item Name"  value="{{$category->name}}">
                                    @if($errors->has('name')) 
                                        <span class="help-block text-danger">{{$errors->first('name')}}</span>
                                    @endif
                                </div>
                                <div class="form-group @if($errors->has('description')) has-error @endif">
                                    <label>Description</label>
                                    <textarea name="description" id="description" cols="30" rows="10" class="form-control" style="resize: none;" placeholder="Description of item..."> {{$category->description}} </textarea>
                                    @if($errors->has('description')) 
                                        <span class="help-block text-danger">{{$errors->first('description')}}</span>
                                    @endif
                                </div>
                                <div class="form-group @if($errors->has('is_published')) has-error @endif">
                                    <label>Publish</label>
                                    <select class="select form-control" name="is_published">
                                        <option>Select</option>
                                        <option value="1" {{ $category->is_published ? 'selected' : null}}>Publish</option>
                                        <option value="0" {{ !$category->is_published ? 'selected' : null}}>Draft</option>
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