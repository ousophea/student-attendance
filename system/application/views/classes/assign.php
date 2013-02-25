<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$db = new Dbf();
$cla_id = $this->uri->segment(3);
$this->db->where($db->cla_id, $cla_id);
$this->db->where($db->cla_status, 1);
$this->db->from($db->tbl_classes);
$this->db->join($db->tbl_workloads, $db->cla_id . '=' . $db->wor_cla_id);
$this->db->join($db->tbl_generations, $db->gen_id . '=' . $db->cla_gen_id);
$data = $this->db->get(); //->result_array();

$tea_id = '';
if ($data->num_rows() > 0) {
    foreach ($data->result() as $row) {
        $tea_id[$row->wor_tea_id] = $row->wor_tea_id;
    }
}
// get teacher that not join
$this->db->where($db->tea_status, 1);
$this->db->where_not_in($db->tea_id, $tea_id);
$data = $this->db->get($db->tbl_teachers);
if ($data->num_rows() > 0) {
    echo '<p>Click button add to assign teacher</p><hr />';
    echo '<table border="0" style="padding:3px;width:100%;border-color:#ccc !important; border-collapse:collapse;" align="center">';
    echo '<tr style="border-bottom:1px solid #ccc;">';
    echo '<th style="text-align:left;">Teacher name</th>';
    echo '<th style="text-align:left;">Assign</th>';
    echo '</tr>';
    foreach ($data->result() as $r) {
        echo '<tr style="border-bottom:1px solid #ccc;" id="trid_"' . $r->tea_id . '>';
        echo '<td style="padding:2px;">' . $r->tea_name . '</td>';
        echo '<td style="padding:2px;">' . anchor('classes/assign/assign/' . $cla_id . '/' . $r->tea_id, img(array('src' => 'admin/images/24/assign.png', 'title' => 'Assign', 'alt' => 'Assign'))) . '</td>';
        echo '</tr>';
    }
    echo '</table><br />';
    echo '<table cellpadding="5" cellspacing="5"></table>';
} else {
    echo '<p class="error">Don\'t have any teacher to assign for this class!</p>';
}
?>
