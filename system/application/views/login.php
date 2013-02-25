<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>System Login</title>
<?php
	echo link_tag("admin/css/login.css");
?>
</head>
<body>
	<div class="wrap">
    <div class="border_left"></div>
	<div class="border">
    	<p class="aac_header">Student Attendance &amp; Assessment System</p>
        <div class="bg_right"></div>
    	<div class="login">
        	<div class="login_header">Member Login</div>
            <div class="login_img">
            	<?php 
				$image_properties = array(
				  'src' => 'admin/images/others/lock.png',
				  'alt' => 'Logo',
				  'width' => '210'
				);
				echo img($image_properties);
				?>
            </div>
            <div class="login_form">
            
            <?php 
			echo $this->session->userdata("ms");
			$this->session->unset_userdata("ms");
			
			echo form_open('home/login');
			echo login();
			echo form_close();
			echo form_error("username");
			echo form_error("password");
			?>
            </div>
        </div>
        <div class="bg_left"></div>
        <div class="clearboth"></div>
    </div>
    <div class="border_right"></div>
    <div class="clearboth"></div>
    </div>
    <div class="clearboth"></div>
</body>
</html>