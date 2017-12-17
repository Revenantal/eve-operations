<h2>Roam Operation Details</h2>
<div class="form-group">
    {{Form::label('form_up', 'Form Up Location')}}
    {{Form::text('form_up', '', ['class' => 'form-control', 'placeholder' => 'Q-U96U - Evictus Command'])}}
</div>
<div class="form-group">
    {{Form::label('voice_comms', 'Voice Communications')}}
    {{Form::text('voice_comms', '', ['class' => 'form-control', 'placeholder' => 'Evictus Mumble'])}}
</div>
<div class="form-group">
    {{Form::label('ship_types', 'Ship Types')}}
    {{Form::text('ship_types', '', ['class' => 'form-control', 'placeholder' => 'Titan > Dreads > Imicus'])}}
</div>
<div class="form-group">
    {{Form::label('estimated_duration', 'Estimated Duration')}}
    {{Form::text('estimated_duration', '', ['class' => 'form-control', 'placeholder' => '2 hours'])}}
</div>
<div class="form-group">
    {{Form::label('notes', 'Notes')}}
    {{Form::textarea('notes', '', ['class' => 'form-control', 'placeholder' => ''])}}
</div>