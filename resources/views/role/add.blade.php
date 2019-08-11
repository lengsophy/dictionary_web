@extends('layouts.app') @section('content')
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <h3>Role Create Form</h3>
                        <form method="POST" action="{{ url('role/add') }}" id="create_role_form" autocomplete="off">
                            @csrf
                            <div class="form-group row">
                                <span for="name" class="col-md-4 text-md-right">Name*</span>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                                     @if ($errors->has('name'))
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span> @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <span for="display_name" class="col-md-4 col-form-label text-md-right">Dispaly Name*</span>
    
                                <div class="col-md-6">
                                    <input id="display_name" type="display_name" class="form-control{{ $errors->has('display_name') ? ' is-invalid' : '' }}" name="display_name" value="{{ old('display_name') }}" required>
                                     @if ($errors->has('display_name'))
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $errors->first('display_name') }}</strong>
                                        </span> 
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                    <span for="description" class="col-md-4 col-form-label text-md-right">Description</span>
                                    <div class="col-md-6">
                                        <textarea  id="description"class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" value="{{ old('description') }}" style="height: 100px;" ></textarea>
                                         @if ($errors->has('description'))
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $errors->first('description') }}</strong>
                                            </span> 
                                        @endif
                                    </div>
                            </div>
                            <br>
                            <div class="form-group row mb-0">
                                <div class="col-md-12">
                                    <a href="{{url('role')}}" ><input type="button" class="btn btn-danger pull-right" value="Cancel"></a>
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
@push('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        $('#create_role_form').validate({
            rules: {
                name: {
                    required:true,
                    remote: {
                        url:'{{ url("role/check_role_key") }}',
                        type: "post",
                        dataType: 'json',
                        data: {
                            name:function (){ 
                                return $('input[name="name"]').val(); 
                            },
                            _token: $('input[name="_token"]').val()
                        },                 
                    }
                },
                display_name: {
                    required: true,
                    minlength:2,
                    maxlength:125
                }
            },
            messages: {
                name:{
                    remote:"Role Name is already used!"
                }
            },
            submitHandler: function(form){
                form.submit();
            }           
        });
    });
</script>
@endpush