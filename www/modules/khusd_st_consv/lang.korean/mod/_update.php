<?php
	// 기존 정보 불러오기
	$SCORE_ROWS = getDbArray($table[$m.'score'],"s_uid = '".$s_uid."' AND st_id='".$my['id']."'", '*', 'date_update', 'desc', 1, 1);
	$SCORE = db_fetch_array($SCORE_ROWS);
	
	if(!$SCORE['uid']) {
		$SCORE['pre_st_ant'] = 0;
		$SCORE['pre_st_post'] = 0;
		$SCORE['pre_st_cervical'] = 0;
		$SCORE['pre_st_am'] = 0;

		$SCORE['indirect_prep_imp'] = 0;
		$SCORE['indirect_setting'] = 0;

		$SCORE['am'] = 0;

		$SCORE['tooth_colored_simple'] = 0;
		$SCORE['tooth_colored_complex'] = 0;
		$SCORE['tooth_colored_diastema'] = 0;

		$SCORE['post'] = 0;
		$SCORE['core'] = 0;

		$SCORE['others'] = 0;

		$SCORE['surgery'] = 0;
		$SCORE['miscellaneous'] = 0;
		
		$SCORE['pre_st_ant_pe'] = false;
		$SCORE['pre_st_ant_ce'] = false;
		$SCORE['pre_st_ant_cf'] = false;

		$SCORE['pre_st_pre_pe'] = false;
		$SCORE['pre_st_pre_ce'] = false;
		$SCORE['pre_st_pre_cf'] = false;

		$SCORE['pre_st_ant_re_rm'] = false;
		$SCORE['pre_st_ant_re_ce'] = false;
		$SCORE['pre_st_ant_re_cf'] = false;

		$SCORE['pre_st_pre_re_rm'] = false;
		$SCORE['pre_st_pre_re_ce'] = false;
		$SCORE['pre_st_pre_re_cf'] = false;

		$SCORE['endo_molar_pe'] = 0;
		$SCORE['endo_molar_ce'] = 0;
		$SCORE['endo_molar_cf'] = 0;
		$SCORE['endo_molar_etc'] = 0;

		$SCORE['endo_pre_pe'] = 0;
		$SCORE['endo_pre_ce'] = 0;
		$SCORE['endo_pre_cf'] = 0;
		$SCORE['endo_pre_etc'] = 0;

		$SCORE['endo_ant_pe'] = 0;
		$SCORE['endo_ant_ce'] = 0;
		$SCORE['endo_ant_cf'] = 0;
		$SCORE['endo_ant_etc'] = 0;
		
		$SCORE['fol_cp'] = 0;
		$SCORE['fol_ei'] = 0;
		
		$SCORE['st_op_tooth_colored_cervical'] = 0;
		$SCORE['st_op_tooth_colored_simple'] = 0;
		$SCORE['st_op_tooth_colored_complex'] = 0;
		$SCORE['st_op_tooth_colored_diastema'] = 0;

		$SCORE['st_op_chair_assigned'] = 0;
		$SCORE['st_op_am_simple'] = 0;
		$SCORE['st_op_am_complex'] = 0;
		
		$SCORE['st_op_bleaching'] = 0;
		$SCORE['st_op_others'] = 0;
		
		$SCORE['st_endo_1st_point'] = 0;
		$SCORE['st_endo_2nd_point'] = 0;
	}
?>