@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Permission Management</h1>
@stop

@section('content')
    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-condensed table-hover">
                <thead>
                <tr>
                    <th>Permission Name</th>
                    <th>Display Name</th>
                    <th>Description</th>
                </tr>
                @foreach($permissions as $permission)
                    <tr>
                        <td>{{$permission->name}}</td>
                        <td>{{$permission->display_name}}</td>
                        <td>{{$permission->description}}</td>
                    </tr>
                @endforeach
                </thead>
            </table>
        </div>
    </div>
@stop

@push('css')

@push('js')