<div class="task1">
	<div class="manager">
    <div class="heading">Organizations Management</div>
    <?php  
		if($this->session->userdata('ms_error')){echo message($this->session->userdata('ms_error'),"error"); $this->session->unset_userdata('ms_error');}
		else if($this->session->userdata('ms_success')){echo message($this->session->userdata('ms_success'),"success");$this->session->unset_userdata('ms_success');}
	?>
    	<div class="search">
        	<div class="search_input">
            	<?php
					echo form_open("ngo/manager");
				?>
            	Search by: Name 
				<?php 
					echo form_input("txt_ngoname");  
				?>
                <input type="submit" class="my_search" value="" />
                <?php
					echo form_close();
				?>
            </div>
        	<?php
				echo toolbar(array("type"=>"new","link"=>"ngo/addnew","text"=>"New NGO","title"=>"Add New"));
			?>
        </div>
    	<div class="mgTable">
            <table class="myTable" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <th align="center">N &deg;</th>
                <th>ID</th>
                <th>Name</th>
                <th>Address</th>
                <th>Contact Person</th>
                <th>Url</th>
                <th>Email</th>
                <th>Start</th>
                <th>End</th>
                <th>Description</th>
                <th>Action</th>
              </tr>
                <tr>
                <?php
				$i=0;
				if($all_ngo->num_rows()>0){
					foreach($all_ngo->result() as $row){
						$i++;
						$edit=anchor("ngo/edit/".$row->ngo_id,img("admin/images/menu/icon-16-edit2.png"),"title=Edit");
						$delete="&nbsp;&nbsp;&nbsp;&nbsp;".anchor("ngo/delete/".$row->ngo_id,img("admin/images/menu/icon-16-delete2.png"),'title=Delete onclick="return confirm(\'Are you sure you want to delete?\')"');
						
						echo "<tr class=row". $i%2 .">";
						//substring
						$dis=strlen($row->ngo_description)>100?substr_replace($row->ngo_description,'...',100):$row->ngo_description;
						//this function is in the mgpage file of helper folder
						echo mgtable(
									 array($i=>"align='center'"),
									 $row->ngo_id,
									 $row->ngo_name,
									 $row->ngo_address,
									 $row->ngo_contact_person,
									 $row->ngo_url,
									 $row->ngo_email,
									 $row->ngo_sdate,
									 $row->ngo_edate,
									 $dis,
									 array($edit.$delete=>"align='center'")
									 );
						echo "</tr>";
					}
				}else echo mgtable(array("Result not found!"=>"colspan='9' align='center'"));
                ?>
                </tr>
            </table>
        </div>
        <div class="pagenation">
    		<?php echo $this->pagination->create_links(); ?>
    	</div>
    </div>
</div>