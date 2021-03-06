<?php echo $header;?>
<script type="text/javascript">
	$(document).ready(function(){
		$( ".stars" ).each(function() { 
			// Get the value
			var val = $(this).data("rating");
			// Make sure that the value is in 0 - 5 range, multiply to get width
			var size = Math.max(0, (Math.min(5, val))) * 23;
			// Create stars holder
			var $span = $('<span />').width(size);
			// Replace the numerical value with stars
			$(this).html($span);
		});
	});
</script>
<section class="container">
  <section class="main_contentarea serch_result">
    
    <div class="srch_rslt_wrp">
      <div class="main_bd_srchwrp bd_scr">
        <div class="bdsrch_wrp bd_wp">
          <h2>Search results for <?php echo $this->uri->segment(3);?> category</h2>
          
        </div>
      </div>
      <?php if( count($companies) > 0) { ?>
      <?php for($i=0; $i<count($companies); $i++) { ?>
      <?php $avgstar = $this->common->get_avg_ratings_bycmid($companies[$i]['id']);
			$itemproaverage = $avgstar;
			$avgstar = round($avgstar);
			$elitemem_status = $this->common->get_eliteship_bycompanyid($companies[$i]['id']);
			
			?>
      <div class="srch_result_blck">
        <div class="innr_wrap">
          <div class="srch_rslt_left">
            <div class="verified_wrp srch_rslt_vrfy">
              <?php if(count($elitemem_status)==0){?>
              <div class="vry_logo"> <a href="<?php echo site_url($companies[$i]['seoslug']);?>" title="view company Detail" target="_blank"><img src="images/notverified.png" class="reviewverifiedlogo marginlogo" alt="<?php echo ucfirst(stripslashes($companies[$i]['company'])); ?> Notverified Seal" /></a> </div>
              <?php }else{
				  ?>
              <div class="vry_logo"> <a href="<?php echo site_url($companies[$i]['seoslug']);?>" title="view company Detail" target="_blank"><img src="images/verifiedlogo.jpg" class="reviewverifiedlogo marginlogo" alt="<?php echo ucfirst(stripslashes($companies[$i]['company'])); ?> Verified Seal" /></a> </div>    
                  <?php
				  } ?>
              <!--<php if(count($elitemem_status)==0){?>
              <div class="notvry_title"></div>
              <php }else{
				  ?>
              <div class="vry_title"></div>
              <php
				  } ?>-->
              <div class="compny_name">
                <h2>
				<a href="<?php echo site_url($companies[$i]['seoslug']);?>" title="view company Detail" style="height:auto;color:#333333 !important;" target="_blank">
				<?php echo strtoupper($companies[$i]['company']);?>
                </a>
                </h2>
                 <div class="vry_rating">
                  <span class="stars" data-rating="<?php echo $itemproaverage; ?>"></span>
                </div>
              </div>
             
               
              
              <div class="vry_btn"><a href="review/add/<?php echo $companies[$i]['id'];?>" title="Write review">WRITE REVIEW</a> <a href="<?php echo site_url('complaint/add');?>" title="File Complaint"> FILE COMPLAINT</a></div>
            </div>
            <div class="contct_dtl cntdll">
              <ul>
                <li><span>ADDRESS</span> <a> <?php echo ucfirst($companies[$i]['streetaddress']);?>,&nbsp;&nbsp;&nbsp;<?php echo ucfirst($companies[$i]['city']);?>,&nbsp;&nbsp;&nbsp;<?php echo ucfirst($companies[$i]['state']);?>,&nbsp;&nbsp;&nbsp;<?php echo ucfirst($companies[$i]['country']);?>,&nbsp;&nbsp;&nbsp;<?php echo ($companies[$i]['zip']);?> </a></li>
                <li><span>PHONE</span> <a href="tel:<?php echo ($companies[$i]['phone']);?>" title="call us"><?php echo ($companies[$i]['phone']);?></a></li>
                <!--<li><span>FAX</span> <a href="" title="Fax"><php echo ($companies[$i]['fax']);?></a></li>-->
                <li><span>WEBSITE</span> <a href="<?php echo (strpos($companies[$i]['siteurl'],'http') !== false) ? '' :'//'; echo  ($companies[$i]['siteurl']);?>" title="company website"><?php echo ($companies[$i]['siteurl']);?></a></li>
                <li><span>E-MAIL</span> <a href="mailto:<?php echo ($companies[$i]['email']);?>" title="mail us"><?php echo ($companies[$i]['email']);?></a></li>
              </ul>
            </div>
          </div>
          <?php 
			  $mapaddress = stripslashes($companies[$i]['streetaddress'].','.$companies[$i]['city'].','.$companies[$i]['state'].','.$companies[$i]['country'].','.$companies[$i]['zip']);
			  $string = str_replace(' ', '-', $mapaddress); // Replaces all spaces with hyphens.

   $mapaddress = preg_replace('/[^A-Za-z0-9\-]/', '', $string);
			  ?>
          <div class="srch_rslt_right srh_rght sh_srhh">
            <!--<div class="map_wrap">-->
             <div class="" align="center">
              <div class="Flexible-container">
                <?php /*?><iframe width="424" height="214" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBkUSG003UBp7IiqoZXZUJjtC_-N4BOZ_c
    &q=<?php echo $mapaddress; ?>"></iframe><?php */?>
    <script>
			function PopupCenter(pageURL, title,w,h)
			 {
			  var left = (screen.width/2)-(w/2);
		  	  var top = (screen.height/2)-(h/2);
			  var targetWin = window.open (pageURL, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
  
}
			</script><a style="cursor: pointer;" onclick="PopupCenter('businessdirectory/map/<?php echo $mapaddress; ?>','','800','500');" target="_blank" title="View Map"> View Map</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php } 
	 
	 
	 if($this->pagination->create_links()) { ?>
      <div class="pagination"><?php echo $this->pagination->create_links(); ?></div>
      <?php } 
	  } ?>
    </div>
    <div class="lgn_btnlogo"> <a href="<?php echo base_url();?>" title="<?php echo $site_name;?>"><img src="images/ygr_logos.png" class="logo_btm" alt="Yougotrated-Mini-logo" title="Yougotrated"></a> </div>
    <!--pagination--> 
  </section>
</section>
<?php echo $footer;?>
