@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>User Management</h1>
@stop

@section('content')
    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-condensed table-hover">
                <thead>
                <tr>
                    <th>Character Name</th>
                    <th>Corporation Name</th>
                    <th>Alliance Name</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
@stop

@push('css')

@push('js')