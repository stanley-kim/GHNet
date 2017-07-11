<?php
$table[$module.'group'] = $DB['head'].'_'.$module.'_group'; // 픽스 조 테이블
$table[$module.'group_mbr'] = $DB['head'].'_'.$module.'_group_mbr'; // 픽스 조 구성원 테이블
$table[$module.'schedule'] = $DB['head'].'_'.$module.'_schedule'; // 픽스 턴 시간표 테이블 (각 과별 조 일정표)
$table[$module.'timetable'] = $DB['head'].'_'.$module.'_timetable'; // 픽스 일정 테이블 (매주간 픽스 일정)
?>