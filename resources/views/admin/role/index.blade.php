@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Role Management</h1>
@stop

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Role Management</h3>

            <div class="box-tools pull-right">
                @include('admin.partials.role-header-buttons')
            </div>
        </div>

        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-condensed table-hover">
                    <thead>
                    <tr>
                        <th>Role Name</th>
                        <th>Display Name</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                    @foreach($roles as $role)
                        <tr>
                            <td>{{$role->name}}</td>
                            <td>{{$role->display_name}}</td>
                            <td>{{$role->description}}</td>
                            <td>
                                <a class="btn btn-info btn-sm" href="{{route('roles.edit', $role->id)}}"><span class="fa fa-pencil" aria-hidden="true"></span></a>
                                <a class="btn btn-danger btn-sm" href="{{route('roles.destroy', $role->id)}}"><span class="fa fa-trash-o" aria-hidden="true"></span></a>
                            </td>
                        </tr>
                    @endforeach
                    </thead>
                </table>
            </div>
        </div>
    </div>
@stop

@push('css')

@push('js')