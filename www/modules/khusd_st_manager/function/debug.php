<?php

/*
	사용법
		
	include_once $g['path_module'].'khusd_st_manager/function/debug.php';
	__debug_print('디버그 메시지');
*/
function __debug_print($msg)
{
	$_tmpdfile = $g['dir_module'].'_debug.txt'; //변수파일
	$fp = fopen($_tmpdfile,'a');
	fwrite($fp, $msg."\n");
	fclose($fp);
}

?>