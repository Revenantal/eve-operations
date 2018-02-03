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
                            <a class="btn btn-info btn-sm" href="{{route('users.edit', $user->id)}}"><span class="fa fa-pencil" aria-hidden="true"></span></a>
                        </td>
                    </tr>
                @endforeach
                </thead>
            </table>
        </div>
    </div>
@stop

@push('css')

@push('js')