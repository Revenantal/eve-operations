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
                <div class="card mb-3 operation {{$operation->keyedAttributes()['attr_priority']->value}}">
                    <div class="card-body">
                        <a data-toggle="collapse" href="#op-{{$operation->id}}" aria-expanded="false" aria-controls="op-{{$operation->id}}">
                            <div class="row">
                                <div class="col-sm-1">
                                    @if (isset($operation->keyedAttributes()['attr_priority']->value))
                                        @switch($operation->keyedAttributes()['attr_priority']->value)
                                            @case('strat')
                                                <img src="{{URL::asset('/images/icons/strat-op.png')}}" alt="Strategic Operation" class="img-fluid icon" data-toggle="tooltip" title="Strategic Operation"/>
                                                @break
                                            @case('cta')
                                                <img src="{{URL::asset('/images/icons/cta.png')}}" alt="Call To Arms" class="img-fluid icon" data-toggle="tooltip" title="Call To Arms"/>
                                                @break
                                            @default
                                                <img src="{{URL::asset('/images/icons/general-op.png')}}" alt="General Operation" class="img-fluid icon" data-toggle="tooltip" title="General Operation"/>
                                                @break
                                        @endswitch
                                    @endif

                                    @if ($operation->keyedAttributes()['attr_srp']->value == true)
                                        <img src="{{URL::asset('/images/icons/srp.png')}}" alt="SRP Approved" class="img-fluid icon" data-toggle="tooltip" title="SRP Approved"/>
                                    @endif

                                    @if (isset($operation->type))
                                        @switch($operation->type)
                                            @case('structure_off')
                                                <img src="{{URL::asset('/images/icons/struture_off.png')}}" alt="{{$operation->friendlyType()}}" class="img-fluid icon" data-toggle="tooltip" title="{{$operation->friendlyType()}}"/>
                                                @break
                                            @case('structure_def')
                                                <img src="{{URL::asset('/images/icons/structure_def.png')}}" alt="{{$operation->friendlyType()}}" class="img-fluid icon" data-toggle="tooltip" title="{{$operation->friendlyType()}}"/>
                                                @break
                                            @case('roam')
                                                <img src="{{URL::asset('/images/icons/roam.png')}}" alt="{{$operation->friendlyType()}}" class="img-fluid icon" data-toggle="tooltip" title="{{$operation->friendlyType()}}"/>
                                                @break
                                            @case('moon_mining')
                                                <img src="{{URL::asset('/images/icons/mining.png')}}" alt="{{$operation->friendlyType()}}" class="img-fluid icon" data-toggle="tooltip" title="{{$operation->friendlyType()}}"/>
                                                @break
                                            @default
                                                <img src="{{URL::asset('/images/icons/fun.png')}}" alt="{{$operation->friendlyType()}}" class="img-fluid icon" data-toggle="tooltip" title="{{$operation->friendlyType()}}"/>
                                                @break
                                        @endswitch
                                    @endif

                                    @if (isset($operation->keyedAttributes()['attr_structure_type']))
                                        <img src="/images/icons/{{$operation->keyedAttributes()['attr_structure_type']->value}}.png" alt="{{$operation->keyedAttributes()['attr_structure_type']->value}}" class="img-fluid icon" data-toggle="tooltip" title="{{$operation->keyedAttributes()['attr_structure_type']->value}}"/>
                                    @endif

                                </div>
                                <div class="col-sm-1">
                                    @if($operation->assignedTo)
                                        <img src="{{$operation->assignedTo->avatar}}" class="img-fluid" title="{{$operation->assignedTo->username}} is assigned to this operation">
                                    @else
                                        <img src="{{URL::asset('/images/no-fc.png')}}" class="img-fluid" title="No one is assigned to this operation">
                                    @endif
                                </div>
                                <div class="col-sm-5">
                                    <h3>{{$operation->name}}</h3>
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
                            <div class="col-sm-12 mb-3">
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
                                                    @if (isset($operation->keyedAttributes()['attr_notes']->value))
                                                        <h3>Notes</h3>
                                                        <div class="card">
                                                            <div class="card-body">{{$operation->keyedAttributes()['attr_notes']->value}}</div>
                                                        </div>
                                                    @endif
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
                            <div class="col-12">
                                Posted by {{$operation->createdBy->username}} on {{$operation->created_at}}
                                @if($operation->modifiedBy)
                                    - Modified by {{$operation->modifiedBy->username}} on {{$operation->modified_on}}
                                @endif
                            </div>
                        </div>
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

