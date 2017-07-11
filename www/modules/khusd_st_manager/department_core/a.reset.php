<?php
if(!defined('__KIMS__')) exit;
checkAdmin(0); //관리자만 접근

include_once $g['path_module'].'khusd_st_manager/var/var.php';	// 필수 인클루드 파일

// 기존에는 DB 데이터 삭제 후 연결그룹에 있는 모든 회원들의 기본점수를 입력하는 기능이었으나, 
// 동시에 여러 학년이 사용할 수 있게 하기 위해서는... 지정된 그룹의 점수만 0점으로 추가될 수 있어야 함...

// DB 데이터 삭제하기
//getDbDelete($table[$m.'score'], '1=1');

$date_update = $date['totime'];
$s_uid = $semester;

// 선택된 그룹에 해당하는 회원정보 가져오기
$st_array = getDbArray(
				$table['s_mbrdata'].' d,'.$table['s_mbrid'].' i', 
				'd.sosok='.$group.' AND d.memberuid=i.uid', 
				'id', 'id', 'asc', 0, 0);

while($st_info = db_fetch_array($st_array))
{
	$st_id = $st_info['id'];
	
	// 해당 회원들의 기본점수 입력하기
	$QKEY = "st_id, date_update, s_uid";
	$QVAL = "'$st_id', '$date_update', '$s_uid'";
	
	getDbInsert($table['khusd_st_'.$DEPARTMENT.'score'],$QKEY,$QVAL);
}
 
getLink('reload','parent.','설정이 반영되었습니다.','');
?>