<div class="task1">
    <div class="form-wrapper">
        <?php
        $cla_id = $this->uri->segment(3);
        $gen_id = $this->uri->segment(4);
        $ter_id = $this->uri->segment(5);
        echo form_open('scores/input_score/'.$cla_id.'/'.$gen_id.'/'.$ter_id);
        echo '<fieldset>';
        echo '<legend align="center"><div class="heading">Input score for each students</div></legend>';
        if ($this->session->flashdata('error'))
            echo message($this->session->flashdata('error'), "error");
        //echo toolbar(array("type" => "cancel", "link" => "classes/manager", "text" => "Cencel", "title" => "Cencel"));
        echo '<br /><p>Note: required all fields<span class="error">*</span>, except comment fields are optional.</p>';
        $db = new Dbf();
        if ($students->num_rows() > 0) {
            echo form_hidden($db->sco_ter_id, $ter_id);
            echo '<table border="1" style="width:100%;border-collapse:collapse;border-color:#ccc;" class="tbl_scores">';
            echo '<tr>';
            echo '<th>Stuent name</th>';
            echo '<th>Photo</th>';
            echo '<th>Attended</th>';
            echo '<th>Absent</th>';
            echo '<th>Effort <br />(1-10)</th>';
            echo '<th title="Participate + Engage">P+E <br />(1-10)</th>';
            echo '<th>Progress <br />(1-10)</th>';
            echo '<th>Focused</th>';
            echo '<th>Discruptive</th>';
            echo '<th>Withdrawn</th>';
            echo '<th>Improvement</th>';
            echo '<th>Comment</th>';
            echo '</tr>';

            foreach ($students->result() as $row) {
                echo form_hidden($db->stu_id . $row->stu_id, $row->stu_id);
                echo '<tr>';
                $img = ($row->stu_photo=='')?'stu_photo/default.png':'stu_photo/'.$row->stu_photo;
                echo '<td>' . $row->stu_khmer_name. '</td>';
                echo '<td>' . anchor($img,img(array('src'=>$img,'alt'=>$row->stu_khmer_name,''=>$row->stu_khmer_name,'style'=>'width: 50px;')),'class="imgPopUp"') . '</td>';
                $atten = $obj->get_attendance(array($db->stu_id => $row->stu_id, $db->cla_id => $row->cla_id, $db->gen_id => $gen_id, $db->ter_id => $ter_id));
                $attendance = explode('_', $atten);
                echo '<td>' . $attendance[0] . '</td>';
                echo '<td>' . $attendance[1] . '</td>';
                echo '<td>' . form_input(array('maxlength'=>2,'id'=>'ef_'.$row->stu_id, 'name'=>$db->sco_effort . $row->stu_id,'value'=> ($this->input->post($db->sco_effort . $row->stu_id)) ? $this->input->post($db->sco_effort . $row->stu_id) : 0 ,'class'=>'score')) . '<span class="error">' . form_error($db->sco_effort . $row->stu_id) . '</span></td>';
                echo '<td>' . form_input(array('maxlength'=>2,'id'=>'pe_'.$row->stu_id, 'name'=>$db->sco_pe . $row->stu_id,'value'=> ($this->input->post($db->sco_pe . $row->stu_id)) ? $this->input->post($db->sco_pe . $row->stu_id) : 0 ,'class'=>'score')) . '<span class="error">' . form_error($db->sco_pe . $row->stu_id) . '</span></td>';
                echo '<td>' . form_input(array('maxlength'=>2,'id'=>'pro_'.$row->stu_id, 'name'=>$db->sco_progress . $row->stu_id,'value'=> ($this->input->post($db->sco_progress . $row->stu_id)) ? $this->input->post($db->sco_progress . $row->stu_id) : 0 ,'class'=>'score')) . '<span class="error">' . form_error($db->sco_progress . $row->stu_id) . '</span></td>';
                
                echo '<td>';
                $s1 = ($this->input->post($db->sco_unfocused . $row->stu_id)==1 && $this->input->post($db->sco_ter_id))? TRUE :FALSE;
                $s0 = ($this->input->post($db->sco_unfocused . $row->stu_id)==="0" && $this->input->post($db->sco_ter_id))? TRUE :FALSE;
                echo form_radio($db->sco_unfocused . $row->stu_id,1, $s1 ). ' Yes <br />';
                echo form_radio($db->sco_unfocused . $row->stu_id,"0", $s0) . ' No <span class="error">' . form_error($db->sco_unfocused . $row->stu_id) . '</span>';
//                echo form_radio($db->sco_unfocused . $row->stu_id,"0", ($this->input->post($db->sco_unfocused . $row->stu_id)==="0") ? $this->input->post($db->sco_unfocused . $row->stu_id) : $row->sco_unfocused) . '<span class="error">' . form_error($db->sco_unfocused . $row->stu_id) . '</span>';
                echo '</td>';

                echo '<td>';
                $s1 = ($this->input->post($db->sco_discruptive . $row->stu_id)==1)? TRUE :FALSE;
                $s0 = ($this->input->post($db->sco_discruptive . $row->stu_id)==="0")? TRUE :FALSE;
                echo form_radio($db->sco_discruptive . $row->stu_id,1, $s1) . ' Yes <br /> ';
                echo form_radio($db->sco_discruptive . $row->stu_id,"0", $s0) . ' No <span class="error">' . form_error($db->sco_discruptive . $row->stu_id) . '</span>';

                echo '</td>';
                echo '<td>';
                $s1 = ($this->input->post($db->sco_withdrawn . $row->stu_id)==1)? TRUE :FALSE;
                $s0 = ($this->input->post($db->sco_withdrawn . $row->stu_id)==="0")? TRUE :FALSE;
                echo form_radio($db->sco_withdrawn . $row->stu_id,1, $s1) . ' Yes <br />';
                echo form_radio($db->sco_withdrawn . $row->stu_id,"0", $s0) . ' No <span class="error">' . form_error($db->sco_withdrawn . $row->stu_id) . '</span>';
                echo '</td>';

                echo '<td>';
                $s1 = ($this->input->post($db->sco_improve . $row->stu_id)==1)? TRUE :FALSE;
                $s0 = ($this->input->post($db->sco_improve . $row->stu_id)==="0")? TRUE :FALSE;
                echo form_radio($db->sco_improve . $row->stu_id,1, $s1) . ' Yes <br />';
                echo form_radio($db->sco_improve . $row->stu_id,"0", $s0) . ' No <span class="error">' . form_error($db->sco_improve . $row->stu_id) . '</span>';
                echo '</td>';
                echo '<td>' . form_textarea(array('name'=>$db->sco_comment . $row->stu_id,'value'=> ($this->input->post($db->sco_comment . $row->stu_id)) ? $this->input->post($db->sco_comment . $row->stu_id) : '','rows'=>3,'cols'=>20)) . '<span class="error">' . form_error($db->sco_comment . $row->stu_id) . '</span></td>';
                echo '</tr>';
            }
            echo '</table>';
            echo '<div class="contain-submit" style="text-align:center;">';
            echo form_submit('submit', 'Save');
            echo form_input(array('type' => 'button', 'value' => 'Cancel', 'onclick' => "window.location.href='" . base_url() . "scores/manager'"));
            echo '</div>';
            echo '</fieldset>';
            echo form_close();
        } else {
            echo "<p>Class $cla_id and term $ter_id don't have any students</p>";
        }
        ?>
    </div>
</div>