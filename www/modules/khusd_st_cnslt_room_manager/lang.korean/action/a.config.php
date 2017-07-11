<?php
if(!defined('__KIMS__')) exit;
checkAdmin(0); //관리자만 접근
 
$_tmpdfile = $g['dir_module'].'var/var.php'; //변수파일
$fp = fopen($_tmpdfile,'w');
fwrite($fp, "<?php\n");
fwrite($fp, "\$d['khusd_st_cnslt_room_manager']['layout'] = \"".$layout."\";\n"); //레이아웃
fwrite($fp, "\$d['khusd_st_cnslt_room_manager']['theme'] = \"".$theme."\";\n"); //테마
fwrite($fp, "\$d['khusd_st_cnslt_room_manager']['theme_m'] = \"".$theme_m."\";\n"); //모바일테마
fwrite($fp, "\$d['khusd_st_cnslt_room_manager']['jointmenu'] = \"".$jointmenu."\";\n"); //연결메뉴
fwrite($fp, "\$d['khusd_st_cnslt_room_manager']['jointgroup'] = \"".$jointgroup."\";\n"); // 연결그룹
fwrite($fp, "?>");
fclose($fp);
@chmod($_tmpdfile,0707);
 
getLink('reload','parent.','설정이 반영되었습니다.','');
?>