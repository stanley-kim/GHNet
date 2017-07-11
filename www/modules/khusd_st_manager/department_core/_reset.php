<?php include_once $g['path_module'].$module.'/var/var.php'?>
<?php include_once $g['path_module'].'khusd_st_manager/function/member.php'?>
<div id="configbox">
<form name="procForm" action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>" onsubmit="return saveCheck(this);">
<input type="hidden" name="r" value="<?php echo $r?>" />
<input type="hidden" name="m" value="<?php echo $module?>" />
<input type="hidden" name="a" value="reset" />

<p> 초기화할 그룹을 선택 : </p>
<select name="group" class="select1">
<?php $_SOSOK=getDbArray($table['s_mbrgroup'],'','*','gid','asc',0,1)?>
<?php while($_S=db_fetch_array($_SOSOK)):?>
<option value="<?php echo $_S['uid']?>">ㆍ<?php echo $_S['name']?>(<?php echo number_format($_S['num'])?>)</option>
<?php endwhile?>
</select>

<p> 해당 그룹의 학기 선택 : </p>
<select name="semester">
<?php $SEMESTERS_ARRAY = getSemesterGroupArray()?>
<?php foreach($SEMESTERS_ARRAY as $_S):?>
	<option value="<?php echo $_S['uid']?>"><?php echo $_S['description']?></option>
<?php endforeach?>
</select>


<p>선택한 그룹의 기본점수(0점)를 생성합니다. </p>
<p>계속 하시겠습니까?</p>

<div class="submitbox">
 <input type="submit" class="btnblue" value="초기화" />
</div>
</form>
</div>

<script type="text/javascript">
//<![CDATA[
function saveCheck(f) 
{
 return confirm('정말로 실행하시겠습니까?');
}
//]]>
</script>