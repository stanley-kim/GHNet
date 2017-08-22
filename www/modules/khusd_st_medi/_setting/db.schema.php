<?php
if(!defined('__KIMS__')) exit;

// 구강내과 모듈 옵져 테이블
// 사용 특성상 회원 아이디가 아닌, 학번으로 데이터를 저장한다
// ~42기까지 사용되던 테이블 구조 이어받으며, 불필요한 column 삭제 및 일부 속성 변경
$_tmp = db_query( "select count(*) from ".$table[$module.'score'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("
CREATE TABLE `".$table[$module.'score']."` (
  `uid` int(20) NOT NULL auto_increment,
  `st_id` varchar(20) NOT NULL default '0',
  `s_uid` int	NOT NULL default 0,
  
  `charting` int(4) NOT NULL default 0,
  `obser` int(4) NOT NULL default 0,
  `splint_obser` int(4) NOT NULL default 0,
  `physical_tx` int(4) NOT NULL default 0,
  `odor` int(4) NOT NULL default 0,
  `m_text` int(4) NOT NULL default 0,
  `charting_obser` int(4) NOT NULL default 0,
  `fix_am` int(4) NOT NULL default 0,
  `fix_pm` int(4) NOT NULL default 0,

  `soft_charting` int(4) NOT NULL default 0,
  `portfolio1` int(4) NOT NULL default 0,
  `portfolio2` int(4) NOT NULL default 0,
  `portfolio3` int(4) NOT NULL default 0,
  `portfolio4` int(4) NOT NULL default 0,
  `splint_impression` int(4) NOT NULL default 0,
  `splint_polishing` int(4) NOT NULL default 0,
  `splint_adjust` int(4) NOT NULL default 0,
  `physical_tx_fix` int(4) NOT NULL default 0,
  `infra_tx` int(4) NOT NULL default 0,
  `ultra_tx` int(4) NOT NULL default 0,
  `east_tx` int(4) NOT NULL default 0,
  `tens_tx` int(4) NOT NULL default 0,
  `ionto_tx` int(4) NOT NULL default 0,
  `tmd_tx` int(4) NOT NULL default 0,
  `soft_tx` int(4) NOT NULL default 0,
  `saliva_test` int(4) NOT NULL default 0,
  `charting_tmd_1cycle_charting` int(4) NOT NULL default 0,
  `charting_tmd_1cycle_check` int(4) NOT NULL default 0,
  `charting_tmd_1cycle_follow1st` int(4) NOT NULL default 0,
  `charting_tmd_1cycle_follow2nd` int(4) NOT NULL default 0,
  `charting_tmd_2cycle_charting` int(4) NOT NULL default 0,
  `charting_tmd_2cycle_check` int(4) NOT NULL default 0,
  `charting_tmd_2cycle_follow1st` int(4) NOT NULL default 0,
  `charting_tmd_2cycle_follow2nd` int(4) NOT NULL default 0,
  `charting_tmd_3cycle_charting` int(4) NOT NULL default 0,
  `charting_tmd_3cycle_check` int(4) NOT NULL default 0,
  `charting_tmd_3cycle_follow1st` int(4) NOT NULL default 0,
  `charting_tmd_3cycle_follow2nd` int(4) NOT NULL default 0,
  `charting_soft_charting` int(4) NOT NULL default 0,
  `charting_soft_check` int(4) NOT NULL default 0,
  `charting_soft_follow1st` int(4) NOT NULL default 0,
  `charting_soft_follow2nd` int(4) NOT NULL default 0,
  
  `date_update` varchar(14) NOT NULL default '',
  PRIMARY KEY  (`uid`),
  KEY `st_id` (`st_id`),
  KEY `date_update` (`date_update`)
) ENGINE=".$DB['type']." CHARSET=UTF8");
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table[$module.'score'],$DB_CONNECT); 
}
?>
