<div class="task1">
	
	<fieldset>
    <legend align="center"><div class="heading">Add New Organization</div></legend>
    <?php  if($this->session->userdata('ms_error')){echo message($this->session->userdata('ms_error'),"error");$this->session->unset_userdata("ms_error");} ?>
    <div class="search">
    <?php echo toolbar(array("type"=>"cancel","link"=>"ngo/manager","text"=>"Cencel","title"=>"Cencel"));?>
    </div>
    <div class="addnew"><br />
    <?php echo form_open("ngo/addnew");?>
        <table width="700" align="center">
            
                <?php
					$text=array(
								'name'=>'txt_ngodes',
								'cols'=>20,
								'rows'=>5,
								'value'=>$this->input->post("txt_ngodes")?$this->input->post("txt_ngodes"):"",
								);
					$req='<span class="require">*</span>';
					$labels=array(
								  "NGO Name".$req,
								  "Address".$req,
								  "Contact Person".$req,
								  "Url",
								  array("Email".$req=>"valign='top'"),
								  "Sart Date",
								  "End Date",
								  array("Description"=>"valign='top'")
								  );
					$inputs=array(
								  form_input("txt_ngoname",$this->input->post("txt_ngoname")?$this->input->post("txt_ngoname"):""),
								  form_input("txt_ngoadd",$this->input->post("txt_ngoadd")?$this->input->post("txt_ngoadd"):""),
								  form_input("txt_ngocontact",$this->input->post("txt_ngocontact")?$this->input->post("txt_ngocontact"):""),
								  form_input("txt_ngourl",$this->input->post("txt_ngourl")?$this->input->post("txt_ngourl"):""),
								  form_input("txt_ngoemail",$this->input->post("txt_ngoemail")?$this->input->post("txt_ngoemail"):""),
								  form_input("txt_ngosdate",$this->input->post("txt_ngosdate")?$this->input->post("txt_ngosdate"):"","id='startPicker'"),
								  form_input("txt_ngoedate",$this->input->post("txt_ngoedate")?$this->input->post("txt_ngoedate"):"","id='endPicker'"),
								  form_textarea($text)
								  );
					$validate=array(
									form_error('txt_ngoname'),
									form_error('txt_ngoadd'),
									form_error('txt_ngocontact'),
									form_error('txt_ngourl'),
									form_error('txt_ngoemail'),
									'&nbsp;',
									'&nbsp;',
									'&nbsp;',
									);
					
					$num_column=1;
					$data="";
					for($i=0;$i<(count($labels));$i++){
						$data.=mgtable($labels[$i],array($inputs[$i].$validate[$i]=>"class='require'"));
						if(($i+1)%$num_column==0) {echo "<tr>".$data."</tr>"; $data="";}
					}
                    echo '<tr><td>&nbsp;</td>'.mgtable(array(form_submit("mySubmit","Save").anchor('ngo/manager',form_button("Cencel","Cencel"),"title='Cencel'")=>"colspan='". ($num_column*2)-1 ."'")).'</tr>';
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