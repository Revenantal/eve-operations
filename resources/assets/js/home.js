$(function() {
    $('.localtime').each(function() {
        var strDate = $(this).data('date');
        var date = new Date(strDate + ' UTC');
        $(this).text(date.toString());
    });
});