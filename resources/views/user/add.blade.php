@extends('layouts.app') @section('content')
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <h3>User Create Form</h3>
                        <form method="POST" action="{{ url('user/add') }}" autocomplete="off">
                            @csrf
                            <div class="form-group row">
                                <span for="name" class="col-md-4 text-md-right">Name <star class="star">*</star></span>
    
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="Name" autofocus >
                                     @if ($errors->has('name'))
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span> @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <span for="email" class="col-md-4 col-form-label text-md-right">Email <star class="star">*</star></span>
    
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email"> @if ($errors->has('email'))
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span> @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                    <span for="role" class="col-md-4 col-form-label text-md-right">Role <star class="star">*</star> </span>
                                       <div class="col-md-6">
                                            <select name="role" class="form-control" data-title="Single Select" data-style="btn-default btn-outline" data-menu-style="dropdown-blue">
                                                @foreach ($role as $item)
                                                    <option value="{{ $item->id}}"> {{ $item->display_name}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('role'))
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $errors->first('role') }}</strong>
                                                </span>
                                            @endif
                                       </div>
                                    </div>                                   
                            <div class="form-group row">
                                <span for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }} <star class="star">*</star></span>
    
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password"> @if ($errors->has('password'))
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span> @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <span for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password <star class="star">*</star></span>
    
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Password Confirmation">
                                </div>
                            </div>
                            <br>
                            <div class="form-group row mb-0">
                                <div class="col-md-12">
                                    <a href="{{url('user')}}" ><input type="button" class="btn btn-danger pull-right" value="Cancel"></a>
                                <button type="submit" class="btn btn-primary pull-right">
                                        Save
                                </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>               
            </div>
        </div>
    </div> 
</div>
@endsection