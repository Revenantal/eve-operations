$(function() {
    $("#operation_type").change(function() {
        $detailPanel = $("#operation-details .detail-group[data-op-type='" + this.value + "'");
        if ($detailPanel.length != 0) {
            $("#operation-details .detail-group").hide();
            $("#operation-details").show();
            $detailPanel.show();
        }
    });

    if ($('#operation_type').find(":selected").val()) {
        $opType = $('#operation_type').find(":selected").val()
        $("#operation-details .detail-group").hide();
        $("#operation-details").show();
        $("#operation-details .detail-group[data-op-type='" + $opType + "'").show();
    }
});