<div class="task1">
<?php
echo form_open('teachers/edit/'.$this->uri->segment(3));
// input hidden get id by segment
echo form_hidden($this->dbf->tea_id, $this->uri->segment(3));
// dbf is the class library Dbf it store field name of each table
// can access two ways
$db = new dbf();
//$db=$this->dbf;
foreach ($teachers->result() as $row){
    $key_name = array(
        $db->tea_name => $row->tea_name,
        $db->tea_sex => $row->tea_sex,
        $db->tea_phone => $row->tea_phone,
        $db->tea_address => $row->tea_address,
        $db->tea_position => $row->tea_position,
        $db->tea_email => $row->tea_email,
//        $db->tea_status =>$row->tea_status,
        $db->tea_description => $row->tea_description
    );
}
foreach ($key_name as $field=>$val) {
    $value[$field] = ($this->input->post($field)) ? $this->input->post($field) :$val;
}
$value[$db->tea_password]=($this->input->post($db->tea_password))?$this->input->post($db->tea_password):'';
$value[$db->tea_password.'c']=($this->input->post($db->tea_password.'c'))?$this->input->post($db->tea_password.'c'):'';


echo '<div class="form-wrapper">';
echo '<fieldset>';
echo '<legend align="center"><div class="heading">Edit teacher</div></legend>';
if($this->session->flashdata('error')) echo message($this->session->flashdata('error'),"error") ;
echo toolbar(array("type"=>"cancel","link"=>"teachers/manager","text"=>"Cencel","title"=>"Cencel"));
echo '<table style="width: 100%;" align="center">';

$data = array(
    'type' => 'text', // input type='text'
    'title' => 'Username',
    'required' => 1, // 1 required, 0 not required for asteric sign
    'validator' => 1, // 1 validat, 0 not validat for validat fom
    'attr' => array(
        'name' => $db->tea_name,
        'class' => 'input_box',
        'value' => $value[$db->tea_name],
    )
);
$this->load->view('global/form_tr', $data);
//----------------------------------------
$data = array(
    'type' => 'password', // input type='password'
    'title' => 'Password',
    'required' => 1, // 1 required, 0 not required for asteric sign
    'validator' => 1, // 1 validat, 0 not validat for validat fom
    'attr' => array(
        'name' => $db->tea_password,
        'class' => 'input_box',
        'value' => $value[$db->tea_password],
    )
);
$this->load->view('global/form_tr', $data);
//----------------------------------------
$data = array(
    'type' => 'password', // input type='password'
    'title' => 'Password confirm',
    'required' => 1, // 1 required, 0 not required for asteric sign
    'validator' => 1, // 1 validat, 0 not validat for validat fom
    'attr' => array(
        'name' => $db->tea_password.'c',
        'class' => 'input_box',
        'value' => $value[$db->tea_password.'c'],
    )
);
$this->load->view('global/form_tr', $data);
//----------------------------------------
$data = array(
    'type' => 'select', // input type='selete'
    'title' => 'Sex',
    'required' => 1, // 1 required, 0 not required for asteric sign
    'validator' => 1, // 1 validat, 0 not validat for validat fom
    'attr' => array(
        'name' => $db->tea_sex,
        'class' => 'input_box',
        'selected' => $value[$db->tea_sex],
        'option'=>array(''=>'--Select sex--','Male'=>'Male','Female'=>'Female')
    )
);
$this->load->view('global/form_tr', $data);
//----------------------------------------
$data = array(
    'type' => 'select', // input type='select'
    'title' => 'Position',
    'required' => 1, // 1 required, 0 not required for asteric sign
    'validator' => 1, // 1 validat, 0 not validat for validat fom
    'attr' => array(
        'name' => $db->tea_position,
        'class' => 'input_box',
        'selected' => $value[$db->tea_position],
        'option'=>array(''=>'--Select position--','Admin'=>'Admin','Teacher'=>'Teacher')
    )
);
$this->load->view('global/form_tr', $data);
//----------------------------------------
$data = array(
    'type' => 'text', // input type='text'
    'title' => 'Phone',
    'required' => 0, // 1 required, 0 not required for asteric sign
    'validator' => 1, // 1 validat, 0 not validat for validat fom
    'attr' => array(
        'name' => $db->tea_phone,
        'class' => 'input_box',
        'value' => $value[$db->tea_phone],
    )
);
$this->load->view('global/form_tr', $data);

//----------------------------------------
$data = array(
    'type' => 'text', // input type='text'
    'title' => 'E-mail',
    'required' => 0, // 1 required, 0 not required for asteric sign
    'validator' => 1, // 1 validat, 0 not validat for validat fom
    'attr' => array(
        'name' => $db->tea_email,
        'class' => 'input_box',
        'value' => $value[$db->tea_email],
    )
);
$this->load->view('global/form_tr', $data);
//----------------------------------------
//$data = array(
//    'type' => 'select', // input type='select'
//    'title' => 'Status',
//    'required' => 1, // 1 required, 0 not required for asteric sign
//    'validator' => 1, // 1 validat, 0 not validat for validat fom
//    'attr' => array(
//        'name' => $db->tea_status,
//        'class' => 'input_box',
//        'selected' => $value[$db->tea_status],
//        'option'=>array(''=>'--Select status--','1'=>'Enable','0'=>'Desable')
//    )
//);
//$this->load->view('global/form_tr', $data);
//----------------------------------------
$data = array(
    'type' => 'textarea', // input type='text'
    'title' => 'Address',
    'required' => 0, // 1 required, 0 not required for asteric sign
    'validator' => 1, // 1 validat, 0 not validat for validat fom
    'attr' => array(
        'name' => $db->tea_address,
        'class' => 'input_box',
        'value' => $value[$db->tea_address],
        'rows'=>5,
        'cols'=>20
    )
);
$this->load->view('global/form_tr', $data);
//----------------------------------------
$data = array(
    'type' => 'textarea', // input type='text'
    'title' => 'Descriptions',
    'required' => 0, // 1 required, 0 not required for asteric sign
    'validator' => 1, // 1 validat, 0 not validat for validat fom
    'attr' => array(
        'name' => $db->tea_description,
        'class' => 'input_textarea',
        'value' => $value[$db->tea_description],
        'rows'=>5,
        'cols'=>20
    )
);
$this->load->view('global/form_tr', $data);

echo '<tr>';
echo '<td style="text-align:right;"><p>Note: All fields containt (<span class="required">*</span>) are required.</p></td><td>';
echo '<div class="contain-submit">';
echo form_submit('submit', 'Update');
echo form_input(array('type'=>'button','value'=>'Cancel','onclick'=>"window.location.href='".  base_url()."teachers/manager'"));
echo '</div>';
echo '</td>';
echo '</tr>';
echo  '</table>';
echo '</fieldset>';


echo '</div>';

echo form_close();
?>
</div>