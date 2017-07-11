
<script type="text/javascript">
    function changeStage(f_type){
        var stage = '';
        $("#stage_"+f_type).find("input[type=num]").each(function(){
            var val = $(this).val();
            if (val == undefined) {
                val = 0;
            }
            stage += val+","; 
        });
        
        //console.log(stage);

    	location.href = "<?php echo $g['khusd_st_pros_obser_score']?>"+"&type="+f_type+"&stage="+stage+"&st_id="+$("#st_id").val();
    }
	function findSt_ID(){
		
		location.href = "http://kd45th.kimsq.co.kr/?c=17/77&st_id="+$("#st_id").val();
	}
</script>
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
    #follow_list tbody tr.follow_name td{border-top:2px solid #cdcdcd;background-color:rgb(245,250,250); height:32px;}
    #follow_list thead th{background:rgb(255,255,255); padding:10px 0;}

	.stid_div{padding:0 0 20px 0;}
	.stid_div a{text-decoration:underline; margin-left:10px; color:blue}
</style>
<?php if(!$st_id):?>
<div class="stid_div">
	<b>학번 입력: </b><input type="text" name="st_id" id="st_id"/> <a href="#" onClick="findSt_ID();">검색</a>
	</div>
<?php else:?>
<div class="stid_div">
	<b>학번 입력: </b><input type="text" name="st_id" id="st_id" value="<?=$st_id?>"/> <a href="#" onClick="findSt_ID();">검색</a>
	</div>
		<div id="follow_list">
		<table class="my_follow update" border=0 spacing=0>
			<tbody>
				<?php $idx = 1; $follow_total = 0;?>
				<?php foreach( $d['khusd_st_pros']['OBSER_TYPES'] as $f_types ):?>
				<?php $f_type = $f_types['id']; ?>
				<tr class="follow_name">
					<td style="padding-left:15px;font-weight:bold"><?php $idx++; echo $f_types['name']?>
					<span style="float:right;margin-right:15px;" class="btn00"><a href="#" style="background-color:#3399DD;font-weight:bold;color:white;"onclick="changeStage('<?php echo $f_type;?>');">저장</a></span>
					</td>

				</tr>
                <tr style="background:rgb(254,254,254);" id="stage_<?=$f_type?>">
                    <td colspan=8 style="">
                        <?php
							$my_stage = explode(",",$MY_ARRAY['stage_'.$f_types['id']]);
                            $total = 0;
                            $t_idx = -1;
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
                            <div style="width:25%; float:left; text-align:center; padding-bottom: 10px;">
                                <b style="color:#909090; font-weight:normal;"><?=$type["name"];?></b>
                                <input type="num" name="<?=$t_idx?>" maxlength="2" class="input num stage_<?=$f_type?>_<?=$t_idx?>" value="<?=$score[$t_idx]?>" style="text-align:center;" /> 회
                            </div>
                    	<?php endforeach?>
                        
                    </td>
                </tr>
                <tr style="background:rgb(250,250,250);" id="stage_<?=$MY_FOLLOW['fcuid']?>">
                    <td colspan=8 style="text-align:right; padding-right:20px;color:gray;">
                        <?php $follow_total+=$total;?>
                        <b>점수</b> <?=$total?><b>점</b>
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