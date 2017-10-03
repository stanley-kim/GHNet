<?php
if(!defined('__KIMS__')) exit;

// 치주과 모듈 옵져 테이블
// 사용 특성상 회원 아이디가 아닌, 학번으로 데이터를 저장한다
// ~42기까지 사용되던 테이블 구조 이어받으며, 불필요한 column 삭제 및 일부 속성 변경
// st_perio 테이블을 두 개의 테이블로 분리
$_tmp = db_query( "select count(*) from ".$table[$module.'score'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("
CREATE TABLE `".$table[$module.'score']."` (
  `uid` int(20) NOT NULL auto_increment,
  `st_id` varchar(20) NOT NULL default '0',
  `s_uid` int	NOT NULL default 0,
  `follow_point` float NOT NULL default '0',
  `iot` int(4) NOT NULL default '0',
  `charting` int(4) NOT NULL default '0',
  `abandon` int(4) NOT NULL default '0',
  `surgery` int(4) NOT NULL default '0',
  `surgery2` int(4) NOT NULL default '0',
  `imp_1st` int(4) NOT NULL default '0',
  `imp_1st2` int(4) NOT NULL default '0',
  `imp_2nd` int(4) NOT NULL default '0',
  `imp_2nd2` int(4) NOT NULL default '0',
  `sc` int(4) NOT NULL default '0',
  `sc2` int(4) NOT NULL default '0',
  `others` int(4) NOT NULL default '0',
  `tbi` int(4) NOT NULL default '0',
  `stpresc` int(1) NOT NULL default '0',
  `stsc` int(4) NOT NULL default '0',
  `stpc` int(4) NOT NULL default '0',
  `stcu` int(4) NOT NULL default '0',
  `stcu_selected` int(4) NOT NULL default '0',
  `stcu_todo` int(4) NOT NULL default '0',
  `is_goal` char(1) NOT NULL default 'n',
  `fix` int(4) NOT NULL default '0',
  `cp` int(4) NOT NULL default '6',
  `date_update` varchar(14) NOT NULL default '',
  `perio_report` int(4) NOT NULL default '0',
  `imp1_report` int(4) NOT NULL default '0',
  `imp2_report` int(4) NOT NULL default '0',
  `animal_exp` int(4) NOT NULL default '0',
  PRIMARY KEY  (`uid`),
  KEY `st_id` (`st_id`),
  KEY `is_goal` (`is_goal`),
  KEY `date_update` (`date_update`)
) ENGINE=".$DB['type']." CHARSET=UTF8");
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table[$module.'score'],$DB_CONNECT); 
}

// 치주과 ST 체어 신청 테이블
// ~42기까지의 perio_sc 테이블에 해당
// status 의 상태값은 module 의 var/var.define.php 에 정의
$_tmp = db_query( "select count(*) from ".$table[$module.'st_chair'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("
CREATE TABLE `".$table[$module.'st_chair']."` (
  `uid` int(20) NOT NULL auto_increment,
  `st_id` varchar(20) NOT NULL default '0',
  
  `pt_name` varchar(20) NOT NULL default '',
  `tx_plan` varchar(20) NOT NULl default '0',
  
  `st_date` varchar(8) NOT NULL default '',
  `st_timetype` char(2) NOT NULL default '',
  
  `status` char(1) NOT NULL default '',
  `chair_no` int NOT NULL default '0',
  
  `date_reg` varchar(14) NOT NULL default '',
  `date_cancel` varchar(14) NOT NULL default '',
  
  PRIMARY KEY  (`uid`),
  KEY `st_id` (`st_id`),
  KEY `st_date` (`st_date`),
  KEY `st_timetype` (`st_timetype`)
) ENGINE=".$DB['type']." CHARSET=UTF8");
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table[$module.'st_chair'],$DB_CONNECT); 
}

// 치주과 수술 목록 테이블
$_tmp = db_query( "select count(*) from ".$table[$module.'op_list'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("
CREATE TABLE `".$table[$module.'op_list']."` (
  `uid` int(20) NOT NULL auto_increment,
  `op_grp_uid` int NOT NULL default 0,
  
  `op_date` varchar(14) NOT NULL default '',
  
  `pt_name` varchar(20) NOT NULL default '',
  `op_dr`	varchar(20) NOT NULL default '',
  `op_name`	varchar(50) NOT NULL default '',
  
  `op_remark`	varchar(500) NOT NULL default '',
  
  `status` char(1) NOT NULL default '',
  
  `date_reg` varchar(14) NOT NULL default '',
  `date_cancel` varchar(14) NOT NULL default '',
  
  PRIMARY KEY  (`uid`),
  KEY `op_date` (`op_date`)
) ENGINE=".$DB['type']." CHARSET=UTF8");
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table[$module.'op_list'],$DB_CONNECT); 
}

// 치주주과 수술 신청 메타 정보 테이블
$_tmp = db_query( "select count(*) from ".$table[$module.'op_ob_group'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("
CREATE TABLE `".$table[$module.'op_ob_group']."` (
  `uid` int NOT NULL auto_increment,

  `req_limit` tinyint NOT NULL default 0,

  `date_start` varchar(14) NOT NULL default '',

  `date_reg` varchar(14) NOT NULL default '',
  
  PRIMARY KEY (`uid`),
  KEY `date_start` (`date_start`)
) ENGINE=".$DB['type']." CHARSET=UTF8");
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table[$module.'op_ob_group'],$DB_CONNECT);
}

// 치주과 수술 옵져 테이블
// status 값은 var/var.define.php 참고
$_tmp = db_query( "select count(*) from ".$table[$module.'op_ob'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("
CREATE TABLE `".$table[$module.'op_ob']."` (
  `uid` int(20) NOT NULL auto_increment,
  
  `st_id` varchar(20) NOT NULL default '',
  
  `op_uid` int(20) NOT NULL default '0', 
  
  `status` char(1) NOT NULL default '',
  
  `timestamp` DOUBLE NOT NULL default 0,
  `date_reg` varchar(14) NOT NULL default '',
  `date_cancel` varchar(14) NOT NULL default '',
  
  PRIMARY KEY  (`uid`),
  KEY `st_id` (`st_id`),
  KEY `op_uid` (`op_uid`),
  KEY `timestamp` (`timestamp`)
) ENGINE=".$DB['type']." CHARSET=UTF8");
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table[$module.'op_ob'],$DB_CONNECT); 
}
?>
