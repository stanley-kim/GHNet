<div id="ortho_list" class="khusd_st list ortho">
<style>
    
.khusd_st th.category1 {
background: #FDF5E6;
}
.khusd_st th.category2 {
background: #EEEEEE;
}
.khusd_st th.category3 {
background: #FFFFE0;
}
.khusd_st th.category4 {
background: #EDFFFF;
}
.khusd_st th.category4 {
background: #DEFFFF;
}

.khusd_st td.category1 {
background: #FDF5E6;
}
.khusd_st td.category2 {
background: #F0F8FF;
}
.khusd_st td.category3 {
background: #F5FFFA;
}
.khusd_st td.category4 {
background: #FFFFE0;
}

table caption{font-size:14px; font-weight:bold; margin:20px 0 20px 0;}
#follow_list th{background: #FDF5E6}
.khusd_st td{text-align: left;}
</style>
    
 
	<table summary="치주과 점수표 입니다.">
	<caption>치주 수술 현황</caption> 
	<colgroup> 
	<col width="80">
	<col width="40"> 
	<col width="120"> 
	</colgroup> 
	<thead>
	<tr>
	<th scope="col" class="split">치주 수술</th>
	<th scope="col" class="split">최초 당첨자</th>
	<th scope="col" class="split">최종 상태</th>
	</tr>
	</thead>
	<tbody>

	<?php $idx = 1?>
	<?php if(is_array($SCORE_ARRAY)) {?>


	<?php foreach($SCORE_ARRAY as $SCORE):?>
	<tr>
        <td><?=$SCORE['content']?></td>
	<?php if($SCORE['st_ids']):?>
        <td><?php
            foreach(explode(",",$SCORE['st_ids']) as $st_id){
                echo $MEMBER_ARRAY[$st_id]['st_name']." ";
            }
        ?>
        </td>
        <?php else:?>
        <td>미신청</td>
        <?php endif?>
	<?php if($SCORE['history']):?>
        <td>
            <?php foreach($SCORE['history'] as $history):?>
                <?echo "&gt; ".$MEMBER_ARRAY[$history['st_id']]['st_name']."(".$d['khusd_st_perio']['surgery'][$history['type']].")"?>
            <?php endforeach?>
        </td>
        <?php else:?>
        <td><?php echo $SCORE['st_info']['id']?> <?php echo $SCORE['st_info']['name']?></td>
        <?php endif?>

	</tr>
	<?php endforeach?>
	<?php }?>
	</tbody>
	</table>


	<div class="bottom">
		<div class="btnbox1">
		</div>
		<div class="btnbox2"></div>
		<div class="clear"></div>
		<div class="pagebox01" style="text-align: center; margin-bottom:20px;">
                        <?php $GLOBALS['g']['pagelink'] = "/?r=home&m=khusd_st_perio&mode=surgery_history"; ?>
			<?php echo getPageLink($d['theme']['pagenum'],$p,$TPG,$g['img_core'].'/page/default')?>
		</div>
	</div>
        
        <div class="bottom">
		<div class="btnbox1">
		</div>
		<div class="btnbox2"></div>
		<div class="clear"></div>
		<div class="pagebox01" style="text-align: center; margin-bottom:20px;">
                    <form id="addHistory" name="addHistory" method="post" action="<?php echo $g['s']?>/" target="_action_frame_<?php echo $m?>" onsubmit="return updateCheck2(this);">
                    <input type="hidden" name="r" value="<?php echo $r?>" />
                    <input type="hidden" name="a" value="add_history" />
                    <input type="hidden" name="c" value="<?php echo $c?>" />
                    <input type="hidden" name="m" value="<?php echo $m?>" />
                    
                    <input id="st_id" type="hidden" name="st_id" value="<?php echo $my['id']?>" />
                    
                    <select id="surgery" name="surgery">
                        <?php foreach($SCORE_ARRAY as $SCORE){
                            echo "<option value='".$SCORE['uid']."'>".$SCORE['content']."</option>";    
                        }?>
                    </select>
                    
                    <select id="type" name="type">
                        <?php foreach($d['khusd_st_perio']['surgery'] as $key => $value){
                            echo "<option value='$key'>$value</option>";    
                        }?>
                    </select>

                    <input type="submit" value="확인" class="btnblue" />
                    </div>
                    </form>
                </div>
	</div>

<script type="text/javascript">
    
    function updateCheck2(a){
        var st_id = $("#st_id").val();
        var target = $("#surgery option:selected").text();
        var typeTarget = $("#type option:selected").text();
        var returnValue = confirm("학번: "+st_id+"\n수술: "+target+"\n유형: "+typeTarget+" 이 확실한가요?");
        return returnValue;
    }
</script>
	