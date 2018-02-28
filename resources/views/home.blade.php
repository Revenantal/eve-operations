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
                <div class="card mb-2 operation {{$operation->keyedAttributes()['attr_priority']->value}}" data-operation-id="{{$operation->id}}">
                    <div class="edit-controls">
                        <div class="button bg-primary" data-toggle="tooltip" title="Broadcast">
                            <i class="fas fa-fw fa-bullhorn"></i>
                        </div>
                        <a href="{{route('operations.edit', $operation->id)}}" class="button bg-warning" data-toggle="tooltip" title="Edit">
                            <i class="fas fa-fw fa-pencil-alt"></i>
                        </a>
                        <div class="button bg-danger" data-toggle="tooltip" title="Delete" data-action="delete">
                            <i class="fas fa-fw fa-trash"></i>
                        </div>
                    </div>
                    <div class="card-body">
                        <a data-toggle="collapse" href="#op-{{$operation->id}}" aria-expanded="false" aria-controls="op-{{$operation->id}}">
                            <div class="row h-100">
                                <div class="col-sm-1 my-auto">
                                    @foreach($operation->icons() as $icon)
										<img src="{{URL::asset('/images/icons/' . $icon['image'])}}" alt="{{$icon['title']}}" class="img-fluid icon" data-toggle="tooltip" title="{{$icon['title']}}"/>
                                    @endforeach
                                </div>
                                <div class="col-sm-1 my-auto">
                                    @if($operation->assignedTo)
                                        <img src="//image.eveonline.com/Character/{{$operation->assignedTo->character_id}}_64.jpg" class="img-fluid rounded" title="{{$operation->assignedTo->character_name}} is assigned to this operation">
                                    @else
                                        <img src="{{URL::asset('/images/no-fc.png')}}" class="img-fluid rounded" title="No one is assigned to this operation">
                                    @endif
                                </div>
                                <div class="col-sm-5 my-auto">
                                    <h4 class="operation-name">{{$operation->name}}</h4>
                                    @if (isset($operation->keyedAttributes()['attr_structure_timer']->value))
                                        <p class="structure-timer">  
                                            Structure comes out in:
                                            <strong><countdown data-toggle="tooltip" title="{{$operation->keyedAttributes()['attr_structure_timer']->value}} EVE" date="{{$operation->keyedAttributes()['attr_structure_timer']->value}}"></countdown></strong>
                                        </p>
                                    @endif
                                </div>
                                <div class="col-sm-3 my-auto text-center form-up">
                                    <h5>Form Up In:<br>
                                        <strong><countdown data-toggle="tooltip" title="{{$operation->operation_at}} EVE" date="{{$operation->operation_at}}"></countdown></strong>
                                    </h5>
                                </div>
                                <div class="col-sm-2 local-time my-auto text-center">
                                    <h5>Local Time</h5>
                                    <p class="localtime" data-date="{{$operation->operation_at}}"></p>
                                </div>
                            </div>
                        </a>
                        <div class="row collapse" id="op-{{$operation->id}}">
                            <div class="col-sm-12 mt-3 mb-3">
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
                                Posted by {{$operation->createdBy->character_name}} on {{$operation->created_at}}
                                @if($operation->modifiedBy)
                                    - Modified by {{$operation->modifiedBy->character_name}} on {{$operation->modified_at}}
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

<!-- Modal -->
<div class="modal fade" id="deleteOperationModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Operation?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you wish to delete operation "<strong><span class="op-name"></span></strong>"?
            </div>
            <div class="modal-footer">
                <form action="{{ route('operations.destroy', 62) }}" method="POST">
                    <a href="#" class="btn btn-secondary" data-dismiss="modal">Cancel</a>
                    <button class="btn btn-danger confirm">Delete</button>
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="{{ mix('/js/home.js') }}"></script>
@endsection

