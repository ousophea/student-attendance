/////////////////////////////////////////////
/////////    Sochy choeun   ////////////
/////////////////////////////////////////////

jQuery.noConflict();
(function($) {
    $(function() {
        // start jQuery
        $('#assign').click(function(){
            $('#teacher_assign').toggle(500);
            return false;
        });
        // end jQuery
    });
})(jQuery);
