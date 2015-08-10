<?php echo $header;?>

<section class="container">
  <section class="main_contentarea">
    <div class="innr_wrap">
      <h1  class="bannertextcoupon bnrtxt">
		<span class="bannertextregular">Coupon, Deals </span>& Steals	
      </h1>

      <!-- Go to www.addthis.com/dashboard to customize your tools -->
				<div class="addthis_native_toolbox"></div> 

      <div class="coupon_wrap">
        <?php if(count($coupons)>0) {?>
        <?php for($i=0; $i<count($coupons); $i++) { ?>
        <div class="revw_blck">
          <div class="revw_blck_img"><a href="<?php echo site_url($coupons[$i]['seoslug']); ?>" title="view coupon detail"><img src="<?php if( strlen($coupons[$i]['image'])>5 ){ echo $this->common->get_setting_value('2').$this->config->item('coupon_thumb_upload_path');?><?php echo stripslashes($coupons[$i]['image']); } else{echo $this->common->get_setting_value('2').$this->config->item('company_thumb_upload_path')."/no_image.png"; } ?>" alt="YGR-<?php echo ucfirst(stripslashes($coupons[$i]['company'])); ?>-coupon" width="80px" height="65px"/></a> </div>
          <div class="revw_blck_cnt">
            <h2> <?php echo $coupons[$i]['company'];?> <span>EXPIRES: <?php echo date('m/d/Y',strtotime($coupons[$i]['enddate']));?></span></h2>
            <div class="coupon_dscrwrp">
              <div class="coupon_dscr">
                <div class="revw_desc"> 
				  <a title="Title">Title : <span><?php echo $coupons[$i]['title'];?></span> </a> <br/>
				  <a href="<?php echo $coupons[$i]['url']; ?>" title="Promocode" target="_blank" rel="nofollow">Promocode : <span><?php echo $coupons[$i]['promocode'];?></span> </a> <br/>
                  <a href="<?php echo site_url($coupons[$i]['seoslug']); ?>" title="Business Category"><span><?php echo ucfirst($coupons[$i]['category']);?></span> </a> </div>
              </div>
 		<?php if($coupons[$i]['logo']!='')
		{
		?>
 		<div class='couponlogoarea'><img src="<?php  echo 'uploads/company/thumb/'.$coupons[$i]['logo']; ?>" alt="YGR-<?php echo $coupons[$i]['company'];?>-Couponlogo" class='couponlogoimg' ></div>
		<?php
		}
		?>              
		<div class="offer_wrp"> <a href="<?php echo site_url($coupons[$i]['seoslug']); ?>"><img src="images/YouGotRated_Essential_ViewOffer.png" alt="YGR-ViewOffer-Image" title="View Offer"></a> </div>
            </div>
          </div>
        </div>
        <?php } }?>
      </div>
    </div>
  </section>
</section>
<?php echo $footer;?> 
