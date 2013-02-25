<div class="task1">
	<fieldset>
    <legend align="center"><div class="heading">Add New Term</div></legend>
    <?php  if($this->session->userdata('ms_error')){echo message($this->session->userdata('ms_error'),"error");$this->session->unset_userdata("ms_error");} ?>
    <div class="search">
    <?php echo toolbar(array("type"=>"cancel","link"=>"generation/manager","text"=>"Cencel","title"=>"Cencel"));?>
    </div>
    <div class="addnew"><br />
    <?php echo form_open("generation/addTerm");?>
        <table width="700" align="center" id="myTable">
            
                <?php
					$req='<span class="require">*</span>';
					$labels=array(
								  //"Term Name".$req,
								  "Start Date".$req,
								  "End Date".$req,
								  );
					$inputs=array(
								  //form_input("txt_tername",$this->input->post("txt_tername")?$this->input->post("txt_tername"):$row->ter_name),
								  form_input("txt_tersdate",$this->input->post("txt_tersdate")?$this->input->post("txt_tersdate"):'',"id='startPicker'")." <span style='color:#000;'>ex: yyyy-mm-date</span>",
								  form_input("txt_teredate",$this->input->post("txt_teredate")?$this->input->post("txt_teredate"):'',"id='endPicker'")." <span style='color:#000;'>ex: yyyy-mm-date</span>",
								  );
					$validate=array(
									//form_error("txt_tername"),
									form_error("txt_tersdate"),
									form_error("txt_teredate"),
									);
					
					$num_column=1;
					$data="";
					for($i=0;$i<(count($labels));$i++){
						$data.=mgtable(array($labels[$i]=>'valign="top"'),array($inputs[$i].$validate[$i]=>"class='require'"));
						if(($i+1)%$num_column==0) {echo "<tr>".$data."</tr>"; $data="";}
					}
                    echo '<tr><td>&nbsp;</td>'.mgtable(array(form_submit("mySubmit","Save",'').anchor('generation/manager',form_button("Cencel","Cencel"),"title='Cencel'")=>"colspan='". ($num_column*2)-1 ."'")).'</tr>';
					echo '<tr>'.mgtable(array('Note: All fields containt (<font color="red">*</font>) are required.'=>"colspan='". ($num_column*2)."'")).'</tr>';
				
			?>
        </table>
        
    <?php 
		
		echo form_close();
		
	?>
    </div>
    </fieldset>
    <br />
</div>