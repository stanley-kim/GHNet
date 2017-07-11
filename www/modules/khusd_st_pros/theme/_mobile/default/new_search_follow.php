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
    
    #follow_list tbody td{color:#232323; padding:20px 0;}
    #follow_list thead th{background:rgb(250,250,250); padding:20px 0;}
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
</script>


<div id="pros_follow" class="khusd_st follow pros" style="padding:10px;">
    <h3>&#8226;'<?=$pt_id?><?=$pt_name?>'에 대한 검색 결과</h3>
	<div id="follow_list">
		<table class="my_follow update">
			<thead>
				<tr>
					<th>이름</th>
					<th>환자</th>
					<th>종류</th>
					<th>담당의</th>
					<th>팔로우 상태</th>
				</tr>
			</thead>
			<tbody>
				<?php $idx = 1; $follow_total = 0;?>
				<?php foreach($FOLLOW_ARRAY as $MY_FOLLOW):?>
				<tr class="follow_name">
					<td><?php echo $MY_FOLLOW['st_id']?><br /><?php echo $MY_FOLLOW['name']?></td>
					<td><?php echo $MY_FOLLOW['pt_id']?><br /><?php echo $MY_FOLLOW['pt_name']?></td>
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
				</tr>
                <?php endforeach?>
            </tbody>
        </table>
<div style="text-align:center;">
<span class="btn00"><a href="#" onclick="window.close();">닫기</a></span>
</div>
</div>
