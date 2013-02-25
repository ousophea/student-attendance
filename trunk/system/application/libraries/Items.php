<?php

class Items {

    function Items() {
        $obj = & get_instance();
        $obj->load->helper(array('html'));
    }

    function panel($status="",$float=""){
        if($status=="open"){
            $att="id";
            if($float=="right") $att = "class";
            return '<div class="cpanel-'.$float.'"><div '.$att.'="cpanel">';
        }
        else if($status=="close")
            return "</div></div>";
        
        return "You are missing one parameters: open,close";
    }

    function icon($link="",$image="", $icon="") {
        if ($icon != "" && $link != "") {
            $img = img(array(
                'src'=>'admin/images/header/'.$image,
                'alt'=>$icon
            ));

            $html = "<div class='icon-wrapper'>" .
                    "<div class='icon'>".
                    anchor($link, $img.'<span>'.$icon.'</span>') .
                    "</div>".
                    "</div>";

            return $html;
        } else {
            return  "<p style='color:red;'>You are missing tree parameters in function icon(link,imaageUrl,displaytext)" .
            "<br />Example: icon('controller/function','teacher')<br />" .
            "Parameter: teacher,ngo,class,student<br />".
            "path of image: admin/images/header/</p>";
        }
    }

}
?>
<!--<div class="icon-wrapper">
    <div class="icon">
        <a href="/joomla1.7/administrator/index.php?option=com_categories&amp;extension=com_content">
            <img src="/joomla1.7/administrator/templates/bluestork/images/header/icon-48-category.png" alt="">
            <span>Category Manager</span>
        </a>
    </div>
</div>-->
