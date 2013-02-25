/////////////////////////////////////////////
/////////    VSVB Group License  ////////////
/////////////////////////////////////////////

function submits(action,url){
    //alert(url); return;
    if(action=='link'){
        window.location =url;
    }
    else{
        window.document.form_admin.action=url;// alert(url);
        window.document.form_admin.submit(); 
    }
}


jQuery.noConflict();
(function($) {
    $(function() {
        // start jquery

        // get uri from php
        var uri=[
        $('[name="base_url"]').val(),
        $('[name="segment1"]').val(),
        $('[name="segment2"]').val(),
        $('[name="segment3"]').val(),
        ];
        // check all in page admin
        $(".checkall").click(function(){
            var checked_status = this.checked;

            $(".check").each(function(){

                this.checked = checked_status;

            });

        });
        // click on icon of toolbar
        $('.tra-toolbar-icon').click(function(){
            $('.loading').show();
            var toolbarid=this.id,url,count,id;
            //alert(toolbarid);return false;
            if((uri[2]=='manager' && toolbarid=='edit') || toolbarid=='company'){
                count=0;
                id=null;
                $(".check").each(function(){ // find all checkbox
                    if(this.checked){
                        count++;
                        id=this.id;
                    }
                });
                if(count==1){
                    // not post
                    //if(toolbarid=='company');
                    //uri1=((toolbarid=="edit")?"admin_member":"admin_company");
                    //alert(toolbarid);return false;
                    url=uri[0]+uri[1]+'/'+toolbarid+'/'+id;
                    submits('link',url);
                    return false;
                }
                else if(count==0){
                    $('.loading').hide();
                    alert('Please select item!');
                    
                    return false;
                }
                else{
                    alert('Select item allow only one!');
                    $('.loading').hide();
                    return false;
                }

            }
            else if(toolbarid=='delete'){

                count=0;
                id=null;
                $(".check").each(function(){
                    if(this.checked){
                        count++;
                        id=this.id;
                    }
                });
                if(count!=0){
                    //post
                    if(confirm('Are you sure want to delete '+count+' item?\nNote: all data that related to this item will delete.')==false){
                        $('.loading').hide();
                        return false;
                    }
                    url=uri[0]+uri[1]+'/'+toolbarid;
                    submits('post',url);
                    return false;
                }
                else{
                    alert('Please select item!');
                    $('.loading').hide();
                    return false;
                }
            }
            else if((toolbarid=='add')&& uri[2]=='manager'){
                url=uri[0]+uri[1]+'/'+toolbarid;
                submits('link',url);
                return false;
            }
            //dmo
            else if((toolbarid=='add_dmo')&& uri[2]=='manager'){
                url=uri[0]+uri[1]+'/'+toolbarid;
                submits('link',url);
                return false;
            }
            //import
            else if((toolbarid=='import')&& uri[2]=='manager'){
                url=uri[0]+uri[1]+'/'+toolbarid;
                submits('link',url);
                return false;
            }
            else if(toolbarid=='upload_file'){
                url=uri[0]+uri[1]+'/'+'upload_file'
                //alert (url);
                submits('post',url);
                return false;
            }
            else if(toolbarid=='cancel'){
                url=uri[0]+uri[1]+'/manager'
                submits('link',url);
                return false;
            }
            else if(toolbarid=='add_company')  { // for company toobar save
                url=uri[0]+uri[1]+'/company/'+uri[3]
                submits('post',url);
                return false;
            }
            else  { // form toolbar save
                url=uri[0]+uri[1]+'/'+uri[2]+'/'+uri[3]
                submits('post',url);
                return false;
            }
        });

        // Update hours of curricula
        $('.hours').click(function(){
            var val=prompt('Please enter number of hours.',this.textContent);
            //            alert(this.id);return false;
            //validate
            var number = /^(?:[0-9]+)$/i; // number unsign
            var regex = RegExp(number);
            if(val==null){
                return false;
            }
            else if(!regex.test(val)){
                alert('Allow only number,please try again.');
                return false;
            }
            if(val==this.textContent) return false;
            document.getElementById(this.id).innerHTML='<img title="Please wait..." src="'+uri[0]+'global/images/loading-small.gif" alt="Loading..." />';//return false;
            submits('post',uri[0]+uri[1]+'/edit/'+val+'/'+this.id+'/'+uri[3]);
            return false;
        });

        // login
        $('.submit,input[type="submit"]').click(function(){
            $('.loading').show();
        });
        // end
		
        //hide show midterm, final exam
        var default_exam= $('[name="default_exam"]').val();
		
        $('#'+default_exam).hide();//hide defaule exam
        $("#midterm_tab").css({
            'background':'#FFFF99'
        });
        $("#midterm_tab").click(function () {//when user click on button midterm
            $("#final").hide();
            $("#midterm").show();
            $(this).css({
                'background':'#FFFF99'
            });
            $("#final_tab").css({
                'background':'#ECE9D8',
                'color': '#666666'
            });
            $('[name="examtype"]').val(1);
            //enable
            $("#final").attr('disabled', true);
            $("#midterm").attr('disabled', false);
		
        });
        $("#final_tab").click(function () {//when user click on button final
            $("#final").show();
            $("#midterm").hide();
			  
            $(this).css({
                'background':'#FFFF99'
            });
            $("#midterm_tab").css({
                'background':'#ECE9D8',
                'color': '#666666'
            });
            $('[name="examtype"]').val(2);
            $("#final").attr('disabled', false);
            $("#midterm").attr('disabled', true);
			  
        });     

        //---------------
    });
})(jQuery);
