$(function() {
    $('.localtime').each(function() {
        var strDate = $(this).data('date');
        var date = new Date(strDate + ' UTC');

        $(this).html(moment(date).format('YYYY-MM-DD[<br>]HH:mm:ss') + " " +  moment().tz(Intl.DateTimeFormat().resolvedOptions().timeZone).format('z')); 
    });

    $('.operation > .card-body > a').on('click', function() {
        $(this).parents('.operation').toggleClass("active");
    });

    $('.operation .edit-controls .button').on("click", function() {
        var action = $(this).data("action");
        var operationID = $(this).parents(".operation").data("operation-id");
        var operationName = $(this).parents(".operation").find(".operation-name").text();
        
        if (action == "delete") {
            modalDelete(operationID, operationName);
        }

    });


    function modalDelete(operationID, operationName) {
        var $modal = $('#deleteOperationModal');

        $modal.find('.op-name').text(operationName);
        $modal.find('form').attr("action", "/operations/" + operationID);

        $modal.modal('show');
    }

});