<?php echo $header; ?>
<section class="content-wrap" style="margin-right:0">
  <section class="inner_main">
    <!-- #content -->
    
    <div class="main_contentarea"> <?php echo $menu; ?>
      
      <div class="left_content_panel">
        <div class="treding_title">Trending  Searches <span>Last 7 Days</span></div>
        <div class="treding_lnk">
          <?php if(count($keywords)>0){?>
          <?php for($i=0; $i<count($keywords); $i++)
                { 
								?>
          <a title="Search <?php echo $keywords[$i]['keyword'];?>" href="<?php echo site_url('complaint/keysearch').'/'.$keywords[$i]['keyword'];?>"><?php echo $keywords[$i]['keyword'];?></a>
          <?php }
                ?>
          <?php } ?>
        </div>
        <table border="0" align="left">
          <tr>
            <td width="40px"><span class="company_content_title">&nbsp;&nbsp;Do you have a complaint?</span></td>
          </tr>
          <tr>
            <td class="company_dsr">Start with the name of the Company, Person or a Phone Number. Then select the complaint type to get started.</td>
          </tr>
          <tr>
            <td><div style="margin-top:5px;margin-bottom:5px;" align="right" class="my"> <a href="<?php echo site_url('welcome');?>" title="submit a complaint"><?php echo form_input(array('name'=>'btnsubmit','id'=>'btnphone','class'=>'complaint_btn','type'=>'submit','value'=>'Submit a complaint','style'=>'padding:7px 25px;cursor: pointer;')); ?></a> </div></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
        </table>
        <?php if($leftads){ ?>
        <div><a href="<?php echo $leftads[0]['url'];?>" title="Advertisement" target="_blank" rel="nofollow"><img src="<?php if( $leftads[0]['image'] ) { echo $this->common->get_setting_value('2').$this->config->item('ad_main_upload_path');?><?php echo stripslashes($leftads[0]['image']); } ?>" alt="Advertisement" width="280" height="180" class="adimg"/></a> </div>
        <?php } ?>
      </div>
      <div class="right_content_panel">
        <div class="treding_title">
          <h1 style="font-size:24px !important;">Yougotrated Live</h1>
        </div>
        <?php if(count($coupons)){ ?>
        <?php for($i=0; $i<count($coupons); $i++) { ?>
        <div class="main_livepost">
          <div class="view_all"> <a href="<?php echo site_url('company').'/'.$coupons[$i]['companyseokeyword'].'/reviews/coupons/complaints';?>" title="view all"> <span>
            <h3>
              <?php $num=$this->coupons->get_coupon_bycompanyid($coupons[$i]['companyid']);?>
              <?php if(count($num)>0){?>
              <?php echo count($num);?>
              <?php }else{"0";}?>
            </h3>
            Related<br>
            Coupons </span></a> <!--<span>--><a href="<?php echo site_url('company').'/'.$coupons[$i]['companyseokeyword'].'/reviews/coupons/complaints';?>" title="view all">View All</a><!--</span>--> </div>
          <div class="post_maincontent">
            <div class="side-image"> <a href="<?php echo site_url('coupon/browse/'.$coupons[$i]['seokeyword']); ?>" title="view coupon detail"><img src="<?php if( $coupons[$i]['image'] ){ echo $this->common->get_setting_value('2').$this->config->item('coupon_thumb_upload_path');?><?php echo stripslashes($coupons[$i]['image']); } else{echo $this->common->get_setting_value('2').$this->config->item('company_thumb_upload_path')."/no_image.png"; } ?>" alt="<?php echo ucfirst(stripslashes($coupons[$i]['company'])); ?>" width="100px" height="40px"/></a> </div>
            <div class="post_content_title"><a href="<?php echo site_url('coupon/browse/'.$coupons[$i]['seokeyword']); ?>" title="view coupon detail"><?php echo ucfirst(stripslashes($coupons[$i]['company'])); ?></a></div>
            <div class="post_content_dscr user_view" style="margin-top:2px;"> <a href="<?php echo site_url('coupon/browse/'.$coupons[$i]['seokeyword']); ?>" title="view coupon detail"><?php echo strtolower(stripslashes($coupons[$i]['title'])); ?></a> </div>
            <?php 
                        $date = date_default_timezone_set('Asia/Kolkata');                             
                        $dbdate = date('Y-m-d',strtotime($coupons[$i]['enddate']));
                        $today = date('m/d/Y');
                        $d1 = strtotime(date('Y-m-d H:i:s'));
                        $d2 = strtotime($coupons[$i]['enddate']);
                        $newdate =round(($d1-$d2)/60);
                        if($newdate > 60){$diff = round(($d1-$d2)/60/60).' hours ago';}else{$diff = $newdate.' minutes ago';}
                        ?>
            <div class="timing"> <a href="<?php echo $coupons[$i]['url']; ?>" title="Advertisement" target="_blank" rel="nofollow">Promocode : <span><?php echo $coupons[$i]['promocode'];?></span> </a> </div>
            <div class="timing"> <a href="<?php echo site_url('coupon/browse/'.$coupons[$i]['seokeyword']); ?>" title="view coupon detail">Expires : <span><?php echo date('m/d/Y',strtotime($dbdate));?></span> </a> </div>
            <div class="timing"> <a href="<?php echo site_url('coupon/browse/'.$coupons[$i]['seokeyword']); ?>" title="Business Category"><span><?php echo ucfirst($coupons[$i]['category']);?></span> </a> </div>
          </div>
        </div>
        <?php } ?>
        <?php  if($this->pagination->create_links()) { ?>
        <tr style="background:#ffffff">
          <td></td>
          <td></td>
          <td></td>
          <td style="padding:10px"><div class="pagination"><?php echo $this->pagination->create_links(); ?></div></td>
        </tr>
        <?php } } else { ?>
        <div class="main_livepost">
          <div class="post_maincontent">
            <div class="form-message warning">
              <p>No coupons.</p>
            </div>
          </div>
        </div>
        <?php } ?>
      </div>
      
    </div>
    </div>
    <!-- /#content --> 
  </section>
</section>
<?php echo $footer; ?>