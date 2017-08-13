<div id="consv_list" class="khusd_st list consv">

	<?php getWidget('khusd/semester_selector',array())?>
	
	<table summary="보존과 점수표 입니다.">
	<caption>보존과 Pre ST 현황표</caption> 
	<colgroup> 
	<col width="35">
	<col width="150">
	<col width="40">
	<col width="40">
	<col width="40">
	<col width="40">
	<col width="40">
	<col width="40">
	<col width="40">
	<col width="40">
	<col width="40">
	<col width="40">
	<col width="40">
	<col width="40">
	<col width="40">
	<col width="40">
<!--	<col width="40">
	<col width="40">
	<col width="40">-->
	<col width="40">
	<col width="40"> 
	<col width="40"> 
	<col width="40"> 
	<col width="40"> 
	<col width="40"> 
	<col width="40"> 
	<col width="40"> 
	<col width="40"> 
	<col width="40"> 
	<col width="40"> 
	<col width="40"> 
	<col width="40"> 
	<col width="40"> 
	<col width="40"> 
	<col width="40"> 
	<col width="40"> 
	<col width="40"> 
	<col width="40"> 
	<col width="200"> 
	</colgroup> 
	<thead>
	<tr>
	<?php if($MANAGER):?>
		<th rowspan="6" scope="col" class="split category1">No</th>
		<th rowspan="3" scope="col" class="split category1"><a href="<?php echo getSortingLink($c, 'st_id', $om)?>">학번,이름</a></th>
<!--		<th colspan="8" scope="col" class="split category3">[Follow]</th>-->
		<th colspan="14" scope="col" class="split category2">[Endodontic Tx.]</th>
		<th colspan="7" scope="col" class="split category3">[일반]</th>
		<th colspan="3" scope="col" class="split category4"></th>
		<th rowspan="6" scope="col" class="category5">수정일</th>
	</tr>
	<tr>
<!--		<th rowspan="2" scope="col" class="split category3"><a href="<?php echo getSortingLink($c, 'fol_ind', $om)?>">ind</a></th>
		<th colspan="2" scope="col" class="split category3">end</th>
		<th rowspan="2" scope="col" class="split category3"><a href="<?php echo getSortingLink($c, 'fol_sur', $om)?>">sur</a></th>
		<th rowspan="2" scope="col" class="split category3"><a href="<?php echo getSortingLink($c, 'fol_ble', $om)?>">ble</a></th>
		<th rowspan="3" scope="col" class="split category3"><a href="<?php echo getSortingLink($c, 'fol_sc', $om)?>">득점</a></th>
		<th rowspan="3" scope="col" class="split category3"><a href="<?php echo getSortingLink($c, 'fol_sc_m', $om)?>">감점</a></th>
		<th rowspan="3" scope="col" class="split category3"><a href="<?php echo getSortingLink($c, 'fol_sc_obs', $om)?>">obs</a></th>-->
		<th colspan="3" scope="col" class="split category2">전치</th>
		<th colspan="3" scope="col" class="split category2">소구치</th>
		<th colspan="3" scope="col" class="split category2">전치Re</th>
		<th colspan="3" scope="col" class="split category2">소구치Re</th>
		<th rowspan="2" scope="col" class="split category2"><a href="<?php echo getSortingLink($c, 'pre_st_endo', $om)?>">Endo완료</a></th>
		<th rowspan="2" scope="col" class="split category2"><a href="<?php echo getSortingLink($c, 'pre_st_re_endo', $om)?>">ReEndo완료</a></th>
<!--		<th rowspan="2" scope="col" class="split category2"><a href="<?php echo getSortingLink($c, 'pre_st_endo', $om)?>">PRe St(Endo)</a></th>-->
		<th rowspan="2" scope="col" class="split category3"><a href="<?php echo getSortingLink($c, 'pre_st_ant', $om)?>">Ant Resin</a></th>
		<th rowspan="2" scope="col" class="split category3"><a href="<?php echo getSortingLink($c, 'pre_st_post', $om)?>">Post Resin</a></th>
		<th rowspan="2" scope="col" class="split category3"><a href="<?php echo getSortingLink($c, 'pre_st_cervical', $om)?>">Cervical Resin</a></th>
		<th rowspan="2" scope="col" class="split category3"><a href="<?php echo getSortingLink($c, 'pre_st_am', $om)?>">Amalgam</a></th>
		<th rowspan="2" scope="col" class="split category3"><a href="<?php echo getSortingLink($c, 'pre_st_op', $om)?>">Op완료</a></th>
