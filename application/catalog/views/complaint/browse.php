<?php echo $header;
$elitemem_status = $this->common->get_eliteship_bycompanyid($complaints[0]['companyid']);
?>

<section class="container">
  <section class="main_contentarea">
    <div class="verified_wrp pr_rwrp">
        <?php if(count($elitemem_status)==0){?>
        <div class="vry_logo verified_browse"> <a href="<?php echo site_url('company/'.$complaints[0]['companyseokeyword'].'/reviews/coupons/complaints');?>" title="view company Detail"><img src="images/notverified.png" class = "reviewnotverifiedlogo" alt="<?php echo ucfirst(stripslashes($complaints[0]['company'])); ?>" /></a> </div>
        <?php }else{
				  ?>
        <div class="vry_logo verified_browse"> <a href="<?php echo site_url('company/'.$complaints[0]['companyseokeyword'].'/reviews/coupons/complaints');?>" title="view company Detail"><img src="images/verifiedlogo.jpg" class = "reviewverifiedlogo" alt="<?php echo ucfirst(stripslashes($complaints[0]['company'])); ?>" /></a> </div>
        <?php
				  } ?>
        <?php if(count($elitemem_status)==0){?>
        <div class="bsntvry_title">
          <div class="bsvry_tag"> <span>IS THIS YOUR BUSINESS?</span>
            <p><a href="solution/claimbusiness" title="CLICK HERE TO BECOME VERIFIED">CLICK HERE TO BECOME VERIFIED</a></p>
          </div>
        </div>
        <?php }else { ?>
        <div class="vry_title"></div>
        <?php } ?>
      
      <div class="compny_name">
        <h1><?php echo (stripslashes($complaints[0]['company'])); ?></h1>
                  <?php 
		//get avg star by cmpyid
		$avgstar = $this->common->get_avg_ratings_bycmid($complaints[0]['companyid']);
		$avgstar = round($avgstar);
		;?>
          <div class="vry_rating">
            <?php for($r=0;$r<($avgstar);$r++){?>
            <i class="vry_rat_icn"></i>
            <?php } ?>
            <?php for($p=0;$p<(5-($avgstar));$p++){?>
            <img src="images/no_star.png" alt="no_star" title="no_star" />
            <?php } ?>
          </div>
      </div>
      <div class="vry_btn"><a href="<?php echo site_url('review/add/'.$complaints[0]['companyid']);?>" title="Write review">WRITE REVIEW</a> <a href="<?php echo site_url('complaint/add/'.$complaints[0]['companyid']);?>" title="File Complaint">FILE COMPLAINT</a></div>
      
    </div>
    <div class="pr_detlwrp">
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
          <div class="clnt_intr"> - &nbsp;&nbsp;
            <div class="clnt_pic"> <a href="<?php echo site_url('complaint/viewuser/'.$complaints[0]['companyid'].'/'.$complaints[0]['userid']);?>" title="view profile"><img src="images/default_user.png" alt="Client Image" title="Client Image"> </a></div>
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
	<div class="cmnt_mainwrp">
      <h2 class="textbanner">MORE COMPLAINTS AGAINST THIS BUSINESS</h2>
      <?php for($j=0;$j<count($othercomplaints);$j++){?>
      <div class="cmnt_blckwrp">
        <div class="clnt_intr cmt_lft lefter">
          <div class="clnt_name txt_right righter">
            <h4 class="namespace"><?php echo $othercomplaints[$j]['username'];?></h4>
            
            
          </div>
          <div class="clnt_pic photo"> <img src="images/default_user.png" alt="Client Image" title="Client Image"> </div>
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
