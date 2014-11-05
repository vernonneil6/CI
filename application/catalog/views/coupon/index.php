<?php echo $header;?>

<section class="container">
  <section class="main_contentarea">
    <div class="innr_wrap">
      <h1  class="bannertextcoupon"><!--<a href="" style="margin-left:-25px;"><img src="images/YouGotRated_HeaderGraphics_CouponsDealsSteals.png" alt="CouponsDealsSteals" title="CouponsDealsSteals"></a>-->
		<span class="bannertextregular">Coupon,Deals </span>& Steals	
      </h1>
      <div class="coupon_wrap">
        <?php if(count($coupons)>0) {?>
        <?php for($i=0; $i<count($coupons); $i++) { ?>
        <div class="revw_blck">
          <div class="revw_blck_img"><a href="<?php echo site_url('coupon/browse/'.$coupons[$i]['seokeyword']); ?>" title="view coupon detail"><img src="<?php if( strlen($coupons[$i]['image'])>5 ){ echo $this->common->get_setting_value('2').$this->config->item('coupon_thumb_upload_path');?><?php echo stripslashes($coupons[$i]['image']); } else{echo $this->common->get_setting_value('2').$this->config->item('company_thumb_upload_path')."/no_image.png"; } ?>" alt="<?php echo ucfirst(stripslashes($coupons[$i]['company'])); ?>" width="100px" height="60px"/></a> </div>
          <div class="revw_blck_cnt">
            <h2><?php echo $coupons[$i]['title'];?> <span>EXPIRES: <?php echo date('d.m.Y',strtotime($coupons[$i]['enddate']));?></span></h2>
            <div class="coupon_dscrwrp">
              <div class="coupon_dscr">
                <div class="revw_desc"> <a href="<?php echo $coupons[$i]['url']; ?>" title="Promocode" target="_blank" rel="nofollow">Promocode : <span><?php echo $coupons[$i]['promocode'];?></span> </a> <br/>
                  <a href="<?php echo site_url('coupon/browse/'.$coupons[$i]['seokeyword']); ?>" title="Business Category"><span><?php echo ucfirst($coupons[$i]['category']);?></span> </a> </div>
              </div>
 		<?php if($coupons[$i]['logo']!='')
		{
		?>
 		<div class='couponlogoarea'><img src="<?php  echo 'uploads/company/thumb/'.$coupons[$i]['logo']; ?>" class='couponlogoimg' ></div>
		<?php
		}
		?>              
		<div class="offer_wrp"> <a href="<?php echo site_url('coupon/browse/'.$coupons[$i]['seokeyword']); ?>"><img src="images/YouGotRated_Essential_ViewOffer.png" alt="View Offer" title="View Offer"></a> </div>
            </div>
          </div>
        </div>
        <?php } }?>
      </div>
    </div>
  </section>
</section>
<?php echo $footer;?> 