<?php echo $header; ?>

<section class="container">
  <section class="inner_main">
    <div class="main_contentarea"><?php echo $menu; ?>
      <div class="login_box_div">
        <?php if($this->uri->segment(1) == 'login' || $this->uri->segment(2) == 'forgot'){?>
        
        <script type="text/javascript" language="javascript">
                function trim(stringToTrim) {
                    return stringToTrim.replace(/^\s+|\s+$/g,"");
                }
                $(document).ready(function() {
                            
                <?php if( $this->uri->segment(1) == 'login' && $this->uri->segment(2) == '') { ?>
			
				$("#frmlogin .close-red").click(function () {
						$("#frmlogin #message-red").fadeOut("slow");
				});
	
                    $("#btnsubmit").click(function () {
                        
                        var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                        if( trim($("#email").val()) == "" )
                        {
							$("#emailerror").hide();
                            $("#emailrqerror").show();
                            $("#email").val('').focus();
                            return false;
                        }
                        else
                        {
							$("#emailrqerror").hide();
                            if( !filter.test(trim($("#email").val())) )
                            {
                                $("#emailerror").show();
                                $("#email").val('').focus();
                                return false;
                            }
                            else
                            {
                                $("#emailerror").hide();
                            }
                        }
                        
                        if( trim($("#password").val()) == "" )
                        {
                            $("#passerror").show();
                            $("#password").val('').focus();
                            return false;
                        }
                        else
                        {
                            $("#passerror").hide();
                        }
                            
                        $("#frmlogin").submit();
                        
                });
                <?php } ?>
                <?php if( $this->uri->segment(2) == 'forgot' ) { ?>
                    $("#btnforgot").click(function () {
                        var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                        if( trim($("#email").val()) == "" )
                        {
							$("#emailerror").hide();
                            $("#emailrqerror").show();
                            $("#email").val('').focus();
                            return false;
                        }
                        else
                        {
							$("#emailrqerror").hide();
                            if( !filter.test(trim($("#email").val())) )
                            {
                                $("#emailerror").show();
                                $("#email").val('').focus();
                                return false;
                            }
                            else
                            {
                                $("#emailerror").hide();
                            }
                        }
                
                        $("#frmforgot").submit();
                    
                    });
                    <?php } ?>
                
                });
            </script>
        <?php } ?>
        <?php if( (!$this->uri->segment(2) && $this->uri->segment(2) == '')  || ($this->uri->segment(2) && $this->uri->segment(2) == 'index' ) ) { ?>
        
        <!-- box -->
        <div class="login_box">
        
          <div class="login_box_title"><h1 style="font-size:24px !important;"><?php echo 'Login'; ?></h1></div>
          <table class="data_table" cellspacing="0" cellpadding="0" border="0" width="70%">
            <tbody>
              <!-- Correct form message -->
              <?php if( $this->session->flashdata('success') ) { ?>
            <div id="message-green">
              <tr>
                <td class="green-left"><?php echo $this->session->flashdata('success'); ?></td>
                <td class="green-right"><a class="close-green" title="Close"><img src="<?php echo base_url(); ?>images/messages/icon_close_green.gif" alt="Close"/></a></td>
              </tr>
            </div>
            <?php } ?>
            <!-- Error form message --> 
            <!--  start message-red -->
            <?php if( $this->session->flashdata('error') ) { ?>
            <div id="message-red">
              <tr>
                <td class="red-left"><?php echo $this->session->flashdata('error'); ?></td>
                <td class="red-right"><a class="close-green" title="Close"><img src="<?php echo base_url(); ?>images/messages/icon_close_red.gif" alt="Close"/></a></td>
              </tr>
            </div>
            <?php } ?>
              </tbody>
            
          </table>
          
          <?php echo form_open('login',array('class'=>'formBox','id'=>'frmlogin')); ?> 
          <!--  end message-red -->
          <table align="left" width="850">
            <tbody>
              <tr>
                <td class="box_label" width="200px">Email Address</td>
                <td><?php echo form_input( array( 'name'=>'email','id'=>'email','class'=>'box_txtbox','type'=>'text','onchange'=>'chkmail(this.value)','placeholder'=>'Email Address','style'=>'float:none;' ) ); ?></td>
                <td width="320px"><div id="emailrqerror" class="error">Emailid is required.</div>
                  <div id="emailerror" class="error">Enter valid Emailid.</div></td>
              </tr>
              <tr>
                <td class="box_label">Password</td>
                <td><?php echo form_input( array( 'name'=>'password','id'=>'password','class'=>'box_txtbox','type'=>'password','placeholder'=>'Password','style'=>'float:none;'  ) ); ?></td>
                <td><div id="passerror" class="error">Password is required.</div></td>
              </tr>
              <tr>
                <td></td>
                <td><?php echo form_input(array('name'=>'btnsubmit','id'=>'btnsubmit','class'=>'dir-searchbtn','type'=>'submit','value'=>'Login','style'=>'float:none;color:#fff; padding: 3px 16px;font-size:16px;text-shadow:none;')); ?>
                <div style="margin:-31px 0px 0px 81px;">
                &nbsp;<a onclick="FBLogin();" title="Signin with Facebook"><img src="<?php echo site_url(); ?>images/fb_signin_btn.png" alt="Signin with Facebook" title="Signin with Facebook" width="127" height="29" ></a></div></td>
              </tr>
              <tr>
                <td></td>
                <td style="padding-top:15px" class="user_view"><a title="Forgot your Password" href="<?php echo site_url('login/forgot');?>">Forgot Your Password?</a></td>
              </tr>
              <tr>
                <td></td>
                <td class="user_view"><a title="Create an account" href="<?php echo site_url('go/register');?>">Don't Have An Account? Sign Up Now</a></td>
              </tr>
              <?php if($this->session->flashdata('last_url')){ 
					$url = $this->session->flashdata('last_url');
					echo form_hidden( array( 'last_url' => $this->encrypt->encode($url) ) ); }?>
            </tbody>
          </table>
          <?php echo form_close(); ?> </div>
        <?php } else if($this->uri->segment(2) && $this->uri->segment(2) == 'forgot'){?>
        <!-- /box-content -->
        <div class="login_box">
          <div class="login_box_title"><h1 style="font-size:24px !important;"><?php echo 'Forgot Password'; ?></h1></div>
          <?php echo form_open('login/update',array('class'=>'formBox','id'=>'frmforgot')); ?> 
          <!-- Correct form message -->
          <?php if( $this->session->flashdata('forgotsuccess') ) { ?>
          <div id="message-green">
            <table border="0" width="100%" cellpadding="0" cellspacing="0">
              <tr>
                <td class="green-left"><?php echo $this->session->flashdata('forgotsuccess'); ?></td>
                <td class="green-right"><a class="close-green" title="Close"><img src="<?php echo base_url(); ?>images/messages/icon_close_green.gif" alt="Close"/></a></td>
              </tr>
            </table>
          </div>
          <?php } ?>
          <!-- Error form message --> 
          <!--  start message-red -->
          <?php if( $this->session->flashdata('forgoterror') ) { ?>
          <div id="message-red">
            <table border="0" width="100%" cellpadding="0" cellspacing="0">
              <tr>
                <td class="red-left"><?php echo $this->session->flashdata('forgoterror'); ?></td>
                <td class="red-right"><a class="close-green" title="Close"><img src="<?php echo base_url(); ?>images/messages/icon_close_red.gif" alt="Close"/></a></td>
              </tr>
            </table>
          </div>
          <?php } ?>
          <table class="data_table" align="center" width="850">
            <tbody>
              <tr>
                <td class="box_label" width="200px">Email Address:</td>
                <td><?php echo form_input( array( 'name'=>'email','id'=>'email','class'=>'box_txtbox','type'=>'text','onchange'=>'chkmail(this.value)','style'=>'float:none;' ) ); ?></td>
                <td width="320"><div id="emailrqerror" class="error">Emailid is required.</div>
                  <div id="emailerror" class="error">Enter valid Emailid.</div></td>
              </tr>
              <tr>
                <td></td>
                <td><?php echo form_input(array('name'=>'btnforgot','id'=>'btnforgot','class'=>'dir-searchbtn','type'=>'submit','value'=>'Submit','style'=>'float:none;color:#fff; padding: 3px 16px;font-size:16px;text-shadow:none;')); ?></td>
              </tr>
              <tr>
                <td></td>
                <td style="padding-top:15px" class="user_view"><a title="Back to Login" href="<?php echo site_url('login');?>">Back to Login</a></td>
              </tr>
            </tbody>
          </table>
          <?php echo form_close(); ?> </div>
        <?php } ?>
        <!-- /#content --> 
      </div>
    </div>
    <div class="shadow"></div>
    </div>
  </section>
</section>
<?php echo $footer; ?>