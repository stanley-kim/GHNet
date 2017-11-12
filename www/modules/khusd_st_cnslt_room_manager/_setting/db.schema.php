<?php
if(!defined('__KIMS__')) exit;

// 종진실 예약 관리 테이블
// 과에 상관없이 종진실의 예약 신청/결과를 총 관리한다. 
// 각 과에 대한 구체적인 정보는 별도로 각 과별 DB 에서 얻어와야 한다. 

// ~42기까지 사용되던 테이블 구조 이어받으며, 불필요한 column 삭제 및 일부 속성 변경
// 추가로 각 과에 대한 정보를 추가하고, 그 정보를 찾아올 수 있는 id column 추가

// reserve_status, dept_code 의 값에 대한 정의는 module의 var/var.define.php 에 정의
$_tmp = db_query( "select count(*) from ".$table[$module.'reservation'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("
CREATE TABLE `".$table[$module.'reservation']."` (
  `uid` int(20) NOT NULL auto_increment,
  
  `st_id` varchar(20) NOT NULL default '0',
  `pt_name` varchar(20) NOT NULL default '',
  `pt_id` varchar(20) NOT NULL default '',
  `dental_formula` varchar(20) NOT NULL default '',
  
  `reserve_status` char(1) NOT NULL default '',  
  `department` varchar(8) NOT NULL default '',
  `tx_plan` varchar(50) NOT NULL default '',
  
  `chair_no` int NOT NULL default '0',
  
  `chair_date` varchar(8) NOT NULL default '',
  `chair_timetype` char(2) NOT NULL default '',
  `chair_start_time` varchar(4) NOT NULL default '',
  `chair_end_time` varchar(4) NOT NULL default '',
  
  `memo` varchar(200) NOT NULL default '',
  `st_type` varchar(8) NOT NULL default '',
  `chair_timetype_detail` char(2) NOT NULL default '',
  
  `date_reg` varchar(14) NOT NULL default '',
  `date_cancel` varchar(14) NOT NULL default '',

  PRIMARY KEY  (`uid`),
  KEY `st_id` (`st_id`),

  KEY `chair_no` (`chair_no`),
  KEY `chair_date` (`chair_date`),
  KEY `chair_timetype` (`chair_timetype`),
  KEY `chair_start_time` (`chair_start_time`),

  KEY `reserve_status` (`reserve_status`),
  KEY `department` (`department`),

  KEY `date_reg` (`date_reg`)
) ENGINE=".$DB['type']." CHARSET=UTF8");
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table[$module.'reservation'],$DB_CONNECT); 
}

// ST 체어 신청 테이블
// status 의 상태값은 module 의 var/var.define.php 에 정의
$_tmp = db_query( "select count(*) from ".$table[$module.'apply'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("
CREATE TABLE `".$table[$module.'apply']."` (
  `uid` int(20) NOT NULL auto_increment,
  `s_uid` int(11) NOT NULL default '0',
  `st_id` varchar(20) NOT NULL default '0',
  
  `pt_name` varchar(20) NOT NULL default '',
  `pt_id` varchar(20) NOT NULL default '',
  `dental_formula` varchar(20) NOT NULL default '',
  `department` varchar(8) NOT NULL default '',
  `st_type` varchar(8) NOT NULL default '',
  `tx_plan` varchar(20) NOT NULl default '0',
  
  `st_date` varchar(8) NOT NULL default '',
  `st_timetype` char(2) NOT NULL default '',
  `st_timetype_detail` char(2) NOT NULL default '',
  `st_start_time` varchar(4) NOT NULL default '',
  `st_end_time` varchar(4) NOT NULL default '',
  `consv_op` tinyint,

  `status` char(1) NOT NULL default '',
  `memo` varchar(200) NOT NULL default '',

  `chair_no` int NOT NULL default '0',
  
  `date_reg` varchar(14) NOT NULL default '',
  `date_cancel` varchar(14) NOT NULL default '',
  
  PRIMARY KEY  (`uid`),
  KEY `s_uid` (`s_uid`),
  KEY `st_id` (`st_id`),
  KEY `department` (`department`),
  KEY `st_type` (`st_type`),
  KEY `st_date` (`st_date`),
  KEY `st_timetype` (`st_timetype`),
  KEY `st_start_time` (`st_start_time`),
  KEY `st_end_time` (`st_end_time`)
) ENGINE=".$DB['type']." CHARSET=UTF8");
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table[$module.'apply'],$DB_CONNECT); 
}

// ST 체어 대기 테이블
$_tmp = db_query( "select count(*) from ".$table[$module.'candi'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("
CREATE TABLE `".$table[$module.'candi']."` (
  `uid` int(20) NOT NULL auto_increment,
  `s_uid` int(11) NOT NULL default '0',
  `apply_uid` int(20) NOT NULL default '0',
  
  `st_id` varchar(20) NOT NULL default '0',
  
  `st_date` varchar(8) NOT NULL default '',
  `st_timetype` char(2) NOT NULL default '',
  
  `next_uid` int(20) NOT NULL default '0',
  `is_first` char(1) NOT NULL default '',
  `is_last` char(1) NOT NULL default '',
  
  `date_reg` varchar(14) NOT NULL default '',
  
  PRIMARY KEY  (`uid`),
  KEY `s_uid` (`s_uid`),
  KEY `apply_uid` (`apply_uid`),
  KEY `is_last` (`is_last`)
) ENGINE=".$DB['type']." CHARSET=UTF8");
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table[$module.'candi'],$DB_CONNECT); 
}

?>
