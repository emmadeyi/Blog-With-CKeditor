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
            @elseif (session('error-message'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> {{session('error-message')}}.
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
                    <h4 class="card-title d-inline-block">Managed Posts</h4> <a href="{{route('posts.create')}}" class="btn btn-primary float-right"> <i class="fa fa-plus"></i> Add to Post List</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="d-none">
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Added By</th>
                                    <th>Added On</th>
                                    <th class="text-right">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $item)   
                                <tr>
                                    <td style="min-width: 100px;">
                                        <h2><a href="{{route('posts.edit', $item->id)}}">{{ \Illuminate\Support\Str::words($item->title, 10, $end='...') }}</a></h2>
                                    </td>  
                                    <td>
                                        <h5 class="time-title p-0">Added By</h5>
                                        <p>{{$item->user->name}}</p>
                                    </td>
                                    <td>
                                        <h5 class="time-title p-0">Added On</h5>
                                        <p>{{ date('d, M, Y', strtotime($item->created_at))}}</p>
                                    </td>
                                    <td>
                                        <h5 class="time-title p-0">Status</h5>
                                        <p>{{$item->is_published ? 'Published' : 'Not Published'}}</p>
                                    </td>
                                    <td class="text-right" style="min-width: 150px;">
                                        <a href="{{route('posts.edit', $item->id)}}" class="btn btn-outline-primary"> <i class="fa fa-pencil"></i> </a>   
                                        @if (Auth::user()->email === 'admin@blog.io')        
                                        <form action="{{ route('posts.destroy', $item->id) }}" method="post" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger"><i class="fa fa-trash"></i> </button>  
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="row mt-4 justify-content-center">
                            {{ $posts->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</div>
@endsection
