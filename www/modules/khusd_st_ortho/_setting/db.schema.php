<?php
if(!defined('__KIMS__')) exit;

// 교정과 모듈 옵져 테이블
// 사용 특성상 회원 아이디가 아닌, 학번으로 데이터를 저장한다
// ~42기까지 사용되던 테이블 구조 이어받으며, 불필요한 column 삭제 및 일부 속성 변경
$_tmp = db_query( "select count(*) from ".$table[$module.'score'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("
CREATE TABLE `".$table[$module.'score']."` (
  `uid` int(20) NOT NULL auto_increment,
  `st_id` varchar(20) NOT NULL default '0',
  `s_uid` int	NOT NULL default 0,
  
  `obser_cnt` int(4) NOT NULL default '0',
  `obser`	int(4) NOT NULL default 0,

  `follow_old_obs_cnt` int(4) NOT NULL default '0',
  `follow_old_cnt` int(4) NOT NULL default '0',
  `follow_old` int(4) NOT NULL default '0',
  `follow_new_obs_cnt` int(4) NOT NULL default '0',
  `follow_new_cnt` int(4) NOT NULL default '0',
  `follow_new` int(4) NOT NULL default '0',
  `appliance` varchar(5) NOT NULL default '00000',
  `appliance_score` int(4) NOT NULL default '0',
  `date_update` varchar(14) NOT NULL default '',

  `fabri_a` int(4) NOT NULL default '0',
  `fabri_b` int(4) NOT NULL default '0',
  `fabri_c` int(4) NOT NULL default '0',
  PRIMARY KEY  (`uid`),
  KEY `st_id` (`st_id`),
  KEY `date_update` (`date_update`)
) ENGINE=".$DB['type']." CHARSET=UTF8");
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table[$module.'score'],$DB_CONNECT); 
}

$_tmp = db_query( "select count(*) from ".$table[$module.'follow_pt'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("
CREATE TABLE `".$table[$module.'follow_pt']."` (
  `uid` int(20) NOT NULL auto_increment,

  `pt_name` varchar(20) NOT NULL default '',
  `pt_id`	varchar(8) NOT NULL default '',
  `pf_name` varchar(10) NOT NULL,
  `dr_name` varchar(10) NOT NULL default '',
  `dr_room` int NOT NULL default 0,
  
  `status` char(1) NOT NULL default '',
  
  `date_update` varchar(14) NOT NULL default '',

  PRIMARY KEY  (`uid`),
  KEY `pt_id` (`pt_id`),
  KEY `dr_name` (`dr_name`),
  KEy `dr_room` (`dr_room`),
) ENGINE=".$DB['type']." CHARSET=UTF8");
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table[$module.'follow_pt'],$DB_CONNECT); 
}

$_tmp = db_query( "select count(*) from ".$table[$module.'follow'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("
CREATE TABLE `".$table[$module.'follow']."` (
  `uid` int(20) NOT NULL auto_increment,
  `s_uid` int	NOT NULL default 0,
  
  `pt_uid` int(20) NOT NULL default 0,

  `st_id` varchar(20) NOT NULL default '',
  
  `status` char(1) NOT NULL default '',
  
  `date_update` varchar(14) NOT NULL default '',

  `type` tinyint(1) default '0',
  `step` int(1) default '0',
  `bool_analysis` tinyint(1) default '0',
  `bool_fabri` tinyint(1) default '0',
  `report` tinyint(1) default '0',

  PRIMARY KEY  (`uid`),
  KEy `pt_uid` (`pt_uid`),
  KEY `st_id` (`st_id`),
  KEY `s_uid` (`s_uid`),
  KEY `date_update` (`date_update`)
) ENGINE=".$DB['type']." CHARSET=UTF8");
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table[$module.'follow'],$DB_CONNECT); 
}



?>
