<div id="ortho_history" class="khusd_st list ortho">

	<table summary="치주과 점수표 기록입니다.">
	<caption>교정과 점수표 기록</caption> 
	<colgroup> 
	<col width="35">
	<col width="125"> 
	<col width="120"> 
	<col width="40"> <!--follow old cnt-->
	<col width="40"> <!--follow old obs cnt-->
	<col width="40"> <!--follow old score-->
	<col width="40"> <!--follow new cnt-->
	<col width="40"> <!--follow new obs cnt-->
	<col width="40"> <!--follow new score-->
	<col width="40"> <!--simple obs count-->
	<col width="40"> <!--simple obs score-->
	<col width="40"> <!--appliance score-->
	<col width="40"> <!--appliance A/B/C score-->
	<col width="40"> <!--total score-->
	<col width="150"> 
	</colgroup> 
	<thead>
	<tr>
	<th scope="col" class="split">No</th>
	<th scope="col" class="split">학번</th>
	<th scope="col" class="split">이름</th>
	<th scope="col" class="split">구환 명수</th>
	<th scope="col" class="split">구환 횟수</th>
	<th scope="col" class="split">유효 구환 점수</th>
	<th scope="col" class="split">신환 명수</th>
	<th scope="col" class="split">신환 횟수</th>
	<th scope="col" class="split">유효 신환 점수</th>
	<th scope="col" class="split">옵져 횟수</th>
	<th scope="col" class="split">유효 옵져 점수</th>
	<th scope="col" class="split">기공 점수</th>
	<th scope="col" class="split">A/B/C</th>
	<th scope="col" class="split">총점</th>
	<th scope="col">수정일</th>
	</tr>
	</thead>
	<tbody>
	
	<?php $idx = 1?>
	<?php if(is_array($SCORE_ARRAY)) {?>
	<?php foreach($SCORE_ARRAY as $SCORE):?>
	<?php if($idx == 1) $simple_obser = $SCORE['obser']?>
	<tr>
	<td><?php echo $idx++?></td>
	<td class="hand" onclick="getMemberLayer2('<?php echo $SCORE['st_info']['memberuid']?>',event);"><?php echo $SCORE['st_id']?></td>
	<td class="hand" onclick="getMemberLayer2('<?php echo $SCORE['st_info']['memberuid']?>',event);"><?php echo $SCORE['st_info']['name']?></td>

	<td><?php echo $SCORE['follow_old_cnt']?></td>
	<td><?php echo $SCORE['follow_old_obs_cnt']?></td>
	<td><?php echo $SCORE['follow_old']?></td>
	<td><?php echo $SCORE['follow_new_cnt']?></td>
	<td><?php echo $SCORE['follow_new_obs_cnt']?></td>
	<td><?php echo $SCORE['follow_new']?></td>
	<td><?php echo $SCORE['obser_cnt']?></td>
	<td><?php echo $SCORE['obser']?></td>
	<td><?php echo $SCORE['appliance_score']?></td>
	<td><?php echo $SCORE['fabri_a']?>/<?php echo $SCORE['fabri_b']?>/<?php echo $SCORE['fabri_c']?></td>
	<td><?php echo $SCORE['total_score']?></td>
	
	<td><?php echo getDateFormat($SCORE['date_update'],"Y-m-d H:i")?></td>
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
		<div class="pagebox01">
			<?php echo getPageLink($d['theme']['pagenum'],$p,$TPG,$g['img_core'].'/page/default')?>
		</div>
	</div>

        <br><br><br>
        <table summary="점수표 입니다.">
        <caption>세부 내역</caption>
        <colgroup>
        <col width="10">
        <col width="30">
        <col width="30">
        <col width="20">
        <col width="20">
        <col width="20">
        <col width="20">
        <col width="20">
        <col width="20">
        <col width="20">
        <col width="20">
        </colgroup>
        <thead>
	<tr>
        <th scope="col" rowspan=1 class="split">No</th>
        <th scope="col" rowspan=1 class="split">환자명</th>
        <th scope="col" rowspan=1 class="split">병록번호</th>
        <th scope="col" rowspan=1 class="split">상태</th>
        <th scope="col" rowspan=1 class="split">분석/본필/본딩</th>
        <th scope="col" rowspan=1 class="split">F/U횟수</th>
        <th scope="col" rowspan=1 class="split">레포트</th>
        <th scope="col" rowspan=1 class="split">F/U점수</th>
        <th scope="col" rowspan=1 class="split">Obser 점수</th>
        <th scope="col" rowspan=1 class="split">레포트점수</th>
        <th scope="col" rowspan=1 class="split">합</th>
	</tr>
	<tr>
        <th scope="col" rowspan=1 class="split"></th>
        <th scope="col" rowspan=1 class="split"></th>
        <th scope="col" rowspan=1 class="split"></th>
        <th scope="col" rowspan=1 class="split"></th>
        <th scope="col" rowspan=1 class="split"></th>
        <th scope="col" rowspan=1 class="split"></th>
        <th scope="col" rowspan=1 class="split"></th>
        <th scope="col" rowspan=1 class="split">(신환:<?php echo $d['khusd_st_ortho']['score']['follow_req_new']?> 회 이상, 구환:<?php echo $d['khusd_st_ortho']['score']['follow_req_old']?> 회 이상시 &#931F/U횟수)</th>
        <th scope="col" rowspan=1 class="split">(신환:<?php echo $d['khusd_st_ortho']['score']['follow_req_new']?>회 미만시 0 구환:<?php echo $d['khusd_st_ortho']['score']['follow_req_old']?>회 미만시 <?php echo $d['khusd_st_ortho']['score']['obser']?> )</th>
        <th scope="col" rowspan=1 class="split">(신환:<?php echo $d['khusd_st_ortho']['score']['follow_new_report']?> 구환:<?php echo $d['khusd_st_ortho']['score']['follow_old_report']?>)</th>
        <th scope="col" rowspan=1 class="split"></th>
	</tr>
        </thead>
        <tbody>
	<?php include_once $g['path_module'].'khusd_st_ortho/function/calc.php'?> 
        <?php $idx=1?>
        <?php foreach($MY_FOLLOW_ARRAY as $MY_FOLLOW):?>
        <tr >
        <td><?php echo $idx++?></td>
        <td><?php echo $MY_FOLLOW['pt_name']?></td>
        <td><?php echo $MY_FOLLOW['pt_id']?></td>
        <td>
      		<?php if($MY_FOLLOW['type']==$d['khusd_st_ortho']['FOLLOW_TYPE']['NEW'] && $MY_FOLLOW['status'] == $d['khusd_st_ortho']['FOLLOW_STATUS']['FOLLOWING']):?>신환 팔로중
                <?php elseif($MY_FOLLOW['type']==$d['khusd_st_ortho']['FOLLOW_TYPE']['OLD'] && $MY_FOLLOW['status'] == $d['khusd_st_ortho']['FOLLOW_STATUS']['FOLLOWING']):?>구환 팔로중
                <?php elseif($MY_FOLLOW['type']==$d['khusd_st_ortho']['FOLLOW_TYPE']['NEW'] && $MY_FOLLOW['status'] == $d['khusd_st_ortho']['FOLLOW_STATUS']['COMPLETE']):?><b style="color:blue">신환 완료</b>
                <?php elseif($MY_FOLLOW['type']==$d['khusd_st_ortho']['FOLLOW_TYPE']['OLD'] && $MY_FOLLOW['status'] == $d['khusd_st_ortho']['FOLLOW_STATUS']['COMPLETE']):?><b style="color:green">구환 완료</b>
                <?php else:?>팔로 중단
                <?php endif?>
        </td>
        <td><?php echo $MY_FOLLOW['bool_analysis']?>/<?php echo $MY_FOLLOW['bool_mandatorybonding']?>/<?php echo $MY_FOLLOW['bool_bonding']?> </td>
        <td><?php echo $MY_FOLLOW['step']?></td>
        <td><?php echo $MY_FOLLOW['report']?></td>
	<td><?php echo _follow_point($MY_FOLLOW['type'], $MY_FOLLOW['report'] ,  $MY_FOLLOW['bool_analysis'] ,$MY_FOLLOW['bool_mandatorybonding'] ,$MY_FOLLOW['bool_bonding'] ,  intval($MY_FOLLOW['step'])  ,
$d['khusd_st_ortho']['FOLLOW_TYPE']['NEW'],$d['khusd_st_ortho']['FOLLOW_TYPE']['OLD'],
$d['khusd_st_ortho']['score']['follow_req_new'],$d['khusd_st_ortho']['score']['follow_req_old'],
$d['khusd_st_ortho']['score']['follow_new_report'],  $d['khusd_st_ortho']['score']['follow_old_report'], $d['khusd_st_ortho']['score']['obser']
 ) ?></td>
	<td><?php echo obser_point($MY_FOLLOW['type'], $MY_FOLLOW['report'] ,  $MY_FOLLOW['bool_analysis'] ,$MY_FOLLOW['bool_mandatorybonding'] ,$MY_FOLLOW['bool_bonding'] ,  intval($MY_FOLLOW['step'])  ,
$d['khusd_st_ortho']['FOLLOW_TYPE']['NEW'],$d['khusd_st_ortho']['FOLLOW_TYPE']['OLD'],
$d['khusd_st_ortho']['score']['follow_req_new'],$d['khusd_st_ortho']['score']['follow_req_old'],
$d['khusd_st_ortho']['score']['follow_new_report'],  $d['khusd_st_ortho']['score']['follow_old_report'], $d['khusd_st_ortho']['score']['obser']
 ) ?></td>
	<td><?php echo _report_point($MY_FOLLOW['type'], $MY_FOLLOW['report'] ,  $MY_FOLLOW['bool_analysis'] ,$MY_FOLLOW['bool_mandatorybonding'] ,$MY_FOLLOW['bool_bonding'] ,  intval($MY_FOLLOW['step'])  ,
$d['khusd_st_ortho']['FOLLOW_TYPE']['NEW'],$d['khusd_st_ortho']['FOLLOW_TYPE']['OLD'],
$d['khusd_st_ortho']['score']['follow_req_new'],$d['khusd_st_ortho']['score']['follow_req_old'],
$d['khusd_st_ortho']['score']['follow_new_report'],  $d['khusd_st_ortho']['score']['follow_old_report'], $d['khusd_st_ortho']['score']['obser']
 ) ?></td>
	<td><?php echo follow_obser_point($MY_FOLLOW['type'], $MY_FOLLOW['report'] ,  $MY_FOLLOW['bool_analysis'] ,$MY_FOLLOW['bool_mandatorybonding'] ,$MY_FOLLOW['bool_bonding'] ,  intval($MY_FOLLOW['step'])  ,
$d['khusd_st_ortho']['FOLLOW_TYPE']['NEW'],$d['khusd_st_ortho']['FOLLOW_TYPE']['OLD'],
$d['khusd_st_ortho']['score']['follow_req_new'],$d['khusd_st_ortho']['score']['follow_req_old'],
$d['khusd_st_ortho']['score']['follow_new_report'],  $d['khusd_st_ortho']['score']['follow_old_report'], $d['khusd_st_ortho']['score']['obser']
 ) ?></td>

        </tr>
	<?php $simple_obser = $simple_obser - obser_point($MY_FOLLOW['type'], $MY_FOLLOW['report'] ,  $MY_FOLLOW['bool_analysis'] ,$MY_FOLLOW['bool_mandatorybonding'] ,$MY_FOLLOW['bool_bonding'] ,  intval($MY_FOLLOW['step'])  ,
$d['khusd_st_ortho']['FOLLOW_TYPE']['NEW'],$d['khusd_st_ortho']['FOLLOW_TYPE']['OLD'],
$d['khusd_st_ortho']['score']['follow_req_new'],$d['khusd_st_ortho']['score']['follow_req_old'],
$d['khusd_st_ortho']['score']['follow_new_report'],  $d['khusd_st_ortho']['score']['follow_old_report'], $d['khusd_st_ortho']['score']['obser']
 )     ?>
        <?php endforeach?>
	<?php foreach($SCORE_ARRAY as $SCORE):?>
	<tr>
        <td><?php echo $idx++?></td>
        <td>기공점수</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><?php echo $SCORE['appliance_score']?></td>
	</tr>
	<tr>
        <td><?php echo $idx++?></td>
        <td>단순obser</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><?php echo $simple_obser?></td>
        <td></td>
        <td><?php echo $simple_obser?></td>
	</tr>
	<tr>
        <td></td>
        <td>총점</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
	<td><?php echo $SCORE['total_score']?></td>
	</tr>
	<?php break?>
        <?php endforeach?>
        </tbody>

        </table>



</div>
