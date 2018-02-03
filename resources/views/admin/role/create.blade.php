@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>
        Role Management
        <small>Create role</small>
    </h1>
@stop

@section('content')
    <form action="{{ route('roles.store') }}"  method="post" role="form">
        {{csrf_field()}}

    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Create Role</h3>

            <div class="box-tools pull-right">
                @include('admin.partials.role-header-buttons')
            </div>
        </div>

        <div class="box-body">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" id="" placeholder="Role Name">
            </div>

            <div class="form-group">
                <label for="display_name">Display name</label>
                <input type="text" class="form-control" name="display_name" id="" placeholder="Display name">
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" class="form-control" name="description" id="" placeholder="Description">
            </div>

            <div class="form-group">
                <h3>Associated Permissions</h3>
                @foreach($permissions as $permission)
                    <input type="checkbox" name="permission[]" value="{{$permission->id}}" > {{$permission->name}} <br>
                @endforeach
            </div>

            <div class="box box-success">
                <div class="box-body">
                    <div class="pull-left">
                        {{ link_to_route('roles.index', 'Cancel', [], ['class' => 'btn btn-danger btn-xs']) }}
                    </div><!--pull-left-->

                    <div class="pull-right">
                        <button type="submit" class="btn btn-success btn-xs">Submit</button>
                    </div><!--pull-right-->

                    <div class="clearfix"></div>
                </div><!-- /.box-body -->
            </div>

    </div>
@stop

@push('css')

@push('js')