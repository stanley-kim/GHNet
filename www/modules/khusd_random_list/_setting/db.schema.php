<?php
if(!defined('__KIMS__')) exit;


$_tmp = db_query( "select count(*) from ".$table[$module.'item'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("
CREATE TABLE `".$table[$module.'item']."` (
  `uid` int(20) NOT NULL auto_increment,
  `s_uid` int NOT NULL default 0,
  `st_id` varchar(20) NOT NULL default '',
  `subject` varchar(200) NOT NULL default '',
  `content` MEDIUMTEXT NOT NULL default '',
  `reg_date` TIMESTAMP NOT NULL default CURRENT_TIMESTAMP,
  
  PRIMARY KEY  (`uid`),
  KEY `s_uid` (`s_uid`),
) ENGINE=".$DB['type']." CHARSET=UTF8");
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table[$module.'group'],$DB_CONNECT); 
}


$_tmp = db_query( "select count(*) from ".$table[$module.'list'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("
CREATE TABLE `".$table[$module.'list']."` (
  `uid` int(20) NOT NULL auto_increment,

  `item_uid` int(20) NOT NULL default '0',
  `st_id` varchar(20) NOT NULL default '0',
  `rand` float,

  PRIMARY KEY  (`uid`),
  KEY `item_uid` (`item_uid`),
  KEY `st_id` (`st_id`)
) ENGINE=".$DB['type']." CHARSET=UTF8");
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table[$module.'group_mbr'],$DB_CONNECT); 
}


?>