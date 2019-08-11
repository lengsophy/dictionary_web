@extends('layouts.app') @section('content')
<div class="content">
    <div class="container">
      <div class="row">
      <div class="col-md-12">
      <div class="card ">
        <div class="card-body ">         
            <form method="POST" action="{{ url('role/permission/'.$result->id) }}">
              @csrf
              
              <div class="card ">
                  <div class="card-body ">
                  <div class="form-group">
                    <h5 class="modal-title">Permissions</h5><br>
                    <div class="col-sm-12">
                    <ul style="display: inline-block;list-style-type: none;padding:0; margin:0;">

                      @if($permissions !=null)
                        @foreach($permissions as $row)
                          <li class="checkbox" style="display: inline-block; min-width: 155px;">
                              <label>
                              <input type="hidden" value="{{$result->name}}" name="role_key">
                              <input type="checkbox" class="permission_check" name="permission[]" value="{{ $row->name }}" {{ in_array($row->id, $stored_permissions) ? 'checked' : '' }} > 
                              <span class="checkboxtext"> {{ $row->display_name }} </span>

                              </label>                      
                          </li>                    
                          @endforeach
                      @endif
                    </ul>
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
