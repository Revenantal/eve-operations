<div class="mb-3">
    <h2>Structure Defensive Operation Details</h2>
</div>
<div class="card mb-3">
    <div class="card-header">
        Objective Details
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                        {{Form::label('attr_structure_location', 'Structure location')}}
                        {{Form::text('attr_structure_location', '', ['class' => 'form-control', 'placeholder' => 'WFC-MY - Structure Name'])}}
                </div>
                <div class="form-group">
                    {{Form::label('attr_structure_corp', 'Structure Corporation Owners')}}
                    {{Form::text('attr_structure_corp', '', ['class' => 'form-control', 'placeholder' => 'ExDominion'])}}
                </div>
                <div class="form-group">
                    {{Form::label('attr_structure_alliance', 'Structure Alliance Owners')}}
                    {{Form::text('attr_structure_alliance', '', ['class' => 'form-control', 'placeholder' => 'Evictus'])}}
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    {{Form::label('attr_structure_type', 'Structure Type')}}
                    {{Form::select('attr_structure_type', [
                                        'astrahus'  => 'Astrahus',
                                        'fortizar'  => 'Fortizar',
                                        'keepstar'  => 'Keepstar',
                                        'raitaru'   => 'Raitaru',
                                        'azbel'     => 'Azbel',
                                        'sotiyo'    => 'Sotiyo',
                                        'athanor'   => 'Athanor',
                                        'Tatara'    => 'Tatara',
                                        'poco'      => 'POCO',
                                        'pos'       => 'POS' ],
                                    null, ['class' => 'form-control', 'placeholder' => 'Select Type'])}}
                </div>
                <div class="form-group">
                    {{Form::label('attr_structure_timer', 'Structure Vulnerability Starts At')}} <small>(EVE Time)</small>
                    <div class="form-row d-flex date">
                        <div class="col-lg-5 align-items-stretch">
                            {{Form::text('attr_structure_timer', '', ['class' => 'flatpickr form-control', 'placeholder' => 'Select Date and Time', 'data-id' => 'datetime'])}}
                        </div>
                        <div class="col-lg-1 text-center align-items-stretch align-self-center">
                            OR
                        </div>
                        <div class="col-lg-6 align-items-stretch align-self-center">
                            <div class="form-row">
                                <div class="col-sm-4 align-self-center">
                                    <select id="inputState" class="form-control form-control-sm day">
                                        <option value='' selected>DD</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <select id="inputState" class="form-control form-control-sm hour">
                                        <option value='' selected>HH</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <select id="inputState" class="form-control form-control-sm minute">
                                        <option value='' selected>MM</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    {{Form::label('attr_timer_type', 'Timer Type')}}
                    {{Form::select('attr_timer_type', [
                                        'shield'    => 'Shield', 
                                        'armor'     => 'Armor',
                                        'final'     => 'Final'],
                                        null, ['class' => 'form-control', 'placeholder' => 'Select Type'])}}
                </div>
            </div>
        </div>
    </div>
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
                    {{Form::text('attr_form_up', '', ['class' => 'form-control', 'placeholder' => 'Q-U96U - Evictus Command'])}}
                </div>
                <div class="form-group">
                    {{Form::label('attr_voice_comms', 'Voice Communications')}}
                    {{Form::text('attr_voice_comms', '', ['class' => 'form-control', 'placeholder' => 'Evictus Mumble'])}}
                </div>
                <div class="form-group">
                    {{Form::label('attr_ship_types', 'Ship Types')}}
                    {{Form::text('attr_ship_types', '', ['class' => 'form-control', 'placeholder' => 'Titan > Dreads > Imicus'])}}
                </div>
                <div class="form-group">
                    {{Form::label('attr_estimated_duration', 'Estimated Duration')}}
                    {{Form::text('attr_estimated_duration', '', ['class' => 'form-control', 'placeholder' => '2 hours'])}}
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    {{Form::label('attr_notes', 'Notes')}}
                    {{Form::textarea('attr_notes', '', ['class' => 'form-control', 'placeholder' => '', 'rows' => '8'])}}
                </div>
            </div>
        </div>
    </div>
</div>
