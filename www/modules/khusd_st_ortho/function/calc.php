<?php 


function sum_from1toN($Number)  {
        $ret_value =  0;
        if( !is_int($Number) ) return 0;
        for($i=1; $i<=$Number;$i++)
                $ret_value = $ret_value + $i;
        return $ret_value;
}
//only report point
function _report_point($FOL_TYPE,$freport,$fbool_analysis,$fbool_mandatorybonding,$fbool_bonding ,$fobser,
$follow_type_new, $follow_type_old,
$follow_req_new, $follow_req_old,
$point_follow_new_report, $point_follow_old_report, $point_obser) {

        //new patient and reqs are ok
        if( $FOL_TYPE == $follow_type_new && $fobser >= $follow_req_new && $fbool_analysis != 0 && ( ($fbool_mandatorybonding!=0&&$fbool_bonding!= 0) || ($fbool_mandatorybonding == 0) )  )
                return  $freport*$point_follow_new_report ;
        //old patient and reqs are ok
        else  if(  $FOL_TYPE == $follow_type_old && $fobser >= $follow_req_old )
                return  $freport*$point_follow_old_report;

                 return 0;
}
//only follow point
function _follow_point($FOL_TYPE,$freport,$fbool_analysis,$fbool_mandatorybonding,$fbool_bonding ,$fobser,
$follow_type_new, $follow_type_old,
$follow_req_new, $follow_req_old,
$point_follow_new_report, $point_follow_old_report, $point_obser) {

        //new patient and reqs are ok
        if( $FOL_TYPE == $follow_type_new && $fobser >= $follow_req_new && $fbool_analysis != 0 && ( ($fbool_mandatorybonding!=0&&$fbool_bonding!= 0) || ($fbool_mandatorybonding == 0) )  )
                return  sum_from1toN($fobser);
        //old patient and reqs are ok
        else  if(  $FOL_TYPE == $follow_type_old && $fobser >= $follow_req_old )
                return  sum_from1toN($fobser);

                 return 0;
}
//follow point + report point
function follow_point2($FOL_TYPE,$freport,$fbool_analysis,$fbool_mandatorybonding,$fbool_bonding ,$fobser,
$follow_type_new, $follow_type_old,
$follow_req_new, $follow_req_old,
$point_follow_new_report, $point_follow_old_report, $point_obser) {
	return _follow_point($FOL_TYPE,$freport,$fbool_analysis,$fbool_mandatorybonding,$fbool_bonding ,$fobser,
$follow_type_new, $follow_type_old,
$follow_req_new, $follow_req_old,
$point_follow_new_report, $point_follow_old_report, $point_obser)+ 
	_report_point($FOL_TYPE,$freport,$fbool_analysis,$fbool_mandatorybonding,$fbool_bonding ,$fobser,
$follow_type_new, $follow_type_old,
$follow_req_new, $follow_req_old,
$point_follow_new_report, $point_follow_old_report, $point_obser); 
}
/*
function follow_point($FOL_TYPE,$freport,$fbool_analysis,$fbool_mandatorybonding,$fbool_bonding ,$fobser,
$follow_type_new, $follow_type_old,
$follow_req_new, $follow_req_old,
$point_follow_new_report, $point_follow_old_report, $point_obser) {

        //new patient and reqs are ok
        if( $FOL_TYPE == $follow_type_new && $fobser >= $follow_req_new && $fbool_analysis != 0 && ( ($fbool_mandatorybonding!=0&&$fbool_bonding!= 0) || ($fbool_mandatorybonding == 0) )  )
                return  sum_from1toN($fobser)+$freport*$point_follow_new_report ;
        //old patient and reqs are ok
        else  if(  $FOL_TYPE == $follow_type_old && $fobser >= $follow_req_old )
                return  sum_from1toN($fobser) + $freport*$point_follow_old_report;

                 return 0;
}
*/
//obser point
function obser_point($FOL_TYPE,$freport,$fbool_analysis,$fbool_mandatorybonding,$fbool_bonding ,$fobser,
$follow_type_new, $follow_type_old,
$follow_req_new, $follow_req_old,
$point_follow_new_report, $point_follow_old_report, $point_obser) {

        //old patienr and reqs are not ok
        //if(  $FOL_TYPE == $d['khusd_st_ortho']['FOLLOW_TYPE']['OLD'] && $fobser < $d['khusd_st_ortho']['score']['follow_req_old'] )
        if(  $FOL_TYPE == $follow_type_old &&  $fobser < $follow_req_old  )
                return  $fobser*$point_obser;
        return 0 ;
}
//follow point + obser point 
function follow_obser_point($FOL_TYPE,$freport,$fbool_analysis,$fbool_mandatorybonding,$fbool_bonding ,$fobser,
$follow_type_new, $follow_type_old,
$follow_req_new, $follow_req_old,
$point_follow_new_report, $point_follow_old_report, $point_obser) {
	return _follow_point($FOL_TYPE,$freport,$fbool_analysis,$fbool_mandatorybonding,$fbool_bonding ,$fobser,
$follow_type_new, $follow_type_old,
$follow_req_new, $follow_req_old,
$point_follow_new_report, $point_follow_old_report, $point_obser)+ 
	_report_point($FOL_TYPE,$freport,$fbool_analysis,$fbool_mandatorybonding,$fbool_bonding ,$fobser,
$follow_type_new, $follow_type_old,
$follow_req_new, $follow_req_old,
$point_follow_new_report, $point_follow_old_report, $point_obser)+ 
	obser_point($FOL_TYPE,$freport,$fbool_analysis,$fbool_mandatorybonding,$fbool_bonding ,$fobser,
$follow_type_new, $follow_type_old,
$follow_req_new, $follow_req_old,
$point_follow_new_report, $point_follow_old_report, $point_obser); 
}

	

?>
