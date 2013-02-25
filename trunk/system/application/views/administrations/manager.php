<?php

/*
 * Created on Jan 27, 2012
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */


// panel left
echo panel("open", "left"); // load from helper Item
if (strtolower($this->session->userdata("tea_position")) == 'admin') { // for permission admin
    echo icon('teachers/manager', 'teacher.png', 'Teachers MG'); // first argument is link 'controller/function', second is icon file name (path:admin/images/header), third is text display
    echo icon('student/manager', '1326088060_graduated.png', 'Students MG');
    echo icon('classes/manager', 'class.png', 'Class MG');
    echo icon('generation/manager', 'generation_icon.png', 'Generantion MG');
    echo icon('attendant/manager', 'Attendance_Icon.png', 'Attendance MG');
    echo icon('scores/manager/reports', 'viewreport.png', 'View Reports');
    echo icon('ngo/manager', 'NGO_1.png', 'NGO MG');
    echo icon('scores/manager', 'score-icon.png', 'Score MG');
}
// for permission teacher
else if(strtolower($this->session->userdata("tea_position")) == 'teacher'){
    echo icon('scores/manager/reports', 'viewreport.png', 'View Reports');
    echo icon('attendant/manager', 'Attendance_Icon.png', 'Attendance MG');
    echo icon('scores/manager', 'score-icon.png', 'Score MG');
}
else{
    echo header('You don\'t have permission!',1);
}
echo panel("close", "right");

// panel right
echo panel("open", "right");
echo "<div style='float:left;width:398px;text-align:justify;float: right;'>";
$img1 = array(
    'src' => 'admin/images/others/helping.gif',
    'alt' => 'Panel image',
    'style' => 'float:left;height:163px;'
);
$img2 = array(
    'src' => 'admin/images/others/kidsClass.gif',
    'alt' => 'Panel image',
    'style' => 'float:left;'
);
$text = "<div class='clr'></div><p class='inden'>Krama Yoga is a Cambodian NGO run by young men and women" .
        "who have changed their lives with yoga and now provide Kids" .
        "Yoga, Teen Yoga and Yoga Therapy classes for others.</p>";
$text.="<p class='inden'>Krama Yoga is the organization that will ensure gainful and" .
        " fulfilling careers for the core team members, and for others" .
        "who are now growing up with yoga and can choose to pursue it as" .
        "a life path.  This NGO is the tangible outcome of these kids' " .
        "climb from poverty and trauma, to leaders of their community and artists of their own lives.</p>";


echo img($img1);
echo img($img2);
echo $text;
echo "</div>";
echo panel("close", "right");
?>
