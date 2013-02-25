<div class="task1">
	
	<fieldset>
    <legend align="center"><div class="heading">Add New Generation (Step 2)</div></legend>
    <?php  if($this->session->userdata('ms_error')){echo message($this->session->userdata('ms_error'),"error");$this->session->unset_userdata("ms_error");} ?>
    <div class="search">
    <?php echo toolbar(array("type"=>"cancel","link"=>"generation/manager","text"=>"Cencel","title"=>"Cencel"));?>
    </div>
    <div class="addnew"><br />
    <?php echo form_open("generation/addnew1");?>
        <table width="800" align="center" id="myTable">
            
                <?php
					$num=$this->session->userdata('gen_numterm');
					for($j=1;$j<=$num;$j++){
						$req='<span class="require">*</span>';
						$labels=array(
									  //"Term Name".$req,
									  "Start Date ".$j.$req,
									  "End Date ".$j.$req,
									  );
						$inputs=array(
									  //form_input("txt_terName".$j,$this->input->post("txt_terName".$j)?$this->input->post("txt_terName".$j):"Term ".$j),
									  form_input("txt_terSDate".$j,$this->input->post("txt_terSDate".$j)?$this->input->post("txt_terSDate".$j):"",'class="datePicker"'),
									  form_input("txt_terEDate".$j,$this->input->post("txt_terEDate".$j)?$this->input->post("txt_terEDate".$j):"",'class="datePicker"'),
									  );
						$validate=array(
										//form_error('txt_terName'.$j),
										form_error('txt_terSDate'.$j),
										form_error('txt_terEDate'.$j),
										);
						$num_column=2;
						$data="";
						for($i=0;$i<(count($labels));$i++){
							$data.=mgtable(array($labels[$i]=>'valign="top" width="90"'),array($inputs[$i].$validate[$i]=>"class='require'"));
							
							if(($i+1)%$num_column==0) {echo "<tr>".$data."</tr>"; $data="";}
						}
					}
                    echo '<tr><td>&nbsp;</td>'.mgtable(array(form_submit("mySubmit","Save").anchor('generation/manager',form_button("Cencel","Cencel"),"title='Cencel'")=>"colspan='". ($num_column*2)-1 ."'")).'</tr>';
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