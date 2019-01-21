<div id="update" class="khusd_st manager">

        <?php if( permcheck('duplication_checker') ) :?>




        <table summary="통합 점수표 입니다.">
        <caption>서브인턴/익스턴십 summary</caption>
        <colgroup>
        <col width="10">
        <col width="70">
	<?php  for($idx=0; $idx<=5; $idx++)  :?>
        <col width="20">
	<?php endfor ?>
	<?php  for($idx=0; $idx<=5; $idx++)  :?>
        <col width="20">
	<?php endfor ?>
        </colgroup>
        <thead>

        <tr>
        <th scope="col" rowspan=1 class="split">No</th>
        <th scope="col" rowspan=1 class="split">학번</th>
        <th scope="col" rowspan=1 colspan=1  class="split">Sub1</th>
        <th scope="col" rowspan=1 colspan=1  class="split">Sub2</th>
        <th scope="col" rowspan=1 colspan=1  class="split">Sub3</th>
        <th scope="col" rowspan=1 colspan=1  class="split">Sub4</th>
        <th scope="col" rowspan=1 colspan=1  class="split">Sub5</th>
        <th scope="col" rowspan=1 colspan=1  class="split">Ext11</th>
        <th scope="col" rowspan=1 colspan=1  class="split">Ext2</th>
        <th scope="col" rowspan=1 colspan=1  class="split">Ext3</th>
        <th scope="col" rowspan=1 colspan=1  class="split">Ext4</th>
        <th scope="col" rowspan=1 colspan=1  class="split">Ext5</th>
        </tr>
        </thead>
        <tbody>
        <?php $idx=1?>
	<?php $temp_doc0 =  str_split(  '서브인턴',4)   ?>
	<?php $temp_doc1 =  str_split( '자율선택(익스턴십)',4 )  ?>

       <?php foreach( $Check_Dic  as $SCORE):?>
        <tr >
        <td><?php echo $idx++?></td>
        <td class="hand" ><?php echo $SCORE['st_id']?></td>
        <td class="hand" >
	<?php if (  count ( $SCORE[ $temp_doc0[0]  ]['주말1차'])== 0) echo 'x' ?> 
       <?php foreach( $SCORE[ $temp_doc0[0]  ]['주말1차']  as $_SCORE):?>
	<?php if (  $_SCORE['status'] == 'a'  )  echo $_SCORE['status'].'('.$_SCORE['apply_item_content'].')';   
              elseif (  ($_SCORE['status'] == 'p') && ($_SCORE['rand'] > 0)  )  echo $_SCORE['status']; 
	      else echo 'x' ?> 
        <?php endforeach?>
	</td>

       <td class="hand" >
	<?php  if (  count ( $SCORE[ $temp_doc0[0]  ]['주말2차'])== 0) echo 'x' ?> 
       <?php foreach( $SCORE[  $temp_doc0[0] ]['주말2차']  as $_SCORE):?>
        <?php if (  ($_SCORE['status'] == 'a') && ($_SCORE['rand'] > 0)   )  echo $_SCORE['status'].'('.$_SCORE['apply_item_content'].')' ;   
        	elseif (  ($_SCORE['status'] == 'p') && ($_SCORE['rand'] > 0)   )  echo $_SCORE['status'] ;   
		 ?>
        <?php endforeach?>
        </td>
       <td class="hand" >
	<?php if (  count ( $SCORE[ $temp_doc0[0]  ]['주말3차'])== 0) echo 'x' ?> 
       <?php foreach( $SCORE[   $temp_doc0[0]  ]['주말3차']  as $_SCORE):?>
        <?php if (  ($_SCORE['status'] == 'a') && ($_SCORE['rand'] > 0)   )  echo $_SCORE['status'].'('.$_SCORE['apply_item_content'].')';   
        elseif (  ($_SCORE['status'] == 'p') && ($_SCORE['rand'] > 0)   )  echo $_SCORE['status'] ; 
	 ?>
        <?php endforeach?>
        </td>
       <td class="hand" >
	<?php if (  count ( $SCORE[ $temp_doc0[0]  ]['주말4차'])== 0) echo 'x' ?> 
       <?php foreach( $SCORE[   $temp_doc0[0]   ]['주말4차']  as $_SCORE):?>
        <?php if (  ($_SCORE['status'] == 'a') && ($_SCORE['rand'] > 0)   )  echo $_SCORE['status'].'('.$_SCORE['apply_item_content'].')'  ;  
        elseif (  ($_SCORE['status'] == 'p') && ($_SCORE['rand'] > 0)   )  echo $_SCORE['status']  ;  
	 ?>
        <?php endforeach?>
        </td>

