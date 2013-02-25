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

        $db = new Dbf();
        if ($students->num_rows() > 0) {
            echo '<div id="print_report">';
            $img = array(
                'src' => 'admin/images/logo.gif',
                'titl' => 'Yoga logo',
                'alt' => 'Logo'
            );
            //--- Header
            echo '<table style="width: 100%;">';
            echo '<tr><th style="height:70px;">';
            echo img($img);
            echo '</th>';
            echo '<th style="text-align:right"><h3>Students assessment report</h3></th>';
            echo '</tr>';
            echo '</table>';
            //--------
            echo '<table cellpadding="2" border="1" style="font-size:12px;width:100%;border-collapse:collapse;border-color:#ccc;" class="tbl_scores">';
            $css_head = ' style="height: 30px;background-color: #C4D89C;"';
            foreach ($students->result_array() as $r) {
                echo '<tr>';
                echo '<th ' . $css_head . '  colspan="5">Registeration Details:</th>';
                echo '<th ' . $css_head . ' >Year</th>';
                echo '<th ' . $css_head . ' >' . $r[$db->gen_year] . '</th>';
                echo '<th ' . $css_head . ' >Term</th>';
                echo '<th ' . $css_head . ' >' . $r[$db->ter_name] . '</th>';
                echo '<th ' . $css_head . ' >Start date</th>';
                echo '<th ' . $css_head . '  colspan="2">' . $r[$db->ter_start_date] . '</th>';
                echo '<th ' . $css_head . ' >Finish date</th>';
                echo '<th ' . $css_head . '  colspan="2">' . $r[$db->ter_end_date] . '</th>';

                echo '<th>N. classes</th>';
                    //$this->db->where();
                    //$this->db->where($db->cla_gen_id, $r[$db->cla_gen_id]);
                    //$query_count = $obj->get_attendance(array($db->stu_id => $row->stu_id, $db->cla_id => $row->cla_id, $db->gen_id => $row->gen_id, $db->ter_id => $row->sco_ter_id));
                    //$num_couse = explode('_', $query_count);
                    //echo '<td  ' . $css. '>'.$num_couse[2] . '</td>';
                    //echo '<th>' . $this->db->get($db->tbl_classes)->num_rows() . '</th>';
                echo '<th>' . $obj->get_couse_number($ter_id,$cla_id) . '</th>';
                    //echo '<th>' . $num_couse[2]. '</th>';


                //echo '<th ' . $css_head . ' >N. classes</th>';
                //$this->db->where($db->cla_gen_id, $r[$db->cla_gen_id]);
                //echo '<th ' . $css_head . ' >' . $this->db->get($db->tbl_classes)->num_rows() . '</th>';
                echo '</tr>';
                //================================
                echo '<tr>';
                echo '<th ' . $css_head . '  colspan="2" rowspan="2">Organization</th>';
                echo '<th ' . $css_head . '  colspan="3" rowspan="2">' . $r[$db->ngo_name] . '</th>';
                echo '<th ' . $css_head . ' >Grade</th>';
                echo '<th ' . $css_head . ' >' . $r[$db->cla_name] . '</th>';
                echo '<th ' . $css_head . ' >Age</th>';
                echo '<th ' . $css_head . ' >' . $r[$db->cla_age_leval] . '</th>';
                echo '<th ' . $css_head . ' >Time</th>';
                echo '<th ' . $css_head . '  colspan="2">' . $r[$db->cla_time] . '</th>';
                echo '<th ' . $css_head . ' >Teacher(s)</th>';
                $teacher = $obj->get_teacher_assegned(array($db->cla_id => $r[$db->cla_id]));
                echo '<th ' . $css_head . '  colspan="4">';
                $j = 0;
                foreach ($teacher->result_array() as $t) {
                    echo ($j == 0) ? $t[$db->tea_name] : ', ' . $t[$db->tea_name];
                    $j = 1;
                }
                echo '</th>';
                echo '</tr>';
                //================================
                echo '<tr>';
                echo '<th ' . $css_head . ' ></th>';
                echo '<th ' . $css_head . '  colspan="2">Attendance</th>';
                echo '<th ' . $css_head . '  colspan="4">Assesment</th>';
                echo '<th ' . $css_head . '  colspan="5">Are there any comcerns about behavior? If so:</th>';
                echo '</tr>';
                //================================
                break;
            }

            echo '<tr>';
            echo '<th ' . $css_head . ' >N&ordm;</th>';
            echo '<th ' . $css_head . ' >Family name</th>';
            echo '<th ' . $css_head . ' >Given name</th>';
            echo '<th ' . $css_head . ' >Sex</th>';
            echo '<th ' . $css_head . ' >D.O.B</th>';
            echo '<th ' . $css_head . ' >Age</th>';
            echo '<th ' . $css_head . ' >Attended</th>';
            echo '<th ' . $css_head . ' >Absent</th>';
            echo '<th ' . $css_head . ' >Effort <br />(1-10)</th>';
            echo '<th ' . $css_head . ' title="Participate + Engage">P+E <br />(1-10)</th>';
            echo '<th ' . $css_head . ' >Progress <br />(1-10)</th>';
            echo '<th ' . $css_head . ' >Total score</th>';
            echo '<th ' . $css_head . ' >Focused</th>';
            echo '<th ' . $css_head . ' >Discruptive</th>';
            echo '<th ' . $css_head . ' >Withdrawn</th>';
            echo '<th ' . $css_head . ' >Improvement</th>';
            echo '<th ' . $css_head . ' >Comment</th>';
            echo '</tr>';
            $i = 0;
            $num_rows = $students->num_rows();
            foreach ($students->result() as $row) {
                $total_array[$row->stu_id] = $row->total;
                $i++;

                // mark color red or green
                if ($num_rows > 10) {
                    if ($i <= 5)
                        $css = 'style="color: green;font-weight: bold;"';
                    else if ($i > ($num_rows - 5) && $i <= $num_rows)
                        $css = 'style="color: red;font-weight: bold;"';
                    else
                        $css = '';
                }
                else
                    $css = '';
                ///--------------------
                echo form_hidden($db->stu_id . $row->stu_id, $row->stu_id);

                echo '<tr>';
                echo '<td  ' . $css . '>' . $i . '</td>';
                echo '<td  ' . $css . '>' . $row->stu_first_name . '</td>';
                echo '<td  ' . $css . '>' . $row->stu_last_name . '</td>';
                echo '<td  ' . $css . '>' . $row->stu_sex . '</td>';
                echo '<td  ' . $css . '>' . date('d-M-y', strtotime($row->stu_dob)) . '</td>';
                $age = date('Y', strtotime($row->stu_dob));
                $age = date('Y') - $age;
                echo '<td  ' . $css . '>' . $age . '</td>';
                $atten = $obj->get_attendance(array($db->stu_id => $row->stu_id, $db->cla_id => $row->cla_id, $db->gen_id => $row->gen_id, $db->ter_id => $row->sco_ter_id));
                $attendance = explode('_', $atten);
                echo '<td  ' . $css . '>' . $attendance[0] . '</td>';
                echo '<td  ' . $css . '>' . $attendance[1] . '</td>';
                echo '<td  ' . $css . '>' . $row->sco_effort . '</span></td>';
                echo '<td  ' . $css . '>' . $row->sco_pe . '</span></td>';
                echo '<td  ' . $css . '>' . $row->sco_progress . '</span></td>';
                echo '<td  ' . $css . '>' . ($row->total) . '</span></td>';

                echo '<td  ' . $css . '>';
                echo ($row->sco_unfocused == 1) ? 'Yes' : (($row->sco_unfocused == 0) ? 'No' : '');
                echo '</td>';

                echo '<td  ' . $css . '>';
                echo ($row->sco_discruptive == 1) ? 'Yes' : (($row->sco_discruptive == 0) ? 'No' : '');
                echo '</td>';

                echo '<td  ' . $css . '>';
                echo ($row->sco_withdrawn == 1) ? 'Yes' : (($row->sco_withdrawn == 0) ? 'No' : '');
                echo '</td>';

                echo '<td  ' . $css . '>';
                echo ($row->sco_improve == 1) ? 'Yes' : (($row->sco_improve == 0) ? 'No' : '');
                echo '</td>';

                echo '<td  ' . $css . '>';
                echo $row->sco_comment;
                echo '</td>';
                echo '</tr>';
            }
            echo '</table>';

            echo '<div style="margin-top:10px;">';
            if ($num_rows > 0) {
                echo '<table  class="tbl_scores" cellpadding="2" border="0" style="float:right;font-weight: bold;font-size:12px;width:100%;border-collapse:collapse;border-color:#ccc;">';
                echo '<tr>';
                echo '<td colspan="14" style="width: 75%;border:0px !important;">NataRaj Yoga Cambodia</td>';
                echo '<td colspan="2" style="width:150px">Maximum total score</td>';
                echo '<td style="width:50px;">' . max($total_array) . '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td colspan="14"  style="border:0px;">&copy; Isabelle Skaburskis 2010</td>';
                echo '<td colspan="2">Minimum total score</td>';
                echo '<td>' . min($total_array) . '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td colspan="14"  style="border:0px;"></td>';
                echo '<td colspan="2">Average total score</td>';
                echo '<td>' . round(array_sum($total_array) / count($total_array), 2) . '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td colspan="16"  style="border:0px;"><u>Note:</u>
                    <br />1. Effort is the score of each sudent who efforted in class, from 0 to 10
                    <br />2. P+E: Participation + Engage is score of eacher student who participated and engaged in class,rank from 0 to 10
                    <br />3. Progress is the score of each student who progress in class, rank from 0 to 10
                    </td>';
                echo '</tr>';
                echo '</table>';
            }
            echo '</div>';
            echo '<div class="clr"></div>';
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
// print
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
    $db = new Dbf();
    $c = '';
    $t = '';
    $g = '';
    if ($students->num_rows() > 0) {
        echo '<div id="print_report">';
        $img = array(
            'src' => 'admin/images/logo.gif',
            'titl' => 'Yoga logo',
            'alt' => 'Logo'
        );
//                echo '<table>';
//                echo '<tr><th style="height:70px;">';
//                echo img($img);
//                echo '</th></tr>';
//                echo '</table>';
        //--- Header
        echo '<table style="width: 100%;">';
        echo '<tr><th style="height:70px;">';
        echo img($img);
        echo '</th>';
        echo '<th colspan="16" style="text-align:right"><h3>Students assessment report</h3></th>';
        echo '</tr>';
        echo '</table>';
        //--------

        echo '<table cellpadding="2" border="1" style="font-size:12px;width:100%;border-collapse:collapse;border-color:#ccc;" class="tbl_scores">';
        foreach ($students->result_array() as $r) {
            $cp = $r[$db->cla_name];
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
            //echo '<th>N. classes</th>';
            //$this->db->where();
            //$this->db->where($db->cla_gen_id, $r[$db->cla_gen_id]);
            //$query_count = $obj->get_attendance(array($db->stu_id => $row->stu_id, $db->cla_id => $row->cla_id, $db->gen_id => $row->gen_id, $db->ter_id => $row->sco_ter_id));
            //$num_couse = explode('_', $query_count);
            //echo '<td  ' . $css. '>'.$num_couse[2] . '</td>';
            //echo '<th>' . $this->db->get($db->tbl_classes)->num_rows() . '</th>';
            //echo '<th>' . $obj->db->get_couse_number($db->cla_gen_id, $r[$db->cla_gen_id]) . '</th>';
            //echo '<th>' . $num_couse[2]. '</th>';
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
        echo '<th>Effort (1-10)</th>';
        echo '<th>P+E (1-10)</th>';
        echo '<th>Progress (1-10)</th>';
        echo '<th>Total score</th>';
        echo '<th>Focused</th>';
        echo '<th>Discruptive</th>';
        echo '<th>Withdrawn</th>';
        echo '<th>Improvement</th>';
        echo '<th>Comment</th>';
        echo '</tr>';
        $i = 0;
        foreach ($students->result() as $row) {
            $total_array[$row->stu_id] = $row->total;
            $i++;

            // mark color red or green
            if ($num_rows > 10) {
                if ($i <= 5)
                    $css = 'style="color: green;font-weight: bold;"';
                else if ($i > ($num_rows - 5) && $i <= $num_rows)
                    $css = 'style="color: red;font-weight: bold;"';
                else
                    $css = '';
            }
            else
                $css = '';
            ///--------------------
            echo form_hidden($db->stu_id . $row->stu_id, $row->stu_id);
            echo '<tr>';
            echo '<td  ' . $css . '>' . $i . '</td>';
            echo '<td  ' . $css . '>' . $row->stu_first_name . '</td>';
            echo '<td  ' . $css . '>' . $row->stu_last_name . '</td>';
            echo '<td  ' . $css . '>' . $row->stu_sex . '</td>';
            echo '<td  ' . $css . '>' . date('d-M-y', strtotime($row->stu_dob)) . '</td>';
            $age = date('Y', strtotime($row->stu_dob));
            $age = date('Y') - $age;
            echo '<td  ' . $css . '>' . $age . '</td>';
            $atten = $obj->get_attendance(array($db->stu_id => $row->stu_id, $db->cla_id => $row->cla_id, $db->gen_id => $row->gen_id, $db->ter_id => $row->sco_ter_id));
            $attendance = explode('_', $atten);
            echo '<td  ' . $css . '>' . $attendance[0] . '</td>';
            echo '<td  ' . $css . '>' . $attendance[1] . '</td>';
            echo '<td  ' . $css . '>' . $row->sco_effort . '</span></td>';
            echo '<td  ' . $css . '>' . $row->sco_pe . '</span></td>';
            echo '<td  ' . $css . '>' . $row->sco_progress . '</span></td>';
            echo '<td  ' . $css . '>' . ($row->sco_effort + $row->sco_pe + $row->sco_progress) . '</span></td>';

            echo '<td  ' . $css . '>';
            echo ($row->sco_unfocused == 1) ? 'Yes' : (($row->sco_unfocused == 0) ? 'No' : '');
            echo '</td>';

            echo '<td  ' . $css . '>';
            echo ($row->sco_discruptive == 1) ? 'Yes' : (($row->sco_discruptive == 0) ? 'No' : '');
            echo '</td>';

            echo '<td  ' . $css . '>';
            echo ($row->sco_withdrawn == 1) ? 'Yes' : (($row->sco_withdrawn == 0) ? 'No' : '');
            echo '</td>';

            echo '<td  ' . $css . '>';
            echo ($row->sco_improve == 1) ? 'Yes' : (($row->sco_improve == 0) ? 'No' : '');
            echo '</td>';

            echo '<td  ' . $css . '>';
            echo $row->sco_comment;
            echo '</td>';
            echo '</tr>';
        }
        echo '</table>';
        echo '<div style="margin-top:10px;">';
        if ($num_rows > 0) {
            echo '<table  class="tbl_scores" cellpadding="2" border="0" style="float:right;font-weight: bold;font-size:12px;width:100%;border-collapse:collapse;border-color:#ccc;">';
            echo '<tr>';
            echo '<td colspan="14" style="border:0px !important;">NataRaj Yoga Cambodia</td>';
            echo '<td colspan="2" style="width:150px">Maximum total score</td>';
            echo '<td style="width:50px;">' . max($total_array) . '</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td colspan="14"  style="border:0px;">&copy; Isabelle Skaburskis 2010</td>';
            echo '<td colspan="2">Minimum total score</td>';
            echo '<td>' . min($total_array) . '</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td colspan="14"  style="border:0px;"></td>';
            echo '<td colspan="2">Average total score</td>';
            echo '<td>' . round(array_sum($total_array) / count($total_array), 2) . '</td>';
            echo '</tr>';
            echo '<td colspan="16"  style="border:0px;"><u>Note:</u>
                    <br />1. Effort is the score of each sudent who efforted in class, from 0 to 10
                    <br />2. P+E: Participation + Engage is score of eacher student who participated and engaged in class,rank from 0 to 10
                    <br />3. Progress is the score of each student who progress in class, rank from 0 to 10
                    </td>';
            echo '</tr>';
            echo '</table>';
        }
        echo '</div>';
        echo '<div class="clr"></div>';
        echo '</div>'; // End contain print
    }
    header("Content-type: application/vnd.ms-excel; name='excel'");

    header("Content-Disposition: filename=report_scores.xls");
    // Fix for crappy IE bug in download.
    header("Pragma:");
    header("Cache-Control: ");
    //echo $_REQUEST['datatodisplay'];
}
echo '</body></html>';
?>