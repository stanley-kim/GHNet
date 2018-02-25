<div class="widget_my_apply_manager">
	<div class="title" style="border-bottom:#efefef dotted 2px;">
		<div class="article">
			<a href="#"><span class="name">내 신청 항목</span></a>
			<span class="stat">(<?=$my['id']?>)</span>
		</div>
		<div class="clear"></div>
	</div>
	<ul>
	<?php
		include_once $g['path_module'].'khusd_st_manager/var/var.php';	// 필수 인클루드 파일
		include_once $g['path_module'].'khusd_st_apply_manager/var/var.define.php';
		include_once $g['path_module'].'khusd_st_manager/function/date.php';
		include_once $g['path_module'].'khusd_st_manager/function/debug.php';
		$recnum = $wdgvar['recnum'];
		
/*		
		$MY_APPLY_ARRAY = getDbArray(
			$table['khusd_st_apply_manager'.'apply_list'].' al'
			.', '.$table['khusd_st_apply_manager'.'apply_info_list'].' ail'
			.', '.$table['khusd_st_apply_manager'.'apply_item'].' ai', 
			"al.st_id = '".$my['id']."'"
			." AND ("
				."al.status = '".$d['khusd_st_apply_manager']['apply_list']['APPLY']."'"
				." OR al.status = '".$d['khusd_st_apply_manager']['apply_list']['ACCEPTED']."'"
			." )"
			." AND al.apply_info_uid = ail.uid" 
			." AND al.apply_item_uid = ai.uid"

			." GROUP BY apply_item_content", 

			"al.*"
			.", IF(ail.status = '".$d['khusd_st_apply_manager']['apply_info']['CLOSED']."', 1, 0) AS is_closed"
			.", ail.subject AS apply_info_subject"
			.", ail.date_start AS date_start"
			.", ail.department AS department"
			.", ail.uid AS apply_info_uid"
			.", ai.content AS apply_item_content",
			'al.date_reg', 
			'DESC', 
			$recnum, 
			1
		);
*/
		$MY_APPLY_ARRAY = getDbArray(
			$table['khusd_st_apply_manager'.'apply_list'].' al'
			.', '.$table['khusd_st_apply_manager'.'apply_info_list'].' ail'
			.', '.$table['khusd_st_apply_manager'.'apply_item'].' ai', 
			"al.st_id = '".$my['id']."'"
			." AND ("
				."al.status = '".$d['khusd_st_apply_manager']['apply_list']['APPLY']."'"
				." OR al.status = '".$d['khusd_st_apply_manager']['apply_list']['ACCEPTED']."'"
			." )"
			." AND al.apply_info_uid = ail.uid" 
			." AND al.apply_item_uid = ai.uid",

			"al.*"
			.", IF(ail.status = '".$d['khusd_st_apply_manager']['apply_info']['CLOSED']."', 1, 0) AS is_closed"
			.", ail.subject AS apply_info_subject"
			.", ail.info_order AS apply_info_order"
			.", ail.date_start AS date_start"
			.", ail.department AS department"
			.", ail.uid AS apply_info_uid"
			.", ail.is_perio_surgery AS is_perio_surgery"
			.", ai.content AS apply_item_content"
			.", ai.date_item AS apply_item_date_item"
			.", ai.pt_name AS apply_item_pt_name"
			.", ai.doctor AS apply_item_doctor"
			.", ai.assist AS apply_item_assist"
			,
			'al.date_reg', 
			'DESC', 
			$recnum, 
			1
		);

