@extends('layouts.app')

@section('content')
<div class="content">  
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-12">
            @if (session('error-message'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> {{session('error-message')}}.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>                
            @endif
        </div>   
        <div class="col-lg-8 col-md-12">
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
                    <h4 class="card-title d-inline-block">User Accounts</h4> <a href="{{route('accounts.create')}}" class="btn btn-primary float-right"> <i class="fa fa-plus"></i> Add User</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead >
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Added On</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $item)   
                                @if (Auth::user()->email === 'admin@blog.io') 
                                    <tr>
                                        <td style="min-width: 200px;">
                                            <h2>{{$loop->iteration}}</h2>
                                        </td>                 
                                        <td style="min-width: 200px;">
                                            {{-- <h5 class="time-title p-0">Name</h5> --}}
                                            <h2><a href="{{route('accounts.edit', $item->id)}}">{{$item->name}}</a></h2>
                                        </td>                 
                                        <td>
                                            {{-- <h5 class="time-title p-0">Email</h5> --}}
                                            <p>{{ $item->email}}</p>
                                        </td>
                                        <td>
                                            {{-- <h5 class="time-title p-0">Added By</h5> --}}
                                            <p>{{ date('d, M, Y', strtotime($item->created_at))}}</p>
                                        </td>
                                        <td class="text-right" style="min-width: 100px;">
                                            <a href="{{route('accounts.edit', $item->id)}}" class="btn btn-outline-primary"> <i class="fa fa-pencil"></i> </a>
                                            @if ($item->email !== 'admin@blog.io' && $item->email !=='admin@wadoreporters.org.ng')
                                            <form action="{{ route('accounts.destroy', $item->id) }}" method="post" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger"><i class="fa fa-trash"></i> </button>  
                                            </form>
                                            @endif
                                        </td>
                                    </tr>
                                @else
                                    @if (Auth::user()->email !== 'admin@blog.io' && $item->email !== 'admin@blog.io') 
                                        <tr>
                                            <td style="min-width: 200px;">
                                                <h2>{{$loop->iteration}}</h2>
                                            </td>                 
                                            <td style="min-width: 200px;">
                                                {{-- <h5 class="time-title p-0">Name</h5> --}}
                                                <h2><a href="{{route('accounts.edit', $item->id)}}">{{$item->name}}</a></h2>
                                            </td>                 
                                            <td>
                                                {{-- <h5 class="time-title p-0">Email</h5> --}}
                                                <p>{{ $item->email}}</p>
                                            </td>
                                            <td>
                                                {{-- <h5 class="time-title p-0">Added By</h5> --}}
                                                <p>{{ date('d, M, Y', strtotime($item->created_at))}}</p>
                                            </td>
                                            <td class="text-right" style="min-width: 100px;">
                                                <a href="{{route('accounts.edit', $item->id)}}" class="btn btn-outline-primary"> <i class="fa fa-pencil"></i> </a>
                                                <form action="{{ route('accounts.destroy', $item->id) }}" method="post" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger"><i class="fa fa-trash"></i> </button>  
                                                </form>
                                            </td>
                                        </tr>
                                    @endif
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                        <div class="row mt-4 justify-content-center">
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</div>
@endsection
