@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            <h1>Create a New Operation</h1>
        </div>
    </div>
</div>

{!! Form::open(['action' => 'OperationsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    <div class="container">
        <div class="well">
            <h2>Basic Operation Details</h2>
        
                <div class="form-group">
                    {{Form::label('name', 'Operation Name')}}<span class="text-danger">*</span>
                    {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Imicus Doctrine'])}}
                </div>
                <div class="form-group">
                    {{Form::label('type', 'Operation Type')}}<span class="text-danger">*</span>
                    {{Form::text('type', '', ['class' => 'form-control', 'placeholder' => 'Roam'])}}
                </div>
                <div class="form-group">
                    {{Form::label('assigned_to', 'Assigned To')}}
                    {{Form::text('assigned_to', '', ['class' => 'form-control', 'placeholder' => '1336468925'])}}
                </div>
                <div class="form-group">
                    {{Form::label('operation_type', 'Operation Type')}}
                    {{Form::select('operation_type', [
                                        'structure_off' => 'Structure Offensive', 
                                        'structure_def' => 'Structure Defensive',
                                        'roam'          => 'Roam',
                                        'general'       => 'General Fleet',
                                        'fun'           => 'Fun Fleet'],
                                        null, ['class' => 'form-control', 'placeholder' => 'Select Type'])}}
                </div>

                
                <div class="form-group">
                    {{Form::label('operation_at', 'Operation Start')}}<span class="text-danger">*</span> <small>When the timer comes out.</small>
                    {{Form::text('operation_at', '', ['class' => 'form-control', 'placeholder' => 'yyyy/mm/dd hh:mm:ss'])}}
                </div>
        </div>
    </div>

    <div class="container" id="operation-details" style="display:none;">
        <div class="well">
            <div class="detail-group" data-op-type="fun">
                @include('operations.parts.fun')
            </div>
            <div class="detail-group" data-op-type="general">
                @include('operations.parts.general')
            </div>
            <div class="detail-group" data-op-type="structure_def">
                @include('operations.parts.structure_def')
            </div>
            <div class="detail-group" data-op-type="structure_off">
                @include('operations.parts.structure_off')
            </div>
            <div class="detail-group" data-op-type="roam">
                @include('operations.parts.roam')
            </div>
        </div>

        {{Form::submit('Create Operation', ['class'=>'btn btn-primary'])}}
    </div>


 {!! Form::close() !!}
@endsection

@section('scripts')
    <script src="{{ asset('/js/operations.js') }}"></script>
@endsection
