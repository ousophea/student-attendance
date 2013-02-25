<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Database_fields
 *
 * @author sochy.choeun
 */
class Dbf {
    // Fielt name in table tbl_teachers
    var $tbl_teachers='tbl_teachers';
    var $tea_id='tea_id';
    var $tea_name='tea_name';
    var $tea_password='tea_password';
    var $tea_sex='tea_sex';
    var $tea_phone='tea_phone';
    var $tea_address='tea_address';
    var $tea_email='tea_email';
    var $tea_description='tea_description';
    var $tea_position='tea_position';
    var $tea_status='tea_status';
    //--------------------------------
    // Field name in table tbl_classes
    var $tbl_classes='tbl_classes';
    var $cla_id='cla_id';
    var $cla_name='cla_name';
    var $cla_student_number='cla_student_number';
    var $cla_time='cla_time';
    var $cla_description='cla_description';
    var $cla_age_leval='cla_age_leval';
    var $cla_gen_id='cla_gen_id';
    var $cla_status='cla_status';

    // table and field in table tbl_workloads
    var $tbl_workloads='tbl_workloads';
    var $wor_tea_id='wor_tea_id';
    var $wor_cla_id='wor_cla_id';
    var $wor_description='wor_description';

    // table and field name in table tbl_generations
    var $tbl_generations='tbl_generations';
    var $gen_id='gen_id';
    var $gen_year='gen_year';
    var $gen_description='gen_description';

    // table and field name in table tbl_students
    var $tbl_students = 'tbl_students';
    var $stu_id='stu_id';
    var $stu_khmer_name='stu_khmer_name';
    var $stu_first_name='stu_first_name';
    var $stu_last_name='stu_last_name';
    var $stu_sex='stu_sex';
    var $stu_dob='stu_dob';
    var $stu_ngo_id='stu_ngo_id';
    var $stu_status='stu_status';
    var $stu_photo='stu_photo';
    var $stu_cla_id='stu_cla_id';
    var $stu_age='stu_age';

    // field and table tbl_scores
    var $tbl_scores = 'tbl_scores';
    var $sco_id='sco_id';
    var $sco_stu_id='sco_stu_id';
    var $sco_effort='sco_effort';
    var $sco_pe='sco_pe';
    var $sco_progress='sco_progress';
    var $sco_ter_id='sco_ter_id';
    var $sco_unfocused='sco_unfocused';
    var $sco_discruptive='sco_discruptive';
    var $sco_withdrawn = 'sco_withdrawn';
    var $sco_improve='sco_improve';
    var $sco_comment='sco_comment';

    // field and table tbl_terms
    var $tbl_terms = 'tbl_terms';
    var $ter_id='ter_id';
    var $ter_name='ter_name';
    var $ter_gen_id='ter_gen_id';
    var $ter_start_date='ter_start_date';
    var $ter_end_date='ter_end_date';

    // NGO
    var $tbl_ngos='tbl_ngos';
    var $ngo_id='ngo_id';
    var $ngo_name='ngo_name';
    var $ngo_address='ngo_address';
    var $ngo_contact_person='ngo_contact_person';
    var $ngo_url='ngo_url';
    var $ngo_email='ngo_email';
    var $ngo_description='ngo_description';
    var $ngo_sdate='ngo_sdate';
    var $ngo_edate='ngo_edate';
    // Attendance
    var $tbl_attendances ='tbl_attendances';
    var $att_id='att_id';
    var $att_stu_id='att_stu_id';
    var $att_date='att_date';
    var $att_absent = 'att_absent';
    var $att_attended='att_attended';
    var $att_ter_id ='att_ter_id';
    var $att_description='att_description';


    function Dbf(){
        $obj = & get_instance();
    }
}
?>
