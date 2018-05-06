<?php
if(!defined('__KIMS__')) exit;

// 보존과 모듈 옵져 테이블
// 사용 특성상 회원 아이디가 아닌, 학번으로 데이터를 저장한다
// ~42기까지 사용되던 테이블 구조 이어받으며, 불필요한 column 삭제 및 일부 속성 변경
$_tmp = db_query( "select count(*) from ".$table[$module.'score'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("
CREATE TABLE `".$table[$module.'score']."` (
  `uid` int(20) NOT NULL auto_increment,
  `st_id` varchar(20) NOT NULL default '0',
  `s_uid` int	NOT NULL default 0,
  
  `pre_st_ant` 			int(4) NOT NULL default 0,
  `pre_st_post` 		int(4) NOT NULL default 0,
  `pre_st_cervical` 	int(4) NOT NULL default 0,
  `pre_st_am` 			int(4) NOT NULL default 0,
  
  `indirect_prep_imp`	int(4) NOT NULL default 0,
  `indirect_setting`	int(4) NOT NULL default 0,
  
  `am`					int(4) NOT NULL default 0,
  
  `tooth_colored_simple`	int(4) NOT NULL default 0,
  `tooth_colored_complex`	int(4) NOT NULL default 0,
  `tooth_colored_diastema`	int(4) NOT NULL default 0,
  
  `post`				int(4) NOT NULL default 0,
  `core`				int(4) NOT NULL default 0,
  
  `others`				int(4) NOT NULL default 0,
  
  `surgery`				int(4) NOT NULL default 0,
  `miscellaneous`		int(4) NOT NULL default 0,
  
  `pre_st_ant_pe`		tinyint(1) NOT NULL default 0,
  `pre_st_ant_ce`		tinyint(1) NOT NULL default 0,
  `pre_st_ant_cf`		tinyint(1) NOT NULL default 0,

  `pre_st_pre_pe`		tinyint(1) NOT NULL default 0,
  `pre_st_pre_ce`		tinyint(1) NOT NULL default 0,
  `pre_st_pre_cf`		tinyint(1) NOT NULL default 0,

  `pre_st_ant_re_rm`		tinyint(1) NOT NULL default 0,
  `pre_st_ant_re_ce`		tinyint(1) NOT NULL default 0,
  `pre_st_ant_re_cf`		tinyint(1) NOT NULL default 0,

  `pre_st_pre_re_rm`		tinyint(1) NOT NULL default 0,
  `pre_st_pre_re_ce`		tinyint(1) NOT NULL default 0,
  `pre_st_pre_re_cf`		tinyint(1) NOT NULL default 0,
  
  `pre_st_inlay_gold_prep`		tinyint(1) NOT NULL default 0,
  `pre_st_inlay_gold_setting`	tinyint(1) NOT NULL default 0,
  `pre_st_inlay_resin_prep`		tinyint(1) NOT NULL default 0,
  `pre_st_inlay_resin_setting`	tinyint(1) NOT NULL default 0,
  
  `endo_molar_pe`			int(4) NOT NULL default 0,
  `endo_molar_ce`			int(4) NOT NULL default 0,
  `endo_molar_cf`			int(4) NOT NULL default 0,
  `endo_molar_etc`			int(4) NOT NULL default 0,

  `endo_pre_pe`			int(4) NOT NULL default 0,
  `endo_pre_ce`			int(4) NOT NULL default 0,
  `endo_pre_cf`			int(4) NOT NULL default 0,
  `endo_pre_etc`		int(4) NOT NULL default 0,

  `endo_ant_pe`			int(4) NOT NULL default 0,
  `endo_ant_ce`			int(4) NOT NULL default 0,
  `endo_ant_cf`			int(4) NOT NULL default 0,
  `endo_ant_etc`		int(4) NOT NULL default 0,

  `fol_cp` int(4) NOT NULL default '0',
  `fol_ei` int(4) NOT NULL default '0',
  
  
  `st_op_prev_score`			int(4) NOT NULL default 0,
  `st_op_tooth_colored_cervical`	int(4) NOT NULL default 0,
  `st_op_tooth_colored_simple`		int(4) NOT NULL default 0,
  `st_op_tooth_colored_complex`		int(4) NOT NULL default 0,
  `st_op_tooth_colored_diastema`	int(4) NOT NULL default 0,
  
  `st_op_am_simple`		int(4) NOT NULL default 0,
  `st_op_am_complex`	int(4) NOT NULL default 0,
  
  `st_op_bleaching`		int(4) NOT NULL default 0,
  `st_op_others`		int(4) NOT NULL default 0,
  
  `st_endo_1st_point`		int(4) NOT NULL default 0,
  `st_endo_2nd_point`		int(4) NOT NULL default 0,
  
  `st_endo_1`	varchar(50) NOT NULL default '',
  `st_endo_2`	varchar(50) NOT NULL default '',
  
  `st_inlay_1_case`		varchar(15) NOT NULL default '',
  `st_inlay_2_case`		varchar(15) NOT NULL default '',
  
  `st_inlay_1_proc`		varchar(50)		NOT NULL default '',
  `st_inlay_2_proc`		varchar(50)		NOT NULL default '',
 
  `st_op_chair_assigned`	int NOT NULL default 0,
  

  `date_update` varchar(14) NOT NULL default '',
  
  `f_indirect_prep_imp` int(4) NOT NULL default '0',
  `f_indirect_setting` int(4) NOT NULL default '0',
  `f_am` int(4) NOT NULL default '0',
  `f_tooth_colored_simple` int(4) NOT NULL default '0',
  `f_tooth_colored_complex` int(4) NOT NULL default '0',
  `f_tooth_colored_diastema` int(4) NOT NULL default '0',
  `f_post` int(4) NOT NULL default '0',
  `f_core` int(4) NOT NULL default '0',
  `f_others` int(4) NOT NULL default '0',
  `f_surgery` int(4) NOT NULL default '0',
  `f_miscellaneous` int(4) NOT NULL default '0',
  `f_endo_molar_pe` int(4) NOT NULL default '0',
  `f_endo_molar_ce` int(4) NOT NULL default '0',
  `f_endo_molar_cf` int(4) NOT NULL default '0',
  `f_endo_molar_etc` int(4) NOT NULL default '0',
  `f_endo_pre_pe` int(4) NOT NULL default '0',
  `f_endo_pre_ce` int(4) NOT NULL default '0',
  `f_endo_pre_cf` int(4) NOT NULL default '0',
  `f_endo_pre_etc` int(4) NOT NULL default '0',
  `f_endo_ant_pe` int(4) NOT NULL default '0',
  `f_endo_ant_ce` int(4) NOT NULL default '0',
  `f_endo_ant_cf` int(4) NOT NULL default '0',
  `f_endo_ant_etc` int(4) NOT NULL default '0',
  `f_charting` int(4) NOT NULL default '0',
  `f_diastema` int(4) NOT NULL default '0',
  `diastema` int(4) NOT NULL default '0',
  `charting` int(4) NOT NULL default '0',

  
  PRIMARY KEY  (`uid`),
  KEY `st_id` (`st_id`),
  KEY `s_uid` (`s_uid`),
  KEY `date_update` (`date_update`)
) ENGINE=".$DB['type']." CHARSET=UTF8");
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table[$module.'score'],$DB_CONNECT); 
}
?>
