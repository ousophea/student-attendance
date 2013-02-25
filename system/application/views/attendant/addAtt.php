<div class="task1" style="width:700px;">
	<fieldset>
    <legend align="center"><div class="heading">Choose Date to add attendant</div></legend>
    <?php  if($this->session->userdata('ms_error')){echo message($this->session->userdata('ms_error'),"error");$this->session->unset_userdata("ms_error");} ?>
    <div class="search">
    </div>
    <div class="addnew"><br />
    <?php echo form_open("attendant/addAtt/".$this->uri->segment(3).'/'.$this->uri->segment(4).'/'.$this->uri->segment(5));?>
        <table width="700" align="center" id="myTable">
                <?php
					$req='<span class="require">*</span>';
					$datestring = "%Y-%m-%d";
					$labels=array(
								  "Select Date".$req,
								  );
					$inputs=array(
								  form_input("txt_attDate",$this->input->post("txt_attDate")?$this->input->post("txt_attDate"):mdate($datestring),'class="datePicker"'),
								  );
					$validate=array(
									form_error('txt_attDate'),
									);
					$num_column=1;
					$data="";
					for($i=0;$i<(count($labels));$i++){
						$data.=mgtable(array($labels[$i]=>'valign="top"'),array($inputs[$i].$validate[$i]=>"class='require'"));
						if(($i+1)%$num_column==0) {echo "<tr>".$data."</tr>"; $data="";}
					}
                    echo '<tr><td>&nbsp;</td>'.mgtable(array(form_submit("mySubmit","Next",'').anchor('attendant/manager',form_button("Cancel","Back"),"title='Cancel'")=>"colspan='". ($num_column*2)-1 ."'")).'</tr>';
					//echo '<tr>'.mgtable(array(form_checkbox('newsletter', 'accept', FALSE).'Don\'t show this again?'=>"colspan='". ($num_column*2)."'")).'</tr>';
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