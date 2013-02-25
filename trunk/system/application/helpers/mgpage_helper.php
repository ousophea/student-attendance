<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('mgtable'))
{
	function mgtable(){
		$argnames= func_get_args();
		$data="";
		
		foreach($argnames as $arg){
			$val="";
			$index="";
			if(is_array($arg)){
				foreach($arg as $index=>$val){
					
				}
				$arg=$index;
			}
			$data.="<td ".$val.">";
			$data.=$arg;
			$data.="</td>";
		}
		return $data;
	}
}

if ( ! function_exists('toolbar'))
{
	function toolbar(){
		$argnames= func_get_args();
		$data="";
		$data.='<div class="toolbar-list" id="toolbar">';
        	$data.='<div style="float:right; padding-bottom:5px;">';
            	$data.='<ul>';
		foreach($argnames as $arg){
			$val=""; $type=""; $link=""; $text=""; $title="";
			if(is_array($arg)){
				foreach($arg as $index=>$val){
					
					strtolower($index)=="type"?$type=$val:strtolower($index)=="link"?$link=$val:strtolower($index)=="text"?$text=$val:strtolower($index)=="title"?$title=$val:"";
					//$type=$val?$index=="type":$type="ff";echo "d".$index."d".$type;die();
				}
			}
                        $data.='<li id="toolbar-'.$type.'" class="button">';
						$data.=anchor($link,'<center><span class="icon-32-'.$type.'"> </span>'.$text.'</center>','title='.$title);
                        $data.='</li>';
		}
				$data.='</ul>';
            $data.='</div>';
        $data.='</div>';
			
		return $data;
	}
}

//message
if ( ! function_exists('message'))
{
	function message($ms,$type){
		
		$data="";
		if($type=="error")$mes="error";
		elseif($type=="success")$mes="message";
		$data.='<dl id="system-message"><dd class="'.$mes.' message"><ul><li>';
		$data.=$ms;
		$data.='</li></ul></dd></dl>';
		return $data;
	}
}
//add new

//on progress. now not work
/*if ( ! function_exists('mgaddnew'))
{
	function mgaddnew(){
		$argnames= func_get_args();
		$data="";
		$col=1;$i=0;
		if(is_array($argnames[0]))return $data;
		$col=$argnames[0];
		
		foreach($argnames as $arg){
			$i++;
			$i==1?$data.="<tr>":$data.="";
			if(is_array($arg)){
				foreach($arg as $index=>$val){
					$validate="";$rem="";$label="";$input="";$req="";
					strtolower($index)=="req"?$req=$val:strtolower($index)=="validate"?$validate=$val:strtolower($index)=="rem"
				}
			}
			if($i%$col==0){
				$data.="</tr>"	
			}
		}
	}
}*/