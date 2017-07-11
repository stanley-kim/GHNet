<?php
if(!defined('__KIMS__')) exit;

// 학기정보
// sid -> 2013FW3Y (2013년도 F/W 시즌 3학년)
$_tmp = db_query( "select count(*) from ".$table[$module.'semester'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("
CREATE TABLE ".$table[$module.'semester']." (
	uid		INT			PRIMARY KEY  NOT NULL AUTO_INCREMENT,
	
	sid		VARCHAR(10)	DEFAULT '' NOT NULL,
	description VARCHAR(200) DEFAULT '' NOT NULL, 
	
	KEY sid(sid)
) ENGINE=".$DB['type']." CHARSET=UTF8");                            
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table[$module.'semester'],$DB_CONNECT); 
}

// 학기 구성원 정보
$_tmp = db_query( "select count(*) from ".$table[$module.'s_mbr'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("
CREATE TABLE ".$table[$module.'s_mbr']." (
	s_uid	INT	DEFAULT 0 	NOT NULL,
	
	st_id	VARCHAR(20)	DEFAULT '' NOT NULL,

	KEY s_uid(s_uid),	
	KEY st_id(st_id)
) ENGINE=".$DB['type']." CHARSET=UTF8");                            
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table[$module.'s_mbr'],$DB_CONNECT); 
}

?>