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
	  <!-- Go to www.addthis.com/dashboard to customize your tools -->
				<div class="addthis_native_toolbox"></div>

      <?php if(count($reviews)>0)
				 { ?>
      <div class="dir_rew_wrap">
        <?php for($i=0; $i<count($reviews); $i++) {?>
        <?php $company=$this->reviews->get_company_byid($reviews[$i]['companyid']);
        $companyseokeyword = ($company) ? $company[0]['companyseokeyword'] : '';
		$elitemem_status = $this->common->get_eliteship_bycompanyid($reviews[$i]['companyid']);
		?>
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
			<div class="revw_blck_img">            <?php 
				if(count($elitemem_status)==0){?>
					<div class="vry_logo"> 
						<a href="<?php echo site_url('company/'.$companyseokeyword.'/reviews/coupons/complaints');?>" title="view company Detail">
							<img  class="reviewnotverifiedlogo" src="images/notverified.png" alt="<?php echo ucfirst(stripslashes($reviews[$i]['company'])); ?>" />
						</a> 
					</div>  <?php 
					}else{  ?>
					<div class="vry_logo"> 
						<a href="<?php echo site_url('company/'.$companyseokeyword.'/reviews/coupons/complaints');?>" title="view company Detail">
							<img class="reviewverifiedlogo" src="images/verifiedlogo.jpg" alt="<?php echo ucfirst(stripslashes($reviews[$i]['company'])); ?>" />
						</a> 
					</div>      <?php
				} ?>            
            </div>
          <div class="revw_blck_cnt">
            <h2>
				<a href="<?php echo site_url('company/'.$companyseokeyword.'/reviews/coupons/complaints');?>" title="view <?php echo stripslashes($reviews[$i]['company']);?>'s detail" class="reviewcolor">
					<?php echo ucfirst(stripslashes($reviews[$i]['company']));?>
				</a>
				<div class="rating">
					<div class ="count-<?php echo $reviews[$i]['rate']?>">
					<?php for($r=0;$r<($reviews[$i]['rate']);$r++){?>
						<i class="vry_rat_icn"></i>
						<?php } ?>
					</div>	
						<?php for($p=0;$p<(5-($reviews[$i]['rate']));$p++){?>
						<i class="dull_starrat"></i>
				   <?php } ?>            
				</div>
            </h2>            
            <div class="revw_occupt"> 
				<span>
					<a href="review/browse/<?php echo $reviews[$i]['seokeyword'];?>" title="see details" style="color:#FFFFFF;">
						"<?php echo $reviews[$i]['reviewtitle'];?>"
					</a>
				</span>-
				<p> 
					<?php
					$users = $this->users->get_user_bysingleid($reviews[$i]['reviewby']); 
					if($users['id']==$reviews[$i]['reviewby'])
					{
					?>
						<a class = "reviewcolor" target = "_blank" href="<?php echo site_url('complaint/viewuser/'.$reviews[$i]['companyid'].'/'.$reviews[$i]['reviewby']);?>" title="view profile"><?php echo $users['username']; ?></a>
					<?php
					}
					else
					{
					?>
						<a class = "reviewcolor"><?php echo $reviews[$i]['reviewby']; ?></a>
					<?php
					}
					?>					
				</p>
              <div class="revw_date">
                <?php
					    $reviewdate = date('m/d/Y',strtotime($reviews[$i]['reviewdate']));
                        $today = date('m/d/Y'); 
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
            <div class="revw_ratpoint"> 
				<span>
					  <h5>RATE THIS REVIEW:</h5>
					  <?php $ip = $_SERVER['REMOTE_ADDR'];?>
					  <?php if($this->reviews->check_vote($ip,$reviews[$i]['id'],'helpful') == 'true'){ ?>
					  <a class="vote-disable" id="helpful_<?php echo $reviews[$i]['id'];?>" reviewid="<?php echo $reviews[$i]['id'];?>" title="Helpful" style="cursor:pointer !important;"><b id="helpful<?php echo $reviews[$i]['id'];?>"><?php echo $this->reviews->getcount($reviews[$i]['id'],'helpful');?></b> Helpful</a>
					  <?php }else{ ?>
					  <a class="vote" id="helpful_<?php echo $reviews[$i]['id'];?>" reviewid="<?php echo $reviews[$i]['id'];?>" title="Helpful" style="cursor:pointer !important;">Helpful</a>
					  <?php } ?>
					  <?php if($this->reviews->check_vote($ip,$reviews[$i]['id'],'funny') == 'true'){?>
					  <a id="funny_<?php echo $reviews[$i]['id'];?>" class="vote-disable" title="funny" reviewid="<?php echo $reviews[$i]['id'];?>" style="cursor:pointer !important;"><b id="funny<?php echo $reviews[$i]['id'];?>"><?php echo $this->reviews->getcount($reviews[$i]['id'],'funny');?></b> Funny</a>
					  <?php }else{ ?>
					  <a id="funny_<?php echo $reviews[$i]['id'];?>" class="vote" title="funny" reviewid="<?php echo $reviews[$i]['id'];?>" style="cursor:pointer !important;">Funny</a>
					  <?php } ?>
					  <?php if($this->reviews->check_vote($ip,$reviews[$i]['id'],'agree') == 'true'){?>
					  <a id="agree_<?php echo $reviews[$i]['id'];?>" class="vote-disable" reviewid="<?php echo $reviews[$i]['id'];?>" title="Agree" style="cursor:pointer !important;"><b id="agree<?php echo $reviews[$i]['id'];?>"><?php echo $this->reviews->getcount($reviews[$i]['id'],'agree');?></b> Agree</a>
					  <?php }else{ ?>
					  <a id="agree_<?php echo $reviews[$i]['id'];?>" class="vote" reviewid="<?php echo $reviews[$i]['id'];?>" title="Agree" style="cursor:pointer !important;">Agree</a>
					  <?php } ?>
					  <?php if($this->reviews->check_vote($ip,$reviews[$i]['id'],'disagree') == 'true'){?>
					  <a id="disagree_<?php echo $reviews[$i]['id'];?>" class="vote-disable" title="disagree" reviewid="<?php echo $reviews[$i]['id'];?>" style="cursor:pointer !important;"><b id="disagree<?php echo $reviews[$i]['id'];?>"><?php echo $this->reviews->getcount($reviews[$i]['id'],'disagree');?></b> Disagree</a>
					  <?php }else{ ?>
					  <a id="disagree_<?php echo $reviews[$i]['id'];?>" class="vote" title="disagree" reviewid="<?php echo $reviews[$i]['id'];?>" style="cursor:pointer !important;">Disagree</a>
					  <?php } ?>
					  <?php if($this->session->userdata('youg_user')){$userid = $this->session->userdata['youg_user']['userid']; ?>
					  <?php if($reviews[$i]['reviewby'] == $userid) {?>
					  <a href="<?php echo site_url('review/edit').'/'.$reviews[$i]['id'];?>" title="Edit Review" class="" style="cursor:pointer !important;">Edit</a> <a href="<?php echo site_url('review/delete').'/'.$reviews[$i]['id'];?>" title="Delete Review" class="" onclick="return confirm('Are you sure to remove this review?');" style="cursor:pointer !important;">Delete</a>
					  <?php } else {?>
					  <a href="<?php echo site_url('review/add').'/'.$reviews[$i]['companyid'];?>" title="Review This Company" class="dir-searchbtn" style="cursor:pointer !important;">Review It</a>
					  <?php } ?>
					  <?php } else {?>
					  <a href="<?php echo site_url('review/add').'/'.$reviews[$i]['companyid'];?>" title="Review This Company" class="dir-searchbtn" style="cursor:pointer !important;">Review It</a>
					  <?php } ?>              
				</span>
				<div class="cmnt_wrp">
                    <a href="review/browse/<?php echo $reviews[$i]['seokeyword'];?>" title="Add Comment" style="cursor:pointer !important;">
                            +  Add comment
                    </a>
	            </div>
				<div class="cmnt_wrp">
                    <a href="<?php echo site_url('company/reviews/'.$companyseokeyword.'/reviews/coupons/complaints');?>" title="View All" style="cursor:pointer !important;margin-right: 10px;">
                            +   View All
                    </a>
	            </div> 
	        </div>
          </div>
        </div>
        <?php } ?>
      </div>
      <?php }
	  
	  if($this->pagination->create_links()) { ?>
        <div class="pagination"><?php echo $this->pagination->create_links(); ?></div>
        <?php } 
	   ?>
      <div class="lgn_btnlogo"> <a href=""><img src="images/ygr_logos.png" class="logo_btm" alt="Yougotrated" title="Yougotrated"></a> </div>
    </div>
  </section>
