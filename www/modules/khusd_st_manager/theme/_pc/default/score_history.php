<div id="score_history" class="khusd_st manager">
	
	<form name="update_check" action="<?php echo $g['s']?>/" method="get">
		<input type="hidden" name="r" value="<?php echo $r?>" />
		<input type="hidden" name="c" value="<?php echo $c?>" />
		<input type="hidden" name="m" value="<?php echo $m?>" />
		<input type="hidden" name="mode" value="<?php echo $mode?>" />


		<select name="dept_id">
			<option value="perio"<?php if($dept_id == 'perio'):?> selected<?php endif?>>치주과</option>
			<option value="pros"<?php if($dept_id == 'pros'):?> selected<?php endif?>>보철과</option>
			<option value="pedia"<?php if($dept_id == 'pedia'):?> selected<?php endif?>>소아치과</option>
			<option value="radio"<?php if($dept_id == 'radio'):?> selected<?php endif?>>영상과</option>
			<option value="ortho"<?php if($dept_id == 'ortho'):?> selected<?php endif?>>교정과</option>
			<option value="consv"<?php if($dept_id == 'consv'):?> selected<?php endif?>>보존과</option>
			<option value="oms"<?php if($dept_id == 'oms'):?> selected<?php endif?>>구강외과</option>
			<option value="medi"<?php if($dept_id == 'medi'):?> selected<?php endif?>>구강내과</option>
		</select>

		학번 : <input type="text" name="st_id" value="<?php echo $st_id ? $st_id : ''?>" />
		이름 : <input type="text" name="st_name" value="<?php echo $st_name ? $st_name : ''?>" />
		<input type="submit" value="확인" class="btngray" />
	</form>
	
	<?php if($dept_id && $st_id):?>
	<iframe src="<?php echo $g['s'].'/?m=khusd_st_'.$dept_id.'&amp;mode=history&amp;iframe=Y&amp;st_id='.$st_id?>" width="100%" height="300px" border="0px"> </iframe>
	<?php endif?>
</div>