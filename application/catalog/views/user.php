<?php echo $header; ?>
<section class="container">
  <section class="inner_main">
    
    <!-- #content -->
    
    <div id="main_contentarea"> <?php //echo $menu; ?>
      <div class="login_box_div">
        <?php if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'register' || $this->uri->segment(2) == 'edit' ) ) { ?>
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
                      dataType 		: "json",
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
		  
		  function chkuser(username)
          {
              //alert(email);
              var filter  = /^[A-Za-z0-9]+(?:[ _-][A-Za-z0-9]+)*$/;
              if( trim(username) != '' && filter.test(trim(username)) )
              {
                  $("#unameerror").hide();
				  $("#unameverror").hide();
				  $("#utknerror").hide();
                  //Return from conroller in php code : echo json_encode(array("result"=>"exist"));
                  $.ajax({
                      type 				: "POST",
                      url 				: "<?php echo site_url('user/fieldcheck'); ?>",
                      data				:	{ <?php if($this->uri->segment(2) == 'edit' ) echo "'id' : ".$user[0]['id'].", "; ?>'username' 		: username },
                      dataType 			: "json",
                      cache				: false,
                      success			: function(data){
                                                      //alert(data.result); return false;
                                                      if( data.result == 'old')
                                                      {
                                                          $("#unameerror").hide();
                                                          $("#utknerror").show();
                                                          $("#username").val('').focus();
                                                          return false;
                                                      }
                                                      else
                                                      {
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
                  $("#username").val('').focus();
                  return false;
              }
          }
      </script> 
        <script type="text/javascript" language="javascript">
              function trim(stringToTrim) {
                  return stringToTrim.replace(/^\s+|\s+$/g,"");
              }
              $(document).ready(function() {
                  
              <?php if( $this->uri->segment(2) =='register' ) { ?>
                  $("#btnsubmit").click(function () {
              <?php } ?>
              <?php if( $this->uri->segment(2) == 'edit' ) { ?>
                  $("#btnupdate").click(function () {
              <?php } ?>
              
					 var filter1  = /^[A-Za-z0-9]+(?:[ _-][A-Za-z0-9]+)*$/;
					  if( trim($("#username").val()) == "" )
					  {
						  $("#unameerror").show();
						  $("#unameverror").hide();
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
							  $("#unameerror").hide();
							  $("#unameverror").hide();
						  }
					  }
					 
					 
					 
					 
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
                      dataType 		: "json",
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
					  }
                      
                      <?php if($this->uri->segment(2) == 'register') { ?>
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
                          $("#repasserror").show();
                          $("#repassword").val('').focus();
                          return false;
                      }
                      else
                      {
                          if($("#repassword").val()!=$("#password").val())
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
                      <?php if( $this->uri->segment(2) == 'register' ) { ?>
                      if(!$("#terms").is(":checked") )
                      {
                          $("#termserror").show();
                          //$("#terms").val('').focus();
                          return false;
                      }
                      else
                      {
                          $("#termserror").hide();
                      }
                      <?php } ?>
                      $("#frmuser").submit();
                          
                  });
              
              });
          </script> 
        
        <!-- box -->
        <div class="login_box">
          <div class="login_box_title"><?php echo $section_title; ?></div>
          
          <?php echo form_open_multipart('user/update',array('class'=>'formBox','id'=>'frmuser')); ?>
          <table class="data_table" align="left" width="900px">
            <tbody>
              <tr>
                <td class="box_label" width="180px" valign="middle"><box_labelel for="username">Username</box_labelel>
                  <span class="error-sign">*</span></td>
                <td><?php if($this->uri->segment(2) =='register') { ?>
                  <?php echo form_input( array( 'name'=>'username','id'=>'username','class'=>'box_txtbox','type'=>'text' ,'onchange'=>'chkuser(this.value)') ); ?>
                  <?php } ?>
                  <?php if($this->uri->segment(2) == 'edit') { ?>
                  <?php echo form_input( array( 'name'=>'username','id'=>'username','class'=>'box_txtbox','type'=>'text','value'=>stripslashes($user[0]['username']),'onchange'=>'chkuser(this.value)' ) ); ?>
                  <?php } ?></td>
                <td width="320px"><div id="unameerror" class="error">User Name is required.</div>
                  <div id="unameverror" class="error">Enter Valid User Name(Only characters and numbers).</div>
                  <div id="utknerror" class="error">This Username is already taken.</div>
                  </td>
              </tr>
              <tr>
                <td class="box_label" width="180px" valign="middle"><box_labelel for="firstname">First Name</box_labelel>
                  <span class="error-sign">*</span></td>
                <td><?php if($this->uri->segment(2) =='register') { ?>
                  <?php echo form_input( array( 'name'=>'firstname','id'=>'firstname','class'=>'box_txtbox','type'=>'text' ) ); ?>
                  <?php } ?>
                  <?php if($this->uri->segment(2) == 'edit') { ?>
                  <?php echo form_input( array( 'name'=>'firstname','id'=>'firstname','class'=>'box_txtbox','type'=>'text','value'=>stripslashes($user[0]['firstname']) ) ); ?>
                  <?php } ?></td>
                <td width="320px"><div id="fnameerror" class="error">First Name is required.</div>
                  <div id="fnameverror" class="error">Enter Valid First Name(Only characters).</div></td>
              </tr>
              <tr>
                <td class="box_label" width="180px" valign="middle"><box_labelel for="lastname">Last Name</box_labelel>
                  <span class="error-sign">*</span></td>
                <td><?php if($this->uri->segment(2) =='register') { ?>
                  <?php echo form_input( array( 'name'=>'lastname','id'=>'lastname','class'=>'box_txtbox','type'=>'text' ) ); ?>
                  <?php } ?>
                  <?php if($this->uri->segment(2) == 'edit') { ?>
                  <?php echo form_input( array( 'name'=>'lastname','id'=>'lastname','class'=>'box_txtbox','type'=>'text','value'=>stripslashes($user[0]['lastname']) ) ); ?>
                  <?php } ?></td>
                <td><div id="lnameerror" class="error">Last Name is required.</div>
                  <div id="lnameverror" class="error">Enter Valid Last Name(Only characters).</div></td>
              </tr>
              <tr>
                <td class="box_label" width="180px" valign="middle"><box_labelel for="email">Email</box_labelel>
                  <span class="error-sign">*</span></td>
                <td><?php if($this->uri->segment(2) =='register') { ?>
                  <?php echo form_input( array( 'name'=>'email','id'=>'email','class'=>'box_txtbox','type'=>'text','onchange'=>'chkmail(this.value)' ) ); ?>
                  <?php } ?>
                  <?php if($this->uri->segment(2) == 'edit') { ?>
                  <?php echo form_input( array( 'name'=>'email','id'=>'email','class'=>'box_txtbox','type'=>'text','value'=>stripslashes($user[0]['email']),'onchange'=>'chkmail(this.value)' ) ); ?>
                  <?php } ?></td>
                <td><div id="emailerror" class="error">Enter valid Emailid.</div>
                  <div id="emailtknerror" class="error">This Emailid already taken.</div></td>
              </tr>
              <?php if($this->uri->segment(2) =='register') { ?>
              <tr>
                <td class="box_label" width="180px" valign="middle"><box_labelel for="password">Password</box_labelel>
                  <span class="error-sign">*</span></td>
                <td><?php echo form_input( array( 'name'=>'password','id'=>'password','class'=>'box_txtbox','type'=>'password' ) ); ?></td>
                <td><div id="passerror" class="error">Password is required.</div>
                  <div id="passverror" class="error">Enter valid password.(Mininum length 6)</div></td>
              </tr>
              <tr>
                <td class="box_label" width="180px" valign="middle"><box_labelel for="repassword">Confirm Password</box_labelel>
                  <span class="error-sign">*</span></td>
                <td><?php echo form_input( array( 'name'=>'repassword','id'=>'repassword','class'=>'box_txtbox','type'=>'password' ) ); ?></td>
                <td><div id="repasserror" class="error">Password and Confirm Password dont match.</div></td>
              </tr>
              <?php } ?>
              <tr>
                <td class="box_label" width="180px" valign="middle"><box_labelel for="gender">Gender</box_labelel>
                  <span class="error-sign">*</span></td>
                <td><?php if($this->uri->segment(2) =='register') { ?>
                  <?php echo form_radio(array('name'=>'gender','type'=>'radio','id'=>'radmale','class'=>'input','value'=>'Male','style'=>'float:none','checked'=>'checked')); ?>
                  <box_labelel for="radmale">Male</box_labelel>
                  <?php echo form_radio(array('name'=>'gender','type'=>'radio','id'=>'radfemale','class'=>'input','value'=>'Female','style'=>'float:none')); ?>
                  <box_labelel for="radfemale">Female</box_labelel>
                  <?php } ?>
                  <?php if($this->uri->segment(2) == 'edit') { ?>
                  <?php if($user[0]['gender'] == 'Male'){?>
                  <?php echo form_radio(array('name'=>'gender','type'=>'radio','id'=>'radmale','class'=>'input','value'=>'Male','checked'=>'checked','style'=>'float:none'));  } else {?> <?php echo form_radio(array('name'=>'gender','type'=>'radio','id'=>'radmale','class'=>'input','value'=>'Male','style'=>'float:none')); ?>
                  <?php } ?>
                  <box_labelel for="radmale">Male</box_labelel>
                  <?php if($user[0]['gender'] == 'Female'){?>
                  <?php echo form_radio(array('name'=>'gender','type'=>'radio','id'=>'radfemale','class'=>'input','value'=>'Female','checked'=>'checked','style'=>'float:none')); } else { ?> <?php echo form_radio(array('name'=>'gender','type'=>'radio','id'=>'radfemale','class'=>'input','value'=>'Female','style'=>'float:none')); ?>
                  <?php } ?>
                  <box_labelel for="radfemale">Female</box_labelel>
                  <?php } ?></td>
              </tr>
              <tr>
                <td class="box_label" width="180px" valign="middle"><box_labelel for="street">Street Address</box_labelel>
                  <span class="error-sign">*</span></td>
                <td><?php if($this->uri->segment(2) =='register') { ?>
                  <?php echo form_input( array( 'name'=>'street','id'=>'street','class'=>'box_txtbox','type'=>'text' ) ); ?>
                  <?php } ?>
                  <?php if($this->uri->segment(2) == 'edit') { ?>
                  <?php echo form_input( array( 'name'=>'street','id'=>'street','class'=>'box_txtbox','type'=>'text','value'=>stripslashes($user[0]['street']) ) ); ?>
                  <?php } ?></td>
                <td width="320px"><div id="streeterror" class="error">Street Address is required.</div>
                  </td>
              </tr>
              <tr>
                <td class="box_label" width="180px" valign="middle"><box_labelel for="city">City</box_labelel>
                  <span class="error-sign">*</span></td>
                <td><?php if($this->uri->segment(2) =='register') { ?>
                  <?php echo form_input( array( 'name'=>'city','id'=>'city','class'=>'box_txtbox','type'=>'text' ) ); ?>
                  <?php } ?>
                  <?php if($this->uri->segment(2) == 'edit') { ?>
                  <?php echo form_input( array( 'name'=>'city','id'=>'city','class'=>'box_txtbox','type'=>'text','value'=>stripslashes($user[0]['city']) ) ); ?>
                  <?php } ?></td>
                <td width="320px"><div id="cityerror" class="error">City is required.</div>
                  </td>
              </tr>
              <tr>
                <td class="box_label" width="180px" valign="middle"><box_labelel for="state">State</box_labelel>
                  <span class="error-sign">*</span></td>
                <td><?php if($this->uri->segment(2) =='register') { ?>
                  <?php echo form_input( array( 'name'=>'state','id'=>'state','class'=>'box_txtbox','type'=>'text' ) ); ?>
                  <?php } ?>
                  <?php if($this->uri->segment(2) == 'edit') { ?>
                  <?php echo form_input( array( 'name'=>'state','id'=>'state','class'=>'box_txtbox','type'=>'text','value'=>stripslashes($user[0]['state']) ) ); ?>
                  <?php } ?></td>
                <td width="320px"><div id="fnameerror" class="error">State is required.</div>
                  </td>
              </tr>
              <tr>
                <td class="box_label" width="180px" valign="middle"><box_labelel for="zipcode">Zipcode</box_labelel>
                  <span class="error-sign">*</span></td>
                <td><?php if($this->uri->segment(2) =='register') { ?>
                  <?php echo form_input( array( 'name'=>'zipcode','id'=>'zipcode','class'=>'box_txtbox','type'=>'text' ) ); ?>
                  <?php } ?>
                  <?php if($this->uri->segment(2) == 'edit') { ?>
                  <?php echo form_input( array( 'name'=>'zipcode','id'=>'zipcode','class'=>'box_txtbox','type'=>'text','value'=>stripslashes($user[0]['zipcode']) ) ); ?>
                  <?php } ?></td>
                <td width="320px"><div id="zipcodeerror" class="error">Enter digits only.</div>
                  </td>
              </tr>
              <tr>
                <td class="box_label" width="180px" valign="middle"><box_labelel for="phoneno">Phoneno</box_labelel>
                  <span class="error-sign">*</span></td>
                <td><?php if($this->uri->segment(2) =='register') { ?>
                  <?php echo form_input( array( 'name'=>'phoneno','id'=>'phoneno','class'=>'box_txtbox','type'=>'text' ) ); ?>
                  <?php } ?>
                  <?php if($this->uri->segment(2) == 'edit') { ?>
                  <?php echo form_input( array( 'name'=>'phoneno','id'=>'phoneno','class'=>'box_txtbox','type'=>'text','value'=>stripslashes($user[0]['phoneno']) ) ); ?>
                  <?php } ?></td>
                <td width="320px"><div id="phonenoerror" class="error">Enter digits only.valid fomrat(0123456789)</div>
                  </td>
              </tr>
              <tr>
                <td class="box_label" width="180px" valign="middle"><box_labelel for="photo">Profile Photo</box_labelel>
                  <span class="error-sign"></span></td>
                <td><?php echo form_input( array( 'name'=>'avatarbig','id'=>'avatarbig','class'=>'input file upload-file','type'=>'file','style'=>'float:left') ); ?></td>
                <td><?php if($this->uri->segment(2) == 'edit') { ?>
                  <?php if(stripslashes($user[0]['avatarbig'])!='') { ?>
                  <?php 
                  $site = site_url();
                  $url = explode("/admincp",$site);
                  $path = $url[0];
                  ?>
                  <img src="<?php echo $path;?>uploads/user/thumb/<?php echo stripslashes($user[0]['avatarbig']); ?>" title="<?php echo stripslashes($user[0]['firstname']); ?>" alt="<?php echo stripslashes($user[0]['firstname']); ?>" style="max-height:60px;max-width:60px;" />
                  <?php } else { echo "No Image"; } ?>
                  <?php } ?>
                  <div id="photoerror" class="error">Profile Photo is required.</div></td>
              </tr>
              <?php if($this->uri->segment(2) =='register') { ?>
              <tr>
                <td valign="top"></td>
                <td id="tdterms"><?php echo form_checkbox(array('name'=>'terms','type'=>'checkbox','id'=>'terms','value'=>'Yes')); ?>&nbsp;I agree with the <a href="<?php echo site_url('terms');?>" target="_blank" title="Terms and Conditions">Terms and Conditions</a></td>
                <td><div id="termserror" class="error">Please agree with Terms and Conditions.</div></td>
              </tr>
              <?php } ?>
              <tr>
                <td></td>
                <td><!-- Submit form -->
                  
                  <?php if($this->uri->segment(2) =='register') { ?>
                  <?php echo form_input(array('name'=>'btnsubmit','id'=>'btnsubmit','class'=>'dir-searchbtn','type'=>'submit','value'=>'Create Account','style'=>'float:none;color:#fff; padding: 3px 16px;font-size:16px;text-shadow:none;')); ?>
                  <?php } ?>
                  <?php if($this->uri->segment(2) == 'edit') { ?>
                  <?php echo form_input(array('name'=>'btnupdate','id'=>'btnupdate','class'=>'dir-searchbtn','type'=>'submit','value'=>'Update','style'=>'float:none;color:#fff; padding: 3px 16px;font-size:16px;text-shadow:none;')); ?>
                  <?php } ?>
                  </td>
                <td></td>
              </tr>
            </tbody>
          </table>
          <?php if($this->uri->segment(2) == 'edit') { ?>
          <?php echo form_hidden( array( 'id' => $this->encrypt->encode($user[0]['id']) ) ); ?>
          <?php } ?>
          <?php echo form_close(); ?> </div>
        <!-- /box-content -->
        
        <?php } 
          else if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'changepassword' ) ) { ?>
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
        <div class="login_box"> 
          <!-- box -->
          <div class="box">
            <div class="job_box_title"><?php echo $section_title; ?></div>
           
            <?php echo form_open('user/update',array('class'=>'formBox','id'=>'frmchpass')); ?>
            <table class="data_table">
              <tbody>
                <tr>
                  <td class="box_label" width="180px"><box_labelel for="oldpassword">Old Password</box_labelel>
                    <span class="error-sign">*</span></td>
                  <td><?php echo form_input( array( 'name'=>'oldpassword','id'=>'oldpassword','class'=>'box_txtbox','type'=>'password' ) ); ?></td>
                  <td><div id="oldpasserror" class="error">Old Password is required.</div></td>
                </tr>
                <tr>
                  <td class="box_label" width="180px"><box_labelel for="newpassword">New Password</box_labelel>
                    <span class="error-sign">*</span></td>
                  <td><?php echo form_input( array( 'name'=>'newpassword','id'=>'newpassword','class'=>'box_txtbox','type'=>'password' ) ); ?></td>
                  <td><div id="newpasserror" class="error">New Password is required.</div></td>
                </tr>
                <tr>
                  <td class="box_label" width="180px"><box_labelel for="repassword">Re Password</box_labelel>
                    <span class="error-sign">*</span></td>
                  <td><?php echo form_input( array( 'name'=>'repassword','id'=>'repassword','class'=>'box_txtbox','type'=>'password' ) ); ?></td>
                  <td><div id="repasserror" class="error">New Password and Re-Password dont match.</div></td>
                </tr>
                <tr>
                  <td></td>
                  <td><!-- Submit form --> 
                    <?php echo form_input(array('name'=>'btnpassupdate','id'=>'btnpassupdate','class'=>'dir-searchbtn','type'=>'submit','value'=>'Update','style'=>'float:none;color:#fff; padding: 3px 16px;font-size:16px;text-shadow:none;')); ?></td>
                  <td></td>
                </tr>
              </tbody>
            </table>
            <?php echo form_hidden( array( 'id' => $this->encrypt->encode($user[0]['id']) ) ); ?> <?php echo form_close(); ?> </div>
          <!-- /box-content --> 
        </div>
        <?php } 
        
        
        
                    //complaints//
                    
                    
                    
                    
					else if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'complaints'))
					{ ?>
        <div class="login_box">
          <?php if( $this->session->userdata('youg_user') ){ ?>
          <table align="left" border="0" style="margin-top:22px;">
          <tr>
            <td valign="top"><div class="task-photo"> <img width="60px" src="<?php if( strlen($user[0]['avatarbig']) > 1 ){ echo $this->common->get_setting_value('2').$this->config->item('user_thumb_upload_path');?><?php echo stripslashes($user[0]['avatarbig']); } else { if($user[0]['gender']=='Male') { echo $this->common->get_setting_value('2')."images/male.png"; } 
		  	if($user[0]['gender']=='Female') { echo $this->common->get_setting_value('2')."images/female.png"; } 
		  } 
		   ?>" alt="<?php echo stripslashes($user[0]['firstname']); ?>"/> </div>
              </td>
            </tr>
            <tr>
              <td><div class="login_box_title" style="font-size:16px;"><?php echo $user[0]['username']; ?></div>
                <div class="user_view"><a href="<?php echo site_url('user/edit'); ?>" title="edit personal details">Edit Personal Details</a></div>
                <div class="user_view"><a href="<?php echo site_url('user/changepassword'); ?>" title="change password">Change Password</a></div>
                <?php $totalcomplaints=$this->users->get_all_complaintsby_userid($user[0]['id']);?>
                <?php $totalcomments=$this->users->get_all_commentsby_userid($user[0]['id']);?>
                <?php $totaldisputes=$this->users->get_all_disputesby_userid($user[0]['id']);?>
                <?php $totalrating = $this->users->get_all_rating($user[0]['id']);?>
                <div class="user_view"><a href="<?php echo site_url('user/complaints'); ?>" title="Complaints"><span class="colorcode">Complaints ( <?php echo count($totalcomplaints);?> )</span></a></div>
                <div class="user_view"><a href="<?php echo site_url('user/comments'); ?>" title="Comments">Comments ( <?php echo count($totalcomments);?> )</a></div>
                <div class="user_view"><a href="<?php echo site_url('user/disputes'); ?>" title="Disputes">Disputes ( <?php echo count($totaldisputes);?> )</a></div>
                <div class="user_view"><a href="<?php echo site_url('user/myratings'); ?>" title="My Ratings"><span class="colorcode">My Ratings ( <?php echo count($totalrating);?> )</span></a></div>
              </td>              
            </tr>
          </table>
          <?php }  ?>
          <table align="right" border="0" class="tablecompliant">
            <tr>
              <td><div class="right_content_panel">
                  <div class="treding_title">Complaints</div>
                  <?php if(count($complaints)>0){ ?>
                  <?php //echo '<pre>'; print_r($complaints); die();?>
                  <?php for($i=0; $i<count($complaints); $i++) { ?>
                  <?php $company=$this->users->get_company_byid($complaints[$i]['companyid']) ;?>
                  <div class="main_livepost">
                    <div class="post_maincontent">
                      <div class="search_content_title"><a href="<?php echo site_url('complaint/browse/'.$complaints[$i]['comseokeyword']); ?>" title="view complaint detail">
                        <?php if(count($company)>0) {
									echo stripslashes($company[0]['company'])." Complaint for $".$complaints[$i]['damagesinamt'];?>
                        </a>
                        <?php } ?>
                      </div>
                      <?php 
                        $date = date_default_timezone_set('UTC');                             
							$dbdate = date('Y-m-d',strtotime($complaints[$i]['whendate']));
                            $complaindate = date('m/d/Y',strtotime($complaints[$i]['complaindate']));
                            $today = date('m/d/Y');
							$d1 = strtotime(date('Y-m-d H:i:s'));
							$d2 = strtotime($complaints[$i]['complaindate']);
							$newdate =round(($d1-$d2)/60);
							if($newdate > 60){$diff = round(($d1-$d2)/60/60).' hours ago';}else{$diff = $newdate.' minutes ago';}
							?>
                      <div class="search_content_date" style="margin-bottom:15px;"> <?php echo ($complaindate==$today)?"Posted ".$diff:"Posted ".date('d M,Y',strtotime($complaints[$i]['complaindate'])); ?> </div>
                      <div class="post_content_dscr user_view"> <a href="<?php echo site_url('complaint/browse/'.$complaints[$i]['comseokeyword']); ?>" title="view complaint detail"> <?php echo substr(stripslashes($complaints[$i]['detail']),0,212)."..."; ?></a> </div>
                    </div>
                  </div>
                  <?php } ?>
                  <?php } else {?>
                  <div class="main_livepost">
                    <div class="post_maincontent">
                      <div class="form-message warning">
                        <p>No Complaints.</p>
                      </div>
                    </div>
                  </div>
                  <?php } ?>
                </div></td>
            </tr>
          </table>
        </div>
        
        
                             <?php //comments ?>
        
        <?php	}	else if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'comments'))
					{ ?>
        <div class="login_box">
          <?php if( $this->session->userdata('youg_user') ){ ?>
          <table align="left" border="0" style="margin-top:22px;">
            <tr>
            <td valign="top"><div class="task-photo"> <img width="60px" src="<?php if( strlen($user[0]['avatarbig']) > 1 ){ echo $this->common->get_setting_value('2').$this->config->item('user_thumb_upload_path');?><?php echo stripslashes($user[0]['avatarbig']); } else { if($user[0]['gender']=='Male') { echo $this->common->get_setting_value('2')."images/male.png"; } 
		  	if($user[0]['gender']=='Female') { echo $this->common->get_setting_value('2')."images/female.png"; } 
		  } 
		   ?>" alt="<?php echo stripslashes($user[0]['firstname']); ?>"/> </div>
              </td>
            </tr>
            <tr>
              <td><div class="login_box_title" style="font-size:16px;"><?php echo $user[0]['username']; ?></div>
                <div class="user_view"><a href="<?php echo site_url('user/edit'); ?>" title="edit personal details">Edit Personal Details</a></div>
                <div class="user_view"><a href="<?php echo site_url('user/changepassword'); ?>" title="change password">Change Password</a></div>
                <?php $totalcomplaints=$this->users->get_all_complaintsby_userid($user[0]['id']);?>
                <?php $totalcomments=$this->users->get_all_commentsby_userid($user[0]['id']);?>
                <?php $totaldisputes=$this->users->get_all_disputesby_userid($user[0]['id']);?>
                <?php $totalrating = $this->users->get_all_rating($user[0]['id']);?>
                <div class="user_view"><a href="<?php echo site_url('user/complaints'); ?>" title="Complaints">Complaints ( <?php echo count($totalcomplaints);?> )</a></div>
                <div class="user_view"><a href="<?php echo site_url('user/comments'); ?>" title="Comments"><span class="colorcode">Comments ( <?php echo count($totalcomments);?> )</span></a></div>
                <div class="user_view"><a href="<?php echo site_url('user/disputes'); ?>" title="Disputes">Disputes ( <?php echo count($totaldisputes);?> )</a></div>
                <div class="user_view"><a href="<?php echo site_url('user/myratings'); ?>" title="My Ratings"><span class="colorcode">My Ratings ( <?php echo count($totalrating);?> )</span></a></div>
              </td>
            </tr>
          </table>
          <?php }  ?>
          <table align="right" border="0" class="tablecompliant">
            <tr>
              <td><div class="right_content_panel" >
                  <div class="treding_title">Comments</div>
                  <?php if(count($comments)>0){ ?>
                  <?php //echo '<pre>'; print_r($complaints); die();?>
                  <?php for($i=0; $i<count($comments); $i++) { ?>
                  <div class="main_livepost">
                    <div class="post_maincontent">
                      <?php 
                        $date = date_default_timezone_set('UTC');                             
					//		$dbdate = date('Y-m-d',strtotime($complaints[$i]['whendate']));
                            $commentdate = date('m/d/Y',strtotime($comments[$i]['commentdate']));
                            $today = date('m/d/Y');
							$d1 = strtotime(date('Y-m-d H:i:s'));
							$d2 = strtotime($comments[$i]['commentdate']);
							$newdate =round(($d1-$d2)/60);
							if($newdate > 60){$diff = round(($d1-$d2)/60/60).' hours ago';}else{$diff = $newdate.' minutes ago';}
							?>
                      <div class="search_content_date user_view" style="margin-bottom:15px;"> <?php echo ($commentdate==$today)?$diff:date('d M,Y',strtotime($comments[$i]['commentdate'])); ?>&nbsp;&nbsp;<a href="<?php echo site_url('review/deletecomment/'.$comments[$i]['id']);?>" style="float:right;text-decoration:underline;" onclick="return confirm('Are you sure to delete this comment?');" title="delete comment">delete</a> <span style="float:right">&nbsp;or&nbsp;</span> <a href="<?php echo site_url('review/editcomment/'.$comments[$i]['id']);?>" style="float:right;text-decoration:underline;" title="edit comment">edit</a> </div>
                      <div class="post_content_dscr user_view"> <?php echo nl2br(stripslashes($comments[$i]['comment'])); ?> </div>
                    </div>
                  </div>
                  <?php } ?>
                  <?php } else { ?>
                  <div class="main_livepost">
                    <div class="post_maincontent">
                      <div class="form-message warning">
                        <p>No Comments.</p>
                      </div>
                    </div>
                  </div>
                  <?php 
				} ?>
                </div></td>
            </tr>
          </table>
        </div>
        
                                    <?php //Disputes ?>
        <?php	} 
					else if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'disputes'))
					{ ?>
        <div class="login_box">
          <?php if( $this->session->userdata('youg_user') ){ ?>
          <table align="left" border="0" style="margin-top:22px;">
            <tr>
            <td valign="top"><div class="task-photo"> <img width="60px" src="<?php if( strlen($user[0]['avatarbig']) > 1 ){ echo $this->common->get_setting_value('2').$this->config->item('user_thumb_upload_path');?><?php echo stripslashes($user[0]['avatarbig']); } else { if($user[0]['gender']=='Male') { echo $this->common->get_setting_value('2')."images/male.png"; } 
		  	if($user[0]['gender']=='Female') { echo $this->common->get_setting_value('2')."images/female.png"; } 
		  } 
		   ?>" alt="<?php echo stripslashes($user[0]['firstname']); ?>"/> </div>
              </td>
            </tr>
            <tr>
              <td><div class="login_box_title" ><?php echo $user[0]['username']; ?></div>
                <div class="user_view"><a href="<?php echo site_url('user/edit'); ?>" title="edit personal details">Edit Personal Details</a></div>
                <div class="user_view"><a href="<?php echo site_url('user/changepassword'); ?>" title="change password">Change Password</a></div>
                <?php $totalcomplaints=$this->users->get_all_complaintsby_userid($user[0]['id']);?>
                <?php $totalcomments=$this->users->get_all_commentsby_userid($user[0]['id']);?>
                <?php $totaldisputes=$this->users->get_all_disputesby_userid($user[0]['id']);?>
                <?php $totalrating = $this->users->get_all_rating($user[0]['id']);?>
                <div class="user_view"><a href="<?php echo site_url('user/complaints'); ?>" title="Complaints">Complaints ( <?php echo count($totalcomplaints);?> )</a></div>
                <div class="user_view"><a href="<?php echo site_url('user/comments'); ?>" title="Comments">Comments ( <?php echo count($totalcomments);?> )</a></div>
                <div class="user_view"><a href="<?php echo site_url('user/disputes'); ?>" title="Disputes"><span class="colorcode">Disputes ( <?php echo count($totaldisputes);?> )</span></a></div>
                <div class="user_view"><a href="<?php echo site_url('user/myratings'); ?>" title="My Ratings"><span class="colorcode">My Ratings ( <?php echo count($totalrating);?> )</span></a></div>
              </td>
            </tr>
          </table>
          <?php }  ?>
          <table align="right" border="0" class="tablecompliant">
            <tr>
              <td><div class="right_content_panel" >
                  <div class="treding_title" >Disputes</div>
                  <?php if(count($disputes)>0){ ?>
                  <?php //echo '<pre>'; print_r($complaints); die();?>
                  <?php for($i=0; $i<count($disputes); $i++) { ?>
                  <div class="main_livepost">
                    <div class="post_maincontent">
                      <?php 
                        $date = date_default_timezone_set('UTC');                             
					//		$dbdate = date('Y-m-d',strtotime($complaints[$i]['whendate']));
                            $date = date('m/d/Y',strtotime($disputes[$i]['ondate']));
                            $today = date('m/d/Y');
							$d1 = strtotime(date('Y-m-d H:i:s'));
							$d2 = strtotime($disputes[$i]['ondate']);
							$newdate =round(($d1-$d2)/60);
							if($newdate > 60){$diff = round(($d1-$d2)/60/60).' hours ago';}else{$diff = $newdate.' minutes ago';}
							?>
                      <div class="search_content_date user_view" style="margin-bottom:15px;">
						  <div class="post_content_dscr user_view"></div><br>
						  <div class="treding_title">Against company <b> <?php echo nl2br(stripslashes($disputes[$i]['companyname'])); ?> </b>&nbsp;&nbsp;<b>CASEID-#<?php echo $disputes[$i]['id'];?></b></div>
						  <div class="post_content_dscr user_view"><?php echo nl2br(stripslashes($disputes[$i]['dispute'])); ?> </div><br>
						  <div class="post_content_dscr user_view">
						  <a href='/dispute/message/<?php echo $disputes[$i]['msglink'];?>' style="color:#0080FF">Send & Check the Messages here</a><br>
						  <?php echo ($date==$today)?$diff:date('d M,Y',strtotime($disputes[$i]['ondate'])); ?>&nbsp;&nbsp;
						  </div>
						  <div  class="treding_title"></div>
						  
						  <?php /* <a href="<?php echo site_url('review/deletecomment/'.$disputes[$i]['id']);?>" style="float:right;text-decoration:underline;" onclick="return confirm('Are you sure to delete this comment?');" title="delete comment">delete</a>
                           <span style="float:right">&nbsp;or&nbsp;</span> 
                          <a href="<?php echo site_url('review/editcomment/'.$disputes[$i]['id']);?>" style="float:right;text-decoration:underline;" title="edit comment">edit</a> </div> */?>
                      
                      
                    </div>
                  </div>
                  <?php } ?>
                  <?php } else { ?>
                  <div class="main_livepost">
                    <div class="post_maincontent">
                      <div class="form-message warning">
                        <p>No Disputes.</p>
                      </div>
                    </div>
                  </div>
                  <?php 
				} ?>
                </div></td>
            </tr>
          </table>
        </div>
        <?php	} 
        
        
        //rating
        else if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'myratings'))
					{ ?>
        <div class="login_box">
          <?php if( $this->session->userdata('youg_user') ){ ?>
          <table align="left" border="0" style="margin-top:22px;">
            <tr>
            <td valign="top"><div class="task-photo"> <img width="60px" src="<?php if( strlen($user[0]['avatarbig']) > 1 ){ echo $this->common->get_setting_value('2').$this->config->item('user_thumb_upload_path');?><?php echo stripslashes($user[0]['avatarbig']); } else { if($user[0]['gender']=='Male') { echo $this->common->get_setting_value('2')."images/male.png"; } 
		  	if($user[0]['gender']=='Female') { echo $this->common->get_setting_value('2')."images/female.png"; } 
		  } 
		   ?>" alt="<?php echo stripslashes($user[0]['firstname']); ?>"/> </div>
              </td>
            </tr>
            <tr>
              <td><div class="login_box_title" ><?php echo $user[0]['username']; ?></div>
                <div class="user_view"><a href="<?php echo site_url('user/edit'); ?>" title="edit personal details">Edit Personal Details</a></div>
                <div class="user_view"><a href="<?php echo site_url('user/changepassword'); ?>" title="change password">Change Password</a></div>
                <?php $totalcomplaints=$this->users->get_all_complaintsby_userid($user[0]['id']);?>
                <?php $totalcomments=$this->users->get_all_commentsby_userid($user[0]['id']);?>
                <?php $totaldisputes=$this->users->get_all_disputesby_userid($user[0]['id']);?>
                <?php $totalrating = $this->users->get_all_rating($user[0]['id']);?>
                
                <div class="user_view"><a href="<?php echo site_url('user/complaints'); ?>" title="Complaints">Complaints ( <?php echo count($totalcomplaints);?> )</a></div>
                <div class="user_view"><a href="<?php echo site_url('user/comments'); ?>" title="Comments">Comments ( <?php echo count($totalcomments);?> )</a></div>
                <div class="user_view"><a href="<?php echo site_url('user/disputes'); ?>" title="Disputes"><span class="colorcode">Disputes ( <?php echo count($totaldisputes);?> )</span></a></div>
                <div class="user_view"><a href="<?php echo site_url('user/myratings'); ?>" title="My Ratings"><span class="colorcode">My Ratings ( <?php echo count($totalrating);?> )</span></a></div>
              </td>
            </tr>
          </table>
          <?php }  ?>
          <table align="right" border="0" class="tablecompliant">
            <tr>
              <td><div class="right_content_panel" >
                  <div class="treding_title" >My Ratings</div>
                  <?php if(count($myratings)>0){ ?>
                  <?php for($i=0; $i<count($myratings); $i++) { ?>
				  <?php $cmyname = $this->users->get_company_bysingleid($myratings[$i]['companyid']); ?>
				  <?php $review = $this->users->get_single_rating($user[0]['id'], $myratings[$i]['companyid']); ?>
                  <div class="main_livepost">
                    <div class="post_maincontent">
                      <div class="search_content_date user_view mg_btm">
						  <div>Against company <b> <?php echo $cmyname['company']; ?> </b></div>
					  </div>
					  <div><?php echo $myratings[$i]['reviewtitle']; ?></div>
					  <div class = "mg_btm"><?php echo $myratings[$i]['comment']; ?></div>
					  <?php if(count($review)>0) { ?>
							<div>Resolution : <b> <?php echo $review['resolution']; ?> </b></div>
							<div>Comment : <b> <?php echo $review['comment']; ?> </b></div>
					  <?php } ?>
                    </div>
                  </div>
                  <?php } ?>
                  <?php } else { ?>
                  <div class="main_livepost">
                    <div class="post_maincontent">
                      <div class="form-message warning">
                        <p>No Ratings.</p>
                      </div>
                    </div>
                  </div>
                  <?php 
				} ?>
                </div></td>
            </tr>
          </table>
        </div>
        <?php	}
        
        
          else { ?>
        
        <!-- box -->
        <div class="login_box">
       
          <?php if( $this->session->userdata('youg_user') ){ ?>
          <table align="left" border="0" style="margin-top:22px;">
          <tr><td valign="top"><div class="task-photo"> <img width="60px" src="<?php if( strlen($user[0]['avatarbig']) > 1 ){ echo $this->common->get_setting_value('2').$this->config->item('user_thumb_upload_path');?><?php echo stripslashes($user[0]['avatarbig']); } else { if($user[0]['gender']=='Male') { echo $this->common->get_setting_value('2')."images/male.png"; } 
		  	if($user[0]['gender']=='Female') { echo $this->common->get_setting_value('2')."images/female.png"; } 
		  } 
		   ?>" alt="<?php echo stripslashes($user[0]['firstname']); ?>"/> </div>
              </td>
            </tr>
            <tr>
              <td><div class="login_box_title" style="font-size:16px;"><?php echo $user[0]['username']; ?></div>
                <div class="user_view"><a href="<?php echo site_url('user/edit'); ?>" title="edit personal details">Edit Personal Details</a></div>
                <div class="user_view"><a href="<?php echo site_url('user/changepassword'); ?>" title="change password">Change Password</a></div>
                <?php $totalcomplaints=$this->users->get_all_complaintsby_userid($user[0]['id']);?>
                <?php $totalcomments=$this->users->get_all_commentsby_userid($user[0]['id']);?>
                <?php $totaldisputes=$this->users->get_all_disputesby_userid($user[0]['id']);?>
                <?php $totalrating = $this->users->get_all_rating($user[0]['id']);?>
                <div class="user_view"><a href="<?php echo site_url('user/complaints'); ?>" title="Complaints">Complaints ( <?php echo count($totalcomplaints);?> )</a></div>
                <div class="user_view"><a href="<?php echo site_url('user/comments'); ?>" title="Comments">Comments ( <?php echo count($totalcomments);?> )</a></div>
                <div class="user_view"><a href="<?php echo site_url('user/disputes'); ?>" title="Disputes"><span class="colorcode">Disputes ( <?php echo count($totaldisputes);?> )</span></a></div>
                <div class="user_view"><a href="<?php echo site_url('user/myratings'); ?>" title="My Ratings"><span class="colorcode">My Ratings ( <?php echo count($totalrating);?> )</span></a></div>
              </td>
            </tr>
          </table>
          <?php }  ?>
          <table border="0" align="right" class="tablecompliant">
            <tr>
              <td><div class="right_content_panel">
                  <div class="treding_title" >Complaints</div>
                  <?php if(count($complaints)>0){ ?>
                  <?php //echo '<pre>'; print_r($complaints); die();?>
                  <?php for($i=0; $i<count($complaints); $i++) { ?>
                  <?php $company=$this->users->get_company_byid($complaints[$i]['companyid']) ;?>
                  <div class="main_livepost">
                    <div class="post_maincontent">
                      <div class="search_content_title"><a href="<?php echo site_url('complaint/browse/'.$complaints[$i]['comseokeyword']); ?>" title="view complaint detail">
                        <?php if(count($company)>0) {
									echo stripslashes($company[0]['company'])." Complaint for $".$complaints[$i]['damagesinamt'];?>
                        </a>
                        <?php } ?>
                      </div>
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
                      <div class="post_content_dscr user_view"> <a href="<?php echo site_url('complaint/browse/'.$complaints[$i]['comseokeyword']); ?>" title="view complaint detail"> <?php echo substr(stripslashes($complaints[$i]['detail']),0,212)."..."; ?></a> </div>
                    </div>
                  </div>
                  <?php } ?>
                  <?php } else {?>
                  <div class="main_livepost">
                    <div class="post_maincontent">
                      <div class="form-message warning">
                        <p>No Complaints.</p>
                      </div>
                    </div>
                  </div>
                  <?php } ?>
                </div></td>
            </tr>
          </table>
          <table border="0" align="left" class="tablecomment">
            <tr>
              <td><div class="right_content_panel">
                  <div class="treding_title" >Comments</div>
                  <?php if(count($comments)>0){ ?>
                  <?php //echo '<pre>'; print_r($complaints); die();?>
                  <?php for($i=0; $i<count($comments); $i++) { ?>
                  <div class="main_livepost">
                    <div class="post_maincontent">
                      <?php 
                        $date = date_default_timezone_set('Asia/Kolkata');                             
					//		$dbdate = date('Y-m-d',strtotime($complaints[$i]['whendate']));
                            $commentdate = date('m/d/Y',strtotime($comments[$i]['commentdate']));
                            $today = date('m/d/Y');
							$d1 = strtotime(date('Y-m-d H:i:s'));
							$d2 = strtotime($comments[$i]['commentdate']);
							$newdate =round(($d1-$d2)/60);  
							if($newdate > 60){$diff = round(($d1-$d2)/60/60).' hours ago';}else{$diff = $newdate.' minutes ago';}
							?>
                      <div class="search_content_date user_view" style="margin-bottom:15px;"> <?php echo ($commentdate==$today)?$diff:date('d M,Y',strtotime($comments[$i]['commentdate'])); ?>&nbsp;&nbsp;<a href="<?php echo site_url('review/deletecomment/'.$comments[$i]['id']);?>" style="float:right;text-decoration:underline;" onclick="return confirm('Are you sure to delete this comment?');" title="delete comment">delete</a> <span style="float:right">&nbsp;or&nbsp;</span> <a href="<?php echo site_url('review/editcomment/'.$comments[$i]['id']);?>" style="float:right;text-decoration:underline;" title="edit comment">edit</a> </div>
                      <div class="post_content_dscr user_view"> <?php echo nl2br(stripslashes($comments[$i]['comment'])); ?> </div>
                    </div>
                  </div>
                  <?php } ?>
                  <?php } else { ?>
                  <div class="main_livepost">
                    <div class="post_maincontent">
                      <div class="form-message warning">
                        <p>No Comments.</p>
                      </div>
                    </div>
                  </div>
                  <?php 
				} ?>
                </div></td>
            </tr>
          </table>
        </div>
        <!-- /box -->
        
        <?php } ?>
      </div>
    </div>
    <div class="shadow"></div>
    <!-- /#content --> 
  </section>
</section>
<?php echo $footer; ?>
