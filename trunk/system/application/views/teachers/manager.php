<div class="task1">
    <div class="manager">
        <div class="heading">Teachers Management</div>
        <?php if($this->session->flashdata('success')) echo message($this->session->flashdata('success'),"success") ;?>
        <div class="search">
            <div class="search_input">
                <?php
                echo form_open("teachers/manager");
                ?>
                    Search by: Name
                <?php
                echo form_input($this->dbf->tea_name,($this->input->post($this->dbf->tea_name))?$this->input->post($this->dbf->tea_name):'');
                ?>
                <input type="submit" class="my_search" value="" />
                <?php
                echo form_close();
                ?>
            </div>
            <?php
                echo toolbar(array("type" => "new", "link" => "teachers/addnew", "text" => "Add new", "title" => "Add New"));
            ?>
            </div>
            <div class="mgTable">
                <table class="myTable" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                        <th>N&ordm;</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Position</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Action</th>
                    </tr>
                <?php
                if($teachers->num_rows() > 0){
                    

                    // loop link of teacher information
                    $i=0;
                    foreach ($teachers->result() as $tea) {
                        // create link button Edit and Delete
                        $js='onclick="return confirm(\'Are you sure want to delete this item?\')"';
                        $edit=anchor('teachers/edit/'.$tea->tea_id,img(array('src'=>'admin/images/menu/icon-16-edit2.png','alt'=>'Edit','title'=>'Edit')));
                        $delete=anchor('teachers/delete/'.$tea->tea_id,img(array('src'=>'admin/images/menu/icon-16-delete2.png','alt'=>'Delete','title'=>'Delete')),$js);
                        echo '<tr>';
                        echo '<td class="center">' . ++$i . '</td>';
                        echo '<td>' . $tea->tea_name . '</td>';
                        echo '<td>' . $tea->tea_sex . '</td>';
                        echo '<td>' . $tea->tea_position . '</td>';
                        echo '<td>' . $tea->tea_email . '</td>';
                        echo '<td>' . $tea->tea_phone . '</td>';
                        echo '<td class="center">' . $edit .  nbs(3) . $delete. '</td>';
                        echo '</tr>';
                    }
                }
                else{
                    echo '<tr class="center"><td class="red" colspan="7">Don\'t have any teacher.</td></tr>';
                }
                ?>

            </table>
        </div>
        <div class="pagenation">
            <?php echo $this->pagination->create_links(); ?>
        </div>
    </div>
</div>