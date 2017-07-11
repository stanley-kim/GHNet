<style>
	table{width:100%;}
	.khusd_st .my_follow thead th{background: #FDF5E6;border-bottom:1px solid #efefef;}
	h3{color:blue;}
	#searchFollow {padding-left:10px;}
	h4{margin-bottom:5px;}
	.pt_info span{margin-right:20px;}
	.add_follow_table td{height:24px;}
	.add_follow_table tr td:first-child{background: #F4F4F4;}
	
	#pros_follow select{height:24px;}
    
    #add_follow.khusd_st  .add_follow td{text-align:left; padding-left:20px;}
    
    #follow_list tbody td{color:#232323;}
    #follow_list tbody tr{ background-color:rgb(250,250,250);}
    #follow_list tbody tr.follow_name td{border-top:2px solid #cdcdcd;background-color:rgb(245,250,250);}
    #follow_list thead th{background:rgb(255,255,255); padding:10px 0;}
	.add_follow tbody tr td:first-child{background:rgb(245,250,250); padding:5px 0;}
</style>

<script type="text/javascript">
    function emptyForm() {
        $("input[type=text]").val("");
    }
    
    function changeFollowStatus(uid){
        var stage = '';
        $("#stage_"+uid).find("input[type=num]").each(function(){
            var val = $(this).val();
            if (val == undefined) {
                val = 0;
            }
            stage += val+","; 
        });
        
        //console.log(stage);

    	location.href = "<?php echo $g['khusd_st_pros_new_change_follow']?>"+uid+"&option="+$("#status_"+uid).val()+"&stage="+stage;
    }
    
function applierListWindow(url)
{
	window.open(url, '', 'left=0, top=0, width=700px height=600px, statusbar=no, scrollbars=yes, toolbar=yes');
    return false;
}

function find_pt_name() {
	var url = "<?=$g['khusd_st_pros_new_search_follow']?>&pt_name="+$("#pt_name").val();
	applierListWindow(url);
}
function find_pt_id(id) {
	var url = "<?=$g['khusd_st_pros_new_search_follow']?>&pt_id="+id;
	if (id == '') {
		url = "<?=$g['khusd_st_pros_new_search_follow']?>&pt_id="+$("#pt_id").val();
    }
	applierListWindow(url);
}


</script>


<div id="pros_follow" class="khusd_st follow pros">

<h2>보철과 F/U 환자 관리</h2>
	<h3>&#8226;팔로우 등록</h3>
    
<div id="add_follow" class="khusd_st update pros">
    <form name="addFollow" method="post" action="<?php echo $g['s']?>/" target="_action_frame_<?php echo $m?>" onsubmit="return updateCheck(this);">
	<input type="hidden" name="r" value="<?php echo $r?>" />
	<input type="hidden" name="a" value="new_add_follow" />
	<input type="hidden" name="c" value="<?php echo $c?>" />
	<input type="hidden" name="m" value="<?php echo $m?>" />
    
    <table class="add_follow my_follow">
    <tbody>
        <tr>
            <td class="head" style="width:100px;">환자명</td>
			<td>
                <input type="text" id="pt_name" name="pt_name" maxlength="10" class="input" value="" style="text-align:center;" />
                <a href="#" onclick="find_pt_name();return false;" style="margin-left:20px; text-decoration:underline; color:blue;">검색하기</a>
            </td>
		</tr>
		<tr>
            <td class="head"style="width:100px;">병록번호</td>
			<td>
                <input type="text" id="pt_id" name="pt_id" maxlength="10" class="input" value="" style="text-align:center;" />
                <a href="#" onclick="find_pt_id('');return false;" style="margin-left:20px; text-decoration:underline; color:blue;">검색하기</a>
            </td>
        </tr>
        <tr>
            <td class="head">종류</td>
			<td>
						<select name="follow_type" class="input">
                            <option value=0>선택</option>
							<?php foreach( $d['khusd_st_pros']['TYPES'] as $type ):?>
							<option value="<?php echo $type['id'];?>"><?php echo $type['name'];?></option>
							<?php endforeach?>
						</select>
            </td>
		</tr>
        <tr>
            <td class="head"style="width:100px;">담당의</td>
			<td>
                <input type="text" name="dr_name" maxlength="10" class="input" value="" style="text-align:center;" />
            </td>
        </tr>
    </tbody>
</table>
        <div class="bottombox" style="border:none; margin:0; padding:0;">
		<input type="button" value="취소" class="btngray" onclick="emptyForm();">
		<input type="submit" value="등록" class="btnblue">
	</div>
    </div>

	<h3>&#8226;나의 팔로우 현황</h3>
	<?php if($MY_FOLLOW_ARRAY && is_array($MY_FOLLOW_ARRAY) && count($MY_FOLLOW_ARRAY) > 0):?>
	<div id="follow_list">
		<table class="my_follow update">
			<thead>
				<tr>
					<th>환자</th>
					<th>종류</th>
					<th>담당의</th>
					<th>팔로우 상태</th>
					<th>변경</th>
				</tr>
			</thead>
			<tbody>
				<?php $idx = 1; $follow_total = 0;?>
				<?php foreach($MY_FOLLOW_ARRAY as $MY_FOLLOW):?>
				<tr class="follow_name">
					<?php $idx++;?>
					<td><a href="#" onclick="find_pt_id('<?=$MY_FOLLOW['pt_id']?>');return false;" ><?php echo $MY_FOLLOW['pt_name']?></a><br /><a href="#" onclick="find_pt_id('<?=$MY_FOLLOW['pt_id']?>');return false;" ><?php echo $MY_FOLLOW['pt_id']?></a></td>
					<td>
					<?php foreach( $d['khusd_st_pros']['TYPES'] as $type ):?>
							<?php if( $MY_FOLLOW['type'] == $type['id']):?>
							<?php echo $type["name"];?>
							<?php endif?>
					<?php endforeach?>
					</td>
					<td><?php echo $MY_FOLLOW['dr_name']?></td>
					<td>
							<?php if($MY_FOLLOW['status'] == $d['khusd_st_pros']['FOLLOW_STATUS']['FOLLOWING']) echo '팔로우';?>
							<?php if($MY_FOLLOW['status'] == $d['khusd_st_pros']['FOLLOW_STATUS']['COMPLETE']) echo '완료';?>
					</td>
					<td>
						<select name="follow_status" class="input" id="status_<?=$MY_FOLLOW['fcuid']?>">
                            <option value="<?php echo $d['khusd_st_pros']['FOLLOW_STATUS']['FOLLOWING'];?>" <?php if($MY_FOLLOW['status'] == $d['khusd_st_pros']['FOLLOW_STATUS']['FOLLOWING']) echo 'selected';?>>팔로우</option>
                            <option value="<?php echo $d['khusd_st_pros']['FOLLOW_STATUS']['COMPLETE'];?>"  <?php if($MY_FOLLOW['status'] == $d['khusd_st_pros']['FOLLOW_STATUS']['COMPLETE']) echo 'selected';?>>완료</option>
                            <option value="<?php echo $d['khusd_st_pros']['FOLLOW_STATUS']['DROP'];?>"  <?php if($MY_FOLLOW['status'] == $d['khusd_st_pros']['FOLLOW_STATUS']['DROP']) echo 'selected';?>>삭제</option>
						</select>
					</td>
				</tr>
                <tr style="background:rgb(254,254,254);" id="stage_<?=$MY_FOLLOW['fcuid']?>">
                    <td colspan=8 style="">
                        <?php
                            $total = 0;
                            $f_type = $MY_FOLLOW['type'];
                            if( $MY_FOLLOW['type'] == "2ndCr" || $MY_FOLLOW['type'] == "bridge"){
                                $f_type = "single";
                            }
                            $t_idx = -1;
                            
                            $my_stage = explode(",",$MY_FOLLOW['stage']);
                            if($MY_FOLLOW['stage'] == ''){
                                $my_stage = array();
                            }
                            
                            $stage = count( $d['khusd_st_pros'][$f_type] );
                            
                            $score = array();
                            for($i=0; $i< $stage; $i++){
                                if($i < count($my_stage)){
                                    array_push( $score, $my_stage[$i]);
                                }else{
                                    array_push( $score, 0);
                                }
                            }
                            
                        ?>
                		<?php foreach( $d['khusd_st_pros'][$f_type] as $type ):?>
							<?php $t_idx++; $total+=$type["score"]*$score[$t_idx]; ?>
                            <div style="width:50%; float:left; text-align:right; padding-bottom: 10px;">
                                <b style="color:#909090; font-weight:normal;"><?=$type["name"];?></b>
                                <input type="num" name="<?=$t_idx?>" maxlength="2" class="input num" value="<?=$score[$t_idx]?>" style="text-align:center;" /> 회
                            </div>
                    	<?php endforeach?>
                        
                    </td>
                </tr>
                <tr style="background:rgb(250,250,250);" id="stage_<?=$MY_FOLLOW['fcuid']?>">
                    <td colspan=8 style="text-align:right; padding-right:20px;color:gray;">
                        <?php $follow_total+=$total;?>
                        <b>점수</b> <?=$total?><b>점</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<span class="btn00"><a href="#" style="text-align:center;background-color:#3399DD;font-weight:bold;width:40px;color:white;"onclick="changeFollowStatus('<?php echo $MY_FOLLOW["fcuid"];?>');">업데이트</a></span>

                    </td>
                </tr>
                
				<?php endforeach?>
                <tr style="background:white;" id="stage_<?=$MY_FOLLOW['fcuid']?>">
                    <td colspan=8 style="text-align:right; padding-right:20px;color:black;border-top:2px solid #cdcdcd;padding:10px 20px;font-size:15px;">
                        <b>총 점수</b> <font style="color:blue"><?=$follow_total?></font><b>점</b>
                    </td>
                </tr>
                
			</tbody>
		</table>
	</div>
	<?php endif?>