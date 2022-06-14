@extends('layouts.app')

@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-4 col-sm-6">
            <div class="dash-widget">
                <span class="dash-widget-bg1"><i class="fa fa-ship" aria-hidden="true"></i></span>
                <div class="dash-widget-info text-right">
                    <h3>{{$categoryCount ? $categoryCount : 0}}</h3>
                    <span class="widget-title1">Category <i class="fa fa-check" aria-hidden="true"></i></span>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class="dash-widget">
                <span class="dash-widget-bg2"><i class="fa fa-tasks "></i></span>
                <div class="dash-widget-info text-right">
                    <h3>{{$postsCount ? $postsCount : 0}}</h3>
                    <span class="widget-title2">Posts <i class="fa fa-check" aria-hidden="true"></i></span>
                </div>
            </div>
        </div>
        {{-- <div class="col-md-3 col-sm-6">
            <div class="dash-widget">
                <span class="dash-widget-bg4"><i class="fa fa-image" aria-hidden="true"></i></span>
                <div class="dash-widget-info text-right">
                    <h3>{{$galleryCount ? $galleryCount : 0}}</h3>
                    <span class="widget-title4">Gallery <i class="fa fa-check" aria-hidden="true"></i></span>
                </div>
            </div>
        </div> --}}
        @if (Auth::user()->email === 'admin@app.io')
            <div class="col-md-4 col-sm-6">
                <div class="dash-widget">
                    <span class="dash-widget-bg3"><i class="fa fa-users" aria-hidden="true"></i></span>
                    <div class="dash-widget-info text-right">
                        <h3>{{$userCount ? $userCount : 0}}</h3>
                        <span class="widget-title3">Users <i class="fa fa-check" aria-hidden="true"></i></span>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <div class="row">
        
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title d-inline-block">Managed Category</h4> <a href="{{ route('categories.index') }}" class="btn btn-primary float-right">View all</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="d-none">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Added By</th>
                                    <th class="text-right">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($category as $item)   
                                <tr>
                                    <td style="min-width: 200px;">
                                        <h2><a href="{{route('categories.edit', $item->id)}}">{{$item->name}}</a></h2>
                                    </td>                 
                                    <td>
                                        <h5 class="time-title p-0">Added By</h5>
                                        <p>{{$item->user->name}}</p>
                                    </td>
                                    <td>
                                        <h5 class="time-title p-0">Status</h5>
                                        <p>{{$item->is_published ? 'Published' : 'Not Published'}}</p>
                                    </td>
                                    <td class="text-right" style="min-width: 100px;">
                                        <a href="{{route('categories.edit', $item->id)}}" class="btn btn-outline-primary"> <i class="fa fa-pencil"></i> </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title d-inline-block">Posts Profile</h4> <a href="{{ route('posts.index') }}" class="btn btn-primary float-right">View all</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="d-none">
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Added By</th>
                                    <th class="text-right">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $item)   
                                <tr>
                                    <td style="min-width: 200px;">
                                        <h2><a href="{{route('posts.edit', $item->id)}}">{{ \Illuminate\Support\Str::words($item->title, 4, $end='...') }}</a></h2>
                                    </td>                 
                                    <td>
                                        <h5 class="time-title p-0">Added By</h5>
                                        <p>{{$item->user->name}}</p>
                                    </td>
                                    <td>
                                        <h5 class="time-title p-0">Status</h5>
                                        <p>{{$item->is_published ? 'Published' : 'Not Published'}}</p>
                                    </td>
                                    <td class="text-right" style="min-width: 100px;">
                                        <a href="{{route('posts.edit', $item->id)}}" class="btn btn-outline-primary"> <i class="fa fa-pencil"></i> </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title d-inline-block">Recent Gallery Posts</h4> <a href="{{ route('galleries.index') }}" class="btn btn-primary float-right">View all</a>
                </div>
                <div class="card-body p-2">
                    <div class="row">
                        @foreach ($galleries as $item)                        
                            <div class="col-md-3">
                                <!-- IMG START -->
                                <article class="card post p-2 blog-post">
                                    <div class="post-preview">
                                        <a href="{{route('galleries.edit', $item->id)}}"><img src="{{asset('./storage/'.$item->image_url)}}" alt="" class="img-fluid mx-auto d-block"></a>
                                    </div>
        
                                    <div class="post-header">
                                        <div class="post-content mt-2">
                                            <p class="text-muted">Added By - {{$item->user->name}} </p>
                                        </div>
                                         
                                    </div>
                                </article>
                                <!-- IMG END -->
                            </div>
                        @endforeach                        
                    </div>
                </div>
            </div>
        </div> --}}
         
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title d-inline-block">User Accounts</h4> <a href="{{ route('accounts') }}" class="btn btn-primary float-right">View all</a>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead class="d-none">
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Added On</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $item)  
                                        <tr>
                                            <td style="min-width: 150px;">
                                                <h2><a href="{{route('categories.edit', $item->id)}}">{{$item->name}}</a></h2>
                                            </td>                 
                                            <td>
                                                <h5 class="time-title p-0">Email</h5>
                                                <p>{{ $item->email}}</p>
                                            </td>
                                            <td>
                                                <h5 class="time-title p-0">Added By</h5>
                                                <p>{{ date('d, M, Y', strtotime($item->created_at))}}</p>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    </div> 
</div>
@endsection
