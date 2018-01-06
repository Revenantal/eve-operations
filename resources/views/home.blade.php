@extends('layouts.app')

@section('content')
<div class="container mb-3">
    <div class="row">
        <div class="col-md-12 text-center">
            <h1>Upcoming Operations</h1>
        </div>
    </div>
</div>

<div class="container mb-3">
    <div class="operations">
        @if(count($operations) > 0)
            @foreach($operations as $operation)
                <div class="card mb-3 operation">
                    <div class="card-body">
                        <a data-toggle="collapse" href="#op-{{$operation->id}}" aria-expanded="false" aria-controls="op-{{$operation->id}}">
                            <div class="row">
                                <div class="col-sm-1">
                                    icons
                                </div>
                                <div class="col-sm-1">
                                    @if($operation->assignedTo)
                                        <img src="{{$operation->assignedTo->avatar}}" class="img-fluid" title="{{$operation->assignedTo->username}} is assigned to this operation">
                                    @else
                                        <img src="{{URL::asset('/images/no-fc.png')}}" class="img-fluid" title="No one is assigned to this operation">
                                    @endif
                                </div>
                                <div class="col-sm-5">
                                    <h3>{{$operation->name}} - {{$operation->friendlyType()}}</h3>
                                    @if (isset($operation->keyedAttributes()['attr_structure_timer']->value))
                                        <p>  
                                            Structure comes out in: <countdown date="{{$operation->keyedAttributes()['attr_structure_timer']->value}}"></countdown>
                                            <small>({{$operation->keyedAttributes()['attr_structure_timer']->value}} ET)</small>
                                        </p>
                                    @endif
                                </div>
                                <div class="col-sm-3">
                                    <h4>
                                        Form Up In:<br>
                                        <countdown date="{{$operation->operation_at}}"></countdown>
                                        <small>({{$operation->operation_at}} ET)</small>
                                    </h4>
                                </div>
                                <div class="col-sm-2">
                                    <h4>Local Time</h4>
                                    <div class="localtime" data-date="{{$operation->operation_at}}">test</div>
                                </div>
                            </div>
                        </a>
                        <div class="row collapse" id="op-{{$operation->id}}">
                            <div class="col-sm-12">
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <div class="row">
                                            @if(count($operation->operationAttributes))
                                                <div class="col-sm-7">
                                                    <h3>Operation Details</h3>
                                                    <div class="row">
                                                        @if (isset($operation->keyedAttributes()['attr_ship_types']->value))
                                                            <div class="col-sm-4">
                                                                <strong>Ship Types:</strong> 
                                                            </div>
                                                            <div class="col-sm-8">  
                                                                {{$operation->keyedAttributes()['attr_ship_types']->value}}
                                                            </div>
                                                        @endif
            
                                                        @if (isset($operation->keyedAttributes()['attr_voice_comms']->value))
                                                            <div class="col-sm-4">
                                                                <strong>Voice Coms:</strong> 
                                                            </div>
                                                            <div class="col-sm-8">  
                                                                {{$operation->keyedAttributes()['attr_voice_comms']->value}}
                                                            </div>
                                                        @endif
            
                                                        @if (isset($operation->keyedAttributes()['attr_form_up']->value))
                                                            <div class="col-sm-4">
                                                                <strong>Form Up Location:</strong> 
                                                            </div>
                                                            <div class="col-sm-8">  
                                                                {{$operation->keyedAttributes()['attr_form_up']->value}}
                                                            </div>
                                                        @endif
            
                                                        @if (isset($operation->keyedAttributes()['attr_estimated_duration']->value))
                                                            <div class="col-sm-4">
                                                                <strong>Est. Duration:</strong> 
                                                            </div>
                                                            <div class="col-sm-8">  
                                                                {{$operation->keyedAttributes()['attr_estimated_duration']->value}}
                                                            </div>
                                                        @endif

                                                        @if (isset($operation->keyedAttributes()['attr_structure_location']->value))
                                                            <div class="col-sm-4">
                                                                <strong>Struc. Location:</strong> 
                                                            </div>
                                                            <div class="col-sm-8">  
                                                                {{$operation->keyedAttributes()['attr_structure_location']->value}}
                                                            </div>
                                                        @endif

                                                        @if (isset($operation->keyedAttributes()['attr_structure_corp']->value) || isset($operation->keyedAttributes()['attr_structure_alliance']->value))
                                                            <div class="col-sm-4">
                                                                <strong>Owners:</strong> 
                                                            </div>
                                                            <div class="col-sm-8">  
                                                                <!-- Gotta be a better way to clean this up -->
                                                                @if (isset($operation->keyedAttributes()['attr_structure_corp']->value))
                                                                    {{$operation->keyedAttributes()['attr_structure_corp']->value}}
                                                                @endif
                                                                @if (isset($operation->keyedAttributes()['attr_structure_alliance']->value))
                                                                    @if (isset($operation->keyedAttributes()['attr_structure_corp']->value))
                                                                        <br>
                                                                    @endif
                                                                    {{$operation->keyedAttributes()['attr_structure_alliance']->value}}
                                                                @endif
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-sm-5">
                                                    <h3>Notes</h3>
                                                    <div class="card">
                                                        <div class="card-body">{{$operation->keyedAttributes()['attr_notes']->value}}</div>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="col-sm-12">
                                                    No details to share today!
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-muted">
                        Posted by {{$operation->createdBy->username}} on {{$operation->created_at}}
                            @if($operation->modifiedBy)
                                - Modified by {{$operation->modifiedBy->username}} on {{$operation->modified_on}}
                            @endif
                    </div>
                </div>
            @endforeach
        @else 
            <div class="row">
                <div class="col-md-12 text-center">
                    <p>Huh, that is weird... Seems we have no upcoming operations. We should go annoy someone.</p>
                </div>
            </div>    
        @endif
    </div>
</div>
@endsection

@section('scripts')
    <script src="{{ mix('/js/home.js') }}"></script>
@endsection

