@extends('layouts.login') 
@section('content')
<div class="container">
    <div class="col-lg-4 col-md-6 ml-auto mr-auto">
        <form method="POST" action="{{ route('login') }}" autocomplete="off">@csrf
            <div class="card card-login">
                <img src="{!! url('assets/img/text_logo.png') !!}" style="display: block;margin-left: auto;margin-right: auto;width: 80%;"/>
                <div class="card-body ">
                    <strong><label>Email or Username</label></strong>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                      <i class="nc-icon nc-email-85"></i>
                    </span>
                        </div>
                        <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} {{ session()->has('message') ? ' is-invalid' : '' }}"
                            name="email" value="{{ old('email') }}" placeholder="Email..."> @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('email') }}</strong>
                  </span> @endif @if(session()->has('message'))
                        <span class="invalid-feedback" role="alert">
                   <strong>{{ session()->get('message') }}</strong>
               </span> @endif
                    </div>
                    <strong><label>Password</label></strong>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                      <i class="nc-icon nc-key-25"></i>
                    </span>
                        </div>
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password...">                        @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('password') }}</strong>
                      </span> @endif
                    </div>
                    <br/>
                    <div class="form-group">
                        <div class="form-check">
                            <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <span class="form-check-sign"> Remember Me</span>
                    </label>
                        </div>
                    </div>
                </div>
                <div class="card-footer ">
                    <button type="submit" class="btn btn-warning btn-round btn-block mb-3">Login</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection