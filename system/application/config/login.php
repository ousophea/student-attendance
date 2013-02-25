<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//enable all paramater below
//Ex: $enable=1;(true), $enable=0;(false)
$enable=1;

//Ex: array("name","type of input",require);

//field  infomation
$fields=array(
			  1=>array("username","text",1),
			  2=>array("password","password",1),
			  );

//link register
//Ex: $register=1;(true), $register=0;(false)
//if you put it 1, please go to config register file (conf/register.php)
$register=0;

//forget password
//Ex: $forgetpassword=1;(true), $forgetpassword=0;(false)
//if you put it 1, please go to config forgot password file (conf/forgotpass.php)
$forgetpassword=0;
?>