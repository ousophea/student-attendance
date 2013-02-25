<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('login'))
{
	function login()
	{
		$login_info="";
		require_once ("system/application/config/login.php");
		if($enable==1){
			$login_info.='<table cellpadding="5">';
			
			foreach($fields as $pu_rows){
				list($name,$type,$require)=$pu_rows;
				$login_info.="<tr>";
				$login_info.='<td>'.ucfirst($name);
				if($require==1)$login_info.='* : </td>';
				$login_info.='<td> <input size="20" type="'.$type.'" name="'.$name.'" class="input_'.$name;
				
				if($require==1)	$login_info.= ' required';
				if(strtolower($name)=="email") $login_info.= ' email';
				
				$login_info.='" /></td></tr>';
			}	
		}
		$login_info.='<tr><td colspan="2" align="right"><input type="submit" value="Login" /></td></tr>';
		
		$login_info.="</table>";
		$login_info.=''.$register==1?"<span class=\"login\"><br /><a href=\"\"  onclick='return false;'>Login</a></span>":'';
		$login_info.=''.$register==1?"<span class=\"register\"><br /><a href=\"\"  onclick='return false;'>Register</a><br /></span>":'';
		$login_info.=''.$forgetpassword==1?"<span class=\"forgotpass\" id=\"forgotpass\"><a href=\"\"  onclick='return false;'>Forget Password</a></span>":'';
		
		return $login_info;
	}
}