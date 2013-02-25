<div class="task1">
	<fieldset>
    <legend align="center"><div class="heading">Add New Student</div></legend>
    <?php  if($this->session->userdata('ms_error')){echo message($this->session->userdata('ms_error'),"error");$this->session->unset_userdata("ms_error");} ?>
    <div class="search">
    <?php echo toolbar(array("type"=>"cancel","link"=>"student/manager","text"=>"Cencel","title"=>"Cencel"));?>
    </div>
    <div class="addnew"><br />
    <?php echo form_open_multipart("student/addnew");?>
        <table width="700" align="center">
                <?php
					$req='<span class="require">*</span>';
					//sex
					$sex=array(
							   ' '=>'--Select Sex--',
							   'Male'=>'Male',
							   'Female'=>'Female'
							   );
					//ngo
					$ngo[' ']='--Select Ngo--';
					foreach ($ngos->result() as $row){
						$ngo[$row->ngo_id]=$row->ngo_name;
					}
					//classes
					$cla[' ']='--Select Class--';
					foreach($clas->result() as $row){
						$cla[$row->cla_id]=$row->cla_name;
					}
					//Label
					$labels=array(
								  "Class".$req,
								  "First Name".$req,
								  "Last Name".$req,
								  "Khmer Name".$req,
								  "Sex".$req,
								  "Date of Birth",
								  "Age".$req,
								  "Photo",
								  "NGO".$req,
								  );
					//input form
					$inputs=array(
								  form_dropdown("dro_stuclaid",$cla,$this->input->post("dro_stuclaid")?$this->input->post("dro_stuclaid"):" ","class='width150'"),
								  form_input("txt_stufirst",$this->input->post("txt_stufirst")?$this->input->post("txt_stufirst"):""),
								  form_input("txt_stulast",$this->input->post("txt_stulast")?$this->input->post("txt_stulast"):""),
								  form_input("txt_stukhmer",$this->input->post("txt_stukhmer")?$this->input->post("txt_stukhmer"):""),
								  form_dropdown("dro_stusex",$sex,$this->input->post("dro_stusex")?$this->input->post("dro_stusex"):" ","class='width150'"),
								  form_input("txt_studob",$this->input->post("txt_studob")?$this->input->post("txt_studob"):"","class='datePicker'"),
								  form_input("txt_stuage",$this->input->post("txt_stuage")?$this->input->post("txt_stuage"):""),
								  form_upload("txt_photo"),
								  form_dropdown("dro_stungoid",$ngo,$this->input->post("dro_stungoid")?$this->input->post("dro_stungoid"):" ","class='width150'")
								  );
					//validation
					$validate=array(
									form_error('dro_stuclaid'),
									form_error('txt_stufirst'),
									form_error('txt_stulast'),
									form_error('txt_stukhmer'),
									form_error('dro_stusex'),
									'&nbsp;',
									form_error('txt_stuage'),
									form_error('txt_photo'),
									form_error('dro_stungoid')
									);
					//generate field
					$num_column=1;
					$data="";
					for($i=0;$i<(count($labels));$i++){
						$data.=mgtable($labels[$i],array($inputs[$i].$validate[$i]=>"class='require'"));
						if(($i+1)%$num_column==0) {echo "<tr>".$data."</tr>"; $data="";}
					}
                    echo '<tr><td>&nbsp;</td>'.mgtable(array(form_submit("mySubmit","Save").anchor('student/manager',form_button("Cencel","Cencel"),"title='Cencel'")=>"colspan='". ($num_column*2)-1 ."'")).'</tr>';
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