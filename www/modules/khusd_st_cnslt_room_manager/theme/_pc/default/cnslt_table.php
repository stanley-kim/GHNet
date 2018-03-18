<div id="cnslt_table" class="khusd_st list">

	<div>
		<?php if($iframe != 'y' && $iframe != 'Y'):?>
		<a href="<?php echo $g['khusd_st_cnslt_room_manager_cnslt_table'].$ch_date.'&amp;part='.$part.'&amp;iframe=Y'?>" target="_blank">프린트</a>
		<?php endif?>
	</div>
	
	<?php $_start_idx = 1?>
	<?php include $g['dir_module_skin'].'_cnslt_table.php'?>

	<?php $_start_idx = 13?>
	<?php include $g['dir_module_skin'].'_cnslt_table.php'?>

	<?php $_start_idx = 25?>
	<?php include $g['dir_module_skin'].'_cnslt_table.php'?>

        <?php if(getDateFormat($ch_date,'w') == 1) :?>
        <?php $_i  = 2?>
        <?php while ( $_i <=6  ) :?>
        <?php $ch_date = $WEEK_ch_date[$_i]   ?>
        <?php $is_available_nt = $WEEK_is_available_nt[$_i]   ?>
        <?php $CHAIR_RESERV_ARRAY = $WEEK_CHAIR_RESERV_ARRAY[$_i]   ?>
        <?php $_start_idx = 1?>
        <?php include $g['dir_module_skin'].'_cnslt_table.php'?>

        <?php $_start_idx = 13?>
        <?php include $g['dir_module_skin'].'_cnslt_table.php'?>

        <?php $_start_idx = 25?>
        <?php include $g['dir_module_skin'].'_cnslt_table.php'?>
        <?php $_i  = $_i + 1?>
        <?php endwhile ?>
        <?php endif ?>


</div>
