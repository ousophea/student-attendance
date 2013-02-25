<div class="task1">
    <div class="manager">
        <div class="heading">Classes Management</div>
        <?php if($this->session->flashdata('success')) echo message($this->session->flashdata('success'),"success") ;?>
        <div class="search">
            <div class="search_input">
                <?php
                echo form_open("classes/manager");
                $db = new Dbf();
                ?>
                    Search by: Name
                <?php
                echo form_input($this->dbf->cla_name,($this->input->post($this->dbf->cla_name))?$this->input->post($this->dbf->cla_name):'');
                ?>
                <input type="submit" class="my_search" value="" />
                <?php
                echo form_close();
                ?>
            </div>
            <?php
                echo toolbar(array("type" => "new", "link" => "classes/addnew", "text" => "Add new", "title" => "Add New"));
            ?>
            </div>
            <div class="mgTable">
                <table class="myTable" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                        <th>N&ordm;</th>
                        <th>Class name</th>
                        <th>Students number</th>
                        <th>Time</th>
                        <th>Age level</th>
                        <th>Generation</th>
                        <th>Assigned</th>
                        <th>Action</th>
                    </tr>
                <?php
                if($query->num_rows() > 0){
                    

                    // loop link of class information
                    $i=0;
                    foreach ($query->result() as $row) {
                        // create link button Edit and Delete
                        $js='onclick="return confirm(\'Are you sure want to delete this item?\')"';
                        $edit=anchor('classes/edit/'.$row->cla_id,img(array('src'=>'admin/images/menu/icon-16-edit2.png','alt'=>'Edit','title'=>'Edit')));
                        $delete=anchor('classes/delete/'.$row->cla_id,img(array('src'=>'admin/images/menu/icon-16-delete2.png','alt'=>'Delete','title'=>'Delete')),$js);
                        echo '<tr>';
                        echo '<td class="center">' . ++$i . '</td>';
                        echo '<td>' . $row->cla_name . '</td>';
                        echo '<td>' . $obj->count_students(array($db->cla_id=>$row->cla_id,$db->cla_gen_id=>$row->cla_gen_id)) . '</td>';
                        echo '<td>' . $row->cla_time . '</td>';
                        echo '<td>' . $row->cla_age_leval . '</td>';
                        echo '<td><span  title="'.$row->gen_description.'">' . $row->gen_year . '</span></td>';
                        
                        echo '<td>';
                        $teacher =$obj->get_teacher_assegned(array($this->dbf->cla_id=>$row->cla_id));
                        if($teacher->num_rows() > 0){
                            echo '<table style="border:0px;width:100%;">';
                            foreach ($teacher->result() as $r){
                                echo '<tr>';
                                echo '<td style="border:0px;">'.$r->tea_name.'</td>';
                                echo '<td style="border:0px; text-align:right;">'.  anchor('classes/remove_teacher/'.$row->cla_id.'/'.$r->tea_id,form_button(array('content'=>'Remove','class'=>'remove_teacher','value'=>$r->tea_id)),'onclick="return confirm(\'Are you sure want to remove teacher from this class?\')"').'</td>';
                                echo '</tr>';
                            }
                            echo '</table>';
                        }
                        else{
                            echo '<span class="error">No teacher assigned yet! </span>';
                        }
                        echo anchor('classes/assign/'.$row->cla_id,'Assign teacher?',array('class'=>'imgPopUp'));
                        echo '</td>';
                        echo '<td class="center">' . $edit .  nbs(3) . $delete. '</td>';
                        echo '</tr>';
                    }
                }
                else{
                    echo '<tr class="center"><td class="red" colspan="8">Don\'t have any class. </td></tr>';
                }
                ?>

            </table>
        </div>
        <div class="pagenation">
            <?php echo $this->pagination->create_links(); ?>
        </div>
    </div>
</div>