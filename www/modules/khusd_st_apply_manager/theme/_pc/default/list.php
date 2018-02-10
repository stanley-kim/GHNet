


<script type="text/javascript">
function timeMsg()
{
var t=setTimeout("alertMsg()",10000);
}
function alertMsg()
{
alert("Hello");
}
</script>

<?php
/*
$ITEM_ARRAY = array();
$ITEM_ARRAY2 = array();
//$ITEM_ROWS = getDbArray($table[$m.'apply_info_list'], '','*','uid','ASC',0,0);
$ITEM_ROWS = getDbArray($table[$m.'apply_info_list'],  " status = '".$d['khusd_st_apply_manager']['apply_info']['OPEN']."'"   ,'*','uid','ASC',0,0);
__debug_print("push func: Could not connect to server91. - ".'_'.mysql_error());
while($ITEM = db_fetch_array($ITEM_ROWS))
{
	if (  $ITEM['status'] == $d['khusd_st_apply_manager']['apply_info']['OPEN'] && $ITEM['date_end'] <= $date['totime']   )   {
// close apply_info
		getDbUpdate($table[$m.'apply_info_list']
	        , "status = '".$d['khusd_st_apply_manager']['apply_info']['CLOSED']."'"
                .", date_select = '".$date['totime']."'"
	        , "uid = '".$ITEM['uid']."'"
		);
// update apply_list to generate random value
		getDbUpdate($table[$m.'apply_list'], 'rand = RAND( UNIX_TIMESTAMP() )', "apply_info_uid = '".$ITEM['uid']."' AND status = '".$d['khusd_st_apply_manager']['apply_list']['APPLY']."'");
		$ITEM_ROWS2 = getDbArray($table[$m.'apply_item'], 'apply_info_uid='.$ITEM['uid'],'*','uid','ASC',0,0);
		while($ITEM2 = db_fetch_array($ITEM_ROWS2))
		{		

		        // 기존 당첨자 수 구하기
		        $ACCEPTED_NUM = getDbRows($table[$m.'apply_list'],
                                "apply_item_uid = '".$ITEM2['uid']."'"
                                ." AND status = '".$d['khusd_st_apply_manager']['apply_list']['ACCEPTED']."'"
		        );

		        if($ACCEPTED_NUM < $ITEM2['accept_limit'])
		        {
				$apply_info = getUidData($table[$m.'apply_info_list'], $ITEM2['uid']);

		                db_query("UPDATE ".$table[$m.'apply_list']
                                ." SET status = '".$d['khusd_st_apply_manager']['apply_list']['ACCEPTED']."'"
                                ." WHERE apply_item_uid = '".$ITEM2['uid']."'"
                                ." AND status = '".$d['khusd_st_apply_manager']['apply_list']['APPLY']."'"
                                ." AND date_reg >= '".$apply_info['date_start']."'"
                                ." ORDER BY rand DESC"
                                .( $ITEM2['accept_limit'] == 0 ? '' : ' LIMIT '.($ITEM2['accept_limit'] - $ACCEPTED_NUM) ), $DB_CONNECT);
		        }
		}		

	}

}   //end of while

$_new_apply_info = 0;
// control pre_apply_info_list 
$_status =  $d['khusd_st_apply_manager']['apply_info']['pre_apply_info']['status']['finished']  ;   //finish
$ITEM_ROWS = getDbArray($table[$m.'pre_apply_info_list'], " status != '".$_status."'"  ,'*','uid','ASC',0,0);
	
__debug_print("push func: Could not connect to server99991. - " . $ITEM['subject'].'_'.mysql_error());
while($ITEM = db_fetch_array($ITEM_ROWS))  //each pre_apply_infos (not finished)
{
	if( $ITEM['status']  != $_status  && $ITEM['date_start'] < $date['totime']  )    {   //have to start new apply_info
		__debug_print("push func: Could not connect to server9999x. - " . $ITEM['subject'].'_'.$ITEM['date_start'].'_'.$ITEM['status'].'_'.mysql_error());
		$s_uid = $ITEM['s_uid']; 
		$st_id = $ITEM['st_id'];
		$apply_limit= $ITEM['apply_limit'];
		$department = $ITEM['department'];
		$subject    = $ITEM['subject'];
		$content    = $ITEM['content'];
		$date_start = $ITEM['date_start'];
		$date_end   = $ITEM['date_end'];
		$apply_type = $ITEM['apply_type'];
		$status = $d['khusd_st_apply_manager']['apply_info']['OPEN']; 
		$able_apply_accepted = $ITEM['able_apply_accepted'];
		$is_perio_surgery    = $ITEM['is_perio_surgery'];
		$date_reg = $date['totime'];
		$order = $ITEM['info_order'];
		//make new apply_info
	        $_QKEY = 's_uid, st_id, apply_limit, department, subject, content, date_start, date_end, apply_type, status, able_apply_accepted, is_perio_surgery, date_reg, info_order ';
	        $_QVAL = "'$s_uid', '$st_id', '$apply_limit','$department', '$subject', '$content', '$date_start', '$date_end', '$apply_type', '$status', '$able_apply_accepted', '$is_perio_surgery', '$date_reg', '$order'";
	        getDbInsert($table[$m.'apply_info_list'],$_QKEY, $_QVAL);
		$_new_apply_info += 1;
		//update pre_apply_info's status as finished
		getDbUpdate($table[$m.'pre_apply_info_list'], "status = '".$_status."'", "uid = '".$ITEM['uid']."'" );

		//get apply_info's uid
	        $query = "select uid "
	        ." from rb_khusd_st_apply_manager_apply_info_list as info_list"
	        ." where info_list.department = '".$department."'"
	        ." and info_list.subject = '".$subject."'"
	        ." and info_list.info_order = '".$order."'"
	        ." and info_list.date_end = '".$date_end."'"
	        ." order by uid";

	        $_count = 0;
	        global $DB_CONNECT;
	        $_ROWS = db_query($query, $DB_CONNECT);
	        while( $_ROW = db_fetch_array($_ROWS) ){
	                $_apply_info_uid = $_ROW['uid'] ;
	                $_count = $_count +  1;
	        }

	
		//update pre_apply_info's apply_info_uid
		if( isset($_apply_info_uid)  )
		getDbUpdate($table[$m.'pre_apply_info_list'], "apply_info_uid = '".$_apply_info_uid."'", "uid = '".$ITEM['uid']."'" );
		//transfer previous apply_items
        // 새로 추가된 신청의 uid 가져온다.
        $LASTUID = getDbCnt($table[$m.'apply_info_list'],'max(uid)','');
        // 추가 신청은... 새로 생성하되, uid 에 있는 item들과 '당첨자'들 정보를 가져온다...!!!
        $ITEM_ROWS = getDbArray($table[$m.'apply_item'], "apply_info_uid='".$ITEM['parent_apply_info_uid']."'",'*','uid','asc',0,0);
        while($_ITEM = db_fetch_array($ITEM_ROWS))
        {
                $_QKEY = 'apply_info_uid, content, ref_uid, accept_limit, date_reg, date_item, doctor, assist, pt_id, pt_name, is_imp_cent, sub_category';
                $_QVAL = "'".$LASTUID."', '".mysql_real_escape_string($_ITEM['content'])."', '".$_ITEM['ref_uid']."', '".$_ITEM['accept_limit']."', '".$_ITEM['date_reg']."'"
                                .", '".$_ITEM['date_item']."', '".$_ITEM['doctor']."', '".$_ITEM['assist']."', '".$_ITEM['pt_id']."', '".$_ITEM['pt_name']."', '".$_ITEM['is_imp_cent']."', '".$_ITEM['sub_category']."'";

                getDbInsert($table[$m.'apply_item'],$_QKEY, $_QVAL);
                // 새로 추가된 uid 가져온다.
                $ITEM_LASTUID = getDbCnt($table[$m.'apply_item'],'max(uid)','');

                // 당첨자들도 추가
                $APPLIER_ROWS = getDbArray($table[$m.'apply_list'].' al',
                                                "al.apply_item_uid='".$_ITEM['uid']."' AND al.status ='".$d['khusd_st_apply_manager']['apply_list']['ACCEPTED']."'",
                                                'al.*',
                                                'al.date_reg, al.timestamp',
                                                'asc',
                                                0,
                                                0);

                while($APPLIER = db_fetch_array($APPLIER_ROWS))
                {
                        $_QKEY = 'st_id, apply_info_uid, apply_item_uid, original_apply_item_uid, rand, timestamp, date_reg, status';
                        $_QVAL = "'".$APPLIER['st_id']."', '".$LASTUID."', '".$ITEM_LASTUID."', '".$_ITEM['uid']."', '".$APPLIER."', '".$APPLIER['timestamp']."', '".$APPLIER['date_reg']."', '".$APPLIER['status']."'";

                        getDbInsert($table[$m.'apply_list'],$_QKEY, $_QVAL);
                }
        }
        // item 수 구하기
        $num_item = getDbRows($table[$m.'apply_item'],"apply_info_uid = '".$LASTUID."'");
        // apply_info_list 의 num_item 업데이트
        getDbUpdate($table[$m.'apply_info_list'], "num_item='".$num_item."'", "uid = '".$LASTUID."'");
	}
}

if( $_new_apply_info > 0 )   {
		//$_status = $d['khusd_st_apply_manager']['apply_info']['OPEN'];
		$_status =  $d['khusd_st_apply_manager']['apply_info']['pre_apply_info']['status']['finished']  ;   //finish
		$close_finished = array();
		//make close_finished  array		 
		$FINISHED_ITEM_ROWS = getDbArray($table[$m.'pre_apply_info_list'], " status = '".$_status."'"  ,'*','uid','ASC',0,0);
		while($ITEM = db_fetch_array($FINISHED_ITEM_ROWS))  //each pre_apply_infos (finished)
		{
			if( $ITEM['status'] == $_status  && $ITEM['date_start'] < $date['totime'] && $ITEM['date_end'] > $date['totime']   )    {   
__debug_print("close_finished making." . $ITEM['uid'].'_'.$ITEM['parent_apply_info_uid'].'_'.$ITEM['apply_info_uid'].'_' .mysql_error());
				$close_finished[ $ITEM['parent_apply_info_uid'] ]  = $ITEM['apply_info_uid']   ;
			}
		}

		$_status =  $d['khusd_st_apply_manager']['apply_info']['pre_apply_info']['status']['finished']  ;   //finish
		$BOOKED_ITEM_ROWS = getDbArray($table[$m.'pre_apply_info_list'], " status != '".$_status."'"  ,'*','uid','ASC',0,0);
		while($ITEM = db_fetch_array($BOOKED_ITEM_ROWS))  //each pre_apply_infos (finished)
		{
			if( $ITEM['status'] != $_status  && $ITEM['date_start'] > $date['totime'] && isset($close_finished[$ITEM['parent_apply_info_uid']])  )   { 
__debug_print("close_finished test." . $ITEM['status'].'_'.mysql_error());
				$_next_uid = $close_finished[$ITEM['parent_apply_info_uid']]; 
				getDbUpdate($table[$m.'pre_apply_info_list'], "parent_apply_info_uid = '".$_next_uid."'", "uid = '".$ITEM['uid']."'" );
			}
		}

}
		
*/
?>

