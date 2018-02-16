$(function() {

    // Populate the date dropdowns
    populateDates();

    // Load selected operation panel on a post back
    var selectedOption = $('#operation_type option:selected').val();
    if (selectedOption) {
       changeDetailPanel(selectedOption);
    }

    // Init flatpickr
    $(".flatpickr").flatpickr({
        enableTime: true, 
        minDate: "today", 
        time_24hr: true
    });

    //Init Solar system Typeahead
    $(".solarsystem.typeahead").typeahead({
        source:  function (query, process) {
            return $.get("/solarsystems/search/" + query, function (data) {
                return process(data);
            });
        }
    });

    // Change the operation detail view on dropdown selection
    $("#operation_type").change(function() {
        changeDetailPanel(this.value);
    });

    // Validate if user exists
    $('.username').focusout(function() {
        var username = $(this).val().trim();
        getCharactersByUsername(username);
    });  

    $(document).on('click', '.setCharacter', function() {
        var character_id = $(this).data('character_id');
        var character_name = $(this).data('character_name');
        setCharacter(character_id, character_name);
        $('#characterSelector').modal('hide');
    });

    // Watch for date drop down changes
    $('.date select').change(function() {
        $picker = $(this).parents('.date');
        var days = $picker.find('select.day').val();
        var hours = $picker.find('select.hour').val();
        var minutes = $picker.find('select.minute').val();

        // If all 3 are set, update flatpickr
        if (days && hours && minutes) {
            var opDate = new Date();
            opDate.setDate(opDate.getUTCDate() + Number(days));
            opDate.setHours(opDate.getUTCHours() + Number(hours));
            opDate.setMinutes(opDate.getUTCMinutes() + Number(minutes));

            $picker.find(".flatpickr").flatpickr({
                enableTime: true,
                minDate: "today",
                time_24hr: true
            }).setDate(opDate);
        }
    });


    function getCharactersByUsername(username) {
        if (username.length >= 3) {
            $.ajax({
                url: "https://esi.tech.ccp.is/latest/search/?categories=character&search=" + encodeURIComponent(username),
            })
            .done(function(data) {
                if (!data.character){
                    setCharacter();
                } else if (data.character.length == 1){
                    setCharacter(data.character[0], username);
                } else if (data.character.length > 20){
                    displayCharacterListModal(data.character.slice(0,20));
                } else if (data.character.length > 0){
                    displayCharacterListModal(data.character);
                } 
            });
        } else {
            setCharacter();
        }
    }

    function displayCharacterListModal(character_ids) {
        var $modal = $('#characterSelector');
        var $modalBody = $modal.find('.modal-body #character-selector');
        $modalBody.html('');

        $.ajax({
            url: "https://esi.tech.ccp.is/latest/characters/names/?character_ids=" + character_ids.join(",")
        })
        .done(function(data) {
            if (!data.error){
                data.forEach(function(character) {
                    $.ajax({
                        url: "https://esi.tech.ccp.is/latest/characters/" + character.character_id + "/portrait/",
                    })
                    .done(function(data) {
                        var portrait = '/images/no-fc.png';
                        if (!data.error){
                            var portrait = data.px256x256;
                        }
                        $modalBody.append(' \
                        <div class="col-lg-3 col-md-4 col-6 setCharacter mb-3" data-character_id="' + character.character_id + '" data-character_name="' + character.character_name + '"> \
                            <div class="card"> \
                                <img class="card-img-top" src="' + portrait + '" alt="' + character.character_name + '"> \
                                <div class="card-footer"> \
                                    <p class="card-text text-center">' + character.character_name + '</p> \
                                </div> \
                            </div> \
                        </div>');
                    });
                });
            } 
            $modal.modal();
        });
    }

    function setCharacter(id, name) {

        if (id) {
            $('#organizer-portrait').hide();
            $('#character-loading').show();
            $.ajax({
                url: "https://esi.tech.ccp.is/latest/characters/" + id + "/portrait/",
            })
            .done(function(data) {
                if (!data.error){
                    $('#assigned_to').val(id);
                    $('#organizer-name').val(name);
                    $('#organizer-portrait').attr('src', data.px64x64);
                } 
            });
        } else {
            $('#assigned_to').val('');
            $('#organizer-name').val('');
            $('#organizer-portrait').attr('src', '/images/no-fc.png');

        }

        $('#organizer-portrait').on('load', function() {
            $('#character-loading').hide();
            $('#organizer-portrait').show();
        });

    }

    function populateDates() {
        $daySelect = $('select.day');
        $hourSelect = $('select.hour');
        $minuteSelect = $('select.minute'); 

        var i = 0;
        while (i <= 59) {
            if (i <= 23) { $hourSelect.append($('<option>', { value: i, text: i })); }
            if (i <= 31) { $daySelect.append($('<option>', { value: i, text: i })); }
            $minuteSelect.append($('<option>', { value: i, text: i }));
            i++;
        }
    }

    function changeDetailPanel(panelName) {
        $detailPanel = $("#detail-panel");
        $targetView = $("#" + panelName);
        $currentView = $detailPanel.find(".detail-view");
        $form = $("#operation-form");

        if ($currentView.length != 0) {
            $currentView.slideUp('normal', function() {
                $currentView.detach();
                $currentView.appendTo($form);
                $targetView.appendTo($detailPanel);
                $targetView.slideDown('normal');
            });
        } else {
            $("#operation-details").fadeIn('fast');
            $targetView.appendTo($detailPanel);
            $targetView.slideDown('normal');
        }


    }
});