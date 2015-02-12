<link rel="stylesheet" href="<?php echo base_url();?>css/style.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url();?>css/widget.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url();?>css/fancybox.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url(); ?>css/tooltipster.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url(); ?>css/font-awesome.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url(); ?>css/themes/widget-tooltip.css" type="text/css">
<style>
@font-face {
  font-family: 'FontAwesome';
  src: url('<?php echo base_url(); ?>/font/Font-Awesome/fontawesome-webfont.eot');
  src: url('<?php echo base_url(); ?>/font/Font-Awesome/fontawesome-webfont.eot?#iefix') format('embedded-opentype'),
    url('<?php echo base_url(); ?>/font/Font-Awesome/fontawesome-webfont.woff') format('woff'),
    url('<?php echo base_url(); ?>/font/Font-Awesome/fontawesome-webfont.ttf') format('truetype');
  font-weight: normal;
  font-style: normal;
}
</style>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery-1.7.min.js" ></script>
<script type="text/javascript" src="<?php echo base_url();?>js/fancybox.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.tooltipster.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.raty.min.js"></script>


<div class = "company_review_tab fancybox" href="#review_popup">
Reviews
</div>

<div id="review_popup" class = "popupwidth">
<div class = "review_poweredby">Powered by YouGotRated</div>
<div class = "review_tab_top">
	<div class="widget_title">
		<label >THESE ARE REAL REVIEWS <br> PUBLISHED ON YOUGOTRATED</label>
	</div>
	<div class="widget_img">
		<a target="_blank" href="<?php echo base_url(); ?>" title = "<?php echo base_url(); ?>">
			<img  src="<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/images/badge.png'; ?>" width = "80px">
		</a>
	</div>
	<label class = "widget_close">X</label>
	<div class = "clear"></div>
</div>

<div class = "review_tab_middle">
	 <div><label class = "widget_company_name"><a target="_blank" href = "<?php echo base_url().'company/'.$companyseo.'/reviews/coupons/complaints'; ?>"><?php echo ucfirst($companyname); ?></a></label></div>
	 <div class="vry_rating vryrating">
		<?php for($r=0;$r<round($averagerating);$r++){?>
		<i class="vry_rat_icn"></i>
		<?php } ?>
		<?php for($p=0;$p<(5-round($averagerating));$p++){?>
		<img src="<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/'; ?>images/no_star.png" alt="no_star" title="no_star" />
		<?php } ?>
		<label class = "single_review"><?php echo $total."  Reviews"; ?></label>
	  </div>	
	  <div class = "clear"></div>			  
</div>

