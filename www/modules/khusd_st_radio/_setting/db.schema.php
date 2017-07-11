<?php
if(!defined('__KIMS__')) exit;

// 영상과 모듈 옵져 테이블
// 사용 특성상 회원 아이디가 아닌, 학번으로 데이터를 저장한다
// ~42기까지 사용되던 테이블 구조 이어받으며, 불필요한 column 삭제 및 일부 속성 변경
$_tmp = db_query( "select count(*) from ".$table[$module.'score'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("
CREATE TABLE `".$table[$module.'score']."` (
  `uid` int(20) NOT NULL auto_increment,
  `st_id` varchar(20) NOT NULL default '0',
  `s_uid` int	NOT NULL default 0,
  
  `taking` int(4) NOT NULL default 0,
  `taking_pt` int(4) NOT NULL default 0,
  `follow` int(4) NOT NULL default 0,
  `panorama` int(4) NOT NULL default 0,

  `penalty_taking` int(4) NOT NULL default 0,

  `obser_decoding` int(4) NOT NULL default 0,
  `obser_filming` int(4) NOT NULL default 0,
  
  `date_update` varchar(14) NOT NULL default '',
  PRIMARY KEY  (`uid`),
  KEY `st_id` (`st_id`),
  KEY `date_update` (`date_update`)
) ENGINE=".$DB['type']." CHARSET=UTF8");
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table[$module.'score'],$DB_CONNECT); 
}
?>
