<?php include_once $g['path_module'].$module.'/var/var.php'?>
<div id="configbox">
<form name="procForm" action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>" onsubmit="return saveCheck(this);">
<input type="hidden" name="r" value="<?php echo $r?>" />
<input type="hidden" name="m" value="<?php echo $module?>" />
<input type="hidden" name="a" value="reset" />

<p>기존 입력되어 있는 점수를 모두 초기화하고, 현재 설정되어 있는 연결그룹의 기본점수를 생성합니다. </p>
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