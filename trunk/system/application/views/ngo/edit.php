<div class="task1">
	<fieldset>
    <legend align="center"><div class="heading">Edit Organization</div></legend>
    <?php  if($this->session->userdata('ms_error')) echo message($this->session->userdata('ms_error'),"error"); $this->session->unset_userdata('ms_error');?>
    <div class="search">
    <?php echo toolbar(array("type"=>"cancel","link"=>"ngo/manager","text"=>"Cencel","title"=>"Cencel"));?>
    </div>
    <div class="addnew"><br />
    <?php echo form_open("ngo/edit");?>
    	<input type="hidden" value="<?php echo $this->session->userdata("condition");?>" name="ngo_id" />
        <table width="700" align="center">
            	
                <?php
				foreach($oneNgo->result() as $row){
					$text=array(
								'name'=>'txt_ngodes',
								'cols'=>20,
								'rows'=>5,
								'value'=>$this->input->post("txt_ngodes")?$this->input->post("txt_ngodes"):$row->ngo_description,
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
								  form_input("txt_ngoname",$this->input->post("txt_ngoname")?$this->input->post("txt_ngoname"):$row->ngo_name),
								  form_input("txt_ngoadd",$this->input->post("txt_ngoadd")?$this->input->post("txt_ngoadd"):$row->ngo_address),
								  form_input("txt_ngocontact",$this->input->post("txt_ngocontact")?$this->input->post("txt_ngocontact"):$row->ngo_contact_person),
								  form_input("txt_ngourl",$this->input->post("txt_ngourl")?$this->input->post("txt_ngourl"):$row->ngo_url),
								  form_input("txt_ngoemail",$this->input->post("txt_ngoemail")?$this->input->post("txt_ngoemail"):$row->ngo_email),
								  form_input("txt_ngosdate",$this->input->post("txt_ngosdate")?$this->input->post("txt_ngosdate"):$row->ngo_sdate,"id='startPicker'"),
								  form_input("txt_ngoedate",$this->input->post("txt_ngoedate")?$this->input->post("txt_ngoedate"):$row->ngo_edate,"id='endPicker'"),
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
                    echo '<tr><td>&nbsp;</td>'.mgtable(array(form_submit("mySubmit","Update").anchor('ngo/manager',form_button("Cencel","Cencel"),"title='Cencel'")=>"colspan='". ($num_column*2)-2 ."'")).'</tr>';
					echo '<tr>'.mgtable(array('Note: All fields containt (<font color="red">*</font>) are required.'=>"colspan='". ($num_column*2)."'")).'</tr>';
				}
                ?>
        </table>
    <?php 
		echo form_close();
	?>
    </div>
    </fieldset>
    <br />
</div>