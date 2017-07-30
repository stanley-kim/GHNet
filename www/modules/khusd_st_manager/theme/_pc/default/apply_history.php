

<div id="apply_history" class="khusd_st manager">
	
	<form name="apply_history" action="<?php echo $g['s']?>/" method="get">
		<input type="hidden" name="r" value="<?php echo $r?>" />
		<input type="hidden" name="c" value="<?php echo $c?>" />
		<input type="hidden" name="m" value="<?php echo $m?>" />
		<input type="hidden" name="mode" value="<?php echo $mode?>" />


		학번 : <input type="text" name="st_id" value="<?php echo $st_id ? $st_id : ''?>" />
		이름 : <input type="text" name="st_name" value="<?php echo $st_name ? $st_name : ''?>" />
		<input type="submit" value="확인" class="btngray" />
		<?php echo $ST_INFO['name']?>
	</form>
	
	<table>
	<thead>
		<th width="150">신청시간</th>
		<th width="80">관련과</th>
		<th width="300">신청글</th>
		<th>신청항목</th>
		<th width="40">상태</th>
	</thead>
	<tbody>
	<?php foreach($APPLY_ARRAY as $APPLY):?>
	<tr>
		<td><?php echo getDateFormat($APPLY['date_reg'],'Y-m-d H:i')?></td>
		<td><?php echo $d['khusd_st_manager']['department'][$APPLY['department']]['name']?></td>
		<td>
			<a href="<?php echo $g['st_manager_apply_info_link'].$APPLY['apply_info_uid']?>">
				<?php echo $APPLY['apply_info_subject']?>
			</a>
		</td>
		<td>
			<a href="<?php echo $g['st_manager_apply_item_link'].$APPLY['apply_item_uid']?>">
				<?php echo $APPLY['apply_item_content']?>
			</a>
		</td>
		<td>
			<?php if($APPLY['status'] == $d['khusd_st_apply_manager']['apply_list']['ACCEPTED']):?>
			<span class="highlight">당첨</span>
			<?php elseif($APPLY['is_closed'] == 1):?>
			<span>탈락</span>
			<?php elseif($APPLY['date_reg'] >= $APPLY['date_start']):?>
			<span>신청</span>
			<?php else:?>
			<span>무효 신청</span>
			<?php endif?>
		</td>
	</tr>
	<?php endforeach?>
	</tbody>
	</table>
	
	
	<?php if( count($AVG_ARRAY) != 0):?>
	<table>
	<thead>
		<th width=120>학번</th>
		<th width=120>이름</th>
		<th width=80>신청 수</th>
		<th width=80>당첨</th>
		<th width=80>탈락</th>
		<th width=120>당첨 비율</th>
		<th width=120>평균 랜덤값</th>
	</thead>
	<tbody>
	<?php foreach($AVG_ARRAY as $_AVG):?>
	<tr>
		<td><?=$_AVG["avg_st_id"]?></td>
		<td><?=$_AVG["avg_name"]?></td>
		<td><?=$_AVG["total_count"]?></td>
		<td class="status_a"><?=$_AVG["a"]?></td>
		<td class="status_p"><?=$_AVG["p"]?></td>
		<td><?=number_format($_AVG["a_ratio"], 2)?>%</td>
		<td><?=number_format($_AVG["avg_rand"], 6)?></td>
	</tr>
	<?php endforeach?>
	</tbody>
	</table>


	<?php  


if( permcheck('duplication_checker') )  {
	include_once $g['path_module'].'khusd_st_manager/function/date.php';
		echo  "HIHI"."<br>";

        foreach($Duplicate_Check_Dic as $dcd1)  // each st_id
                foreach($dcd1 as $dcd2)         // each day
                        foreach($dcd2 as $dcd3)    { // each time
                                //sort($dcd3 ) 1st try; 
				//ksort to order by date_end
                                ksort($dcd3, SORT_NUMERIC ) ;
                                $a_flag = 0;
				$i = 0;
				//count of date_end to detect if it is last chasu
				$len = count($dcd3);  
                                foreach($dcd3 as $dcd4)    { // each date_end
                                        if( count($dcd4)>= 2 )  {
//echo  '<span style="color:blue;">HIHI??------------------>></span>'."<br>";
$prefix = '<span style="color:blue;">each google]';
                                        foreach($dcd4 as $dcd5)  {  // each uid
echo $prefix;
echo "ID)".$dcd5['st_id'].']환자예약시간)'.getDateFormat($dcd5['date_item'],'m/d').'('.getWeek(getDateFormat($dcd5['date_item'], 'w')).')'.' '.getDateFormat($dcd5['date_item'],'H:i').']차수신청시간)'.$dcd5['date_end'].']상태)'.$dcd5['status'].']rand)'.$dcd5['rand'];
echo ']세부항목) '.$dcd5['apply_item_content'].']차수제목) '.$dcd5['apply_info_subject']."<br>"  ;
echo '</span>';

                                        }
                                        }
                                        else  {
                                        foreach($dcd4 as $dcd5)  {  // each uid
$prefix='<span style="color:black;">each normal]';
if ($a_flag > 0 )  {
	//echo '<span style="color:blue;">HI?-----------------></span>'."<br>"  ;
	$prefix = '<span style="color:blue;">echo talk--]';
}
// if it is not last date_end , evenif 'a' case, no duplicate possibility
if ($dcd5['status'] == 'a' && $i != $len-1 )  {  
	$a_flag = 1;
	$prefix = '<span style="color:blue;">each kakao-]';
}
echo $prefix;
echo "ID)".$dcd5['st_id'].']환자예약시간)'.getDateFormat($dcd5['date_item'],'m/d').'('.getWeek(getDateFormat($dcd5['date_item'], 'w')).')'.' '.getDateFormat($dcd5['date_item'],'H:i').']차수신청시간)'.$dcd5['date_end'].']상태)'.$dcd5['status'].']rand)'.$dcd5['rand']   ;
echo ']세부항목) '.$dcd5['apply_item_content'].']차수제목) '.$dcd5['apply_info_subject']."<br>"  ;
echo '</span>';
                                        }


                                        }
			$i++;
                                }
                        }


} // end of if permcheck



	?>	
	<style>
	.status_a{background-color:#FDF5E6;}
	.status_p{background-color:#F0F8FF;}		
	</style>

	<?php endif?>
	<div class="bottom">
		<div class="btnbox1">
		</div>
		<div class="btnbox2"></div>
		<div class="clear"></div>
		<div class="pagebox01">
			<?php echo getPageLink($d['theme']['pagenum'],$p,$TPG,$g['img_core'].'/page/default')?>
		</div>
	</div>
</div>
