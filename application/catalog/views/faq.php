<?php echo $header; ?>

<section class="content-wrap" style="margin-right:0">
  <section class="inner_main">
    <div class="main_contentarea">
        <h1 class="page_ti"><?php echo $section_title;?></h1>
      <?php if( count($faqs) > 0 ) { ?>
      <!-- table -->
      <table border="0" width="96%">
        <?php for($i=0;$i<count($faqs);$i++) { ?>
        <tr>
          <table width="95%" border="0" style="margin-bottom:10px;border-bottom: 1px solid #CCCCCC;">
            <tr>
              <td class="login_box_title" style="font-size:20px;"><?php echo nl2br(stripslashes(ucfirst($faqs[$i]['question'])));?></td>
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
      
  
          
      </div>
    </div>
  </section>
</section>
<?php echo $footer; ?> 