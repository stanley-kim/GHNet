<div id="mjointbox">
 <div class="title">
  이 모듈을 연결하시겠습니까?
 </div>
 <input type="button" value="종진실장 신청 관리 연결" class="btnblue" onclick="dropJoint('<?php echo $g['s']?>/?r=<?php echo $r?>&m=<?php echo $smodule?>&department=manager&st_type=manager&mode=st_list');" />
 <input type="button" value="구강검진(방사) 신청 연결" class="btnblue" onclick="dropJoint('<?php echo $g['s']?>/?r=<?php echo $r?>&m=<?php echo $smodule?>&department=radio&st_type=radio&mode=st_schedule');" />
 <input type="button" value="치주과 신청 연결" class="btnblue" onclick="dropJoint('<?php echo $g['s']?>/?r=<?php echo $r?>&m=<?php echo $smodule?>&department=perio&st_type=perio&mode=st_schedule');" />
 <input type="button" value="보존과 OP 신청 연결" class="btnblue" onclick="dropJoint('<?php echo $g['s']?>/?r=<?php echo $r?>&m=<?php echo $smodule?>&department=consv&st_type=consv&mode=st_schedule');" />
 <input type="button" value="보존과 Endo 신청 연결" class="btnblue" onclick="dropJoint('<?php echo $g['s']?>/?r=<?php echo $r?>&m=<?php echo $smodule?>&department=consv&st_type=endo&mode=st_schedule');" />
 <input type="button" value="보철과 신청 연결" class="btnblue" onclick="dropJoint('<?php echo $g['s']?>/?r=<?php echo $r?>&m=<?php echo $smodule?>&department=pros&st_type=pros&mode=st_schedule');" />
 <input type="button" value="소아치과 신청 연결" class="btnblue" onclick="dropJoint('<?php echo $g['s']?>/?r=<?php echo $r?>&m=<?php echo $smodule?>&department=pedia&st_type=pedia&mode=st_schedule');" />
 <input type="button" value="체어 배정표 연결" class="btnblue" onclick="dropJoint('<?php echo $g['s']?>/?r=<?php echo $r?>&m=<?php echo $smodule?>&mode=cnslt_schedule');" />
 <input type="button" value="수관/표면소독" class="btnblue" onclick="dropJoint('<?php echo $g['s']?>/?r=<?php echo $r?>&m=<?php echo $smodule?>&mode=disinfection');" />
</div>
<style type="text/css">
#mjointbox {}
#mjointbox .title {border-bottom:#dfdfdf dashed 1px;padding:0 0 10px 0;margin:0 0 20px 0;}
</style>