<?php echo $header;?>
<?php $avgstar = $this->common->get_avg_ratings_bycmid($company[0]['id']);
			$avgstar = round($avgstar);
			$elitemem_status = $this->common->get_eliteship_bycompanyid($company[0]['id']);
			
			?>
<!--<script type="text/javascript" src="js/tytabs.jquery.min.js"></script>-->
<script type="text/javascript" language="javascript">
	$(document).ready(function() {
	//Default Action
	$(".tab_content").hide(); //Hide all content
	$("ul.tabbs li:first").addClass("active").show(); //Activate first tab
	$(".tab_content:first").show(); //Show first tab content
		$("ul.tabbs li").click(function() {
			$("ul.tabbs li").removeClass("active"); //Remove any "active" class
			$(this).addClass("active"); //Add "active" class to selected tab
			$(".tab_content").hide(); //Hide all tab content
			var activeTab = $(this).find("a").attr("href"); //Find the rel attribute value to identify the active tab + content
			$(activeTab).fadeIn(); //Fade in the active content
			return false;
		});
	 }); 
</script>

<section class="container">
  <section class="main_contentarea">
   
    <div class="innr_wrap wrapborder">
      <div class="left_panel  leftpanelwidth">


	<div>
        <?php if(count($elitemem_status)==0){?>
        <div class="vry_logo"> <a href="<?php echo site_url('company/'.$company[0]['companyseokeyword'].'/reviews/coupons/complaints');?>" title="view company Detail"><img src="images/notverified.png" class="imgverify" alt="<?php echo ucfirst(stripslashes($company[0]['company'])); ?>" /></a> </div>
        <?php }else{
				  ?>
        <div class="vry_logo"> <a href="<?php echo site_url('company/'.$company[0]['companyseokeyword'].'/reviews/coupons/complaints');?>" title="view company Detail"><img src="images/verifiedlogo.jpg" class="imgverify" alt="<?php echo ucfirst(stripslashes($company[0]['company'])); ?>" /></a> </div>
        <?php
				  } ?>
        <?php if(count($elitemem_status)==0){?>
        <div class="bsntvry_title">
          <div class="bsvry_tag"> <span>IS THIS YOUR BUSINESS?</span>
            <p><a href="solution/claimbusiness" title="CLICK HERE TO BECOME VERIFIED">CLICK HERE TO BECOME VERIFIED</a></p>
          </div>
        </div>
	<div class="compny_name">
          <h1><?php echo strtoupper($company[0]['company']);?></h1>
          <div class="vry_rating vryrating">
            <?php for($r=0;$r<$avgstar;$r++){?>
            <i class="vry_rat_icn"></i>
            <?php } ?>
            <?php for($p=0;$p<(5-$avgstar);$p++){?>
            <img src="images/no_star.png" alt="no_star" title="no_star" />
            <?php } ?>
          </div>
        </div>
        <?php }else { ?>
      
	<div class="compny_name">
          <h1><?php echo strtoupper($company[0]['company']);?></h1>
	  	<div class="vrytitle">YouGotRated VERIFIED MERCHANT</div>
          <div class="vry_rating vryrating">
            <?php for($r=0;$r<$avgstar;$r++){?>
            <i class="vry_rat_icn"></i>
            <?php } ?>
            <?php for($p=0;$p<(5-$avgstar);$p++){?>
            <img src="images/no_star.png" alt="no_star" title="no_star" />
            <?php } ?>
          </div>
        </div>
        <?php } ?>
        
        <?php if(count($elitemem_status)==0){?>
        <div class="vry_btn"><a href="review/add/<?php echo $company[0]['id'];?>" title="Write review">WRITE REVIEW</a> <a href="<?php echo site_url('complaint/add/'.$company[0]['id']);?>" title="File Complaint">FILE COMPLAINT</a></div>
        
        <?php } else { ?>
		<div class="vry_btn"><a href="review/add/<?php echo $company[0]['id'];?>" title="Write review">WRITE REVIEW</a> <a href="<?php echo site_url('complaint/add/'.$company[0]['id']);?>" title="File Complaint">FILE COMPLAINT</a><a href="complaint/dispute/<?php echo $company[0]['id'];?>" title="File A Dispute">FILE A DISPUTE</a></div>	
       <?php } ?>
      </div>


        <div class="contct_dtl">
          <ul>
            <li><a><?php echo strtoupper(stripslashes($company[0]['streetaddress'])); ?></a></li>
            <li><a><?php echo strtoupper(stripslashes($company[0]['city'].','.$company[0]['state'].','.$company[0]['country'].','.$company[0]['zip'])); ?></a></li>
            <li><a class="colors" href="tel:<?php echo $company[0]['phone'];?>" title="<?php echo $company[0]['phone'];?>"><?php echo $company[0]['phone']; ?></a></li>
            <?php if(strlen($company[0]['fax']>8)){?>
            <li><a><?php echo $company[0]['fax'];?></a></li>
            <?php } ?>
	<li><a href="mailto:<?php echo strtoupper($company[0]['email']);?>" title="Email us" class="colors"><?php echo strtoupper($company[0]['email']);?></a></li>
            <li>
              <?php if (strpos($company[0]['siteurl'],'http://') !== false)
				 {
    				?>
              <a class="colors"  href="<?php  echo strtoupper($company[0]['siteurl']);?>" target="_blank" title="<?php echo $company[0]['siteurl'];?>"><?php echo strtoupper($company[0]['siteurl']);?></a>
              <?php
					
				 }
				 else
				 {
				 ?>
              <a class="colors" href="http://<?php echo ($company[0]['siteurl']);?>" target="_blank" title="http://<?php echo ($company[0]['siteurl']);?>"><?php echo strtoupper("http://".$company[0]['siteurl']);?></a>
              <?php
				 }?>
            </li>
            
            
            
          <?php if( count($elitemem_status)>0 )  {	?>
         
          <?php if( count($companypdfs) > 0 ) { ?>
          <li> <span>Company Menu</span>
		  <?php for($x=0; $x<count($companypdfs); $x++) { ?>
          <div> 
            <script>
			function PopupCenter(pageURL, title,w,h)
			 {
			  var left = (screen.width/2)-(w/2);
		  	  var top = (screen.height/2)-(h/2);
			  var targetWin = window.open (pageURL, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
}		</script>
            <?php $file = $this->common->get_setting_value(2).$this->config->item('pdf_main_upload_path').$companypdfs[$x]['pdf'];?>
            <?php $title = ucfirst(stripslashes($companypdfs[$x]['title'])); ?>
            <a style="cursor: pointer;" onclick="PopupCenter('<?php echo $file;?>','<?php echo $title;?>','800','500');" target="_blank" title="View document">
            <div><?php echo $companypdfs[$x]['title'];?>&nbsp; <img src="<?php echo base_url();?>/images/pdf.png" title="pdf" alt="pdf" /> </div>
            </a> </div>
          <?php } ?></li>
          <?php } 
		  ?>
          
          <?php
		  };?>
        
         
          </ul>
        </div>
        <div class="social_blck">
          <?php if(count($elitemem_status)!=0){?>
          <ul>
            <?php for($cs=0;$cs<count($companysems);$cs++)
			  {?>
	     <?php if($companysems[$cs]['type']=='t'){?>
            <?php if(strlen($companysems[$cs]['url'])>7){?>
            <li class="twitter"><a href="<?php echo $companysems[$cs]['url'];?>" title="twitter"></a></li>
            <?php }} ?>
             <?php if($companysems[$cs]['type']=='f'){?>
            <?php if(strlen($companysems[$cs]['url'])>7){?>
            <li class="facebook"><a href="<?php echo $companysems[$cs]['url'];?>" title="facebook"></a></li>
            <?php }} ?>
            <?php if($companysems[$cs]['type']=='g'){?>
            <?php if(strlen($companysems[$cs]['url'])>7){?>
            <li class="google"><a href="<?php echo $companysems[$cs]['url'];?>" title="google"></a></li>
            <?php }} ?>
   	     <?php if($companysems[$cs]['type']=='p'){?>
            <?php if(strlen($companysems[$cs]['url'])>7){?>
            <li class="pintrest"><a href="<?php echo $companysems[$cs]['url'];?>" title="pintrest"></a></li>
            <?php }} ?>
            <?php if($companysems[$cs]['type']=='a'){?>
            <?php if(strlen($companysems[$cs]['url'])>7){?>
            <li class="amazon"><a href="<?php echo $companysems[$cs]['url'];?>" title="amazon"></a></li>
            <?php }} ?>
            <?php if($companysems[$cs]['type']=='e'){?>
            <?php if(strlen($companysems[$cs]['url'])>7){?>
            <li class="ebay"><a href="<?php echo $companysems[$cs]['url'];?>" title="ebay"></a></li>
            <?php }} ?>
         <!-- <?php if($companysems[$cs]['type']=='l'){?>
            <?php if(strlen($companysems[$cs]['url'])>7){?>
            <li class="linkedin"><a href="<?php echo $companysems[$cs]['url'];?>" title="linkedin"></a></li>
            <?php }} ?>
            <?php if($companysems[$cs]['type']=='y'){?>
            <?php if(strlen($companysems[$cs]['url'])>7){?>
            <li class="youtube"><a href="<?php echo $companysems[$cs]['url'];?>" title="youtube"></a></li>
            <?php }} ?>-->
            <?php } ?>
          </ul>
          <?php } ?>
        </div>

         <div class="get_dirct">
          <div class="getdir_title">
            <label id="directions">GET DIRECTIONS</label>
           <!-- <i class="line"></i>--> 
	</div>
	   </div>

	<div class="get_dirct">
	<div class="getdir_title">
            <label>MENU</label>
	</div></div>

        <div class="review_wrp">
          <div class="contct_dtl">
            <ul>
              <li><span>TOTAL REVIEWS </span><my class="fontcolors";><?php echo $to_reviews;?></my></li>
              <li><span>TOTAL COMPLAINTS </span><my  class="fontcolors";> <?php echo $to_complaints;?></my></li>
              <li><span>TOTAL DAMAGES </span><my  class="fontcolors";> $  <?php if($to_damages!=''){ echo round($to_damages);}else{echo "0";}?>  </my></li>
            
              <li><span>PRICE RANGE </span><my  class="fontcolors";> <?php echo $company[0]['price_range'];?></my></li>
              <li><span>ACCEPTS CREDIT CARDS </span><my  class="fontcolors";> <?php echo $company[0]['accept_credit_cards'];?></my></li>
              <li><span>ACCEPTS PAYPAL </span><my  class="fontcolors";> <?php echo $company[0]['accept_paypal'];?></my></li>
		<li><span>CATEGORY</span><a>
        
          <?php $ex = explode(',',$company[0]['categoryid']); ?>
          <?php for($a=0;$a<count($ex);$a++)
			  {
			  		
					$cat = $this->complaints->get_category_byid($ex[$a]);
					if(count($cat)>0)
					{
						?>
                        <a class="fontcolors";>
                                
                        <?php
                        echo strtoupper($cat[0]['category']);
						?>
                        </a>
						<?php
                      
					}
			  }
			  ?>
            </a></li>
            </ul>
          </div>
        </div>


       <!-- <php if(count($elitemem_status)!=0){?>
        <div class="hour_operatn">
          <div class="hr_title">
            <h2>Hours</h2>
            <i class="line"></i> <span>of operation</span> </div>
          <table class="hrly_tb">
            <thead>
              <tr>
                <th>Monday</th>
                <th>Tuesday</th>
                <th>Wednesday</th>
                <th>Thursday</th>
                <th>Friday</th>
                <th>Saturday</th>
                <th>Sunday</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <php for($t=0;$t<count($company_timings); $t++) { ?>
                <td><php echo date("h:i A",strtotime($company_timings[$t]['start']));?></td>
                <php } ?>
              </tr>
              <tr>
                <php for($t=0; $t<count($company_timings); $t++) { ?>
                <td><php echo date("h:i A",strtotime($company_timings[$t]['end']));?></td>
                <php } ?>
              </tr>
            </tbody>
          </table>
        </div>
        <php } ?>-->
        
        </ul>
<?php 
			  $mapaddress = stripslashes($companies[$i]['streetaddress'].','.$companies[$i]['city'].','.$companies[$i]['state'].','.$companies[$i]['country'].','.$companies[$i]['zip']);
			  $string = str_replace(' ', '-', $mapaddress); // Replaces all spaces with hyphens.

   $mapaddress = preg_replace('/[^A-Za-z0-9\-]/', '', $string);
			  ?>
          <div class="srch_rslt_right srh_rght">
<!--            <div class="map_wrap">-->
            <div class="" align="center">
              <div class="Flexible-container">
                <?php /*?><iframe width="424" height="214" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBkUSG003UBp7IiqoZXZUJjtC_-N4BOZ_c&q=<?php echo $mapaddress; ?>"></iframe><?php */?>
                <script>
			function PopupCenter(pageURL, title,w,h)
			 {
			  var left = (screen.width/2)-(w/2);
		  	  var top = (screen.height/2)-(h/2);
			  var targetWin = window.open (pageURL, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
  
}
			</script><a style="cursor: pointer;" onclick="PopupCenter('businessdirectory/map/<?php echo $mapaddress; ?>','','800','500');" target="_blank" title="View Map">View Map</a>
              </div>
            </div>
          </div>
        </div>
      </div>
<!--<script>
$(document).ready(function(){
$('#directions').click(function(){
$('#mapshow').addClass('mapshow');
});
$('#maps').click(function(){
$('#mapshow').removeClass('mapshow');
});
});
</script>

<div id="mapshow" class="map">
<div id="maps"></div>       
          <div class="map_wrap">
            <div class="Flexible-container">
              <php 
			  $mapaddress = stripslashes($company[0]['streetaddress'].','.$company[0]['city'].','.$company[0]['state'].','.$company[0]['country'].','.$company[0]['zip']);
			  $string = str_replace(' ', '-', $mapaddress); // Replaces all spaces with hyphens.
	      ?>
    
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyASm3CwaK9qtcZEWYa-iQwHaGi3gcosAJc&sensor=false"></script>
<script type="text/javascript">
           
	 // When the window has finished loading create our google map below
            google.maps.event.addDomListener(window, 'load', init);
        
<php 
    $json = file_get_contents("http://maps.google.com/maps/api/geocode/json?address=$mapaddress&sensor=false");
    $json = json_decode($json);
    $lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
    $long = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
?>
	      function init() 
	      {
				
                // Basic options for a simple Google Map
                // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
                var mapOptions = {
                
		// How zoomed in you want the map to start at (always required)
                    zoom: 10,

                 // The latitude and longitude to center the map (always required)
                    center: new google.maps.LatLng(<php echo $lat?>,<php echo $long;?>), // New York

                // How you would like to style the map. 
                // This is where you would paste any style found on Snazzy Maps.
                    styles: [	{		featureType:'water',		stylers:[{color:'#0080FF'},{visibility:'on'}]	},{		featureType:'landscape',		stylers:[{color:'#f2f2f2'}]	},{		featureType:'road',		stylers:[{saturation:-100},{lightness:45}]	},{		featureType:'road.highway',		stylers:[{visibility:'simplified'}]	},{		featureType:'road.arterial',		elementType:'labels.icon',		stylers:[{visibility:'off'}]	},{		featureType:'administrative',		elementType:'labels.text.fill',		stylers:[{color:'#444444'}]	},{		featureType:'transit',		stylers:[{visibility:'off'}]	},{		featureType:'poi',		stylers:[{visibility:'off'}]	}]};

                // Get the HTML DOM element that will contain your map 
                // We are using a div with id="map" seen below in the <body>
                var mapElement = document.getElementById('map');

                // Create the Google Map using out element and options defined above
                var map = new google.maps.Map(mapElement, mapOptions);
             }
</script>
<div id="map" style="width:500px;height:400px;"></div>

    
            </div>
          </div>
</div>


        </div>-->








        <!--<div class="abt_dtwrap">
          <div class="abt_title">
            <h2><php echo strtoupper($company[0]['company']);?></h2>
            <i class="line"></i> <span>ABOUT US</span> 
	</div>
          <p> <php echo ucfirst($company[0]['aboutus']);?> </p>
        </div> -->
   







      <div class="right_panel rightpanelwidth">

	<div>
        <ul class="tabbs">
          <?php if(count($elitemem_status)==0){?>
          <li><a href="#tab1" title="REVIEWS">REVIEWS</a></li>
          <li><a href="#tab2" title="COMPLAINTS">COMPLAINTS</a></li>
          <li><a href="#tab4" title="COUPONS">COUPONS</a></li>
          <?php } else {
			  ?>
          <li><a href="#tab1" title="REVIEWS">REVIEWS</a></li>
          <li><a href="#tab2" title="COMPLAINTS">COMPLAINTS</a></li>
          <li><a href="#tab3" title="PRESS RELEASES">PRESS RELEASES</a></li>
          <li><a href="#tab4" title="COUPONS">COUPONS</a></li>
          <li><a href="#tab5" title="PHOTOS">PHOTOS</a></li>
          <li><a href="#tab6" title="VIDEOS" style="background:none !important;">VIDEOS</a></li>
          <?php
			   } ?>
        </ul>
      </div>

        <div class="tab_container">
          <div class="tab_content" id="tab1">
            <div class="review_title">
              <h2>Customer Reviews</h2>
               </div>
            <?php if( count($reviews) > 0 ) { ?>
            <?php if(count($reviews)>5)
			  {
				$newreviews = 5;
			  }
			  else
			  {
			  	$newreviews = count($reviews);
			  }?>
            <?php for($i=0; $i<$newreviews; $i++) { ?>
            <div class="review_block <?php if($i%2==0){echo "fadeout";}?>">
              <div class="review_lft">
                <div class="user_img"><img src="images/default_user.png" alt="User image" title="User image"></div>
               
              </div>
              <div class="review_rgt reviewstab">

 <div class="user_name">
                  <?php if($reviews[$i]['type']=='csv') { ?>
                  <a><?php echo $reviews[$i]['reviewby'];?><span>   -  Orlando, FL</span></a>
			<div class="datereview"><?php echo date("d.m.Y",strtotime($reviews[$i]['reviewdate']));?></div>
                  <?php } else {?>
                  <?php $user=$this->users->get_user_byid($reviews[$i]['reviewby']);?>
                  <?php if(count($user)>0) { ?>
                  <a href="<?php echo site_url('complaint/viewuser/'.$reviews[$i]['companyid'].'/'.$reviews[$i]['reviewby']);?>" title="view profile"><?php echo $user[0]['username'];?><span>Orlando, FL</span></a>
			<div class="datereview"><?php echo date("d.m.Y",strtotime($reviews[$i]['reviewdate']));?></div>
                  <?php } ?>
                  <?php } ?>
                  </a></div>


                <div class="review_ratng_wrp">
                  <div class="rating <?php if($i%2==0){echo "raticn";}?>">
                    <?php for($r=0;$r<($reviews[$i]['rate']);$r++){?>
                    <i class="vry_rat_icn"></i>
                    <?php } ?>
                    <?php for($p=0;$p<(5-($reviews[$i]['rate']));$p++){?>
                    <img src="images/no_star.png" alt="no_star" title="no_star" />
                    <?php } ?>
                  </div>
                  <div class="rat_title reptitle">
                    <h2><?php echo $reviews[$i]['reviewtitle'];?></h2>
                    </div>
                </div>
                <p><?php echo $reviews[$i]['comment'];?></p>
                <div class="cmnt_wrp wrps"> <a href="review/browse/<?php echo $reviews[$i]['seokeyword'];?>" title="Add comment">  +  Add comment </a> </div>
              </div>
            </div>
            <?php } 
			?>
            <p align="right" class="cmnt_wrp wrps"><a href="<?php echo site_url('company/reviews/'.$company[0]['companyseokeyword'].'/reviews/coupons/complaints');?>" title="View All">View All</a>
            </p>
            <?php
			}?>
            <?php  if( count($reviews)==0 ) 
			  { ?>
            <div class="form-message warning">
              <p>No Reviews.</p>
            </div>
            <?php } ?>
          </div>
          <div class="tab_content" id="tab2">
            <div class="review_title">
              <h2>RECENT COMPLAINTS</h2>
               </div>
            <?php if( count($complaints) > 0 ) { ?>
            <?php if(count($complaints)>5)
			  {
			  	
				$newcomplaints = 5;
			  }
			  else
			  {
			  	$newcomplaints = count($complaints);
			  }?>
            <?php for($i=0; $i<($newcomplaints); $i++) { ?>
            <?php $company=$this->complaints->get_company_byid($complaints[$i]['companyid'])?>
            <div class="review_block <?php if($i%2==0){echo "fadeout";}?>">
              <div class="review_lft">
                <div class="user_img"><img src="images/default_user.png" alt="User image" title="User image"></div>
	    </div>
                
              
              <div class="review_rgt reviewstab">
		
		<div class="user_name">
                  <?php $user=$this->users->get_user_byid($complaints[$i]['userid']);?>
                  <?php if(count($user)>0) { ?>
                  <a href="<?php echo site_url('complaint/viewuser/'.$complaints[$i]['companyid'].'/'.$complaints[$i]['userid']); ?>" title="view profile"><?php echo $user[0]['username'];?><!--<span>ORLANDO, FL</span>--></a>
                  <?php } else { ?>
                  <a><?php echo "Anonymous";?></a>
                  <?php	}?>
		 <span class="datereview"><?php echo date('d.m.Y',strtotime($complaints[$i]['complaindate']));?></span>
                </div>


                <div class="review_ratng_wrp">
                  <div class="rat_title reptitle">
                    <h2>Reported Damage: $<?php echo $complaints[$i]['damagesinamt'];?></h2>
                   </div>
                </div>
                <p> <a href="<?php echo site_url('complaint/browse/'.$complaints[$i]['comseokeyword']); ?>" title="view complaint detail"><?php echo strtolower(substr(stripslashes($complaints[$i]['detail']),0,212)."..."); ?></a> </p>
                <div class="cmnt_wrp wrps"> <a href="<?php echo site_url('remove/complaint/'.$complaints[$i]['id'].'/'.$complaints[$i]['companyid']); ?>" title="Remove this complaint"> <i class="rmv_rw"></i>REMOVE</a> </div>
		<div class="cmnt_wrp wrps "><a class="valigns" href="<?php echo site_url('company/complaints/'.$company[0]['companyseokeyword'].'/reviews/coupons/complaints');?>" title="View All">View All</a></div>
              </div>
              <?php } }else{?>
              <div class="review_block noblock">
                <p>No Complaints.</p>
              </div>
              <?php } ?>
            </div>
         
          <div class="tab_content" id="tab3">
            <div class="review_title">
              <h2>RECENT PRESSRELEASES</h2>
               </div>
            <?php if(count($companypressreleases)>0)
		  {?>
            <?php for($pr=0;$pr<count($companypressreleases);$pr++){?>
            <div class="review_block <?php if($pr%2==0){echo "fadeout";}?>">
              <div class="review_rgt reviewstab">
                <div class="review_ratng_wrp">
                  <div class="rat_title reptitle">
                    <h2 class="flats"><a href="<?php echo site_url('pressrelease/browse/'.$companypressreleases[$pr]['seokeyword']); ?>" title="view <?php echo stripslashes(ucfirst($companypressreleases[$pr]['title'])); ?>'s detail"><?php echo $companypressreleases[$pr]['title'];?></a></h2>
                    <span class="datereview pads"><?php echo date('d.m.Y',strtotime($companypressreleases[$pr]['insertdate']));?></span></div>
                </div>
                <p> <a href="<?php echo site_url('pressrelease/browse/'.$companypressreleases[$pr]['seokeyword']); ?>" title="view <?php echo stripslashes(ucfirst($companypressreleases[$pr]['title'])); ?>'s detail"> <?php echo $companypressreleases[$pr]['sortdesc'];?> </a> </p>
              </div>
            </div>
            <?php } ?>
            <p align="right" class="cmnt_wrp wrps">
            <a href="<?php echo site_url('company/pressreleases/'.$company[0]['companyseokeyword']);?>" title="View All">View All</a></p>
            <?php }else{ ?>
            <div class="review_block noblock">
              <p> No Pressreleases. </p>
            </div>
            <?php } ?>
          </div>
          <div class="tab_content" id="tab4">
            <div class="review_title">
              <h2>RECENT COUPONS</h2>
               </div>
            <?php if( count($coupons) > 0 ) { ?>
            <?php if(count($coupons)>5)
			  {
				$d = 5;
			  }
			  else
			  {
			  	$d = count($coupons);
			  }?>
            <?php for($i=0; $i<$d; $i++) { ?>
            <div class="review_block <?php if($i%2==0){echo "fadeout";}?>">
              <div class="review_rgt reviewstab">
                <div class="review_ratng_wrp">
                  <div class="rat_title reptitle">
                    <h2>
				<a href="<?php echo site_url('coupon/browse/'.$coupons[$i]['seokeyword']);?>" title="view coupon detail"><?php echo stripslashes($coupons[$i]['title']); ?></a>
                   		<span><a href="<?php echo $coupons[$i]['url'];?>" title="<?php echo $coupons[$i]['url'];?>" target="_blank" rel="nofollow">Promocode: <span><?php echo $coupons[$i]['promocode'];?></span> </a></span></div>
		     </h2>
                </div>
                <p><?php echo date("d.m.Y",strtotime($coupons[$i]['enddate']));?></p>
              </div>
            </div>
            <?php } ?>
            <p align="right" class="cmnt_wrp wrps">
            <a href="<?php echo site_url('company/coupons/'.$company[0]['companyseokeyword'].'/reviews/coupons/complaints');?>" title="View All">View All</a>
            </p>
            <?php } 
                else { ?>
            <div class="review_block noblock">
              <p>No Coupons.</p>
            </div>
            <?php } ?>
          </div>
          <div class="tab_content" id="tab5">
            <div class="review_title">
              <h2>RECENT PHOTOS</h2>
            </div>
            <div class="review_block noblock">
              <link rel="stylesheet" href="<?php echo base_url();?>js/orbit/orbit-1.2.3.css" type="text/css">
              <script type="text/javascript" src="<?php echo base_url();?>js/orbit/jquery.orbit-1.2.3.min.js"></script>
              <?php if( count($gallerys) > 0 ) { ?>
              <?php $site = site_url();
			  		//$site = str_replace('new/','',$site);
			  		?>
              <script type="text/javascript">
				$(window).load(function() {
				$('#featured').orbit();
					});
				</script>
              <?php for($i=0; $i<count($gallerys); $i++) { ?>
              <?php $photos = $this->complaints->get_photos_bygalleryid($gallerys[$i]['id']);?>
              <?php if(count($photos)>0){ ?>
              <div class="container1">
                <div id="featured">
                  <?php for($f=0; $f<count($photos); $f++) { ?>
                  <img src="<?php echo $site;?>uploads/gallery/main/<?php echo stripslashes($photos[$f]['photo']); ?>" title="<?php echo stripslashes($gallerys[$i]['title']); ?>" alt="<?php echo stripslashes($photos[$f]['photo']); ?>" width="520;" height="392"/>
                  <?php } ?>
                </div>
              </div>
              <div style="padding-bottom:15; margin-top:15px;"></div>
              <?php } else { ?>
              <div class="form-message warning">
                <p>No photos in this gallery.</p>
              </div>
              <?php } ?>
              <?php } ?>
              <?php } else { ?>
              <div class="form-message warning">
                <p>No Photos.</p>
              </div>
              <?php } ?>
            </div>
          </div>
          <div class="tab_content" id="tab6">
            <div class="review_title">
              <h2>RECENT VIDEOS</h2>
            </div>
            <?php if( count($videos) > 0 ) { ?>
            <?php for($i=0; $i<count($videos); $i++) { ?>
            <div class="noblock review_block <?php if($i%2==0){echo "fadeout";}?>">
              <div class="company_content_title contenttag"><?php echo $videos[$i]['title'];?></div>
              <br />
              <div>
                <?php $link = strstr($videos[$i]['videourl'], '=');?>
                <?php $link = str_replace('=','',$link);?>
                <iframe width="520" height="280" src="//www.youtube.com/embed/<?php echo $link;?>" frameborder="1" allowfullscreen id="ygrvideo"></iframe>
              </div>
              <div style="display:none;"> <a href="<?php echo $videos[$i]['videourl'];?>" title="<?php echo $videos[$i]['videourl'];?>"><?php echo $videos[$i]['videourl'];?></a> </div>
            </div>
            <?php } ?>
            <?php }?>
          </div>
        </div>
      </div>
       </div>
<div class="load_rvw"> <a href="<?php echo site_url('company/reviews/'.$company[0]['companyseokeyword'].'/reviews/coupons/complaints');?>" title="Click here to see more review"><div ><label class="load_label">Click here to view more recent business reviews</label></div> <img class="logo_btm" src="images/ygr_logos.png" alt="Click here to see more review" title="Click here to see more review"> </a> </div>
    </div>
  </section>
</section>

<?php echo $footer;?>
