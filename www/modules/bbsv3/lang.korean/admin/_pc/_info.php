

<div id="infobox">

	<h2>모듈 기본정보</h2>
	<table>
	<tr>
		<td class="td1">모듈명</td>
		<td>:</td>
		<td class="td2"><?php echo $MD['name']?></td>
	</tr>
	<tr>
		<td class="td1">모듈아이디</td>
		<td>:</td>
		<td class="td2"><?php echo $MD['id']?></td>
	</tr>
	<tr>
		<td class="td1">모듈의위치</td>
		<td>:</td>
		<td class="td2"><?php echo $g['path_module'].$module?>/</td>
	</tr>
	<tr>
		<td class="td1">테이블생성</td>
		<td>:</td>
		<td class="td2">
			<?php if($MD['tblnum']):?>
			<?php echo $MD['tblnum']?>개
			<?php else:?>
			없음
			<?php endif?>
		</td>
	</tr>
	<tr>
		<td class="td1">모듈등록일</td>
		<td>:</td>
		<td class="td2">
			<?php echo getDateFormat($MD['d_regis'],'Y/m/d')?>
		</td>
	</tr>
	<tr>
		<td class="td1">버젼</td>
		<td>:</td>
		<td class="td2">
			1.2
		</td>
	</tr>
	<tr>
		<td class="td1">최근업데이트</td>
		<td>:</td>
		<td class="td2">
			2013.09.06
		</td>
	</tr>
	</table>



	<h2>제작사 정보</h2>
	<table>
	<tr>
		<td class="td1">제작사</td>
		<td>:</td>
		<td class="td2">오픈씨엠에스</td>
	</tr>
	<tr>
		<td class="td1">회원아이디</td>
		<td>:</td>
		<td class="td2">하루종일(pco7333)</td>
	</tr>
	<tr>
		<td class="td1">이메일</td>
		<td>:</td>
		<td class="td2"><a href="mailto:admin@kimsq.com">home04@gmail.com</a></td>
	</tr>
	<tr>
		<td class="td1">홈페이지</td>
		<td>:</td>
		<td class="td2">
			<a href="http://www.opencms.co.kr" target="_blank">www.opencms.co.kr</a>
		</td>
	</tr>
	<tr>
		<td class="td1">라이센스</td>
		<td>:</td>
		<td class="td2">
			RBL
		</td>
	</tr>
	</table>



</div>