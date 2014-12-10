<?php echo $header;?>

<section class="container">
  <section class="main_contentarea">
    <div class="innr_wrap">
      <div class="bus_dir_head"><a><img src="images/YouGotRated_HeaderGraphics_BusinessDirectory.png" alt="Business Directory" title="Business Directory"></a></div>
      <?php if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'add' ) ){ ?>
      <div class="dir_panel">
        <div class="dir_title">
          <h1 style="font-size:24px !important;">Add New Business</h1>
        </div>
        <script type="text/javascript">
          function trim(stringToTrim) {
              return stringToTrim.replace(/^\s+|\s+$/g,"");
          }
          function chkmail(email)
          {
              //alert(email);
              var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
              if( trim(email) != '' && filter.test(trim(email)) )
              {
                  $("#emailerror").hide();
                  //Return from conroller in php code : echo json_encode(array("result"=>"exist"));
                  $.ajax({
                      type 				: "POST",
                      url 				: "<?php echo site_url('businessdirectory/fieldcheck'); ?>",
                      data				:	{ 'email' : email },
                      dataType 			: "json",
                      cache				: false,
                      success			: function(data){
                                                      //alert(data.result); return false;
                                                      if( data.result == 'old')
                                                      {
                                                          $("#emailerror").hide();
                                                          $("#emailtknerror").show();
                                                          $("#email").val('').focus();
                                                          return false;
                                                      }
                                                      else
                                                      {
                                                          $("#emailtknerror").hide();
                                                      }
                                                  }
                  });
              }
              else
              {
                  $("#emailtknerror").hide();
                  $("#emailerror").show();
                  $("#email").val('').focus();
                  return false;
              }
          }
      </script> 
        <script type="text/javascript">
          function trim(stringToTrim) {
              return stringToTrim.replace(/^\s+|\s+$/g,"");
          }
          function chkcompanyname(name)
          {
                if( trim(name) != '')
              {
                  $("#nameerror").hide();
                  //Return from conroller in php code : echo json_encode(array("result"=>"exist"));
                  $.ajax({
                      type 				: "POST",
                      url 				: "<?php echo site_url('businessdirectory/fieldcheck'); ?>",
                      data				:	{ 'companyname' : name },
                      dataType 			: "json",
                      cache				: false,
                      success			: function(data){
                                                      //alert(data.result); return false;
                                                      if( data.result == 'old')
                                                      {
                                                          $("#nameerror").hide();
                                                          $("#nametknerror").show();
                                                          $("#name").val('').focus();
                                                          return false;
                                                      }
                                                      else
                                                      {
                                                          $("#nametknerror").hide();
                                                      }
                                                  }
                  });
              }
              
          }
      </script> 
        <script type="text/javascript" language="javascript">
              function trim(stringToTrim) {
                  return stringToTrim.replace(/^\s+|\s+$/g,"");
              }
              $(document).ready(function() {
                  $("#btnaddcompany").click(function () {
					  
					  if( trim($("#name").val()) == "" )
					  {
						  $("#nameerror").show();
						  $("#name").val('').focus();
						  return false;
					  }
					  else
					  {						  
						  $("#nameerror").hide();
						
					  }
					  
					  if( trim($("#streetaddress").val()) == "" )
					  {
						  $("#streetaddresserror").show();
						  $("#streetaddress").val('').focus();
						  return false;
					  }
					  else
					  {
						  $("#streetaddresserror").hide();
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
					  
					  if( trim($("#country").val()) == "" )
					  {
						  $("#countryerror").show();
						  $("#country").val('').focus();
						  return false;
					  }
					  else
					  {
						  $("#countryerror").hide();
					  }
					  
					  if( trim($("#zip").val()) == "" )
					  {
						  $("#ziperror").show();
						  $("#zipverror").hide();
						  $("#zip").val('').focus();
						  return false;
					  }
					  else
					  {
						  if( isNaN(trim($("#zip").val())))
						  {
							  $("#ziperror").hide();
						  	  $("#zipverror").show();
							  $("#zip").focus();
							  return false;
						  }
						  else
						  {
							  $("#ziperror").hide();
							  $("#zipverror").hide();
						  }
					  }
					  
					  if( trim($("#phone").val()) == "" )
					  {
						  $("#phoneerror").show();
						  $("#phoneverror").hide();
						  $("#phone").val('').focus();
						  return false;
					  }
					  else
					  {
						  if( isNaN(trim($("#phone").val())) || $("#phone").val().length < 10)
						  {
							  $("#phoneerror").hide();
						  	  $("#phoneverror").show();
							  $("#phone").focus();
							  return false;
						  }
						  else
						  {
							  $("#phoneerror").hide();
							  $("#phoneverror").hide();
						  }
					  }
					  
					  var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
					  if( trim($("#email").val()) == "" )
					  {
						  $("#emailtknerror").hide();
						  $("#emailerror").show();
						  $("#email").val('').focus();
						  return false;
					  }
					  else
					  {
						  if( !filter.test(trim($("#email").val())) )
						  {
							  $("#emailtknerror").hide();
							  $("#emailerror").show();
							  $("#email").val('').focus();
							  return false;
						  }
						  else
						  {
							  $("#emailerror").hide();
						  }
					  }
					  
					  if( trim($("#website").val()) == "" )
					  {
						  $("#websiteerror").show();
						  $("#website").focus();
						  return false;
					  }
					  else
					  {
						  $("#websiteerror").hide();
					  }
					  
					  if( trim($("#paypalid").val()) == "" )
					  {
						  $("#paypaliderror").show();
						  $("#paypalid").focus();
						  return false;
					  }
					  else
					  {
						  $("#paypaliderror").hide();
					  }
					  
					  if( trim($("#logo").val()) == "" )
					  {
						  $("#logoerror").show();
						  $("#logo").focus();
						  return false;
					  }
					  else
					  {
						  $("#logoerror").hide();
					  }
					  
                      $("#frmaddcompany").submit();
                  });
              });
          </script> 
        <!-- box --> 
        
        <?php echo form_open_multipart('businessdirectory/update',array('class'=>'formBox','id'=>'frmaddcompany')); ?>
        <table class="data_table" align="left" width="100%" border="0">
          <tbody>
            <tr>
              <td class="box_label"><label for="name">Name</label>
                <span class="error-sign">*</span></td>
              <td><?php echo form_input( array( 'name'=>'name','id'=>'name','class'=>'box_txtbox','type'=>'text','onchange'=>'chkcompanyname(this.value)' ) ); ?></td>
              <td></td>
            </tr>
            <tr>
              <td></td>
              <td><div id="nameerror" class="error">Name is required.</div>
                <div id="nametknerror" class="error">This compnay name is already exists.</div></td>
            </tr>
            <tr>
              <td class="box_label"><label for="streetaddress">Street Address</label>
                <span class="error-sign">*</span></td>
              <td><?php echo form_input( array( 'name'=>'streetaddress','id'=>'streetaddress','class'=>'box_txtbox','type'=>'text' ) ) ; ?></td>
            </tr>
            <tr>
              <td></td>
              <td colspan="2"><div id="streetaddresserror" class="error">Street Address is required.</div></td>
            </tr>
            <tr>
              <td class="box_label"><label for="city">City</label>
                <span class="error-sign">*</span></td>
              <td><?php echo form_input( array( 'name'=>'city','id'=>'city','class'=>'box_txtbox','type'=>'text' ) ) ; ?></td>
              <td></td>
              <td class="box_label"><label for="state">State</label>
                <span class="error-sign">*</span></td>
              <td><?php echo form_input( array( 'name'=>'state','id'=>'state','class'=>'box_txtbox','type'=>'text' ) ) ; ?></td>
            </tr>
            <tr>
              <td></td>
              <td width="320px"><div id="cityerror" class="error">City is required.</div></td>
              <td></td>
              <td></td>
              <td width="320px"><div id="stateerror" class="error">State is required.</div></td>
            </tr>
            <tr>
              <td class="box_label"><label for="country">Country</label>
                <span class="error-sign">*</span></td>
              <td><?php echo form_input( array( 'name'=>'country','id'=>'country','class'=>'box_txtbox','type'=>'text' ) ) ; ?></td>
              <td></td>
              <td class="box_label"><label for="phone">Zip Code</label>
                <span class="error-sign">*</span></td>
              <td><?php echo form_input( array( 'name'=>'zip','id'=>'zip','class'=>'box_txtbox','type'=>'text' ) ); ?></td>
            </tr>
            <tr>
              <td></td>
              <td width="320px"><div id="countryerror" class="error">Country is required.</div></td>
              <td></td>
              <td></td>
              <td><div id="ziperror" class="error">Zip Code is required.</div>
                <div id="zipverror" class="error">Enter digits only valid format 123456</div></td>
            </tr>
            <tr>
              <td class="box_label"><label for="phone">Phone</label>
                <span class="error-sign">*</span></td>
              <td><?php echo form_input( array( 'name'=>'phone','id'=>'phone','class'=>'box_txtbox','type'=>'text' ) ); ?></td>
              <td></td>
              <td class="box_label"><label for="phone">Email</label>
                <span class="error-sign">*</span></td>
              <td><?php echo form_input( array( 'name'=>'email','id'=>'email','class'=>'box_txtbox','type'=>'text','onchange'=>'chkmail(this.value)' ) ); ?></td>
            </tr>
            <tr>
              <td></td>
              <td><div id="phoneerror" class="error">Phone is required.</div>
                <div id="phoneverror" class="error">Enter Valid format.0741852963</div></td>
              <td></td>
              <td></td>
              <td><div id="emailerror" class="error">Enter valid Emailid.</div>
                <div id="emailtknerror" class="error">This Emailid already taken.</div></td>
            </tr>
            <tr>
              <td class="box_label"><label for="website">Website</label>
                <span class="error-sign">*</span></td>
              <td><?php echo form_input( array( 'name'=>'website','id'=>'website','class'=>'box_txtbox','type'=>'text' ) ); ?></td>
              <td></td>
              <td class="box_label"><label for="paypalid">Paypalid</label>
                <span class="error-sign">*</span></td>
              <td><?php echo form_input( array( 'name'=>'paypalid','id'=>'paypalid','class'=>'box_txtbox','type'=>'text' ) ); ?></td>
            </tr>
            <tr>
              <td></td>
              <td><div id="websiteerror" class="error">Website is required.</div></td>
              <td></td>
              <td></td>
              <td><div id="paypaliderror" class="error">Paypalid is required.</div></td>
            </tr>
            <tr>
              <td class="box_label"><label for="logo">Company Logo</label>
                <span class="error-sign">*</span></td>
              <td><?php echo form_input( array( 'name'=>'logo','id'=>'logo','class'=>'input file upload-file','type'=>'file' ) ) ; ?></td>
              <td></td>
            </tr>
            <tr>
              <td class="box_label"><label for="cat">Category</label></td>
              <td colspan="4"><div id="" style="overflow-y: scroll; height:180px;border: 1px solid #D9D9D9;">
                  <?php for($i=0;$i<count($categories);$i++) { ?>
                  <?php  $option = array( 'name'=>'cat[]', 'id'=>'cat[]', 'value'=>$categories[$i]['id'] );
        	    echo form_checkbox( $option ); ?>
                  &nbsp; <span style="color:#666666;"> <?php echo stripslashes($categories[$i]['category'])."<br/>";?> </span>
                  <?php } ?>
                </div></td>
            </tr>
            <tr>
              <td></td>
              <td><div id="logoerror" class="error">Logo is required.</div></td>
            </tr>
            <tr>
              <td class="box_label"><label for="aboutcompany">About Company</label></td>
              <td colspan="4"><?php echo form_textarea( array( 'name'=>'aboutcompany','id'=>'aboutcompany','class'=>'complain_txtboxc','style'=>' height: 100px;
    width: 809px;' ) ) ; ?></td>
            </tr>
            <tr>
              <td></td>
              <td><!-- Submit form --> 
                <?php echo form_input(array('name'=>'btnaddcompany','id'=>'btnaddcompany','class'=>'dir-searchbtn','type'=>'submit','value'=>'Add Business','style'=>'float:none;color:#fff; padding: 3px 16px;font-size:15px;text-shadow:none;')); ?></td>
              <td></td>
            </tr>
          </tbody>
        </table>
        <?php echo form_close(); ?> 
        <!-- /box-content --> 
        
      </div>
      <?php } elseif( $this->uri->segment(2) && ( $this->uri->segment(2) == 'search' || $this->uri->segment(2) == 'searchkey') ){ ?>
      <div class="dir_panel"> <?php echo form_open('businessdirectory/search',array('class'=>'formBox','id'=>'frmcompany')); ?>
        <div class="dir_title">
          <h1 style="font-size:24px !important;">Business Directory?</h1>
        </div>
        <div class="dir-search">
          <div style="margin:0px auto; padding-top:5px"> <span class="dir-label">Search</span> <?php echo form_input( array( 'name'=>'searchcomp','id'=>'searchcomp','class'=>'search_txtbox','type'=>'text','placeholder'=>'Search by City Name or Company Name','value'=>$keyword ) ); ?> <?php echo form_input(array('name'=>'btnsearch','name'=>'btnsearch','class'=>'dir-searchbtn', 'type'=>'submit','value'=>'Go'));?></div>
        </div>
        <?php echo form_close();?>
        <table border="0" align="center">
          <tr>
            <td><div class="my"><a href="<?php echo site_url('businessdirectory/add');?>" title="Submit Business To YouGotRated Directory"><?php echo form_input(array('name'=>'addbusiness','id'=>'addbusiness','class'=>'complaint_btn','type'=>'button','value'=>'Submit Business To YouGotRated Directory','style'=>'padding:7px 25px;cursor: pointer;')); ?></a> </div></td>
          </tr>
        </table>
        <?php if( count($companies) > 0) { ?>
        <!--<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>--> 
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
        <div class="dir-label" style="padding-bottom:10px">Matching Companies</div>
        <?php for($i=0; $i<count($companies); $i++) { ?>
        <div class="main_dir">
          <div class="dir_maincontent" style="width:730px;">
            <div class="dir-image" style="max-height:100px !important;"> <a href="<?php echo site_url('company/'.$companies[$i]['companyseokeyword'].'/reviews/coupons/complaints');?>" title="view <?php echo stripslashes(ucfirst($companies[$i]['company'])); ?>'s detail"><img src="<?php if( $companies[$i]['logo'] ){ echo $this->common->get_setting_value('2').$this->config->item('company_main_upload_path');?><?php echo stripslashes($companies[$i]['logo']); } else{echo $this->common->get_setting_value('2').$this->config->item('company_thumb_upload_path')."/no_image.png"; } ?>" alt="<?php echo stripslashes(ucfirst($companies[$i]['company'])); ?>" width="100px" height="100px"/></a> </div>
            <div class="dir_content_title"><a href="<?php echo site_url('company/'.$companies[$i]['companyseokeyword'].'/reviews/coupons/complaints');?>" title="view <?php echo stripslashes(ucfirst($companies[$i]['company'])); ?>'s detail" style="font-size:15px !important;"><?php echo stripslashes(ucfirst($companies[$i]['company'])); ?></a></div>
            <div class="dir-map"> 
              <script type="text/javascript">

var geocoder = new google.maps.Geocoder();
var address = "<?php echo $companies[$i]['streetaddress'];?> , <?php echo $companies[$i]['city'];?> , <?php echo $companies[$i]['state'];?> , <?php echo $companies[$i]['country'];?> , <?php echo $companies[$i]['zip'];?>";

geocoder.geocode( { 'address': address}, function(results, status) {

  if (status == google.maps.GeocoderStatus.OK) {
    var latitude = results[0].geometry.location.lat();
    var longitude = results[0].geometry.location.lng();
    //alert(latitude);
	//alert(longitude);
	var map;
	
	function initialize() {
	//alert(latitude);
	//alert(longitude);
	var mapOptions = {
    zoom: 14,
    center: new google.maps.LatLng(latitude,longitude),
    mapTypeId: google.maps.MapTypeId.ROADMAP
	
	
  };
  map = new google.maps.Map(document.getElementById('map-canvas<?php echo $i;?>'),
      mapOptions);
	  
   var marker = new google.maps.Marker({
   position: new google.maps.LatLng(latitude,longitude),
   map: map,
   title: '<?php echo $companies[$i]['company'];?>'
  });

}

google.maps.event.addDomListener(window, 'load', initialize);

  } 
}); 


    </script>
              <div id="map-canvas<?php echo $i;?>" style="width:300px;height:200px;border: 1px solid #CCCCCC;"></div>
            </div>
            <div class="giverev">
              <?php if(!$this->session->userdata('youg_user')){ ?>
              <a style="color:#fff; padding: 3px 16px;font-size:15px;text-shadow:none;" href="<?php echo site_url('review/add/'.$companies[$i]['id']);?>" title="Review This Company" class="dir-searchbtn">Review</a>
              <?php } else {
							$userid = $this->session->userdata['youg_user']['userid'];
							$givenreview=$this->reviews->get_reviews_byciduid($companies[$i]['id'],$userid);
							if(count($givenreview)>0) {?>
              <a style="color:#fff; padding: 3px 16px;font-size:15px;text-shadow:none;" href="<?php echo site_url('review/browse').'/'.$givenreview[0]['id'];?>" title="See Review" class="dir-searchbtn">Reviewed</a>
              <?php } else {?>
              <a style="color:#fff; padding: 3px 16px;font-size:15px;text-shadow:none;" href="<?php echo site_url('review/add').'/'.$companies[$i]['id'];?>" title="Review This Company" class="dir-searchbtn">Review</a>
              <?php } }?>
            </div>
            <div class="dir-rating" style="margin-left:0px;width:282px;">
              <?php $reviews=$this->data['reviews'] = $this->reviews->get_reviews_bycompanyid($companies[$i]['id']); ?>
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
                   if( count($reviews)==0) { ?>
              <span style="font-size:16px;text-align:center"><img src="<?php echo base_url(); ?>images/stars/0.png" alt="No Rating" title="No Rating" class="star_image"/></span>
              <?php }else
			  {
			  
              if(count($reviews)==0)
                    {
						$avgratings=0;
					} 
               ?>
              <img src="<?php echo base_url(); ?>images/stars/<?php echo ceil(($avgratings)); ?>.png" alt="<?php echo 'Ratings : '.(($avgratings)); ?>" title="<?php 'Ratings : '.(($avgratings)); ?>" class="star_image"/>
              <?php
			  } ?>
            </div>
            <div class="dir_content_dscr" style="width:282px;margin-left:100px;"> <a href="<?php echo site_url('company/'.$companies[$i]['companyseokeyword'].'/reviews/coupons/complaints');?>" title="view <?php echo stripslashes(ucfirst($companies[$i]['company'])); ?>'s detail"><?php echo stripslashes($companies[$i]['streetaddress']); ?></a> </div>
            <div class="dir_content_dscr" style="width:282px;margin-left:100px;"> <a href="<?php echo site_url('company/'.$companies[$i]['companyseokeyword'].'/reviews/coupons/complaints');?>" title="view <?php echo stripslashes(ucfirst($companies[$i]['company'])); ?>'s detail"><?php echo ucfirst(stripslashes($companies[$i]['city'])); ?></a> </div>
            <div class="dir_content_dscr" style="width:282px;margin-left:100px;"> <a href="<?php echo site_url('company/'.$companies[$i]['companyseokeyword'].'/reviews/coupons/complaints');?> ?>" title="view <?php echo stripslashes(ucfirst($companies[$i]['company'])); ?>'s detail"><?php echo ucfirst(stripslashes($companies[$i]['state'])); ?></a> </div>
            <div class="dir_content_dscr" style="width:282px;margin-left:122px;"> <a href="<?php echo site_url('company/'.$companies[$i]['companyseokeyword'].'/reviews/coupons/complaints');?>" title="view <?php echo stripslashes(ucfirst($companies[$i]['company'])); ?>'s detail"><?php echo ucfirst(stripslashes($companies[$i]['country'])); ?></a> </div>
            <div class="dir_content_dscr" style="width:282px;margin-left:122px;"> <a href="<?php echo site_url('company/'.$companies[$i]['companyseokeyword'].'/reviews/coupons/complaints');?>" title="view <?php echo stripslashes(ucfirst($companies[$i]['company'])); ?>'s detail"><?php echo stripslashes($companies[$i]['zip']); ?></a> </div>
            <div class="dir_content_dscr" style="width:282px;margin-left:122px;"> <a href="mailto:<?php echo stripslashes($companies[$i]['email']); ?>" title="view <?php echo stripslashes(ucfirst($companies[$i]['company'])); ?>'s detail"><?php echo stripslashes($companies[$i]['email']); ?></a> </div>
            <div class="dir_siteurl" style="width:282px;margin-left:122px;"> <a href="http://<?php echo stripslashes($companies[$i]['siteurl']); ?>" title="view <?php echo stripslashes(ucfirst($companies[$i]['company'])); ?>'s detail"><?php echo stripslashes($companies[$i]['siteurl']); ?></a> </div>
            <div class="dir_content_dscr" style="width:282px;margin-left:122px;"> <a href="<?php echo site_url('company/'.$companies[$i]['companyseokeyword'].'/reviews/coupons/complaints');?>" title="view <?php echo stripslashes(ucfirst($companies[$i]['company'])); ?>'s detail"><?php echo stripslashes($companies[$i]['phone']); ?></a> </div>
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
        <p>No matches found.</p>
      </div>
      <?php } ?>
      <?php }else{?>
      <form class="busdt_wrap" method="post" id="frmcompany" action="businessdirectory/search">
        <div class="main_bd_srchwrp">
          <div class="bdsrch_wrp">
            <h2>Search</h2>
            <div class="bd_srchwrp">
              <input type="text" class="bdsrch_txtbx" placeholder="ENTER CITY OR COMPANY NAME HERE" id="searchcomp" name="searchcomp" maxlength="100" required>
              <input type="submit" class="bdsrch_btn" title="Search" id="btnsearch" name="btnsearch" value="">
            </div>
          </div>
        </div>
        <div class="orwrp">
          <div class="orinnrwrp"> </div>
          <h1 class="bus_tag"><a href="<?php echo site_url('businessdirectory/add');?>" title="Submit Business To YouGotRated Directory" style="color:#0080FF;">SUBMIT A NEW BUSINESS</a></h1>
        </div>
        <div class="lgn_btnlogo"> <a href="<?php echo base_url();?>"><img src="images/YouGotRated_Essential_YGR-Logo-Small.png" alt="<?php echo $site_name;?>" title="<?php echo $site_name;?>"></a> </div>
      </form>
      <?php } ?>
    </div>
  </section>
</section>
<?php echo $footer;?>