///////
function generateOpenApplyInfoArray( &$_OpenApplyInfo, $_check_start_time, $_APPLY, $_ACCEPTED, $_CLOSED, $_al, $_ail, $_ai )   {
                //$check_start_code = ( 12 - date("w", time()   ) )%7 - 4 ;
                //$check_start_time = date("Ymd", time() + 60*60*24*$check_start_code).'000000';
                        //$table['khusd_st_apply_manager'.'apply_list'].' al'
                        //.', '.$table['khusd_st_apply_manager'.'apply_info_list'].' ail'
                        //.', '.$table['khusd_st_apply_manager'.'apply_item'].' ai',

                $TCC = getDbArray(
                        $_al.' al'
                        .', '.$_ail.' ail'
                        .', '.$_ai.' ai',

                        "("
                                ."al.status = '".$_APPLY."'"
                                ." OR al.status = '".$_ACCEPTED."'"
                        ." )"
                        ." AND al.apply_info_uid = ail.uid"
                        ." AND al.apply_item_uid = ai.uid"
                        ." AND ail.status = '".$_CLOSED."'"
                        ." AND ai.date_item >= ".$_check_start_time,
                        "al.*"
                        .", IF(ail.status = '".$_CLOSED."', 1, 0) AS is_closed"
                        .", ail.subject AS apply_info_subject"
                        .", ail.date_start AS date_start"
                        .", ail.date_end AS date_end"
                        .", ail.date_select AS date_select"
                        .", ail.department AS department"
                        .", ail.num_item AS num_item"
                        .", ail.is_perio_surgery AS is_perio_surgery"
                        .", ail.uid AS apply_info_uid"
                        .", ail.apply_limit AS apply_limit"
                        .", ai.accept_limit AS accept_limit"
                        .", ai.date_item AS date_item"
                        .", ai.sub_category AS sub_category"
                        .", ai.content AS apply_item_content",

                        'al.st_id' ,
                        'asc' ,
                        //'desc' ,
                        0,
                        0
                );
	$applies = array();
	$num_items = array(); 
        $accept_limits = array();
        $apply_limits = array();
        $date_items = array();
        //__debug_print("db_query_4_detect. - " . mysql_error());

        while($_R = db_fetch_array($TCC))   {

                if( $_R['rand'] >= 0 )    {
 //__debug_print("db_query_go for_opened search detect main.php. - " .$_R['apply_item_uid'] );
                        $applies[  $_R['apply_info_uid']  ][$_R['apply_item_uid'] ]++;

                }
                $accept_limits[ $_R['apply_info_uid'] ][ $_R['apply_item_uid']] = $_R['accept_limit'];
 //__debug_print("db_query_go for_mb_strpos search detect2 main.php. - " .$_R['apply_item_content']. '_'. mb_strpos( $_R['apply_item_content']  ,  "(4", 0,  "UTF-8"     )  );

		
                $num_items[ $_R['apply_info_uid'] ]  = $_R['num_item'];
                $apply_limits[ $_R['apply_info_uid'] ]  = $_R['apply_limit'];
                $date_items[ $_R['apply_info_uid'] ][ $_R['apply_item_uid']] = $_R['date_item'];
        }


        //$OpenApplyInfo = array();
        foreach( array_keys($accept_limits) AS $tmp_apply_info)   {
                $closed = 0;
                foreach( array_keys($accept_limits[$tmp_apply_info])  AS $tmp_apply_item)  {
                        if ( $accept_limits[$tmp_apply_info][$tmp_apply_item] > 0  && $accept_limits[$tmp_apply_info][$tmp_apply_item] <= $applies[$tmp_apply_info][$tmp_apply_item]  )   {
                                $closed=$closed+1;
//// __debug_print("detect closed items. - " .$tmp_apply_info.'_'.$tmp_apply_item.'_('. $accept_limits[$tmp_apply_info][$tmp_apply_item]  .'<='.$applies[$tmp_apply_info][$tmp_apply_item].')_'.$closed );
                        }
                }
                if( $apply_limits[$tmp_apply_info] >0 && $num_items[$tmp_apply_info] > $closed )   {
//// __debug_print("detect open apply info. - " .$tmp_apply_info.'_'. $num_items[$tmp_apply_info] .'>'.$closed  );
                        $_OpenApplyInfo[$tmp_apply_info] = true;
                }
		else  {
//// __debug_print("detect closed apply info. - " .$tmp_apply_info.'_'. $num_items[$tmp_apply_info] .'<='.$closed  );
                        $_OpenApplyInfo[$tmp_apply_info] = false;
		}

        }

}