<div class = "review_tab_bottom" id = "scrollbar"> 
			<div id = "itemContainer" style = "min-height: unset;">
            <?php 
            if( count($reviews) > 0 ) 
            { 		
							  
				for($i=0; $i<count($reviews); $i++) 
				{ 
					if($reviews[$i]['type']=='csv' || $reviews[$i]['type']=='ygr') 
					{ 
					$users = $this->users->get_user_bysingleid($reviews[$i]['reviewby']); 
					$cmpy  = $this->users->get_company_bysingleid($reviews[$i]['companyid']); 
					$elitemem_status = $this->common->get_eliteship_bycompanyid($reviews[$i]['companyid']); 
						if(count($users)>0) 
						{ 
						?>
						<div class ="review_border_bottom padding_top_1">
							<div class = "review_circle">
							 <div class = "review_firstletter">
								<label><?php if($users['username']!=null){ $firstword = $users['username']; echo ucfirst($firstword[0]); } else { echo "A";}?></label>
								<span class = "review_correct_circle"><i class="fa fa-check"></i></span>
							 </div>
							</div>
							<div class = "review_username_row">
								 <div class = "review_name_tab tooltip" >
									 <?php if($users['username']!=null){ echo ucfirst($users['username']); } else { echo "Anonymous";}?>
									 <span class = "tooltip" 
									   
									 title = "
									 &lt;div class&#61;&#34;tooltip_text&#34; &gt;
									 &lt;div &gt; This review has been authenticated by &lt;span class&#61;&#34;tooltip_heading_color&#34; &gt; <?php echo strtoupper($companyname); ?> &lt;/span&gt; &lt;/div&gt;
									 &lt;div &gt; and has been posted on YouGotRated by a real shopper. &lt;/div&gt;
									 &lt;/div &gt;
									 "
									 >					
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
							 
							 <div class = "review_rates">
								 <div class = "widget_share"><i class="fa fa-share-square-o"></i>&nbsp;  Share  |</div>
								 <div class = "widget_social_link" > 
									 
									<a target = "_blank" href = "http://www.facebook.com/sharer/sharer.php?u=<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/review/browse/'.$reviews[$i]['seokeyword']; ?>">
										Facebook
									</a>
									<span>*</span>
									
									<a target = "_blank"
									  href="https://twitter.com/share?
									  url=<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/review/browse/'.$reviews[$i]['seokeyword']; ?>							  
									  &text=<?php echo $reviews[$i]['reviewtitle']; ?>"  >
										Twitter
									</a>
									<span>*</span>
									
									<a target = "_blank" href = "http://www.linkedin.com/shareArticle?mini=true&url=<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/review/browse/'.$reviews[$i]['seokeyword']; ?>&amp;title=<?php echo $reviews[$i]['reviewtitle']; ?>">
										Linkedin
									</a>
									<span>*</span>
									
									<a href="https://plus.google.com/share?url=<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/review/browse/'.$reviews[$i]['seokeyword']; ?>" onclick="javascript:window.open(this.href,
									  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
									  Google
									</a>
									
								 </div>
								 <div class = "review_ratethis">
									<span>
									  <label>Was this review:</label>
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
									  <a href="<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/review/browse/'. $reviews[$i]['id']; ?>" title="Review This Company" class="dir-searchbtn" style="cursor:pointer !important;">Review It</a>
									  
										  <script>
											<?php $ip = $_SERVER['REMOTE_ADDR'];  ?>
											
											$(document).ready(function(){ 
											 $("#helpful_<?php echo $reviews[$i]['id'];?>").unbind('click').bind('click', function() {
												 var vote = 'helpful';
												 var reviewid = $(this).attr('reviewid');
												 check('<?php echo $ip;?>',reviewid,vote);
											   });
											   $("#funny_<?php echo $reviews[$i]['id'];?>").unbind('click').bind('click',function() {
												 var vote = 'funny';
												 var reviewid = $(this).attr('reviewid');
												 check('<?php echo $ip;?>',reviewid,vote);
											   });
											   $("#agree_<?php echo $reviews[$i]['id'];?>").unbind('click').bind('click',function() {
												 var vote = 'agree';
												 var reviewid = $(this).attr('reviewid');
												 check('<?php echo $ip;?>',reviewid,vote);
												 countme(reviewid,'disagree');
												 $('#disagree_'+reviewid).removeClass('vote-disable');
												 $('#disagree_'+reviewid).addClass('vote'); 
											   });
											   $("#disagree_<?php echo $reviews[$i]['id'];?>").unbind('click').bind('click',function() {
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
								<div class = "clear"></div>
							 </div>
							 
						 </div> 
						<?php
						} 
					} 
				} 
			}
			?>
			</div>
			
			<div class="holder"> </div>
			
			<link rel="stylesheet" href="<?php echo base_url(); ?>css/jPages.css" />
			<link rel="stylesheet" href="<?php echo base_url(); ?>css/animate.css" />
			<script type="text/javascript" src="<?php echo base_url();?>js/jPages.js"></script>
			
			<script>
				
				$(document).ready(function() 
				{	
										
					$("div.holder").jPages({
						
						containerID  : "itemContainer",
						previous    : "&#60;",
						next        : "&#62;",
						perPage      : 5
					
						});
					
					$("div.holder > a").click(function(){
						$('.review_tab_bottom').animate({scrollTop:0}, 'slow');
						});
											
			   });
			   $(".widget_share").toggle(function () {
				  $(this).parent().find(".widget_social_link").css('display', 'inline-block');
			   },function(){
				  $(this).parent().find(".widget_social_link").css('display', 'none');
			   });
			</script>
			
			
			<?php			 
			if( count($reviews)==0 ) 
			{ 
			?>
            <div class="form-message warning">
              <p>No Reviews.</p>
            </div>
            <?php 
            }
            ?>
            <div>
				
			
						
			</div>
    </div>
    
</div>

<script>
	$(document).ready(function() 
	{
		$('.tooltip').tooltipster({
		
			theme: 'widget-tooltip',
			position: 'bottom',
			contentAsHTML: true
		
		});
		
		$('.fancybox').fancybox();
		
		$('.widget_close').click(function(){
			$('.fancybox-overlay').hide();
		});
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

