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
  
  `follow_pt` int(4) NOT NULL default 0,
  `follow` int(4) NOT NULL default 0,
  `charting` int(4) NOT NULL default 0,
  `charting_obser` int(4) NOT NULL default 0,
  `obser` int(4) NOT NULL default 0,
  `ga` int(4) NOT NULL default 0,
  `sedation_rp` int(4) NOT NULL default 0,
  `clinical_rp` int(4) NOT NULL default 0,
  `blsm` int(4) NOT NULL default 0,
  `st_pt` int(4) NOT NULL default 0,
  `st_point` int(4) NOT NULL default 0,
  `st_assist` int(4) NOT NULL default 0,
  `fix` int(4) NOT NULL default 0,
  `prof_fix_am` int(4) NOT NULL default 0,
  `prof_fix_pm` int(4) NOT NULL default 0,
  `st_add_a` int(4) NOT NULL default '0',
  `st_add_b` int(4) NOT NULL default '0',
  `st_add_c` int(4) NOT NULL default '0',

  `is_goal` char(1) NOT NULL default 'n',
  
  `date_update` varchar(14) NOT NULL default '',
  `follow_str` varchar(100) NOT NULL default '',

  PRIMARY KEY  (`uid`),
  KEY `st_id` (`st_id`),
  KEY `is_goal` (`is_goal`),
  KEY `date_update` (`date_update`)
) ENGINE=".$DB['type']." CHARSET=UTF8");
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table[$module.'score'],$DB_CONNECT); 
}
?>
