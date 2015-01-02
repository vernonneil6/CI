<?php echo $header; ?>

<section class="content-wrap" style="margin-right:0">
  <section class="inner_main">
    <div class="main_contentarea"> <?php echo $menu; ?> 
    <?php if($topads){ ?>
       <div class="ad_up"><a href="<?php echo $topads[0]['url'];?>" title="" target="_blank"><img src="<?php if( $topads[0]['image'] ) { echo $this->common->get_setting_value('2').$this->config->item('ad_main_upload_path');?><?php echo stripslashes($topads[0]['image']); } ?>" alt="topads" width="940" height="180" class="adimg"/></a> </div>
     
		  <?php } ?>
    
      <script src='<?php echo site_url();?>js/star-rating/jquery.js' type="text/javascript"></script> 
      <script src='<?php echo site_url();?>js/star-rating/jquery.MetaData.js' type="text/javascript" language="javascript"></script> 
      <script src='<?php echo site_url();?>js/star-rating/jquery.rating.js' type="text/javascript" language="javascript"></script>
      <link href='<?php echo site_url();?>js/star-rating/jquery.rating.css' type="text/css" rel="stylesheet"/>
      <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/jquery-ui.min.js" type="text/javascript"></script>
 
      <?php if( $this->session->flashdata('success') ) { ?>
      <!--  start message-green -->
      <div id="message-green">
        <table border="0" width="100%" cellpadding="0" cellspacing="0">
          <tr>
            <td class="green-left"><?php echo $this->session->flashdata('success'); ?></td>
            <td class="green-right"><a class="close-green"><img src="<?php echo base_url(); ?>images/messages/icon_close_green.gif" alt="Close"/></a></td>
          </tr>
        </table>
      </div>
      <!--  end message-green -->
      <?php } ?>
      <?php 	 if( $this->session->flashdata('error') ) { ?>
      <!--  start message-red -->
      <div id="message-red">
        <table border="0" width="100%" cellpadding="0" cellspacing="0">
          <tr>
            <td class="red-left"><?php echo $this->session->flashdata('error'); ?></td>
            <td class="red-right"><a class="close-red"><img src="<?php echo base_url(); ?>images/messages/icon_close_red.gif" alt="Close"/></a></td>
          </tr>
        </table>
      </div>
      <!--  end message-red -->
      <?php } 	?>
      <?php echo form_open('review/update',array('class'=>'formBox','id'=>'form5'));?>
      <div class="dir_panel"> 
        <script type="text/javascript" language="javascript">				  
		  function countme(rid,vote)
		  {
			  $.ajax({
				  type 				: "POST",
				  url 				: "<?php echo site_url('review/countme');?>",
				  dataType 		: "json",
				  data				: {reviewid:rid,vote : vote},
				  cache				: false,
				  success			: function(data)
									  {	
										$('#'+vote+rid).html(data.total);
									
									  }
			   });
		  }
		  function check(ip,rid,vote)
		  {
			  
			  $.ajax({
				  type 				: "POST",
				  url 				: "<?php echo site_url('review/checkvote');?>",
				  dataType 		: "json",
				  data				: { ip:ip,reviewid:rid,vote : vote},
				  cache				: false,
				  success			: function(data)
									  {	
										if(data.message == 'deleted')
										{
										   $('#'+vote+'_'+rid).removeClass('vote-disable');
										   $('#'+vote+'_'+rid).addClass('vote');
										}
										if(data.message == 'added')
										{
										   $('#'+vote+'_'+rid).removeClass('vote');
										   $('#'+vote+'_'+rid).addClass('vote-disable');										   										  
										}
										countme(rid,vote);
									  }
				  

			   });
			  
		  }

		  </script>
        <div class="dir_title" style="width:auto;padding-bottom:15px;">Business Review
          <div class="my" style="float:right;padding-bottom:-10px;"> <a href="<?php echo site_url('welcome');?>" title="submit a complaint"><?php echo form_input(array('name'=>'submitacomplaint','id'=>'submitacomplaint','class'=>'complaint_btn','type'=>'button','value'=>'Submit a complaint','style'=>'padding:7px 25px;cursor: pointer;')); ?></a> </div>
        </div>
        <div class="vote-box"> <span>Votes Since Yesterday: <?php echo $this->reviews->get_yest_count('helpful');?> Helpful / <?php echo $this->reviews->get_yest_count('funny');?> Funny / <?php echo $this->reviews->get_yest_count('agree');?> Agree / <?php echo $this->reviews->get_yest_count('disagree');?> Disagree</span> </div>
        <?php if(count($reviews)>0)
				 { 
				// echo "<pre>";
				//print_r($reviews);
				//die();
				 ?>
        <?php for($i=0; $i<count($reviews); $i++) {?>
        
        <?php $company=$this->reviews->get_company_byid($reviews[$i]['companyid']);?>
        <script>
					<?php $ip = $_SERVER['REMOTE_ADDR'];  ?>
					
					$(function(){ 
					 $("#helpful_<?php echo $reviews[$i]['id'];?>").click(function() {
						 var vote = 'helpful';
						 var reviewid = $(this).attr('reviewid');
						 check('<?php echo $ip;?>',reviewid,vote);
					   });
					   $("#funny_<?php echo $reviews[$i]['id'];?>").click(function() {
						 var vote = 'funny';
						 var reviewid = $(this).attr('reviewid');
						 check('<?php echo $ip;?>',reviewid,vote);
					   });
					   $("#agree_<?php echo $reviews[$i]['id'];?>").click(function() {
						 var vote = 'agree';
						 var reviewid = $(this).attr('reviewid');
						 check('<?php echo $ip;?>',reviewid,vote);
						 countme(reviewid,'disagree');
						 $('#disagree_'+reviewid).removeClass('vote-disable');
						 $('#disagree_'+reviewid).addClass('vote'); 
					   });
					   $("#disagree_<?php echo $reviews[$i]['id'];?>").click(function() {
						 var vote = 'disagree';
						 var reviewid = $(this).attr('reviewid');
						 check('<?php echo $ip;?>',reviewid,vote);
						 countme(reviewid,'agree');
						 $('#agree_'+reviewid).removeClass('vote-disable');
						 $('#agree_'+reviewid).addClass('vote'); 
					   });
					});
				</script>
        <table width="980" border="0" cellspacing="0" cellpadding="0" class="job-table" style="border:none">
          <tr height="80">
            <td width="85px" valign="top"><a href="<?php echo site_url('complaint/viewuser/'.$reviews[$i]['companyid'].'/'.$reviews[$i]['reviewby']);?>" title="view profile">
              <div class="task-photo"> <img width="60px" src="<?php if( strlen($reviews[$i]['avatarbig']) > 1 ){ echo $this->common->get_setting_value('2').$this->config->item('user_thumb_upload_path');?><?php echo stripslashes($reviews[$i]['avatarbig']); } else { if($reviews[$i]['gender']=='Male') { echo $this->common->get_setting_value('2')."images/male.png"; } 
		  	if($reviews[$i]['gender']=='Female') { echo $this->common->get_setting_value('2')."images/female.png"; } 
		  } 
		   ?>" alt="<?php echo stripslashes($reviews[0]['username']); ?>"/> </div>
              </a>
              <?php
					    $reviewdate = date('m/d/Y',strtotime($reviews[$i]['reviewdate']));
                        $today = date('m/d/Y'); 
					  	$date = date_default_timezone_set('Asia/Kolkata');
					    $d1 = strtotime(date('Y-m-d H:i:s'));
                        $d2 = strtotime($reviews[$i]['reviewdate']);
                        $newdate =round(($d1-$d2)/60);
                        if($newdate > 60){$diff = round(($d1-$d2)/60/60).' hours ago';}else{
													if($newdate<2){$diff='Just now';}else{
													$diff = $newdate.' minutes ago'; }
													}
					  ?>
              <div class="rev-date"> <?php echo ($reviewdate==$today)?$diff:date('m/d/Y',strtotime($reviews[$i]['reviewdate'])); ?> </div></td>
            <td width="600" align="justify" valign="top" colspan="2" style="padding-bottom:5px"><span class="rev-user"> <a href="<?php echo site_url('complaint/viewuser/'.$reviews[$i]['companyid'].'/'.$reviews[$i]['reviewby']);?>" title="view profile"> <?php echo stripslashes($reviews[$i]['username']); ?></a></span> reviewed <span class="rev-company"><a href="<?php echo site_url('company/'.$company[0]['companyseokeyword'].'/reviews/coupons/complaints');?>" title="view <?php echo stripslashes($reviews[$i]['company']);?>'s detail"><?php echo ucfirst(stripslashes($reviews[$i]['company']));?></a></span><br>
              <br>
              <span>
              <div id="tab-Testing"> 
                <script type="text/javascript" language="javascript">
							$(function(){  
							 $('#form5 :radio.star').rating(); 
							});
						  </script>
                <div class="Clear">
                  <?php if($reviews[$i]['rate']=='1'){ ?>
                  <input class="star required" type="radio" id="radt_<?php echo $i;?>" name="test-4-rating-<?php echo $i;?>" value="1" title="Terrible" checked="checked" disabled="disabled"/>
                  <input class="star" type="radio" id="radb" name="test-4-rating-<?php echo $i;?>" value="2" title="Bad" disabled="disabled"/>
                  <input class="star" type="radio" id="rado" name="test-4-rating-<?php echo $i;?>" value="3" title="Ok" disabled="disabled"/>
                  <input class="star" type="radio" id="radgd" name="test-4-rating-<?php echo $i;?>" value="4" title="Good" disabled="disabled"/>
                  <input class="star" type="radio" id="radg" name="test-4-rating-<?php echo $i;?>" value="5" title="Great!" disabled="disabled"/>
                  <?php } ?>
                  <?php if($reviews[$i]['rate']=='2'){ ?>
                  <input class="star required" type="radio" id="radt" name="test-4-rating-<?php echo $i;?>" value="1" title="Terrible" checked="checked" disabled="disabled"/>
                  <input class="star" type="radio" id="radb" name="test-4-rating-<?php echo $i;?>" value="2" title="Bad" checked="checked"disabled="disabled"/>
                  <input class="star" type="radio" id="rado" name="test-4-rating-<?php echo $i;?>" value="3" title="Ok" disabled="disabled"/>
                  <input class="star" type="radio" id="radgd" name="test-4-rating-<?php echo $i;?>" value="4" title="Good" disabled="disabled"/>
                  <input class="star" type="radio" id="radg" name="test-4-rating-<?php echo $i;?>" value="5" title="Great!" disabled="disabled"/>
                  <?php } ?>
                  <?php if($reviews[$i]['rate']=='3'){ ?>
                  <input class="star required" type="radio" id="radt" name="test-4-rating-<?php echo $i;?>" value="1" title="Terrible" checked="checked" disabled="disabled"/>
                  <input class="star" type="radio" id="radb" name="test-4-rating-<?php echo $i;?>" value="2" title="Bad" checked="checked" disabled="disabled"/>
                  <input class="star" type="radio" id="rado" name="test-4-rating-<?php echo $i;?>" value="3" title="Ok" checked="checked" disabled="disabled"/>
                  <input class="star" type="radio" id="radgd" name="test-4-rating-<?php echo $i;?>" value="4" title="Good" disabled="disabled"/>
                  <input class="star" type="radio" id="radg" name="test-4-rating-<?php echo $i;?>" value="5" title="Great!" disabled="disabled"/>
                  <?php } ?>
                  <?php if($reviews[$i]['rate']=='4'){ ?>
                  <input class="star required" type="radio" id="radt" name="test-4-rating-<?php echo $i;?>" value="1" title="Terrible" checked="checked" disabled="disabled"/>
                  <input class="star" type="radio" id="radb" name="test-4-rating-<?php echo $i;?>" value="2" title="Bad" checked="checked" disabled="disabled"/>
                  <input class="star" type="radio" id="rado" name="test-4-rating-<?php echo $i;?>" value="3" title="Ok" checked="checked" disabled="disabled"/>
                  <input class="star" type="radio" id="radgd" name="test-4-rating-<?php echo $i;?>" value="4" title="Good" checked="checked" disabled="disabled"/>
                  <input class="star" type="radio" id="radg" name="test-4-rating-<?php echo $i;?>" value="5" title="Great!" disabled="disabled"/>
                  <?php } ?>
                  <?php if($reviews[$i]['rate']=='5'){ ?>
                  <input class="star required" type="radio" id="radt" name="test-4-rating-<?php echo $i;?>" value="1" title="Terrible" checked="checked" disabled="disabled"/>
                  <input class="star" type="radio" id="radb" name="test-4-rating-<?php echo $i;?>" value="2" title="Bad" checked="checked" disabled="disabled"/>
                  <input class="star" type="radio" id="rado" name="test-4-rating-<?php echo $i;?>" value="3" title="Ok" checked="checked" disabled="disabled"/>
                  <input class="star" type="radio" id="radgd" name="test-4-rating-<?php echo $i;?>" value="4" title="Good" checked="checked" disabled="disabled"/>
                  <input class="star" type="radio" id="radg" name="test-4-rating-<?php echo $i;?>" value="5" title="Great!" checked="checked" disabled="disabled"/>
                  <?php } ?>
                  <div style="margin-top:5px;"> <span id="hover-test">
                    <?php if($reviews[$i]['rate']=='1'){ ?>
                    <?php echo 'Terrible'; ?>
                    <?php } ?>
                    <?php if($reviews[$i]['rate']=='2'){ ?>
                    <?php echo 'Bad'; ?>
                    <?php } ?>
                    <?php if($reviews[$i]['rate']=='3'){ ?>
                    <?php echo 'Ok'; ?>
                    <?php } ?>
                    <?php if($reviews[$i]['rate']=='4'){ ?>
                    <?php echo 'Good'; ?>
                    <?php } ?>
                    <?php if($reviews[$i]['rate']=='5'){ ?>
                    <?php echo 'Great!'; ?>
                    <?php } ?>
                    </span> </div>
                  <input type="hidden" name="rating" id="rating"/>
                </div>
              </div>
              </span><br />
              <span style="padding-bottom:10px"> <?php echo nl2br(stripslashes($reviews[$i]['comment'])); ?> </span></td>
            <td class="post-date" style="width:150px;"><?php if($this->session->userdata('youg_user')){$userid = $this->session->userdata['youg_user']['userid']; ?>
              <?php if($reviews[$i]['reviewby'] == $userid) {?>
              <a style="color:#fff; padding: 3px 16px;font-size:16px;text-shadow:none;" href="<?php echo site_url('review/edit').'/'.$reviews[$i]['id'];?>" title="Edit Review" class="dir-searchbtn">Edit</a> <a style="color:#fff; padding: 3px 16px;font-size:16px;text-shadow:none;" href="<?php echo site_url('review/delete').'/'.$reviews[$i]['id'];?>" title="Delete Review" class="dir-searchbtn" onclick="return confirm('Are you sure to remove this review?');">Delete</a>
              <?php } else {?>
              <a style="color:#fff; padding: 3px 16px;font-size:16px;text-shadow:none;" href="<?php echo site_url('review/add').'/'.$reviews[$i]['companyid'];?>" title="Review This Company" class="dir-searchbtn">Review</a>
              <?php } ?>
              <?php } else {?>
              <a style="color:#fff; padding: 3px 16px;font-size:16px;text-shadow:none;" href="<?php echo site_url('review/add').'/'.$reviews[$i]['companyid'];?>" title="Review This Company" class="dir-searchbtn">Review</a>
              <?php } ?></td>
          </tr>
          <tr>
            <td></td>
            <td colspan="2" style="color:#333333; padding-bottom:10px; padding-top:10px">Add your vote:
              <?php $ip = $_SERVER['REMOTE_ADDR'];
					if($this->reviews->check_vote($ip,$reviews[$i]['id'],'helpful') == 'true'){?>
              <a class="vote-disable" id="helpful_<?php echo $reviews[$i]['id'];?>" reviewid="<?php echo $reviews[$i]['id'];?>">Helpful</a>
              <?php } else {?>
              <a class="vote" id="helpful_<?php echo $reviews[$i]['id'];?>" reviewid="<?php echo $reviews[$i]['id'];?>">Helpful</a>
              <?php } ?>
              <?php if($this->reviews->check_vote($ip,$reviews[$i]['id'],'funny') == 'true'){?>
              <a id="funny_<?php echo $reviews[$i]['id'];?>" class="vote-disable" title="funny" reviewid="<?php echo $reviews[$i]['id'];?>">Funny</a>
              <?php } else {?>
              <a id="funny_<?php echo $reviews[$i]['id'];?>" class="vote" title="funny" reviewid="<?php echo $reviews[$i]['id'];?>">Funny</a>
              <?php } ?>
              <?php if($this->reviews->check_vote($ip,$reviews[$i]['id'],'agree') == 'true'){?>
              <a id="agree_<?php echo $reviews[$i]['id'];?>" class="vote-disable" reviewid="<?php echo $reviews[$i]['id'];?>">Agree</a>
              <?php } else {?>
              <a id="agree_<?php echo $reviews[$i]['id'];?>" class="vote" reviewid="<?php echo $reviews[$i]['id'];?>">Agree</a>
              <?php } ?>
              <?php if($this->reviews->check_vote($ip,$reviews[$i]['id'],'disagree') == 'true'){?>
              <a id="disagree_<?php echo $reviews[$i]['id'];?>" class="vote-disable" title="disagree" reviewid="<?php echo $reviews[$i]['id'];?>">Disagree</a>
              <?php } else {?>
              <a id="disagree_<?php echo $reviews[$i]['id'];?>" class="vote" title="disagree" reviewid="<?php echo $reviews[$i]['id'];?>">Disagree</a>
              <?php } ?></td>
            <td></td>
            <td></td>
          </tr>
          <tr style="background:#E8E8E8" height="30px">
            <td width="105px" style="padding-left:1px" class="user_view"><div class="comment_img"> 
                <!--<img src="<?php echo site_url();?>/images/ico-riv-comment.png"/>--> 
                <span style="padding-left:25px;text-decoration:underline;"> <a href="<?php echo site_url('review/browse/'.$reviews[$i]['id']);?>" title="Comments">
                <?php $comments=$this->reviews->get_comments_byreviewid($reviews[$i]['id']); echo count($comments); ?>
                Comments</a></span></div></td>
            <td colspan="2" style="padding-left:60px">Votes on this review: <b><span id="helpful<?php echo $reviews[$i]['id'];?>"><?php echo $this->reviews->getcount($reviews[$i]['id'],'helpful');?></span> Helpful / <span id="funny<?php echo $reviews[$i]['id'];?>"><?php echo $this->reviews->getcount($reviews[$i]['id'],'funny');?></span> Funny / <span id="agree<?php echo $reviews[$i]['id'];?>"><?php echo $this->reviews->getcount($reviews[$i]['id'],'agree');?></span> Agree / <span id="disagree<?php echo $reviews[$i]['id'];?>"><?php echo $this->reviews->getcount($reviews[$i]['id'],'disagree');?></span> Disagree</span></b>
            <td></td>
            <td></td>
          </tr>
        </table>
        <?php } ?>
        <?php 
				if($this->pagination->create_links()) { ?>
        <table border="0">
          <tr style="background:#ffffff">
            <td><div class="pagination"><?php echo $this->pagination->create_links(); ?></div></td>
          </tr>
        </table>
        <?php } } else {?><div class="form-message warning">
                <p>No reviews.</p>
              </div><?php }?>
        <?php if($bottomads){ ?>
       <div class="ad_bottom"><a href="<?php echo $bottomads[0]['url'];?>" title="" target="_blank"><img src="<?php if( $bottomads[0]['image'] ) { echo $this->common->get_setting_value('2').$this->config->item('ad_main_upload_path');?><?php echo stripslashes($bottomads[0]['image']); } ?>" alt="topads" width="940" height="180" class="adimg"/></a> </div>
     
		  <?php } ?>
      </div>
      <?php echo form_close();?> 
      <!-- /box -->
      
    </div>
  </section>
</section>
<?php echo $footer; ?>