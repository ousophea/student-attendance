<div class="task1">
	<div class="manager">
    <div class="heading">Student Management</div>
    <?php  
		if($this->session->userdata('ms_error')){echo message($this->session->userdata('ms_error'),"error"); $this->session->unset_userdata('ms_error');}
		else if($this->session->userdata('ms_success')){echo message($this->session->userdata('ms_success'),"success");$this->session->unset_userdata('ms_success');}
	?>
    	<div class="search">
        	<div class="search_input">
            	<?php
					echo form_open("student/manager");
				?>
            	Search by: Student Name 
				<?php 
					echo form_input("txt_stuName");
				?>
                 &nbsp; NGO Name
                <?php
					echo form_input("txt_ngoName");  
				?>
                 &nbsp; Class Name
                <?php
					echo form_input("txt_claName");  
				?>
                <input type="submit" class="my_search" value="" />
                <?php
					echo form_close();
				?>
            </div>
        	<?php
				echo toolbar(array("type"=>"new","link"=>"student/addnew","text"=>"New Student","title"=>"Add&nbsp;New"));
			?>
        </div>
    	<div class="mgTable">
            <table class="myTable" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <th align="center">N &deg;</th>
                <th>View</th>
                <th>Name(EN)</th>
                <th>Name(KH)</th>
                <th>Sex</th>
                <th>Date of Birth</th>
                <th>Age</th>
                <th>Class</th>
                <th>Ngo</th>
                <th>Action</th>
              </tr>
                <tr>
                <?php
				$i=0;
				if($all_ngo->num_rows()>0){
					foreach($all_ngo->result() as $row){
						$i++;
						$edit=anchor("student/edit/".$row->stu_id,img("admin/images/menu/icon-16-edit2.png"),"title=Edit");
						$delete="&nbsp;&nbsp;&nbsp;&nbsp;".anchor("student/delete/".$row->stu_id,img("admin/images/menu/icon-16-delete2.png"),'title=Delete onclick="return confirm(\'Are you sure you want to delete?\')"');
						
						echo "<tr class=row". $i%2 .">";
						//substring
						//$dis=strlen($row->ngo_description)>100?substr_replace($row->ngo_description,'...',100):$row->ngo_description;
						//this function is in the mgpage file of helper folder
						echo mgtable(array($i=>"align='center'"),anchor("stu_photo/".$row->stu_photo,"View Photo",'class="imgPopUp"'),$row->stu_last_name.' '.$row->stu_first_name,$row->stu_khmer_name,$row->stu_sex,$row->stu_dob,$row->stu_age,$row->cla_name,$row->ngo_name,array($edit.' &nbsp; '.$delete=>"align='center'"));
						echo "</tr>";
					}
				}else echo mgtable(array("Result not found!"=>"colspan='11' align='center'"));
                ?>
                </tr>
            </table>
        </div>
        <div class="pagenation">
    		<?php echo $this->pagination->create_links(); ?>
    	</div>
    </div>
</div>