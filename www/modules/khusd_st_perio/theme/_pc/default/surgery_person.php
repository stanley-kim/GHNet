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
	<?php if($MANAGER):?>
        <form name="apply_history" action="/" method="get">
		<input type="hidden" name="r" value="home">
		<input type="hidden" name="m" value="khusd_st_perio">
		<input type="hidden" name="mode" value="surgery_person">


		학번 : <input type="text" name="st_id" value="">
		<input type="submit" value="검색" class="btngray">
	</form>   
	<?php endif?>
 
	<table summary="치주과 점수표 입니다.">
	<caption><b style="color:blue"><?=$MEMBER_ARRAY[$st_id]['st_name']?></b> 치주 수술 기록</caption> 
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
                <?echo "&gt; ".$MEMBER_ARRAY[$history['st_id']]['st_name']."(".$d['khusd_st_perio']['surgery'][$history['type']].")"?> <?php echo getDateFormat($history['date_reg'],"m/d H:i")?>
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

	