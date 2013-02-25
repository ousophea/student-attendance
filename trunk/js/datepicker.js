/*jQuery.noConflict();
(function($) {
    $(function() {
        // start jQuery
        //date picker
		//$(".datePicker").click(function(){alert(3)});
        $(".datePicker").dynDateTime({
									 ifFormat:     "%Y-%m-%d",
									 }); //defaults
    // end jQuery
    });
})(jQuery);*/
jQuery.noConflict();
(function($) {
    $(function() {
		$('.datePicker').datepick({dateFormat: 'yyyy-mm-dd'}); 
		$('#startPicker,#endPicker,#startPicker1,#endPicker1').datepick({ 
			dateFormat: 'yyyy-mm-dd',
			onSelect: customRange, showTrigger: '#calImg'}); 
			 
		function customRange(dates) { 
			if (this.id == 'startPicker') { 
				$('#endPicker').datepick('option', 'minDate', dates[0] || null); 
			} 
			else if(this.id == 'endPicker'){ 
				$('#startPicker').datepick('option', 'maxDate', dates[0] || null); 
			}			
		}
    });
})(jQuery);