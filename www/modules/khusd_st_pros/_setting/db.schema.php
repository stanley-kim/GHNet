<?php
if(!defined('__KIMS__')) exit;

// 보철과 모듈 옵져 테이블
// 사용 특성상 회원 아이디가 아닌, 학번으로 데이터를 저장한다
// ~42기까지 사용되던 테이블 구조 이어받으며, 불필요한 column 삭제 및 일부 속성 변경
$_tmp = db_query( "select count(*) from ".$table[$module.'score'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("
CREATE TABLE `".$table[$module.'score']."` (
  `uid` int(20) NOT NULL auto_increment,
  `st_id` varchar(20) NOT NULL default '0',
  `s_uid` int	NOT NULL default 0,
  
  `second_cr_cancel` int(4) NOT NULL default 0,
  `post_core_cancel` int(4) NOT NULL default 0,
  `imp_cr_br_cancel` int(4) NOT NULL default 0,
  `single_cr_cancel` int(4) NOT NULL default 0,
  `br_cancel` int(4) NOT NULL default 0,
  `partial_denture_cancel` int(4) NOT NULL default 0,
  `complete_denture_cancel` int(4) NOT NULL default 0,
  `others_cancel` int(4) NOT NULL default 0,

  `second_cr_ongoing` int(4) NOT NULL default 0,
  `post_core_ongoing` int(4) NOT NULL default 0,
  `imp_cr_br_ongoing` int(4) NOT NULL default 0,
  `single_cr_ongoing` int(4) NOT NULL default 0,
  `br_ongoing` int(4) NOT NULL default 0,
  `partial_denture_ongoing` int(4) NOT NULL default 0,
  `complete_denture_ongoing` int(4) NOT NULL default 0,
  `others_ongoing` int(4) NOT NULL default 0,

  `second_cr_complete` int(4) NOT NULL default 0,
  `post_core_complete` int(4) NOT NULL default 0,
  `imp_cr_br_complete` int(4) NOT NULL default 0,
  `single_cr_complete` int(4) NOT NULL default 0,
  `br_complete` int(4) NOT NULL default 0,
  `partial_denture_complete` int(4) NOT NULL default 0,
  `complete_denture_complete` int(4) NOT NULL default 0,
  `others_complete` int(4) NOT NULL default 0,
  
  `st_case_1`	varchar(50) NOT NULL default '',
  `st_case_1_pt_name`	varchar(20) NOT NULL default '',
  `st_case_1_last_tx_date`	varchar(14) NOT NULL default '',
  `st_case_1_last_tx`		varchar(50) NOT NULL default '',
  `st_case_1_last_inst`		varchar(20) NOT NULL default '',
  `st_case_1_friendly`		char(1) NOT NULL default '',
  
  `st_case_2`	varchar(50) NOT NULL default '',
  `st_case_2_pt_name`	varchar(20) NOT NULL default '',
  `st_case_2_last_tx_date`	varchar(14) NOT NULL default '',
  `st_case_2_last_tx`		varchar(50) NOT NULL default '',
  `st_case_2_last_inst`		varchar(20) NOT NULL default '',
  `st_case_2_friendly`		char(1) NOT NULL default '',

  `st_case_3`	varchar(50) NOT NULL default '',
  `st_case_3_pt_name`	varchar(20) NOT NULL default '',
  `st_case_3_last_tx_date`	varchar(14) NOT NULL default '',
  `st_case_3_last_tx`		varchar(50) NOT NULL default '',
  `st_case_3_last_inst`		varchar(20) NOT NULL default '',
  `st_case_3_friendly`		char(1) NOT NULL default '',


  `st_post`		int(4) NOT NULL default 0,
  `st_assist`	int(4) NOT NULL default 0,
 
  `date_update` varchar(14) NOT NULL default '',
  PRIMARY KEY  (`uid`),
  KEY `st_id` (`st_id`),
  KEY `date_update` (`date_update`)
) ENGINE=".$DB['type']." CHARSET=UTF8");
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table[$module.'score'],$DB_CONNECT); 
}


$_tmp = db_query( "select count(*) from ".$table[$module.'follow'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("
CREATE TABLE `".$table[$module.'follow']."` (
  `uid` int(20) NOT NULL auto_increment,
  `s_uid` int(11) NOT NULL default '0',
  `pt_uid` int(20) NOT NULL default '0',
  `st_id` varchar(20) NOT NULL default '',
  `status` char(1) NOT NULL default '',
  `date_update` varchar(14) NOT NULL default '',
  `type` varchar(10) default '0',
  PRIMARY KEY  (`uid`),
  KEY `pt_uid` (`pt_uid`),
  KEY `st_id` (`st_id`),
  KEY `s_uid` (`s_uid`),
  KEY `date_update` (`date_update`)
) ENGINE=".$DB['type']." CHARSET=utf8");
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table[$module.'follow'],$DB_CONNECT); 
}

$_tmp = db_query( "select count(*) from ".$table[$module.'follow_pt'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("
CREATE TABLE `".$table[$module.'follow_pt']."` (
  `uid` int(20) unsigned NOT NULL auto_increment,
  `pt_name` varchar(20) NOT NULL,
  `pt_id` varchar(8) NOT NULL,
  `dr_name` varchar(50) NOT NULL default '',
  `status` char(1) NOT NULL,
  `date_update` varchar(14) NOT NULL,
  PRIMARY KEY  (`uid`),
  KEY `pt_id` (`pt_id`),
  KEY `date_update` (`date_update`),
  KEY `dr_name` (`dr_name`)
) ENGINE=".$DB['type']." CHARSET=utf8");
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table[$module.'follow_pt'],$DB_CONNECT); 
}

$_tmp = db_query( "select count(*) from ".$table[$module.'follow_comment'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("
CREATE TABLE `".$table[$module.'follow_comment']."` (
  `uid` int(20) unsigned NOT NULL auto_increment,
  `s_uid` int(11) NOT NULL default '0',
  `st_id` varchar(20) NOT NULL default '',
  `pt_name` varchar(20) NOT NULL,
  `pt_id` varchar(8) NOT NULL,
  `comment` text NOT NULL,
  `status` char(1) NOT NULL,
  `date_update` varchar(14) NOT NULL,
  `type` varchar(10) default '0',
  PRIMARY KEY  (`uid`),
  KEY `pt_id` (`pt_id`),
  KEY `st_id` (`st_id`),
  KEY `date_update` (`date_update`)
) ENGINE=".$DB['type']." CHARSET=utf8");
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table[$module.'follow_pt'],$DB_CONNECT); 
}

$_tmp = db_query( "select count(*) from ".$table[$module.'new_follow'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("
CREATE TABLE `".$table[$module.'new_follow']."` (
  `uid` int(20) unsigned NOT NULL auto_increment COMMENT 'ID',
  `s_uid` int(11) NOT NULL default '0' COMMENT '학기 ID',
  `st_id` varchar(20) NOT NULL default '' COMMENT '학번',
  `pt_name` varchar(20) NOT NULL default '' COMMENT '환자 성명',
  `pt_id` varchar(10) NOT NULL default '' COMMENT '환자 병록번호',
  `type` int(1) NOT NULL COMMENT '팔로우 타입',
  `status` char(1) NOT NULL default '' COMMENT '상태',
  `stage` varchar(100) default NULL COMMENT '단계',
  `comment` text NOT NULL COMMENT '비고',
  `date_update` varchar(14) NOT NULL default '' COMMENT '업데이트 날짜',
  PRIMARY KEY  (`uid`),
  KEY `pt_id` (`pt_id`),
  KEY `st_id` (`st_id`)
) ENGINE=".$DB['type']." CHARSET=utf8");
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table[$module.'follow_pt'],$DB_CONNECT); 
}

?>