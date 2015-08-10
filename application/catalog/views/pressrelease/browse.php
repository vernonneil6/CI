<?php echo $header; ?>

<section class="container">
  <section class="main_contentarea">
    <div class="innr_wrap">
      <?php //echo $menu; ?>
      <h1 class="page_ti"><?php echo stripslashes(ucfirst($pressrelease[0]['title'])); ?></h1>
      <div><?php echo stripslashes(ucfirst($pressrelease[0]['subtitle'])); ?></div>
      <div><?php echo nl2br(stripslashes($pressrelease[0]['sortdesc']));?></div>
      <div><?php echo stripslashes($pressrelease[0]['presscontent']);?></div>
      <div><?php echo $content; ?></div>
      <div><span class="company_content_title"><?php echo $companyname;?></span>
      <br/><?php echo $address;?><br/>
        <a href="tel:<?php echo $phone;?>"><?php echo $phone;?></a> <br/>
        <a href="<?php echo $url;?>" title="<?php echo $url;?>" target="_blank"><?php echo $url;?></a>
        <div style="margin-top:5px;float:none;">
          <?php if( count($sems)>0 ) {?>
          <?php for($j=0;$j<count($sems);$j++){?>
          <a href="<?php echo $sems[$j]['url'];?>" title="<?php echo $sems[$j]['title']; ?>" target="_blank"> <img src="<?php echo base_url(); ?>uploads/companysem/thumb/<?php echo $sems[$j]['thumbimg']; ?>" title="<?php echo $sems[$j]['title']; ?>" width="30px;" height="30px;" alt="YGR-<?php echo $sems[$j]['title']; ?>"/> </a>
          <?php
		
		} }?>
        </div>
      </div>
      
    </div>
    </div>
    <div> </div>
  </section>
</section>
<?php echo $footer; ?> 
