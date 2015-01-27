<link rel="stylesheet" href="<?php echo base_url();?>css/style.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url();?>css/widget.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url();?>css/fancybox.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url(); ?>businessadmin/css/tooltipster.css" />

<script type="text/javascript" src="<?php echo base_url();?>js/jquery-1.7.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/fancybox.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>businessadmin/js/jquery.tooltipster.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.raty.min.js"></script>


<div class = "company_review_tab fancybox" href="#review_popup">
Reviews
</div>

<div id="review_popup" class = "popupwidth">
<div class = "review_poweredby">Powered by YouGotRated</div>
<div class = "review_tab_top">
	THESE ARE REAL REVIEWS FROM YOUGOTRATED
</div>
<div class = "review_tab_bottom">
	
            <?php 
            if( count($reviews) > 0 ) 
            { 		
				if(count($reviews)>5)
				{
					$newreviews = 5;
				}
				else
				{
					$newreviews = count($reviews);
				}
			  
				for($i=0; $i<$newreviews; $i++) 
				{ 
					if($reviews[$i]['type']=='csv' || $reviews[$i]['type']=='ygr') 
					{ 
					$users = $this->users->get_user_bysingleid($reviews[$i]['reviewby']); 
					$cmpy  = $this->users->get_company_bysingleid($reviews[$i]['companyid']); 
					$elitemem_status = $this->common->get_eliteship_bycompanyid($reviews[$i]['companyid']); 
						if(count($users)>0) 
						{ 
						?>
						<div class ="<?php if($i!='0'){ echo "review_border_bottom";} ?> padding_top_1">
							 <div class = "review_firstletter">
								<label><?php if($users['username']!=''){ $firstword = $users['username']; echo ucfirst($firstword[0]); }?></label>
							 </div>
						
							<div class = "review_username_row">
								 <div class = "review_name_tab tooltip" title = "This review has been authenticated by <?php echo $cmpy['company']; ?> and has been posted on YouGotRated by a real shopper">
									 <?php echo $users['username'];?>
									 <span>					
										<?php /*if(count($elitemem_status)==0) { ?>
											Not Verified Buyer  
										<?php }else{  ?>
											Verified Buyer
										<?php } */?>           
									</span>
								 </div>
								 <div class = "review_date_tab"><?php echo date("m/d/Y",strtotime($reviews[$i]['reviewdate']));?></div>
								 <div class="review_rating_tab">
									<?php for($r=0;$r<($reviews[$i]['rate']);$r++){?>
									<i class="vry_rat_icn"></i>
									<?php } ?>
									<?php for($p=0;$p<(5-($reviews[$i]['rate']));$p++){?>
									<img src="images/no_star.png" alt="no_star" title="no_star" />
									<?php } ?>
								  </div>
								   <div class="rat_title reptitle">
										<h2 class = "font_size_tab"><?php echo $reviews[$i]['reviewtitle'];?></h2>
								   </div>
								   <p><?php echo $reviews[$i]['comment'];?></p>		  
							 </div>
							 
							 <div class = "review_rates">
								 <div class = "review_ratethis">
									<span>
									  <label>RATE THIS REVIEW:</label>
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
									</span>
								</div>
							 </div>
							 
						 </div> 
						<?php
						} 
					} 
				} 
			}
			
			if($this->pagination->create_links()) 
			{ 
			?>
				<div class="pagination"><?php echo $this->pagination->create_links(); ?></div>
			<?php 
			}      
			if( count($reviews)==0 ) 
			{ 
			?>
            <div class="form-message warning">
              <p>No Reviews.</p>
            </div>
            <?php 
            }
            ?>
    </div>
</div>

<script>
	$(document).ready(function() 
	{
		$('.tooltip').tooltipster();
		$('.fancybox').fancybox();
	});

function countme(rid,vote)
	{
	  $.ajax({
		  type 				: "POST",
		  url 				: "<?php echo site_url('review/countme');?>",
		  dataType 			: "json",
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
		  dataType 			: "json",
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
