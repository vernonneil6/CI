<?php echo $header;?>
<section class="container">
  <section class="main_contentarea">
    <div class="innr_wrap">
      <div class="p_realese_head"><a href="#"><img src="./images/YouGotRated_HeaderGraphics_press_release.png" alt="Press Realease" title="Business Directory"></a></div>
      <form class="p_realse_wrap" action="pressrelease/search" method="post">
        <div class="main_press_srchwrp">
          <div class="pres_srch_wrp">
            <div class="press_srchwrp">
              <input type="text" class="press_srch_txtbx" placeholder="SEARCH FOR PRESS RELEASE" required maxlength="20" name="searchpress" id="searchpress" value="<?php echo $keyword;?>">
              <input type="submit" class="press_srch_btn" title="Search" value="">
            </div>
          </div>
        </div>
        </form>
        <div class="pre_blckwrp">
          
          <?php if( count($pressreleases) > 0) { ?>
        <?php for($i=0; $i<count($pressreleases); $i++) { ?>
          
          
          
          <div class="pre_blck">
            <div class="pre_desc"><a href="<?php echo site_url('pressrelease/browse/'.$pressreleases[$i]['seokeyword']); ?>" title="view <?php echo stripslashes(ucfirst($pressreleases[$i]['title'])); ?>'s detail"> "<?php echo stripslashes(substr($pressreleases[$i]['sortdesc'],0,100)).'...'; ?>"</a></div>
            <div class="pre_titlewrp">
              <h3><a href="<?php echo site_url('company/'.$pressreleases[$i]['companyseokeyword'].'/reviews/coupons/complaints');?>" title="view <?php echo stripslashes(ucfirst($pressreleases[$i]['company'])); ?>'s detail"><?php echo stripslashes(ucfirst($pressreleases[$i]['company'])); ?></a></h3>
              <p><a href="<?php echo site_url('pressrelease/browse/'.$pressreleases[$i]['seokeyword']); ?>" title="view <?php echo stripslashes(ucfirst($pressreleases[$i]['title'])); ?>'s detail">"<?php echo stripslashes(ucfirst($pressreleases[$i]['title'])); ?>"</a></p>
            </div>
          </div>
          <?php } }else
		  {
		  ?>
          <div id="message-red">
              <table cellpadding="0" cellspacing="0" width="99%">
              <tr>
                <td class="red-left">No Records Found.</td>
                <td class="red-right"><a class="close-green" title="Close"><img src="<?php echo base_url(); ?>images/messages/icon_close_red.gif" alt="Close"/></a></td>
              </tr>
              </table>
            </div>
          <?php
		  }?>
        </div>
        <?php  if($this->pagination->create_links()) { ?>
       <div class="pagination"> <?php echo $this->pagination->create_links(); ?> </div>
        
        
		<?php } ?>
      
    </div>
  </section>
</section>
<?php echo $footer;?>