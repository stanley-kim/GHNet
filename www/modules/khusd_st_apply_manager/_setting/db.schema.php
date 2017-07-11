<?php
if(!defined('__KIMS__')) exit;

// 신청 정보 테이블
// 각종 선착순 신청 상황에 대한 정보를 담고 있는 테이블
// 
// apply_limit : 한 명당 신청할 수 있는 개수 제한, 0이면 신청 제한 없음
// date_start : 신청 시작 시각, 이 전부터 신청 가능하지만 이 시각 이전의 신청은 인정되지 않음
// apply_type : 신청 종류, 치주수술, 보철 팔로우 등의 종류를 지정
// 			이런 미리 정의된 종류의 경우, 다른 모듈의 DB를 참고하여 정보를 가져오게 됨
// 			그 외의 신청은 etc 로 지정하여, 각각의 내용을 직접 작성하여야 함. 게시판에 가까운 형태를 띰
// status : 현재 상태, 
// 			c - closed, 신청이 마감된 상태
// 			o - open, 신청 가능 상태, 하지만 신청시간보다 이전일 수 있다. 
//$_tmp = db_query( "select count(*) from ".$table[$module.'apply_info_list'], $DB_CONNECT );
//if ( !$_tmp ) {
$_tmp = ("
CREATE TABLE `".$table[$module.'apply_info_list']."` (
  `uid` int NOT NULL auto_increment,
  
  `s_uid` int NOT NULL default 0,
  `st_id` varchar(20) NOT NULL default '',

  `apply_limit` tinyint NOT NULL default 0,

  `department` char(20) NOT NULL default 'etc',
  `subject` varchar(200) NOT NULL default '',
  `content` MEDIUMTEXT NOT NULL default '',
  `date_start` varchar(14) NOT NULL default '',
  `date_end` varchar(14) NOT NULL default '',
  `apply_type` varchar(10) NOT NULL default 'etc',	
  
  `status` char(1) NOT NULL default 'o',
  `able_apply_accepted`	char(1) NOT NULL default 'y',
  `num_item` int NOT NULL default 0,
  
  `is_perio_surgery` char(1) NOT NULL default 'n',
  
  `date_reg` varchar(14) NOT NULL default '',
  `date_select` varchar(14) NOT NULL default '',
  
  PRIMARY KEY (`uid`),
  KEY `s_uid` (`s_uid`),
  KEY `date_start` (`date_start`)
) ENGINE=".$DB['type']." CHARSET=UTF8");
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table[$module.'apply_info_list'],$DB_CONNECT);
//}


// 신청 항목 테이블
// 신청 가능한 각각의 항목에 대한 정보를 담고 있다. 
// 
// apply_info_uid : 이 아이템을 소유하는 apply_info 의 uid
// content : etc 타입의 경우 content의 정보를 출력한다. 
// ref_uid : 미리 정의된 종류의 경우, 다른 DB를 참고하는데, 그 때 사용되는 uid
// accept_limit : 이 아이템이 선착순 몇 명인지에 대한 정보
$_tmp = db_query( "select count(*) from ".$table[$module.'apply_item'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("
CREATE TABLE `".$table[$module.'apply_item']."` (
  `uid` int NOT NULL auto_increment,
  
  `apply_info_uid` int NOT NULL,
  
  `content` text(100) default '',
  
  `ref_uid` int default 0,
  
  `accept_limit` tinyint NOT NULL default 0,
  
  `date_reg` varchar(14) NOT NULL default '',
  
  `date_item` varchar(14) NOT NULL default '',
  `doctor`	varchar(20) NOT NULL default '',
  `assist`	varchar(20) NOT NULL default '',
  `pt_name`	varchar(20) NOT NULL default '',
  `is_imp_cent` tinyint(1)  NOT NULL default 0,
  `pt_id` int  NOT NULL,
  
  PRIMARY KEY  (`uid`),
  KEY `apply_info_uid` (`apply_info_uid`),
  KEY `ref_uid` (`ref_uid`),
  KEY `date_item` (`date_item`)
) ENGINE=".$DB['type']." CHARSET=UTF8");
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table[$module.'apply_item'],$DB_CONNECT); 
}

// 신청 데이터 테이블
// status 값은 var/var.define.php 참고
$_tmp = db_query( "select count(*) from ".$table[$module.'apply_list'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("
CREATE TABLE `".$table[$module.'apply_list']."` (
  `uid` int(20) NOT NULL auto_increment,
  
  `st_id` varchar(20) NOT NULL default '',
  
  `apply_info_uid` int NOT NULL default '0',
  `apply_item_uid` int NOT NULL default '0', 
  `original_apply_item_uid` int, 
  
  `status` char(1) NOT NULL default 'p',
  `rand` float,
  
  `timestamp` DOUBLE NOT NULL default 0,
  `date_reg` varchar(14) NOT NULL default '',
  `date_cancel` varchar(14) NOT NULL default '',
  
  PRIMARY KEY  (`uid`),
  KEY `st_id` (`st_id`),
  KEY `apply_info_uid` (`apply_info_uid`),
  KEY `apply_item_uid` (`apply_item_uid`),
  KEY `original_apply_item_uid` (`original_apply_item_uid`),
  KEY `rand` (`rand`),
  KEY `timestamp` (`timestamp`)
) ENGINE=".$DB['type']." CHARSET=UTF8");
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table[$module.'apply_list'],$DB_CONNECT); 
}
?>
