<?php echo $header;?>
<script type="text/javascript" language="javascript">
              $(document).ready(function() {
				  $('#divcouponshare').hide();
               $('#couponshare').click(function() {
				   $('#divcouponshare').toggle();
				   
			   });
              });
          </script>

<section class="container">
  <section class="main_contentarea">
    <?php  	$avgstar = $this->common->get_avg_ratings_bycmid($coupons[0]['companyid']);
			$avgstar = round($avgstar);
			$elitemem_status = $this->common->get_eliteship_bycompanyid($coupons[0]['companyid']);
			?>
      <div class="verified_wrp pr_rwrp pr_rwrp">

        <?php if(count($elitemem_status)==0){?>
        <div class="vry_logo"> <a href="<?php echo site_url('company/'.$coupons[0]['companyseokeyword'].'/reviews/coupons/complaints');?>" title="view company Detail"><img src="images/notverified.png" class="reviewnotverifiedlogo" alt="<?php echo ucfirst(stripslashes($coupons[0]['company'])); ?>" /></a> </div>
        <?php }else{ ?>
        <div class="vry_logo"> <a href="<?php echo site_url('company/'.$coupons[0]['companyseokeyword'].'/reviews/coupons/complaints');?>" title="view company Detail"><img src="images/verifiedlogo.jpg" class="reviewverifiedlogo" alt="<?php echo ucfirst(stripslashes($coupons[0]['company'])); ?>" /></a> </div>
        <?php  } ?>
				  
        <?php if(count($elitemem_status)==0){?>
       <div class="bsntvry_title bsntitle">
          <img src = <?php echo base_url()."images/YouGotRated_BusinessProfile_NotVerified-CompanyHeaderText.jpg";  ?>  class = "bsnntverified">
          <div class="bsvry_tag bsntg"> <span>IS THIS YOUR BUSINESS?</span>
            <p><a href="solution/claimbusiness" title="CLICK HERE TO BECOME VERIFIED">CLICK HERE TO BECOME VERIFIED</a></p>
          </div>
        </div>
        
        <?php }else { ?>
        <div class="vry_title"></div>
        <?php } ?>
        <div class="compny_name">
          <h1><?php echo $coupons[0]['company'];?></h1>
          <?php 

		$avgstar = $this->common->get_avg_ratings_bycmid($coupons[0]['companyid']);
		$avgstar = round($avgstar);
		;?>
          <div class="vry_rating ratess">
            <?php for($r=0;$r<($avgstar);$r++){?>
            <i class="vry_rat_icn"></i>
            <?php } ?>
            <?php for($p=0;$p<(5-($avgstar));$p++){?>
            <img src="images/no_star.png" alt="no_star" title="no_star" />
            <?php } ?>
          </div>
        </div>
        <div class="vry_btn">
			<a href="<?php echo base_url('review/add/'.$coupons[0]['companyid']);?>" title="Write review">WRITE REVIEW</a>
			<?php if(count($elitemem_status)!=0){?>		 
			<a href="<?php echo site_url('complaint/add');?>" title="File Complaint">FILE COMPLAINT</a>
			<?php } ?>		
		</div>
      </div>
    <div class="pr_detlwrp">
      <div class="titl_pr_rel">
        <div class="pre_rls_rating"> </div>
        <h1>"COUPON OF <?php echo strtoupper(stripslashes($coupons[0]['company'])); ?>"</h1>
        <p>-
          <?php 
			$dbdate = date('m/d/Y',strtotime($coupons[0]['enddate']));
			echo $dbdate;?>
          -</p>
      </div>
      <div class="pr_countwrp"> </div>
      <div class="pr_testmnl_wrp">
	  <?php echo ucwords($coupons[0]['title']);?><br/>
      <a href="<?php echo $coupons[0]['url'];?>" target="_blank" title="Promocode" rel="nofollow" style="color:#333333;"> <?php echo "Promocode: ";?><span><?php echo $coupons[0]['promocode'];?></span> </a><br/>
        <?php echo "Expires: ";?><?php echo date('m/d/Y',strtotime($dbdate));?><br/>
        <?php echo "Category: ";?><?php echo $coupons[0]['category'];?><br/>
        <span id="couponshare" class="shareitcoupon">Share it</span>
        <div id="divcouponshare" style="display:block;">
        <input type="text"  class="txt_box" value="<?php 
echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
?>
" style="width:600px;" /></div>
            
         </div>
    </div>
    <?php if(count($othercoupons)>0){?>
    <div class="cmnt_mainwrp">
      <h2 class = "font_size_2">OTHER COUPONS FROM  <?php echo strtoupper(stripslashes($coupons[0]['company'])); ?></h2>
      <?php for($j=0;$j<count($othercoupons);$j++){?>
      <div class="cmnt_blckwrp">
        <div class="clnt_intr cmt_lft coupon_left">
          <div class="clnt_name txt_right">
            <h4><?php echo (stripslashes($coupons[0]['company'])); ?></h4>
          </div>
          <div class="clnt_pic"> <img src="images/default_user.png" alt="Client Image" title="Client Image"></a> </div>
        </div>
        <div class="review_rgt cmnt_dscr">
          <p><?php echo $othercoupons[$j]['title'];?></p>
          <p><a href="<?php echo $othercoupons[$j]['url'];?>" target="_blank" title="Promocode" rel="nofollow"> <?php echo "Promocode: ";?><span><?php echo $othercoupons[$j]['promocode'];?></span> </a></p>
          <p><?php echo "Expires: ";?>
            <?php 
			$dbdate = date('m/d/Y',strtotime($othercoupons[$j]['enddate']));
			echo $dbdate;?>
          </p>
        </div>
      </div>
      <?php } ?>
    </div>
    <?php } ?>
  </section>
</section>
<?php echo $footer;?>