/*
$OpenApplyInfo = array();
$check_start_code = ( 12 - date("w", time()   ) )%7 - 4 ;
$check_start_time = date("Ymd", time() + 60*60*24*$check_start_code).'000000';
$_al = $table['khusd_st_apply_manager'.'apply_list'] ;
$_ail =$table['khusd_st_apply_manager'.'apply_info_list'] ;
$_ai = $table['khusd_st_apply_manager'.'apply_item'] ;

generateOpenApplyInfoArray( $OpenApplyInfo, $check_start_time,  $d['khusd_st_apply_manager']['apply_list']['APPLY'],$d['khusd_st_apply_manager']['apply_list']['ACCEPTED'],$d['khusd_st_apply_manager']['apply_info']['CLOSED'], $_al, $_ail, $_ai );
		__debug_print("OpenApplyInfos_start ".'_' .mysql_error());
        foreach( array_keys($OpenApplyInfo) AS $_apply_info_key)   {
		if ($OpenApplyInfo[ $_apply_info_key ]==true) $_b = 1;
		else  $_b = 0;
		__debug_print("OpenApplyInfos ".$_apply_info_key.'_'.$_b.'_' .mysql_error());
	}
//__debug_print("close_finished making." . $ITEM['uid'].'_'.$ITEM['parent_apply_info_uid'].'_'.$ITEM['apply_info_uid'].'_' .mysql_error());
*/
db_query("begin" , $DB_CONNECT);
__debug_print("Transaction Begin_".$my['id'].'_' .mysql_error());


$ITEM_ARRAY = array();
$ITEM_ARRAY2 = array();
//$ITEM_ROWS = getDbArray($table[$m.'apply_info_list'], '','*','uid','ASC',0,0);
$ITEM_ROWS = getDbArray($table[ 'khusd_st_apply_manager'.'apply_info_list'],  " status = '".$d['khusd_st_apply_manager']['apply_info']['OPEN']."'"   ,'*','uid','ASC',0,0);
//__debug_print("get apply_info_list  open - ".'_'.mysql_error());
while($ITEM = db_fetch_array($ITEM_ROWS))
{
        if (  $ITEM['status'] == $d['khusd_st_apply_manager']['apply_info']['OPEN'] && $ITEM['date_end'] <= $date['totime']   )   {
// close apply_info
                getDbUpdate($table['khusd_st_apply_manager' .'apply_info_list']
                , "status = '".$d['khusd_st_apply_manager']['apply_info']['CLOSED']."'"
                .", date_select = '".$date['totime']."'"
                , "uid = '".$ITEM['uid']."'"
                );
// update apply_list to generate random value
                getDbUpdate($table[ 'khusd_st_apply_manager' .'apply_list'], 'rand = RAND( UNIX_TIMESTAMP() )', "apply_info_uid = '".$ITEM['uid']."' AND status = '".$d['khusd_st_apply_manager']['apply_list']['APPLY']."'");
                $ITEM_ROWS2 = getDbArray($table['khusd_st_apply_manager'  .'apply_item'], 'apply_info_uid='.$ITEM['uid'],'*','uid','ASC',0,0);
                while($ITEM2 = db_fetch_array($ITEM_ROWS2))
                {

                        // 기존 당첨자 수 구하기
                        $ACCEPTED_NUM = getDbRows($table['khusd_st_apply_manager'  .'apply_list'],
                                "apply_item_uid = '".$ITEM2['uid']."'"
                                ." AND status = '".$d['khusd_st_apply_manager']['apply_list']['ACCEPTED']."'"
                        );
                        if($ACCEPTED_NUM < $ITEM2['accept_limit'])
                        {
                                $apply_info = getUidData($table[ 'khusd_st_apply_manager' .'apply_info_list'], $ITEM2['uid']);

                                db_query("UPDATE ".$table['khusd_st_apply_manager'  .'apply_list']
                                ." SET status = '".$d['khusd_st_apply_manager']['apply_list']['ACCEPTED']."'"
                                ." WHERE apply_item_uid = '".$ITEM2['uid']."'"
                                ." AND status = '".$d['khusd_st_apply_manager']['apply_list']['APPLY']."'"
                                ." AND date_reg >= '".$apply_info['date_start']."'"
                                ." ORDER BY rand DESC"
                                .( $ITEM2['accept_limit'] == 0 ? '' : ' LIMIT '.($ITEM2['accept_limit'] - $ACCEPTED_NUM) ), $DB_CONNECT);
__debug_print("UPDATE_IF_ACCEPTED_". $my['id'].'_apply_item_uid('.$ITEM2['uid'].'_ACCCPETED_NUM('.$ACCEPTED_NUM.'<accept_limit( '.$ITEM2['accept_limit'].'_'.mysql_error());
                        }
                }

        }  //end of if

}   //end of while

