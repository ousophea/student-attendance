<div class="task1">
    <div class="form-wrapper">
        <?php
        $cla_id = $this->uri->segment(3);
        $gen_id = $this->uri->segment(4);
        $ter_id = $this->uri->segment(5);
        echo form_open('scores/report/' . $cla_id . '/' . $gen_id . '/' . $ter_id);
        echo form_hidden('style1', base_url() . 'admin/css/template.css');
        echo form_hidden('style2', base_url() . 'admin/css/textbig.css');
        echo '<fieldset>';
        echo '<legend align="center"><div class="heading">View report</div></legend>';

        $img = array(
            'src' => 'admin/images/logo.gif',
            'titl' => 'Yoga logo',
            'alt' => 'Logo'
        );
        echo img($img) . nbs(3);
        $db = new Dbf();
        if ($students->num_rows() > 0) {
            echo '<div id="print_report">';
            echo '<table cellpadding="2" border="1" style="font-size:12px;width:100%;border-collapse:collapse;border-color:#ccc;" class="tbl_scores">';
            foreach ($students->result_array() as $r) {
                echo '<tr>';
                echo '<th colspan="5">Registeration Details:</th>';
                echo '<th>Year</th>';
                echo '<th>' . $r[$db->gen_year] . '</th>';
                echo '<th>Term</th>';
                echo '<th>' . $r[$db->ter_name] . '</th>';
                echo '<th>Start date</th>';
                echo '<th colspan="2">' . $r[$db->ter_start_date] . '</th>';
                echo '<th>Finish date</th>';
                echo '<th colspan="2">' . $r[$db->ter_end_date] . '</th>';
                echo '<th>N. classes</th>';
                $this->db->where($db->cla_gen_id, $r[$db->cla_gen_id]);
                echo '<th>' . $this->db->get($db->tbl_classes)->num_rows() . '</th>';
                echo '</tr>';
                //================================
                echo '<tr>';
                echo '<th colspan="2" rowspan="2">Organization</th>';
                echo '<th colspan="3" rowspan="2">' . $r[$db->ngo_name] . '</th>';
                echo '<th>Grade</th>';
                echo '<th>' . $r[$db->cla_name] . '</th>';
                echo '<th>Age</th>';
                echo '<th>' . $r[$db->cla_age_leval] . '</th>';
                echo '<th>Time</th>';
                echo '<th colspan="2">' . $r[$db->cla_time] . '</th>';
                echo '<th>Teacher(s)</th>';
                $teacher = $obj->get_teacher_assegned(array($db->cla_id => $r[$db->cla_id]));
                echo '<th colspan="4">';
                $j = 0;
                foreach ($teacher->result_array() as $t) {
                    echo ($j == 0) ? $t[$db->tea_name] : ', ' . $t[$db->tea_name];
                    $j = 1;
                }
                echo '</th>';
                echo '</tr>';
                //================================
                echo '<tr>';
                echo '<th></th>';
                echo '<th colspan="2">Attendance</th>';
                echo '<th colspan="4">Assesment</th>';
                echo '<th colspan="5">Are there any comcerns about behavior? If so:</th>';
                echo '</tr>';
                //================================
                break;
            }

            echo '<tr>';
            echo '<th>N&ordm;</th>';
            echo '<th>Family name</th>';
            echo '<th>Given name</th>';
            echo '<th>Sex</th>';
            echo '<th>D.O.B</th>';
            echo '<th>Age</th>';
            echo '<th>Attended</th>';
            echo '<th>Absent</th>';
            echo '<th>Effort</th>';
            echo '<th>P+E</th>';
            echo '<th>Progress</th>';
            echo '<th>Total score</th>';
            echo '<th>Unfocused</th>';
            echo '<th>Discruptive</th>';
            echo '<th>Withdrawn</th>';
            echo '<th>Improve</th>';
            echo '<th>Comment</th>';
            echo '</tr>';
            $i = 0;
            foreach ($students->result() as $row) {
                echo form_hidden($db->stu_id . $row->stu_id, $row->stu_id);
                $i++;
                echo '<tr>';
                echo '<td>' . $i . '</td>';
                echo '<td>' . $row->stu_first_name . '</td>';
                echo '<td>' . $row->stu_last_name . '</td>';
                echo '<td>' . $row->stu_sex . '</td>';
                echo '<td>' . date('d-M-y', strtotime($row->stu_dob)) . '</td>';
                $age = date('Y', strtotime($row->stu_dob));
                $age = date('Y') - $age;
                echo '<td>' . $age . '</td>';
                $atten = $obj->get_attendance(array($db->stu_id => $row->stu_id, $db->cla_id => $row->cla_id, $db->gen_id => $row->gen_id, $db->ter_id => $row->sco_ter_id));
                $attendance = explode('_', $atten);
                echo '<td>' . $attendance[0] . '</td>';
                echo '<td>' . $attendance[1] . '</td>';
                echo '<td>' . $row->sco_effort . '</span></td>';
                echo '<td>' . $row->sco_pe . '</span></td>';
                echo '<td>' . $row->sco_progress . '</span></td>';
                echo '<td>' . ($row->sco_effort + $row->sco_pe + $row->sco_progress) . '</span></td>';

                echo '<td>';
                echo ($row->sco_unfocused == 1) ? 'Yes' : 'No';
                echo '</td>';

                echo '<td>';
                echo ($row->sco_discruptive == 1) ? 'Yes' : 'No';
                echo '</td>';

                echo '<td>';
                echo ($row->sco_withdrawn == 1) ? 'Yes' : 'No';
                echo '</td>';

                echo '<td>';
                echo ($row->sco_improve == 1) ? 'Yes' : 'No';
                echo '</td>';

                echo '<td>';
                echo $row->sco_comment;
                echo '</td>';
                echo '</tr>';
            }
            echo '</table>';
            echo '<p>NataRaj Yoga Cambodia.<br />&copy; Isabelle Skaburskis 2010</p>';
            echo '</div>'; // End contain print

            echo '<div class="contain-submit" style="text-align:center;">';
            echo form_input(array('type' => 'button', 'class' => 'bprint', 'value' => 'Print PDF'));
            echo form_input(array('type' => 'button', 'class' => 'bprinte', 'value' => 'Print Excel', 'onclick' => "window.location.href='" . base_url() . "scores/print_report/" . $cla_id . '/' . $gen_id . '/' . $ter_id . "'"));
            echo form_input(array('type' => 'button', 'value' => 'Cancel', 'onclick' => "window.location.href='" . base_url() . "scores/manager/reports'"));
            echo '</div>';

            echo '</fieldset>';
        } else {
            echo "<p>Class $cla_id and term $ter_id don't have any students</p>";
        }
        ?>
    </div>
