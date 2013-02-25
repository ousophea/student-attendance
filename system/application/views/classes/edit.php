<div class="task1">
<?php
echo form_open('classes/edit/'.$this->uri->segment(3));
// input hidden get id by segment
echo form_hidden($this->dbf->cla_id, $this->uri->segment(3));
// dbf is the class library Dbf it store field name of each table
// can access two ways
$db = new dbf();
//$db=$this->dbf;
foreach ($query->result() as $row){
    $key_name = array(
    $db->cla_name => $row->cla_name,
    $db->cla_student_number => $row->cla_student_number,
    $db->cla_time => $row->cla_time,
    $db->cla_description => $row->cla_description,
    $db->cla_age_leval => $row->cla_age_leval,
    $db->cla_gen_id => $row->cla_gen_id,
    );
}
foreach ($key_name as $field=>$val) {
    $value[$field] = ($this->input->post($field)) ? $this->input->post($field) :$val;
}
//-------------
$generations['']='--- Select generation --';
foreach ($generation->result() as $gen)
        $generations[$gen->gen_id]=$gen->gen_year;
//------------------
$age_level['']='--- Select age level ---';
for($i=10;$i<=100;$i++){
    $age_level[$i]=$i;
}
//-----------------

echo '<div class="form-wrapper">';
echo '<fieldset>';
echo '<legend align="center"><div class="heading">Edit class</div></legend>';
if($this->session->flashdata('error')) echo message($this->session->flashdata('error'),"error") ;
echo toolbar(array("type"=>"cancel","link"=>"classes/manager","text"=>"Cencel","title"=>"Cencel"));
echo '<table style="width: 100%;" align="center">';

$data = array(
    'type' => 'text', // input type='text'
    'title' => 'Class name',
    'required' => 1, // 1 required, 0 not required for asteric sign
    'validator' => 1, // 1 validat, 0 not validat for validat fom
    'attr' => array(
        'name' => $db->cla_name,
        'class' => 'input_box',
        'value' => $value[$db->cla_name],
    )
);
$this->load->view('global/form_tr', $data);
//----------------------------------------
//$data = array(
//    'type' => 'text', // input type='password'
//    'title' => 'Student number',
//    'required' => 0, // 1 required, 0 not required for asteric sign
//    'validator' => 1, // 1 validat, 0 not validat for validat fom
//    'attr' => array(
//        'name' => $db->cla_student_number,
//        'class' => 'input_box',
//        'value' => $value[$db->cla_student_number],
//    )
//);
//$this->load->view('global/form_tr', $data);
//----------------------------------------
$data = array(
    'type' => 'text', // input type='password'
    'title' => 'Time',
    'required' => 1, // 1 required, 0 not required for asteric sign
    'validator' => 1, // 1 validat, 0 not validat for validat fom
    'attr' => array(
        'name' => $db->cla_time,
        'class' => 'input_box',
        'value' => $value[$db->cla_time],
    )
);
$this->load->view('global/form_tr', $data);
//----------------------------------------
$data = array(
    'type' => 'select', // input type='selete'
    'title' => 'Generation',
    'required' => 1, // 1 required, 0 not required for asteric sign
    'validator' => 1, // 1 validat, 0 not validat for validat fom
    'attr' => array(
        'name' => $db->cla_gen_id,
        'class' => 'input_box',
        'selected' => $value[$db->cla_gen_id],
        'option'=>$generations
    )
);
$this->load->view('global/form_tr', $data);
//----------------------------------------
$data = array(
    'type' => 'text', // input type='select'
    'title' => 'Age level',
    'required' => 1, // 1 required, 0 not required for asteric sign
    'validator' => 1, // 1 validat, 0 not validat for validat fom
    'attr' => array(
        'name' => $db->cla_age_leval,
        'class' => 'input_box',
        'value' => $value[$db->cla_age_leval],
        //'option'=>$age_level
    )
);
$this->load->view('global/form_tr', $data);
//----------------------------------------
$data = array(
    'type' => 'textarea', // input type='text'
    'title' => 'Description',
    'required' => 0, // 1 required, 0 not required for asteric sign
    'validator' => 1, // 1 validat, 0 not validat for validat fom
    'attr' => array(
        'name' => $db->cla_description,
        'class' => 'input_box',
        'value' => $value[$db->cla_description],
        'rows'=>'5',
        'cols'=>'20'
    )
);
$this->load->view('global/form_tr', $data);
//----------------------------------------

echo '<tr>';
echo '<td style="text-align:right;"><p>Note: All fields containt (<span class="required">*</span>) are required.</p></td><td>';
echo '<div class="contain-submit">';
echo form_submit('submit', 'Update');
echo form_input(array('type'=>'button','value'=>'Cancel','onclick'=>"window.location.href='".  base_url()."classes/manager'"));
echo '</div>';
echo '</td>';
echo '</tr>';
echo  '</table>';
echo '</fieldset>';


echo '</div>';

echo form_close();
?>
</div>