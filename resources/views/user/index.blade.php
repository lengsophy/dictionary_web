@extends('layouts.app')
@section('content')
<div class="content">
        <div class="container-fluid">
            <div class="row">
            <div class="col-md-12">
            <div class="btn-group pull-right" role="group">
                <a href="{{url('user/add')}}"> <button class="btn btn-primary " id="btn_add">Add Admin User</button></a>
            </div>   
            </div>
        </div>
        &nbsp;&nbsp;
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="modal-title">User Management</h5>
                    </div><br>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead style="font-size:12px;">
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Role Type</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($users)>=1)
                                    @foreach ($users as $key => $item)
                                    <tr>
                                        <td>0{{$key + 1}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->role_name}}</td>
                                        <td>{{$item->email}}</td>
                                        <td>
                                            @if($item->status == 1)
                                                <span>Active</span>
                                            @else
                                                <span style="color: red;">Disable</span>
                                            @endif
                                        </td>
                                        <td>{{$item->created_at}}</td>
                                        <td>
                                            <!-- edit -->
                                            <a href="user/edit/{{$item->id}}" class="btn btn-link"><i class="fa fa-edit font-action" data-toggle="tooltip" title="Edit"></i></a>
                                            <!-- delete -->
                                            @if(Auth::user()->id != $item->id)
                                            <a href="#" class="btn btn-link" data-href="user/delete/{{$item->id}}" data-toggle="modal" data-target="#confirm-delete">
                                                <i class="fa fa-remove font-action" data-toggle="tooltip" title="Delete"></i>
                                            </a>
                                            @endif
                                            <!-- disable & enable-->
                                            @if($item->status == 0)
                                                <a href="#" class="btn-link btn-info" data-href="user/enable/{{$item->id}}" data-toggle="modal" data-target="#confirm-enable">
                                                    <i class="fa fa-check-square-o font-action" style="color:#FFA534" data-toggle="tooltip" title="Enable"></i>
                                                </a>
                                            @else
                                                @if(Auth::user()->id != $item->id)
                                                <a href="#" class="btn-link btn-info" data-href="user/disable/{{$item->id}}" data-toggle="modal" data-target="#confirm-disable">
                                                    <i class="fa fa-ban font-action" style="color:#FB404B" data-toggle="tooltip" title="Disable"></i>
                                                </a>
                                                @endif
                                            @endif 
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                <tr>
                                    <td colspan="7" class="text-center">No data available in table</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                        <div class="pagination-footer clearfix">
                            <span class="pull-right">{{ $users->links() }}</span>
                        </div> 
                    </div>
                  
                </div>
            </div>
        </div>  
        <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        Are you sure to delete this user?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary pull-left" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-danger btn-ok">Delete</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- disable -->
        <div class="modal fade" id="confirm-disable" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        Are you sure to disable this user?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary pull-left" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-danger btn-ok">OK</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- enable -->
        <div class="modal fade" id="confirm-enable" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        Are you sure to enable this user?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary pull-left" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-danger btn-ok">OK</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@push('scripts')
<script>
    $(document).ready(function() {
        $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
        });
        $('#confirm-disable').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
        });
        $('#confirm-enable').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
        });
    })
</script>
@endpush