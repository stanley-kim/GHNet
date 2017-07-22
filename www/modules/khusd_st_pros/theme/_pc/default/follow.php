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
</style>

<script type="text/javascript">
function changeFollowStatus(uid){
	location.href = "<?php echo $g['khusd_st_pros_change_follow']?>"+uid+"&option="+$("#status_"+uid).val();
}	

function changeFollowStatus2(uid, _option){
        location.href = "<?php echo $g['khusd_st_pros_change_follow']?>"+uid+"&option="+_option;
}

	
</script>

<div id="pros_follow" class="khusd_st follow pros">

<h2>보철과 F/U 환자 관리</h2>
	<h3>&#8226;나의 팔로우 현황</h3>
	<?php if($MY_FOLLOW_ARRAY && is_array($MY_FOLLOW_ARRAY) && count($MY_FOLLOW_ARRAY) > 0):?>
	<div id="follow_list">
		<table class="my_follow">
			<thead>
				<tr>
					<th>번호</th>
					<th>환자명</th>
					<th>병록번호</th>
					<th>종류</th>
					<th>담당의</th>
					<th>업데이트</th>
					<th>팔로우 상태</th>
					<th>변경</th>
				</tr>
			</thead>
			<tbody>
				<?php $idx = 1?>
				<?php foreach($MY_FOLLOW_ARRAY as $MY_FOLLOW):?>
				<tr>
					<td><?php echo $idx++?></td>
					<td><a href="<?php echo $g['khusd_st_pros_search_follow'].$MY_FOLLOW['pt_id']?>"><?php echo $MY_FOLLOW['pt_name']?></a></td>
					<td><a href="<?php echo $g['khusd_st_pros_search_follow'].$MY_FOLLOW['pt_id']?>"><?php echo $MY_FOLLOW['pt_id']?></a></td>
					<td>
					<?php foreach( $d['khusd_st_pros']['TYPES'] as $type ):?>
							<?php if( $MY_FOLLOW['type'] == $type['id']):?>
							<?php echo $type["name"];?>
							<?php endif?>
					<?php endforeach?>
					</td>
					<td><?php echo $MY_FOLLOW['dr_name']?></td>
					<td><?php echo getDateFormat($MY_FOLLOW['date_update'], 'Y-m-d H:i')?></td>
					<td>
						<?php foreach( $d['khusd_st_pros']['STATUS_OPTIONS'] as $type ):?>
							<?php if( $MY_FOLLOW['status'] == $type['id']):?>
							<?php echo $type["name"];?>
							<?php endif?>
						<?php endforeach?>
					</td>
					<td>

