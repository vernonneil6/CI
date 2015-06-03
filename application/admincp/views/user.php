<?php if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'view' ) ) { ?>
<!-- box -->

<div class="box">
  <div class="headlines">
    <h2><span>User Detail</span></h2>
  </div>
  <!-- table -->
  <table align="center" width="100%" cellspacing="10" cellpadding="0" border="0">
    <?php if( count($user)>0 ) { ?>
    <tr>
      <td width="120px"><b>First Name</b></td>
      <td><b>:</b></td>
      <td><?php echo stripslashes($user[0]['firstname']) ?></td>
    </tr>
    <tr>
      <td width="120"><b>Last Name</b></td>
      <td><b>:</b></td>
      <td><?php echo stripslashes($user[0]['lastname']); ?></td>
    </tr>
    <tr>
      <td width="120"><b>Email</b></td>
      <td><b>:</b></td>
      <td><?php echo stripslashes($user[0]['email']); ?></td>
    </tr>
    <tr>
      <td width="120"><b>Gender</b></td>
      <td><b>:</b></td>
      <td><?php echo stripslashes($user[0]['gender']); ?></td>
    </tr>
    <tr>
      <td width="120"><b>Address</b></td>
      <td><b>:</b></td>
      <td>	<?php echo nl2br(stripslashes($user[0]['street'])); ?>,
      		<?php echo nl2br(stripslashes($user[0]['city'])); ?>,
      		<?php echo nl2br(stripslashes($user[0]['state'])); ?>,
	  		<?php echo nl2br(stripslashes($user[0]['zipcode'])); ?></td>
    </tr>
    <tr>
      <td width="120"><b>Phone no</b></td>
      <td><b>:</b></td>
      <td><?php echo stripslashes($user[0]['phoneno']); ?></td>
    </tr>
    <tr>
      <td width="120"><b>Profile Photo</b></td>
      <td><b>:</b></td>
      <td><div class="task-photo"> <img width="60" height="40" src="<?php if( $user[0]['avatarbig'] ){ echo $this->settings->get_setting_value('2').substr($this->config->item('user_thumb_upload_path'),3);?><?php echo stripslashes($user[0]['avatarbig']); } else{echo $this->settings->get_setting_value('2').substr($this->config->item('user_thumb_upload_path'),3)."/no-image.gif"; } ?>" alt="<?php echo stripslashes($user[0]['firstname'].' '.$user[0]['lastname']) ?>"/> </div></td>
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
				url 				: "<?php echo site_url('user/fieldcheck'); ?>",
				data				:	{ <?php if($this->uri->segment(2) == 'edit' ) echo "'id' : ".$user[0]['id'].", "; ?>'email' : email },
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
	function chkuser(username)
	{
		//alert(email);
		var filter1  = /^[A-Za-z0-9]+(?:[ _-][A-Za-z0-9]+)*$/;
		if( trim(username) != '' && filter1.test(trim(username)) )
		{
			$("#unameerror").hide();
			//Return from conroller in php code : echo json_encode(array("result"=>"exist"));
			$.ajax({
				type 				: "POST",
				url 				: "<?php echo site_url('user/fieldcheck'); ?>",
				data				:	{ <?php if($this->uri->segment(2) == 'edit' ) echo "'id' : ".$user[0]['id'].", "; ?>'username' : username },
				dataType 			: "json",
				cache				: false,
				success				: function(data){
												//alert(data.result); return false;
												if( data.result == 'old')
												{
													$("#unameerror").hide();
													$("#unameverror").hide();
													$("#utknerror").show();
													$("#username").val('').focus();
													return false;
												}
												else
												{
													$("#unameerror").hide();
													$("#unameverror").hide();
													$("#utknerror").hide();
												}
											}
			});
		}
		else
		{
			$("#unameerror").hide();
			$("#unameverror").show();
			$("#utknerror").hide();
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
			var filter1  = /^[A-Za-z0-9]+(?:[ _-][A-Za-z0-9]+)*$/;
			if( trim($("#username").val()) == "" )
			{
				$("#error").attr('style','display:block;');
				$("#unameerror").show();
				$("#username").val('').focus();
				return false;
			}
			else
			{
				if( !filter1.test(trim($("#username").val())) )
				{
					$("#unameerror").hide();
					$("#unameverror").show();
					$("#username").val('').focus();
					return false;
				}
				else
				{
					$("#unameverror").hide();
					$("#unameerror").hide();
				}
			}
			
			var ffilter = /^[a-zA-Z -]+$/; 
			if( trim($("#firstname").val()) == "" )
			{
				$("#error").attr('style','display:block;');
				$("#fnameerror").show();
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
				$("#error").attr('style','display:block;');
				$("#lnameerror").show();
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
			
			var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			if( trim($("#email").val()) == "" )
			{
				$("#emailtknerror").hide();
				$("#error").attr('style','display:block;');
				$("#emailerror").show();
				$("#email").val('').focus();
				return false;
			}
			else
			{
				if( !filter.test(trim($("#email").val())) )
				{
					$("#emailtknerror").hide();
					$("#error").attr('style','display:block;');
					$("#emailerror").show();
					$("#email").val('').focus();
					return false;
				}
				else
				{
					$("#emailerror").hide();
				}
			}
			
			var pfilter = /^([a-zA-Z0-9-_+^&*%$#@!|?]{6,16})$/;
			if( trim($("#password").val()) == "" )
			{
				$("#passerror").show();
				$("#password").val('').focus();
				return false;
			}
			else
			{
			   if( !pfilter.test(trim($("#password").val())) )
				{
					$("#passerror").hide();
					$("#passverror").show();
					$("#password").val('').focus();
					return false;
				}
				else
				{
					$("#passverror").hide();
					$("#passerror").hide();
				}
			}
  
			if( trim($("#repassword").val()) == "")
			{
				$("#error").attr('style','display:block;');
				$("#repasserror").show();
				$("#repassword").val('').focus();
				return false;
			}
			else
			{
				if($("#repassword").val()!=$("#password").val())
				{
					$("#error").attr('style','display:block;');
					$("#repasserror").show();
					$("#repassword").val('').focus();
					return false;
				}
				else
				{
					$("#repasserror").hide();
				}
			}
			
			<?php if( $this->uri->segment(2) != 'edit' ) { ?>
			if( trim($("#avatarbig").val()) == "" )
			{
				$("#photoerror").show();
				$("#avatarbig").val('').focus();
				return false;
			}
			else
			{
				$("#photoerror").hide();
			}
			<?php } ?>
			
				  if(trim($("#street").val()) == "")
					  {	
						$("#streeterror").show();
						$("#street").val('').focus();
						return false;
					  } 
					else
			   			{
							$("#streeterror").hide();
						}
						
					if(trim($("#city").val()) == "")
					  {	
						$("#cityerror").show();
						$("#city").val('').focus();
						return false;
					  } 
					else
			   			{
							$("#cityerror").hide();
						}
						if(trim($("#state").val()) == "")
					  {	
						$("#stateerror").show();
						$("#state").val('').focus();
						return false;
					  } 
					else
			   			{
							$("#stateerror").hide();
						}	
					
					
					if(trim($("#zipcode").val()) == "")
							{
								$("#zipcodeerror").show();
								$("#zipcode").val('').focus();
								return false;
							}
							else
							{
								if( isNaN(trim($("#zipcode").val())) )
								{
									$("#zipcodeerror").show();
									$("#zipcode").val('').focus();
									return false;
								}
								else
								{
									$("#zipcodeerror").hide();
								}
						
					}
							if(trim($("#phoneno").val()) == "")
							{
								$("#phonenoerror").show();
								$("#phoneno").val('').focus();
								return false;
							}
							else
							{
								if( isNaN(trim($("#phoneno").val())) )
								{
									$("#phonenoerror").show();
									$("#phoneno").val('').focus();
									return false;
								}
								else
								{
									if( $("#phoneno").val().length < 10 )
									{
										$("#phonenoerror").show();
										$("#phoneno").focus();
										return false;
									}
									else
									{
									$("#phonenoerror").hide();
								}
						}
					}
					
					
               
			
			if( $("#frmuser").submit() )
			{
				$("#error").attr('style','display:none;');
			}
				
    	});
	
	});
</script>
  <?php } ?>
  
  <!-- breadcrumbs -->
  <div class="breadcrumbs">
    <ul>
      <li class="home"><a href="<?php echo site_url('dashboard');?>" title="Dashboard">Dashboard</a></li>
      <li><a href="<?php echo site_url('user');?>" title="<?php echo $section_title; ?>"><?php echo $section_title; ?></a></li>
      <li>
        <?php if($this->uri->segment(2) == 'add'){echo 'Add User';} else if($this->uri->segment(2) == 'edit') {echo 'Edit User'; }?>
      </li>
    </ul>
  </div>
  <!-- /breadcrumbs -->
  
  <?php if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'add' || $this->uri->segment(2) == 'edit' ) ) { ?>
  <style>
.form-cols .col1 {
	width: 63%;
}
.formBox .col1 .lab{
	width: 32% !important;
}
.formBox .col1 .con{
	width: 65% !important;
}
.formBox .file .upload-file {
    width: 252px !important;
}
.error{
	width:210px;
}
.formBox .file .button-upload {
	left:260px;
}

</style>
  <!-- box -->
  <div class="box">
    <div class="headlines">
      <h2><span>
        <?php if($this->uri->segment(2) == 'add') { echo "Add User"; } ?>
        <?php if($this->uri->segment(2) == 'edit') { echo "Edit User"; } ?>
        </span></h2>
    </div>
    <div class="box-content"> <?php echo form_open_multipart('user/update',array('class'=>'formBox','id'=>'frmuser')); ?>
      <fieldset>
      <div class="form-cols"><!-- two form cols -->
          <div class="col1">
            <div class="clearfix">
              <div class="lab">
                <label for="username">Username <span class="errorsign">*</span></label>
              </div>
              <div class="con">
                <?php if($this->uri->segment(2) == 'add') { ?>
                <?php echo form_input( array( 'name'=>'username','id'=>'username','class'=>'input','type'=>'text','onchange'=>'chkuser(this.value)' ) ); ?>
                <?php } ?>
                <?php if($this->uri->segment(2) == 'edit') { ?>
                <?php echo form_input( array( 'name'=>'username','id'=>'username','class'=>'input','type'=>'text','value'=>stripslashes($user[0]['username']),'onchange'=>'chkuser(this.value)' ) ); ?>
                <?php } ?>
              </div>
            </div>
          </div>
          <div id="unameerror" class="error">Enter username.</div>
          <div id="unameverror" class="error">Enter valid username.</div>
          <div id="utknerror" class="error">This username already taken.</div>
        </div>
        <div class="form-cols"><!-- two form cols -->
          <div class="col1">
            <div class="clearfix">
              <div class="lab">
                <label for="firstname">First Name <span class="errorsign">*</span></label>
              </div>
              <div class="con">
                <?php if($this->uri->segment(2) == 'add') { ?>
                <?php echo form_input( array( 'name'=>'firstname','id'=>'firstname','class'=>'input','type'=>'text' ) ); ?>
                <?php } ?>
                <?php if($this->uri->segment(2) == 'edit') { ?>
                <?php echo form_input( array( 'name'=>'firstname','id'=>'firstname','class'=>'input','type'=>'text','value'=>stripslashes($user[0]['firstname']) ) ); ?>
                <?php } ?>
              </div>
            </div>
          </div>
          <div id="fnameerror" class="error">First Name is required.</div>
          <div id="fnameverror" class="error">Enter Valid First Name only (a-zA-Z-) allowed characters.</div>
        </div>
        <div class="form-cols">
          <div class="col1">
            <div class="clearfix">
              <div class="lab">
                <label for="lastname">Last Name <span class="errorsign">*</span></label>
              </div>
              <div class="con">
                <?php if($this->uri->segment(2) == 'add') { ?>
                <?php echo form_input( array( 'name'=>'lastname','id'=>'lastname','class'=>'input','type'=>'text' ) ); ?>
                <?php } ?>
                <?php if($this->uri->segment(2) == 'edit') { ?>
                <?php echo form_input( array( 'name'=>'lastname','id'=>'lastname','class'=>'input','type'=>'text','value'=>stripslashes($user[0]['lastname']) ) ); ?>
                <?php } ?>
              </div>
            </div>
          </div>
          <div id="lnameerror" class="error">Last Name is required.</div>
          <div id="lnameverror" class="error">Enter Valid Last Name only (a-zA-Z-) allowed characters.</div>
        </div>
        <div class="form-cols"><!-- two form cols -->
          <div class="col1">
            <div class="clearfix">
              <div class="lab">
                <label for="email">Email <span class="errorsign">*</span></label>
              </div>
              <div class="con">
                <?php if($this->uri->segment(2) == 'add') { ?>
                <?php echo form_input( array( 'name'=>'email','id'=>'email','class'=>'input','type'=>'text','onchange'=>'chkmail(this.value)' ) ); ?>
                <?php } ?>
                <?php if($this->uri->segment(2) == 'edit') { ?>
                <?php echo form_input( array( 'name'=>'email','id'=>'email','class'=>'input','type'=>'text','value'=>stripslashes($user[0]['email']),'onchange'=>'chkmail(this.value)' ) ); ?>
                <?php } ?>
              </div>
            </div>
          </div>
          <div id="emailerror" class="error">Enter valid Emailid.</div>
          <div id="emailtknerror" class="error">This Emailid already taken.</div>
        </div>
        <div class="form-cols">
          <div class="col1">
            <div class="clearfix">
              <div class="lab">
                <label for="gender">Gender <span class="errorsign">*</span></label>
              </div>
              <div>
                <?php if($this->uri->segment(2) == 'add') { ?>
                <?php echo form_radio(array('name'=>'gender','type'=>'radio','id'=>'radmale','class'=>'input','value'=>'Male','style'=>'float:none;width:5% !important')); ?>
                <label for="radmale">Male</label>
                <?php echo form_radio(array('name'=>'gender','type'=>'radio','id'=>'radfemale','class'=>'input','value'=>'Female','style'=>'float:none;width:5% !important')); ?>
                <label for="radfemale">Female</label>
                <?php } ?>
                <?php if($this->uri->segment(2) == 'edit') { ?>
                <?php if($user[0]['gender'] == 'Male'){?>
                <?php echo form_radio(array('name'=>'gender','type'=>'radio','id'=>'radmale','class'=>'input','value'=>'Male','checked'=>'checked','style'=>'float:none;width:3% !important'));  } else {?> <?php echo form_radio(array('name'=>'gender','type'=>'radio','id'=>'radmale','class'=>'input','value'=>'Male','style'=>'float:none;width:3% !important')); ?>
                <?php } ?>
                <label for="radmale">Male</label>
                <?php if($user[0]['gender'] == 'Female'){?>
                <?php echo form_radio(array('name'=>'gender','type'=>'radio','id'=>'radfemale','class'=>'input','value'=>'Female','checked'=>'checked','style'=>'float:none;width:3% !important')); } else { ?> <?php echo form_radio(array('name'=>'gender','type'=>'radio','id'=>'radfemale','class'=>'input','value'=>'Female','style'=>'float:none;width:3% !important')); ?>
                <?php } ?>
                <label for="radfemale">Female</label>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
        <div class="form-cols"><!-- two form cols -->
          <div class="col1">
            <div class="clearfix">
              <div class="lab">
                <label for="password">Password <span class="errorsign">*</span></label>
              </div>
              <div class="con">
                <?php if($this->uri->segment(2) == 'add') { ?>
                <?php echo form_input( array( 'name'=>'password','id'=>'password','class'=>'input','type'=>'password' ) ); ?>
                <?php } ?>
                <?php if($this->uri->segment(2) == 'edit') { ?>
                <?php echo form_input( array( 'name'=>'password','id'=>'password','class'=>'input','type'=>'password','value'=>stripslashes($user[0]['password']) ) ); ?>
                <?php } ?>
              </div>
            </div>
          </div>
          <div id="passerror" class="error">Password is required.</div>
          <div id="passverror" class="error">Enter valid password (Mininum length 6).</div>
        </div>
        <div class="form-cols">
          <div class="col1">
            <div class="clearfix">
              <div class="lab">
                <label for="repassword">Confirm Password <span class="errorsign">*</span></label>
              </div>
              <div class="con">
                <?php if($this->uri->segment(2) == 'add') { ?>
                <?php echo form_input( array( 'name'=>'repassword','id'=>'repassword','class'=>'input','type'=>'password' ) ); ?>
                <?php } ?>
                <?php if($this->uri->segment(2) == 'edit') { ?>
                <?php echo form_input( array( 'name'=>'repassword','id'=>'repassword','class'=>'input','type'=>'password','value'=>stripslashes($user[0]['password']) ) ); ?>
                <?php } ?>
              </div>
            </div>
          </div>
          <div id="repasserror" class="error">Password and Confirm Password don't match.</div>
        </div>
        <div class="clearfix file">
          <div class="lab" style="width:20%">
            <label for="photo">Photo <span class="errorsign">*</span></label>
          </div>
          <div class="con" style="width:40%; float:left"> <?php echo form_input( array( 'name'=>'avatarbig','id'=>'avatarbig','class'=>'input file upload-file','type'=>'file') ); ?> </div>
          <?php if($this->uri->segment(2) == 'edit') { ?>
          <div class="task-photo"> <img style="margin-left:35px;" width="50" height="50" src="<?php if( $user[0]['avatarthum'] ){ echo $this->settings->get_setting_value('2').substr($this->config->item('user_thumb_upload_path'),3);?><?php echo stripslashes($user[0]['avatarthum']); } else{echo $this->settings->get_setting_value('2').substr($this->config->item('user_thumb_upload_path'),3)."/no-image.gif"; } ?>" /> </div>
          <?php } ?>
          <div id="photoerror" class="error" style="width:auto">Photo required.</div>
        </div>
        
        <div class="form-cols"><!-- two form cols -->
          <div class="col1">
            <div class="clearfix">
              <div class="lab">
                <label for="street">Street Address<span class="errorsign">*</span></label>
              </div>
              <div class="con">
                <?php if($this->uri->segment(2) == 'add') { ?>
                <?php echo form_input( array( 'name'=>'street','id'=>'street','class'=>'input','type'=>'text' ) ); ?>
                <?php } ?>
                <?php if($this->uri->segment(2) == 'edit') { ?>
                <?php echo form_input( array( 'name'=>'street','id'=>'street','class'=>'input','type'=>'text','value'=>stripslashes($user[0]['street']) ) ); ?>
                <?php } ?>
              </div>
            </div>
          </div>
          <div id="streeterror" class="error">street address is required.</div>
        </div>
        <div class="form-cols"><!-- two form cols -->
          <div class="col1">
            <div class="clearfix">
              <div class="lab">
                <label for="city">City <span class="errorsign">*</span></label>
              </div>
              <div class="con">
                <?php if($this->uri->segment(2) == 'add') { ?>
                <?php echo form_input( array( 'name'=>'city','id'=>'city','class'=>'input','type'=>'text' ) ); ?>
                <?php } ?>
                <?php if($this->uri->segment(2) == 'edit') { ?>
                <?php echo form_input( array( 'name'=>'city','id'=>'city','class'=>'input','type'=>'text','value'=>stripslashes($user[0]['city']) ) ); ?>
                <?php } ?>
              </div>
            </div>
          </div>
          <div id="cityerror" class="error">city is required.</div>
        </div>
        <div class="form-cols"><!-- two form cols -->
          <div class="col1">
            <div class="clearfix">
              <div class="lab">
                <label for="state">State <span class="errorsign">*</span></label>
              </div>
              <div class="con">
                <?php if($this->uri->segment(2) == 'add') { ?>
                <?php echo form_input( array( 'name'=>'state','id'=>'state','class'=>'input','type'=>'text' ) ); ?>
                <?php } ?>
                <?php if($this->uri->segment(2) == 'edit') { ?>
                <?php echo form_input( array( 'name'=>'state','id'=>'state','class'=>'input','type'=>'text','value'=>stripslashes($user[0]['state']) ) ); ?>
                <?php } ?>
              </div>
            </div>
          </div>
          <div id="stateerror" class="error">state is required.</div>
        </div>
        <div class="form-cols"><!-- two form cols -->
          <div class="col1">
            <div class="clearfix">
              <div class="lab">
                <label for="zipcode">Zipcode <span class="errorsign">*</span></label>
              </div>
              <div class="con">
                <?php if($this->uri->segment(2) == 'add') { ?>
                <?php echo form_input( array( 'name'=>'zipcode','id'=>'zipcode','class'=>'input','type'=>'text' ) ); ?>
                <?php } ?>
                <?php if($this->uri->segment(2) == 'edit') { ?>
                <?php echo form_input( array( 'name'=>'zipcode','id'=>'zipcode','class'=>'input','type'=>'text','value'=>stripslashes($user[0]['zipcode']) ) ); ?>
                <?php } ?>
              </div>
            </div>
          </div>
          <div id="zipcodeerror" class="error">Enter digits only.</div>
        </div>
        <div class="form-cols"><!-- two form cols -->
          <div class="col1">
            <div class="clearfix">
              <div class="lab">
                <label for="phoneno">Phoneno <span class="errorsign">*</span></label>
              </div>
              <div class="con">
                <?php if($this->uri->segment(2) == 'add') { ?>
                <?php echo form_input( array( 'name'=>'phoneno','id'=>'phoneno','class'=>'input','type'=>'text' ) ); ?>
                <?php } ?>
                <?php if($this->uri->segment(2) == 'edit') { ?>
                <?php echo form_input( array( 'name'=>'phoneno','id'=>'phoneno','class'=>'input','type'=>'text','value'=>stripslashes($user[0]['phoneno']) ) ); ?>
                <?php } ?>
              </div>
            </div>
          </div>
          <div id="phonenoerror" class="error">Enter digits only valid format(0123456789).</div>
        </div>
        <div class="btn-submit" style="padding: 15px 0 0 22%;"> 
          <!-- Submit form -->
          <?php if($this->uri->segment(2) == 'add') { ?>
          <?php echo form_input(array('name'=>'btnsubmit','id'=>'btnsubmit','class'=>'button','type'=>'submit','value'=>'Submit')); ?>
          <?php } ?>
          <?php if($this->uri->segment(2) == 'edit') { ?>
          <?php echo form_input(array('name'=>'btnupdate','id'=>'btnupdate','class'=>'button','type'=>'submit','value'=>'Update')); ?>
          <?php } ?>
          or <a href="<?php echo site_url('user');?>" class="Cancel">Cancel</a> </div>
      </fieldset>
      <?php if($this->uri->segment(2) == 'edit') { ?>
      <?php echo form_hidden( array( 'id' => $this->encrypt->encode($user[0]['id']) ) ); ?>
      <?php } ?>
      <?php echo form_close(); ?></div>
  </div>
  <!-- /box-content -->
  
  <?php } else { ?>
  <?php echo link_tag('colorbox/colorbox.css'); ?> 
  <script language="javascript" type="text/javascript" src="<?php echo base_url();?>colorbox/jquery.colorbox.js"></script> 
  <script language="javascript" type="text/javascript">
  $(document).ready(function(){
		//$('.colorbox').colorbox({'width':'55%'});
		$('.colorbox').colorbox({'width':'55%','height':'60%'});
/*		$('.colorbox').colorbox({ 
			onComplete : function() { 
			   $(this).colorbox.resize();
			}
		});
*/  });
</script> 
  
  <!-- box -->
  <div class="box">
    <div class="headlines">
      <h2><span> Users: </span></h2>
       
        <h2><span>

        <a href="<?php if(!empty($_GET['s'])){ echo site_url('user/csv/'.$_GET['s']); } else { echo site_url('user/csv'); } ?>" title="Export as CSV file">
       <img src="<?php echo base_url(); ?>images/csv.jpeg" alt="" title="Export as CSV file" width="20" height="20"/>&nbsp;CSV </a>
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
    
    <div class="box-content"> <?php echo form_open('user/searchuser',array('class'=>'formBox','id'=>'frmsearch')); ?>
      <fieldset>
        <!-- Error form message -->
        <div class="form-cols"><!-- two form cols -->
          <div class="col1">
            <div class="clearfix">
              <div class="lab">
                <label for="keysearch">Keyword<span>*</span></label>
              </div>
              <div class="con"> <?php echo form_input( array( 'name'=>'keysearch','id'=>'keysearch','class'=>'input','type'=>'text','placeholder'=>'Search user by name or email','value'=>"")); ?> </div>
            </div>
          </div>
          <div id="keysearcherror" style="display:none;" class="error" align="right">Enter Keyword.</div>
        </div>
        <div class="btn-submit"> 
          <!-- Submit form --> 
          <?php echo form_input(array('name'=>'btnsearch','id'=>'btnsearch','class'=>'button','type'=>'submit','value'=>'Search','style'=>'margin-left:-48px;')); ?> or <a href="<?php echo site_url('user');?>" class="Cancel">Cancel</a> </div>
          
          <?php if(!empty($_GET['s']))
			{	   
				echo "<div style='margin-top:1em;'> Search results for <span style='color:#1a2e4d'>' ". $_GET['s'] . " ' </span> </div>";
			}
			
		?>
         
      </fieldset>
      <?php echo form_close(); ?> </div>
  
    <?php if( count($users) > 0 ) {  ?>
		<table class="tab tab-drag">
		<thead>
			<tr class="top nodrop nodrag">
			<?php foreach($fields as $field_name => $field_display): ?>
			<th <?php if ($sort_by == $field_name) echo "class=\"sort_$sort_order sorttitle \"" ?>>
				<?php 
					if($sort_by == $field_name){ 
						$field_display .= "<img alt='desc' src='".site_url("images/sort_".$sort_order.".gif")."'/>";
					}
				 ?>
				<?php echo anchor("user/index/$field_name/" .
					(($sort_order == 'asc' && $sort_by == $field_name) ? 'desc' : 'asc') ,
					$field_display,array('class' => 'sorttitle')); ?>
			</th>
			
			
			<?php endforeach; ?>
			<th>Action</th>
			</tr>
		</thead>
		
		<tbody>
			<?php foreach($users as $user): ?>
			<tr>
				<?php foreach($fields as $field_name => $field_display): ?>
				<td>
					<?php if( $field_name == 'firstname' ){ ?>
						<a style="color: #404040;" class="colorbox cboxElement" title="View Detail of chirag suthar" href="<?php echo site_url('user/view/'.$user->id); ?>">
							<?php echo $user->firstname .' '. $user->lastname;  ?>
						</a>	
					<?php 
						  }else if ($field_name == 'registerdate' ) {
							echo date('m-d-Y',strtotime($user->registerdate));
						  
						  }else if ($field_name == 'status' ) { ?>
							<?php
							if( $user->$field_name == 'Enable' ){ ?>
								<a href="<?php echo site_url('user/disable/'.$user->id);?>" title="Click to Disable" class="btn btn-small btn-success" onClick="return confirm('Are you sure to Disable this user?');"><span><?php echo $user->$field_name; ?></span></a>
								
							<?php 
							}else{ ?>
								
							<a href="<?php echo site_url('user/enable/'.$user->id);?>" title="Click to Enable" class="btn btn-small btn-success" style="cursor:default; color: #CD0B1C;" onClick="return confirm('Are you sure to Enable this user?');"><span><?php echo $user->$field_name; ?></span></a>
						 <?php
							}
						  
						  }else{						
							echo $user->$field_name; 
						  }
					?>	
					
				</td>			
				<?php endforeach; ?>
				<td>
					<a href="<?php echo site_url('user/edit/'.$user->id); ?>" title="Edit" class="ico ico-edit">Edit</a> 
					<a href="<?php echo site_url('user/view/'.$user->id); ?>" title="View Detail of <?php echo stripslashes($user->firstname).' '.stripslashes($user->lastname); ?>" class="colorbox"><img width="16" height="17" border="0" src="images/detail.jpeg" alt="view"></a> 
					<a href="<?php echo site_url('user/delete/'.$user->id);?>" title="Delete" class="ico ico-delete" onClick="return confirm('Are you sure to Delete this user?');">Delete</a>
				</td>
			</tr>
			<?php endforeach; ?>			
		</tbody>
		
	</table>
	
	<?php if ($this->pagination->create_links()): ?>
	<div class="pagination">
		 <?php echo $this->pagination->create_links(); ?>
	</div>
	<?php endif; ?>
		
		
	<?php
		
	}else { ?>
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
