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

{!! Form::open(['action' => 'OperationsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'operation-form']) !!}
    <div class="container mb-3">
        <div class="card mb-3">
            <div class="card-body">
                <h2>Basic Operation Details</h2>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            {{Form::label('name', 'Operation Name')}}<span class="text-danger">*</span>
                            {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Imicus Doctrine'])}}
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            {{Form::label('organizer-name', 'Assigned To')}}
                            <div class="form-row align-items-center">
                                <div class="col-auto" style="width:48px;">
                                    <div style="display:none; width:100%;" id="character-loading" class="text-center">
                                        <i class="fas fa-spinner fa-spin"></i>
                                    </div>
                                    <img src="{{URL::asset('/images/no-fc.png')}}" id="organizer-portrait" class="rounded img-fluid"/>
                                </div>
                                <div class="col">
                                    {{Form::text('organizer-name', '', ['class' => 'form-control username', 'placeholder' => 'Username'])}}
                                </div>
                            </div>
                            {{ Form::hidden('assigned_to', '', array('id' => 'assigned_to')) }}
                        </div>
                    </div>
                    <div class="col-lg-6">
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
                    <div class="col-lg-6">
                        <div class="form-group">
                            {{Form::label('operation_at', 'Operation Form Up')}}<span class="text-danger">*</span> <small>(EVE Time)</small>
                            <div class="form-row d-flex date">
                                <div class="col-lg-5 align-items-stretch">
                                    {{Form::text('operation_at', '', ['class' => 'flatpickr form-control', 'placeholder' => 'Select Date and Time', 'data-id' => 'datetime'])}}
                                </div>
                                <div class="col-lg-1 text-center align-items-stretch align-self-center">
                                    OR
                                </div>
                                <div class="col-lg-6 align-items-stretch align-self-center">
                                    <div class="form-row">
                                        <div class="col-sm-4 align-self-center">
                                            <select id="inputState" class="form-control form-control-sm day">
                                                <option value='' selected>DD</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <select id="inputState" class="form-control form-control-sm hour">
                                                <option value='' selected>HH</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <select id="inputState" class="form-control form-control-sm minute">
                                                <option value='' selected>MM</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            {{Form::label('attr_priority', 'Operation Priority')}}<span class="text-danger">*</span>
                            {{Form::select('attr_priority', [
                                                'general'   => 'General',
                                                'strat'     => 'Strategic Operation',
                                                'cta'       => 'Call To Arms' ],
                                                null, ['class' => 'form-control'])}}
                        </div>
                    </div>
                    <div class="col-lg-6">
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
    </div>

    <div class="container mb-3">
        {{Form::submit('Create Operation', ['class'=>'btn btn-primary'])}}
    </div>
    

{!! Form::close() !!}

<div id="fun" class="detail-view">
    @include('operations.parts.fun')
</div>

<div id="general" class="detail-view">
    @include('operations.parts.general')
</div>

<div id="moon_mining" class="detail-view">
    @include('operations.parts.moon_mining')
</div>

<div id="roam" class="detail-view">
    @include('operations.parts.roam')
</div>

<div id="structure_def" class="detail-view">
    @include('operations.parts.structure_def')
</div>

<div id="structure_off" class="detail-view">
    @include('operations.parts.structure_off')
</div>
    


<div class="modal" tabindex="-1" role="dialog" id="characterSelector">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Character Selector</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row" id="character-selector">
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    <script src="{{ mix('/js/flatpickr.js') }}"></script>
    <script src="{{ mix('/js/bootstrap3-typeahead.js') }}"></script>
    <script src="{{ mix('/js/operations.js') }}"></script>
@endsection
