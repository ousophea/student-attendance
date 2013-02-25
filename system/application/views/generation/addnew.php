<div class="task1">
	
	<fieldset>
    <legend align="center"><div class="heading">Add New Generation (Step 1)</div></legend>
    <?php  if($this->session->userdata('ms_error')){echo message($this->session->userdata('ms_error'),"error");$this->session->unset_userdata("ms_error");} ?>
    <div class="search">
    <?php echo toolbar(array("type"=>"cancel","link"=>"generation/manager","text"=>"Cencel","title"=>"Cencel"));?>
    </div>
    <div class="addnew"><br />
    <?php echo form_open("generation/addnew");?>
        <table width="700" align="center" id="myTable">
            
                <?php
					$text=array(
								'name'=>'txt_gendes',
								'cols'=>20,
								'rows'=>5,
								'value'=>$this->input->post("txt_gendes")?$this->input->post("txt_gendes"):"",
								);
					$req='<span class="require">*</span>';
					$labels=array(
								  "Year".$req,
								  "Number of Term".$req,
								  "Discription",
								  );
					$inputs=array(
								  form_input("txt_genyear",$this->input->post("txt_genyear")?$this->input->post("txt_genyear"):""),
								  form_input("txt_gennumterm",$this->input->post("txt_gennumterm")?$this->input->post("txt_gennumterm"):""),
								  form_textarea($text)
								  );
					$validate=array(
									form_error('txt_genyear'),
									form_error('txt_gennumterm'),
									form_error('txt_gendes'),
									);
					
					$num_column=1;
					$data="";
					for($i=0;$i<(count($labels));$i++){
						$data.=mgtable(array($labels[$i]=>'valign="top"'),array($inputs[$i].$validate[$i]=>"class='require'"));
						if(($i+1)%$num_column==0) {echo "<tr>".$data."</tr>"; $data="";}
					}
                    echo '<tr><td>&nbsp;</td>'.mgtable(array(form_submit("mySubmit","Next").anchor('generation/manager',form_button("Cencel","Cencel"),"title='Cencel'")=>"colspan='". ($num_column*2)-1 ."'")).'</tr>';
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