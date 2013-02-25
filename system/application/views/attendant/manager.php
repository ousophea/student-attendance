<div class="task1">
	<div class="manager">
    <div class="heading">Attendant Management</div>
    <?php  
		if($this->session->userdata('ms_error')){echo message($this->session->userdata('ms_error'),"error"); $this->session->unset_userdata('ms_error');}
		else if($this->session->userdata('ms_success')){echo message($this->session->userdata('ms_success'),"success");$this->session->unset_userdata('ms_success');}
	?>
    	<div class="search">
        	<div class="search_input">
			</div>
        </div>
        <?php
			echo form_open('attendant/addAttendant');
			$req="<span class='required'>*</span>";
		?>
        <div class="mgTable">
            <table class="myTable" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <th align="center">N &deg;</th>
                <th>Generation</th>
                <th>Term</th>
                <th>Class</th>
              </tr>
                <tr>
                <?php
				$i=0;
				//edit
				
				if($all_cla->num_rows()>0){
					$att=array(
							   '1'=>'yes',
							   '0'=>'no',
							   );
					foreach($all_cla->result() as $row){
						$i++;
						echo "<tr class=row". $i%2 .">";
						//get class
						$cla='';
						foreach($obj->getClaInTer($row->gen_id, $row->ter_id)->result() as $cls){
							$add=anchor("attendant/addAtt/".$row->gen_id."/".$cls->cla_id."/".$row->ter_id,img("admin/images/menu/icon-16-new.png"),"title='Add Attendant for ".$cls->cla_name."'");
							$cla.=$cls->cla_name."<div style='text-align:right; width:20px; float:right;'> ".$add.'</div><br />';
						}
						//this function is in the mgpage file of helper folder
						echo mgtable(
									 array($i=>"align='center'"),
									 $row->gen_year,
									 $row->ter_name,
									 array($cla=>'width="300"')
									 );
						echo "</tr>";
					}
				}else echo mgtable(array("Result not found!"=>"colspan='8' align='center'"));
                ?>
                </tr>
            </table>
        </div>
        <?php 
		form_close();
		?>
        <div class="pagenation">
    		<?php echo $this->pagination->create_links(); ?>
    	</div>
    </div>
</div>