<td class="hand" >
	<?php if (  count ( $SCORE[ $temp_doc0[0]  ]['주말5차'])== 0) echo 'x' ?> 
       <?php foreach( $SCORE[  $temp_doc0[0]  ]['주말5차']  as $_SCORE):?>
        <?php if (  ($_SCORE['status'] == 'a') && ($_SCORE['rand'] > 0)   )  echo $_SCORE['status'].'('.$_SCORE['apply_item_content'].')'?>
        <?php if (  ($_SCORE['status'] == 'p') && ($_SCORE['rand'] > 0)   )  echo $_SCORE['status']?>
        <?php endforeach?>
        </td>
        <td class="hand" >
	<?php if (  count ( $SCORE[ $temp_doc1[0]  ]['주말1차'])== 0) echo 'x' ?> 
       <?php foreach( $SCORE[ $temp_doc1[0]  ]['주말1차']  as $_SCORE):?>
        <?php if (  ($_SCORE['status'] == 'a') && ($_SCORE['rand'] > 0)   )  echo $_SCORE['status'].'('.$_SCORE['apply_item_content'].')'?>
        <?php if (  ($_SCORE['status'] == 'p') && ($_SCORE['rand'] > 0)   )  echo $_SCORE['status']?>
        <?php endforeach?>
        </td>
        <td class="hand" >
	<?php if (  count ( $SCORE[ $temp_doc1[0]  ]['주말2차'])== 0) echo 'x' ?> 
       <?php foreach( $SCORE[  $temp_doc1[0] ]['주말2차']  as $_SCORE):?>
        <?php if (  ($_SCORE['status'] == 'a') && ($_SCORE['rand'] > 0)   )  echo $_SCORE['status'].'('.$_SCORE['apply_item_content'].')'?>
        <?php if (  ($_SCORE['status'] == 'p') && ($_SCORE['rand'] > 0)   )  echo $_SCORE['status']?>
        <?php endforeach?>
        </td>
        <td class="hand" >
	<?php if (  count ( $SCORE[ $temp_doc1[0]  ]['주말3차'])== 0) echo 'x' ?> 
       <?php foreach( $SCORE[  $temp_doc1[0]  ]['주말3차']  as $_SCORE):?>
        <?php if (  ($_SCORE['status'] == 'a') && ($_SCORE['rand'] > 0)   )  echo $_SCORE['status'].'('.$_SCORE['apply_item_content'].')'?>
        <?php if (  ($_SCORE['status'] == 'p') && ($_SCORE['rand'] > 0)   )  echo $_SCORE['status']?>
        <?php endforeach?>
        </td>
        <td class="hand" >
	<?php if (  count ( $SCORE[ $temp_doc1[0]  ]['주말4차'])== 0) echo 'x' ?> 
       <?php foreach( $SCORE[  $temp_doc1[0]  ]['주말4차']  as $_SCORE):?>
        <?php if (  ($_SCORE['status'] == 'a') && ($_SCORE['rand'] > 0)   )  echo $_SCORE['status'].'('.$_SCORE['apply_item_content'].')'?>
        <?php if (  ($_SCORE['status'] == 'p') && ($_SCORE['rand'] > 0)   )  echo $_SCORE['status']?>
        <?php endforeach?>
        </td>
        <td class="hand" >
	<?php if (  count ( $SCORE[ $temp_doc1[0]  ]['주말6차'])== 0) echo 'x' ?> 
       <?php foreach( $SCORE[  $temp_doc1[0] ]['주말6차']  as $_SCORE):?>
        <?php if (  ($_SCORE['status'] == 'a') && ($_SCORE['rand'] > 0)   )  echo $_SCORE['status'].'('.$_SCORE['apply_item_content'].')'?>
        <?php if (  ($_SCORE['status'] == 'p') && ($_SCORE['rand'] > 0)   )  echo $_SCORE['status']?>
        <?php endforeach?>
        </td>

	</tr>


        <?php endforeach?>
        </tbody>

        </table>


        <table summary="통합 점수표 입니다.">
        <caption>ST summary</caption>
        <colgroup>
        <col width="10">
        <col width="70">
        <col width="70">
	<?php  for($idx=0; $idx<=5; $idx++)  :?>
        <col width="10">
	<?php endfor ?>
	<?php  for($idx=0; $idx<=11; $idx++)  :?>
        <col width="10">
	<?php endfor ?>
	<?php  for($idx=0; $idx<=3; $idx++)  :?>
        <col width="10">
	<?php endfor ?>
        <col width="10">
        </colgroup>
        <thead>

        <tr>
        <th scope="col" rowspan=3 class="split">No</th>
        <th scope="col" rowspan=3 class="split">학번</th>
        <th scope="col" rowspan=3 class="split">이름</th>
        <th scope="col" rowspan=1 colspan=3  class="split">치주</th>
        <th scope="col" rowspan=1 colspan=1  class="split">외과</th>
        <th scope="col" rowspan=1 colspan=1  class="split">영상</th>
        <th scope="col" rowspan=1 colspan=11  class="split">보존</th>
        <th scope="col" rowspan=1 colspan=3  class="split">보철</th>
        <th scope="col" rowspan=1 colspan=1  class="split">소치</th>
        </tr>
        <tr>
        <th scope="col" rowspan=2 class="split">SPT완료</th>
        <th scope="col" rowspan=2 class="split">SPT미완료</th>
        <th scope="col" rowspan=2 class="split">CU</th>
        <th scope="col" rowspan=2 class="split">발치ST</th>
        <th scope="col" rowspan=2 class="split">Peri</th>
        <th scope="col" rowspan=2 class="split">이월OP score</th>
        <th scope="col" rowspan=2 class="split">CA</th>
        <th scope="col" rowspan=2 class="split">simple</th>
        <th scope="col" rowspan=2 class="split">complex</th>
        <th scope="col" rowspan=2 class="split">diastema</th>
        <th scope="col" rowspan=2 class="split">이번학기op score</th>
        <th scope="col" rowspan=2 class="split">이번-이뤌op score</th>
        <th scope="col" rowspan=2 class="split">Endo1</th>
        <th scope="col" rowspan=2 class="split">Endo2</th>
        <th scope="col" rowspan=2 class="split">Inlay1</th>
        <th scope="col" rowspan=2 class="split">Inlay2</th>
        <th scope="col" rowspan=2 class="split">Cr1</th>
        <th scope="col" rowspan=2 class="split">Cr2</th>
        <th scope="col" rowspan=2 class="split">Cr3</th>
        <th scope="col" rowspan=2 class="split">st점수</th>
        </tr>
        <tr></tr>
        </thead>
        <tbody>
        <?php $idx=1?>
       <?php foreach($SCORE_ARRAY as $SCORE):?>

	<?php if ($SCORE['st_id'] == '2015740006' ) ; 
	elseif ( $SCORE['st_id'] == '2015740017') ;
	elseif ( $SCORE['st_id'] == '2015740023') ;
	elseif ( $SCORE['st_id'] == '2015740029') ;
	elseif ( $SCORE['st_id'] == '2015740055') ;
	elseif ( $SCORE['st_id'] == '2015740068') ;
	elseif ( $SCORE['st_id'] == '2015740076') ;
	elseif ( $SCORE['st_id'] == '2015740079') ;
	else continue?>

       <tr >
        <td><?php echo $idx++?></td>
        <td class="hand" ><?php echo $SCORE['st_id']?></td>
        <td class="hand" ><?php echo $SCORE['st_info']['name']?></td>

        <td class="category1"><?php echo $SCORE['stspt_complete']?></td>
        <td class="category1"><?php echo $SCORE['stspt_incomplete']?></td>
        <td class="category1"><?php echo $SCORE['stcu']?></td>
        <td class="category3"><?php echo $SCORE['oms_st_case']?></td>
        <td ><?php echo $SCORE['radio_taking']?></td>
        <td class="category2"><?php echo $SCORE['consv_st_op_prev_score']?></td>
        <td class="category2"><?php echo $SCORE['consv_st_op_tooth_colored_cervical']?></td>
        <td class="category2"><?php echo $SCORE['consv_st_op_tooth_colored_simple']?></td>
        <td class="category2"><?php echo $SCORE['consv_st_op_tooth_colored_complex']?></td>
        <td class="category2"><?php echo $SCORE['consv_st_op_tooth_colored_diastema']?></td>
        <td class="category2"><?php echo $SCORE['consv_st_op_score']?></td>
        <td class="category2"><?php echo $SCORE['consv_st_op_prev_cur_score']?></td>
        <td class="category2"><?php echo $SCORE['consv_st_endo_1']?></td>
        <td class="category2"><?php echo $SCORE['consv_st_endo_2']?></td>
        <td class="category2"><?php echo $SCORE['consv_st_inlay_1_proc']?></td>
        <td class="category2"><?php echo $SCORE['consv_st_inlay_2_proc']?></td>
        <td><?php echo $SCORE['pros_st_case_1']?></td>
        <td><?php echo $SCORE['pros_st_case_2']?></td>
        <td><?php echo $SCORE['pros_st_case_3']?></td>
        <td class="category1"><?php echo $SCORE['pedia_st_point']?></td>
        </tr>
        <?php endforeach?>
        </tbody>


        </table>







	<?php else:?>
	Under Construction
        <?php endif?>


</div>
