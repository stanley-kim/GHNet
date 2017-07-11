<div id="mjointbox">
 <div class="title">
  이 모듈을 연결하시겠습니까?
 </div>
 <input type="button" value="상벌점 부여 연결" class="btnblue" onclick="dropJoint('<?php echo $g['s']?>/?r=<?php echo $r?>&m=<?php echo $smodule?>&mode=update');" />
 <input type="button" value="상벌점 부여 내역" class="btnblue" onclick="dropJoint('<?php echo $g['s']?>/?r=<?php echo $r?>&m=<?php echo $smodule?>&mode=list');" />
 <input type="button" value="상벌점 현황" class="btnblue" onclick="dropJoint('<?php echo $g['s']?>/?r=<?php echo $r?>&m=<?php echo $smodule?>&mode=main');" />
</div>
<style type="text/css">
#mjointbox {}
#mjointbox .title {border-bottom:#dfdfdf dashed 1px;padding:0 0 10px 0;margin:0 0 20px 0;}
</style>