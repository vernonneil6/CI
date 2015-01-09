<?php echo $header; ?>
<section class="content-wrap" style="margin-right:0">
  <section class="inner_main">
    <!-- #content -->
    
    <div class="main_contentarea"> <?php echo $menu; ?>
      <?php if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'browse') ){ ?>
      <div class="dir_panel">
        <div class="dir_title">Press Releases</div>
        <?php if( count($pressrelease) > 0) { ?>
        <div class="main_dir">
          <div class="dir_maincontent" style="width:95%;">
            <div class="dir-image" style="max-height:100px !important;"> <a href="#<?php /* echo site_url('company/'.$pressrelease[0]['companyseokeyword'].'/reviews/coupons/complaints'); */?>" title="view <?php echo stripslashes(ucfirst($pressrelease[0]['company'])); ?>'s detail"><img src="<?php if( $pressrelease[0]['logo'] ){ echo $this->common->get_setting_value('2').$this->config->item('company_main_upload_path');?><?php echo stripslashes($pressrelease[0]['logo']); } else{echo $this->common->get_setting_value('2').$this->config->item('company_thumb_upload_path')."/no_image.png"; } ?>" alt="<?php echo stripslashes(ucfirst($pressrelease[0]['company'])); ?>" width="100px" height="100px"/></a> </div>
            <div class="dir_content_title" style="width:auto;"> <?php echo stripslashes(ucfirst($pressrelease[0]['title'])); ?><br/>
              <?php echo stripslashes(ucfirst($pressrelease[0]['subtitle'])); ?> </div>
            <div style="margin-top:20px;"> <?php echo nl2br(stripslashes($pressrelease[0]['sortdesc']));?></a> </div>
            <div style="margin-top:20px;"> <?php echo stripslashes($pressrelease[0]['presscontent']);?></a> </div>
          </div>
        </div>
        <?php } ?>
        <div> <span class="company_content_title"><?php echo $companyname;?></span><br/>
          <?php echo $aboutus;?><br/>
          <?php echo $address;?><br/>
          <a href="#<?php /*tel: $phone; */?>"><?php echo $phone;?></a> <br/>
          <a href="#<?php /*echo $url; */?>" title="<?php echo $url;?>"><?php echo $url;?></a>
          <div style="margin-top:5px;float:none;">
            <?php if( count($sems)>0 ) {?>
            <?php for($j=0;$j<count($sems);$j++){?>
            <a href="#<?php /* echo $sems[$j]['url']; */?>" title="<?php echo $sems[$j]['title']; ?>" > <img src="<?php echo base_url(); ?>uploads/companysem/thumb/<?php echo $sems[$j]['thumbimg']; ?>" title="<?php echo $sems[$j]['title']; ?>" width="30px;" height="30px;"/> </a>
            <?php
		
		} }?>
          </div>
        </div>
      </div>
      <?php } else { 
	 
		?>
      <div class="dir_panel">
        <div class="dir_title">Press Releases</div>
        <?php if( count($pressreleases) > 0) { ?>
        <?php for($i=0; $i<count($pressreleases); $i++) { ?>
        <div class="main_dir">
          <div class="dir_maincontent" style="width:95%;">
            <div class="dir-image" style="max-height:100px !important;"> <a href="#<?php /* echo site_url('company/'.$pressreleases[$i]['companyseokeyword'].'/reviews/coupons/complaints'); */?>" title="view <?php echo stripslashes(ucfirst($pressreleases[$i]['company'])); ?>'s detail"><img src="<?php if( $pressreleases[$i]['logo'] ){ echo $this->common->get_setting_value('2').$this->config->item('company_main_upload_path');?><?php echo stripslashes($pressreleases[$i]['logo']); } else{echo $this->common->get_setting_value('2').$this->config->item('company_main_upload_path')."/no_image.png"; } ?>" alt="<?php echo stripslashes(ucfirst($pressreleases[$i]['company'])); ?>" width="100px" height="100px"/></a> </div>
            <div class="dir_content_title" style="width:auto;"> <a href="<?php echo site_url('pressrelease/browse/'.$pressreleases[$i]['seokeyword']); ?>" title="view <?php echo stripslashes(ucfirst($pressreleases[$i]['title'])); ?>'s detail"><?php echo stripslashes(ucfirst($pressreleases[$i]['title'])); ?></a> By <a href="#<?php /*echo site_url('company/'.$pressreleases[$i]['companyseokeyword'].'/reviews/coupons/complaints');*/?>" title="view <?php echo stripslashes(ucfirst($pressreleases[$i]['company'])); ?>'s detail"><?php echo stripslashes(ucfirst($pressreleases[$i]['company'])); ?></a><br/>
              <a href="<?php echo site_url('pressrelease/browse/'.$pressreleases[$i]['seokeyword']); ?>" title="view <?php echo stripslashes(ucfirst($pressreleases[$i]['title'])); ?>'s detail"><?php echo substr(stripslashes(($pressreleases[$i]['subtitle'])),0,50).'...'; ?></a> </div>
            <div style="margin-top:20px;" class="user_view"> <a href="<?php echo site_url('pressrelease/browse/'.$pressreleases[$i]['seokeyword']); ?>" title="view <?php echo stripslashes(ucfirst($pressreleases[$i]['title'])); ?>'s detail"><?php echo substr(nl2br(stripslashes($pressreleases[$i]['sortdesc'])),0,300)."...Read More";?></a> </div>
          </div>
        </div>
        <?php } ?>
        <?php  if($this->pagination->create_links()) { ?>
        <tr style="background:#ffffff">
          <td></td>
          <td></td>
          <td></td>
          <?php  if($this->pagination->create_links()) { ?>
          <div class="pagination pagination-centered"> <?php echo $this->pagination->create_links(); ?> </div>
          <?php } ?>
        </tr>
        <?php } ?>
      </div>
      <?php } else { ?>
      <!-- Warning form message -->
      <div class="form-message warning">
        <p>No Records found.</p>
      </div>
      <?php } ?>
      <?php 
	  }
	   ?>
      <?php if($bottomads){ ?>
      <div class="ad_bottom"><a href="<?php echo $bottomads[0]['url'];?>" title="" target="_blank"><img src="<?php if( $bottomads[0]['image'] ) { echo $this->common->get_setting_value('2').$this->config->item('ad_main_upload_path');?><?php echo stripslashes($bottomads[0]['image']); } ?>" alt="topads" width="940" height="180" class="adimg"/></a> </div>
      <?php } ?>
    </div>
    <!-- /#content -->
    </div>
  </section>
  
  <!--  <a href="tel:+1-800-555-5555">Call 1-800-555-5555</a>-->
</section>
<?php echo $footer; ?>