$OpenApplyInfo = array();
$check_start_code = ( 12 - date("w", time()   ) )%7 - 4 ;
$check_start_time = date("Ymd", time() + 60*60*24*$check_start_code).'000000';
$_al = $table['khusd_st_apply_manager'.'apply_list'] ;
$_ail =$table['khusd_st_apply_manager'.'apply_info_list'] ;
$_ai = $table['khusd_st_apply_manager'.'apply_item'] ;

generateOpenApplyInfoArray( $OpenApplyInfo, $check_start_time,  $d['khusd_st_apply_manager']['apply_list']['APPLY'],$d['khusd_st_apply_manager']['apply_list']['ACCEPTED'],$d['khusd_st_apply_manager']['apply_info']['CLOSED'], $_al, $_ail, $_ai );
////		__debug_print("OpenApplyInfos_start ".'_' .mysql_error());
        foreach( array_keys($OpenApplyInfo) AS $_apply_info_key)   {
		if ($OpenApplyInfo[ $_apply_info_key ]==true) $_b = 1;
		else  $_b = 0;
////		__debug_print("OpenApplyInfos ".$_apply_info_key.'_'.$_b.'_' .mysql_error());
	}

$_new_apply_info = 0;
// control pre_apply_info_list
$_booked_status =  $d['khusd_st_apply_manager']['apply_info']['pre_apply_info']['status']['booked']; 
$_finished_status =  $d['khusd_st_apply_manager']['apply_info']['pre_apply_info']['status']['finished']  ;   //finish
$_cancelled_status =  $d['khusd_st_apply_manager']['apply_info']['pre_apply_info']['status']['cancelled']  ;   //cancelled 
$ITEM_KEEP = array(); 
$ITEM_ROWS = getDbArray($table['khusd_st_apply_manager' .'pre_apply_info_list'], " status = '".$_booked_status."'"  ,'*','uid','ASC',0,0);

while($ITEM = db_fetch_array($ITEM_ROWS))  //each pre_apply_infos (booked)
	$ITEM_KEEP[] = $ITEM;

