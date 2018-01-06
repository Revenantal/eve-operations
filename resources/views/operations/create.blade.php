@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" type="text/css"  href="{{ mix('/css/flatpickr.css') }}">
@endsection

@section('content')
<div class="container mb-3">
    <div class="row">
        <div class="col-md-12 text-center">
            <h1>Create a New Operation</h1>
        </div>
    </div>
</div>

{!! Form::open(['action' => 'OperationsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    <div class="container mb-3">
        <div class="card mb-3">
            <div class="card-body">
                <h2>Basic Operation Details</h2>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            {{Form::label('name', 'Operation Name')}}<span class="text-danger">*</span>
                            {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Imicus Doctrine'])}}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            {{Form::label('assigned_to', 'Assigned To')}}
                            {{Form::text('assigned_to', '', ['class' => 'form-control', 'placeholder' => 'Username'])}}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            {{Form::label('operation_type', 'Operation Type')}}<span class="text-danger">*</span>
                            {{Form::select('operation_type', [
                                                'structure_off' => 'Structure Offensive', 
                                                'structure_def' => 'Structure Defensive',
                                                'roam'          => 'Roam',
                                                'fun'           => 'Fun Fleet',
                                                'moon_mining'   => 'Moon Mining'],
                                                null, ['class' => 'form-control', 'placeholder' => 'Select Type'])}}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            {{Form::label('operation_at', 'Operation Form Up')}}<span class="text-danger">*</span> <small>(Eve Time)</small>
                            {{Form::text('operation_at', '', ['class' => 'flatpickr form-control', 'placeholder' => 'Select Eve Date and Time', 'data-id' => 'datetime'])}}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            {{Form::label('attr_priority', 'Operation Priority')}}<span class="text-danger">*</span>
                            {{Form::select('attr_priority', [
                                                'general'   => 'General',
                                                'strat'     => 'Strategic Operation',
                                                'cta'       => 'Call To Arms' ],
                                                null, ['class' => 'form-control'])}}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            {{Form::label('attr_srp', 'Ship Replacement Program')}}<span class="text-danger">*</span><br>
                            {{Form::select('attr_srp', [
                                                false   => 'Denied',
                                                true     => 'Approved' ],
                                                null, ['class' => 'form-control'])}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mb-3" id="operation-details" style="display:none;">
        <div class="card mb-3">
            <div class="card-body">
                <div class="detail-panel" id="detail-panel"> </div>
            </div>
        </div>

        {{Form::submit('Create Operation', ['class'=>'btn btn-primary'])}}
    </div>


 {!! Form::close() !!}
@endsection

@section('scripts')
    <script src="{{ mix('/js/flatpickr.js') }}"></script>
    <script src="{{ mix('/js/operations.js') }}"></script>
@endsection
