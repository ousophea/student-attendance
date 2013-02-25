<?php //echo 1;   ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo $title; ?></title>


        <!--[if IE 6]>
            <link rel="stylesheet" type="text/css" href="css/admin/iecss.css" />
            <![endif]-->

        <!--[if IE 8]>
        <link rel="stylesheet" type="text/css" href="css/admin/ie8.css" />
        <![endif]-->

        <!--admin style-->
        <!--    <link rel="stylesheet" type="text/css" href="admin/css/template.css" />
            <link rel="stylesheet" type="text/css" href="admin/css/ie7.css" />-->
        <!--[if IE 7]>
        <?php echo link_tag('admin/css/style-IE.css'); ?>
        <![endif]-->
        <?php
        echo link_tag('admin/css/template.css');
        echo link_tag('admin/css/system.css');
        echo link_tag('admin/css/theme.css');
        echo link_tag('admin/css/textbig.css');
        echo link_tag('admin/css/ie7.css');
        echo link_tag('admin/css/ie8.css');

        echo link_tag('admin/css/style.css');
        echo link_tag('admin/css/style_task1.css');
        echo link_tag('admin/css/style_score.css');
        $this->jquery->output();

//    echo link_tag('admin/css/highcontrast.css');
        ?>
    </head>

    <body>
        <?php echo $this->load->view('header'); ?>
        <div id="wrapper">
            <?php echo $this->load->view('menu'); ?>
            <div class="clear">&nbsp;</div>
            <div id="content">
                <div id="top_content">
                    <div id="content_top_left">&nbsp;</div>
                    <div id="content_top_right">&nbsp;</div>
                    <div id="content_top_m">&nbsp;</div>
                </div>

                <div id="main_content">
                    <div id="signout">
                        <div style='text-align:right;padding: 0 0 10px;'>
                            <?php
                            $img = array(
                                'src' => 'admin/images/16/shutdown.png',
                                'alt' => 'Signout',
                                'title' => 'Click to sign out',
                                'style' => 'margin-top:5px;'
                            );
                            echo 'Welcome <b>' . $this->session->userdata('tea_name');
                            echo anchor('home/signout', ' Sign out ' . img($img)) . '</b>';
                            ?>
                        </div>
                    </div>
                    <?php
                            if ($this->uri->segment(2)) {
                                $this->load->view($this->uri->segment(1) . "/" . $this->uri->segment(2));
                            }
                    ?>
                        </div>
                        <div id="bottom_content">
                            <div id="content_bottom_left">&nbsp;</div>
                            <div id="content_bottom_right">&nbsp;</div>
                            <div id="content_bottom_m">&nbsp;</div>
                        </div>
                        <div class="clear">&nbsp;</div>
                    </div>
                </div>
                <div class="clear"></div>
        <?php echo $this->load->view('footer'); ?>
    </body>
</html>