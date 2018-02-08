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
                    <th>Roles</th>
                    <th>Actions</th>
                </tr>
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->character_name}}</td>
                        <td>{{$user->corporation_name}}</td>
                        <td>{{$user->alliance_name}}</td>
                        <td>
                            @foreach($user->roles as $role)
                                {{$role->name}}
                            @endforeach
                        </td>
                        <td>
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal-{{$user->id}}">
                                Edit Roles
                            </button>
                        </td>
                    </tr>

                    <div class="modal fade" id="myModal-{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit {{$user->character_name}} Roles</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('users.update', $user->id)}}" method="post" role="form" id="role-form-{{$user->id}}">
                                        {{csrf_field()}}
                                        {{method_field('PATCH')}}

                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" name="name" id="" placeholder="Role Name" value="{{$user->character_name}}">
                                        </div>

                                        <select name="roles[]" multiple>
                                            @foreach($roles as  $role)
                                                <option value="{{$role->id}}">{{$role->name}}</option>
                                            @endforeach
                                        </select>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" onclick="$('#role-form-{{$user->id}}').submit()">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach
                </thead>
            </table>
        </div>
    </div>
@stop

@push('css')
<link href="{{ mix('css/toastr.css') }}" rel="stylesheet">

@push('js')
<script src="{{ mix('js/toastr.js') }}"></script>
{!! Toastr::render() !!}