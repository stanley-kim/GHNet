<div id="mjointbox">
 <div class="title">
  이 모듈을 연결하시겠습니까?
 </div>
 <input type="button" value="정보수정 확인 연결" class="btnblue" onclick="dropJoint('<?php echo $g['s']?>/?r=<?php echo $r?>&m=<?php echo $smodule?>&mode=update_check');" />
 <input type="button" value="점수 업데이트 이력 연결" class="btnblue" onclick="dropJoint('<?php echo $g['s']?>/?r=<?php echo $r?>&m=<?php echo $smodule?>&mode=score_history');" />
 <input type="button" value="신청 이력 연결" class="btnblue" onclick="dropJoint('<?php echo $g['s']?>/?r=<?php echo $r?>&m=<?php echo $smodule?>&mode=apply_history');" />
 <input type="button" value="차수중복검중 연결" class="btnblue" onclick="dropJoint('<?php echo $g['s']?>/?r=<?php echo $r?>&m=<?php echo $smodule?>&mode=verification');" />
 <input type="button" value="소모임통합" class="btnblue" onclick="dropJoint('<?php echo $g['s']?>/?r=<?php echo $r?>&m=<?php echo $smodule?>&mode=koda');" />
</div>
<style type="text/css">
#mjointbox {}
#mjointbox .title {border-bottom:#dfdfdf dashed 1px;padding:0 0 10px 0;margin:0 0 20px 0;}
</style>