<!--		<th rowspan="2" scope="col" class="split category3"><a href="<?php echo getSortingLink($c, 'pre_st_am', $om)?>">Pre ST(AF)</a></th>
		<th rowspan="2" scope="col" class="split category3"><a href="<?php echo getSortingLink($c, 'pre_st_op', $om)?>">Pre ST(OP)</a></th>-->
		<th rowspan="2" scope="col" class="split category3"><a href="<?php echo getSortingLink($c, 'pre_st_inlay_gold', $om)?>">Pre ST(Inlay Gold)</a></th>
		<th rowspan="2" scope="col" class="split category3"><a href="<?php echo getSortingLink($c, 'pre_st_inlay_resin', $om)?>">Pre ST(Inlay Resin)</a></th>
		<th rowspan="2" scope="col" class="split category4"><a href="<?php echo getSortingLink($c, 'plus_score', $om)?>">득점</a></th>
		<th rowspan="2" scope="col" class="split category4"><a href="<?php echo getSortingLink($c, 'minus_sc', $om)?>">감점</a></th>
		<th rowspan="2" scope="col" class="split category4"><a href="<?php echo getSortingLink($c, 'obser_score', $om)?>">총점</a></th>
	</tr>
	<tr>
<!--		<th scope="col" class="split category3"><a href="<?php echo getSortingLink($c, 'fol_endapm', $om)?>">a-pm</a></th>
		<th scope="col" class="split category3"><a href="<?php echo getSortingLink($c, 'fol_endm', $om)?>">m</a></th>-->
		<th scope="col" class="split category2"><a href="<?php echo getSortingLink($c, 'pre_st_ant_pe', $om)?>">PE</a></th>
		<th scope="col" class="split category2"><a href="<?php echo getSortingLink($c, 'pre_st_ant_ce', $om)?>">CE</a></th>
		<th scope="col" class="split category2"><a href="<?php echo getSortingLink($c, 'pre_st_ant_cf', $om)?>">CF</a></th>
		<th scope="col" class="split category2"><a href="<?php echo getSortingLink($c, 'pre_st_pre_pe', $om)?>">PE</a></th>
		<th scope="col" class="split category2"><a href="<?php echo getSortingLink($c, 'pre_st_pre_ce', $om)?>">CE</a></th>
		<th scope="col" class="split category2"><a href="<?php echo getSortingLink($c, 'pre_st_pre_cf', $om)?>">CF</a></th>
		<th scope="col" class="split category2"><a href="<?php echo getSortingLink($c, 'pre_st_ant_re_rm', $om)?>">GP제거</a></th>
		<th scope="col" class="split category2"><a href="<?php echo getSortingLink($c, 'pre_st_ant_re_ce', $om)?>">CE</a></th>
		<th scope="col" class="split category2"><a href="<?php echo getSortingLink($c, 'pre_st_ant_re_cf', $om)?>">CF</a></th>
		<th scope="col" class="split category2"><a href="<?php echo getSortingLink($c, 'pre_st_pre_re_rm', $om)?>">GP제거</a></th>
		<th scope="col" class="split category2"><a href="<?php echo getSortingLink($c, 'pre_st_pre_re_ce', $om)?>">CE</a></th>
		<th scope="col" class="split category2"><a href="<?php echo getSortingLink($c, 'pre_st_pre_re_cf', $om)?>">CF</a></th>
	</tr>
	<?php else:?>
		<th rowspan="6" scope="col" class="split category1">No</th>
		<th rowspan="3" scope="col" class="split category1">학번,이름</th>
<!--		<th colspan="8" scope="col" class="split category3">[Follow]</th>-->
		<th colspan="14" scope="col" class="split category2">[Endodontic Tx.]</th>
		<th colspan="7" scope="col" class="split category3">[일반]</th>
		<th colspan="3" scope="col" class="split category4"></th>
		<th rowspan="6" scope="col" class="category5">수정일</th>
	</tr>
	<tr>
