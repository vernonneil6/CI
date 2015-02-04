<link rel="stylesheet" href="<?php echo base_url();?>css/style.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url();?>css/widget.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url();?>css/fancybox.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url(); ?>businessadmin/css/tooltipster.css" />

<script type="text/javascript" src="<?php echo base_url();?>js/jquery-1.7.min.js" ></script>
<script type="text/javascript" src="<?php echo base_url();?>js/fancybox.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>businessadmin/js/jquery.tooltipster.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.raty.min.js"></script>


<div class = "company_review_tab fancybox" href="#review_popup">
Reviews
</div>

<div id="review_popup" class = "popupwidth">
<div class = "review_poweredby">Powered by YouGotRated</div>
<div class = "review_tab_top">
	<div>
		<label class="widget_title">THESE ARE REAL REVIEWS <br> FROM YOUGOTRATED</label>
	</div>
	<div>
		<img class="widget_img" src="<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/images/badge.png'; ?>">
	</div>
</div>
<div class = "review_tab_bottom">
			<?php echo $total; ?>
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
								<label><?php if($users['username']!=null){ $firstword = $users['username']; echo ucfirst($firstword[0]); } else { echo "A";}?></label>
							 </div>
							
							<div class = "review_username_row">
								 <div class = "review_name_tab tooltip" title = "This review has been authenticated by <?php echo $cmpy['company']; ?> and has been posted on YouGotRated by a real shopper">
									 <?php if($users['username']!=null){ echo $users['username']; } else { echo "Anonymous";}?>
									 <span>					
										<?php if(count($elitemem_status)==0) { ?>
											Not Verified Review  
										<?php }else{  ?>
											Verified Review
										<?php } ?>           
									</span>
								 </div>
								 <div class = "review_date_tab"><?php echo date("m/d/Y",strtotime($reviews[$i]['reviewdate']));?></div>
								 <div class="review_rating_tab">
									<?php for($r=0;$r<($reviews[$i]['rate']);$r++){?>
									<i class="vry_rat_icn"></i>
									<?php } ?>
									<?php for($p=0;$p<(5-($reviews[$i]['rate']));$p++){?>
									<img src="<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/'; ?>images/no_star.png" alt="no_star" title="no_star" />
									<?php } ?>
								  </div>
								   <div class="rat_title reptitle">
										<h2 class = "font_size_tab"><?php echo $reviews[$i]['reviewtitle'];?></h2>
								   </div>
								   <p><?php echo $reviews[$i]['comment'];?></p>		  
							 </div>
							 
							 
						 </div> 
						<?php
						} 
					} 
				} 
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
</script>
