<?php include_once $g['path_module'].$module.'/var/var.join.php'?>


<div id="configbox">

	<form name="procForm" action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>" onsubmit="return saveCheck(this);">
	<input type="hidden" name="r" value="<?php echo $r?>" />
	<input type="hidden" name="m" value="<?php echo $module?>" />
	<input type="hidden" name="a" value="member_config" />
	<input type="hidden" name="_join_menu" value="<?php echo $_SESSION['_join_menu']?$_SESSION['_join_menu']:1?>" />


	<div class="tab">
		<ul>
		<li id="tbox1" class="leftside selected" onclick="confShow(1);">초기 설정</li>
		<li id="tbox2" onclick="confShow(2);">학생 아이디 생성</li>
		<li id="tbox3" onclick="confShow(3);">가입항목 추가</li>
		<li id="tbox4" onclick="confShow(4);">로그인/MYPAGE</li>
		<li id="tbox5" onclick="confShow(5);">약관/안내메세지</li>
		</ul>
	</div>
	<div class="agreebox">
		<div id="tarea1">


			<table>
				<tr>
					<td class="td1"><span>가입시 학생 그룹</span></td>
					<td class="td2">
						<select name="join_group" class="select1">
						<?php $_SOSOK=getDbArray($table['s_mbrgroup'],'','*','gid','asc',0,1)?>
						<?php while($_S=db_fetch_array($_SOSOK)):?>
						<option value="<?php echo $_S['uid']?>"<?php if($_S['uid']==$d['khusd_st_member']['join_group']):?> selected="selected"<?php endif?>>ㆍ<?php echo $_S['name']?>(<?php echo number_format($_S['num'])?>)</option>
						<?php endwhile?>
						</select>
					</td>
					<td class="td1"><span>원내생 그룹</span></td>
					<td class="td2">
						<select name="st_group" class="select1">
						<?php $_SOSOK=getDbArray($table['s_mbrgroup'],'','*','gid','asc',0,1)?>
						<?php while($_S=db_fetch_array($_SOSOK)):?>
						<option value="<?php echo $_S['uid']?>"<?php if($_S['uid']==$d['khusd_st_member']['st_group']):?> selected="selected"<?php endif?>>ㆍ<?php echo $_S['name']?>(<?php echo number_format($_S['num'])?>)</option>
						<?php endwhile?>
						</select>
					</td>
				</tr>
				<tr>
					<td class="td1"><span>원내생 레벨</span></td>
					<td class="td2">
						<select name="st_level" class="select1">
						<?php $_LEVEL=getDbArray($table['s_mbrlevel'],'','*','uid','asc',0,1)?>
						<?php while($_L=db_fetch_array($_LEVEL)):?>
						<option value="<?php echo $_L['uid']?>"<?php if($_L['uid']==$d['khusd_st_member']['st_level']):?> selected="selected"<?php endif?>>ㆍ<?php echo $_L['name']?>(<?php echo number_format($_L['num'])?>)</option>
						<?php if($_L['gid'])break; endwhile?>
						</select>
					</td>

					<td class="td1"><span>총대단 레벨</span></td>
					<td class="td2">
						<select name="delegation_level" class="select1">
						<?php $_LEVEL=getDbArray($table['s_mbrlevel'],'','*','uid','asc',0,1)?>
						<?php while($_L=db_fetch_array($_LEVEL)):?>
						<option value="<?php echo $_L['uid']?>"<?php if($_L['uid']==$d['khusd_st_member']['delegation_level']):?> selected="selected"<?php endif?>>ㆍ<?php echo $_L['name']?>(<?php echo number_format($_L['num'])?>)</option>
						<?php if($_L['gid'])break; endwhile?>
						</select>
					</td>
				</tr>
			</table>


		</div>
		<div id="tarea2" class="hide">
		


			<table>
				<tr>
					<td class="td1"><span>소속될 학기 그룹</span></td>
					<td class="td2" colspan=3>
						<select name="s_uid">
						<?php foreach($SEMESTERS_ARRAY as $_S):?>
							<option value="<?php echo $_S['uid']?>"<?php if($s_uid == $_S['uid']):?> selected<?php endif?>><?php echo $_S['description']?></option>
						<?php endforeach?>
						</select>
					</td>
				</tr>
				<tr>
					<td class="td1"><span>학번 prefix</span></td>
					<td class="td2" colspan=3>
						<input type="text" name="st_id_prefix" value="<?php echo $d['khusd_st_member']['st_id_prefix']?>" size="10" class="input" /> (예: 20117400)
					</td>
				</tr>
				<tr>
					<td class="td1"><span>출석번호, 이름 및 이메일 주소</span></td>
					<td class="td2" colspan=3>
						<textarea name="num_name_email_list" class="num_name_email_list"></textarea> <p>출석번호, 이름, 이메일주소를 공백/탭으로 구분하여 한 줄에 한명씩 입력하시오.</p>
					</td>
				</tr>
				<tr>
					<td class="td1"><span>타학번 원내생 정보</span></td>
					<td class="td2" colspan=3>
						<textarea name="other_num_name_email_list" class="num_name_email_list"></textarea> <p>학번(예:2011740021), 이름, 이메일주소를 공백/탭으로 구분하여 한 줄에 한명씩 입력하시오. </p>
					</td>
				</tr>
				<tr>
					<td class="td1"</td>
					<td class="td2"></td>
					<td class="td1"></td>
					<td class="td2"></td>
				</tr>
			</table>



		</div>
		<div id="tarea3" class="hide">
			
		</div>
		<div id="tarea4" class="hide">
		
		</div>
		<div id="tarea5" class="hide">
		
		</div>
	</div>


	<div class="submitbox">
		<input type="submit" class="btnblue" value=" 확인 " />
	</div>
	</form>

</div>
















<script type="text/javascript">
//<![CDATA[
function confShow(n)
{
	var i;

	for (i = 1; i < 6; i++)
	{
		getId('tbox'+i).style.borderBottom = '#dfdfdf solid 1px';
		getId('tbox'+i).style.background = '#f9f9f9';
		getId('tbox'+i).style.color = '#000000';
		getId('tarea'+i).style.display = 'none';
	}
	getId('tbox'+n).style.borderBottom = '#ffffff solid 1px';
	getId('tbox'+n).style.background = '#ffffff';
	getId('tbox'+n).style.color = '#FF5B01';
	getId('tarea'+n).style.display = 'block';

	document.procForm._join_menu.value = n;
}
function saveCheck(f)
{
	return confirm('정말로 실행하시겠습니까?');
}
confShow(parseInt(document.procForm._join_menu.value));
//]]>
</script>