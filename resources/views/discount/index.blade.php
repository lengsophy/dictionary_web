@extends('layouts.app')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9">
                {!! Form::open(['url' => 'discount','method' => 'GET','class' => 'form-horizontal', 'autocomplete' => 'off', 'id' => 'active']) !!}
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="input-group">
                                {!! Form::text('name', Request::get('name'),['class' => 'form-control','placeholder'=>'Name']) !!}
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="input-group">
                                {{ Form::submit('Search', ['class' => 'form-control ','style' =>'background-color: #455A64;color: #fff;'])}}
                            </div>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
            <div class="col-md-3">
                <div class="btn-group pull-right" role="group">
                    <a href="{{url('dictionarylist/create')}}" >
                        <button class="btn btn-primary " id="btn_add">Add Dictionary</button>
                    </a>
                </div>
            </div>
        </div>
        &nbsp;&nbsp;
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="modal-title">Dictionary Management</h5>
                    </div><br>
                    <div class="table-responsive">
                       <table class="table table-striped" cellspacing="0" width="100%" style="width:100%" id="discount_from">
                            <thead style="font-size:12px;">
                                <tr>
                                    <th>Key Word</th>
                                    <th>EN</th>
                                    <th>KH</th>
                                    <th>FN</th>
                                    <th>Create At</th>
                                    <th>Update At</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($discounts)>=1)
                                    @foreach ($discounts as $key => $item)
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td>{{$item->percentage}}</td>
                                        <td>{{$item->trip_number}}</td>
                                        <td>{{$item->description}}</td>
                                        <td>{{$item->created_at}}</td>
                                        <td>{{$item->updated_at}}</td>
                                        <td>
                                            @if($item->status == 1)
                                                Active
                                            @else
                                                Inactive
                                            @endif
                                        </td>
                                        <td>{{$item->created_at}}</td>
                                        <td>{{$item->updated_at}}</td>
                                        <td>
                                            @if($item->status == 1)
                                                Active
                                            @else
                                                Inactive
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('dictionarylist/edit/'.$item->id) }}" class="btn btn-link"><i class="fa fa-edit font-action" data-toggle="tooltip" title="Edit"></i></a>
                                            <a href="#" class="btn btn-link" data-href="dictionarylist/destroy/{{$item->id}}" data-toggle="modal" data-target="#confirm-delete">
                                                <i class="fa fa-remove font-action" data-toggle="tooltip" title="Delete"></i>
                                            </a>
                                            @if($item->status == 0)
                                                <a href="#" class="btn-link btn-info" data-href="dictionarylist/enable/{{$item->id}}" data-toggle="modal" data-target="#confirm-enable">
                                                    <i class="fa fa-check-square-o font-action" style="color:#FFA534" data-toggle="tooltip" title="Enable"></i>
                                                </a>
                                            @else
                                                <a href="#" class="btn-link btn-info" data-href="dictionarylist/disable/{{$item->id}}" data-toggle="modal" data-target="#confirm-disable">
                                                    <i class="fa fa-ban font-action" style="color:#FB404B" data-toggle="tooltip" title="Disable"></i>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                <tr>
                                    <td colspan="8" class="text-center">No data available in table</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="pagination-footer clearfix">
                        <span class="pull-right">{{ $discounts->links() }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    Are you sure to delete this discount?
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
                        Are you sure to disable this discount?
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
                        Are you sure to enable this discount?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary pull-left" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-danger btn-ok">OK</a>
                    </div>
                </div>
            </div>
        </div>
</div>
@stop
@push('scripts')
<script type="text/javascript">
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
    });
</script>

@endpush
