<?php
	// ���� ������Ʈ ����� �� ��������...
	// �ֱ� 5��? Ȥ�� �̹���? �̷�������...

	$SCORE_ARRAY = array();
	
	
	
	if(!isset($st_id) || !$st_id || $st_id == '')
	{
		//$st_id = $my['id'];
	}else{

		$order_by = 'fcuid';
		$order_mode = 'ASC';
		$recnum = $recnum && $recnum < 200 ? $recnum : 10;

		$_table = $table[$m.'obser_score'].' fc, '.$table['s_mbrdata'].' mbrdata,'.$table['s_mbrid'].' mbrid';
		$_where = "s_uid = '".$s_uid."'"
			.' AND mbrid.uid = mbrdata.memberuid'
			.' AND mbrid.id = fc.st_id'
			." AND fc.st_id = '".$st_id."'";

		$_data = '*';
		$_sort = $order_by;
		$_orderby = $order_mode;
		
		$MY_ARRAY = getDbData($_table, $_where, $_data);
		
	}
	
	

?>
