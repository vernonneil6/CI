<?php echo $header;
$elitemem_status = $this->common->get_eliteship_bycompanyid($complaints[0]['companyid']);
?>
<script type="text/javascript">
	$(document).ready(function(){
		$( ".stars" ).each(function() { 
			// Get the value
			var val = $(this).data("rating");
			// Make sure that the value is in 0 - 5 range, multiply to get width
			var size = Math.max(0, (Math.min(5, val))) * 23;
			// Create stars holder
			var $span = $('<span />').width(size);
			// Replace the numerical value with stars
			$(this).html($span);
		});
	});
</script>
<section class="container">
  <section class="main_contentarea">
    <div class="verified_wrp pr_rwrp compli_detail">
        <?php if(count($elitemem_status)==0){?>
        <div class="vry_logo verified_browse"> <a href="<?php echo site_url('company/'.$complaints[0]['companyseokeyword'].'/reviews/coupons/complaints');?>" title="view company Detail"><img src="images/notverified.png" class = "reviewnotverifiedlogos" alt="YGR-<?php echo ucfirst(stripslashes($complaints[0]['company'])); ?>-Notverified-logo" /></a> </div>
        <?php }else{
				  ?>
        <div class="vry_logo verified_browse"> <a href="<?php echo site_url('company/'.$complaints[0]['companyseokeyword'].'/reviews/coupons/complaints');?>" title="view company Detail"><img src="images/verifiedlogo.jpg" class = "reviewverifiedlogo" alt="YGR-<?php echo ucfirst(stripslashes($complaints[0]['company'])); ?>-Verified-logo" /></a> </div>
        <?php
				  } ?>
     
      
      <div class="compny_name">
        <h1><?php echo (stripslashes($complaints[0]['company'])); ?></h1>
          <?php if(count($elitemem_status)==0){?>
			<a href="http://business.yougotrated.com/?elitemem=<?php echo $complaints[0]['companyid'] ?>" title="Upgrade to Elite">
					<img class="notverfiedimg" src="images/YouGotRated_BusinessProfile_NotVerified-CompanyHeaderText.jpg" alt="YGR-BusinessProfile-NotVerified">
				<div class="business_link complink"> 			
					IS THIS YOUR BUSINESS? CLICK HERE TO BECOME VERIFIED			
				</div>
			</a>
			
		  <?php } else { ?>
			  
			 <a href="<?php echo site_url('company/'.urlencode($complaints[0]['comseokeyword']).'/reviews/coupons/complaints');?>" title="view company Detail"><div class="vrytitle verifytag">YouGotRated VERIFIED MERCHANT</div></a>
			  
		  <?php } ?>	
         
          <?php 
		//get avg star by cmpyid
		$avgstar = $this->common->get_avg_ratings_bycmid($complaints[0]['companyid']);
		$itemproaverage = $avgstar;
		$avgstar = round($avgstar);
		 
		 if($avgstar < 2) {
		 ?>
          <div class="vry_rating comprates">
			<div class ="count-<?php echo $avgstar?>">  
            <?php for($r=0;$r<($avgstar);$r++){?>
			<i class="vry_rat_icn"></i>
            <?php } ?>
          </div>  
            <?php for($p=0;$p<(5-($avgstar));$p++){?>
			<img src="images/no_star.png" alt="no_star" title="no_star" />
            <?php } } else {?>
				<span class="stars" data-rating="<?php echo $itemproaverage; ?>"></span>
            <?php } ?>
          </div>
        <div class="vry_btn compbtn"><a href="<?php echo site_url('review/add/'.$complaints[0]['companyid']);?>" title="Write review">WRITE REVIEW</a> <a href="<?php echo site_url('complaint/add/'.$complaints[0]['companyid']);?>" title="File Complaint">FILE COMPLAINT</a></div>
     

      </div>
      
    </div>
    <div class="pr_detlwrp">
		 <!-- Go to www.addthis.com/dashboard to customize your tools -->
				<div class="addthis_native_toolbox"></div>
      <div class="titl_pr_rel">
        <div class="pre_rls_rating"> </div>
        <h1>"COMPLAINT AGAINST <?php echo strtoupper(stripslashes($complaints[0]['company'])); ?>"</h1>
        <p>- <?php echo date('m/d/Y',strtotime($complaints[0]['complaindate']));;?> -</p>
      </div>
      <div class="pr_countwrp"> </div>
      <div class="pr_testmnl_wrp">
        <p class = "browse_ptag">"<?php echo $complaints[0]['detail'];?>"</p>
        <?php $user=$this->users->get_user_byid($complaints[0]['userid']);
				if(count($user)>0){
				?>
        <div class="testmnl_clntwrp browse_user">
          <div class="clnt_intr"><div class="hypen">-</div>
            <div class="clnt_pic"> 
				<?php if($user[0]['avatarthum']==null) {?>
					<a href="<?php echo site_url('complaint/viewuser/'.$complaints[0]['companyid'].'/'.$complaints[0]['userid']);?>" title="view profile">
						<img src="images/default_user.png" alt="YGR-Default-UserImage" title="Default User Image"> 
					</a>
				   <?php } else { ?>
					  <img src="uploads/user/thumb/<?php echo $user[0]['avatarthum'];?>" alt="YGR-User-image" title="User image">
				   <?php } ?>
				
			</div>
            <div class="clnt_name">
              <h4><a href="<?php echo site_url('complaint/viewuser/'.$complaints[0]['companyid'].'/'.$complaints[0]['userid']);?>" title="view profile"><?php echo $user[0]['username'];?></a></h4>
               <h4><?php echo $user[0]['city'];?></h4>
            <h4><?php echo $user[0]['state'];?></h4>
            </div>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
    <?php if(count($othercomplaints)>0){?>
	<div class="cmnts_mainwrp">
      <h2>MORE COMPLAINTS AGAINST THIS BUSINESS</h2>
      <?php for($j=0;$j<count($othercomplaints);$j++){?>
      <div class="cmnt_blckwrp">
        <div class="clnt_intr cmt_lft lefter">
          <div class="clnt_name txt_right righter">
            <h4 class="namespace"><?php echo $othercomplaints[$j]['username'];?></h4>
            
            
          </div>
          <div class="clnt_pic photo"> 
			  <?php if($othercomplaints[$j]['avatarthum']==null) {?>
					<img src="images/default_user.png" alt="YGR-Default-UserImage" title="Default User Image"> 
			  <?php } else { ?>
					<img src="uploads/user/thumb/<?php echo $othercomplaints[$j]['avatarthum'];?>" alt="User image" title="User image">
			  <?php } ?>
        </div>
        <div class="review_rgt cmnt_dscr">
          <p><?php echo $othercomplaints[$j]['detail'];?></p>
        </div>
      </div>
      <?php } ?>
    </div>
    <?php } ?>
  </section>
</section>
<?php echo $footer;?>
