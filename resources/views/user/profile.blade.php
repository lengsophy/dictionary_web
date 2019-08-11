@extends('layouts.app') 
@section('content')
<div class="content">
    <div class="container">
        <div class="" data-image="../../assets/img/bg5.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-sm-6">
                        <form class="form" method="POST" action="{{url('profile')}}" enctype="multipart/form-data" id="form_profile">
                            @csrf
                            <div class="card ">
                                <div class="card-header ">
                                    <div class="card-header">
                                        <h4 class="card-title">Edit Profile</h4>
                                    </div>
                                </div>
                                <div class="card-body ">
                                   
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <span>Name</span>
                                                <input type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="User Name" name="name" value="{{ Auth::user()->name}}" >
                                                @if($errors->has('name'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('name') }}</strong>
                                                    </span> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <span>Email</span>
                                                    <input type="text" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="email" name="email" value="{{ Auth::user()->email}}">
                                                    @if($errors->has('email'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                        </span> 
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <span>Change Password</span>
                                                <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password" name="password" id="password">
                                                @if ($errors->has('password'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </span> 
                                                @endif
                                                <span id="result"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <span>Confirm Password</span>
                                                    <input type="password" class="form-control {{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" placeholder="Password Confirm" name="password_confirmation" id="password_confirmation">
                                                    @if ($errors->has('password_confirmation'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                        </span> 
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    <button type="submit" class="btn btn-primary btn-fill pull-right">Update Profile</button>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                    </div>
                            <div class="col-md-4">
                                <div class="card card-user">
                                    <div class="card-header no-padding">
                                        <div class="card-image">
                                            <img src="{{url('assets/img/full-screen-image-3.jpg')}}" alt="...">
                                        </div>
                                    </div>
                                    <div class="card-body ">
                                        <div class="author">
                                            <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                                <div class="fileinput-new">
                                                    @if(Auth::user()->profile_image)
                                                    <img class="avatar border-gray" src="{{url('assets/img/profile/'.Auth::user()->profile_image)}}" alt="..."> @else
                                                    <img class="avatar border-gray" src="{{url('assets/img/default_avatar_male.jpg')}}" alt="..."> @endif
                                                </div>
                                                <div id="line_hight" class="fileinput-preview fileinput-exists img avatar border-gray"></div>
                                                <div id="choose_profile_img">
                                                    <span class="btn btn-rose btn-round btn-file" style="color:black">
                                                    <span class="fileinput-new">Select image</span>
                                                    <span class="fileinput-exists" id="change_img">Change</span>
                                                    <input type="file" name="profile_image" id="profile_image"/>
                                                    </span>
                                                    <a href="#" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                                                </div>
                                                @if ($errors->has('profile_image'))
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $errors->first('profile_image') }}</strong>
                                                </span> 
                                                @endif
                                            </div>
                                            <br>
                                            <p class="card-description">
                                                {{Auth::user()->email}}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        var password    = $('#password'); //id of first password field
        var result  = $('#result'); //id of indicator element        
        setCheckPasswordStrength(password,result);
    });
    function setCheckPasswordStrength(password, result){
        /*=========== Start: Set Password Cretria Regular Expression ===================*/
        
        //Password must contain 5 or more characters
        var lowPassword = /(?=.{6,}).*/;  

        //Password must contain at least one digit and lower case letters .
        var mediumPassword = /^(?=\S*?[a-z])(?=\S*?[0-9])\S{6,}$/;
        
        //Password must contain at least one digit, one upper case letter and one lower case letter.
        var averagePassword = /^(?=\S*?[A-Z])(?=\S*?[a-z])(?=\S*?[0-9])\S{6,}$/; 

        //Password must contain at least one digit, one upper case letter and one lower case letter.
        var strongPassword = /^(?=\S*?[A-Z])(?=\S*?[a-z])(?=\S*?[0-9])(?=\S*?[^\w\*])\S{6,}$/; 

        /*=========== End: Set Password Cretria Regular Expression ===================*/
        
        // test() method is used to test match in a string whether the value is matched in a string or not.
         $(password).on('keyup', function(e) {
            document.getElementById("result").style.display="block";
            if(strongPassword.test(password.val())) {
                result.removeClass().addClass('strongPassword').html("Very Strong! Please use this password!");
            } 
            else if(averagePassword.test(password.val())) {
                result.removeClass().addClass('averagePassword').html("Strong! Tips: Enter special chars to make even stronger");
            } 
            else if(mediumPassword.test(password.val())) {
                result.removeClass().addClass('mediumPassword').html("Good! Tips: Enter uppercase letter to make strong");
            }
            else if(lowPassword.test(password.val())) {
                result.removeClass().addClass('stilllowPassword').html("Still Weak! Tips: Enter digits to make good password");
            }else{
                result.removeClass().addClass('lowPassword').html("Very Weak! Please use 6 or more chars password");
            }
        });     
    }
</script>
@endpush