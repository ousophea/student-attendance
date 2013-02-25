jQuery.noConflict();
(function($) {
    $(function() {
		alert(123);
        var base_url=$('[name="base_url"]').val();
        $('.date_input').attachDatepicker({
            showOn: 'both',
            dateFormat: 'yy-mm-dd',
            buttonImage: base_url+'js/jquery/plugins/UI_date/img/calendar.gif',
            buttonImageOnly: true
        });


    });
})(jQuery);
