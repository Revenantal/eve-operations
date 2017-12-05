@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            <h1>Upcoming Operations</h1>
        </div>
    </div>
</div>

<div class="container">
    @if(count($operations) > 0)
        @foreach($operations as $operation)
            <div class="row operation">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-1">
                            icons
                        </div>
                        <div class="col-sm-1">
                            @if($operation->assignedTo)
                                <img src="{{$operation->assignedTo->avatar}}" class="img-responsive" title="{{$operation->assignedTo->username}} is assigned to this operation">
                            @else
                                <img src="{{URL::asset('/images/no-fc.png')}}" class="img-responsive" title="No one is assigned to this operation">
                            @endif
                        </div>
                        <div class="col-sm-4">
                            <h3>{{$operation->type}} - {{$operation->name}}</h3>
                            <p>Form Up:</p>
                        </div>
                        <div class="col-sm-2 col-sm-offset-1">
                            <h3><countdown date="{{$operation->operation_at}}"></countdown></h3>
                        </div>
                        <div class="col-sm-1">
                            Local Time
                        </div>
                        <div class="col-sm-1">
                            Eve Time
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <p>{{$operation->name}} by {{$operation->createdBy->username}}
                                @if($operation->modifiedBy)
                                    - Modified by {{$operation->modifiedBy->username}}
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>   
            @if(count($operation->operationAttributes)) 
                {{$operation->operationAttributes}}
            @endif
        @endforeach
    @else 
        <div class="row">
            <div class="col-md-12 text-center">
                <p>Huh, that is weird... Seems we have no upcoming operations. We should go annoy someone.</p>
            </div>
        </div>    
    @endif
</div>
@endsection
