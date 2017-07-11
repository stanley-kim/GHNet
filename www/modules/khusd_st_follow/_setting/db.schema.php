<?php
if(!defined('__KIMS__')) exit;

$_tmp = db_query( "select count(*) from ".$table[$module.'follow'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("
CREATE TABLE `".$table[$module.'follow']."` (
  `uid` int(20) NOT NULL auto_increment,
  `s_uid` int	NOT NULL default 0,
  
  `pt_uid` int(20) NOT NULL default 0,
  `department` varchar(20) NOT NULL default '',
  `dr_name` varchar(20) NOT NULL default '',

  `st_id` varchar(20) NOT NULL default '',
  
  `fw_type` varchar(20) NOT NULL default '',
  `step`    int(1)  NOT NULL default 0,
  `status` char(1) NOT NULL default '',
  `misc`   varchar(50) NOT NULL default '',
  
  `date_reg` varchar(14) NOT NULL default '',
  `date_update` varchar(14) NOT NULL default '',

  PRIMARY KEY  (`uid`),
  KEY `pt_uid` (`pt_uid`),
  KEY `st_id` (`st_id`),
  KEY `s_uid` (`s_uid`),
  KEY `department` (`department`),
  KEY `fw_type` (`fw_type`),
  KEY `step` (`step`),
  KEY `dr_name` (`dr_name`),
  KEY `date_reg` (`date_reg`),
  KEY `date_update` (`date_update`)
) ENGINE=".$DB['type']." CHARSET=UTF8");
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table[$module.'follow'],$DB_CONNECT); 
}

// 모든과 통합 팔로우 정보 테이블
$_tmp = db_query( "select count(*) from ".$table[$module.'follow_pt'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("
CREATE TABLE `".$table[$module.'follow_pt']."` (
  `uid` int(20) NOT NULL auto_increment,
  
  `pt_id`	varchar(8) NOT NULL default '',
  `pt_name` varchar(20) NOT NULL default '',
  
  `date_reg` varchar(14) NOT NULL default '',

  PRIMARY KEY  (`uid`),
  KEY `pt_id` (`pt_id`),
  KEY `pt_name` (`pt_name`),
  
  KEY `date_reg` (`date_reg`)
) ENGINE=".$DB['type']." CHARSET=UTF8");
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table[$module.'follow_pt'],$DB_CONNECT); 
}
?>