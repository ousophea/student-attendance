jQuery.noConflict();
(function($) {
    $(function() {
	window.onload = function(){
			new JsDatePick({
				useMode:2,
				target:"pu_datepicker",
				dateFormat:"%d/%M/%Y"
			});
		};
   });
})(jQuery);