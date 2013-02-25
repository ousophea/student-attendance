/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
function getprint(text,style1,style2)
{
    var win = window.open();
    var html='<html>';
    html+='<head>';
    html+='</head><body>';
    html+=text;
    html+='</body></html>';
    win.document.write(html);
    win.print();
    win.close();
}
jQuery.noConflict();
(function($) {
    $(function() {
        // start jQuery
        $('.score').keyup(function(){
            var intRegex = /^\d+$/;
            var floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;
            var val = $('#'+this.id).val();
            if(!intRegex.test(val) && !floatRegex.test(val)) {
                //alert('Allow number fromm 0 -> 10');
                $('#'+this.id).val('');
            }
            else {
                if(val > 10){
                    val =val.substring(0, 1);
                    $('#'+this.id).val(val);
                    //alert('Allow number fromm 0 -> 10');
                    //$('#'+this.id).val('');
                }

            }
        });
        $('.score').blur(function(){
            if($('#'+this.id).val()==''){
                alert('This field could not empty!')
                $('#'+this.id).focus();
            }

        });

        // print report
        
        $(function () {
            $('.bprint').click(function () {
                getprint($("#print_report").html(),$('[name="style1"]').val(),$('[name="style2"]').val());
            });
        });
    // end jQuery
    });
})(jQuery);