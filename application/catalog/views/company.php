<?php echo $header; ?>
<section class="content-wrap" style="margin-right:0">
  <section class="inner_main">
    <!-- #content -->
    
    <div class="main_contentarea"> <?php echo $menu; ?>
      
      <link rel="stylesheet" href="<?php echo base_url();?>js/datetimepicker/style.css" type="text/css" media="all" />
      <script src="<?php echo base_url();?>js/datetimepicker/jquery-ui-timepicker-addon.js"></script>
      <?php  
	if( $this->uri->segment(1) && ( $this->uri->segment(1) == 'company' ) ){ ?>
      <script type="text/javascript">

$(document).ready(function() {

	$(".tab_content").hide();
	$(".tab_content:first").show(); 

	$("ul.tabs li").click(function() {
		$("ul.tabs li").removeClass("active");
		$(this).addClass("active");
		$(".tab_content").hide();
		var activeTab = $(this).attr("rel"); 
		$("#"+activeTab).fadeIn(); 
	});
});

</script>
      <link rel="stylesheet" href="<?php echo base_url(); ?>js/paging/css/main.css" type="text/css" />
      <div class="login_box_div" style="width:740px; margin-top:0; min-height:330px">
        <div class="box" style="width:90% !important;"> 
          <!-- Correct form message -->
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td valign="top" colspan="2"><div class="post_content_title" style="padding-bottom:0; height:auto;margin-bottom:5px;"><?php echo stripslashes($company[0]['company']); ?></div></td>
            </tr>
            <tr>
              <td width="110px;"><img src="<?php if( $company[0]['logo'] ){ echo $this->common->get_setting_value('2').$this->config->item('company_main_upload_path');?><?php echo stripslashes($company[0]['logo']); } else { echo $this->common->get_setting_value('2').$this->config->item('company_thumb_upload_path')."/no_image.png"; } ?>" width="100px" height="100px"/></td>
              <td class="company_content_title" style="padding-left:10px;"><?php echo ucfirst(stripslashes($company[0]['company'])); ?>&nbsp;summary </td>
            </tr>
            <tr>
              <td></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td></td>
              <td class="company_dsr" style="text-align:left !important;"><?php echo stripslashes($company[0]['aboutus']); ?></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td></td>
              <td class="company_content_title" style="padding-left:10px;line-height:17px;">Company Information</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td></td>
              <td style="padding-left:10px;">&nbsp;<b>Address</b>:&nbsp; <?php echo stripslashes($company[0]['streetaddress']); ?>, <?php echo ucfirst(stripslashes($company[0]['city'])); ?> <?php echo ucfirst(stripslashes($company[0]['state'])); ?> <?php echo ucfirst(stripslashes($company[0]['country'])); ?> <?php echo stripslashes($company[0]['zip']); ?></td>
              <td></td>
            </tr>
            <tr>
              <td></td>
              <td style="padding-left:10px;">&nbsp;<b>Email</b>:&nbsp;<a href="mailto:<?php echo stripslashes($company[0]['email']); ?>"><?php echo stripslashes($company[0]['email']); ?></a></td>
              <td></td>
            </tr>
            <tr>
              <td></td>
              <td style="padding-left:10px;">&nbsp;<b>Website</b>:&nbsp;<a href="http://<?php echo stripslashes($company[0]['siteurl']); ?>" class="company_content_title"><?php echo stripslashes($company[0]['siteurl']); ?></a></td>
              <td></td>
            </tr>
            <tr>
              <td></td>
              <td style="padding-left:10px;">&nbsp;<b>Phone No</b>:&nbsp;<?php echo nl2br(stripslashes($company[0]['phone'])); ?></td>
            </tr>
            <tr>
              <td></td>
            </tr>
            <tr>
              <td></td>
              <td style="padding-left:10px;">&nbsp;<b>Business Category</b>:&nbsp;
                <?php $ex = explode(',',$company[0]['categoryid']); ?>
                <?php for($a=0;$a<count($ex);$a++)
			  {
			  		
					$cat = $this->complaints->get_category_byid($ex[$a]);
					if(count($cat)>0)
					{
						echo ucfirst($cat[0]['category']);
						echo ",";
					}
			  }
			  ?></td>
            </tr>
            <tr>
              <td></td>
            </tr>
            <tr>
              <td></td>
              <td style="padding-left:10px;"><?php $elite = $this->complaints->get_eliteship_bycompanyid($company[0]['id']); ?>
                <?php if( count($elite)>0 )  {	?>
                <span class="company_content_title" style="line-height:17px;">Follow us</span>
                <div style="margin-top:5px;float:none;padding-left:10px;">
                  <?php if( count($companysems)>0 ) {?>
                  <?php for($j=0;$j<count($companysems);$j++){?>
                  <a href="<?php echo $companysems[$j]['url'];?>" title="<?php echo $companysems[$j]['title']; ?>" target="_blank"> <img src="<?php echo base_url(); ?>uploads/companysem/thumb/<?php echo $companysems[$j]['thumbimg']; ?>" title="<?php echo $companysems[$j]['title']; ?>" width="30px;" height="30px;"/> </a>
                  <?php
		
		} }?>
                </div>
                <?php
	   }?></td>
            </tr>
            <tr>
              <td></td>
              <td style="padding-left:10px;"><?php $elite = $this->complaints->get_eliteship_bycompanyid($company[0]['id']); ?>
                <?php if( count($elite)>0 )  {	?>
                <span class="" style="line-height:17px;">Company Menu</span>
                <?php if( count($companypdfs) > 0 ) { ?>
                <?php for($x=0; $x<count($companypdfs); $x++) { ?>
                <div> 
                  <script>
			function PopupCenter(pageURL, title,w,h)
			 {
			  var left = (screen.width/2)-(w/2);
		  	  var top = (screen.height/2)-(h/2);
			  var targetWin = window.open (pageURL, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
  
}
			</script>
                  <?php $file =$this->common->get_setting_value('2').$this->config->item('pdf_main_upload_path').$companypdfs[$x]['pdf'];?>
                  <?php $title = ucfirst(stripslashes($companypdfs[$x]['title'])); ?>
                  <a style="cursor: pointer;" onclick="PopupCenter('<?php echo $file;?>','<?php echo $title;?>','800','500');" target="_blank" title="View document">
                  <div class="company_content_title"><?php echo $companypdfs[$x]['title'];?>&nbsp; <img src="<?php echo base_url();?>/images/pdf.png" title="pdf" alt="pdf" /> </div>
                  </a> </div>
                <?php } ?>
                <?php } };?></td>
            </tr>
              </tr>
            
          </table>
          
          <!--tabs--> 
          <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
          <div id="companymap"> 
            <script type="text/javascript">

var geocoder = new google.maps.Geocoder();
var address = "<?php echo $company[0]['streetaddress'];?> , <?php echo $company[0]['city'];?> , <?php echo $company[0]['state'];?> , <?php echo $company[0]['country'];?> , <?php echo $company[0]['zip'];?>";

geocoder.geocode( { 'address': address}, function(results, status) {

  if (status == google.maps.GeocoderStatus.OK) {
    var latitude = results[0].geometry.location.lat();
    var longitude = results[0].geometry.location.lng();
   	var map;
	
	function initialize() {
	var mapOptions = {
    zoom: 14,
    center: new google.maps.LatLng(latitude,longitude),
    mapTypeId: google.maps.MapTypeId.ROADMAP
	
	
  };
  map = new google.maps.Map(document.getElementById('map-canvas'),
      mapOptions);
	  
   var marker = new google.maps.Marker({
   position: new google.maps.LatLng(latitude,longitude),
   map: map,
   title: '<?php echo $company[0]['company'];?>'
  });

}

google.maps.event.addDomListener(window, 'load', initialize);

  } 
}); 
    </script>
            <div style="margin-top:5px;margin-bottom:5px;">
              <?php $dest = $company[0]['streetaddress'].'+'.$company[0]['city'].'+'.$company[0]['state'].'+'.$company[0]['country'].'+'.$company[0]['zip'];?>
              <?php $dest = str_replace(' ','+',$dest);?>
              <a target="_blank" onClick="window.open('<?php echo $site_url; ?>complaint/directions/<?php echo $dest;?>','YougotratedVerification','width=700,height=500,dependent=yes,resizable=yes,scrollbars=yes,menubar=no,toolbar=no,status=no,directories=no,location=yes'); return false;" style="cursor: pointer;" title="get directions to <?php echo $company[0]['company'];?>"><span class="company_content_title">Get Directions </a>
              <div id="map-canvas" style="width:500px;height:200px;border: 1px solid #CCCCCC;"></div>
            </div>
          </div>
          <ul class="tabs" style="margin-top:25px;font-size:12px;">
			<?php $elite = $this->complaints->get_eliteship_bycompanyid($company[0]['id']); ?>
			<?php if( count($elite)>0 ) { ?>
            <li class="active" rel="tab2">Reviews &nbsp;(<?php echo count($reviews)+ count($companyreviews);?>)</li>
            <span class="hreview-aggregate" style="display:none;"> 
             <?php if(count($reviews)>0)
                    {
                        $totalrates = 0;
                        for($j=0;$j<count($reviews);$j++)
                        {
                            $totalrates = $totalrates + $reviews[$j]['rate'];
                        }
						$round = round($totalrates/count($reviews),1);
						$avgratings = ceil($round*2)/2;
                   } 
                   
              		 if(count($companyreviews)>0)
                    {
                        $totalrates1 = 0;
                        for($x=0;$x<count($companyreviews);$x++)
                        {
                            $totalrates1 = $totalrates1 + $companyreviews[$x]['rate'];
                        }
						$round1 = round($totalrates1/count($companyreviews),1);
						$avgratings1 = ceil($round1*2)/2;
                    } 
                    if( count($companyreviews)==0 && count($reviews)==0) { 
              		$lastavg = 0;
               }else
			  {
              if(count($reviews)==0)
                    {
						$avgratings=0;
					} 
                    if(count($companyreviews)==0)
                    {
						$avgratings1=0;
					} ?>
              <?php if($avgratings!=0 && $avgratings1!=0)      { 
			  $lastavg = ceil(($avgratings+$avgratings1)/2);
			   }
			   else
			  {
				 if($avgratings==0) {
				 $lastavg = ceil($avgratings1); 
				 } 
				 if($avgratings1==0) {
				 $lastavg = ceil($avgratings);
				 } 
			  }
			  
			  } ?>
   <span class="item">
      <span class="fn"><?php echo ($company[0]['company']);?> Reviews</span></span> Review 
   <span class="rating">Rating: 
      <span class="average"><?php echo $lastavg;?></span> out of <span class="best">5</span> 
   </span> 
   based on
   <span class="count"><?php echo count($reviews)+ count($companyreviews);?></span> reviews. 
</span>
            <li rel="tab1">Complaints &nbsp;(<?php echo count($complaints);?>)</li>
            <?php } else { ?>
            <li class="active" rel="tab1">Complaints &nbsp;(<?php echo count($complaints);?>)</li>
            <li rel="tab2">Reviews &nbsp;(<?php echo count($reviews)+ count($companyreviews);?>)
            <span class="hreview-aggregate" style="display:none;"> 
             <?php if(count($reviews)>0)
                    {
                        $totalrates = 0;
                        for($j=0;$j<count($reviews);$j++)
                        {
                            $totalrates = $totalrates + $reviews[$j]['rate'];
                        }
						$round = round($totalrates/count($reviews),1);
						$avgratings = ceil($round*2)/2;
                   } 
                   
              		 if(count($companyreviews)>0)
                    {
                        $totalrates1 = 0;
                        for($x=0;$x<count($companyreviews);$x++)
                        {
                            $totalrates1 = $totalrates1 + $companyreviews[$x]['rate'];
                        }
						$round1 = round($totalrates1/count($companyreviews),1);
						$avgratings1 = ceil($round1*2)/2;
                    } 
                    if( count($companyreviews)==0 && count($reviews)==0) { 
              		$lastavg = 0;
               }else
			  {
              if(count($reviews)==0)
                    {
						$avgratings=0;
					} 
                    if(count($companyreviews)==0)
                    {
						$avgratings1=0;
					} ?>
              <?php if($avgratings!=0 && $avgratings1!=0)      { 
			  $lastavg = ceil(($avgratings+$avgratings1)/2);
			   }
			   else
			  {
				 if($avgratings==0) {
				 $lastavg = ceil($avgratings1); 
				 } 
				 if($avgratings1==0) {
				 $lastavg = ceil($avgratings);
				 } 
			  }
			  
			  } ?>
   <span class="item">
      <span class="fn"><?php echo ($company[0]['company']);?> Reviews</span></span> Review 
   <span class="rating">Rating: 
      <span class="average"><?php echo $lastavg;?></span> out of <span class="best">5</span> 
   </span> 
   based on
   <span class="count"><?php echo count($reviews)+ count($companyreviews);?></span> reviews. 
</span>
            
            </li>
            <?php } ?>
            <li rel="tab3">Coupons &nbsp;(<?php echo count($coupons);?>)</li>
            <?php if( count($elite)>0 ) { ?>
            <li rel="tab4">Photo Gallery &nbsp;(<?php echo count($gallerys);?>)</li>
            <li rel="tab5">Video Gallery &nbsp;(<?php echo count($videos);?>)</li>
            <?php } ?>
          </ul>
          <div class="tab_container">
            <?php if( count($elite)>0 ) { ?>
            <div id="tab2" class="tab_content"> <a href="<?php echo site_url('company/reviews/'.$company[0]['companyseokeyword']);?>" title="View All">View All</a>
              <div class="post_content_title" style="padding-bottom:0; height:auto">Recent Reviews</div>
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
              <div class="main_livepost">
                <div class="post_maincontenttab">
                  <div class="post_content_dscrtab user_view"> <a href="<?php echo site_url('review/browse/'.$reviews[$i]['seokeyword']);?>" title="view comment detail"><?php echo stripslashes($reviews[$i]['comment']); ?></a> <br/>
                    <br/>
                    <img src="<?php echo base_url(); ?>images/stars/<?php echo $reviews[$i]['rate']; ?>.png" alt="<?php echo 'Ratings : '.$reviews[$i]['rate']; ?>" title="<?php 'Ratings : '.$reviews[$i]['rate']; ?>" class="star_image"/> </div>
                  <?php 
                        $date = date_default_timezone_set('Asia/Kolkata');                        $dbdate = date('Y-m-d',strtotime($reviews[$i]['reviewdate']));
                        $today = date('m/d/Y');
                        $d1 = strtotime(date('Y-m-d H:i:s'));
                        $d2 = strtotime($reviews[$i]['reviewdate']);
                        $newdate =round(($d1-$d2)/60);
                        if($newdate > 60){$diff = round(($d1-$d2)/60/60).' hours ago';}else{$diff = $newdate.' minutes ago';}
                        ?>
                  <div class="timing"> <a href="<?php echo site_url('review/browse/'.$reviews[$i]['seokeyword']);?>" title="view comment detail">Date occurred: <span><?php echo date('m/d/Y',strtotime($dbdate));?></span> </a> </div>
                  <div class="post_username">
                    <?php //$this->load->model('users');?>
                    <?php if($reviews[$i]['type']=='csv') { ?>
                    <a><?php echo $reviews[$i]['reviewby'];?></a>
                    <a href="<?php echo site_url('review/browse/'.$reviews[$i]['seokeyword']);?>" title="add comment">Add comment</a>
                    <?php } else {?>
					<?php $user=$this->users->get_user_byid($reviews[$i]['reviewby']);?>
                    <?php if(count($user)>0) { ?>
                    <a href="<?php echo site_url('complaint/viewuser/'.$reviews[$i]['companyid'].'/'.$reviews[$i]['reviewby']);?>" title="view profile"><?php echo $user[0]['username'];?></a> <a href="<?php echo site_url('review/browse/'.$reviews[$i]['seokeyword']);?>" title="add comment">Add comment</a>
                    <?php } ?>
                    <?php } ?>
                  </div>
                </div>
              </div>
              <?php } }?>
              <?php  if( count($reviews)==0 && count($companyreviews)==0 ) 
			  { ?>
              <div class="form-message warning">
                <p>No Reviews.</p>
              </div>
              <?php } ?>
            </div>
            <div id="tab1" class="tab_content"> <a href="<?php echo site_url('company/complaints/'.$company[0]['companyseokeyword'].'/reviews/coupons/complaints');?>" title="View All">View All</a>
              <div class="post_content_title" style="padding-bottom:0; height:auto">Recent Complaints</div>
              <div class="example">
                <div id="content">
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
                  <div id="p">
                    <div class="main_livepost" style="border-bottom: 1px solid #CCCCCC;">
                      <div class="post_maincontenttab">
                        <div class="post_content_dscrtab user_view"> <a href="<?php echo site_url('complaint/browse/'.$complaints[$i]['comseokeyword']); ?>" title="view complaint detail"><?php echo strtolower(substr(stripslashes($complaints[$i]['detail']),0,212)."..."); ?></a> </div>
                        <?php 
                        $date = date_default_timezone_set('Asia/Kolkata');                        $dbdate = date('Y-m-d',strtotime($complaints[$i]['whendate']));
                        $complaindate = date('m/d/Y',strtotime($complaints[$i]['complaindate']));
                        $today = date('m/d/Y');
                        $d1 = strtotime(date('Y-m-d H:i:s'));
                        $d2 = strtotime($complaints[$i]['complaindate']);
                        $newdate =round(($d1-$d2)/60);
                        if($newdate > 60){$diff = round(($d1-$d2)/60/60).' hours ago';}else{$diff = $newdate.' minutes ago';}
                        ?>
                        <div class="timing"> <a href="<?php echo site_url('complaint/browse/'.$complaints[$i]['comseokeyword']); ?>" title="view complaint detail">Date occurred: <span><?php echo date('m/d/Y',strtotime($dbdate));?></span> </a> <a href="<?php echo site_url('complaint/browse/'.$complaints[$i]['comseokeyword']); ?>" title="view complaint detail">Reported Damage: <span>$<?php echo $complaints[$i]['damagesinamt'];?></span> </a>
                        </div>
                        <div class="post_username">
                          <?php $user=$this->users->get_user_byid($complaints[$i]['userid']);?>
                          <?php if(count($user)>0) { ?>
                          <a href="<?php echo site_url('complaint/viewuser/'.$complaints[$i]['companyid'].'/'.$complaints[$i]['userid']); ?>" title="view profile"><?php echo $user[0]['username'];?></a>
                          <?php } else { ?>
                          <a href="#"><?php echo "Anonymous";?></a>
                          <?php	}?>
                          <a href="<?php echo site_url('complaint/browse/'.$complaints[$i]['comseokeyword']); ?>" title="view complaint detail"><span><?php echo ($complaindate==$today)?'Posted: '.$diff:'Posted: '.date('m/d/Y',strtotime($complaints[$i]['complaindate'])); ?></span></a> </div>
                      </div>
                    </div>
                  </div>
                  <?php } ?>
                  <?php } 
    	            else { ?>
                  <div class="form-message warning">
                    <p>No Complaints.</p>
                  </div>
                  <?php } ?>
                </div>
                <div id="pagingControls"></div>
              </div>
            </div>
            <?php } else { ?>
            <div id="tab1" class="tab_content"> <a href="<?php echo site_url('company/complaints/'.$company[0]['companyseokeyword'].'/reviews/coupons/complaints');?>" title="View All">View All</a>
              <div class="post_content_title" style="padding-bottom:0; height:auto">Recent Complaints</div>
              <div class="example">
                <div id="content">
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
                  <div id="p">
                    <div class="main_livepost" style="border-bottom: 1px solid #CCCCCC;">
                      <div class="post_maincontenttab">
                        <div class="post_content_dscrtab user_view"> <a href="<?php echo site_url('complaint/browse/'.$complaints[$i]['comseokeyword']); ?>" title="view complaint detail"><?php echo strtolower(substr(stripslashes($complaints[$i]['detail']),0,212)."..."); ?></a> </div>
                        <?php 
                        $date = date_default_timezone_set('Asia/Kolkata');                        $dbdate = date('Y-m-d',strtotime($complaints[$i]['whendate']));
                        $complaindate = date('m/d/Y',strtotime($complaints[$i]['complaindate']));
                        $today = date('m/d/Y');
                        $d1 = strtotime(date('Y-m-d H:i:s'));
                        $d2 = strtotime($complaints[$i]['complaindate']);
                        $newdate =round(($d1-$d2)/60);
                        if($newdate > 60){$diff = round(($d1-$d2)/60/60).' hours ago';}else{$diff = $newdate.' minutes ago';}
                        ?>
                        <div class="timing"> <a href="<?php echo site_url('complaint/browse/'.$complaints[$i]['comseokeyword']); ?>" title="view complaint detail">Date occurred: <span><?php echo date('m/d/Y',strtotime($dbdate));?></span> </a> <a href="<?php echo site_url('complaint/browse/'.$complaints[$i]['comseokeyword']); ?>" title="view complaint detail">Reported Damage: <span>$<?php echo $complaints[$i]['damagesinamt'];?></span> </a>
                          <?php if(count($company)>0) { ?>
                          <a href="<?php echo site_url('remove/complaint/'.$complaints[$i]['id'].'/'.$complaints[$i]['companyid']); ?>" title="Remove this complaint" style="background-color:#FFFFFF;">
                          <input type="submit" name="submit" value="Remove" class="remove_btn" title="Remove this complaint" style="margin-top:-2px;"/>
                          </a>
                          <?php } ?>
                        </div>
                        <div class="post_username">
                          <?php $user=$this->users->get_user_byid($complaints[$i]['userid']);?>
                          <?php if(count($user)>0) { ?>
                          <a href="<?php echo site_url('complaint/viewuser/'.$complaints[$i]['companyid'].'/'.$complaints[$i]['userid']); ?>" title="view profile"><?php echo $user[0]['username'];?></a>
                          <?php } else { ?>
                          <a href="#"><?php echo "Anonymous";?></a>
                          <?php	}?>
                          <a href="<?php echo site_url('complaint/browse/'.$complaints[$i]['comseokeyword']); ?>" title="view complaint detail"><span><?php echo ($complaindate==$today)?'Posted: '.$diff:'Posted: '.date('m/d/Y',strtotime($complaints[$i]['complaindate'])); ?></span></a> </div>
                      </div>
                    </div>
                  </div>
                  <?php } ?>
                  <?php } 
    	            else { ?>
                  <div class="form-message warning">
                    <p>No Complaints.</p>
                  </div>
                  <?php } ?>
                </div>
                <div id="pagingControls"></div>
              </div>
            </div>
            <div id="tab2" class="tab_content"> <a href="<?php echo site_url('company/reviews/'.$company[0]['companyseokeyword'].'/reviews/coupons/complaints');?>" title="View All">View All</a>
              <div class="post_content_title" style="padding-bottom:0; height:auto">Recent Reviews</div>
              <?php if( count($reviews) > 0 ) { ?>
              <?php if(count($reviews)>5)
			  {
				$b = 5;
			  }
			  else
			  {
			  	$b = count($reviews);
			  }?>
              <?php //echo "<pre>"; print_r($reviews); die();?>
              <?php for($i=0; $i<($b); $i++) { ?>
              <div class="main_livepost">
                <div class="post_maincontenttab">
                  <div class="post_content_dscrtab user_view"> <a href="<?php echo site_url('review/browse/'.$reviews[$i]['seokeyword']);?>" title="view comment detail"><?php echo stripslashes($reviews[$i]['comment']); ?></a> <br/>
                    <br/>
                    <img src="<?php echo base_url(); ?>images/stars/<?php echo $reviews[$i]['rate']; ?>.png" alt="<?php echo 'Ratings : '.$reviews[$i]['rate']; ?>" title="<?php 'Ratings : '.$reviews[$i]['rate']; ?>" class="star_image"/> </div>
                  <?php 
                        $date = date_default_timezone_set('Asia/Kolkata');                        $dbdate = date('Y-m-d',strtotime($reviews[$i]['reviewdate']));
                        $today = date('m/d/Y');
                        $d1 = strtotime(date('Y-m-d H:i:s'));
                        $d2 = strtotime($reviews[$i]['reviewdate']);
                        $newdate =round(($d1-$d2)/60);
                        if($newdate > 60){$diff = round(($d1-$d2)/60/60).' hours ago';}else{$diff = $newdate.' minutes ago';}
                        ?>
                  <div class="timing"> <a href="<?php echo site_url('review/browse/'.$reviews[$i]['seokeyword']);?>" title="view comment detail">Date occurred: <span><?php echo date('m/d/Y',strtotime($dbdate));?></span> </a> </div>
                  <div class="post_username">
                    <?php //$this->load->model('users');?>
                    <?php if($reviews[$i]['type']=='csv') {?>
					<a><?php echo $reviews[$i]['reviewby'];?></a>
                    <a href="<?php echo site_url('review/browse/'.$reviews[$i]['seokeyword']);?>" title="add comment">Add comment</a>
                    <?php  ?>
                    <?php }else{ ?>
                    <?php $user=$this->users->get_user_byid($reviews[$i]['reviewby']);?>
                    <?php if(count($user)>0) { ?>
                    <a href="<?php echo site_url('complaint/viewuser/'.$reviews[$i]['companyid'].'/'.$reviews[$i]['reviewby']);?>" title="view profile"><?php echo $user[0]['username'];?></a> <a href="<?php echo site_url('review/browse/'.$reviews[$i]['seokeyword']);?>" title="add comment">Add comment</a>
                    <?php } ?>
                    
					<?php } ?>
                    
                  </div>
                </div>
              </div>
              <?php } }?>
              <?php if( count($companyreviews) > 0 ) { ?>
              <?php if(count($companyreviews)>5)
			  {
			  	
				$c = 5;
			  }
			  else
			  {
			  	$c = count($companyreviews);
			  }?>
              <?php for($x=0; $x<($c); $x++) { ?>
              <div class="main_livepost">
                <div class="post_maincontenttab">
                  <div class="post_content_dscrtab user_view"> <a href="" title=""><?php echo stripslashes($companyreviews[$x]['comment']); ?></a> <br/>
                    <br/>
                    <img src="<?php echo base_url(); ?>images/stars/<?php echo $companyreviews[$x]['rate']; ?>.png" alt="<?php echo 'Ratings : '.$companyreviews[$x]['rate']; ?>" title="<?php 'Ratings : '.$companyreviews[$x]['rate']; ?>" class="star_image"/> </div>
                  <?php 
                        $date = date_default_timezone_set('Asia/Kolkata');                        $dbdate = date('Y-m-d',strtotime($companyreviews[$x]['reviewdate']));
                        $today = date('m/d/Y');
                        $d1 = strtotime(date('Y-m-d H:i:s'));
                        $d2 = strtotime($companyreviews[$x]['reviewdate']);
                        $newdate =round(($d1-$d2)/60);
                        if($newdate > 60){$diff = round(($d1-$d2)/60/60).' hours ago';}else{$diff = $newdate.' minutes ago';}
                        ?>
                  <div class="timing"> <a href="" title="">Date occurred: <span><?php echo date('m/d/Y',strtotime($dbdate));?></span> </a> </div>
                  <div class="post_username"> <a href="" title=""><?php echo $companyreviews[$x]['username'];?></a> <a href="" title=""></a> </div>
                </div>
              </div>
              <?php } ?>
              <?php } ?>
              <?php  if( count($reviews)==0 && count($companyreviews)==0 ) 
			  {
                 ?>
              <div class="form-message warning">
                <p>No Reviews.</p>
              </div>
              <?php } ?>
            </div>
            <?php } ?>
            <div id="tab3" class="tab_content"> <a href="<?php echo site_url('company/coupons/'.$company[0]['companyseokeyword'].'/reviews/coupons/complaints');?>" title="View All">View All</a>
              <div class="post_content_title" style="padding-bottom:0; height:auto">Coupons</div>
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
              <div class="main_livepost">
                <div class="post_maincontenttab">
                  <div class="post_content_dscrtab user_view"> <a href="<?php echo site_url('coupon/browse/'.$coupons[$i]['seokeyword']);?>" title="view coupon detail"><?php echo stripslashes($coupons[$i]['title']); ?></a> <br/>
                  </div>
                  <?php 
                        $date = date_default_timezone_set('Asia/Kolkata');
						$dbdate = date('Y-m-d',strtotime($coupons[$i]['enddate']));
                        $today = date('m/d/Y');
                        $d1 = strtotime(date('Y-m-d H:i:s'));
                        $d2 = strtotime($coupons[$i]['enddate']);
                        $newdate =round(($d1-$d2)/60);
                        if($newdate > 60){$diff = round(($d1-$d2)/60/60).' hours ago';}else{$diff = $newdate.' minutes ago';}
                        ?>
                  <div class="timing"> <a href="<?php echo $coupons[$i]['url'];?>" title="" target="_blank" rel="nofollow">Promocode: <span><?php echo $coupons[$i]['promocode'];?></span> </a> </div>
                  <div class="timing"> <a href="<?php echo site_url('coupon/browse/'.$coupons[$i]['seokeyword']);?>" title="view coupon detail">Expires: <span><?php echo date('m/d/Y',strtotime($dbdate));?></span> </a> </div>
                </div>
              </div>
              <?php } ?>
              <?php } 
                else { ?>
              <div class="form-message warning">
                <p>No Coupons.</p>
              </div>
              <?php } ?>
            </div>
            <!-- #tab3 -->
            <?php $elite = $this->complaints->get_eliteship_bycompanyid($company[0]['id']);
			if( count($elite)>0 ) { ?>
            <div id="tab4" class="tab_content">
              <link rel="stylesheet" href="<?php echo base_url();?>js/orbit/orbit-1.2.3.css" type="text/css">
              <script type="text/javascript" src="<?php echo base_url();?>js/orbit/jquery.orbit-1.2.3.min.js"></script>
              <div class="post_content_title" style="padding-bottom:0; height:auto">Photos</div>
              <br/>
              <?php if( count($gallerys) > 0 ) { ?>
              <?php $site = site_url();?>
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
                  <?php /*?><img src="<?php echo $site;?>uploads/gallery/main/<?php echo stripslashes($photos[$f]['photo']); ?>" title="<?php echo stripslashes($gallerys[$i]['title']); ?>" alt="<?php echo stripslashes($photos[$f]['photo']); ?>" width="644px;" height="350px;" /><?php */?>
                  <img src="<?php echo $site;?>uploads/gallery/main/<?php echo stripslashes($photos[$f]['photo']); ?>" title="<?php echo stripslashes($gallerys[$i]['title']); ?>" alt="<?php echo stripslashes($photos[$f]['photo']); ?>" width="460px;" height="460px;" />
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
            <div id="tab5" class="tab_content">
              <div class="post_content_title" style="padding-bottom:0; height:auto">Videos</div>
              <br />
              <?php if( count($videos) > 0 ) { ?>
              <?php for($i=0; $i<count($videos); $i++) { ?>
              
              
              <div style="border-bottom:1px solid #CCCCCC;margin-bottom:10px;">
                <div class="company_content_title"><?php echo $videos[$i]['title'];?></div>
                <br />
                <div>
                  <?php $link = strstr($videos[$i]['videourl'], '=');?>
                  <?php $link = str_replace('=','',$link);?>
                  <iframe width="550" height="350" src="//www.youtube.com/embed/<?php echo $link;?>" frameborder="1" allowfullscreen id="ygrvideo"></iframe>
                </div>
              </div>
              
              <div style="display:none;">
              <a href="<?php echo $videos[$i]['videourl'];?>" title="<?php echo $videos[$i]['videourl'];?>"><?php echo $videos[$i]['videourl'];?></a>
              </div>
              <?php } ?>
              <?php } 
                else { ?>
              <div class="form-message warning">
                <p>No Videos.</p>
              </div>
              <?php } ?>
            </div>
            <?php } ?>
          </div>
        </div>
      </div>
      <div class="profile-sidebar" style="border:none">
        <table border="0" cellspacing="0" cellpadding="0">
          <tr height="40">
            <td><b>Company Rating</b></td>
          </tr>
          <tr>
            <td width="140"><?php
									 if(count($reviews)>0)
                    {
                        $totalrates = 0;
                        for($j=0;$j<count($reviews);$j++)
                        {
                            $totalrates = $totalrates + $reviews[$j]['rate'];
                        }
						$round = round($totalrates/count($reviews),1);
						$avgratings = ceil($round*2)/2;
                    ?>
              <?php } 
                   
              		 if(count($companyreviews)>0)
                    {
                        $totalrates1 = 0;
                        for($x=0;$x<count($companyreviews);$x++)
                        {
                            $totalrates1 = $totalrates1 + $companyreviews[$x]['rate'];
                        }
						$round1 = round($totalrates1/count($companyreviews),1);
						$avgratings1 = ceil($round1*2)/2;
                    ?>
              <?php } 
                    if( count($companyreviews)==0 && count($reviews)==0) { ?>
              <span style="font-size:16px;text-align:center">NR</span>
              <?php }else
			  {
			  
              if(count($reviews)==0)
                    {
						$avgratings=0;
					} 
                    if(count($companyreviews)==0)
                    {
						$avgratings1=0;
					} ?>
              <?php if($avgratings!=0 && $avgratings1!=0)      { ?>
              <img src="<?php echo base_url(); ?>images/stars/<?php echo ceil(($avgratings+$avgratings1)/2); ?>.png" alt="<?php echo 'Ratings : '.(($avgratings+$avgratings1)/2); ?>" title="<?php 'Ratings : '.(($avgratings+$avgratings1)/2); ?>" class="star_image"/>
              <?php }else
			  {
			  ?>
              <?php if($avgratings==0) {?>
              <img src="<?php echo base_url(); ?>images/stars/<?php echo ceil($avgratings1); ?>.png" alt="<?php echo 'Ratings : '.$avgratings1; ?>" title="<?php 'Ratings : '.$avgratings1; ?>" class="star_image"/>
              <?php } ?>
              <?php if($avgratings1==0) {?>
              <img src="<?php echo base_url(); ?>images/stars/<?php echo ceil($avgratings); ?>.png" alt="<?php echo 'Ratings : '.$avgratings; ?>" title="<?php 'Ratings : '.$avgratings; ?>" class="star_image"/>
              <?php } ?>
              <?php
			  }
			  ?>
              <?php
			  } ?>
              <br />
              <span style="font-size:12px;text-align:center" class="user_view"><a href="<?php echo site_url('review/add/'.$company[0]['id']);?>" title="add review for <?php echo $company[0]['company']; ?>"><b>Add Review</b></a></span></td>
          </tr>
          <tr height="40">
            <td><b>Company Statistics</b></td>
          </tr>
          <tr>
            <td class="company-wrap"><span>Complaint Against</span><br />
              <span><b><?php echo ucfirst($company[0]['company']); ?></b></span></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr height="40">
            <td class="company-wrap"><span>Total Complaints</span><br />
              <span><b><?php echo count($this->complaints->get_complaint_bycompanyid($company[0]['id'])); ?></b></span></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr height="40">
            <td class="company-wrap"><span>Total Damage</span><br />
              <span><b>$
              <?php if(count($complaints)>0) { echo $complaints[0]['damagesinamt'];  }else { echo "0";}?>
              </b></span></td>
          </tr>
        </table>
      </div>
      <?php 
	  $elite = $this->complaints->get_eliteship_bycompanyid($company[0]['id']);
	 if( count($elite)==0 )
	  {
	  ?>
      <div style="margin-top:10px;" class="my" align="right"> <a href="<?php echo site_url('solution');?>" title="Claim Your Business"><?php echo form_input(array('name'=>'btnsubmit','id'=>'btnphone','class'=>'complaint_btn','type'=>'submit','value'=>'Claim Your Business','style'=>'padding:5px 20px;cursor: pointer;')); ?></a> </div>
      <?php } ?>
      <table border="0">
        <tr>
          <td width="40px"><span class="company_content_title">&nbsp;&nbsp;Do you have a complaint?</span></td>
        </tr>
        <tr>
          <td class="company_dsr">Start with the name of the Company, Person or a Phone Number. Then select the complaint type to get started.</td>
        </tr>
        <tr>
          <td><div style="margin-top:5px;margin-bottom:5px;" align="right" class="my">
              <?php if( array_key_exists('youg_user',$this->session->userdata) ) { ?>
              <a href="<?php echo site_url();?>" title="submit a complaint"><?php echo form_input(array('name'=>'btnsubmit','id'=>'btnphone','class'=>'complaint_btn','type'=>'submit','value'=>'Submit a complaint','style'=>'padding:7px 25px;cursor: pointer;')); ?></a>
              <?php } else { ?>
              <a href="<?php echo site_url('welcome');?>" title="submit a complaint"><?php echo form_input(array('name'=>'btnsubmit','id'=>'btnphone','class'=>'complaint_btn','type'=>'submit','value'=>'Submit a complaint','style'=>'padding:7px 25px;cursor: pointer;')); ?></a>
              <?php } ?>
            </div></td>
        </tr>
        <tr>
          <td></td>
        </tr>
        <tr>
          <td><?php if($rightads){ ?>
            <div><a href="<?php echo $rightads[0]['url'];?>" title="" target="_blank" rel="nofollow"><img src="<?php if( $rightads[0]['image'] ) { echo $this->common->get_setting_value('2').$this->config->item('ad_main_upload_path');?><?php echo stripslashes($rightads[0]['image']); } ?>" alt="rightads" width="224" height="180" class="adimg" style="margin-left:5px;"/></a> </div>
            <?php } ?></td>
        </tr>
      </table>
      <?php }
	 else { ?>
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
            <td></td>
          </tr>
          <tr>
            <td><?php if($leftads){ ?>
              <div><a href="<?php echo $leftads[0]['url'];?>" title="" target="_blank" rel="nofollow"><img src="<?php if( $leftads[0]['image'] ) { echo $this->common->get_setting_value('2').$this->config->item('ad_main_upload_path');?><?php echo stripslashes($leftads[0]['image']); } ?>" alt="leftads" width="280" height="180" class="adimg"/></a> </div>
              <?php } ?></td>
          </tr>
        </table>
      </div>
      <div class="right_content_panel">
        <div class="treding_title">Yougotrated Live</div>
        <div class="filter"><span style="font-size:14px; font-weight:bold;">Filter by :</span> <a href="<?php echo site_url('complaint');?>" class="filter_active">Recent Activity</a> <a href="<?php echo site_url('complaint/weektrending');?>">Trending Complaints (7 Days)</a> <!--<a href="#">Most Active (7 Days)</a>--><a href="<?php echo site_url('complaint/advfilter');?>"><span class="advfilterspan"><span id="advfilter" style="cursor: pointer;">Advance Filter</span></span></a></div>
        <?php for($i=0; $i<count($complaints); $i++) { ?>
        <?php //echo "<pre>"; print_r($complaints); die();
        $user=$this->users->get_user_byid($complaints[$i]['userid']) ;?>
        <div class="main_livepost">
          <div class="view_all"> <a href="<?php echo site_url('company').'/'.$complaints[$i]['companyseokeyword'].'/reviews/coupons/complaints';?>" title="view all"> <span>
            <h3>
              <?php $num=$this->complaints->get_complaint_bycompanyid($complaints[$i]['companyid']);?>
              <?php if(count($num)>0){?>
              <?php echo count($num);?>
              <?php }else{"0";}?>
            </h3>
            Related<br>
            Reports </span></a> <!--<span>--><a href="<?php echo site_url('company').'/'.$complaints[$i]['companyseokeyword'].'/reviews/coupons/complaints';?>" title="view all">View All</a><!--</span>--> </div>
          <div class="post_maincontent">
            <div class="side-image"> <a href="<?php echo site_url('complaint/browse/'.$complaints[$i]['comseokeyword']); ?>" title="view complaint detail"><img src="<?php if( $complaints[$i]['logo'] ){ echo $this->common->get_setting_value('2').$this->config->item('company_thumb_upload_path');?><?php echo stripslashes($complaints[$i]['logo']); } else{echo $this->common->get_setting_value('2').$this->config->item('company_thumb_upload_path')."/no_image.png"; } ?>" alt="<?php echo ucfirst(stripslashes($complaints[$i]['company'])); ?>" width="100px" height="40px"/></a> </div>
            <div class="post_content_title"><a href="<?php echo site_url('complaint/browse/'.$complaints[$i]['comseokeyword']); ?>" title="view complaint detail"><?php echo ucfirst(stripslashes($complaints[$i]['company'])); ?></a></div>
            <div class="post_content_dscr user_view" style="margin-top:2px;width: -moz-available;"> <a href="<?php echo site_url('complaint/browse/'.$complaints[$i]['comseokeyword']); ?>" title="view complaint detail"><?php echo strtolower(substr(stripslashes($complaints[$i]['detail']),0,212)."..."); ?></a> </div>
            <?php 
                        $date = date_default_timezone_set('Asia/Kolkata');                             
                        $dbdate = date('Y-m-d',strtotime($complaints[$i]['whendate']));
                        $complaindate = date('m/d/Y',strtotime($complaints[$i]['complaindate']));
                        $today = date('m/d/Y');
                        $d1 = strtotime(date('Y-m-d H:i:s'));
                        $d2 = strtotime($complaints[$i]['complaindate']);
                        $newdate =round(($d1-$d2)/60);
                        if($newdate > 60){$diff = round(($d1-$d2)/60/60).' hours ago';}else{$diff = $newdate.' minutes ago';}
                        ?>
            <div class="timing"> <a href="<?php echo site_url('complaint/browse/'.$complaints[$i]['comseokeyword']); ?>" title="view complaint detail">Date occurred: <span><?php echo date('m/d/Y',strtotime($dbdate));?></span> </a> <a href="<?php echo site_url('complaint/browse/'.$complaints[$i]['comseokeyword']); ?>" title="view complaint detail">Reported Damage: <span>$<?php echo $complaints[$i]['damagesinamt'];?></span> </a> <a href="<?php echo site_url('remove/complaint/'.$complaints[$i]['id'].'/'.$complaints[$i]['companyid']); ?>" title="Remove this complaint" style="background-color:#FFFFFF;">
              <input type="submit" name="submit" value="Remove" class="remove_btn" title="Remove this complaint" style="margin-top:-2px;"/>
              </a> </div>
             <div class="post_username">
              <?php if($complaints[$i]['userid']!=0){ ?>
              <?php if(count($user)>0) {?>
              <a href="<?php echo site_url('complaint/viewuser/'.$complaints[$i]['companyid'].'/'.$complaints[$i]['userid']); ?>" title="view profile"><?php echo $user[0]['username'];?></a>
              <?php } ?>
              <?php } else{ ?>
              <a href="#">Anonymous</a>
              <?php } ?>
              <a href="<?php echo site_url('complaint/browse/'.$complaints[$i]['comseokeyword']); ?>" title="view complaint detail"><span><?php echo ($complaindate==$today)?'Posted: '.$diff:'Posted: '.date('m/d/Y',strtotime($complaints[$i]['complaindate'])); ?></span></a> </div>
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
        <tr>
          <?php } ?>
      </div>
      <?php } ?>
      
    </div>
    <!-- /#content --> 
    
  </section>
</section>
<?php echo $footer; ?>
