<?php echo $header; ?>

<section class="content-wrap" style="margin-right:0">
  <section class="inner_main">
    <div class="main_contentarea"> <?php echo $menu; ?>
        <div class="dir_title" style="margin-top:20px;"><?php echo $section_title;?></div>
      <?php if( count($faqs) > 0 ) { ?>
      <!-- table -->
      <table border="0" width="100%">
        <?php for($i=0;$i<count($faqs);$i++) { ?>
        <tr>
          <table width="100%" border="0" style="margin-bottom:10px;border-bottom: 1px solid #CCCCCC;">
            <tr>
              <td class="login_box_title" style="font-size:20px;"><?php echo nl2br(stripslashes($faqs[$i]['question']));?></td>
            </tr>
            <tr>
              <td style="font-size:14px;line-height:17px"><?php echo nl2br(stripslashes($faqs[$i]['answer']));?></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            
          </table>
        </tr>
        <?php } ?>
      </table>
      <!-- table -->
      <?php } ?>
      
     <?php if($bottomads){ ?>
       <div class="ad_bottom"><a href="<?php echo $topads[0]['url'];?>" title="" target="_blank"><img src="<?php if( $bottomads[0]['image'] ) { echo $this->common->get_setting_value('2').$this->config->item('ad_main_upload_path');?><?php echo stripslashes($bottomads[0]['image']); } ?>" alt="topads" width="940" height="180" class="adimg"/></a> </div>
     
		  <?php } ?>
          
      </div>
    </div>
  </section>
</section>
<?php echo $footer; ?> 