<span class="btn02"><a href="#" onclick="changeFollowStatus2('<?php echo $MY_FOLLOW["uid"];?>', 'f'  );">팔로우</a></span>
<span class="btn00"><a href="#" onclick="changeFollowStatus2('<?php echo $MY_FOLLOW["uid"];?>', 'g'  );">포기</a></span>
<span class="btn00"><a href="#" onclick="changeFollowStatus2('<?php echo $MY_FOLLOW["uid"];?>', 'c'  );">취소</a></span>
<span class="btn01"><a href="#" onclick="changeFollowStatus2('<?php echo $MY_FOLLOW["uid"];?>', 'e'  );">완료</a></span>

						<!--
						<?php if($MY_FOLLOW['status'] != $d['khusd_st_pros']['FOLLOW_STATUS']['DROP']):?>
						<span class="btn00"><a href="<?php echo $g['khusd_st_pros_drop_follow'].$MY_FOLLOW['uid']?>">포기하기</a></span>
						<?php endif?>
						-->
					</td>
				</tr>
				<?php endforeach?>
			</tbody>
		</table>
	</div>
	<?php endif?>

	<h3>&#8226;팔로우 환자 검색</h3>

	<form name="searchFollow" method="get" action="<?php echo $g['s']?>/" onsubmit="return updateCheck(this);">
	<input type="hidden" name="r" value="<?php echo $r?>" />
	<input type="hidden" name="c" value="<?php echo $c?>" />
	<input type="hidden" name="m" value="<?php echo $m?>" />
	<input type="hidden" name="mode" value="follow" />
	
	<div id="searchFollow">
		환자명 혹은 병록번호 : <input type="text" name="nameOrId" maxlength="20" class="input" value="<?php echo $nameOrId?>">
		<input type="submit" value="검색" class="btnblue" />
	</div>
	</form>
	
	<div id="followList">
		<?php if(isset($nameOrId) && $nameOrId):?>
		<h4 style="line-height:20px; color:blue"><?php echo $nameOrId?> 님에 대한 검색 결과 : </h4>
		<?php endif?>
			<?php if($FOLLOW_ARRAY):?>
			<p style="line-height:20px;">동명 이인이 검색된 경우, 병록번호로 검색하여 팔로 환자를 추가하세요.</p>

			<div class="pt_info">
			<span id="pt_name"><b>이름:</b> <?php echo $FOLLOW_PT['pt_name']?></span>
			<span id="pt_id"><b>병록번호:</b> <?php echo $FOLLOW_PT['pt_id']?></span>
			<span id="status">
				<b>상태:</b> 
				<?php if($FOLLOW_PT['status'] == $d['khusd_st_pros']['FOLLOW_PT']['FOLLOWING']):?>
				팔로 있음
				<?php else:?>
				팔로 없음!!!
				<?php endif?>
			</span>
			</div>

				<table>
				<thead>
					<tr>
						<th>번호</th>
						<th>학번</th>
						<th>이름</th>
						<th>종류</th>
						<th>담당의</th>
						<th>업데이트</th>
						<th>팔로우 상태</th>
						<th>비고</th>
					</tr>
				</thead>
				
				<tbody>
					<?php $idx = 1?>
					<?php foreach($FOLLOW_ARRAY as $FOLLOW):?>
					<tr>
						<td><?php echo $idx++?></td>
						<td><?php echo $FOLLOW['st_id']?></td>
						<td><?php echo $FOLLOW['st_name']?></td>
						<td>
						<?php foreach( $d['khusd_st_pros']['TYPES'] as $type ):?>
							<?php if( $FOLLOW['type'] == $type['id']):?>
							<?php echo $type["name"];?>
							<?php endif?>
					<?php endforeach?>
						</td>
						<td><?php echo $FOLLOW['dr_name']?></td>
						<td><?php echo getDateFormat($FOLLOW['date_update'], 'Y-m-d H:i')?></td>
						<td>
							<?php foreach( $d['khusd_st_pros']['STATUS_OPTIONS'] as $type ):?>
								<?php if( $FOLLOW['status'] == $type['id']):?>
								<?php echo $type["name"];?>
								<?php endif?>
							<?php endforeach?>

						</td>
						<td></td>
					</tr>
					<?php endforeach?>
				</tbody>
				</table>
			<?php endif?>

		
		<?php if(isset($nameOrId) && $nameOrId && $nameOrId != '' && !$FOLLOW_PT):?>
			해당 환자는 F/U 목록에 없습니다. 등록하시겠습니까?
			<form name="addFollow" method="post" action="<?php echo $g['s']?>/" target="_action_frame_<?php echo $m?>" onsubmit="return updateCheck(this);">
			<input type="hidden" name="r" value="<?php echo $r?>" />
			<input type="hidden" name="a" value="add_follow" />
			<input type="hidden" name="c" value="<?php echo $c?>" />
			<input type="hidden" name="m" value="<?php echo $m?>" />
			
			<input type="hidden" name="st_id" value="<?php echo $my['id']?>" />
			
			<table  class="add_follow_table">
				<tr>
					<td>환자명</td>
					<td>
						<input type="text" name="pt_name"  class="input" value="<?php echo $nameOrId?>" />
					</td>
				</tr>
				<tr>
					<td>병록번호</td>
					<td>
						<input type="text" name="pt_id" class="input" value="<?php echo $nameOrId?>" />
					</td>
				</tr>
				<tr>
					<td>종류</td>
					<td id="select">
						<select name="follow_type" class="input">
							<?php foreach( $d['khusd_st_pros']['TYPES'] as $type ):?>
							<option value="<?php echo $type['id'];?>"><?php echo $type['name'];?></option>
							<?php endforeach?>
						</select>
					</td>
				</tr>
				<tr>
					<td>담당의</td>
					<td>
						<input type="text" name="dr_name" class="input" />
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>
						<input type="submit" value="등록" class="btnblue" />
					</td>
				</tr>
			</table>
			</form>
		<?php elseif($FOLLOW_PT):?>
			<?php if(!$ABLE_FOLLOW):?>
			<form name="editFollowPt" method="post" action="<?php echo $g['s']?>/" target="_action_frame_<?php echo $m?>" onsubmit="return updateCheck(this);">
			<input type="hidden" name="r" value="<?php echo $r?>" />
			<input type="hidden" name="a" value="edit_follow" />
			<input type="hidden" name="c" value="<?php echo $c?>" />
			<input type="hidden" name="m" value="<?php echo $m?>" />
			
			<input type="hidden" name="st_id" value="<?php echo $my['id']?>" />
			<input type="hidden" name="pt_uid" value="<?php echo $FOLLOW_PT['uid']?>" />
			<input type="hidden" name="pt_id" value="<?php echo $FOLLOW_PT['pt_id']?>" />
			<?php endif?>
			<table  class="add_follow_table">
				<tr>
					<td>환자명</td>
					<td>
						<?php if(!$ABLE_FOLLOW):?>
						<input type="text" name="pt_name" value="<?php echo $FOLLOW_PT['pt_name']?>" />
						<?php else:?>
						<?php echo $FOLLOW_PT['pt_name']?>
						<?php endif?>
					</td>
				</tr>
				<tr>
					<td>병록번호</td>
					<td>
						<?php echo $FOLLOW_PT['pt_id']?>
					</td>
				</tr>
				<tr>
					<td>종류</td>
					<td id="select">
						<select name="follow_type" class="input">
							<?php foreach( $d['khusd_st_pros']['TYPES'] as $type ):?>
							<option value="<?php echo $type['id'];?>"><?php echo $type['name'];?></option>
							<?php endforeach?>
						</select>
					</td>
				</tr>
				<tr>
					<td>담당의</td>
					<td>
						<input type="text" name="dr_name" value="<?php echo $FOLLOW_PT['dr_name']?>" />
					</td>
				</tr>
				<?php if(!$ABLE_FOLLOW):?>
				<tr>
					<td>&nbsp;</td>
					<td>
						<input type="submit" value="수정" class="btnblue" />
					</td>
				</tr>
				<?php else:?>
				<form name="addFollow" method="post" action="<?php echo $g['s']?>/" target="_action_frame_<?php echo $m?>" onsubmit="return updateCheck(this);">
				<tr>
					<input type="hidden" name="r" value="<?php echo $r?>" />
					<input type="hidden" name="a" value="add_follow" />
					<input type="hidden" name="c" value="<?php echo $c?>" />
					<input type="hidden" name="m" value="<?php echo $m?>" />
					
					<input type="hidden" name="st_id" value="<?php echo $my['id']?>" />
					<input type="hidden" name="pt_name"  class="input" value="<?php echo $FOLLOW_PT['pt_name']?>" />
					<input type="hidden" name="pt_id" class="input" value="<?php echo $FOLLOW_PT['pt_id']?>" />		
					<input type="hidden" name="dr_name" class="input" value="<?php echo $FOLLOW_PT['dr_name']?>" />
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>
						<input type="submit" value="팔로우 추가" class="btnblue" />
					</td>
				</tr>
				</form>
				<?php endif?>
			</table>
			<?php if(!$ABLE_FOLLOW):?>
			</form>
			<?php endif?>
		
		<?php endif?>
	</div>

</div>