<!--		<th rowspan="2" scope="col" class="split category3">ind</th>
		<th colspan="2" scope="col" class="split category3">end</th>
		<th rowspan="2" scope="col" class="split category3">sur</th>
		<th rowspan="2" scope="col" class="split category3">ble</th>
		<th rowspan="3" scope="col" class="split category3">득점</th>
		<th rowspan="3" scope="col" class="split category3">감점</th>
		<th rowspan="3" scope="col" class="split category3">obs</th>-->
		<th colspan="3" scope="col" class="split category2">전치</th>
		<th colspan="3" scope="col" class="split category2">소구치</th>
		<th colspan="3" scope="col" class="split category2">전치Re</th>
		<th colspan="3" scope="col" class="split category2">소구치Re</th>
		<th rowspan="2" scope="col" class="split category2">Endo완료</th>
		<th rowspan="2" scope="col" class="split category2">ReEndo완료</th>
<!--		<th rowspan="2" scope="col" class="split category2">PRe St(Endo)</th>-->
		<th rowspan="2" scope="col" class="split category3">Ant Resin</th>
		<th rowspan="2" scope="col" class="split category3">Post Resin</th>
		<th rowspan="2" scope="col" class="split category3">Cervial Resing</th>
		<th rowspan="2" scope="col" class="split category3">Amalgam</th>
		<th rowspan="2" scope="col" class="split category3">Op완료</th>
<!--		<th rowspan="2" scope="col" class="split category3">Pre ST(AF)</th>
		<th rowspan="2" scope="col" class="split category3">Pre ST(OP)</th>-->
		<th rowspan="2" scope="col" class="split category3">Pre ST(Inlay Gold)</th>
		<th rowspan="2" scope="col" class="split category3">Pre ST(Inlay Resin)</th>
		<th rowspan="2" scope="col" class="split category4">득점</th>
		<th rowspan="2" scope="col" class="split category4">감점</th>
		<th rowspan="2" scope="col" class="split category4">총점</th>
	</tr>
	<tr>
		<!--<th scope="col" class="split category3">a-pm</th>
		<th scope="col" class="split category3">m</th>-->
		<th scope="col" class="split category2">PE</th>
		<th scope="col" class="split category2">CE</th>
		<th scope="col" class="split category2">CF</th>
		<th scope="col" class="split category2">PE</th>
		<th scope="col" class="split category2">CE</th>
		<th scope="col" class="split category2">CF</th>
		<th scope="col" class="split category2">GP제거</th>
		<th scope="col" class="split category2">CE</th>
		<th scope="col" class="split category2">CF</th>
		<th scope="col" class="split category2">GP제거</th>
		<th scope="col" class="split category2">CE</th>
		<th scope="col" class="split category2">CF</th>
	</tr>
	<?php endif?>
	<tr>
		<th scope="col" class="split category1">Require</th>
<!--		<th scope="col" class="split category3"><?php echo $d['khusd_st_consv']['require']['follow']['indirect']?></th>--> <!--ind req-->
<!--		<th colspan="2" scope="col" class="split category3"><?php echo $d['khusd_st_consv']['require']['follow']['endo']?></th>-->
<!--		<th scope="col" class="split category3"><?php echo $d['khusd_st_consv']['require']['follow']['surgery']?></th>--> <!--sur req-->
<!--		<th scope="col" class="split category3"><?php echo $d['khusd_st_consv']['require']['follow']['bleach']?></th>--> <!--ble req-->
		<th colspan="3" scope="col" class="split category2"></th>
		<th colspan="3" scope="col" class="split category2"></th>
		<th colspan="3" scope="col" class="split category2"></th>
		<th colspan="3" scope="col" class="split category2"></th>
		<th scope="col" class="split category2"></th>
		<th scope="col" class="split category2"></th>
		<!--<th scope="col" class="split"></th>-->
		<th scope="col" class="split category3"></th>
		<th scope="col" class="split category3"></th>
		<th scope="col" class="split category3"></th>
		<th scope="col" class="split category3"></th>
		<th scope="col" class="split category3"></th>
		<th scope="col" class="split"></th>
		<th scope="col" class="split"></th>
		<!--<<th scope="col" class="split"></th>
		<th scope="col" class="split"></th>-->
		<th colspan="3" scope="col" class="split category4"></th>
	</tr>
	</thead>
	<tbody>
	
	<tr>
		<td></td>
		<td class="avg">평균</th>
