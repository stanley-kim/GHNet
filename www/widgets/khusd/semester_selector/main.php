<div class="widget_my_st_candi_list">
	<?php
		include_once $g['path_module'].'khusd_st_manager/var/var.php';	// 필수 인클루드 파일
		include_once $g['path_module'].'khusd_st_apply_manager/var/var.define.php';
		
		include_once $g['path_module'].'khusd_st_manager/function/date.php';
		include_once $g['path_module'].'khusd_st_manager/function/member.php';

		// 현재 학기 정보
		$SEMESTER_INFO = getCurrentSemesterInfo();
		
		// 학기 그룹 목록 받아오기
		$SEMESTERS_ARRAY = getSemesterGroupArray(true);

	?>

	<div class="ltt">
		<div class="widge_title">현재 학기<?php echo $sss_uid?> : <?php echo $SEMESTER_INFO['description']?></div>
	</div>
	
	학기 이동
	
	<select name="semester_select" onchange="changeSemester();">
	<?php foreach($SEMESTERS_ARRAY as $_S):?>
		<option value="<?php echo $_S['uid']?>"<?php if($_GET["s_uid"] == $_S['uid']):?> selected<?php endif?>><?php echo $_S['description']?></option>
	<?php endforeach?>
	</select>
</div>

<script type="text/javascript">
//<![CDATA[
function changeSemester()
{
	var s = document.getElementsByName("semester_select")[0];	
	document.location.href = updateQueryStringParameter(document.location.href, "s_uid", s.options[s.selectedIndex].value);
}
function updateQueryStringParameter(uri, key, value) {
  var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
  var separator = uri.indexOf('?') !== -1 ? "&" : "?";
  if (uri.match(re)) {
    return uri.replace(re, '$1' + key + "=" + value + '$2');
  }
  else {
    return uri + separator + key + "=" + value;
  }
}

//]]>
</script>