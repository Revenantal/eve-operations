@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Whitelist Management</h1>
@stop

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Whitelist Management</h3>

            <div class="box-tools pull-right">
                @include('admin.partials.whitelist-header-buttons')
            </div>
        </div>

        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-condensed table-hover">
                    <thead>
                    <tr>
                        <th>Corporation ID</th>
                        <th>Corporation Name</th>
                        <th>Alliance ID</th>
                        <th>Alliance Name</th>
                        <th>Actions</th>
                    </tr>
                    @foreach($whitelist as $list)
                        <tr>
                            <td>{{$list->corporation_id}}</td>
                            <td>{{$list->corporation_name}} <img src="http://image.eveonline.com/Corporation/{{ $list->corporation_id }}_32.png" class="rounded-circle img-fluid "></td>
                            <td>{{$list->alliance_id}}</td>
                            <td>{{$list->alliance_name}} <img src="http://image.eveonline.com/Alliance/{{ $list->alliance_id }}_32.png" class="rounded-circle img-fluid "></td>
                            <td>
                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#whitelistEdit-{{$list->id}}">
                                    <span class="fa fa-pencil" aria-hidden="true"></span>
                                </button>
                                <a class="btn btn-danger btn-sm" href="{{route('whitelist.destroy', $list->id)}}"><span class="fa fa-trash-o" aria-hidden="true"></span></a>
                            </td>
                        </tr>

                        <div class="modal fade" id="whitelistEdit-{{$list->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Whitelist Record</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('whitelist.update', $list->id)}}" method="post" role="form" id="whitelistEdit-form-{{$list->id}}">
                                            {{csrf_field()}}
                                            {{method_field('PATCH')}}

                                            <div class="form-group">
                                                <label for="name">Corporation ID</label>
                                                <input type="text" class="form-control" name="name" id="corporation_id" placeholder="Corporation ID" value="{{$list->corporation_id}}">
                                            </div>

                                            <div class="form-group">
                                                <label for="name">Corporation Name</label>
                                                <input type="text" class="form-control" name="corporation_name" id="display_name" placeholder="Corporation Name" value="{{$list->corporation_name}}">
                                            </div>

                                            <div class="form-group">
                                                <label for="name">Alliance ID</label>
                                                <input type="text" class="form-control" name="alliance_id" id="description" placeholder="Alliance ID" value="{{$list->alliance_id}}">
                                            </div>

                                            <div class="form-group">
                                                <label for="name">Alliance Name</label>
                                                <input type="text" class="form-control" name="alliance_name" id="description" placeholder="Alliance Name" value="{{$list->alliance_name}}">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" onclick="$('#whitelistEdit-form-{{$list->id}}').submit()">Save changes</button>
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
<link href="{{ mix('css/toastr.css') }}" rel="stylesheet">

@push('js')
<script src="{{ mix('js/toastr.js') }}"></script>
{!! Toastr::render() !!}