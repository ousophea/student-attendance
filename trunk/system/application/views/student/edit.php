<div class="task1">
	<fieldset>
    <legend align="center"><div class="heading">Edit Student</div></legend>
    <?php  if($this->session->userdata('ms_error')){echo message($this->session->userdata('ms_error'),"error");$this->session->unset_userdata("ms_error");} ?>
    <div class="search">
    <?php echo toolbar(array("type"=>"cancel","link"=>"student/manager","text"=>"Cencel","title"=>"Cencel"));?>
    </div>
    <div class="addnew"><br />
    <?php echo form_open_multipart("student/edit/".$con);
    	//loop to get one student to edit
		foreach($stu->result() as $row){
	?>
        <table width="800" align="center">
        	<tr><td rowspan="11" align="center" style="text-align:center;"><img src="<?php echo base_url(); ?>stu_photo/<?php echo $row->stu_photo;?>" alt="img" /></td></tr>
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
					foreach ($ngos->result() as $rows){
						$ngo[$rows->ngo_id]=$rows->ngo_name;
					}
					//classes
					$cla[' ']='--Select Class--';
					foreach($clas->result() as $rows){
						$cla[$rows->cla_id]=$rows->cla_name;
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
								  form_dropdown("dro_stuclaid",$cla,$this->input->post("dro_stuclaid")?$this->input->post("dro_stuclaid"):$row->stu_cla_id,"class='width150'"),
								  form_input("txt_stufirst",$this->input->post("txt_stufirst")?$this->input->post("txt_stufirst"):$row->stu_first_name),
								  form_input("txt_stulast",$this->input->post("txt_stulast")?$this->input->post("txt_stulast"):$row->stu_last_name),
								  form_input("txt_stukhmer",$this->input->post("txt_stukhmer")?$this->input->post("txt_stukhmer"):$row->stu_khmer_name),
								  form_dropdown("dro_stusex",$sex,$this->input->post("dro_stusex")?$this->input->post("dro_stusex"):$row->stu_sex,"class='width150'"),
								  form_input("txt_studob",$this->input->post("txt_studob")?$this->input->post("txt_studob"):$row->stu_dob,"class='datePicker'"),
								  form_input("txt_stuage",$this->input->post("txt_stuage")?$this->input->post("txt_stuage"):$row->stu_age),
								  form_upload("txt_photo"),
								  form_dropdown("dro_stungoid",$ngo,$this->input->post("dro_stungoid")?$this->input->post("dro_stungoid"):$row->stu_ngo_id,"class='width150'")
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
                    echo '<tr><td>&nbsp;</td>'.mgtable(array(form_submit("mySubmit","Update").anchor('student/manager',form_button("Cencel","Cencel"),"title='Cencel'")=>"colspan='". ($num_column*2)-1 ."'")).'</tr>';
					echo '<tr>'.mgtable(array('Note: All fields containt (<font color="red">*</font>) are required.'=>"colspan='". ($num_column*2)."'")).'</tr>';
				?>
        </table>
    <?php 
		}//end loop
		echo form_close();
	?>
    </div>
    </fieldset>
    <br />
</div>