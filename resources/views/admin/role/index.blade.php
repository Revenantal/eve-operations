@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Role Management</h1>
@stop

@section('content')
    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-condensed table-hover">
                <thead>
                <tr>
                    <th>Role Name</th>
                    <th>Display Name</th>
                    <th>Description</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
@stop

@push('css')

@push('js')