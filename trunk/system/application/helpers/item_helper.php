<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
if (!function_exists('item')) {

    function panel($status="", $float="") {
        if ($status == "open") {
            $att = "id";
            if ($float == "right")
                $att = "class";
            return '<div class="cpanel-' . $float . '"><div ' . $att . '="cpanel">';
        }
        else if ($status == "close")
            return "</div></div>";

        return "You are missing one parameters: open,close";
    }

    function icon($link="", $image="", $icon="") {
        if ($icon != "" && $link != "") {
            $img = img(array(
                        'src' => 'admin/images/header/' . $image,
                        'alt' => $icon
                    ));

            $html = "<div class='icon-wrapper'>" .
                    "<div class='icon'>" .
                    anchor($link, $img . '<span>' . $icon . '</span>') .
                    "</div>" .
                    "</div>";

            return $html;
        } else {
            return "<p style='color:red;'>You are missing tree parameters in function icon(link,imaageUrl,displaytext)" .
            "<br />Example: icon('controller/function','teacher')<br />" .
            "Parameter: teacher,ngo,class,student<br />" .
            "path of image: admin/images/header/</p>";
        }
    }

}