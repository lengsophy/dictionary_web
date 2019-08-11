@extends('layouts.app') @section('content')
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <h3>Role Update Form</h3>
                        <form method="POST" action="{{ url('role/edit/'.$role->id) }}">
                            @csrf
                            <div class="form-group row">
                                <span for="name" class="col-md-4 text-md-right">Name</span>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $role->name }}" required autofocus>
                                     @if ($errors->has('name'))
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span> @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <span for="display_name" class="col-md-4 col-form-label text-md-right">Dispaly Name</span>
    
                                <div class="col-md-6">
                                    <input id="display_name" type="display_name" class="form-control{{ $errors->has('display_name') ? ' is-invalid' : '' }}" name="display_name" value="{{ $role->display_name }}" required>
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
                                    <textarea  id="description"class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" style="height: 100px;" >{{ $role->description }}</textarea>
                                     @if ($errors->has('description'))
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span> 
                                    @endif
                                </div>
                            </div>
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