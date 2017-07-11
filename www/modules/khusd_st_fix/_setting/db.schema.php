<?php
if(!defined('__KIMS__')) exit;

// 픽스 조 테이블
$_tmp = db_query( "select count(*) from ".$table[$module.'group'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("
CREATE TABLE `".$table[$module.'group']."` (
  `uid` int(20) NOT NULL auto_increment,
  
  `s_uid` int NOT NULL default 0,

  `id` tinyint NOT NULL default 0,
  
  `num_mbr` tinyint NOT NULL default 0,

  PRIMARY KEY  (`uid`),
  KEY `s_uid` (`s_uid`),
  KEY `id` (`id`),
  KEY `num_mbr` (`num_mbr`)
) ENGINE=".$DB['type']." CHARSET=UTF8");
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table[$module.'group'],$DB_CONNECT); 
}

// 픽스 조 구성원 테이블
$_tmp = db_query( "select count(*) from ".$table[$module.'group_mbr'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("
CREATE TABLE `".$table[$module.'group_mbr']."` (
  `g_uid` int(20) NOT NULL default 0,
  
  `st_id` varchar(20) NOT NULL default '0',

  KEY `g_uid` (`g_uid`),
  KEY `st_id` (`st_id`)
) ENGINE=".$DB['type']." CHARSET=UTF8");
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table[$module.'group_mbr'],$DB_CONNECT); 
}

// 픽스 턴 시간표 테이블 (각 과별 조 일정표)
$_tmp = db_query( "select count(*) from ".$table[$module.'schedule'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("
CREATE TABLE `".$table[$module.'schedule']."` (
  `uid` int(20) NOT NULL auto_increment,

  `g_uid` int(20) NOT NULL default 0, 
  
  `date_start` varchar(8) NOT NULL default '',
  `date_end` varchar(8) NOT NULL default '',
  
  `department` varchar(8) NOT NULL default '',
  `leader` varchar(20) NOT NULL default '0', 

  PRIMARY KEY  (`uid`),
  KEY `g_uid` (`g_uid`),
  KEY `date_start` (`date_start`), 
  KEY `date_end` (`date_end`), 
  KEY `department` (`department`),
  KEY `leader` (`leader`)
) ENGINE=".$DB['type']." CHARSET=UTF8");
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table[$module.'schedule'],$DB_CONNECT); 
}

// 픽스 일정 테이블 (매주간 픽스 일정)
$_tmp = db_query( "select count(*) from ".$table[$module.'timetable'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("
CREATE TABLE `".$table[$module.'timetable']."` (
  `uid` int(20) NOT NULL auto_increment,

  `g_uid` int(20) NOT NULL default 0, 
  `schedule_uid` int(20) NOT NULL default 0, 
  
  `date_fix` varchar(8) NOT NULL default '',
  `day_of_week` tinyint NOT NULL default 0,
  `timetype` char(2) NOT NULL default '',
  
  PRIMARY KEY  (`uid`),
  KEY `g_uid` (`g_uid`),
  KEY `schedule_uid` (`schedule_uid`),
  KEY `date_fix` (`date_fix`), 
  KEY `day_of_week` (`day_of_week`), 
  KEY `timetype` (`timetype`)
) ENGINE=".$DB['type']." CHARSET=UTF8");
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table[$module.'timetable'],$DB_CONNECT); 
}

?>