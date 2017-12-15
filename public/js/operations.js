$(function() {
    $("#operation_type").change(function() {
        $detailPanel = $("#operation-details .detail-group[data-op-type='" + this.value + "'");
        if ($detailPanel.length != 0) {
            $("#operation-details .detail-group").hide();
            $("#operation-details").fadeIn();
            $detailPanel.fadeIn();
        }
    });

    if ($('#operation_type').find(":selected").val()) {
        $opType = $('#operation_type').find(":selected").val()
        $("#operation-details .detail-group").fadeOut();
        $("#operation-details").fadeIn();
        $("#operation-details .detail-group[data-op-type='" + $opType + "'").fadeIn();
    }
});