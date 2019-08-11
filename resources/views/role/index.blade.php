@extends('layouts.app')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="btn-group pull-right" role="group">
                    <a href="{{url('role/add')}}"> <button class="btn btn-primary " id="btn_add">Add Role</button></a>
                </div>
            </div>
        </div>
        &nbsp;&nbsp;
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="modal-title">Role & Permission</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead style="font-size:12px;">
                                <tr>
                                    <th>Id</th>
                                    <th>Role Name</th>
                                    <th>Dispay Name</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($role as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->display_name }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->updated_at }}</td>
                                    <td>
                                        <a href="role/edit/{{ $item->id }}" class="btn btn-link"><i class="fa fa-edit" data-toggle="tooltip" title="Edit" style="font-size:20px"></i></a>
                                        <a href="role/permission/{{ $item->id }}" class="btn btn-link"><i class="fa fa-th" data-toggle="tooltip" title="Permission"style="font-size:20px"></i></a>
                                        <button class="btn btn-link" data-href="role/delete/{{ $item->id }}" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-remove" data-toggle="tooltip" title="Delete" style="font-size:18px"></i></button>
                                    </td>
                                <tr>
                                    @endforeach
                            </tbody>
                        </table>
                        <div class="pull-right"> {{ $role->appends(Request::except('page'))->links() }} </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        Are you sure to delete?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary pull-left" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-danger btn-ok">Delete</a>
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
    })
</script>
@endpush