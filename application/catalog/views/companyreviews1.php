<?php echo $header;?>

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
										$('#'+vote+'_'+rid).html("<b>"+data.total+"</b>&nbsp;"+vote);
									
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

<section class="container">
  <section class="main_contentarea">
    <div class="innr_wrap">
      <h1 class="bannertext"><span class="bannertextregular">RECENT </span>REVIEWS</h1>
      <?php if(count($reviews)>0)
				 { ?>
      <div class="dir_rew_wrap">
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
        <div class="revw_blck">
          <div class="revw_blck_img"> <a href="<?php echo site_url('complaint/viewuser/'.$reviews[$i]['companyid'].'/'.$reviews[$i]['reviewby']);?>" title="view profile">
            <div class="task-photo"> 
				<img width="100px" height="100" src="
				<?php 
				if( strlen($reviews[$i]['avatarbig']) > 1 ){ echo $this->common->get_setting_value('2').$this->config->item('user_thumb_upload_path');?><?php echo stripslashes($reviews[$i]['avatarbig']); } 
				else 
				{ 
					if($reviews[$i]['gender']=='Male' or $reviews[$i]['avatarbig']=='') { echo $this->common->get_setting_value('2')."images/male.png"; } 
					if($reviews[$i]['gender']=='Female') { echo $this->common->get_setting_value('2')."images/female.png"; } 
				} 
				?>" alt="<?php echo stripslashes($reviews[0]['username']); ?>"/> </div>
          
            </a> </div>
          <div class="revw_blck_cnt">
            <h2><a href="<?php echo site_url('company/'.$company[0]['companyseokeyword'].'/reviews/coupons/complaints');?>" title="view <?php echo stripslashes($reviews[$i]['company']);?>'s detail" class="font_color_2"><?php echo ucfirst(stripslashes($reviews[$i]['company']));?></a>
              <div class="rating">
            <?php for($r=0;$r<($reviews[$i]['rate']);$r++){?>
            <i class="vry_rat_icn"></i>
            <?php } ?>
            <?php for($p=0;$p<(5-($reviews[$i]['rate']));$p++){?>
            <i class="dull_rat_icn"></i>
            <?php } ?>
            
          </div>
            </h2>
            
            <div class="revw_occupt"> <span>
            <a href="review/browse/<?php echo $reviews[$i]['seokeyword'];?>" title="see details" class="font_color_white">
            "<?php echo $reviews[$i]['reviewtitle'];?>"
            </a>
            </span>-
              <p>
                <?php if($reviews[$i]['type']=='csv') { ?>
                <a title="<?php echo stripslashes($reviews[$i]['reviewby']); ?>"><?php echo stripslashes($reviews[$i]['reviewby']); ?></a>
                <?php } else {?>
                <a href="<?php echo site_url('complaint/viewuser/'.$reviews[$i]['companyid'].'/'.$reviews[$i]['reviewby']);?>" title="view profile" class="font_color_2"> <?php echo stripslashes($reviews[$i]['username']); ?></a>
                <?php } ?>
              </p>
              <div class="revw_date">
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
                <?php echo ($reviewdate==$today)?$diff:date('m/d/Y',strtotime($reviews[$i]['reviewdate'])); ?> </div>
            </div>
            <div class="revw_desc">
            <a href="review/browse/<?php echo $reviews[$i]['seokeyword'];?>" title="see details">
             "<?php echo (stripslashes($reviews[$i]['comment'])); ?>"
             </a>
              </div>
            <div class="revw_ratpoint"> <span>
              <h5>RATE THIS REVIEW:</h5>
              <?php $ip = $_SERVER['REMOTE_ADDR'];?>
              <?php if($this->reviews->check_vote($ip,$reviews[$i]['id'],'helpful') == 'true'){ ?>
              <a class="vote-disable" id="helpful_<?php echo $reviews[$i]['id'];?>" reviewid="<?php echo $reviews[$i]['id'];?>" title="Helpful"><b id="helpful<?php echo $reviews[$i]['id'];?>"><?php echo $this->reviews->getcount($reviews[$i]['id'],'helpful');?></b> Helpful</a>
              <?php }else{ ?>
              <a class="vote" id="helpful_<?php echo $reviews[$i]['id'];?>" reviewid="<?php echo $reviews[$i]['id'];?>" title="Helpful">Helpful</a>
              <?php } ?>
              <?php if($this->reviews->check_vote($ip,$reviews[$i]['id'],'funny') == 'true'){?>
              <a id="funny_<?php echo $reviews[$i]['id'];?>" class="vote-disable" title="funny" reviewid="<?php echo $reviews[$i]['id'];?>"><b id="funny<?php echo $reviews[$i]['id'];?>"><?php echo $this->reviews->getcount($reviews[$i]['id'],'funny');?></b> Funny</a>
              <?php }else{ ?>
              <a id="funny_<?php echo $reviews[$i]['id'];?>" class="vote" title="funny" reviewid="<?php echo $reviews[$i]['id'];?>">Funny</a>
              <?php } ?>
              <?php if($this->reviews->check_vote($ip,$reviews[$i]['id'],'agree') == 'true'){?>
              <a id="agree_<?php echo $reviews[$i]['id'];?>" class="vote-disable" reviewid="<?php echo $reviews[$i]['id'];?>" title="Agree"><b id="agree<?php echo $reviews[$i]['id'];?>"><?php echo $this->reviews->getcount($reviews[$i]['id'],'agree');?></b> Agree</a>
              <?php }else{ ?>
              <a id="agree_<?php echo $reviews[$i]['id'];?>" class="vote" reviewid="<?php echo $reviews[$i]['id'];?>" title="Agree">Agree</a>
              <?php } ?>
              <?php if($this->reviews->check_vote($ip,$reviews[$i]['id'],'disagree') == 'true'){?>
              <a id="disagree_<?php echo $reviews[$i]['id'];?>" class="vote-disable" title="disagree" reviewid="<?php echo $reviews[$i]['id'];?>"><b id="disagree<?php echo $reviews[$i]['id'];?>"><?php echo $this->reviews->getcount($reviews[$i]['id'],'disagree');?></b> Disagree</a>
              <?php }else{ ?>
              <a id="disagree_<?php echo $reviews[$i]['id'];?>" class="vote" title="disagree" reviewid="<?php echo $reviews[$i]['id'];?>">Disagree</a>
              <?php } ?>
              <?php if($this->session->userdata('youg_user')){$userid = $this->session->userdata['youg_user']['userid']; ?>
              <?php if($reviews[$i]['reviewby'] == $userid) {?>
              <a href="<?php echo site_url('review/edit').'/'.$reviews[$i]['id'];?>" title="Edit Review" class="">Edit</a> <a href="<?php echo site_url('review/delete').'/'.$reviews[$i]['id'];?>" title="Delete Review" class="" onclick="return confirm('Are you sure to remove this review?');">Delete</a>
              <?php } else {?>
              <a href="<?php echo site_url('review/add').'/'.$reviews[$i]['companyid'];?>" title="Review This Company" class="dir-searchbtn">Review It</a>
              <?php } ?>
              <?php } else {?>
              <a href="<?php echo site_url('review/add').'/'.$reviews[$i]['companyid'];?>" title="Review This Company" class="dir-searchbtn">Review It</a>
              <?php } ?>
              
              </span><div class="cmnt_wrp">
                          <a href="review/browse/<?php echo $reviews[$i]['seokeyword'];?>" title="Add Comment"> + Add comment </a>
	                     </div> </div>
          </div>
        </div>
        <?php } ?>
      </div>
      <?php if($this->pagination->create_links()) { ?>
        <div class="pagination"><?php echo $this->pagination->create_links(); ?></div>
        <?php } }else
		{
		?>
        <div class="isa_info">No reviews.</div>
        <?php
		}
	   ?>
      <div class="lgn_btnlogo"> <a href=""><img src="images/ygr_logos.png" class="logo_btm" alt="Yougotrated" title="Yougotrated"></a> </div>

    </div>
  </section>
</section>
<?php echo $footer;?>
