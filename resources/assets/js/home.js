$(function() {
    $('.localtime').each(function() {
        var strDate = $(this).data('date');
        var date = new Date(strDate + ' UTC');
        $(this).text(moment(date).format('YYYY-MM-DD HH:mm:ss'));
    });

    $('.operation > .card-body > a').on('click', function() {
        $(this).parents('.operation').toggleClass("active");
    });
});