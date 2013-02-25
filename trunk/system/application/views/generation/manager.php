<div class="task1">
	<div class="manager">
    <div class="heading">Generation Management</div>
    <?php  
		if($this->session->userdata('ms_error')){echo message($this->session->userdata('ms_error'),"error"); $this->session->unset_userdata('ms_error');}
		else if($this->session->userdata('ms_success')){echo message($this->session->userdata('ms_success'),"success");$this->session->unset_userdata('ms_success');}
	?>
    	<div class="search">
        	<div class="search_input">
            	<?php
					echo form_open("generation/manager");
				?>
            	Search by: Generation 
				<?php 
					echo form_input("txt_search1");  
				?>
                <input type="submit" class="my_search" value="" />
                <?php
					echo form_close();
				?>
            </div>
        	<?php
				echo toolbar(array("type"=>"new","link"=>"generation/addnew","text"=>"Add New","title"=>"Add New Generation"));
			?>
        </div>
    	<div class="mgTable">
            <table class="myTable" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <th align="center">N &deg;</th>
                <th>Generation</th>
                <th>Number of Term</th>
                <th colspan="2" width="30">Term</th>
                <th>Description</th>
                <th>Action</th>
              </tr>
                <tr>
                <?php
				$i=0;
				$allRow=$all_gen->num_rows();
				if($allRow>0){
					foreach($all_gen->result() as $row){
						$i++;
						//for generation
						$edit=anchor("generation/edit/".$row->gen_id,img("admin/images/menu/icon-16-edit2.png"),"title=Edit");
						$delete="&nbsp;&nbsp;&nbsp;&nbsp;".anchor("generation/delete/".$row->gen_id,img("admin/images/menu/icon-16-delete2.png"),'title=Delete onclick="return confirm(\'Are you sure you want to delete?\')"');
						echo "<tr class=row". $i%2 .">";
						//substring
						$dis=strlen($row->gen_description)>100?substr_replace($row->gen_description,'...',100):$row->gen_description;
						//this function is in the mgpage file of helper folder
						 $dt="";
						 $add1="";
						 //number of term
						 $num=$obj->getTerm($row->gen_id)->num_rows();
						 $j=0;
						foreach($obj->getTerm($row->gen_id)->result() as $terms){
							$j++;
							$add1=anchor("generation/addTerm/".$terms->ter_id.'/'.$row->gen_id,img("admin/images/menu/icon-16-new.png"),"title='Add new term'");
							//for term
							$edit1=anchor("generation/editTerm/".$terms->ter_id.'/'.$row->gen_id,img("admin/images/12x12/icon-12-edit.png"),"title=Edit");
							$j==$num?$delete1="&nbsp;&nbsp;&nbsp;&nbsp;".anchor("generation/deleteTerm/".$terms->ter_id,img("admin/images/12x12/icon-12-delete.png"),'title=Delete onclick="return confirm(\'Are you sure you want to delete?\')"'):$delete1='';
							$dt.=$terms->ter_name." (".date('M d, Y',strtotime($terms->ter_start_date)).' - '.date('M d, Y',strtotime($terms->ter_end_date)).")&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$edit1.$delete1."<br />";
						
						}
						echo mgtable(
									 array($i=>"align='center'"),
									 $row->gen_year,
									 $num,
									 array($dt=>'style="border-right:none;"'),
									 $add1,
									 $row->gen_description,
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