</section>
<?php echo $footer;?>
<?php if(!empty($promo)){?>
<a href = "#readmore" class = "readmore font_color_1" id="applypromo1" style='display:none;'>Apply promo</a>
<div id="readmore" style="width:500px;display:none">
	<div class = "profile_about_company">
		<h3>Review Promo code</h3>
	</div>
	<div class = "profile_about_data">
		<p>Promo code details:</p>
		<table cellpadding="0" cellspacing="0">
		  <tr><td style="padding-bottom: 10px; padding-top: 10px;" width="40%">Title</td><td style="padding-bottom: 10px; padding-top: 10px;"><div id="texter" name="texter"><?php echo $promo['name']; ?></div></td></tr>
		  <tr><td style="padding-bottom: 10px; padding-top: 10px;" width="40%">Summary</td><td style="padding-bottom: 10px; padding-top: 10px;"><div id="sums" name="sums"><?php echo $promo['text']; ?></div></td></tr>
		  <tr>  <?php $coupon_type = explode('.',$promo['image']);
					   if($coupon_type[1] == 'pdf'){
				  ?>
				<td style="padding-bottom: 10px; padding-top: 10px;" width="40%">Coupon Link</td>
				<td style="padding-bottom: 10px; padding-top: 10px;">
				  <a id="linker" href="<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/uploads/coupon'.'/main/'.$promo['image']; ?>" TARGET="_blank">Click here</a>
				</td> 
				<?php } else { ?>
				<td style="padding-bottom: 10px; padding-top: 10px;" width="40%"></td>
				<td style="padding-bottom: 10px; padding-top: 10px;">	  
					<img src="<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/uploads/coupon'.'/main/'.$promo['image']; ?>" alt="Promo Image" width="90%" />		
				</td>
				<?php } ?>
		  </tr>
		</table> 

		<div id="emailmediv" style="margin-top: 5px;">
			<a TARGET="_blank" href="<?php echo site_url('review/emailmepromo/'.$companyid.'/'.$promo['id']);?>" id="emailme" name="emailme">Email me this promotion</a>
		</div>
	</div>
</div>
<link rel="stylesheet" href="<?php echo base_url();?>css/fancybox.css" type="text/css">
<script type="text/javascript" src="<?php echo base_url();?>js/fancybox.js"></script>
<script type="text/javascript">
$(window).load(function(){ 
	$('.readmore').fancybox();
	$('#applypromo1').trigger('click');
});
</script>
<?php } ?>
