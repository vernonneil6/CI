<?php if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'view' ) ) { ?>
<!-- box -->

<div class="box">
  <div class="headlines">
    <h2><span>Pdf Detail</span></h2>
  </div>
  <!-- table -->
  <table align="center" width="100%" cellspacing="10" cellpadding="0" border="0">
    <?php if( count($company)>0 ) { ?>
    <tr>
      <td width="120"><b>Company Name</b></td>
      <td><b>:</b></td>
      <td><?php echo stripslashes($company[0]['company']) ?></td>
    </tr>
    <tr>
      <td width="120" style="vertical-align:top"><b>About Company</b></td>
      <td style="vertical-align:top"><b>:</b></td>
      <td <?php if($company[0]['aboutus'] != ''){?>style="text-align:justify; background:#EEEEEE;" <?php } ?>colspan="3"><?php echo nl2br(stripslashes($company[0]['aboutus'])); ?></td>
    </tr>
    <tr>
      <td width="120"><b>Address</b>
        </th>
      <td><b>:</b></td>
      <td><?php echo stripslashes($company[0]['streetaddress']); ?>
      	  ,<?php echo stripslashes($company[0]['city']); ?>
          ,<?php echo stripslashes($company[0]['state']); ?>
          ,<?php echo stripslashes($company[0]['country']); ?>
          -<?php echo stripslashes($company[0]['zip']); ?>
          	
      </td>
    </tr>
    <tr>
      <td width="120"><b>Email</b></td>
      <td><b>:</b></td>
      <td><?php echo stripslashes($company[0]['email']); ?></td>
    </tr>
    <tr>
      <td width="120"><b>Logo</b></td>
      <td><b>:</b></td>
      <td><div class="task-photo"> <img width="60" height="40" src="<?php if( $company[0]['logo'] ){ echo $this->settings->get_setting_value('2').substr($this->config->item('company_thumb_upload_path'),3);?><?php echo stripslashes($company[0]['logo']); } else{echo $this->settings->get_setting_value('2').substr($this->config->item('company_thumb_upload_path'),3)."/no_image.png"; } ?>" alt="<?php echo stripslashes($company[0]['logo']); ?>"/> </div></td>
    </tr>
    <tr>
      <td width="120"><b>Site Url</b></td>
      <td><b>:</b></td>
      <td><?php echo stripslashes($company[0]['siteurl']); ?></td>
    </tr>
    <tr>
      <td width="120"><b>Phone</b></td>
      <td><b>:</b></td>
      <td><?php echo stripslashes($company[0]['phone']); ?></td>
    </tr>
    <tr>
      <td width="120"><b>Seo keyword</b></td>
      <td><b>:</b></td>
      <td><?php echo stripslashes($company[0]['companyseokeyword']); ?></td>
    </tr>
    <tr>
      <td width="120"><b>Contact Name</b></td>
      <td><b>:</b></td>
      <td><?php echo stripslashes($company[0]['contactname']); ?></td>
    </tr>
    <tr>
      <td width="120"><b>Contact Number</b></td>
      <td><b>:</b></td>
      <td><?php echo stripslashes($company[0]['contactphonenumber']); ?></td>
    </tr>
    <tr>
      <td width="120"><b>Contact Email</b></td>
      <td><b>:</b></td>
      <td><?php echo stripslashes($company[0]['contactemail']); ?></td>
    </tr>
    <?php } else { ?>
    <!-- Warning form message -->
    <div class="form-message warning">
      <p>No record found.</p>
    </div>
    <?php } ?>
  </table>
  <!-- /table --> 
</div>
<!-- /box -->
<?php } 
else { ?>
<?php echo $header; ?> 

		<!-- #content -->
		<div id="content">
		  <?php if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'add' || $this->uri->segment(2) == 'edit' ) ) { ?>
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
		  <script type="text/javascript">
			function trim(stringToTrim) {
				return stringToTrim.replace(/^\s+|\s+$/g,"");
			}
			function chkcompanyseokeyword(companyseokeyword)
			{
				//alert(companyseokeyword);
				var seofilter  = /^[a-zA-Z0-9_-]+$/;
				if( trim(companyseokeyword) != '' && seofilter.test(trim(companyseokeyword)) )
				{
					$("#seocorerror").hide();
					//Return from conroller in php code : echo json_encode(array("result"=>"exist"));
					$.ajax({
						type 				: "POST",
						url 				: "<?php echo site_url('company/fieldcheck'); ?>",
						data				:	{ <?php if($this->uri->segment(2) == 'edit' ) echo "'id' : ".$company[0]['id'].", "; ?>'companyseokeyword' : companyseokeyword },
						dataType 		: "json",
						cache				: false,
						success			: function(data){
														//alert(data.result); return false;
														if( data.result == 'old')
														{
															$("#seocorerror").hide();
															$("#seotknerror").show();
															$("#companyseokeyword").val('').focus();
															return false;
														}
														else
														{
															$("#seotknerror").hide();
														}
													}
					});
				}
				else
				{
					$("#seotknerror").hide();
					$("#seocorerror").show();
					$("#companyseokeyword").val('').focus();
					return false;
				}
			}
		</script> 
		  <script type="text/javascript" language="javascript">
			function trim(stringToTrim) {
				return stringToTrim.replace(/^\s+|\s+$/g,"");
			}
			$(document).ready(function() {
				
			<?php if( $this->uri->segment(2) == 'add' ) { ?>
				$("#btnsubmit").click(function () {
			<?php } ?>
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
						if( !zipcode.test(trim($("#zip").val())))
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
					
					<?php if( $this->uri->segment(2) == 'add' ) { ?>
					if( trim($("#companylogo").val()) == "" )
					{
						$("#companylogoerror").show();
						$("#companylogo").val('').focus();
						return false;
					}
					else
					{
						$("#companylogoerror").hide();
					}
					<?php } ?>
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
					
					var seofilter  = /^[a-zA-Z0-9_-]+$/;
				if( trim($("#companyseokeyword").val()) == "" )
					{
						$("#seocorerror").hide();
						$("#error").attr('style','display:block;');
						$("#seoerror").show();
						$("#companyseokeyword").val('').focus();
						return false;
					}
					else
					{
						$("#seoerror").hide();
						if( !seofilter.test(trim($("#companyseokeyword").val())) )
						{
							$("#error").attr('style','display:block;');
							$("#seoerror").hide();
							$("#seocorerror").show();
							$("#companyseokeyword").focus();
							return false;
						}
						else
						{
							$("#seocorerror").hide();
							$("#seoerror").hide();
						}
					}

					if(trim($("#price_range").val())== "")
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
				<?php if($this->uri->segment(2) == 'add'){echo 'Add Company';} else if($this->uri->segment(2) == 'edit') {echo 'Edit Company'; }?>
			  </li>
			</ul>
		  </div>
		  <!-- /breadcrumbs -->
		  
		  <?php if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'add' || $this->uri->segment(2) == 'edit' ) ) { ?>
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
				<?php if($this->uri->segment(2) == 'add') { echo "Add Company"; } ?>
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
						<?php if($this->uri->segment(2) == 'add') { ?>
						<?php echo form_input( array( 'name'=>'company','id'=>'company','class'=>'input','type'=>'text' ) ); ?>
						<?php } ?>
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
						<?php if($this->uri->segment(2) == 'add') { ?>
						<?php echo form_input( array( 'name'=>'streetaddress','id'=>'streetaddress','class'=>'input','type'=>'text' ) ); }?>
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
						<?php if($this->uri->segment(2) == 'add') { ?>
						<?php echo form_input( array( 'name'=>'city','id'=>'city','class'=>'input','type'=>'text' ) ); }?>
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
						<?php if($this->uri->segment(2) == 'add') { ?>
						<?php echo form_input( array( 'name'=>'state','id'=>'state','class'=>'input','type'=>'text' ) ); }?>
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
						<?php if($this->uri->segment(2) == 'add') { ?>
						<?php echo form_input( array( 'name'=>'country','id'=>'country','class'=>'input','type'=>'text' ) ); }?>
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
						<?php if($this->uri->segment(2) == 'add') { ?>
						<?php echo form_input( array( 'name'=>'zip','id'=>'zip','class'=>'input','type'=>'text' ) ); }?>
						<?php if($this->uri->segment(2) == 'edit') { ?>
						<?php echo form_input( array( 'name'=>'zip','id'=>'zip','class'=>'input','type'=>'text','value'=>stripslashes($company[0]['zip']) ) ); ?>
						<?php } ?>
					  </div>
					</div>
				  </div>
				  <div id="ziperror" class="error">Zip Code is required.</div>
				  <div id="zipverror" class="error">Enter only digits .</div>
				</div>
				<div class="form-cols">
				  <div class="col1">
					<div class="clearfix">
					  <div class="lab">
						<label for="email">Email <span class="errorsign">*</span></label>
					  </div>
					  <div class="con" id="divemail">
						<?php if($this->uri->segment(2) == 'add') { ?>
						<?php echo form_input( array( 'name'=>'email','id'=>'email','class'=>'input','type'=>'text','onchange'=>'chkmail(this.value)' ) ); ?>
						<?php } ?>
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
						<?php if($this->uri->segment(2) == 'add') { ?>
						<?php echo form_input( array( 'name'=>'siteurl','id'=>'siteurl','class'=>'input','type'=>'text' ) );        } ?>
						<?php if($this->uri->segment(2) == 'edit') { ?>
						<?php echo form_input( array( 'name'=>'siteurl','id'=>'siteurl','class'=>'input','type'=>'text','value'=>stripslashes($company[0]['siteurl']) ) ); ?>
						<?php } ?>
					  </div>
					</div>
				  </div>
				  <div id="siteurlerror" class="error">Site Url is required.</div>
				</div>
				<div class="form-cols"><!-- two form cols -->
				  <div class="col1">
					<div class="clearfix">
					  <div class="lab">
						<label for="siteurl">Paypalid <span class="errorsign">*</span></label>
					  </div>
					  <div class="con">
						<?php if($this->uri->segment(2) == 'add') { ?>
						<?php echo form_input( array( 'name'=>'paypalid','id'=>'paypalid','class'=>'input','type'=>'text' ) );        } ?>
						<?php if($this->uri->segment(2) == 'edit') { ?>
						<?php echo form_input( array( 'name'=>'paypalid','id'=>'paypalid','class'=>'input','type'=>'text','value'=>stripslashes($company[0]['paypalid']) ) ); ?>
						<?php } ?>
					  </div>
					</div>
				  </div>
				  <div id="paypaliderror" class="error">Paypalid is required.</div>
				</div>
				<div class="clearfix file">
				  <div class="lab" style="width:18%">
					<label for="companylogo">Logo <span class="errorsign">*</span></label>
				  </div>
				  <div class="con" style="width:40%; float:left"> <?php echo form_input( array( 'name'=>'companylogo','id'=>'companylogo','class'=>'input file upload-file','type'=>'file') ); ?> </div>
				  <?php if($this->uri->segment(2) == 'edit') { ?>
				  <div class="task-photo"> <img width="60" height="40" src="<?php if( $company[0]['logo'] ){ echo $this->settings->get_setting_value('2').substr($this->config->item('company_thumb_upload_path'),3);?><?php echo stripslashes($company[0]['logo']); } else{echo $this->settings->get_setting_value('2').substr($this->config->item('company_thumb_upload_path'),3)."/no_image.png"; } ?>" alt="<?php echo stripslashes($company[0]['logo']); ?>"/> </div>
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
						<?php if($this->uri->segment(2) == 'add') { ?>
						<?php echo form_input( array( 'name'=>'phone','id'=>'phone','class'=>'input','type'=>'text' ) ); ?>
						<?php } ?>
						<?php if($this->uri->segment(2) == 'edit') { ?>
						<?php echo form_input( array( 'name'=>'phone','id'=>'phone','class'=>'input','type'=>'text','value'=>stripslashes($company[0]['phone']) ) ); ?>
						<?php } ?>
					  </div>
					</div>
				  </div>
				  <div id="phoneerror" class="error">Phone No. is required.</div>
				  <div id="phoneinverror" class="error">Enter Only Digits. Valid Format : 0707123456.</div>
				</div>
				<div class="form-cols">
				  <div class="col1">
					<div class="clearfix">
					  <div class="lab">
						<label for="companyseokeyword">Seo Keyword<span class="errorsign">*</span></label>
					  </div>
					  <div class="con">
						<?php if($this->uri->segment(2) == 'add') {
								 echo form_input( array( 'name'=>'companyseokeyword','id'=>'companyseokeyword','class'=>'input','type'=>'text','onchange'=>'chkcompanyseokeyword(this.value)' ) ); }
												if($this->uri->segment(2) == 'edit') {
												 echo form_input( array( 'name'=>'companyseokeyword','id'=>'companyseokeyword','class'=>'input','type'=>'text','value'=>stripslashes($company[0]['companyseokeyword']),'onchange'=>'chkcompanyseokeyword(this.value)' ) ); } ?>
					  </div>
					</div>
				  </div>
				  <div id="seoerror" class="error" style="width:auto;">Company SEO Keyword is required.</div>
				  <div id="seocorerror" class="error" style="width:auto;">Only 'a-z,A-Z,0-9,-,_' allowed characters for Company SEO Keyword.</div>
				  <div id="seotknerror" class="error" style="width:auto;">This SEO Keyword is already taken.</div>
				</div>
				<div class="form-cols">
				  <div class="col1">
					<div class="clearfix">
					  <div class="lab">
						<label for="about">About</label>
					  </div>
					  <div class="con">
						<?php if($this->uri->segment(2) == 'add') { ?>
						<?php echo form_textarea( array( 'name'=>'about','id'=>'about','class'=>'textarea','rows'=>'4','cols'=>'15' ) );        } ?>
						<?php if($this->uri->segment(2) == 'edit') { ?>
						<?php echo form_textarea( array( 'name'=>'about','id'=>'about','class'=>'textarea','rows'=>'4','cols'=>'15','value'=>stripslashes($company[0]['aboutus']) ) ); ?>
						<?php } ?>
					  </div>
					</div>
				  </div>
				  
				</div>
				
				
				<div class="form-cols">
				<style>
				.check{ float: right; position: relative;}
				</style>
				  <div class="col">
					<div class="clearfix">
					  <div class="lab"><label for="cat">Category</label></div>
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
					echo "<br/>";
					echo form_checkbox( $option ); ?>&nbsp;<?php echo stripslashes($categories[$i]['category']);
				
				 } ?>
				 </div>
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
						<?php if($this->uri->segment(2) == 'add') { ?>
						<?php echo form_input( array( 'name'=>'price_range','id'=>'price_range','class'=>'input','type'=>'text') ); ?>
						<?php } ?>
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
				  <?php if($this->uri->segment(2) == 'add') { ?>
				  <?php echo form_input(array('name'=>'btnsubmit','id'=>'btnsubmit','class'=>'button','type'=>'submit','value'=>'Submit')); ?>
				  <?php } ?>
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
		elseif( $this->uri->segment(2) && ( $this->uri->segment(2) == 'search' ) ) { ?>
		  <script type="text/javascript" language="javascript">
			function trim(stringToTrim) {
				return stringToTrim.replace(/^\s+|\s+$/g,"");
			}
			$(document).ready(function() {
				$("#btnsearch").click(function () {
			
					if( trim($("#keysearch").val()) == "" )
					{
						$("#error").attr('style','display:block;');
						$("#keysearcherror").show();
						$("#keysearch").val('').focus();
						return false;
					}
					else
					{
						$("#keysearcherror").hide();
					}
					
					if( $("#frmsearch").submit() )
					{
						$("#error").attr('style','display:none;');
					}
				});
			
			});
		</script> 
		  <!-- box -->
		  <div class="box">
			<div class="headlines">
			  <h2><span>Search Companies</span></h2>
			</div>
			<div class="box-content"> <?php echo form_open('company/searchcompany',array('class'=>'formBox','id'=>'frmsearch')); ?>
			  <fieldset>
				
				<!-- Error form message -->
				
				<div class="form-cols"><!-- two form cols -->
				  <div class="col1">
					<div class="clearfix">
					  <div class="lab">
						<label for="keysearch">Keyword<span>*</span></label>
					  </div>
					  <div class="con"> <?php echo form_input( array( 'name'=>'keysearch','id'=>'keysearch','class'=>'input','type'=>'text','placeholder'=>'Search company by name or email or discription')); ?> </div>
					</div>
				  </div>
				  <div id="keysearcherror" style="display:none;" class="error" align="right">Enter Keyword.</div>
				</div>
				<div class="btn-submit"> 
				  <!-- Submit form --> 
				  <?php echo form_input(array('name'=>'btnsearch','id'=>'btnsearch','class'=>'button','type'=>'submit','value'=>'Search','style'=>'margin-left:-48px;')); ?> or <a href="<?php echo site_url('company');?>" class="Cancel">Cancel</a> </div>
			  </fieldset>
			  <?php echo form_close(); ?> </div>
		  </div>
		  <!-- /box-content -->
		  <?php } 
		else { ?>
		  
		  <!-- Correct form message --> 
		  
		  <?php echo link_tag('colorbox/colorbox.css'); ?> 
		  <script language="javascript" type="text/javascript" src="<?php echo base_url();?>colorbox/jquery.colorbox.js"></script> 
		  <script language="javascript" type="text/javascript">
		  $(document).ready(function(){
				//$('.colorbox').colorbox({'width':'55%'});
				$('.colorbox').colorbox({'width':'60%','height':'70%'});
			
				$('#uploadcsv').click(function() {
					$('#divupload').show();
					$('#submitupload').show();
				});
		  });
		</script> 
		  
		  <!-- box -->
		  <div class="box">
			<div class="headlines">
			  <h2><span>
				<?php if($this->uri->segment(2) && $this->uri->segment(2)=='searchresult')
			   {
				?>
				search results for '<?php echo $this->uri->segment(3);?>'
				<?php
			   } else { echo "Companies"; } ?>
				</span></h2>
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
			<?php if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'searchresult' ) ) { ?>
			<script type="text/javascript" language="javascript">
			function trim(stringToTrim) {
				return stringToTrim.replace(/^\s+|\s+$/g,"");
			}
			$(document).ready(function() {
				$("#btnsearch").click(function () {
			
					if( trim($("#keysearch").val()) == "" )
					{
						$("#error").attr('style','display:block;');
						$("#keysearcherror").show();
						$("#keysearch").val('').focus();
						return false;
					}
					else
					{
						$("#keysearcherror").hide();
					}
					
					if( $("#frmsearch").submit() )
					{
						$("#error").attr('style','display:none;');
					}
				});
			
			});
		</script> 
			<!-- box -->
			
			<div class="box-content"> <?php echo form_open('company/searchcompany',array('class'=>'formBox','id'=>'frmsearch')); ?>
			  <fieldset>
				
				<!-- Error form message -->
				
				<div class="form-cols"><!-- two form cols -->
				  <div class="col1">
					<div class="clearfix">
					  <div class="lab">
						<label for="keysearch">Keyword<span>*</span></label>
					  </div>
					  <div class="con"> <?php echo form_input( array( 'name'=>'keysearch','id'=>'keysearch','class'=>'input','type'=>'text','placeholder'=>'Search company by name or email or discription','value'=>$this->uri->segment(3))); ?> </div>
					</div>
				  </div>
				  <div id="keysearcherror" style="display:none;" class="error" align="right">Enter Keyword.</div>
				</div>
				<div class="btn-submit"> 
				  <!-- Submit form --> 
				  <?php echo form_input(array('name'=>'btnsearch','id'=>'btnsearch','class'=>'button','type'=>'submit','value'=>'Search','style'=>'margin-left:-48px;')); ?> or <a href="<?php echo site_url('company');?>" class="Cancel">Cancel</a> </div>
			  </fieldset>
			  <?php echo form_close(); ?> </div>
			
			<!-- /box-content -->
			<?php } ?>
			<?php if( $this->uri->segment(1) == 'company' && $this->uri->segment(2) == '' )
		  { ?>
			<?php echo form_open_multipart('company/import_csv',array('class'=>'formBox','id'=>'frmupload')); ?>
			<?php 
			$site = site_url();			
			$url = explode("/admincp",$site);
			$path = $url[0];
			?>
			<div class="clearfix file uploadbox" style="width:auto">
			  <div id="divlink"><a title="Upload CSV" id="uploadcsv" style="cursor:pointer; display:block">Upload CSV</a> or <a title="Download Sample CSV" href="<?php echo site_url('company/download');?>" id="downloadcsv" style="cursor:pointer">( Download Sample CSV )</a></div>
			  <div class="con" id="divupload"> <?php echo form_input( array( 'name'=>'csvfile','id'=>'csvfile','class'=>'input file upload-file','type'=>'file') ); ?> </div>
			  <?php echo form_input(array('name'=>'csvupload','value'=>'csvupload','type'=>'hidden')); ?>
			  <div class="btn-submit" id="submitupload"> 
			  
			  <?php echo form_input(array('name'=>'btnupload','id'=>'btnupload','class'=>'button','type'=>'submit','value'=>'Submit')); ?> or <a href="<?php echo site_url('company');?>" class="Cancel">Cancel</a> </div>
			</div>
			<?php echo form_close();?>
			<?php } ?>
			<?php if( count($companys) > 0 ) { ?>
			<!-- table -->
			<table class="tab tab-drag">
			  <tr class="top nodrop nodrag">
				<th>Company Name</th>
				<th>Email</th>
				<th>Status</th>
				<th>Action</th>
				<th>Add Coupon</th>
				<th>Make Elite</th>
			  </tr>
			  <?php 
			$site = site_url();			
			$url = explode("/admincp",$site);
			$path = $url[0];
			?>
			  <?php for($i=0;$i<count($companys);$i++) { ?>
			  <tr>
				<td><a href="<?php echo site_url('company/view/'.$companys[$i]['id']); ?>" title="View Detail of <?php echo stripslashes($companys[$i]['company']); ?>" class="colorbox" style="color: #404040;"><?php echo stripslashes($companys[$i]['company']); ?></a></td>
				<?php /*?> <td><?php echo nl2br(stripslashes($companys[$i]['address'])); ?></td><?php */?>
				<td><?php echo stripslashes($companys[$i]['email']); ?></td>
				<?php /*?>        <td><?php echo stripslashes($companys[$i]['siteurl']); ?></td><?php */?>
				<td><?php if( stripslashes($companys[$i]['status']) == 'Enable' ) { ?>
				  <a href="<?php echo site_url('company/disable/'.$companys[$i]['id']);?>" title="Click to Disable" class="btn btn-small btn-success" onClick="return confirm('Are you sure to Disable this company?');"><span>Enable</span></a>
				  <?php } ?>
				  <?php if( stripslashes($companys[$i]['status']) == 'Disable' ) { ?>
				  <a href="<?php echo site_url('company/enable/'.$companys[$i]['id']);?>" title="Click to Enable" class="btn btn-small btn-info" style="cursor:default; color: #CD0B1C;" onClick="return confirm('Are you sure to Enable this company?');"><span>Disable</span></a>
				  <?php } ?></td>
				<td width="100px"><a href="<?php echo site_url('company/edit/'.$companys[$i]['id']); ?>" title="Edit" class="ico ico-edit">Edit</a> <a href="<?php echo site_url('company/view/'.$companys[$i]['id']); ?>" title="View Detail of <?php echo stripslashes($companys[$i]['company']); ?>" class="colorbox"><img width="16" height="17" border="0" src="images/detail.jpeg" alt="view"></a> <a href="<?php echo site_url('company/delete/'.$companys[$i]['id']);?>" title="Delete" class="ico ico-delete" onClick="return confirm('Are you sure to Delete this company?');">Delete</a></td>
				<td><a href="<?php echo site_url('coupon/add'); ?>" title="Add Coupon">
				<img width="16" height="17" border="0" src="images/Add-icon.png" alt="view">
				</a></td>
				<td>
				<?php $mem = $this->settings->get_elite_status_of_companyid($companys[$i]['id']);?>
				<?php if(count($mem)==0)
				{?>
				<a href="<?php echo site_url('company/makeelite/'.base64_encode($companys[$i]['id'])); ?>" title="Make Elite Member" onClick="return confirm('Are you sure to Make this company an Elite Member ?');">
				<img width="16" height="17" border="0" src="images/Add-icon.png" alt="view">
				</a>
				<?php }
				else
				{
				"Already a Member";
				} ?>
				</td>
			  </tr>
			  <?php } ?>
			</table>
			<?php  if($this->pagination->create_links()) { ?>
			<tr style="background:#ffffff">
			  <td></td>
			  <td></td>
			  <td></td>
			  <td style="padding:10px"><div class="pagination"><?php echo $this->pagination->create_links(); ?></div></td>
			</tr>
			<?php } ?>
			<?php } 
			else { ?>
			<!-- Warning form message -->
			<div class="form-message warning">
			  <p>No records found.</p>
			</div>
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
<?php } ?>
