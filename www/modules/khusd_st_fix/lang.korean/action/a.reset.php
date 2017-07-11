<?php
if(!defined('__KIMS__')) exit;
checkAdmin(0); //관리자만 접근

include_once $g['path_module'].'khusd_st_manager/var/var.php';	// 필수 인클루드 파일

// DB 데이터 삭제하기
getDbDelete($table[$m.'score'], '1=1');

// 연결그룹에 해당하는 회원정보 가져오기
$st_array = getDbArray(
				$table['s_mbrdata'].' d,'.$table['s_mbrid'].' i', 
				'd.sosok='.$d['khusd_st_manager']['jointgroup'].' AND d.memberuid=i.uid', 
				'id', 'id', 'asc', 0, 0);

while($st_info = db_fetch_array($st_array))
{
	$st_id = $st_info['id'];
	
	// 해당 회원들의 기본점수 입력하기
	$QKEY = "st_id, date_update";
	$QVAL = "'$st_id', '$date_update'";
	
	getDbInsert($table[$m.'score'],$QKEY,$QVAL);
}
 
getLink('reload','parent.','설정이 반영되었습니다.','');
?>