//__debug_print("push func: Could not connect to server99991. - " . $ITEM['subject'].'_'.mysql_error());
//////////while($ITEM = db_fetch_array($ITEM_ROWS))  //each pre_apply_infos (booked)
foreach ($ITEM_KEEP AS $ITEM)  //each pre_apply_infos (booked)
{
	$_is_open_parent_apply_info = !(isset($OpenApplyInfo[ $ITEM['parent_apply_info_uid']]) && $OpenApplyInfo[ $ITEM['parent_apply_info_uid'] ] == false) ;
        if( $ITEM['status']  == $_booked_status  && $ITEM['date_start'] < $date['totime'] && $_is_open_parent_apply_info == false )    {   //have to start new apply_info(parent's open items > 0) or cancelled(parent's  open items is 0)
                //update pre_apply_info's status as finished
                getDbUpdate($table[ 'khusd_st_apply_manager'  .'pre_apply_info_list'], "status = '".$_cancelled_status."'", "uid = '".$ITEM['uid']."'" );
	}
        else if( $ITEM['status']  == $_booked_status  && $ITEM['date_start'] < $date['totime'] && $_is_open_parent_apply_info == true )    {   //have to start new apply_info(parent's open items > 0) or cancelled(parent's  open items is 0)
                //__debug_print("push func: Could not connect to server9999x. - " . $ITEM['subject'].'_'.$ITEM['date_start'].'_'.$ITEM['status'].'_'.mysql_error());
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
                //make new apply_info or do not make depend on
                $_QKEY = 's_uid, st_id, apply_limit, department, subject, content, date_start, date_end, apply_type, status, able_apply_accepted, is_perio_surgery, date_reg, info_order ';
                $_QVAL = "'$s_uid', '$st_id', '$apply_limit','$department', '$subject', '$content', '$date_start', '$date_end', '$apply_type', '$status', '$able_apply_accepted', '$is_perio_surgery', '$date_reg', '$order'";
                getDbInsert($table['khusd_st_apply_manager'  .'apply_info_list'],$_QKEY, $_QVAL);
                $_new_apply_info += 1;
                //update pre_apply_info's status as finished
                getDbUpdate($table[ 'khusd_st_apply_manager'  .'pre_apply_info_list'], "status = '".$_finished_status."'", "uid = '".$ITEM['uid']."'" );

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
                getDbUpdate($table['khusd_st_apply_manager' .'pre_apply_info_list'], "apply_info_uid = '".$_apply_info_uid."'", "uid = '".$ITEM['uid']."'" );
                //transfer previous apply_items
        // 새로 추가된 신청의 uid 가져온다.
        $LASTUID = getDbCnt($table['khusd_st_apply_manager'.'apply_info_list'],'max(uid)','');
        // 추가 신청은... 새로 생성하되, uid 에 있는 item들과 '당첨자'들 정보를 가져온다...!!!
        $ITEM_ROWS = getDbArray($table['khusd_st_apply_manager' .'apply_item'], "apply_info_uid='".$ITEM['parent_apply_info_uid']."'",'*','uid','asc',0,0);
        while($_ITEM = db_fetch_array($ITEM_ROWS))
        {
                $_QKEY = 'apply_info_uid, content, ref_uid, accept_limit, date_reg, date_item, doctor, assist, pt_id, pt_name, is_imp_cent, sub_category';
                $_QVAL = "'".$LASTUID."', '".mysql_real_escape_string($_ITEM['content'])."', '".$_ITEM['ref_uid']."', '".$_ITEM['accept_limit']."', '".$_ITEM['date_reg']."'"
                                .", '".$_ITEM['date_item']."', '".$_ITEM['doctor']."', '".$_ITEM['assist']."', '".$_ITEM['pt_id']."', '".$_ITEM['pt_name']."', '".$_ITEM['is_imp_cent']."', '".$_ITEM['sub_category']."'";

                getDbInsert($table['khusd_st_apply_manager'.'apply_item'],$_QKEY, $_QVAL);
                // 새로 추가된 uid 가져온다.
                $ITEM_LASTUID = getDbCnt($table['khusd_st_apply_manager' .'apply_item'],'max(uid)','');

                $APPLIER_ROWS = getDbArray($table['khusd_st_apply_manager'  .'apply_list'].' al',
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

                        getDbInsert($table['khusd_st_apply_manager' .'apply_list'],$_QKEY, $_QVAL);
                }
        }   //while
        // item 수 구하기
        $num_item = getDbRows($table['khusd_st_apply_manager'  .'apply_item'],"apply_info_uid = '".$LASTUID."'");
        // apply_info_list 의 num_item 업데이트
        getDbUpdate($table['khusd_st_apply_manager' .'apply_info_list'], "num_item='".$num_item."'", "uid = '".$LASTUID."'");
        }  // end of if
} //end of while pre_apply_info

