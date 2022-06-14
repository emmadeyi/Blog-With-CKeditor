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
        </div>    
    </div>   
    <div class="row justify-content-center">        
        <div class="col-lg-8 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title d-inline-block">New User</h4> <a href="{{route('accounts')}}" class="btn btn-primary float-right"> <i class="fa fa-list"></i> User Accounts</a>
                </div>
            </div>
            <div class="card col-12">
                
                <div class="card-body p-0">
                    <div class="col-md-12">
                        <div class="card-box">
                            <form method="POST" action="{{route('accounts.store')}}">
                                @csrf
                                <div class="form-group @if($errors->has('name')) has-error @endif">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="First and Last Names" value="{{ old('name') }}" autofocus required>
                                    @if($errors->has('name')) 
                                        <span class="help-block text-danger">{{$errors->first('name')}}</span>
                                    @endif
                                </div>
                                <div class="form-group @if($errors->has('email')) has-error @endif">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="Email Address" required value="{{ old('email') }}">
                                    @if($errors->has('email')) 
                                        <span class="help-block text-danger">{{$errors->first('email')}}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password_confirmation" class="form-control" required placeholder="Confirm Password">
                                </div>
                                
                                <div class="text-right">
                                    <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Submit</button>                                    
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
