<?php
if(!defined('__KIMS__')) exit;

if ($g['mobile']&&$_SESSION['pcmode']!='Y')
{
    echo "MOBILE";
	//include_once $g['path_module'].$module.'/lang.'.$_HS['lang'].'/admin/_mobile/'.$front.'.php';
}
else {
    echo "PC";
	//include_once $g['path_module'].$module.'/lang.'.$_HS['lang'].'/admin/_pc/'.$front.'.php';
}
?>