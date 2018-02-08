@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Permission Management</h1>
@stop

@section('content')

    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Permission Management</h3>

            <div class="box-tools pull-right">
                @include('admin.partials.permission-header-buttons')
            </div>
        </div>

        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-condensed table-hover">
                    <thead>
                    <tr>
                        <th>Permission Name</th>
                        <th>Display Name</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                        @foreach($permissions as $permission)
                            <tr>
                                <td>{{$permission->name}}</td>
                                <td>{{$permission->display_name}}</td>
                                <td>{{$permission->description}}</td>
                                <td>
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#permEdit-{{$permission->id}}">
                                        <span class="fa fa-pencil" aria-hidden="true"></span>
                                    </button>
                                    <a class="btn btn-danger btn-sm" href="{{route('permissions.destroy', $permission->id)}}"><span class="fa fa-trash-o" aria-hidden="true"></span></a>
                                </td>
                            </tr>

                            <div class="modal fade" id="permEdit-{{$permission->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit {{$permission->name}}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('permissions.update', $permission->id)}}" method="post" role="form" id="permEdit-form-{{$permission->id}}">
                                                {{csrf_field()}}
                                                {{method_field('PATCH')}}

                                                <div class="form-group">
                                                    <label for="name">Name</label>
                                                    <input type="text" class="form-control" name="name" id="name" placeholder="Permission Name" value="{{$permission->name}}">
                                                </div>

                                                <div class="form-group">
                                                    <label for="name">Display name</label>
                                                    <input type="text" class="form-control" name="display_name" id="display_name" placeholder="Permission Name" value="{{$permission->display_name}}">
                                                </div>

                                                <div class="form-group">
                                                    <label for="name">Description</label>
                                                    <input type="text" class="form-control" name="description" id="description" placeholder="Permission Name" value="{{$permission->description}}">
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" onclick="$('#permEdit-form-{{$permission->id}}').submit()">Save changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </thead>
                </table>
            </div>
        </div>
    </div>
@stop

@push('css')

@push('js')