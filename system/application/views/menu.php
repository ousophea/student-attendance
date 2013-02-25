<div id="mainmenu">
    <div id="menu_left">&nbsp;</div>
    <div id="menu_right">&nbsp;</div>
    <div id="menu">

        <ul>
            <li>

            <span id="item_menu_main"><?php echo anchor('administrations/manager','Main'); ?></span></li>
            <?php if(strtolower($this->session->userdata("tea_position")) == 'admin'){ ?>
            <li><?php echo anchor('teachers/manager','Teacher'); ?></li>
            <li><?php echo anchor('student/manager','Student'); ?></li>
            <li><?php echo anchor('classes/manager','Class'); ?></li>
            <li><?php echo anchor('ngo/manager','NGO'); ?></li>
            <li><?php echo anchor('generation/manager','Generation'); ?></li>
			<?php } if(strtolower($this->session->userdata("tea_position")) == 'admin' || strtolower($this->session->userdata("tea_position")) == 'teacher'){ ?>
            <li><?php echo anchor('scores/manager/reports','Report'); ?></li>
            <li><?php echo anchor('attendant/manager','Attendent'); ?></li>
            <li><?php echo anchor('scores/manager','Score'); ?></li>
            <?php }?>
        </ul>

    </div>

</div>