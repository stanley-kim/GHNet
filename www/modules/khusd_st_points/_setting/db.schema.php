<?php
if(!defined('__KIMS__')) exit;

// 상/벌점 관리 테이블

$_tmp = db_query( "select count(*) from ".$table[$module.'point_hospital'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("
CREATE TABLE ".$table[$module.'point_hospital']." (
uid		BIGINT			PRIMARY KEY		NOT NULL AUTO_INCREMENT,
s_uid   	INT			DEFAULT '0'		NOT NULL,
my_mbruid	INT			DEFAULT '0'		NOT NULL,
point		INT			DEFAULT '0'		NOT NULL,
content		TEXT			NOT NULL,
d_occur		VARCHAR(14)		DEFAULT ''		NOT NULL,
d_regis		VARCHAR(14)		DEFAULT ''		NOT NULL,

KEY my_mbruid(my_mbruid),
KEY s_uid(s_uid),
KEY d_occur(d_occur),
KEY d_regis(d_regis)) ENGINE=".$DB['type']." CHARSET=UTF8");
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table['point_hospital'],$DB_CONNECT); 
}

$_tmp = db_query( "select count(*) from ".$table[$module.'point_school'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("
CREATE TABLE ".$table[$module.'point_school']." (
uid		BIGINT			PRIMARY KEY		NOT NULL AUTO_INCREMENT,
s_uid   	INT			DEFAULT '0'		NOT NULL,
my_mbruid	INT			DEFAULT '0'		NOT NULL,
point		INT			DEFAULT '0'		NOT NULL,
content		TEXT			NOT NULL,
d_occur		VARCHAR(14)		DEFAULT ''		NOT NULL,
d_regis		VARCHAR(14)		DEFAULT ''		NOT NULL,

KEY my_mbruid(my_mbruid),
KEY s_uid(s_uid),
KEY d_occur(d_occur),
KEY d_regis(d_regis)) ENGINE=".$DB['type']." CHARSET=UTF8");
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table['point_school'],$DB_CONNECT); 
}

?>