<?php
	// ���� ������Ʈ ����� �� ��������...
	// �ֱ� 5��? Ȥ�� �̹���? �̷�������...

	$SCORE_ARRAY = array();
	
	if(!isset($st_id) || !$st_id || $st_id == '')
	{
		$st_id = $my['id'];
	}
/*	
	if(!$MANAGER && $st_id != $my['id'])
	{
		getLink('', '', 'Ÿ�ο� ���� ��ȸ�� ���� ������ �����ϴ�.'.$st_id, '');
	}
*/
	$order_by = 'st_id';
	$order_mode = 'ASC';
	$recnum = $recnum && $recnum < 200 ? $recnum : 10;

	$_table = $table[$m.'obser_score'].' fc, '.$table['s_mbrdata'].' mbrdata,'.$table['s_mbrid'].' mbrid';
	$_where = "s_uid = '".$s_uid."'"
		.' AND mbrid.uid = mbrdata.memberuid'
		.' AND mbrid.id = fc.st_id';

	$_data = '*, fc.uid as fcuid';
	$_sort = $order_by;
	$_orderby = $order_mode;
	
    $MY_ROWS = getDbArray($_table, $_where, $_data, $_sort, $_orderby, 0, 0);
    $SCORE_ARRAY = array();
    while( $_ROW = db_fetch_array($MY_ROWS) )
    {
        $SCORE_ARRAY[$_ROW['fcuid']] = $_ROW;
    }
    
    
?>
