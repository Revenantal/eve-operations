$(function() {
    
    $(".flatpickr").flatpickr({
        enableTime: true, 
        minDate: "today", 
        time_24hr: true
    });

    $("#operation_type").change(function() {
        $detailPanel = $("#detail-panel");
        $('#operation-details').fadeOut('fast');
        $.get(
            "/operations/parts/" + this.value,
            function (data) {
                $detailPanel.html(data);
            }
        )        
        .done(function( data ) {
            $('#operation-details').slideDown('fast');
        });
    });

    if ($('#operation_type').find(":selected").val()) {
        $opType = $('#operation_type').find(":selected").val();
        $.get(
            "/operations/parts/" + $opType,
            function (data) {
                $('#operation-details').fadeOut('fast');
                $('#detail-panel').html(data);
            }
        )
        .done(function( data ) {
            $('#operation-details').slideDown('fast');
        });
    }
});