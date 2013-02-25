<div class="task1">
    <div class="manager">
        <div class="heading"><?php echo ($this->uri->segment(3) != 'reports') ? 'Scores Management' : 'Report management'; ?></div>
        <?php if ($this->session->flashdata('success'))
            echo message($this->session->flashdata('success'), "success"); ?>
        <div class="search">
            <div class="search_input">
                <?php
		$db = new Dbf();
if(0){// not completed yet
                echo form_open("classes/manager");
                
                ?>
                Search by: Name
                <?php
                echo form_input($this->dbf->cla_name, ($this->input->post($this->dbf->cla_name)) ? $this->input->post($this->dbf->cla_name) : '');
                ?>
                <input type="submit" class="my_search" value="" />
                <?php
                echo form_close();
}
                ?>
            </div>
            <?php
                // echo toolbar(array("type" => "new", "link" => "classes/input_score", "text" => "Add new", "title" => "Add New"));
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
                        <th>Terms</th>
                    </tr>
                <?php
                if ($query->num_rows() > 0) {


                    // loop link of class information
                    $i = 0;
                    foreach ($query->result() as $row) {
                        // create link button Edit and Delete
                        $js = 'onclick="return confirm(\'Are you sure want to delete this item?\')"';
                        $edit = anchor('classes/edit/' . $row->cla_id, img(array('src' => 'admin/images/menu/icon-16-edit2.png', 'alt' => 'Edit', 'title' => 'Edit')));
                        $delete = anchor('classes/delete/' . $row->cla_id, img(array('src' => 'admin/images/menu/icon-16-delete2.png', 'alt' => 'Delete', 'title' => 'Delete')), $js);
                        echo '<tr>';
                        echo '<td class="center">' . ++$i . '</td>';
                        echo '<td>' . $row->cla_name . '</td>';
                        echo '<td>' . $obj->count_students(array($db->cla_id => $row->cla_id, $db->cla_gen_id => $row->cla_gen_id)) . '</td>';
                        echo '<td>' . $row->cla_time . '</td>';
                        echo '<td>' . $row->cla_age_leval . '</td>';
                        echo '<td><span  title="' . $row->gen_description . '">' . $row->gen_year . '</span></td>';

                        echo '<td>';
                        $this->db->where($db->ter_gen_id, $row->cla_gen_id);
                        $gens = $this->db->get($db->tbl_terms);
                        if ($gens->num_rows() > 0) {
                            echo '<table style="border:0px;width:100%;">';
                            foreach ($gens->result() as $r) {
                                echo '<tr>';
                                echo '<td style="border:0px">' . $r->ter_name . '</td>';
                                echo '<td style="border:0px;text-align:right;">';
                                $check_score = $obj->check_score(array($db->cla_id => $row->cla_id, $db->gen_id => $row->cla_gen_id, $db->ter_id => $r->ter_id))->num_rows();
                                if ($check_score < 1) {
                                    if ($this->uri->segment(3) != 'reports')
                                        echo anchor('scores/input_score/' . $row->cla_id . '/' . $row->cla_gen_id . '/' . $r->ter_id, 'Input score', 'class="input_score" title="Add score"');
                                }else {
                                    if ($this->uri->segment(3) != 'reports') {
                                        echo anchor('scores/remove_score/' . $row->cla_id . '/' . $row->cla_gen_id . '/' . $r->ter_id, 'Remove score', 'class="remove_score" title = "Remove score" onclick="return confirm(\'Are you sure wnat to deleted score of students in this generation, term and class?\')"');
                                        echo anchor('scores/edit_score/' . $row->cla_id . '/' . $row->cla_gen_id . '/' . $r->ter_id, 'Edit score', 'class="edit_score" title="Edit score"');
                                    }
                                    else
                                        echo anchor('scores/report/' . $row->cla_id . '/' . $row->cla_gen_id . '/' . $r->ter_id, 'View Report', 'class="report" title="View report"');
                                }
                                echo '</td>';
                                echo '</tr>';
                            }
                            echo '</table>';
                        }
                        else {
                            echo '<span class="error">No term to add score yet! </span>';
                        }
                        echo '</td>';
                        echo '</tr>';
                    }
                } else {
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