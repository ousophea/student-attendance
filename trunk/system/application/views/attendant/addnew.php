<div class="task1">
	<div class="manager">
    <div class="heading"><?php 
		foreach($gens->result() as $gen){
			echo "Class:  ";
		}
		foreach($clas->result() as $cla){
			echo $cla->cla_name;
		}
		foreach($ters->result() as $ter){
			echo ", ".$ter->ter_name;
		}
		echo ', on '.$this->session->userdata('att_date');
		?>
   	</div>
    <?php  
		if($this->session->userdata('ms_error')){echo message($this->session->userdata('ms_error'),"error"); $this->session->unset_userdata('ms_error');}
		else if($this->session->userdata('ms_success')){echo message($this->session->userdata('ms_success'),"success");$this->session->unset_userdata('ms_success');}
	?>
    	<div class="search">
        	<div class="search_input">
			</div>
        </div>
        <?php
			echo form_open('attendant/addnew');
			echo form_submit("mySubmit",'Save Now').' '.anchor('attendant/manager',form_button("Cencel","Cencel"),"title='Cencel'");
			$req="<span class='required'>*</span>";
		?>
       <div class="mgTable">
            <table class="myTable" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <th align="center">N &deg;</th>
                <th>Name[EN]</th>
                <th>Name[KH]</th>
                <th>Sex</th>
                <th>NGO</th>
                <th>Attendant</th>
                <th>Description</th>
              </tr>
                <tr>
                <?php
				$i=0;
				//edit
				if($some_stu->num_rows()>0){
					echo form_hidden("hid",'edit');
					$att=array(
							   '1'=>'yes',
							   '0'=>'no',
							   );
					foreach($some_stu->result() as $row){
						$i++;
						//student id
						echo form_hidden('stu_id'.$i,$row->stu_id);
						$text=array(
								'name'=>'txt_attDes'.$i,
								'cols'=>30,
								'rows'=>1,
								'value'=>$this->input->post("txt_attDes".$i)?$this->input->post("txt_attDes".$i):$row->att_description,
								);
						$add=anchor("attendant/addAtt/".$row->gen_id."/".$row->cla_id."/".$row->ter_id,img("admin/images/menu/icon-16-new.png"),"title='Add Attendant'");
											
						echo "<tr class=row". $i%2 .">";
						//this function is in the mgpage file of helper folder
						echo mgtable(
									 array($i=>"align='center'"),
									 $row->stu_first_name.' '.$row->stu_last_name,
									 $row->stu_khmer_name,
									 $row->stu_sex,
									 $row->ngo_name,
									 array(form_radio('att'.$i,1,$row->att_attended).'Attendant &nbsp; '.form_radio('att'.$i,0,$row->att_absent).'Absent'=>'align="center"'),
									 array(form_textarea($text)=>'align="center"')
									 );
						echo "</tr>";
					}
				}
				//add
				else if($all_stu->num_rows()>0){
					echo form_hidden("hid",'add');
					$att=array(
							   '1'=>'yes',
							   '0'=>'no',
							   );
					foreach($all_stu->result() as $row){
						$i++;
						//student id
						echo form_hidden('stu_id'.$i,$row->stu_id);
						$text=array(
								'name'=>'txt_attDes'.$i,
								'cols'=>30,
								'rows'=>1,
								'value'=>$this->input->post("txt_attDes".$i)?$this->input->post("txt_attDes".$i):"",
								);
						$add=anchor("attendant/addAtt/".$row->gen_id."/".$row->cla_id."/".$row->ter_id,img("admin/images/menu/icon-16-new.png"),"title='Add Attendant'");
											
						echo "<tr class=row". $i%2 .">";
						//this function is in the mgpage file of helper folder
						echo mgtable(
									 array($i=>"align='center'"),
									 $row->stu_first_name.' '.$row->stu_last_name,
									 $row->stu_khmer_name,
									 $row->stu_sex,
									 $row->ngo_name,
									 array(form_radio('att'.$i,1).'Attendant &nbsp; '.form_radio('att'.$i,0,true).'Absent'=>'align="center"'),
									 array(form_textarea($text)=>'align="center"')
									 );
						echo "</tr>";
					}
				}
				else echo mgtable(array("Result not found!"=>"colspan='8' align='center'"));
                ?>
                </tr>
            </table>
        </div>
        <br />
        <?php 
		$this->session->set_userdata('num_stu',$i);
		echo form_submit("mySubmit",'Save Now').' '.anchor('attendant/manager',form_button("Cancel","Cancel"),"title='Cancel'");
		form_close();
		?>
        <div class="pagenation">
    		<?php echo $this->pagination->create_links(); ?>
    	</div>
    </div>
</div>