<div id="apply_info_list" class="khusd_st list apply">

	<div style="height:200px; overflow:auto">
	<?php getWidget('khusd/my_apply_manager',array('recnum'=>'50',))?>
	</div>

	<div class="info">
	</div>
	
	<table summary="신청 리스트 입니다.">
	<caption>신청 리스트</caption> 
	<colgroup> 
	<col width="50"> 
	<col width="50"> 
	<col> 
	<col width="80"> 
	<col width="80"> 
	<col width="80"> 
	<col width="80"> 
	<col width="90">
	</colgroup> 
	<thead>
	<tr>
	<th scope="col" class="side1">번호</th>
	<th scope="col">분류</th>
	<th scope="col">제목</th>
	<th scope="col">올린이</th>
	<th scope="col">신청 항목 개수</th>
	<th scope="col">선정 방식</th>
	<th scope="col">마감여부</th>
	<th scope="col" class="side2">신청날짜</th>
	</tr>
	</thead>
	<tbody>
	
	<?php $idx = 1?>
	<?php if(is_array($APPLY_INFO_ARRAY) && count($APPLY_INFO_ARRAY) > 0):?>
		<?php foreach($APPLY_INFO_ARRAY as $APPLY_INFO):?>
		
		<tr <?php if($APPLY_INFO['status'] == $d['khusd_st_apply_manager']['apply_info']['OPEN']):?>class="open"<?php endif?>>
		<td><?php echo $idx++?></td>
		<td><?php echo $dept_array[$APPLY_INFO['department']]['name']?></td>
		<td class="sbj"><a href="<?php echo $g['apply_info_view'].$APPLY_INFO['uid']?>"><?php echo $APPLY_INFO['subject'].' '.$APPLY_INFO['info_order']?></a></td>
		<td class="name hand" onclick="getMemberLayer2('<?php echo $APPLY_INFO['mbruid']?>',event);"><?php echo $APPLY_INFO['name']?></td>
		<td><?php echo $APPLY_INFO['num_item']?></td>
		<td><?php if($APPLY_INFO['apply_type'] == 'rand'):?>랜덤<?php elseif($APPLY_INFO['apply_type'] == 'fcfs'):?>선착순<?php endif?></td>
		<td><?php if($APPLY_INFO['status'] == $d['khusd_st_apply_manager']['apply_info']['CLOSED']):?>마감<?php endif?>
		<td><?php echo getDateFormat($APPLY_INFO['date_start'],'Y-m-d H:i')?></td>
		</tr>
		<?php endforeach?>
	<?php else:?>
	<tr>
		<td colspan="8">신청 없음</td>
	</tr>
	<?php endif?>




	
	</tbody>
	</table>
	<div class="bottom">
		<div class="btnbox1">
			<span class="btn00">
				<a href="<?php echo $g['apply_info_add']?>">신청 추가</a>
			</span>
		</div>
		<div class="btnbox2"></div>
		<div class="clear"></div>
		<div class="pagebox01">
			<?php echo getPageLink($d['theme']['pagenum'],$p,$TPG,$g['img_core'].'/page/default')?>
		</div>
	</div>
	
</div>