</div>


<?php
        if ($this->uri->segment(2) == 'print_report') {
            echo '<html>';
            echo '<head>';
            echo link_tag('admin/css/template.css');
            echo link_tag('admin/css/textbig.css');
            echo '</head><body>';

            $cla_id = $this->uri->segment(3);
            $gen_id = $this->uri->segment(4);
            $ter_id = $this->uri->segment(5);
            echo form_open('scores/report/' . $cla_id . '/' . $gen_id . '/' . $ter_id);
            echo form_hidden('style1', base_url() . 'admin/css/template.css');
            echo form_hidden('style2', base_url() . 'admin/css/textbig.css');
            $img = array(
                'src' => 'admin/images/logo.gif',
                'titl' => 'Yoga logo',
                'alt' => 'Logo'
            );

            $db = new Dbf();
            $c='';
            $t='';
            $g='';
            if ($students->num_rows() > 0) {
                echo '<table>';
                echo '<tr><th style="height:70px;">';
                echo img($img);
                echo '</th></tr>';
                echo '<tr>';
                echo '</table>';
                echo '<div id="print_report">';
                echo '<table cellpadding="2" border="1" style="font-size:12px;width:100%;border-collapse:collapse;border-color:#ccc;" class="tbl_scores">';
                foreach ($students->result_array() as $r) {
                    $cp= $r[$db->cla_name];
                    $tp = $r[$db->ter_name];
                    $gp = $r[$db->gen_year];
                    echo '<th colspan="5">Registeration Details:</th>';
                    echo '<th>Year</th>';
                    echo '<th>' . $r[$db->gen_year] . '</th>';
                    echo '<th>Term</th>';
                    echo '<th>' . $r[$db->ter_name] . '</th>';
                    echo '<th>Start date</th>';
                    echo '<th colspan="2">' . $r[$db->ter_start_date] . '</th>';
                    echo '<th>Finish date</th>';
                    echo '<th colspan="2">' . $r[$db->ter_end_date] . '</th>';
                    echo '<th>N. classes</th>';
                    $this->db->where($db->cla_gen_id, $r[$db->cla_gen_id]);
                    echo '<th>' . $this->db->get($db->tbl_classes)->num_rows() . '</th>';
                    echo '</tr>';
                    //================================
                    echo '<tr>';
                    echo '<th colspan="2" rowspan="2">Organization</th>';
                    echo '<th colspan="3" rowspan="2">' . $r[$db->ngo_name] . '</th>';
                    echo '<th>Grade</th>';
                    echo '<th>' . $r[$db->cla_name] . '</th>';
                    echo '<th>Age</th>';
                    echo '<th>' . $r[$db->cla_age_leval] . '</th>';
                    echo '<th>Time</th>';
                    echo '<th colspan="2">' . $r[$db->cla_time] . '</th>';
                    echo '<th>Teacher(s)</th>';
                    $teacher = $obj->get_teacher_assegned(array($db->cla_id => $r[$db->cla_id]));
                    echo '<th colspan="4">';
                    $j = 0;
                    foreach ($teacher->result_array() as $t) {
                        echo ($j == 0) ? $t[$db->tea_name] : ', ' . $t[$db->tea_name];
                        $j = 1;
                    }
                    echo '</th>';
                    echo '</tr>';
                    //================================
                    echo '<tr>';
                    echo '<th></th>';
                    echo '<th colspan="2">Attendance</th>';
                    echo '<th colspan="4">Assesment</th>';
                    echo '<th colspan="5">Are there any comcerns about behavior? If so:</th>';
                    echo '</tr>';
                    //================================
                    break;
                }

                echo '<tr>';
                echo '<th>N&ordm;</th>';
                echo '<th>Family name</th>';
                echo '<th>Given name</th>';
                echo '<th>Sex</th>';
                echo '<th>D.O.B</th>';
                echo '<th>Age</th>';
                echo '<th>Attended</th>';
                echo '<th>Absent</th>';
                echo '<th>Effort</th>';
                echo '<th>P+E</th>';
                echo '<th>Progress</th>';
                echo '<th>Total score</th>';
                echo '<th>Unfocused</th>';
                echo '<th>Discruptive</th>';
                echo '<th>Withdrawn</th>';
                echo '<th>Improve</th>';
                echo '<th>Comment</th>';
                echo '</tr>';
                $i = 0;
                foreach ($students->result() as $row) {
                    echo form_hidden($db->stu_id . $row->stu_id, $row->stu_id);
                    $i++;
                    echo '<tr>';
                    echo '<td>' . $i . '</td>';
                    echo '<td>' . $row->stu_first_name . '</td>';
                    echo '<td>' . $row->stu_last_name . '</td>';
                    echo '<td>' . $row->stu_sex . '</td>';
                    echo '<td>' . date('d-M-y', strtotime($row->stu_dob)) . '</td>';
                    $age = date('Y', strtotime($row->stu_dob));
                    $age = date('Y') - $age;
                    echo '<td>' . $age . '</td>';
                    $atten = $obj->get_attendance(array($db->stu_id => $row->stu_id, $db->cla_id => $row->cla_id, $db->gen_id => $row->gen_id, $db->ter_id => $row->sco_ter_id));
                    $attendance = explode('_', $atten);
                    echo '<td>' . $attendance[0] . '</td>';
                    echo '<td>' . $attendance[1] . '</td>';
                    echo '<td>' . $row->sco_effort . '</span></td>';
                    echo '<td>' . $row->sco_pe . '</span></td>';
                    echo '<td>' . $row->sco_progress . '</span></td>';
                    echo '<td>' . ($row->sco_effort + $row->sco_pe + $row->sco_progress) . '</span></td>';

                    echo '<td>';
                    echo ($row->sco_unfocused == 1) ? 'Yes' : 'No';
                    echo '</td>';

                    echo '<td>';
                    echo ($row->sco_discruptive == 1) ? 'Yes' : 'No';
                    echo '</td>';

                    echo '<td>';
                    echo ($row->sco_withdrawn == 1) ? 'Yes' : 'No';
                    echo '</td>';

                    echo '<td>';
                    echo ($row->sco_improve == 1) ? 'Yes' : 'No';
                    echo '</td>';

                    echo '<td>';
                    echo $row->sco_comment;
                    echo '</td>';
                    echo '</tr>';
                }
                echo '</table>';
                echo '<p style="font-size:11px;">NataRaj Yoga Cambodia.<br />&copy; Isabelle Skaburskis 2010</p>';
                echo '</div>'; // End contain print
            }

            header("Content-type: application/vnd.ms-excel; name='excel'");

            header("Content-Disposition: filename=report_scores.xls");
            // Fix for crappy IE bug in download.
            header("Pragma: ");
            header("Cache-Control: ");
            //echo $_REQUEST['datatodisplay'];
        }
        echo '</body></html>';
?>