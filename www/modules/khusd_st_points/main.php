<?php
if(!defined('__KIMS__')) exit;

$theme = 'default'; //지정테마
$mode = $mode ? $mode : 'main'; //테마 초기접속모드
$dispType = $g['mobile']&&$_SESSION['pcmode']!='Y' ? '_mobile' : '_pc'; //모바일,PC모드구분
 
$g['dir_module_skin'] = $g['dir_module'].'theme/'.$dispType.'/'.$theme.'/'; //테마폴더 경로
$g['url_module_skin'] = $g['url_module'].'/theme/'.$dispType.'/'.$theme; //테마폴더 URL
$g['img_module_skin'] = $g['url_module_skin'].'/image'; //테마 이미지폴더 URL
 
$g['dir_module_mode'] = $g['dir_module_skin'].$mode; //테마 선택모드 경로
$g['url_module_mode'] = $g['url_module_skin'].'/'.$mode; //테마 선택모드 URL
 
$g['main'] = $g['dir_module_mode'].'.php'; //출력파일
?>