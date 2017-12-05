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
                                    'coalition_off' => 'Coalition Offensive',
                                    'coalition_def' => 'Coalition Defensive', 
                                    'roam' => 'Roam',
                                    'fun' => 'Fun Fleet'],
                                    null, ['class' => 'form-control', 'placeholder' => 'Select Type'])}}
                </div>

                
                <div class="form-group">
                    {{Form::label('operation_at', 'Operation Start')}}<span class="text-danger">*</span> <small>When the timer comes out.</small>
                    {{Form::text('operation_at', '', ['class' => 'form-control', 'placeholder' => 'yyyy/mm/dd hh:mm:ss'])}}
                </div>
        </div>
    </div>

    <div class="container">
        <div class="well">
            <h2>Extended Operation Details</h2>
            <!-- Switch statement here depending on what the user picks above -->
        </div>

        {{Form::submit('Create Operation', ['class'=>'btn btn-primary'])}}
    </div>


 {!! Form::close() !!}
@endsection
