@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>
        Whitelist  Management
        <small>Create Whitelist Record</small>
    </h1>
@stop

@section('content')
    <form action="{{ route('whitelist.store') }}"  method="post" role="form">
        {{csrf_field()}}

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">New Whitelist Record</h3>

                <div class="box-tools pull-right">
                    @include('admin.partials.whitelist-header-buttons')
                </div>
            </div>

            <div class="box-body">
                <div class="callout callout-info">
                    <h4>ID's are required for this!</h4>

                    <p>You can aquire these by going to your corp and or alliance killboard at https://zkillboard.com
                        At the end of the address is the corp or alliance id.</p>
                </div>

                <div class="form-group">
                    <label for="name">Corporation ID</label>
                    <input type="text" class="form-control" name="corporation_id" id="corporation_id" placeholder="Corporation ID">
                </div>

                <div class="form-group">
                    <label for="name">Corporation Name <span style="color:red"><small>Case Sensitive</small></span></label>
                    <input type="text" class="form-control" name="corporation_name" id="corporation_name" placeholder="Corporation Name">
                </div>

                <div class="form-group">
                    <label for="name">Alliance ID</label>
                    <input type="text" class="form-control" name="alliance_id" id="alliance_id" placeholder="Alliance ID">
                </div>

                <div class="form-group">
                    <label for="name">Alliance Name <span style="color:red"><small>Case Sensitive</small></span></label>
                    <input type="text" class="form-control" name="alliance_name" id="alliance_name" placeholder="Alliance Name">
                </div>

                <div class="box box-success">
                    <div class="box-body">
                        <div class="pull-left">
                            {{ link_to_route('whitelist.index', 'Cancel', [], ['class' => 'btn btn-danger btn-xs']) }}
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