<!--		<td class="avg"><?php echo sprintf("%1.1f",$AVG['fol_ind'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['fol_endapm'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['fol_endm'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['fol_sur'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['fol_ble'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['fol_sc'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['fol_sc_m'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['fol_sc_obs'])?></td>-->
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['pre_st_ant_pe'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['pre_st_ant_ce'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['pre_st_ant_cf'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['pre_st_pre_pe'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['pre_st_pre_ce'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['pre_st_pre_cf'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['pre_st_ant_re_rm'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['pre_st_ant_re_ce'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['pre_st_ant_re_cf'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['pre_st_pre_re_rm'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['pre_st_pre_re_ce'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['pre_st_pre_re_cf'])?></td>
		<td class="avg"><?php echo sprintf("%1.0f",$AVG['pre_st_endo'])?></td>
		<td class="avg"><?php echo sprintf("%1.0f",$AVG['pre_st_re_endo'])?></td>
		<!--<<td class="avg"><?php echo sprintf("%1d",$AVG['pre_st_endo'])?>명</td>-->
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['pre_st_ant'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['pre_st_post'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['pre_st_cervical'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['pre_st_am'])?></td>
		<td class="avg"><?php echo sprintf("%1.0f",$AVG['pre_st_op'])?></td>
		<!--<<td class="avg"><?php echo sprintf("%1d",$AVG['pre_st_am'])?>명</td>
		<td class="avg"><?php echo sprintf("%1d",$AVG['pre_st_op'])?>명</td>-->
		<td class="avg"><?php echo sprintf("%1d",$AVG['pre_st_inlay_gold'])?></td>
		<td class="avg"><?php echo sprintf("%1d",$AVG['pre_st_inlay_resin'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['plus_score'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['minus_sc'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['obser_score'])?></td>
		<td></td>
	</tr>

	<?php $idx = 1?>
	<?php if(is_array($SCORE_ARRAY)) {?>

	<?php if(is_array($SCORE_ARRAY[$my['id']])):?>
	<?php $SCORE = $SCORE_ARRAY[$my['id']]?>
	<tr class="mine">
	<td colspan="2">내점수</td>

<!--	<td><?php echo $SCORE['fol_ind']?></td>
	<td><?php echo $SCORE['fol_endapm']?></td>
	<td><?php echo $SCORE['fol_endm']?></td>
	<td><?php echo $SCORE['fol_sur']?></td>
	<td><?php echo $SCORE['fol_ble']?></td>
	<td><?php echo $SCORE['fol_sc']?></td>
	<td><?php echo $SCORE['fol_sc_m']?></td>
	<td><?php echo $SCORE['fol_sc_obs']?></td>-->
	<td><?php echo $SCORE['pre_st_ant_pe']?></td>
	<td><?php echo $SCORE['pre_st_ant_ce']?></td>
	<td><?php echo $SCORE['pre_st_ant_cf']?></td>
	<td><?php echo $SCORE['pre_st_pre_pe']?></td>
	<td><?php echo $SCORE['pre_st_pre_ce']?></td>
	<td><?php echo $SCORE['pre_st_pre_cf']?></td>
	<td><?php echo $SCORE['pre_st_ant_re_rm']?></td>
	<td><?php echo $SCORE['pre_st_ant_re_ce']?></td>
	<td><?php echo $SCORE['pre_st_ant_re_cf']?></td>
	<td><?php echo $SCORE['pre_st_pre_re_rm']?></td>
	<td><?php echo $SCORE['pre_st_pre_re_ce']?></td>
	<td><?php echo $SCORE['pre_st_pre_re_cf']?></td>
	<td class="category3"><?php echo ($SCORE['pre_st_endo'] == 1 ? '완' : '')?></td>
	<td class="category3"><?php echo ($SCORE['pre_st_re_endo'] == 1 ? '완' : '')?></td>
	<td class="category2"><?php echo $SCORE['pre_st_ant']?></td>
	<td><?php echo $SCORE['pre_st_post']?></td>
	<td class="category2"><?php echo $SCORE['pre_st_cervical']?></td>
	<td class="category2"><?php echo $SCORE['pre_st_am']?></td>
<!--	<td><?php echo ($SCORE['pre_st_am'] == 1 ? '완' : '')?></td>-->
	<td><?php echo ($SCORE['pre_st_op'] == 1 ? '완' : '')?></td>
	<td><?php echo ($SCORE['pre_st_inlay_gold'] == 1 ? '완' : ($SCORE['pre_st_inlay_gold_prep'].'/'.$SCORE['pre_st_inlay_gold_setting']))?></td>
	<td><?php echo ($SCORE['pre_st_inlay_resin'] == 1 ? '완' : ($SCORE['pre_st_inlay_resin_prep'].'/'.$SCORE['pre_st_inlay_resin_setting']))?></td>
	<td class="category4"><?php echo $SCORE['plus_score']?></td>
	<td class="category4"><?php echo "-".$SCORE['minus_sc']?></td>
	<td class="category4"><?php echo $SCORE['obser_score']?></td>
	
	<td><?php echo getDateFormat($SCORE['date_update'],"Y-m-d H:i")?></td>
	</tr>
	<?php endif?>


	<?php foreach($SCORE_ARRAY as $SCORE):?>
	<tr <?php if($my['id']==$SCORE['st_id']):?> class="mine"<?php endif?>>
		<td><?php echo $idx++?></td>
		<td class="hand" onclick="getMemberLayer2('<?php echo $SCORE['st_info']['memberuid']?>',event);">
			<p><?php echo $SCORE['st_id']?> <?php echo $SCORE['st_info']['name']?></p>
		</td>
		
<!--		<td><?php echo $SCORE['fol_ind']?></td>
		<td><?php echo $SCORE['fol_endapm']?></td>
		<td><?php echo $SCORE['fol_endm']?></td>
		<td><?php echo $SCORE['fol_sur']?></td>
		<td><?php echo $SCORE['fol_ble']?></td>
		<td><?php echo $SCORE['fol_sc']?></td>
		<td><?php echo $SCORE['fol_sc_m']?></td>
		<td><?php echo $SCORE['fol_sc_obs']?></td>-->
		<td><?php echo $SCORE['pre_st_ant_pe']?></td>
		<td><?php echo $SCORE['pre_st_ant_ce']?></td>
		<td><?php echo $SCORE['pre_st_ant_cf']?></td>
		<td><?php echo $SCORE['pre_st_pre_pe']?></td>
		<td><?php echo $SCORE['pre_st_pre_ce']?></td>
		<td><?php echo $SCORE['pre_st_pre_cf']?></td>
		<td><?php echo $SCORE['pre_st_ant_re_rm']?></td>
		<td><?php echo $SCORE['pre_st_ant_re_ce']?></td>
		<td><?php echo $SCORE['pre_st_ant_re_cf']?></td>
		<td><?php echo $SCORE['pre_st_pre_re_rm']?></td>
		<td><?php echo $SCORE['pre_st_pre_re_ce']?></td>
		<td><?php echo $SCORE['pre_st_pre_re_cf']?></td>
		<td><?php echo ($SCORE['pre_st_endo'] == 1 ? '완' : '')?></td>
		<td><?php echo ($SCORE['pre_st_re_endo'] == 1 ? '완' : '')?></td>
		<td class="category2"><?php echo $SCORE['pre_st_ant']?></td>
		<td><?php echo $SCORE['pre_st_post']?></td>
		<td class="category2"><?php echo $SCORE['pre_st_cervical']?></td>
		<td class="category2"><?php echo $SCORE['pre_st_am']?></td>
<!--		<td><?php echo ($SCORE['pre_st_am'] == 1 ? '완' : '')?></td>-->
		<td><?php echo ($SCORE['pre_st_op'] == 1 ? '완' : '')?></td>
		<td><?php echo ($SCORE['pre_st_inlay_gold'] == 1 ? '완' : ($SCORE['pre_st_inlay_gold_prep'].'/'.$SCORE['pre_st_inlay_gold_setting']))?></td>
		<td><?php echo ($SCORE['pre_st_inlay_resin'] == 1 ? '완' : ($SCORE['pre_st_inlay_resin_prep'].'/'.$SCORE['pre_st_inlay_resin_setting']))?></td>
		<td class="category4"><?php echo $SCORE['plus_score']?></td>
		<td class="category4"><?php echo "-".$SCORE['minus_sc']?></td>
		<td class="category4"><?php echo $SCORE['obser_score']?></td>
	
	<td><?php echo getDateFormat($SCORE['date_update'],"Y-m-d H:i")?></td>
	</tr>
	<?php endforeach?>
	<?php }?>
	</tbody>
	</table>
</div>
