@extends('layouts.app')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <h3>Word Create Form</h3>
                        <form method="POST" action="{{ url('discount/create') }}" autocomplete="off" id="create_discounts_form">
                            @csrf
                            <div class="form-group row">
                                <span for="percentage" class="col-md-4 col-form-label text-md-right">Percentage % <star class="star">*</star></span>
                                <div class="col-md-6">
                                    <input id="percentage" type="text" class="form-control{{ $errors->has('percentage') ? ' is-invalid' : '' }}" name="percentage" value="{{ old('percentage') }}" placeholder="Percentage %" onkeypress='validate(event)'>
                                    @if ($errors->has('percentage'))
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $errors->first('percentage') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <span for="trip_number" class="col-md-4 col-form-label text-md-right">Trip Number <star class="star">*</star></span>
                                <div class="col-md-6">
                                    <input id="trip_number" type="text" class="form-control{{ $errors->has('trip_number') ? ' is-invalid' : '' }}" name="trip_number" value="{{ old('trip_number') }}" placeholder="Trip Number" onkeypress='validate(event)'>
                                    @if ($errors->has('trip_number'))
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $errors->first('trip_number') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <span for="start_date" class="col-md-4 col-form-label text-md-right">Start Date <star class="star">*</star></span>
                                <div class="col-md-6">
                                    <input id="start_date" type="text" class="form-control{{ $errors->has('start_date') ? ' is-invalid' : '' }}" name="start_date" value="{{ old('start_date') }}" placeholder="Start" > @if ($errors->has('start_date'))
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $errors->first('start_date') }}</strong>
                                    </span> @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <span for="end_date" class="col-md-4 col-form-label text-md-right">End Date <star class="star">*</star></span>
                                <div class="col-md-6">
                                    <input id="end_date" type="text" class="form-control{{ $errors->has('end_date') ? ' is-invalid' : '' }}" name="end_date" value="{{ old('end_date') }}" placeholder="End" > @if ($errors->has('end_date'))
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $errors->first('end_date') }}</strong>
                                    </span> @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <span for="description" class="col-md-4 col-form-label text-md-right">Description <star class="star">*</star></span>
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
                                    <a href="{{url('discount')}}" ><input type="button" class="btn btn-danger pull-right" value="Cancel"></a>
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
    <script src="{!! url('assets/js/jquery/jquery.min.js') !!}"></script>
    <script src="{!! url('assets/js/jquery/jquery-ui.min.js') !!}"></script>
    <script>
        $(document).ready(function() {
            // validate date
            $("#start_date").datepicker({
                numberOfMonths: 1,
                onSelect: function(selected) {
                  $("#end_date").datepicker("option","minDate", selected)
                }
            });

            $("#end_date").datepicker({
                numberOfMonths: 1,
                onSelect: function(selected) {
                   $("#start_date").datepicker("option","maxDate", selected)
                }
            });
        });
    </script>
@endpush
