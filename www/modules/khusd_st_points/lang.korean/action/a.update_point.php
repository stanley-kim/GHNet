<?php
if(!defined('__KIMS__')) exit;

//checkAdmin(0);
echo 'in action file';
$i = 0;
$j = 0;
$MEMBERS = array();
if($price) $price = $how == '+' ? $price : -$price;
$html = $act == 'send_paper' ? 'TEXT' : $html;
$subject = trim($subject);
$content = trim($content);
$comment = trim($comment);
$memo = trim($memo);
$send_time = $year1.$month1.$day1.$hour1.$min1.'00';

foreach ($mbrmembers as $val)
{
	$M1 = getUidData($table['s_mbrid'],$val);
	$M2 = getDbData($table['s_mbrdata'],'memberuid='.$M1['uid'],'*');
	if (!$M2['memberuid']) continue;
	$MEMBERS[] = array_merge($M1,$M2);
}

foreach ($MEMBERS as $M)
{
	//상벌점(H) 지급
	if ($act == 'give_point')
	{
		getDbUpdate($table['s_mbrdata'],$pointType.'='.$pointType.'+'.$price,'memberuid='.$M['memberuid']);
		getDbInsert($table['s_'.$pointType],'my_mbruid,by_mbruid,price,content,d_regis',"'".$M['memberuid']."','0','".$price."','".$comment."','".$date['totime']."'");
	}
}

getLink('reload','parent.','상벌점 지급이 완료 되었습니다.','');
?>