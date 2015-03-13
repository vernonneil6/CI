<?php echo $header; ?>

<!-- #content -->

<div id="content">
  <?php if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'edit' ) ) { ?>
	  <script type="text/javascript" src="js/profileedit.js"></script>
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
				url 				: "<?php echo site_url('company/fieldcheck'); ?>",
				data				:	{ <?php if($this->uri->segment(2) == 'edit' ) echo "'id' : ".$company[0]['id'].", "; ?>'email' : email },
				dataType 			: "json",
				cache				: false,
				success				: function(data){
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
  <?php } ?>
  
  <!-- breadcrumbs -->
  <div class="breadcrumbs">
    <ul>
      <li class="home"><a href="<?php echo site_url('dashboard');?>" title="Dashboard">Dashboard</a></li>
      <li><a href="<?php echo site_url('company');?>" title="<?php echo $section_title; ?>"><?php echo $section_title; ?></a></li>
      <li>
        <?php if($this->uri->segment(2) == 'edit') {echo 'Edit Company'; }?>
        <?php if($this->uri->segment(2) == 'changepassword') { echo 'changepassword'; }?>
      </li>
    </ul>
  </div>
  <!-- /breadcrumbs -->
  
  <?php if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'edit' ) ) { ?>
  <style>
.form-cols .col1 {
	width: 58%;
}
.formBox .col1 .lab{
	width: 32% !important;
}
.formBox .col1 .con{
	width: 65% !important;
}
.formBox .file .upload-file {
	width: 237px !important;
}
.formBox .file .button-upload {
	left:245px;
}

</style>
  <!-- box -->
  <div class="box">
    <div class="headlines">
      <h2><span>
        <?php if($this->uri->segment(2) == 'edit') { echo "Edit Company"; } ?>
        </span></h2>
    </div>
    
    <!-- Correct form message -->
    <?php if( $this->session->flashdata('success') ) { ?>
    <div class="form-message correct">
      <p><?php echo $this->session->flashdata('success'); ?></p>
    </div>
    <?php } ?>
    <!-- Error form message -->
    <div class="box-content"> <?php echo form_open_multipart('company/update',array('class'=>'formBox','id'=>'frmcompany')); ?>
      <fieldset>
        <div class="form-cols"><!-- two form cols -->
          <div class="col1">
            <div class="clearfix">
              <div class="lab">
                <label for="company">Company Name <span class="errorsign">*</span></label>
              </div>
              <div class="con">
                <?php if($this->uri->segment(2) == 'edit') { ?>
                <?php echo form_input( array( 'name'=>'company','id'=>'company','class'=>'input','type'=>'text','value'=>stripslashes($company[0]['company']) ) ); ?>
                <?php } ?>
              </div>
            </div>
          </div>
          <div id="companyerror" class="error">Company Name is required.</div>
        </div>
        <div class="form-cols"><!-- two form cols -->
          <div class="col1">
            <div class="clearfix">
              <div class="lab">
                <label for="streetaddress">Street Address <span class="errorsign">*</span></label>
              </div>
              <div class="con">
                <?php if($this->uri->segment(2) == 'edit') { 
					if(empty($company[0]['companystreet'])) { $contactaddress=$company[0]['streetaddress']; } else { $contactaddress=$company[0]['companystreet']; }?>
                <?php echo form_input( array( 'name'=>'companystreet','id'=>'companystreet','class'=>'input','type'=>'text','value'=>$contactaddress ) ); ?>
                <?php } ?>
              </div>
            </div>
          </div>
          <div id="streetaddresserror" class="error">Street Address is required.</div>
        </div>
        <div class="form-cols"><!-- two form cols -->
          <div class="col1">
            <div class="clearfix">
              <div class="lab">
                <label for="city">City <span class="errorsign">*</span></label>
              </div>
              <div class="con">
                <?php if($this->uri->segment(2) == 'edit') { ?>
                <?php echo form_input( array( 'name'=>'city','id'=>'city','class'=>'input','type'=>'text','value'=>stripslashes($company[0]['city']) ) ); ?>
                <?php } ?>
              </div>
            </div>
          </div>
          <div id="cityerror" class="error">City is required.</div>
        </div>
        <div class="form-cols"><!-- two form cols -->
          <div class="col1">
            <div class="clearfix">
              <div class="lab">
                <label for="state">State <span class="errorsign">*</span></label>
              </div>
              <div class="con">
                <?php if($this->uri->segment(2) == 'edit') { ?>
                <?php echo form_input( array( 'name'=>'state','id'=>'state','class'=>'input','type'=>'text','value'=>stripslashes($company[0]['state']) ) ); ?>
                <?php } ?>
              </div>
            </div>
          </div>
          <div id="stateerror" class="error">State is required.</div>
        </div>
        <div class="form-cols"><!-- two form cols -->
          <div class="col1">
            <div class="clearfix">
              <div class="lab">
                <label for="country">Country <span class="errorsign">*</span></label>
              </div>
              <div class="con">
                <?php 
					if($this->uri->segment(2) == 'edit') { 
				?>				
                <?php $countryname = ($countryname['name']) ? $countryname['name']: $company[0]['country'];
                  echo form_input( array( 'name'=>'country','id'=>'country','class'=>'input','type'=>'text','value'=>stripslashes($countryname) ) ); ?>
                <?php } ?>
              </div>
            </div>
          </div>
          <div id="countryerror" class="error">Country is required.</div>
        </div>
        <div class="form-cols"><!-- two form cols -->
          <div class="col1">
            <div class="clearfix">
              <div class="lab">
                <label for="address">Zip Code<span class="errorsign">*</span></label>
              </div>
              <div class="con">
                <?php if($this->uri->segment(2) == 'edit') { ?>
                <?php echo form_input( array( 'name'=>'zip','id'=>'zip','class'=>'input','type'=>'text','value'=>stripslashes($company[0]['zip']) ) ); ?>
                <?php } ?>
              </div>
            </div>
          </div>
          <div id="ziperror" class="error">Zip Code is required.</div>
          <div id="zipverror" class="error">Enter only digits valid format.</div>
        </div>
        <div class="form-cols">
          <div class="col1">
            <div class="clearfix">
              <div class="lab">
                <label for="email">Email <span class="errorsign">*</span></label>
              </div>
              <div class="con" id="divemail">
                <?php if($this->uri->segment(2) == 'edit') { ?>
                <?php echo form_input( array( 'name'=>'email','id'=>'email','class'=>'input','type'=>'text','value'=>stripslashes($company[0]['email']),'onchange'=>'chkmail(this.value)' ) ); ?>
                <?php } ?>
              </div>
            </div>
          </div>
          <div id="emailerror" class="error">Enter valid Emailid.</div>
          <div id="emailtknerror" class="error">This Emailid already taken.</div>
        </div>
        <div class="note-texts">Please note: This email address will be visible publicly.</div>
        <div class="form-cols"><!-- two form cols -->
          <div class="col1">
            <div class="clearfix">
              <div class="lab">
                <label for="siteurl">Site Url <span class="errorsign">*</span></label>
              </div>
              <div class="con">
                <?php if($this->uri->segment(2) == 'edit') { ?>
                <?php echo form_input( array( 'name'=>'siteurl','id'=>'siteurl','class'=>'input','type'=>'text','value'=>stripslashes($company[0]['siteurl']) ) ); ?>
                <?php } ?>
              </div>
            </div>
          </div>
          <div id="siteurlerror" class="error">Site Url is required.</div>
        </div>
        <div class="clearfix file" style = "display:none">
          <div class="lab" style="width:18%">
            <label for="companylogo">Logo <span class="errorsign">*</span></label>
          </div>
          <div class="con" style="width:57%; float:left"> <?php echo form_input( array( 'name'=>'companylogo','id'=>'companylogo','class'=>'input file upload-file','type'=>'file') ); ?> </div>
          <?php if($this->uri->segment(2) == 'edit') { ?>
          <div class="task-photo"> <img width="60" height="40" src="<?php if( $company[0]['logo'] ){ echo $this->settings->get_setting_value('2').substr($this->config->item('company_thumb_upload_path'),3);?><?php echo stripslashes($company[0]['logo']); } else{echo $this->settings->get_setting_value('2').substr($this->config->item('company_thumb_upload_path'),3)."/no-image.gif"; } ?>" alt="<?php echo stripslashes($company[0]['logo']); ?>"/> </div>
          <?php } ?>
          <div id="companylogoerror" class="error" style="width:123px">Logo is required.</div>
        </div>
        <div class="form-cols">
          <div class="col1">
            <div class="clearfix">
              <div class="lab">
                <label for="phone">Phone <span class="errorsign">*</span></label>
              </div>
              <div class="con">
                <?php if($this->uri->segment(2) == 'edit') { ?>
                <?php echo form_input( array( 'name'=>'phone','id'=>'phone','class'=>'input','type'=>'text','value'=>stripslashes($company[0]['phone']) ) ); ?>
                <?php } ?>
              </div>
            </div>
          </div>
          <div id="phoneerror" class="error">Phone No. is required.</div>
          <div id="phoneinverror" class="error">Enter Only Digits. Valid Format : 0707123456.</div>
        </div>
        <div class="form-cols"><!-- two form cols -->
          <div class="col1" style="width: 100% !important;">
            <div class="clearfix">
              <div class="lab" style="width: 18% !important; padding-bottom:5px">
                <label for="about">About</label>
              </div>
              <div class="con" style="width: 60% !important; text-align:justify; float:left;">
                <?php if($this->uri->segment(2) == 'edit') { ?>
                <?php echo form_textarea( array( 'name'=>'about','id'=>'about','class'=>'textarea','rows'=>'4','cols'=>'15','value'=>stripslashes($company[0]['aboutus']) ) ); ?>
                <?php } ?>
              </div>
            </div>
          </div>
          <div id="abouterror" class="error">Company Detail is required.</div>
        </div>
        <div class="form-cols">
          <style>
		.check{ float: right; position: relative;}
		</style>
          <div class="col">
            <div class="clearfix">
              <div class="lab">
                <label for="cat">Category</label>
              </div>
              <div class="check" style="width:80%;">
                <div style="overflow-y: scroll; height:185px;">
                  <?php for($i=0;$i<count($categories);$i++) { ?>
                  <?php 
        if( $this->uri->segment(2) == 'edit' && array_key_exists($categories[$i]['id'],$buscategories) )
        {	
        	$option = array( 'name'=>'cat[]', 'id'=>'cat[]', 'value'=>$categories[$i]['id'], 'checked'=>TRUE );
        }
        else
        {
        	$option = array( 'name'=>'cat[]', 'id'=>'cat[]', 'value'=>$categories[$i]['id'] );
        }
        	echo "<br />";
		    echo form_checkbox( $option ); ?>
                  &nbsp;<?php echo stripslashes($categories[$i]['category']);
        
         } ?> </div>
              </div>
            </div>
          </div>
        </div>
        

        <div class="form-cols">
          <div class="col1">
            <div class="clearfix">
              <div class="lab">
                <label for="price_range">Price range</label>
              </div>
              <div class="con" id="divemail">
              
                <?php if($this->uri->segment(2) == 'edit') { ?>
                <?php echo form_input( array( 'name'=>'price_range','class'=>'input','type'=>'text','value'=>($company[0]['price_range'])) ); ?>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
 	    <div class="form-cols">
          <div class="col1">
            <div class="clearfix">
              <div class="lab">
                <label for="accept_credit_cards">Accept Credit Cards <span class="errorsign">*</span></label>
              </div>
              <?php $ar = array('No'=>'No','Yes'=>'Yes');?>
              <div class="con" id="divemail">
                <?php if($this->uri->segment(2) == 'add') { ?>
                <?php echo form_dropdown('accept_credit_cards',$ar,'','class="select"'); ?>
                <?php } ?>
                <?php if($this->uri->segment(2) == 'edit') { ?>
                <?php echo form_dropdown('accept_credit_cards',$ar,$company[0]['accept_credit_cards'],'class="select"'); ?>
                <?php } ?>
              </div>
            </div>
          </div>
          
        </div>
        <div class="form-cols">
          <div class="col1">
            <div class="clearfix">
              <div class="lab">
                <label for="accept_paypal">Accept Paypal <span class="errorsign">*</span></label>
              </div>
              
              <div class="con" id="divemail">
                <?php if($this->uri->segment(2) == 'add') { ?>
                <?php echo form_dropdown('accept_paypal',$ar,'','class="select"'); ?>
                <?php } ?>
                <?php if($this->uri->segment(2) == 'edit') { ?>
                <?php echo form_dropdown('accept_paypal',$ar,$company[0]['accept_paypal'],'class="select"'); ?>
                <?php } ?>
              </div>
            </div>
          </div>
          
        </div>
        

        <div class="form-cols page_contact_info" >
          <div class="col1">
            <div class="clearfix">
              <div class="lab">
				  <label>Contact Information</label>
              </div>          
            </div>
          </div>        
        </div>
        <div class="note-text">THE FOLLOWING INFORMATION WILL NOT BE PUBLISHED YOUGOTRATED AND IS USED FOR ADMINISTRATION PURPOSES ONLY. THIS INFORMATION IS WHERE YOU WILL RECEIVE EMAILS, AND RECEIPTS FROM YOUGOTRATED.COM.</div>
        
        <div class="form-cols">
          <div class="col1">
            <div class="clearfix">
              <div class="lab">
				  <label>Name <span class="errorsign">*</span></label>
              </div>          
              <div class="con">
				<?php if($this->uri->segment(2) == 'edit') { ?>
				<?php echo form_input( array( 'name'=>'contactname','id'=>'contactname','class'=>'input','type'=>'text','value'=>($company[0]['contactname'])) ); ?>
				<?php } ?>
              </div>
            </div>
          </div> 
          <div id="contactnameerror" class="error">Contact Name is required.</div>       
        </div>
        <div class="form-cols">
          <div class="col1">
            <div class="clearfix">
              <div class="lab">
				  <label>Title / Position <span class="errorsign">*</span></label>
              </div>          
              <div class="con">
				<?php if($this->uri->segment(2) == 'edit') { ?>
				<?php echo form_input( array( 'name'=>'ctitle','id'=>'ctitle','class'=>'input','type'=>'text','value'=>($company[0]['title'])) ); ?>
				<?php } ?>
              </div>
            </div>
          </div> 
          <div id="titleerror" class="error">Title / Position is required.</div>       
        </div>
        
        
        <div class="form-cols">
          <div class="col1">
            <div class="clearfix">
              <div class="lab">
				  <label>Address <span class="errorsign">*</span></label>
              </div>          
              <div class="con">
				<?php ?>
				<?php echo form_input( array( 'name'=>'streetaddress','id'=>'streetaddress','class'=>'input','type'=>'text','value'=>stripslashes($company[0]['streetaddress'])));?>
              </div>
            </div>
          </div>   
          <div id="contactcompanystreeterror" class="error">Contact Address is required.</div>     
        </div>
        
        
        <div class="form-cols">
          <div class="col1">
            <div class="clearfix">
              <div class="lab">
				  <label>City <span class="errorsign">*</span></label>
              </div>          
              <div class="con">
				<?php if(empty($company[0]['companycity'])) { $concity=$company[0]['city']; } else { $concity=$company[0]['companycity']; }?>
				<?php echo form_input( array( 'name'=>'companycity','id'=>'companycity','class'=>'input','type'=>'text','value'=>$concity) ); ?>
              </div>
            </div>
          </div> 
          <div id="contactcompanycityerror" class="error">Contact City is required.</div>       
        </div>
        
        
        <div class="form-cols">
          <div class="col1">
            <div class="clearfix">
              <div class="lab">
				  <label>State <span class="errorsign">*</span></label>
              </div>          
              <div class="con">
				<?php if(empty($company[0]['companystate'])) { $constate=$company[0]['state']; } else { $constate=$company[0]['companystate']; }?>  
				<?php echo form_input( array( 'name'=>'companystate','id'=>'companystate','class'=>'input','type'=>'text','value'=>$constate) ); ?>
              </div>
            </div>
          </div>
          <div id="contactcompanystateerror" class="error">Contact State is required.</div>        
        </div>
        
        
        <div class="form-cols">
          <div class="col1">
            <div class="clearfix">
              <div class="lab">
				  <label>Country<span class="errorsign">*</span></label>
              </div>          
              <div class="con">
				<?php if(empty($company[0]['companycountry'])) { $concount=$company[0]['country']; } else { $concount=$company[0]['companycountry']; }?>
				<?php echo form_input( array( 'name'=>'companycountry','id'=>'companycountry','class'=>'input','type'=>'text','value'=>$concount) ); ?>
              </div>
            </div>
          </div>
          <div id="contactcompanycountryerror" class="error">Contact Country is required.</div>        
        </div>
        
        
        <div class="form-cols">
          <div class="col1">
            <div class="clearfix">
              <div class="lab">
				  <label>Zip Code <span class="errorsign">*</span></label>
              </div>          
              <div class="con">
				<?php if(empty($company[0]['companyzip'])) { $conzip=$company[0]['zip']; } else { $conzip=$company[0]['companyzip']; }?>  
				<?php echo form_input( array( 'name'=>'companyzip','id'=>'companyzip','class'=>'input','type'=>'text','value'=>$conzip) ); ?>
              </div>
            </div>
          </div> 
         <div id="contactcompanyziperror" class="error">Contact Zip Code is required.</div>
        <div id="contactcompanyvziperror" class="error">Enter only digits valid format.</div>       
        </div>

        
        
        <div class="form-cols">
          <div class="col1">
            <div class="clearfix">
              <div class="lab">
				  <label> Email <span class="errorsign">*</span></label>
              </div>          
              <div class="con">
				<?php echo form_input( array( 'name'=>'contactemail','id'=>'contactemail','class'=>'input','type'=>'text','value'=>($company[0]['contactemail'])) ); ?>
              </div>
            </div>
          </div> 
           <div id="contactcompanyemailerror" class="error">Enter valid Emailid.</div>
           <div id="contactcompanyvemailerror" class="error">This Emailid already taken.</div>       
        </div>
       
        
        
        <div class="form-cols">
          <div class="col1">
            <div class="clearfix">
              <div class="lab">
				  <label>Phone <span class="errorsign">*</span></label>
              </div>          
              <div class="con">
				<?php echo form_input( array( 'name'=>'contactphonenumber','id'=>'contactphonenumber','class'=>'input','type'=>'text','value'=>($company[0]['contactphonenumber'])) ); ?>
              </div>
            </div>
          </div> 
          <div id="contactphonenumbererror" class="error">Contact Phone is required.</div>
        <div id="contactvphonenumbererror" class="error">Enter Only Digits. Valid Format : 0707123456.</div>        
        </div>
        
       
       
       <div class="form-cols">
          <div class="col1">
            <div class="clearfix">
              <div class="lab">
              </div>          
              <div>
				<a class = "profile_change_password" href = "/businessadmin/company/changepassword">Click here to change password</a>
              </div>
            </div>
          </div>        
        </div>
      
       
        <div class="btn-submit"> 
          <!-- Submit form -->
          <?php if($this->uri->segment(2) == 'edit') { ?>
          <?php echo form_input(array('name'=>'btnupdate','id'=>'btnupdate','class'=>'button','type'=>'submit','value'=>'Update')); ?>
          <?php } ?>
          or <a href="<?php echo site_url('company');?>" class="Cancel">Cancel</a> </div>
      </fieldset>
      <?php if($this->uri->segment(2) == 'edit') { ?>
      <?php echo form_hidden( array( 'id' => $this->encrypt->encode($company[0]['id']) ) ); ?>
      <?php } ?>
      <?php echo form_close(); ?> </div>
  </div>
  <!-- /box-content -->
  
  <?php } 
elseif( $this->uri->segment(2) && ( $this->uri->segment(2) == 'changepassword' ) ) { ?>
  <script type="text/javascript" language="javascript">
              function trim(stringToTrim) {
                  return stringToTrim.replace(/^\s+|\s+$/g,"");
              }
              $(document).ready(function() {
                  
                  $("#btnpassupdate").click(function () {
                      
                      if( trim($("#oldpassword").val()) == "" )
                      {
                          $("#oldpasserror").show();
                          $("#oldpassword").val('').focus();
                          return false;
                      }
                      else
                      {
                          $("#oldpasserror").hide();
                      }
                      
                      if( trim($("#newpassword").val()) == "" )
                      {
                          $("#newpasserror").show();
                          $("#newpassword").val('').focus();
                          return false;
                      }
                      else
                      {
                          $("#newpasserror").hide();
                      }
                      
                      if( trim($("#repassword").val()) == "")
                      {
                          $("#repasserror").show();
                          $("#repassword").val('').focus();
                          return false;
                      }
                      else
                      {
                          if($("#repassword").val()!=$("#newpassword").val())
                          {
                              $("#repasserror").show();
                              $("#repassword").val('').focus();
                              return false;
                          }
                          else
                          {
                              $("#repasserror").hide();
                          }
                      }
                      
                      $("#frmchpass").submit();
                          
                  });
              
              });
          </script>
  <style>
.form-cols .col1 {
	width: 58%;
}
.formBox .col1 .lab{
	width: 32% !important;
}
.formBox .col1 .con{
	width: 65% !important;
}
.formBox .file .upload-file {
	width: 237px !important;
}
.formBox .file .button-upload {
	left:245px;
}

</style>
  <!-- box -->
  <div class="box">
    <div class="headlines">
      <h2><span>
        <?php if($this->uri->segment(2) == 'changepassword') { echo "Change Password"; } ?>
        </span></h2>
    </div>
    <div class="box-content"> <?php echo form_open('company/update',array('class'=>'formBox','id'=>'frmchpass')); ?>
      <fieldset>
        <div class="form-cols"><!-- two form cols -->
          <div class="col1">
            <div class="clearfix">
              <div class="lab">
                <label for="oldpassword">Old Password <span class="errorsign">*</span></label>
              </div>
              <div class="con">
                <?php if($this->uri->segment(2) == 'changepassword') { ?>
                <?php echo form_input( array( 'name'=>'oldpassword','id'=>'oldpassword','class'=>'input','type'=>'password' ) ); ?>
                <?php } ?>
              </div>
            </div>
          </div>
          <div id="oldpasserror" class="error">Oldpassword is required.</div>
        </div>
        <div class="form-cols"><!-- two form cols -->
          <div class="col1">
            <div class="clearfix">
              <div class="lab">
                <label for="newpassword">New Password <span class="errorsign">*</span></label>
              </div>
              <div class="con">
                <?php if($this->uri->segment(2) == 'changepassword') { ?>
                <?php echo form_input( array( 'name'=>'newpassword','id'=>'newpassword','class'=>'input','type'=>'password' ) ); ?>
                <?php } ?>
              </div>
            </div>
          </div>
          <div id="newpasserror" class="error">Newpassword is required.</div>
        </div>
        <div class="form-cols"><!-- two form cols -->
          <div class="col1">
            <div class="clearfix">
              <div class="lab">
                <label for="city">Re Password <span class="errorsign">*</span></label>
              </div>
              <div class="con">
                <?php if($this->uri->segment(2) == 'changepassword') { ?>
                <?php echo form_input( array( 'name'=>'repassword','id'=>'repassword','class'=>'input','type'=>'password' ) ); ?>
                <?php } ?>
              </div>
            </div>
          </div>
          <div id="repasserror" class="error">New Password and Re-Password dont match..</div>
        </div>
        <div class="btn-submit"> 
          <!-- Submit form -->
          <?php if($this->uri->segment(2) == 'changepassword') { ?>
          <?php echo form_input(array('name'=>'btnpassupdate','id'=>'btnpassupdate','class'=>'button','type'=>'submit','value'=>'Update')); ?>
          <?php } ?>
          or <a href="<?php echo site_url('company');?>" class="Cancel">Cancel</a> </div>
      </fieldset>
      <?php if($this->uri->segment(2) == 'edit') { ?>
      <?php echo form_hidden( array( 'id' => $this->encrypt->encode($company[0]['id']) ) ); ?>
      <?php } ?>
      <?php echo form_close(); ?> </div>
  </div>
  <!-- /box-content -->
  
  <?php } 
  
else { ?>
  
  <!-- Correct form message --> 
  
  <!-- box -->
  <div class="box">
    <div class="headlines">
      <h2><span> Company Detail </span></h2>
    </div>
    <!-- Correct form message -->
    <?php if( $this->session->flashdata('success') ) { ?>
    <div class="form-message correct">
      <p><?php echo $this->session->flashdata('success'); ?></p>
    </div>
    <?php } ?>
    <!-- Error form message -->
    <?php if( $this->session->flashdata('error') ) { ?>
    <div class="form-message error1">
      <p><?php echo $this->session->flashdata('error'); ?></p>
    </div>
    <?php } ?>
    <?php if( count($company) > 0 ) { ?>
    <!-- table -->
    <table class="tab tab-drag">
      <tr class="top nodrop nodrag">
      <tr>
        <td>Company</td>
        <td><?php echo $company[0]['company'];?></td>
      </tr>
      <tr>
        <td>streetaddress</td>
        <td><?php echo $company[0]['streetaddress'];?></td>
      </tr>
      <tr>
        <td>city</td>
        <td><?php echo $company[0]['city'];?></td>
      </tr>
      <tr>
        <td>state</td>
        <td><?php echo $company[0]['state'];?></td>
      </tr>
      <tr>
        <td>country</td>
        <td><?php echo $company[0]['country'];?></td>
      </tr>
      <tr>
        <td>zip</td>
        <td><?php echo $company[0]['zip'];?></td>
      </tr>
      <tr>
        <td>email</td>
        <td><?php echo $company[0]['email'];?></td>
      </tr>
      <tr>
        <td>website</td>
        <td><?php echo $company[0]['siteurl'];?></td>
      </tr>
      <tr>
        <td>phone</td>
        <td><?php echo $company[0]['phone'];?></td>
      </tr>
      <tr>
        <td valign="top">Description</td>
        <td><?php echo $company[0]['aboutus'];?></td>
      </tr>
     <?php/* <tr>
        <td valign="top">Creditcard 1</td>
        <td><?php echo $company[0]['creditcard1'];?></td>
      </tr>
      <tr>
        <td valign="top">Creditcard 2</td>
        <td><?php echo $company[0]['creditcard2'];?></td>
      </tr>*/?>
      <tr> </tr>
    </table>
    <?php } ?>
  </div>
  <!-- /box -->
  
  <?php } ?>
</div>
<!-- /#content --> 

<!-- #sidebar -->
<?php include('leftmenu.php'); ?>
<!-- /#sidebar --> 

<!-- #footer --> 
<?php echo $footer; ?> 
