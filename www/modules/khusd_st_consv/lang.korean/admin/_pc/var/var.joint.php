<div id="mjointbox">
 <div class="title">
  이 모듈을 연결하시겠습니까?
 </div>
 <input type="button" value="정보수정 연결" class="btnblue" onclick="dropJoint('<?php echo $g['s']?>/?r=<?php echo $r?>&m=<?php echo $smodule?>&mode=update');" />
 <input type="button" value="LIST ALL 연결" class="btnblue" onclick="dropJoint('<?php echo $g['s']?>/?r=<?php echo $r?>&m=<?php echo $smodule?>&mode=list');" />
 <input type="button" value="LIST FIX ALL 연결" class="btnblue" onclick="dropJoint('<?php echo $g['s']?>/?r=<?php echo $r?>&m=<?php echo $smodule?>&mode=list_fix');" />
 <input type="button" value="ST LIST ALL 연결" class="btnblue" onclick="dropJoint('<?php echo $g['s']?>/?r=<?php echo $r?>&m=<?php echo $smodule?>&mode=st_list');" />
 <input type="button" value="ST ENDO LIST ALL 연결" class="btnblue" onclick="dropJoint('<?php echo $g['s']?>/?r=<?php echo $r?>&m=<?php echo $smodule?>&mode=st_endo_list');" />
 <input type="button" value="HISTORY 연결" class="btnblue" onclick="dropJoint('<?php echo $g['s']?>/?r=<?php echo $r?>&m=<?php echo $smodule?>&mode=history');" />
</div>
<style type="text/css">
#mjointbox {}
#mjointbox .title {border-bottom:#dfdfdf dashed 1px;padding:0 0 10px 0;margin:0 0 20px 0;}
</style>