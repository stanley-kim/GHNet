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
</style>
    
 
	<table summary="치주과 점수표 입니다.">
	<caption>치주 수술 현황</caption> 
	<colgroup> 
	<col width="40">
	<col width="40"> 
	<col width="40"> 
	<col width="40">
	<col width="40">
	<col width="40">
	<col width="40">
	<col width="40">
	<col width="40">
	<col width="60">
	<col width="60"> 
	</colgroup> 
	<thead>
	<tr>
	<th scope="col" class="split">No</th>
	<th scope="col" class="split">학번</th>
	<th scope="col" class="split">이름</th>
	<th scope="col" class="split category1"><a href="<?php echo getSortingLink2($g['khusd_st_perio_surgery'], 'surgery', $om, $order == 'surgery')?>">치주수술</a></th>
	<th scope="col" class="split category2"><a href="<?php echo getSortingLink2($g['khusd_st_perio_surgery'], 'perio_report', $om, $order == 'perio_report')?>">술후 레포트</a></th>
	<th scope="col" class="split category1"><a href="<?php echo getSortingLink2($g['khusd_st_perio_surgery'], 'imp_1st', $om, $order == 'imp_1st')?>">Implant 1st.</a></th>
	<th scope="col" class="split category2"><a href="<?php echo getSortingLink2($g['khusd_st_perio_surgery'], 'imp1_report', $om, $order == 'imp1_report')?>">술후 레포트</a></th>
	<th scope="col" class="split category1"><a href="<?php echo getSortingLink2($g['khusd_st_perio_surgery'], 'imp_2nd', $om, $order == 'imp_2nd')?>">Implant 2nd.</a></th>
	<th scope="col" class="split category2"><a href="<?php echo getSortingLink2($g['khusd_st_perio_surgery'], 'imp2_report', $om, $order == 'imp2_report')?>">술후 레포트</a></th>
	<th scope="col" class="split category3"><a href="<?php echo getSortingLink2($g['khusd_st_perio_surgery'], 'total', $om, $order == 'total')?>">수술 Total</a></th>
	<th scope="col" class="split category4"><a href="<?php echo getSortingLink2($g['khusd_st_perio_surgery'], 'total_report', $om, $order == 'total_report')?>">술후 Total</a></th>
	</tr>
	</thead>
	<tbody>

	<?php $idx = 1?>
	<?php if(is_array($SCORE_ARRAY)) {?>


	<?php foreach($SCORE_ARRAY as $SCORE):?>
	<tr>
	<td><?php echo $idx++?></td>
	<td class="hand "><?php echo $SCORE['st_info']['id']?></td>
	<td class="hand "><?php echo $SCORE['st_info']['name']?></td>

	<td><?php echo $SCORE['surgery']?></td>
	<td class="category3"><?php echo $SCORE['perio_report']?></td>
	<td><?php echo $SCORE['imp_1st']?></td>
	<td class="category3"><?php echo $SCORE['imp1_report']?></td>
	<td><?php echo $SCORE['imp_2nd']?></td>
	<td class="category3"><?php echo $SCORE['imp2_report']?></td>
	<td><?php echo $SCORE['total']?></td>
	<td class="category3"><?php echo $SCORE['total_report']?></td>

	</tr>
	<?php endforeach?>
	<?php }?>
	</tbody>
	</table>
</div>