if( $_new_apply_info > 0 )   {
                //$_status = $d['khusd_st_apply_manager']['apply_info']['OPEN'];
                $close_finished = array();
                //make close_finished  array
                $FINISHED_ITEM_ROWS = getDbArray($table[$m.'pre_apply_info_list'], " status = '".$_finished_status."'"  ,'*','uid','ASC',0,0);
                while($ITEM = db_fetch_array($FINISHED_ITEM_ROWS))  //each pre_apply_infos (finished)
                {
                        if( $ITEM['status'] == $_finished_status  && $ITEM['date_start'] < $date['totime'] && $ITEM['date_end'] > $date['totime']   )    {
//__debug_print("close_finished making." . $ITEM['uid'].'_'.$ITEM['parent_apply_info_uid'].'_'.$ITEM['apply_info_uid'].'_' .mysql_error());
                                $close_finished[ $ITEM['parent_apply_info_uid'] ]  = $ITEM['apply_info_uid']   ;
                        }
                }

                $BOOKED_ITEM_ROWS = getDbArray($table[$m.'pre_apply_info_list'], " status = '".$_booked_status."'"  ,'*','uid','ASC',0,0);
                while($ITEM = db_fetch_array($BOOKED_ITEM_ROWS))  //each pre_apply_infos (booked)
                {
                        if( $ITEM['status'] == $_booked_status  && $ITEM['date_start'] > $date['totime'] && isset($close_finished[$ITEM['parent_apply_info_uid']])  )   {
//__debug_print("close_finished test." . $ITEM['status'].'_'.mysql_error());
                                $_next_uid = $close_finished[$ITEM['parent_apply_info_uid']];
                                getDbUpdate($table[$m.'pre_apply_info_list'], "parent_apply_info_uid = '".$_next_uid."'", "uid = '".$ITEM['uid']."'" );
                        }
                }

}

db_query("commit" , $DB_CONNECT);
__debug_print("Transaction Commit_".$my['id'].'_' .mysql_error());


//////
	?>
	
	<?php
	$apply_info_view_link = getLinkFilter($g['s'].'/?'.($_HS['usecode']?'r='.$r.'&amp;':'').'m=khusd_st_apply_manager',array($iframe?'iframe':'')).'&amp;uid=';
	?>
	
	<?php if($my['id']):?>
	<?php while($_R = db_fetch_array($MY_APPLY_ARRAY)):?>
	
	<?php
	////// 치주수술의 경우, 수술정보로 content 항목을 새로 구성
	//if($_R['is_perio_surgery'] == 'y')
	if(true)
	{
		$_R['apply_item_content'] =
			getDateFormat($_R['apply_item_date_item'],'m/d').'('.getWeek(getDateFormat($_R['apply_item_date_item'], 'w')).')'
			.' '.getDateFormat($_R['apply_item_date_item'],'H:i')
			.' '.$_R['apply_item_pt_name']
			.' '.$_R['apply_item_doctor']
			.($_R['apply_item_assist'] && strlen($_R['apply_item_assist']) > 0 ? '('.$_R['apply_item_assist'].')' : '')
			.' '.$_R['apply_item_content']
			;
	}
	?>

	<li>
		<span class="dept"><?php echo $d['khusd_st_manager']['department'][$_R['department']]['name']?></span>
		<span class="subject">
			<a href="<?php echo $apply_info_view_link.$_R['apply_info_uid']?>">
				<?php echo $_R['apply_info_subject'].'&nbsp'.$_R['apply_info_order']?> 의 <?php echo $_R['apply_item_content']?>

			</a>
		</span>
		<?php if($_R['status'] == $d['khusd_st_apply_manager']['apply_list']['ACCEPTED']):?>
		<span class="result highlight win">당첨</span>
		<?php elseif($_R['is_closed'] == 1):?>
		<span class="result fall">탈락</span>
		<?php elseif($_R['date_reg'] >= $_R['date_start']):?>
		<span class="result apply">신청</span>
		<?php else:?>
		<span class="result null_apply">무효 신청</span>
		<?php endif?>
	</li>
	
	<?php endwhile?>
	<?php else:?>
	<li><span>로그인을 하세요.</span></li>
	<?php endif?>
	
	</ul>

</div>

<style>  

.widget_my_apply_manager ul li span.dept{color:#32548D; font-weight:bold}

.widget_my_apply_manager ul li span.subject a{color:#343434; font-weight:normal;}

.widget_my_apply_manager ul li span.result{padding:0 2px; margin: 0 2px;}
.widget_my_apply_manager ul li span.win{padding:0 2px; color:green; font-weight:bold; background-color:#FFF2DB;}
.widget_my_apply_manager ul li span.fall{padding:0 2px; color:#ED514D; font-weight:bold; background-color:#FFF2DB;}
.widget_my_apply_manager ul li span.apply{color:#32548D;}
.widget_my_apply_manager ul li span.null_apply{color:#EF534A;}
</style>
