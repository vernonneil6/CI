<?php echo $header; ?>

<!-- #content -->

<div id="content">
  <?php if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'edit' ) ) { ?>
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
  <script type="text/javascript" language="javascript">
	function trim(stringToTrim) {
		return stringToTrim.replace(/^\s+|\s+$/g,"");
	}
	$(document).ready(function() {
		
	<?php if( $this->uri->segment(2) == 'edit' ) { ?>
		$("#btnupdate").click(function () {
	<?php } ?>
	
			if( trim($("#company").val()) == "" )
			{
				$("#error").attr('style','display:block;');
				$("#companyerror").show();
				$("#company").val('').focus();
				return false;
			}
			else
			{
				$("#companyerror").hide();
			}
			
			if( trim($("#streetaddress").val()) == "" )
			{
				$("#error").attr('style','display:block;');
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
				$("#error").attr('style','display:block;');
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
				$("#error").attr('style','display:block;');
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
				$("#error").attr('style','display:block;');
				$("#countryerror").show();
				$("#country").val('').focus();
				return false;
			}
			else
			{
				$("#countryerror").hide();
			}
			
			var zipcode = /^([0-9\(\)\/\+ \-]*)$/; 
			if(trim($("#zip").val()) == "")
			{
				$("#ziperror").show();
				$("#zip").val('').focus();
				return false;
			}
			else
			{
				if( !zipcode.test(trim($("#zip").val())) || trim($("#zip").val()).length < 4)
				{
					$("#ziperror").hide();
					$("#error").attr('style','display:block;');
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

			}
			
			if( trim($("#siteurl").val()) == "" )
			{
				$("#error").attr('style','display:block;');
				$("#siteurlerror").show();
				$("#siteurl").val('').focus();
				return false;
			}
			else
			{
				$("#siteurlerror").hide();
			}
			
			if( trim($("#paypalid").val()) == "" )
			{
				$("#error").attr('style','display:block;');
				$("#paypaliderror").show();
				$("#paypalid").val('').focus();
				return false;
			}
			else
			{
				$("#paypaliderror").hide();
			}
			
			var pfilter = /^([0-9\(\)\/\+ \-]*)$/; 
			if(trim($("#phone").val()) == "")
			{
				$("#phoneerror").show();
				$("#phone").val('').focus();
				return false;
			}
			else
			{
				if( !pfilter.test(trim($("#phone").val())) || trim($("#phone").val()).length <10)
				{
					$("#phoneerror").hide();
					$("#error").attr('style','display:block;');
					$("#phoneinverror").show();
					$("#phone").focus();
					return false;
				}
				else
				{
					$("#phoneinverror").hide();
					$("#phoneerror").hide();
				}
			}
			
			if( $("#creditcard1").val().length > 0 )
				{
					var re16digit = /^\d{16}$/;
				    if (!re16digit.test($("#creditcard1").val()))
					 {
				        $("#error").attr('style','display:block;');
						$("#creditcard1error").show();
				        return false;
					 }
					 else
					 {
						$("#creditcard1error").hide();	
					 }
				}
				
			if( $("#creditcard2").val().length > 0 )
				{
					var re16digit = /^\d{16}$/;
				    if (!re16digit.test($("#creditcard2").val()))
					 {
				        $("#error").attr('style','display:block;');
						$("#creditcard2error").show();
				        return false;
					 }
					  else
					 {
						$("#creditcard2error").hide();	
					 }
				}	
				
			if(trim($("#price_range").val())!= "")
			{
				if( !pfilter.test(trim($("#price_range").val())) || trim($("#price_range").val()).length <10)
				{
					$("#error").attr('style','display:block;');
					$("#price_rangeerror").show();
					$("#price_range").focus();
					return false;
				}
				else
				{
					$("#price_rangeerror").hide();
				}
			}
			
		});
	
	});
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
                <?php if($this->uri->segment(2) == 'edit') { ?>
                <?php echo form_input( array( 'name'=>'streetaddress','id'=>'streetaddress','class'=>'input','type'=>'text','value'=>stripslashes($company[0]['streetaddress']) ) ); ?>
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
                <?php if($this->uri->segment(2) == 'edit') { ?>
                <?php echo form_input( array( 'name'=>'country','id'=>'country','class'=>'input','type'=>'text','value'=>stripslashes($company[0]['country']) ) ); ?>
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
        <div class="clearfix file">
          <div class="lab" style="width:18%">
            <label for="companylogo">Logo <span class="errorsign">*</span></label>
          </div>
          <div class="con" style="width:57%; float:left"> <?php echo form_input( array( 'name'=>'companylogo','id'=>'companylogo','class'=>'input file upload-file','type'=>'file') ); ?> </div>
          <?php /*if($this->uri->segment(2) == 'edit') { ?>
          <div class="task-photo"> <img width="60" height="40" src="<?php if( $company[0]['logo'] ){ echo $this->settings->get_setting_value('2').substr($this->config->item('company_thumb_upload_path'),3);?><?php echo stripslashes($company[0]['logo']); } else{echo $this->settings->get_setting_value('2').substr($this->config->item('company_thumb_upload_path'),3)."/no-image.gif"; } ?>" alt="<?php echo stripslashes($company[0]['logo']); ?>"/> </div>
          <?php } */ ?>
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
              <div class="lab" style="width: 12% !important; padding-bottom:5px">
                <label for="about">About</label>
              </div>
              <div class="con" style="width: 99% !important; text-align:justify; float:left;">
                <?php if($this->uri->segment(2) == 'edit') { ?>
                <?php echo form_textarea( array( 'name'=>'about','id'=>'about','class'=>'textarea','rows'=>'4','cols'=>'15','value'=>stripslashes($company[0]['aboutus']) ) ); ?>
                <?php } ?>
              </div>
            </div>
          </div>
          <div id="abouterror" class="error">Company Detail is required.</div>
        </div>
        <div class="form-cols"><!-- two form cols -->
          <div class="col1">
            <div class="clearfix">
              <div class="lab">
                <label for="creditcard1">Creditcard 1 </label>
              </div>
              <div class="con">
                <?php if($this->uri->segment(2) == 'edit') { ?>
                <?php echo form_input( array( 'name'=>'creditcard1','id'=>'creditcard1','class'=>'input','type'=>'text','value'=>stripslashes($company[0]['creditcard1']) ) ); ?>
                <?php } ?>
              </div>
            </div>
          </div>
          <div id="creditcard1error" class="error">Enter valid number.</div>
        </div>
        <div class="form-cols"><!-- two form cols -->
          <div class="col1">
            <div class="clearfix">
              <div class="lab">
                <label for="creditcard2">Creditcard 2 </label>
              </div>
              <div class="con">
                <?php if($this->uri->segment(2) == 'edit') { ?>
                <?php echo form_input( array( 'name'=>'creditcard2','id'=>'creditcard2','class'=>'input','type'=>'text','value'=>stripslashes($company[0]['creditcard2']) ) ); ?>
                <?php } ?>
              </div>
            </div>
          </div>
          <div id="creditcard2error" class="error">Enter valid number.</div>
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
                <div style="overflow-y: scroll; height:180px;">
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
                <label for="price_range">Price range <span class="errorsign">*</span></label>
              </div>
              <div class="con" id="divemail">
              
                <?php if($this->uri->segment(2) == 'edit') { ?>
                <?php echo form_input( array( 'name'=>'price_range','id'=>'price_range','class'=>'input','type'=>'text','value'=>($company[0]['price_range'])) ); ?>
                <?php } ?>
              </div>
            </div>
          </div>
          <div id="price_rangeerror" class="error">Enter digits only.</div>
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
      <tr>
        <td valign="top">Creditcard 1</td>
        <td><?php echo $company[0]['creditcard1'];?></td>
      </tr>
      <tr>
        <td valign="top">Creditcard 2</td>
        <td><?php echo $company[0]['creditcard2'];?></td>
      </tr>
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
