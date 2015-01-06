<?php echo $header; ?>
<section class="content-wrap" style="margin-right:0">
  <section class="inner_main">
    <!-- #content -->
    
    <div class="main_contentarea"> <?php echo $menu; ?>
    <?php if($topads){ ?>
       <div class="ad_up"><a href="<?php echo $topads[0]['url'];?>" title="" target="_blank"><img src="<?php if( $topads[0]['image'] ) { echo $this->common->get_setting_value('2').$this->config->item('ad_main_upload_path');?><?php echo stripslashes($topads[0]['image']); } ?>" alt="topads" width="940" height="180" class="adimg"/></a> </div>
		  <?php } ?>
      <link rel="stylesheet" href="<?php echo base_url();?>js/datetimepicker/style.css" type="text/css" media="all" />
     <script src="<?php echo base_url();?>js/datetimepicker/jquery-ui-timepicker-addon.js"></script>

      <?php  
	if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'search' ) ){ ?>
    <link rel="stylesheet" href="<?php echo base_url(); ?>js/paging/css/main.css" type="text/css" />
      <script src="<?php echo base_url(); ?>js/paging/js/imtech_pager.js"></script> 
      <script type="text/javascript">
var pager = new Imtech.Pager();
$(document).ready(function() {
    pager.paragraphsPerPage = 100; // set amount elements per page
    pager.pagingContainer = $('#content'); // set of main container
    pager.paragraphs = $('#q', pager.pagingContainer); // set of required containers
    pager.showPage(0);
});
</script>
     <?php /*?> <div class="left_content_panel">
        <div class="treding_title">Trending Searches <span>Last 7 Days</span></div>
        <div class="treding_lnk">
          <?php if(count($keywords)>0){?>
          <?php //echo '<pre>'; print_r($keywords);?>
          <?php for($i=0; $i<count($keywords); $i++)
					{ ?>
          <a title="Search <?php echo $keywords[$i]['keyword'];?>" href="<?php echo base_url('complaint/keysearch');?><?php echo "/".$keywords[$i]['keyword'];?>"><?php echo $keywords[$i]['keyword'];?></a>
          <?php }?>
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
        </table>
      </div><?php */?>
      <?php /*?><div class="right_content_panel">
        <div class="treding_title" style="border-bottom: 1px solid #CCCCCC; margin-bottom: 10px; padding-bottom: 5px; width:545px">Search results for "<?php echo $keyword;?>" </div>
        <?php if(count($complaints)>0){?>
        <?php echo "<pre> "; print_r($complaints);die();?>
        <div class="post_content_title" style="font-size:18px">Matching Complaints</div>
        <?php for($i=0; $i<count($complaints); $i++) { ?>
        <div class="main_livepost">
          <div class="post_maincontent">
            <div class="search_content_title"><a href="<?php echo site_url('complaint/browse/'.$complaints[$i]['comseokeyword']); ?>" title="view complaint detail"><?php echo stripslashes($complaints[$i]['company'])." Complaint for $".$complaints[$i]['damagesinamt'];?></a></div>
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
            <div class="search_content_date" style="margin-bottom:15px;"> <?php echo ($complaindate==$today)?"Posted ".$diff:"Posted ".date('d M,Y',strtotime($complaints[$i]['complaindate'])); ?> </div>
            <div class="post_content_dscr user_view"> <a href="<?php echo site_url('complaint/browse/'.$complaints[$i]['comseokeyword']);?>" title="view complaint detail"><?php echo strtolower(substr(stripslashes($complaints[$i]['detail']),0,212)."..."); ?></a></div>
          </div>
        </div>
        <?php } ?>
        <?php  if($this->pagination->create_links()) { ?>
        <div class="pagination pagination-centered"> <?php echo $this->pagination->create_links(); ?> </div>
        <?php } ?>
        <?php } else { //$keyword = $keyword;?>
        <div class="post_content_title" style="font-size:18px">No Matches found for <?php echo "\"$keyword\"";?></div>
        <?php } ?>
      </div><?php */?>
      <?php //echo "<pre> "; print_r($complaints);die();?>
      <div class="left_content_panel">
        <div class="treding_title">Trending Searches <span>Last 7 Days</span></div>
        <div class="treding_lnk">
          <?php if(count($keywords)>0){?>
          <?php //echo '<pre>'; print_r($keywords);?>
          <?php for($i=0; $i<count($keywords); $i++)
					{ ?>
          <a title="Search <?php echo $keywords[$i]['keyword'];?>" href="<?php echo base_url('complaint/keysearch');?><?php echo "/".$keywords[$i]['keyword'];?>"><?php echo $keywords[$i]['keyword'];?></a>
          <?php }?>
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
        </table>
      </div>
      <div class="right_content_panel">
        <div class="treding_title" style="border-bottom: 1px solid #CCCCCC; margin-bottom: 10px; padding-bottom: 5px; width:545px">Search results for "<?php echo $keyword;?>" </div>
        <div class="example">
        <div id="content">
		<?php if(count($complaints)>0){?>
        <?php //echo "<pre> "; print_r($complaints);die();?>
		
		<?php // echo count($complaints);?>
        <div class="post_content_title" style="font-size:18px">Matching Results</div>
        <?php for($i=0; $i<count($complaints); $i++) { 
		if($complaints[$i]['clink']!='' && $complaints[$i]['cdetail']!='' && $complaints[$i]['damagesinamt']!='' && $complaints[$i]['complaindate']!='')
		{?>
        <div id="q">
        <div class="main_livepost">
          <div class="post_maincontent">
            <div class="search_content_title"><a href="<?php echo site_url($complaints[$i]['clink']); ?>" title="view detail">
			<?php $ex = explode('/',$complaints[$i]['clink']);
			if($ex[0]=='complaint'){
			?>
			<?php echo " Complaint for $".$complaints[$i]['damagesinamt'];?>
            <?php }
            if($ex[0]=='pressrelease'){
			?>
			<?php echo " Pressrelease ".$complaints[$i]['damagesinamt'];?>
            <?php }
            if($ex[0]=='review'){
			?>
			<?php echo " Review ".$complaints[$i]['damagesinamt'];?> star
            <?php }
            if($ex[0]=='coupon'){
			?>
			<?php echo " Promo code ".$complaints[$i]['damagesinamt'];?>
            <?php }?>
            
            </a></div>
            <?php 
?>
            <div class="search_content_date" style="margin-bottom:15px;"> <?php echo "Posted ".date('d M,Y',strtotime($complaints[$i]['complaindate'])); ?> </div>
            <div class="post_content_dscr user_view" style="min-width:500px;"> <a href="<?php echo site_url($complaints[$i]['clink']);?>" title="view detail">
			<?php echo strtolower(substr(stripslashes($complaints[$i]['cdetail']),0,212)."..."); ?></a></div>
          </div>
        </div>
        </div>
        <?php }
		
		} ?>
        <?php /*?><?php  if($this->pagination->create_links()) { ?>
        <div class="pagination pagination-centered"> <?php echo $this->pagination->create_links(); ?> </div>
        <?php } ?><?php */?>
        <?php } else { //$keyword = $keyword;?>
        <div class="post_content_title" style="font-size:18px">No Matches found for <?php echo "\"$keyword\"";?></div>
        <?php } ?>
        </div>
        <div class="post_content_title" style="font-family:Verdana,Geneva,sans-serif !important;font-size:16px !important;">
        <div id="pagingControls"></div>
         </div>
              </div>
              
              
      </div>
      <?php }
	else if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'keysearchresult' ) ){ ?>
      <div class="left_content_panel">
        <div class="treding_title">Trending  Searches <span>Last 7 Days</span></div>
        <div class="treding_lnk">
          <?php if(count($keywords)>0){?>
          <?php for($i=0; $i<count($keywords); $i++)
					{ ?>
          <a title="Search <?php echo $keywords[$i]['keyword'];?>" href="<?php echo base_url('complaint/keysearch');?><?php echo "/".$keywords[$i]['keyword'];?>"><?php echo $keywords[$i]['keyword'];?></a>
          <?php }?>
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
        </table>
      </div>
      <div class="right_content_panel">
        <?php //echo '<pre>'; print_r($complaints); die();?>
        <div class="treding_title" style="border-bottom: 1px solid #CCCCCC; margin-bottom: 10px; padding-bottom: 5px; width:545px">Search results for "<?php echo $keyword;?>" </div>
        <?php if(count($complaints)>0){?>
        <div class="post_content_title" style="font-size:18px">Matching Complaints</div>
        <?php for($i=0; $i<count($complaints); $i++) { ?>
        <div class="main_livepost">
          <div class="post_maincontent">
            <div class="search_content_title"><a href="<?php echo site_url('complaint/browse/'.$complaints[$i]['comseokeyword']); ?>" title="view complaint detail"><?php echo stripslashes($complaints[$i]['company'])." Complaint for $".$complaints[$i]['damagesinamt'];?></a></div>
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
            <div class="search_content_date" style="margin-bottom:15px;"> <?php echo ($complaindate==$today)?"Posted ".$diff:"Posted ".date('d M,Y',strtotime($complaints[$i]['complaindate'])); ?> </div>
            <div class="post_content_dscr user_view"> <a href="<?php echo site_url('complaint/browse/'.$complaints[$i]['comseokeyword']);?>" title="view complaint detail"><?php echo strtolower(substr(stripslashes($complaints[$i]['detail']),0,212)."...");?></a></div>
          </div>
        </div>
        <?php } ?>
        <?php  if($this->pagination->create_links()) { ?>
        <div class="pagination pagination-centered"> <?php echo $this->pagination->create_links(); ?> </div>
        <?php } ?>
        <?php } else { //$keyword = ucfirst($keyword);?>
        <div class="post_content_title" style="font-size:18px">No Matches found for <?php echo "\"$keyword\"";?></div>
        <?php } ?>
      </div>
      <?php }		
	else if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'viewcompany' ) ){ ?>
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
      <script src="<?php echo base_url(); ?>js/paging/js/imtech_pager.js"></script> 
      <script type="text/javascript">
var pager = new Imtech.Pager();
$(document).ready(function() {
    pager.paragraphsPerPage = 20; // set amount elements per page
    pager.pagingContainer = $('#content'); // set of main container
    pager.paragraphs = $('#p', pager.pagingContainer); // set of required containers
    pager.showPage(0);
});
</script>
      <div class="login_box_div" style="width:740px; margin-top:0; min-height:330px">
        <div class="box"> 
          <!-- Correct form message -->
          
          <?php if( $this->session->flashdata('success') ) { ?>
          <!--  start message-green -->
          <div id="message-green">
            <table border="0" width="100%" cellpadding="0" cellspacing="0">
              <tr>
                <td class="green-left"><?php echo $this->session->flashdata('success'); ?></td>
                <td class="green-right"><a class="close-green"><img src="<?php echo base_url(); ?>images/messages/icon_close_green.gif" alt="Close"/></a></td>
              </tr>
            </table>
          </div>
          <!--  end message-green -->
          <?php } ?>
          <?php if( $this->session->flashdata('error') ) { ?>
          <!--  start message-red -->
          <div id="message-red">
            <table border="0" width="100%" cellpadding="0" cellspacing="0">
              <tr>
                <td class="red-left"><?php echo $this->session->flashdata('error'); ?></td>
                <td class="red-right"><a class="close-red"><img src="<?php echo base_url(); ?>images/messages/icon_close_red.gif" alt="Close"/></a></td>
              </tr>
            </table>
          </div>
          <!--  end message-red -->
          <?php } ?>
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td valign="top" colspan="2"><div class="post_content_title" style="padding-bottom:0; height:auto;margin-bottom:5px;"><?php echo stripslashes($company[0]['company']); ?></div></td>
            </tr>
            <tr>
              <td width="110px;"><img src="<?php if( $company[0]['logo'] ){ echo $this->common->get_setting_value('2').$this->config->item('company_thumb_upload_path');?><?php echo stripslashes($company[0]['logo']); } else { echo $this->common->get_setting_value('2').$this->config->item('company_thumb_upload_path')."/no_image.png"; } ?>" width="100px" height="40px;"/></td>
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
              <td class="company_dsr"><?php echo stripslashes($company[0]['aboutus']); ?></td>
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
			  ?>
              </td>
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
<div class="company_content_title"><?php echo $companypdfs[$x]['title'];?>&nbsp;
<img src="<?php echo base_url();?>/images/pdf.png" title="pdf" alt="pdf" />
</div>
</a>
		
              </div>
              <?php } ?>
              <?php } };?>
                </td>
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
          <ul class="tabs" style="margin-top:25px;">
            <?php $elite = $this->complaints->get_eliteship_bycompanyid($company[0]['id']); ?>
            <?php if( count($elite)>0 ) { ?>
            <li class="active" rel="tab2">Reviews &nbsp;(<?php echo count($reviews)+ count($companyreviews);?>)</li>
            <li rel="tab1">Complaints &nbsp;(<?php echo count($complaints);?>)</li>
            <?php } else { ?>
            <li class="active" rel="tab1">Complaints &nbsp;(<?php echo count($complaints);?>)</li>
            <li rel="tab2">Reviews &nbsp;(<?php echo count($reviews)+ count($companyreviews);?>)</li>
			<?php } ?>
            <li rel="tab3">Coupons &nbsp;(<?php echo count($coupons);?>)</li>
            
			<?php if( count($elite)>0 ) { ?>
            <li rel="tab4">Photo Gallery &nbsp;(<?php echo count($gallerys);?>)</li>
            <li rel="tab5">Video Gallery &nbsp;(<?php echo count($videos);?>)</li>
            <?php } ?>
          </ul>
          <div class="tab_container">
            <?php if( count($elite)>0 ) { ?>
            <div id="tab2" class="tab_content">
              <div class="post_content_title" style="padding-bottom:0; height:auto">Recent Reviews</div>
              <?php if( count($reviews) > 0 ) { ?>
              <?php //echo "<pre>"; print_r($reviews); die();?>
              <?php for($i=0; $i<count($reviews); $i++) { ?>
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
                  <div class="timing"> <a href="<?php echo site_url('review/browse/'.$reviews[$i]['id']);?>" title="view comment detail">Date occurred: <span><?php echo date('m/d/Y',strtotime($dbdate));?></span> </a> </div>
                  <div class="post_username">
                    <?php //$this->load->model('users');?>
                    <?php $user=$this->users->get_user_byid($reviews[$i]['reviewby']);?>
                    <?php if(count($user)>0) { ?>
                    <a href="<?php echo site_url('complaint/viewuser/'.$reviews[$i]['companyid'].'/'.$reviews[$i]['reviewby']);?>" title="view profile"><?php echo $user[0]['username'];?></a> <a href="<?php echo site_url('review/browse/'.$reviews[$i]['id']);?>" title="add comment">Add comment</a>
                    <?php } ?>
                  </div>
                </div>
              </div>
              <?php } }?>
              <?php if( count($companyreviews) > 0 ) { ?>
              <?php for($x=0; $x<count($companyreviews); $x++) { ?>
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
            
            <div id="tab1" class="tab_content">
              <div class="post_content_title" style="padding-bottom:0; height:auto">Recent Complaints</div>
              <div class="example">
                <div id="content">
                  <?php if( count($complaints) > 0 ) { ?>
                  <?php for($i=0; $i<count($complaints); $i++) { ?>
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
            <?php } else { ?>
            <div id="tab1" class="tab_content">
              <div class="post_content_title" style="padding-bottom:0; height:auto">Recent Complaints</div>
              <div class="example">
                <div id="content">
                  <?php if( count($complaints) > 0 ) { ?>
                  <?php for($i=0; $i<count($complaints); $i++) { ?>
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
            <div id="tab2" class="tab_content">
              <div class="post_content_title" style="padding-bottom:0; height:auto">Recent Reviews</div>
              <?php if( count($reviews) > 0 ) { ?>
              <?php //echo "<pre>"; print_r($reviews); die();?>
              <?php for($i=0; $i<count($reviews); $i++) { ?>
              <div class="main_livepost">
                <div class="post_maincontenttab">
                  <div class="post_content_dscrtab user_view"> <a href="<?php echo site_url('complaint/viewcomment/'.$reviews[$i]['id']);?>" title="view comment detail"><?php echo stripslashes($reviews[$i]['comment']); ?></a> <br/>
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
                  <div class="timing"> <a href="<?php echo site_url('complaint/viewcomment/'.$reviews[$i]['id']);?>" title="view comment detail">Date occurred: <span><?php echo date('m/d/Y',strtotime($dbdate));?></span> </a> </div>
                  <div class="post_username">
                    <?php //$this->load->model('users');?>
                    <?php $user=$this->users->get_user_byid($reviews[$i]['reviewby']);?>
                    <?php if(count($user)>0) { ?>
                    <a href="<?php echo site_url('complaint/viewuser/'.$reviews[$i]['companyid'].'/'.$reviews[$i]['reviewby']);?>" title="view profile"><?php echo $user[0]['username'];?></a> <a href="<?php echo site_url('review/browse/'.$reviews[$i]['id']);?>" title="add comment">Add comment</a>
                    <?php } ?>
                  </div>
                </div>
              </div>
              <?php } }?>
              <?php if( count($companyreviews) > 0 ) { ?>
              <?php for($x=0; $x<count($companyreviews); $x++) { ?>
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
            <!-- #tab1 -->
            
            <!-- #tab2 -->
            <div id="tab3" class="tab_content">
              <div class="post_content_title" style="padding-bottom:0; height:auto">Coupons</div>
              <?php if( count($coupons) > 0 ) { ?>
              <?php for($i=0; $i<count($coupons); $i++) { ?>
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
                  <div class="timing"> <a href="<?php echo $coupons[$i]['url'];?>" title="" target="_blank">Promocode: <span><?php echo $coupons[$i]['promocode'];?></span> </a> </div>
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
                  <img src="<?php echo $site;?>uploads/gallery/main/<?php echo stripslashes($photos[$f]['photo']); ?>" title="<?php echo stripslashes($gallerys[$i]['title']); ?>" alt="<?php echo stripslashes($photos[$f]['photo']); ?>" width="644px;" height="350px;" />
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
			  <img src="<?php echo base_url(); ?>images/stars/<?php echo ceil(($avgratings+$avgratings1)/2); ?>.png" alt="<?php echo 'Ratings : '.(($avgratings+$avgratings1)/2); ?>" title="<?php 'Ratings : '.(($avgratings+$avgratings1)/2); ?>" class="star_image"/>
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
	  //echo"<pre>";
	  //print_r($elite);
	  //die();
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
        <td>
        <?php if($rightads){ ?>
       <div><a href="<?php echo $rightads[0]['url'];?>" title="" target="_blank"><img src="<?php if( $rightads[0]['image'] ) { echo $this->common->get_setting_value('2').$this->config->item('ad_main_upload_path');?><?php echo stripslashes($rightads[0]['image']); } ?>" alt="rightads" width="224" height="180" class="adimg" style="margin-left:5px;"/></a> </div>
     
		  <?php } ?>
        </td>
        </tr>
      </table>
      <?php }
		else if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'viewuser' ) ){ ?>
      <?php if( $this->session->flashdata('success') ) { ?>
      <!--  start message-green -->
      <div id="message-green">
        <table border="0" width="100%" cellpadding="0" cellspacing="0">
          <tr>
            <td class="green-left"><?php echo $this->session->flashdata('success'); ?></td>
            <td class="green-right"><a class="close-green"><img src="<?php echo base_url(); ?>images/messages/icon_close_green.gif" alt="Close"/></a></td>
          </tr>
        </table>
      </div>
      <!--  end message-green -->
      <?php } ?>
      <div class="dir_panel">
        <?php if(count($user)>0) { ?>
        <?php //echo "<pre>"; print_r($complaintbyuser); //die();?>
        <div class="dir_title" style="font-size:18px;">Profile for :&nbsp;<?php echo stripslashes($user[0]['username']); ?></div>
        <table width="95%" border="0" cellspacing="0" cellpadding="0" style="border:none">
          <tr height="80">
            <td width="200" valign="top"><div class="task-photo"> <img width="60px" src="<?php if( strlen($user[0]['avatarbig']) > 1 ){ echo $this->common->get_setting_value('2').$this->config->item('user_thumb_upload_path');?><?php echo stripslashes($user[0]['avatarbig']); } else { if($user[0]['gender']=='Male') { echo $this->common->get_setting_value('2')."images/male.png"; } 
		  	if($user[0]['gender']=='Female') { echo $this->common->get_setting_value('2')."images/female.png"; } 
		  } 
		   ?>" alt="<?php echo stripslashes($user[0]['username']); ?>"/> </div>
              <span class="rev-company"><?php echo "Joined on";?><br/>
              <?php echo date('d M, Y',strtotime($user[0]['registerdate']));?></span></td>
            <td width="700"><?php if( count($complaintbyuser) > 0 ) { ?>
              <span class="rev-company dir_title1">Complaints by&nbsp;<?php echo stripslashes($user[0]['username']); ?> </span><br/>
              <br/>
              <?php for($i=0; $i<count($complaintbyuser); $i++) { ?>
              <?php $company=$this->complaints->get_company_byid($complaintbyuser[$i]['companyid']);?>
              <div style="margin-bottom:10px;padding-bottom:10px;border-bottom: 1px dotted #CCCCCC;" class="user_view"><span>Company:</span><span>
                <?php if(count($company)>0) { ?>
                <a href="<?php echo site_url('company/'.$company[0]['companyseokeyword'].'/reviews/coupons/complaints');?>" title="view <?php echo stripslashes($company[0]['company']);?>'s detail"> <?php echo stripslashes($company[0]['company']);?>
                <?php } ?>
                </a></span><br/>
                <span style="padding-bottom:3px">Reported Damage:</span><span style="padding-bottom:3px">$<?php echo stripslashes($complaintbyuser[$i]['damagesinamt']);?></span><br/>
                <span style="padding-bottom:3px">Submitted:</span><span style="padding-bottom:3px"><?php echo date('d M, Y',strtotime($complaintbyuser[$i]['complaindate']));?></span><br/>
                <span style="padding-bottom:3px"><a href="<?php echo site_url('complaint/browse/'.$complaintbyuser[$i]['comseokeyword']);?>" title="view complaint detail"><?php echo strtolower(substr(stripslashes($complaintbyuser[$i]['detail']),0,150)."..."); ?></a></span> </div>
              <?php } } else { ?>
              <div style="margin-bottom:10px;"> <span class="rev-company user_title" style="font-size:14px;"> No Complaints by <?php echo stripslashes($user[0]['username']); ?></span> </div>
              <?php	} ?>
              <div class="blankdiv"></div>
              <?php if( count($commentbyuser) > 0 ) { ?>
              <span class="rev-company dir_title1">Comments by&nbsp;<?php echo stripslashes($user[0]['username']); ?> </span><br/>
              <br/>
              <?php for($i=0; $i<count($commentbyuser); $i++) { ?>
              <?php $company=$this->complaints->get_company_byid($commentbyuser[$i]['companyid']);?>
              <div style="margin-bottom:10px;padding-bottom:10px;border-bottom: 1px dotted #CCCCCC;" class="user_view"><span style="padding-bottom:3px">Company:</span><span style="padding-bottom:3px">
                <?php if(count($company)>0) { ?>
                <a href="<?php echo site_url('company/'.$company[0]['companyseokeyword'].'/reviews/coupons/complaints');?>" title="view <?php echo stripslashes($company[0]['company']);?>'s detail"> <?php echo stripslashes($company[0]['company']);?>
                <?php } ?>
                </a></span><br/>
                <span style="padding-bottom:3px">Commented:</span><span style="padding-bottom:3px"><?php echo date('d M, Y',strtotime($commentbyuser[$i]['reviewdate']));?> </span><br/>
                <span style="padding-bottom:3px"> <a href="<?php echo site_url('complaint/viewcomment/'.$commentbyuser[$i]['id']);?>" title="view comment detail"> <?php echo strtolower(substr(stripslashes($commentbyuser[$i]['comment']),0,150)."..."); ?></a></span> </div>
              <?php } } else { ?>
              <div style="margin-bottom:10px;"> <span class="user_title" style="font-size:14px;"> No Comments by <?php echo stripslashes($user[0]['username']); ?></span> </div>
              <?php } ?></td>
          </tr>
        </table>
        <?php } else {?>
        <div id="message-red">
          <table border="0" width="100%" cellpadding="0" cellspacing="0">
            <tr>
              <td class="red-left">No records found.</td>
              <td class="red-right"><img src="<?php echo base_url(); ?>images/messages/icon_close_red.png" alt="Close"/></td>
            </tr>
          </table>
        </div>
        <?php } ?>
      </div>
      <?php }
	else if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'browse' ) ){ ?>
      <div class="login_box_div" style="width:740px; margin-top:0; min-height:330px">
        <div class="box"> 
          <!-- Correct form message -->
          
          <?php if( $this->session->flashdata('success') ) { ?>
          <!--  start message-green -->
          <div id="message-green">
            <table border="0" width="100%" cellpadding="0" cellspacing="0">
              <tr>
                <td class="green-left"><?php echo $this->session->flashdata('success'); ?></td>
                <td class="green-right"><a class="close-green"><img src="<?php echo base_url(); ?>images/messages/icon_close_green.gif" alt="Close"/></a></td>
              </tr>
            </table>
          </div>
          <!--  end message-green -->
          <?php } ?>
          <?php if( $this->session->flashdata('error') ) { ?>
          <!--  start message-red -->
          <div id="message-red">
            <table border="0" width="100%" cellpadding="0" cellspacing="0">
              <tr>
                <td class="red-left"><?php echo $this->session->flashdata('error'); ?></td>
                <td class="red-right"><a class="close-red"><img src="<?php echo base_url(); ?>images/messages/icon_close_red.gif" alt="Close"/></a></td>
              </tr>
            </table>
          </div>
          <!--  end message-red -->
          <?php } ?>
          <!-- table -->
          <?php if( count($complaints) > 0 ) { ?>
          <?php $company=$this->complaints->get_company_byid($complaints[0]['companyid']);?>
          <?php $user=$this->users->get_user_byid($complaints[0]['userid']);?>
          <?php for($i=0; $i<count($complaints); $i++) { ?>
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td></td>
            </tr>
            <tr>
              <td width="460" valign="top" colspan="2"><div class="post_content_title" style="padding-bottom:0; height:auto"><?php echo ucfirst(stripslashes($complaints[$i]['company'])); ?></div></td>
            </tr>
            <tr height="50" valign="middle">
              <td colspan="3"><?php $date = date_default_timezone_set('Asia/Kolkata');                             
								$dbdate = date('Y-m-d',strtotime($complaints[$i]['whendate']));
                $postdate = date('Y-m-d',strtotime($complaints[$i]['complaindate']));?>
                <div class="timing"> <a> <?php echo "Date Occured: ";?><span><?php echo date('m/d/Y',strtotime($dbdate));?></span> </a> <a> <?php echo "Damage: ";?><span><?php echo '$'.$complaints[$i]['damagesinamt'];?></span> </a>
                  <?php if($complaints[$i]['type'] == 'Person' ){?>
                  <?php if($complaints[$i]['username'] != '' && $complaints[$i]['emailid'] != ''){?>
                  <a> <?php echo "Username: ";?><span><?php echo $complaints[$i]['username'];?></span> </a> <a> <?php echo "Email: ";?><span><?php echo $complaints[$i]['emailid'];?></span> </a>
                  <?php } }?>
                  <?php if($complaints[$i]['type'] == 'Person' || $complaints[$i]['type'] == 'Company'){?>
                  <?php if($complaints[$i]['location'] != '' ){?>
                  <a> <?php echo "Location: ";?><span><?php echo $complaints[$i]['location'];?></span> </a>
                  <?php } } ?>
                </div></td>
              <td></td>
              <td></td>
            </tr>
            <tr height="80">
              <td align="justify" colspan="2" style="padding-bottom:20px"><div class="post_content_dscr" style="word-wrap: break-word; margin-top:10px"> <?php echo nl2br(stripslashes($complaints[$i]['detail'])); ?> </div></td>
              <td></td>
              <td></td>
            </tr>
            <tr height="20">
              <td style="border-bottom: 1px solid #CCCCCC; width:200px;" colspan="3"></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><div class="post_username">
                  <?php if(count($user)>0){ ?>
                  <a href="<?php echo site_url('complaint/viewuser/'.$complaints[$i]['companyid'].'/'.$complaints[$i]['userid']);?>" title="view profile"><?php echo $user[$i]['username'];?></a>
                  <?php } else { ?>
                  <a href="#">Anonymous</a>
                  <?php }  ?>
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
                  <span><?php echo ($postdate==$today)?'Posted: '.$diff:'Posted: '.date('m/d/Y',strtotime($complaints[$i]['complaindate'])); ?></span> </div>
                <div style="margin-top:5px;margin-bottom:5px;" align="right" class="my"> <a href="<?php echo site_url('remove/complaint/'.$complaints[$i]['id'].'/'.$complaints[$i]['companyid']); ?>" title="Remove This Complaint" style="background-color:#FFFFFF;"><?php echo form_input(array('name'=>'submit','id'=>'btnphone','class'=>'complaint_btn','type'=>'submit','value'=>'Remove This Complaint','style'=>'padding:7px 25px;cursor: pointer;float:none;margin-top:-13px;padding:7px 5px')); ?></a> </div></td>
              <td></td>
            </tr>
          </table>
          <?php } ?>
          <?php } 
                else { ?>
          <tr>
            <td style="padding-left:20px"><!--  start message-red -->
              
              <div id="message-red">
                <table border="0" width="100%" cellpadding="0" cellspacing="0">
                  <tr>
                    <td class="red-left">No records found.</td>
                    <td class="red-right"><img src="<?php echo base_url(); ?>images/messages/icon_close_red.png" alt="Close"/></td>
                  </tr>
                </table>
              </div>
              
              <!--  end message-red --></td>
          </tr>
          <?php } ?>
          <!-- /pagination -->
          <?php  if($this->pagination->create_links()) { ?>
          <div class="pagination pagination-centered"> <?php echo $this->pagination->create_links(); ?> </div>
          <?php } ?>
          <!-- /pagination --> 
        </div>
      </div>
      <div class="profile-sidebar" style="border:none">
        <table border="0" cellspacing="0" cellpadding="0">
          <tr height="35">
            <td><b>Company Profile Summary</b></td>
          </tr>
          <tr>
            <td width="140"><div class="task-photo"> <img src="<?php if( $complaints[0]['logo'] ){ echo $this->common->get_setting_value('2').$this->config->item('company_thumb_upload_path');?><?php echo stripslashes($complaints[0]['logo']); } else{echo $this->common->get_setting_value('2').$this->config->item('company_thumb_upload_path')."/no_image.png"; } ?>" alt="<?php echo ucfirst(stripslashes($complaints[0]['company'])); ?>" style="border:1px solid #dcdcdc" width="100px" height="40px"/> </div></td>
          </tr>
          <tr height="35">
            <td><b>Company Statistics</b></td>
          </tr>
          <tr>
            <td class="company-wrap"><span>Complaint Against</span><br />
              <span><b><?php echo ucfirst($complaints[0]['company']); ?></b></span></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr height="35">
            <td class="company-wrap"><span>Total Complaints</span><br />
              <span><b><?php echo count($this->complaints->get_complaint_bycompanyid($complaints[0]['companyid'])); ?></b></span></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr height="35">
            <td class="company-wrap"><span>Total Damage</span><br />
              <span><b>$<?php echo $complaints[0]['damagesinamt']; ?></b></span></td>
          </tr>
        </table>
      </div>
      <div style="margin-top:10px;margin-bottom:10px;" align="right">
        <table border="0">
          <tr>
            <td><div style="margin-top:5px;margin-bottom:5px;margin-right:5px;" align="right" class="my"><a href="<?php echo site_url('company/'.$company[0]['companyseokeyword'].'/reviews/coupons/complaints');?>" title="visit complete company profile"><?php echo form_input(array('name'=>'btnsubmit','class'=>'complaint_btn','type'=>'submit','value'=>'visit complete company profile','style'=>'padding:0px 5px;font-size:14px;cursor: pointer;')); ?></a></div></td>
          </tr>
        </table>
      </div>
      <div style="margin-top:0px;margin-bottom:10px;margin-right:5px;float:right">
        <table border="0">
          <tr>
            <td width="40px"><span class="company_content_title">&nbsp;&nbsp;Do you have a complaint?</span></td>
          </tr>
          <tr>
            <td width="40px" class="company_dsr">Start with the name of the Company, Person or a Phone Number. Then select the complaint type to get started.</td>
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
        </table>
      </div>
      <?php }
	else if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'viewcomment' ) ){ ?>
      <div class="login_box_div" style="width:740px; margin-top:0; min-height:330px">
        <div class="box"> 
          <!-- Correct form message -->
          
          <?php if( $this->session->flashdata('success') ) { ?>
          <!--  start message-green -->
          <div id="message-green">
            <table border="0" width="100%" cellpadding="0" cellspacing="0">
              <tr>
                <td class="green-left"><?php echo $this->session->flashdata('success'); ?></td>
                <td class="green-right"><a class="close-green"><img src="<?php echo base_url(); ?>images/messages/icon_close_green.gif" alt="Close"/></a></td>
              </tr>
            </table>
          </div>
          <!--  end message-green -->
          <?php } ?>
          <?php if( $this->session->flashdata('error') ) { ?>
          <!--  start message-red -->
          <div id="message-red">
            <table border="0" width="100%" cellpadding="0" cellspacing="0">
              <tr>
                <td class="red-left"><?php echo $this->session->flashdata('error'); ?></td>
                <td class="red-right"><a class="close-red"><img src="<?php echo base_url(); ?>images/messages/icon_close_red.gif" alt="Close"/></a></td>
              </tr>
            </table>
          </div>
          <!--  end message-red -->
          <?php } ?>
          <?php if( count($comments) > 0 ) { ?>
          <?php $company=$this->complaints->get_company_byid($comments[0]['companyid']);?>
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td></td>
            </tr>
            <tr>
              <td width="460" valign="top" colspan="2"><div class="post_content_title" style="padding-bottom:0; height:auto"><?php echo stripslashes($comments[0]['company']); ?></div></td>
            </tr>
            <tr height="50" valign="middle">
              <td colspan="3"><?php $date = date_default_timezone_set('Asia/Kolkata');               
									    $dbdate = date('Y-m-d',strtotime($comments[0]['reviewdate'])); ?>
                <div class="timing"> <a> <?php echo "Date Occured: ";?><span><?php echo date('m/d/Y',strtotime($dbdate));?></span> </a> </div></td>
              <td></td>
              <td></td>
            </tr>
            <tr height="80">
              <td align="justify" colspan="2" style="padding-bottom:20px"><div class="post_content_dscr" style="width:auto; margin-top:10px"> <?php echo nl2br(stripslashes($comments[0]['comment'])); ?> </div></td>
              <td></td>
              <td></td>
            </tr>
            <tr height="20">
              <td style="border-bottom: 1px solid #CCCCCC; width:200px;" colspan="3"></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><div class="post_username"> <a href="<?php echo site_url('complaint/viewuser/'.$comments[0]['companyid'].'/'.$comments[0]['reviewby']);?>" title="view profile"><?php echo $comments[0]['username'];?></a>
                  <?php 
									  $date = date_default_timezone_set('Asia/Kolkata');                             
									  $reviewdate = date('m/d/Y',strtotime($comments[0]['reviewdate']));
									  $today = date('m/d/Y');
									  $d1 = strtotime(date('Y-m-d H:i:s'));
									  $d2 = strtotime($comments[0]['reviewdate']);
									  $newdate =round(($d1-$d2)/60);
									  if($newdate > 60){$diff = round(($d1-$d2)/60/60).' hours ago';}else{$diff = $newdate.' minutes ago';}
								?>
                  <span><?php echo ($reviewdate==$today)?'Posted: '.$diff:'Posted: '.date('m/d/Y',strtotime($comments[0]['reviewdate'])); ?></span> </div></td>
              <td></td>
            </tr>
          </table>
          <?php } 
                else { ?>
          <tr>
            <td style="padding-left:20px"><!--  start message-red -->
              
              <div id="message-red">
                <table border="0" width="100%" cellpadding="0" cellspacing="0">
                  <tr>
                    <td class="red-left">No records found.</td>
                    <td class="red-right"><img src="<?php echo base_url(); ?>images/messages/icon_close_red.png" alt="Close"/></td>
                  </tr>
                </table>
              </div>
              
              <!--  end message-red --></td>
          </tr>
          <?php } ?>
          <!-- /pagination -->
          <?php  if($this->pagination->create_links()) { ?>
          <div class="pagination pagination-centered"> <?php echo $this->pagination->create_links(); ?> </div>
          <?php } ?>
          <!-- /pagination --> 
        </div>
      </div>
      <div class="profile-sidebar" style="border:none">
        <table border="0" cellspacing="0" cellpadding="0">
          <tr height="35">
            <td><b>Company Profile Summary</b></td>
          </tr>
          <tr>
            <td width="140"><div class="task-photo"> <img src="<?php if( $comments[0]['logo'] ){ echo $this->common->get_setting_value('2').$this->config->item('company_thumb_upload_path');?><?php echo stripslashes($comments[0]['logo']); } else{echo $this->common->get_setting_value('2').$this->config->item('company_thumb_upload_path')."/no_image.png"; } ?>" alt="<?php echo ucfirst(stripslashes($comments[0]['company'])); ?>" style="border:1px solid #dcdcdc" width="100px" height="40px"/> </div></td>
          </tr>
          <tr height="35">
            <td><b>Company Statistics</b></td>
          </tr>
          <tr>
            <td class="company-wrap"><span>Complaint Against</span><br />
              <span><b><?php echo $comments[0]['company']; ?></b></span></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr height="35">
            <td class="company-wrap"><span>Total Complaints</span><br />
              <span><b><?php echo count($this->complaints->get_complaint_bycompanyid($comments[0]['companyid'])); ?></b></span></td>
          </tr>
        </table>
      </div>
      <div style="margin-top:10px;margin-bottom:10px;" align="right">
        <table border="0">
          <tr>
            <td><div style="margin-top:5px;margin-bottom:5px;margin-right:5px;" align="right" class="my">
                <?php $viewcompany=$this->complaints->get_company_byid($comments[0]['companyid']);?>
                <?php if(count($viewcompany)>0) { ?>
                <a href="<?php echo site_url('company/'.$viewcompany[0]['companyseokeyword'].'/reviews/coupons/complaints');?>" title="visit complete company profile"><?php echo form_input(array('name'=>'btnsubmit','class'=>'complaint_btn','type'=>'submit','value'=>'visit complete company profile','style'=>'padding:0px 5px;font-size:14px;cursor: pointer;')); ?></a>
                <?php } ?>
              </div></td>
          </tr>
        </table>
      </div>
      <div style="margin-top:0px;margin-bottom:10px;margin-right:5px;float:right">
        <table border="0">
          <tr>
            <td width="40px"><span class="company_content_title">&nbsp;&nbsp;Do you have a complaint?</span></td>
          </tr>
          <tr>
            <td width="40px" class="company_dsr">Start with the name of the Company, Person or a Phone Number. Then select the complaint type to get started.</td>
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
        </table>
      </div>
      <?php }
	  else if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'claimbusiness' ) ){ ?>
      <div class="login_box_div" style="width:740px; margin-top:0; min-height:330px"> 
        <script>
	$(document).ready(function() {
       $('.selectdrop').selectbox({ inputClass: "styledselectbox" });
     }); 
</script> 
        <script type="text/javascript" language="javascript">
              function trim(stringToTrim) {
                  return stringToTrim.replace(/^\s+|\s+$/g,"");
              }
              $(document).ready(function() {
                  $("#btnclaim").click(function () {
					  var ffilter = /^[a-zA-Z -]+$/; 
					  if( trim($("#firstname").val()) == "" )
					  {
						  $("#fnameerror").show();
						  $("#fnameverror").hide();
						  $("#firstname").val('').focus();
						  return false;
					  }
					  else
					  {
						  if( !ffilter.test(trim($("#firstname").val())) )
						  {
							  $("#fnameerror").hide();
							  $("#fnameverror").show();
							  $("#firstname").val('').focus();
							  return false;
						  }
						  else
						  {
							  $("#fnameverror").hide();
							  $("#fnameerror").hide();
						  }
					  }
					  if( trim($("#lastname").val()) == "" )
					  {
						  $("#lnameerror").show();
						  $("#lnameverror").hide();
						  $("#lastname").val('').focus();
						  return false;
					  }
					  else
					  {
						  if( !ffilter.test(trim($("#lastname").val())) )
						  {
							  $("#lnameerror").hide();
							  $("#lnameverror").show();
							  $("#lastname").val('').focus();
							  return false;
						  }
						  else
						  {
							  $("#lnameverror").hide();
							  $("#lnameerror").hide();
						  }
					  }
					  if( trim($("#address").val()) == "" )
					  {
						  $("#adderror").show();
						  $("#address").val('').focus();
						  return false;
					  }
					  else
					  {
						  $("#adderror").hide();
					  }
					  
					   var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
					   if( trim($("#email").val()) == "" )
					    {	
						  $("#emailverror").hide();
						  $("#emailerror").show();
						  $("#email").val('').focus();
						  return false;
					  	}
						  else
						{
						  if( !filter.test(trim($("#email").val())) )
						  {
							$("#emailerror").hide();
							$("#emailverror").show();
							$("#email").val('').focus();
							return false;
						  }
						  else
						  {
							$("#emailerror").hide();
							$("#emailverror").hide();
						  }
					  	}
								
					  if( trim($("#selcountry").val()) == "" )
					  {
						  $("#cntryerror").show();
						  $("#selcountry").focus();
						  return false;
					  }
					  else
					  {
						  $("#cntryerror").hide();
					  }
					  if( trim($("#state").val()) == "" )
					  {
						  $("#stateerror").show();
						  $("#state").val('').focus();
						  return false;
					  }
					  else
					  {
						  $("#stateerror").hide();
					  }
					  if( trim($("#city").val()) == "" )
					  {
						  $("#cityerror").show();
						  $("#city").val('').focus();
						  return false;
					  }
					  else
					  {
						  $("#cityerror").hide();
					  }
					  if( trim($("#zipcode").val()) == "" )
					  {
						  $("#ziperror").show();
						  $("#zipverror").hide();
						  $("#zipcode").val('').focus();
						  return false;
					  }
					  else
					  {
						  if( isNaN(trim($("#zipcode").val())) )
						  {
							  $("#ziperror").hide();
							  $("#zipverror").show();
							  $("#zipcode").val('').focus();
							  return false;
						  }
						  else
						  {
							  $("#zipverror").hide();
							  $("#ziperror").hide();
						  }
					  }
					  if( trim($("#selcardtype").val()) == "" )
					  {
						  $("#cardtypeerror").show();
						  $("#selcardtype").focus();
						  return false;
					  }
					  else
					  {
						  $("#cardtypeerror").hide();
					  }
					  if( trim($("#cardnumber").val()) == "" )
					  {
						  $("#cardnoerror").show();
						  $("#cardnoverror").hide();
						  $("#cardnumber").val('').focus();
						  return false;
					  }
					  else
					  {
						  if( isNaN(trim($("#cardnumber").val())) )
						  {
							  $("#cardnoerror").hide();
							  $("#cardnoverror").show();
							  $("#cardnumber").val('').focus();
							  return false;
						  }

						  else
						  {
							  $("#cardnoverror").hide();
							  $("#cardnoerror").hide();
						  }
					  }
					  if( trim($("#cvcnumber").val()) == "" )
					  {
						  $("#cvcnoerror").show();
						  $("#cvcnoverror").hide();
						  $("#cvcnumber").val('').focus();
						  return false;
					  }
					  else
					  {
						  if( isNaN(trim($("#cvcnumber").val())) )
						  {
							  $("#cvcnoerror").hide();
							  $("#cvcnoverror").show();
							  $("#cvcnumber").val('').focus();
							  return false;
						  }
						  else
						  {
							  $("#cvcnoverror").hide();
							  $("#cvcnoerror").hide();
						  }
					  }
					  if( trim($("#selexpmonth").val()) == "" )
					  {
						  $("#montherror").show();
						  $("#selexpmonth").focus();
						  return false;
					  }
					  else
					  {
						  $("#montherror").hide();
					  }
					  if( trim($("#selexpyear").val()) == "" )
					  {
						  $("#yearerror").show();
						  $("#selexpyear").focus();
						  return false;
					  }
					  else
					  {
						  $("#yearerror").hide();
					  }
					  
					  if(!$("#readterms").is(":checked") )
		                      	{
        			                 alert("Please read Terms and Conditions")
			                         return false;
            		          	}
																
								if(!$("#terms").is(":checked") )
		                      	{
        			                 
									 alert("Please Agree with Terms and Conditions")
									 return false;
            		          	}
                    
					  $("#frmclaim").submit();
                  });
              });
          </script> 
        <!-- box -->
        
        <div class="dir_title" style="padding-bottom:15px;margin-top:15px;">Elite Membership</div>
        <?php if( $this->session->flashdata('success') ) { ?>
        <!--  start message-green -->
        <div id="message-green">
          <table border="0" width="100%" cellpadding="0" cellspacing="0">
            <tr>
              <td class="green-left"><?php echo $this->session->flashdata('success'); ?></td>
              <td class="green-right"><a class="close-green"><img src="<?php echo base_url(); ?>images/messages/icon_close_green.gif" alt="Close"/></a></td>
            </tr>
          </table>
        </div>
        <!--  end message-green -->
        <?php } ?>
        <?php if( $this->session->flashdata('error') ) { ?>
        <!--  start message-red -->
        <div id="message-red">
          <table border="0" width="100%" cellpadding="0" cellspacing="0">
            <tr>
              <td class="red-left"><?php echo $this->session->flashdata('error'); ?></td>
              <td class="red-right"><a class="close-red"><img src="<?php echo base_url(); ?>images/messages/icon_close_red.gif" alt="Close"/></a></td>
            </tr>
          </table>
        </div>
        <!--  end message-red -->
        <?php } ?>
        <?php echo form_open_multipart('complaint/update_claim',array('class'=>'formBox','id'=>'frmclaim')); ?>
        <table class="data_table" align="left" width="900px">
          <tbody>
            <tr>
              <td class="box_label" width="180px"><label for="firstname">First Name</label>
                <span class="error-sign">*</span></td>
              <td><?php echo form_input( array( 'name'=>'firstname','id'=>'firstname','class'=>'box_txtbox','type'=>'text' ) ) ; ?></td>
              <td width="320px"><div id="fnameerror" class="error">First Name is required.</div>
                <div id="fnameverror" class="error">Enter Valid First Name.</div></td>
            </tr>
            <tr>
              <td class="box_label"><label for="lastname">Last Name</label>
                <span class="error-sign">*</span></td>
              <td><?php echo form_input( array( 'name'=>'lastname','id'=>'lastname','class'=>'box_txtbox','type'=>'text' ) ); ?></td>
              <td><div id="lnameerror" class="error">Last Name is required.</div>
                <div id="lnameverror" class="error">Enter Valid Last Name.</div></td>
            </tr>
            <tr>
              <td class="box_label" width="180px"><label for="address">Address</label>
                <span class="error-sign">*</span></td>
              <td><?php echo form_input( array( 'name'=>'address','id'=>'address','class'=>'box_txtbox','type'=>'text' ) ); ?></td>
              <td><div id="adderror" class="error">Address is required.</div></td>
            </tr>
            <tr>
              <td class="box_label" width="180px"><label for="email">Email</label>
                <span class="error-sign">*</span></td>
              <td><?php echo form_input( array( 'name'=>'email','id'=>'email','class'=>'box_txtbox','type'=>'text' ) ); ?></td>
              <td><div id="emailerror" class="error">Email is required.</div>
                <div id="emailverror" class="error">Enter valid Emailid.</div></td>
            </tr>
            <tr>
              <td class="box_label"><label for="selcountry">Country</label>
                <span class="error-sign">*</span></td>
              <td><?php echo form_dropdown('selcountry',$selcountry,'','id="selcountry" class="selectdrop"' ); ?></td>
              <td><div id="cntryerror" class="error">Select Country.</div></td>
            </tr>
            <tr>
              <td class="box_label"><label for="state">State</label>
                <span class="error-sign">*</span></td>
              <td><?php echo form_input( array( 'name'=>'state','id'=>'state','class'=>'box_txtbox','type'=>'text' ) ); ?></td>
              <td><div id="stateerror" class="error">State is required.</div></td>
            </tr>
            <tr>
              <td class="box_label"><label for="city">City</label>
                <span class="error-sign">*</span></td>
              <td><?php echo form_input( array( 'name'=>'city','id'=>'city','class'=>'box_txtbox','type'=>'text' ) ); ?></td>
              <td><div id="cityerror" class="error">City is required.</div></td>
            </tr>
            <tr>
              <td class="box_label"><label for="zipcode">Zip Code</label>
                <span class="error-sign">*</span></td>
              <td><?php echo form_input( array( 'name'=>'zipcode','id'=>'zipcode','class'=>'box_txtbox','type'=>'text' ) ); ?></td>
              <td><div id="ziperror" class="error">Zip Code is required.</div>
                <div id="zipverror" class="error">Enter Only digits.</div></td>
            </tr>
            <tr>
              <td class="box_label"><label for="selcardtype">Card Type</label>
                <span class="error-sign">*</span></td>
              <td><?php echo form_dropdown('selcardtype',$selcardtype,'','id="selcardtype" class="selectdrop"' ); ?></td>
              <td><div id="cardtypeerror" class="error">Select Card Type.</div></td>
            </tr>
            <tr>
              <td class="box_label"><label for="cardnumber">Card Number</label>
                <span class="error-sign">*</span></td>
              <td><?php echo form_input( array( 'name'=>'cardnumber','id'=>'cardnumber','class'=>'box_txtbox','type'=>'text' ) ); ?></td>
              <td><div id="cardnoerror" class="error">Card Number is required.</div>
                <div id="cardnoverror" class="error">Enter Only digits.</div></td>
            </tr>
            <tr>
              <td class="box_label"><label for="cvcnumber">Card Verification Number</label>
                <span class="error-sign">*</span></td>
              <td><?php echo form_input( array( 'name'=>'cvcnumber','id'=>'cvcnumber','class'=>'box_txtbox','type'=>'text' ) ); ?></td>
              <td><div id="cvcnoerror" class="error">Card Verification Number is required.</div>
                <div id="cvcnoverror" class="error">Enter Only digits.</div></td>
            </tr>
            <tr>
              <td class="box_label"><label for="selexpmonth">Expiration Month</label>
                <span class="error-sign">*</span></td>
              <td><?php echo form_dropdown('selexpmonth',$selexpmonth,'','id="selexpmonth" class="selectdrop"' ) ; ?></td>
              <td><div id="montherror" class="error">Select Expiration Month.</div></td>
            </tr>
            <tr>
              <td class="box_label"><label for="selexpyear">Expiration Year</label>
                <span class="error-sign">*</span></td>
              <td><?php echo form_dropdown('selexpyear',$selexpyear,'','id="selexpyear" class="selectdrop"' ) ; ?></td>
              <td><div id="yearerror" class="error">Select Expiration Year.</div></td>
            </tr>
            <tr>
              <td></td>
              <td colspan="2"><?php echo form_checkbox(array('name'=>'readterms','type'=>'checkbox','id'=>'readterms','value'=>'Yes')); ?>&nbsp;I have read the <a href="<?php echo site_url('eliteterms');?>" target="_blank" class="colorcode">Terms and Conditions</a><br/>
                <?php echo form_checkbox(array('name'=>'terms','type'=>'checkbox','id'=>'terms','value'=>'Yes')); ?>&nbsp;I agree to the terms and conditions 
            </tr>
            <tr>
              <td></td>
              <td><!-- Submit form --> 
                <?php echo form_input(array('name'=>'btnclaim','id'=>'btnclaim','class'=>'dir-searchbtn','type'=>'submit','value'=>'Claim Business','style'=>'float:none;color:#fff; padding: 3px 16px;font-size:15px;text-shadow:none;')); ?>
              <td></td>
            </tr>
          </tbody>
        </table>
        <?php echo form_hidden( array( 'companyid'=> $this->encrypt->encode($company[0]['id']) ) ); ?> <?php echo form_close(); ?> 
        <!-- /box-content --> 
        
      </div>
      <?php }
		else if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'advfilter' ))	
		{
		 ?>
      <style>
			.advfilterspan span:hover{width:auto; margin-right:3px; padding:3px 5px; background:#0573bf; height:auto; font-family:Verdana, Geneva, sans-serif; font-size:12px; color:#fff; border-radius:5px;}

			</style>
      <!-- Correct form message -->
      
      <div class="left_content_panel">
        <div class="treding_title">Trending  Searches <span>Last 7 Days</span></div>
        <div class="treding_lnk">
          <?php if(count($keywords)>0){ ?>
          <?php //echo '<pre>'; print_r($keywords);?>
          <?php for($i=0; $i<count($keywords); $i++)
                { ?>
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
        </table>
      </div>
      <div class="right_content_panel">
        <div class="treding_title">Yougotrated Live</div>
        <div class="filter"><span style="font-size:14px; font-weight:bold;">Filter by :</span> <a href="<?php echo site_url('welcome');?>">Recent Activity</a> <a href="<?php echo site_url('complaint/weektrending');?>">Trending Complaints (7 Days)</a><!-- <a href="#">Most Active (7 Days)</a>--><a href="<?php echo site_url('complaint/advfilter');?>" class="filter_active">Advance Filter</a></div>
      </div>
      <div class="main_livepost" id="filterbox" style="margin-left:22px;"> 
        <script type="text/javascript">
						 $(document).ready(function(){

							$('#fsubdate').datepicker({
								dateFormat : 'mm/dd/yy',
								maxDate: new Date,
								onSelect: function(selected) {
					            $("#tsubdate").datepicker("option","minDate", selected)
								}
							});
							$('#tsubdate').datepicker({
								dateFormat : 'mm/dd/yy',
								maxDate: new Date,
								onSelect: function(selected) {
					            $("#fsubdate").datepicker("option","maxDate", selected)
								}
							});
							$('#foccdate').datepicker({
								dateFormat : 'mm/dd/yy',
								maxDate: new Date,
								onSelect: function(selected) {
					            $("#toccdate").datepicker("option","minDate", selected)
								}
							});
							$('#toccdate').datepicker({
								dateFormat : 'mm/dd/yy', maxDate: new Date,
								onSelect: function(selected) {
					            $("#foccdate").datepicker("option","maxDate", selected)
								}
							});
							});
					</script> 
        <script type="text/javascript">
					function trim(stringToTrim) {
              return stringToTrim.replace(/^\s+|\s+$/g,"");
          }
					$(document).ready(function(){	 
					
							$("#btnfiltersubmit").click(function () {

								 if(trim($("#fsubdate").val()) == "")
									{
										$("#fsubdate").val('').focus();
										$("#fsubdate").css("border", "1px solid #CD0B1C");
									  return false;
									}
									else
									{
										$("#fsubdate").css("border", "1px solid #EEE");
									}
									
									if(trim($("#tsubdate").val()) == "")
									{
										$("#tsubdate").val('').focus();
										$("#tsubdate").css("border", "1px solid #CD0B1C");
									  return false;
									}
									else
									{
										$("#tsubdate").css("border", "1px solid #EEE");
									}
									
									if(trim($("#foccdate").val()) == "")
									{
										$("#foccdate").val('').focus();
										$("#foccdate").css("border", "1px solid #CD0B1C");
									  return false;
									}
									else
									{
										$("#foccdate").css("border", "1px solid #EEE");
									}
									
									if(trim($("#toccdate").val()) == "")
									{
										$("#toccdate").val('').focus();
										$("#toccdate").css("border", "1px solid #CD0B1C");
									  return false;
									}
									else
									{
										$("#toccdate").css("border", "1px solid #EEE");
									}
								
								if (!isCheckedById("type"))
									{
										$("#checktypeerror").show();
										return false;
									}				
								else
									{
										$("#checktypeerror").hide();
									}				
				
									function isCheckedById(id)
									{
										var checked = $("input[@id="+id+"]:checked").length;
										//alert(checked);
										if (checked == 0)
										{
											return false;
										}
										else
										{
											return true;
										}
									}
									
							});
						 });
							</script> 
        <?php echo form_open('complaint/filter',array('id'=>'frmfilter')); ?>
        <table border="0">
          <tr>
            <td style="font-size:12px;">Date Submitted</td>
            <td align="center" style="font-size:12px;">from</td>
            <td><?php echo form_input( array( 'name'=>'fsubdate','id'=>'fsubdate','type'=>'text','class'=>'datetimepicker','readonly'=>'readonly' ) ); ?></td>
            <td align="center" style="font-size:12px;">to</td>
            <td><?php echo form_input( array( 'name'=>'tsubdate','id'=>'tsubdate','type'=>'text','class'=>'datetimepicker','readonly'=>'readonly' ) ); ?></td>
          </tr>
          <tr>
            <td style="font-size:12px;">Date Occurred</td>
            <td align="center" style="font-size:12px;">from</td>
            <td><?php echo form_input( array( 'name'=>'foccdate','id'=>'foccdate','type'=>'text','class'=>'datetimepicker','readonly'=>'readonly' ) ); ?></td>
            <td align="center" style="font-size:12px;">to</td>
            <td><?php echo form_input( array( 'name'=>'toccdate','id'=>'toccdate','type'=>'text','class'=>'datetimepicker','readonly'=>'readonly' ) ); ?></td>
          </tr>
          <tr>
            <td style="font-size:12px;">Complaint Type</td>
            <td></td>
            <td colspan="3" style="font-size:12px;"><?php echo form_checkbox(array('name'=>'type[]','type'=>'checkbox','id[]'=>'company','value'=>'Company')); ?> Company<br />
              <?php echo form_checkbox(array('name'=>'type[]','type'=>'checkbox','id[]'=>'person','value'=>'Person')); ?> Person<br />
              <?php echo form_checkbox(array('name'=>'type[]','type'=>'checkbox','id[]'=>'phone','value'=>'Phone')); ?> Phone</td>
            <td>
          </tr>
          <tr>
            <td></td>
            <td></td>
            <td colspan="3"><div id="checktypeerror" class="error" style="padding-bottom:5px">Select type.</div></td>
          </tr>
          <tr>
            <td></td>
            <td></td>
            <td colspan="3"><?php echo form_input(array('name'=>'btnfiltersubmit','id'=>'btnfiltersubmit','class'=>'dir-searchbtn','type'=>'submit','value'=>'Filter','style'=>'float:none;color:#fff; padding: 3px 16px;font-size:15px;text-shadow:none;')); ?></td>
          </tr>
        </table>
        <?php echo form_close();?> </div>
      <?php 
		
		}
		
		else if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'weektrending' ) )	
		{ ?>
      <!-- Correct form message -->
      
      <?php if( $this->session->flashdata('success') ) { ?>
      <!--  start message-green -->
      <div id="message-green">
        <table border="0" width="100%" cellpadding="0" cellspacing="0">
          <tr>
            <td class="green-left"><?php echo $this->session->flashdata('success'); ?></td>
            <td class="green-right"><a class="close-green"><img src="<?php echo base_url(); ?>images/messages/icon_close_green.gif" alt="Close"/></a></td>
          </tr>
        </table>
      </div>
      <!--  end message-green -->
      <?php } ?>
      <?php if( $this->session->flashdata('error') ) { ?>
      <!--  start message-red -->
      <div id="message-red">
        <table border="0" width="100%" cellpadding="0" cellspacing="0">
          <tr>
            <td class="red-left"><?php echo $this->session->flashdata('error'); ?></td>
            <td class="red-right"><a class="close-red"><img src="<?php echo base_url(); ?>images/messages/icon_close_red.gif" alt="Close"/></a></td>
          </tr>
        </table>
      </div>
      <!--  end message-red -->
      <?php } ?>
      <div class="left_content_panel">
        <div class="treding_title">Trending  Searches <span>Last 7 Days</span></div>
        <div class="treding_lnk">
          <?php if(count($keywords)>0){?>
          <?php //echo '<pre>'; print_r($keywords);?>
          <?php for($i=0; $i<count($keywords); $i++)
                { ?>
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
        </table>
      </div>
      <div class="right_content_panel">
        <div class="treding_title">Yougotrated Live</div>
        <div class="filter"><span style="font-size:14px; font-weight:bold;">Filter by :</span> <a href="<?php echo site_url('complaint');?>">Recent Activity</a> <a href="<?php echo site_url('complaint/weektrending');?>" class="filter_active">Trending Complaints (7 Days)</a><!-- <a href="#">Most Active (7 Days)</a>--><a href="<?php echo site_url('complaint/advfilter');?>"><span class="advfilterspan"><span id="advfilter" style="cursor: pointer;">Advance Filter</span></span></a></div>
        <?php if(count($lastweekcomplaints)>0) { ?>
        <?php for($i=0; $i<count($lastweekcomplaints); $i++) { ?>
        <?php $user=$this->users->get_user_byid($lastweekcomplaints[$i]['userid']);?>
        <?php $company=$this->complaints->get_company_byid($lastweekcomplaints[$i]['companyid'])?>
        <?php //echo "<pre>"; print_r($lastweekcomplaints); die();?>
        <div class="main_livepost">
          <div class="view_all">
            <?php if(count($company)>0) { ?>
            <a href="<?php echo site_url('company/'.$company[0]['companyseokeyword'].'reviews/coupons/complaints');?>" title="view all"> <span>
            <h3>
              <?php $num=$this->complaints->get_complaint_bycompanyid($lastweekcomplaints[$i]['companyid']);?>
              <?php if(count($num)>0){?>
              <?php echo count($num);?>
              <?php }else{"0";}?>
            </h3>
            Related<br>
            Reports </span>
            <?php } ?>
            </a> <!--<span>-->
            <?php if(count($company)>0) { ?>
            <a href="<?php echo site_url('company/'.$company[0]['companyseokeyword'].'reviews/coupons/complaints');?>" title="view all">View All</a>
            <?php } ?>
            <!--</span>--> </div>
          <div class="post_maincontent">
            <?php if(count($company)>0) { ?>
            <div class="side-image"> <a href="<?php echo site_url('complaint/browse/'.$lastweekcomplaints[$i]['comseokeyword']); ?>" title="view complaint detail"><img src="<?php if( $company[0]['logo'] ){ echo $this->common->get_setting_value('2').$this->config->item('company_thumb_upload_path');?><?php echo stripslashes($company[0]['logo']); } else{echo $this->common->get_setting_value('2').$this->config->item('company_thumb_upload_path')."/no_image.png"; } ?>" alt="<?php echo ucfirst(stripslashes($company[0]['company'])); ?>" width="100px" height="40px"/></a> </div>
            <?php } ?>
            <?php if(count($company)>0) { ?>
            <div class="post_content_title"><a href="<?php echo site_url('complaint/browse/'.$lastweekcomplaints[$i]['comseokeyword']); ?>" title="view complaint detail"><?php echo ucfirst(stripslashes($company[0]['company'])); ?></a></div>
            <?php } ?>
            <div class="post_content_dscr user_view" style="margin-top:2px;width: -moz-available;"> <a href="<?php echo site_url('complaint/browse/'.$lastweekcomplaints[$i]['comseokeyword']); ?>" title="view complaint detail"><?php echo strtolower(substr(stripslashes($lastweekcomplaints[$i]['detail']),0,212)."..."); ?></a> </div>
            <?php       $date = date_default_timezone_set('Asia/Kolkata');                             
                        $dbdate = date('Y-m-d',strtotime($lastweekcomplaints[$i]['whendate']));
                        $complaindate = date('m/d/Y',strtotime($lastweekcomplaints[$i]['complaindate']));
                        $today = date('m/d/Y');
                        $d1 = strtotime(date('Y-m-d H:i:s'));
                        $d2 = strtotime($lastweekcomplaints[$i]['complaindate']);
                        $newdate =round(($d1-$d2)/60);
                        if($newdate > 60){$diff = round(($d1-$d2)/60/60).' hours ago';}else{$diff = $newdate.' minutes ago';}
                        ?>
            <div class="timing"> <a href="<?php echo site_url('complaint/browse/'.$lastweekcomplaints[$i]['comseokeyword']); ?>" title="view complaint detail">Date occurred: <span><?php echo date('m/d/Y',strtotime($dbdate));?></span> </a> <a href="<?php echo site_url('complaint/browse/'.$lastweekcomplaints[$i]['comseokeyword']); ?>" title="view complaint detail">Reported Damage: <span>$<?php echo $lastweekcomplaints[$i]['damagesinamt'];?></span> </a>
              <?php if(count($company)>0) {?>
              <a href="<?php echo site_url('remove/complaint/'.$lastweekcomplaints[$i]['id'].'/'.$lastweekcomplaints[$i]['companyid']); ?>" title="Remove this complaint" style="background-color:#FFFFFF;">
              <input type="submit" name="submit" value="Remove" class="remove_btn" title="Remove this complaint" style="margin-top:-2px;"/>
              </a>
              <?php }  ?>
            </div>
            <div class="post_username">
              <?php if($lastweekcomplaints[$i]['userid']!=0){ ?>
              <?php if(count($user)>0){ ?>
              <a href="<?php echo site_url('complaint/viewuser/'.$lastweekcomplaints[$i]['companyid'].'/'.$lastweekcomplaints[$i]['userid']); ?>" title="view profile"><?php echo $user[0]['username'];?></a>
              <?php } ?>
              <?php } else{ ?>
              <a href="#">Anonymous</a>
              <?php } ?>
              <a href="<?php echo site_url('complaint/browse/'.$lastweekcomplaints[$i]['comseokeyword']); ?>" title="view complaint detail"><span><?php echo ($complaindate==$today)?'Posted: '.$diff:'Posted: '.date('m/d/Y',strtotime($lastweekcomplaints[$i]['complaindate'])); ?></span></a> </div>
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
        <?php } }
				else{ ?>
        <div class="main_livepost">
          <div class="post_maincontent">
            <div id="message-red">
              <table border="0" width="100%" cellpadding="0" cellspacing="0">
                <tr>
                  <td class="red-left">No records found.</td>
                  <td class="red-right"><img src="<?php echo base_url(); ?>images/messages/icon_close_red.png" alt="Close"/></td>
                </tr>
              </table>
            </div>
          </div>
        </div>
        <?php } ?>
      </div>
      <?php 
		}
		else if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'filter' ) )	
		{ ?>
      <!-- Correct form message -->
      
      <?php if( $this->session->flashdata('success') ) { ?>
      <!--  start message-green -->
      <div id="message-green">
        <table border="0" width="100%" cellpadding="0" cellspacing="0">
          <tr>
            <td class="green-left"><?php echo $this->session->flashdata('success'); ?></td>
            <td class="green-right"><a class="close-green"><img src="<?php echo base_url(); ?>images/messages/icon_close_green.gif" alt="Close"/></a></td>
          </tr>
        </table>
      </div>
      <!--  end message-green -->
      <?php } ?>
      <?php if( $this->session->flashdata('error') ) { ?>
      <!--  start message-red -->
      <div id="message-red">
        <table border="0" width="100%" cellpadding="0" cellspacing="0">
          <tr>
            <td class="red-left"><?php echo $this->session->flashdata('error'); ?></td>
            <td class="red-right"><a class="close-red"><img src="<?php echo base_url(); ?>images/messages/icon_close_red.gif" alt="Close"/></a></td>
          </tr>
        </table>
      </div>
      <!--  end message-red -->
      <?php } ?>
      <div class="left_content_panel">
        <div class="treding_title">Trending  Searches <span>Last 7 Days</span></div>
        <div class="treding_lnk">
          <?php if(count($keywords)>0){?>
          <?php //echo '<pre>'; print_r($keywords);?>
          <?php for($i=0; $i<count($keywords); $i++)
                { ?>
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
        </table>
      </div>
      <div class="right_content_panel">
        <div class="treding_title">Yougotrated Live</div>
        <div class="filter"><span style="font-size:14px;font-weight:bold;">Filter by :</span> <a href="<?php echo site_url('complaint');?>">Recent Activity</a> <a href="<?php echo site_url('complaint/weektrending');?>">Trending Complaints (7 Days)</a><!-- <a href="#">Most Active (7 Days)</a>--> <a href="<?php echo site_url('complaint/advfilter');?>" class="filter_active">Advance Filter</a></div>
        <?php if(count($filtercomplaints)>0) { ?>
        <?php //echo "<pre>"; print_r($filtercomplaints); die();?>
        <?php for($i=0; $i<count($filtercomplaints); $i++) { ?>
        <?php $user=$this->users->get_user_byid($filtercomplaints[$i]['userid']);?>
        <?php $company=$this->complaints->get_company_byid($filtercomplaints[$i]['companyid'])?>
        <?php //echo "<pre>"; print_r($lastweekcomplaints); die();?>
        <div class="main_livepost">
          <div class="view_all"><a href="<?php echo site_url('company').'/'.$company[0]['companyseokeyword'].'/reviews/coupons/complaints';?>" title="view all"> <span>
            <h3>
              <?php $num=$this->complaints->get_complaint_bycompanyid($filtercomplaints[$i]['companyid']);?>
              <?php if(count($num)>0){?>
              <?php echo count($num);?>
              <?php }else{"0";}?>
            </h3>
            Related<br>
            Reports </span></a> <!--<span>--><a href="<?php echo site_url('company').'/'.$company[0]['companyseokeyword'].'/reviews/coupons/complaints';?>" title="view all">View All</a><!--</span>--> </div>
          <div class="post_maincontent">
            <?php if(count($company)>0) { ?>
            <div class="side-image"> <a href="<?php echo site_url('complaint/browse/'.$filtercomplaints[$i]['comseokeyword']); ?>" title="view complaint detail"><img src="<?php if( $company[0]['logo'] ){ echo $this->common->get_setting_value('2').$this->config->item('company_thumb_upload_path');?><?php echo stripslashes($company[0]['logo']); } else{echo $this->common->get_setting_value('2').$this->config->item('company_thumb_upload_path')."/no_image.png"; } ?>" alt="<?php echo ucfirst(stripslashes($company[0]['company'])); ?>" width="100px" height="40px"/></a> </div>
            <?php } ?>
            <?php if(count($company)>0) { ?>
            <div class="post_content_title"><a href="<?php echo site_url('complaint/browse/'.$filtercomplaints[$i]['comseokeyword']); ?>" title="view complaint detail"><?php echo stripslashes($company[0]['company']); ?></a></div>
            <?php } ?>
            <div class="post_content_dscr user_view" style="margin-top:2px;width: -moz-available;"> <a href="<?php echo site_url('complaint/browse/'.$filtercomplaints[$i]['comseokeyword']); ?>" title="view complaint detail"><?php echo strtolower(substr(stripslashes($filtercomplaints[$i]['detail']),0,212)."..."); ?></a> </div>
            <?php 
                        $date = date_default_timezone_set('Asia/Kolkata');                             
                        $dbdate = date('Y-m-d',strtotime($filtercomplaints[$i]['whendate']));
                        $complaindate = date('m/d/Y',strtotime($filtercomplaints[$i]['complaindate']));
                        $today = date('m/d/Y');
                        $d1 = strtotime(date('Y-m-d H:i:s'));
                        $d2 = strtotime($filtercomplaints[$i]['complaindate']);
                        $newdate =round(($d1-$d2)/60);
                        if($newdate > 60){$diff = round(($d1-$d2)/60/60).' hours ago';}else{$diff = $newdate.' minutes ago';}
                        ?>
            <div class="timing"> <a href="<?php echo site_url('complaint/browse/'.$filtercomplaints[$i]['comseokeyword']); ?>" title="view complaint detail">Date occurred: <span><?php echo date('m/d/Y',strtotime($dbdate));?></span> </a> <a href="<?php echo site_url('complaint/browse/'.$filtercomplaints[$i]['comseokeyword']); ?>" title="view complaint detail">Reported Damage: <span>$<?php echo $filtercomplaints[$i]['damagesinamt'];?></span> </a>
              <?php if(count($company)>0) { ?>
              <a href="<?php echo site_url('remove/complaint/'.$filtercomplaints[$i]['id'].'/'.$filtercomplaints[$i]['companyid']); ?>" title="Remove this complaint" style="background-color:#FFFFFF;">
              <input type="submit" name="submit" value="Remove" class="remove_btn" title="Remove this complaint" style="margin-top:-2px;"/>
              </a>
              <?php
														 }?>
            </div>
            <div class="post_username">
              <?php if($filtercomplaints[$i]['userid']!=0){ ?>
              <a href="<?php echo site_url('complaint/viewuser/'.$filtercomplaints[$i]['companyid'].'/'.$filtercomplaints[$i]['userid']); ?>" title="view profile"><?php echo $user[0]['username'];?></a>
              <?php } else{ ?>
              <a href="#">Anonymous</a>
              <?php } ?>
              <a href="<?php echo site_url('complaint/browse/'.$filtercomplaints[$i]['comseokeyword']); ?>" title="view complaint detail"><span><?php echo ($complaindate==$today)?'Posted: '.$diff:'Posted: '.date('m/d/Y',strtotime($filtercomplaints[$i]['complaindate'])); ?></span></a> </div>
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
        <?php } }
				else{ ?>
        <div class="main_livepost">
          <div class="post_maincontent">
            <div id="message-red">
              <table border="0" width="100%" cellpadding="0" cellspacing="0">
                <tr>
                  <td class="red-left">No records found.</td>
                  <td class="red-right"><img src="<?php echo base_url(); ?>images/messages/icon_close_red.png" alt="Close"/></td>
                </tr>
              </table>
            </div>
          </div>
        </div>
        <?php } ?>
      </div>
      <?php 
		}	
		 else { ?>
      <!-- Correct form message -->
      
      <?php if( $this->session->flashdata('success') ) { ?>
      <!--  start message-green -->
      <div id="message-green">
        <table border="0" width="100%" cellpadding="0" cellspacing="0">
          <tr>
            <td class="green-left"><?php echo $this->session->flashdata('success'); ?></td>
            <td class="green-right"><a class="close-green"><img src="<?php echo base_url(); ?>images/messages/icon_close_green.gif" alt="Close"/></a></td>
          </tr>
        </table>
      </div>
      <!--  end message-green -->
      <?php } ?>
      <?php if( $this->session->flashdata('error') ) { ?>
      <!--  start message-red -->
      <div id="message-red">
        <table border="0" width="100%" cellpadding="0" cellspacing="0">
          <tr>
            <td class="red-left"><?php echo $this->session->flashdata('error'); ?></td>
            <td class="red-right"><a class="close-red"><img src="<?php echo base_url(); ?>images/messages/icon_close_red.gif" alt="Close"/></a></td>
          </tr>
        </table>
      </div>
      <!--  end message-red -->
      <?php } ?>
      <div class="left_content_panel">
        <div class="treding_title">Trending  Searches <span>Last 7 Days</span></div>
        <div class="treding_lnk">
          <?php if(count($keywords)>0){?>
          <?php //echo '<pre>'; print_r($keywords);?>
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
        <td>
        <?php if($leftads){ ?>
       <div><a href="<?php echo $leftads[0]['url'];?>" title="" target="_blank"><img src="<?php if( $leftads[0]['image'] ) { echo $this->common->get_setting_value('2').$this->config->item('ad_main_upload_path');?><?php echo stripslashes($leftads[0]['image']); } ?>" alt="leftads" width="280" height="180" class="adimg"/></a> </div>
     
		  <?php } ?>
        </td>
        </tr>
        </table>
        
        
      </div>
      <div class="right_content_panel">
        <div class="treding_title">Yougotrated Live</div>
        <div class="filter"><span style="font-size:14px; font-weight:bold;">Filter by :</span> <a href="<?php echo site_url('complaint');?>" class="filter_active">Recent Activity</a> <a href="<?php echo site_url('complaint/weektrending');?>">Trending Complaints (7 Days)</a> <!--<a href="#">Most Active (7 Days)</a>--><a href="<?php echo site_url('complaint/advfilter');?>"><span class="advfilterspan"><span id="advfilter" style="cursor: pointer;">Advance Filter</span></span></a></div>
        <?php if(count($complaints)>0){ ?>
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
            <?php //$member=$this->reviews->elitemship($complaints[$i]['companyid']);?>
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
        <?php } } else { ?>
		<div class="main_livepost">
                    <div class="post_maincontent">
                      <div class="form-message warning">
                        <p>No Complaints found.</p>
                      </div>
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
      <?php if($bottomads){ ?>
       <div class="ad_bottom"><a href="<?php echo $bottomads[0]['url'];?>" title="" target="_blank"><img src="<?php if( $bottomads[0]['image'] ) { echo $this->common->get_setting_value('2').$this->config->item('ad_main_upload_path');?><?php echo stripslashes($bottomads[0]['image']); } ?>" alt="topads" width="940" height="180" class="adimg"/></a> </div>
     
		  <?php } ?>
    </div>
    <!-- /#content -->
    
  </section>
</section>
<?php echo $footer; ?>