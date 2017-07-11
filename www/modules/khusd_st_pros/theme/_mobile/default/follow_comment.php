<style>
	table{width:100%;}
	.khusd_st .my_follow thead th{background: #FDF5E6;}
	h3{color:blue;}
	#searchFollow {padding-left:10px;}
	h4{margin-bottom:5px;}
	.pt_info span{margin-right:20px;}
	.add_follow_table td{height:24px;}
	.add_follow_table tr td:first-child{background: #F4F4F4;}
	
	#pros_follow select{height:24px;}
	#pros_follow_comment{margin-bottom:20px;}
    #pros_follow_comment input[type=text]{width:64px;}
    #pros_follow_comment form span{font-weight:bold; margin-right:10px;}
    #pros_follow_comment p {line-height: 30px;}
    
	tr.pt_row{background: #fffff4;}

</style>
<script type="text/javascript">
    function emptyForm() {
        $("input[type=text]").val("");
    }
    
</script>
<div id="pros_follow_comment" class="khusd_st follow pros">

<h2>보철과 F/U 환자 포기/취소 사유</h2>
<h3>&#8226;팔로우 포기/취소 입력</h3>
<div>
    <form name="commentFollow" method="post" action="<?php echo $g['s']?>/" target="_action_frame_<?php echo $m?>" onsubmit="return updateCheck(this);">
	<input type="hidden" name="r" value="<?php echo $r?>" />
	<input type="hidden" name="a" value="update_comment" />
	<input type="hidden" name="c" value="<?php echo $c?>" />
	<input type="hidden" name="m" value="<?php echo $m?>" />
    <p>
	<span>
		종류:
		<select name="follow_type">
			<?php foreach( $d['khusd_st_pros']['TYPES'] as $type ):?>
			<option value="<?php echo $type['id'];?>"><?php echo $type['name'];?></option>
			<?php endforeach?>
		</select>
	</span><br/>
    <span>환자 이름: <input name='pt_name' type='text' /></span>
    <span>병록 번호: <input name='pt_id' type='text' /></span>

	<br/>
    <span>사유: 
        <select name='status'>
            <option value='g'>포기</option>
            <option value='c'>취소</option>
        </select>
        <input name='comment' type='text' style="width:65%"/>
    </span><br />
    <span>
    <input style="margin-left:0" type="button" value="취소" class="btngray" onclick="emptyForm();" />
    <input type="submit" value="입력" class="btnblue" />
    </span>
    </p>
    </form>
</div>
<br />
<h3>&#8226;팔로우 포기/취소 댓글 리스트</h3>
<div id="pros_history" class="khusd_st list pros">

	<table>
	<thead>
	<tr>
        <th>#</th>
        <th>이름</th>
        <th>학번</th>
        <th>환자명</th>
        <th>병록번호</th>
        <th>종류</th>
        <th>상태</th>
	</tr>
	</thead>
	<tbody>
	<?php $idx = 1?>
	<?php if(is_array($SCORE_ARRAY)) {?>
	<?php foreach($SCORE_ARRAY as $SCORE):?>
        <tr class='pt_row'>
            <td><?=$SCORE['index']?></td>
            <td><?=$SCORE['name']?></td>
            <td><?=$SCORE['id']?></td>
            <td><a href="<?php echo $g['khusd_st_pros_search_follow'].$SCORE['pt_id']?>"><?=$SCORE['pt_name']?></a></td>
            <td><a href="<?php echo $g['khusd_st_pros_search_follow'].$SCORE['pt_id']?>"><?=$SCORE['pt_id']?></a></td>
			<td>
				<?php foreach( $d['khusd_st_pros']['TYPES'] as $type ):?>
					<?php if( $SCORE['type'] == $type['id']):?>
					<?php echo $type["name"];?>
					<?php endif?>
				<?php endforeach?>
			</td>
            <td>
				<?php foreach( $d['khusd_st_pros']['STATUS_OPTIONS'] as $type ):?>
				<?php if( $SCORE['status'] == $type['id']):?>
					<?php echo $type["name"];?>
				<?php endif?>
				<?php endforeach?>
			</td>
        </tr>
        <tr>
            <td></td>
            <td colspan=6 style="text-align:left;padding:5px;">
            <?=$SCORE['comment']?>
            <br /><?php echo getDateFormat($SCORE['date_update'],"Y-m-d H:i")?></td>
        </tr>
	<?php endforeach?>
	<?php }?>
    </tbody>
	</table>
	<div class="bottom">
		<div class="btnbox1">
		</div>
		<div class="btnbox2"></div>
		<div class="clear"></div>
		<div class="pagebox01">
			<?php
				$g['pagelink'] = $g['khusd_st_'.$DEPARTMENT.'_list'].'&amp;mode=follow_comment&amp;st_id=';
				echo getPageLink($d['theme']['pagenum'],$p,$TPG,$g['img_core'].'/page/default');
			?>
		</div>
	</div>

</div>
</div>