<div class="mb-3">
    <h2>Moon Mining Operation Details</h2>
</div>

<div class="card mb-3">
    <div class="card-header">
        Fleet Details
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    {{Form::label('attr_form_up', 'Form Up Location')}}
                    {{Form::text('attr_form_up', (isset($operation)) ? $operation->attribute('form_up') : '', ['class' => 'form-control', 'placeholder' => 'Q-U96U - Evictus Command'])}}
                </div>
                <div class="form-group">
                    {{Form::label('attr_voice_comms', 'Voice Communications')}}
                    {{Form::text('attr_voice_comms', (isset($operation)) ? $operation->attribute('voice_comms') : '', ['class' => 'form-control', 'placeholder' => 'Evictus Mumble'])}}
                </div>
                <div class="form-group">
                    {{Form::label('attr_ship_types', 'Ship Types')}}
                    {{Form::text('attr_ship_types', (isset($operation)) ? $operation->attribute('ship_types') : '', ['class' => 'form-control', 'placeholder' => 'Titan > Dreads > Imicus'])}}
                </div>
                <div class="form-group">
                    {{Form::label('attr_estimated_duration', 'Estimated Duration')}}
                    {{Form::text('attr_estimated_duration', (isset($operation)) ? $operation->attribute('estimated_duration') : '', ['class' => 'form-control', 'placeholder' => '2 hours'])}}
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    {{Form::label('attr_notes', 'Notes')}}
                    {{Form::textarea('attr_notes', (isset($operation)) ? $operation->attribute('notes') : '', ['class' => 'form-control', 'placeholder' => '', 'rows' => '8'])}}
                </div>
            </div>
        </div>
    </div>
</div>
