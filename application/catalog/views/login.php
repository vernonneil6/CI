<?php echo $header;?>
<link rel="stylesheet" href = "<?php echo base_url().'css/font-awesome.css';?>">
<style>
	@font-face {
	  font-family: 'FontAwesome';
	  src: url('<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME']; ?>/font/Font-Awesome/fontawesome-webfont.eot');
	  src: url('<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME']; ?>/font/Font-Awesome/fontawesome-webfont.eot?#iefix') format('embedded-opentype'),
		   url('<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME']; ?>/font/Font-Awesome/fontawesome-webfont.woff') format('woff'),
		   url('<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME']; ?>/font/Font-Awesome/fontawesome-webfont.ttf') format('truetype');
	  font-weight: normal;
	  font-style: normal;
	}
	.error
	{
		margin: 0 0 5px;
	}
</style> 

 <?php if($this->uri->segment(1) == 'login' || $this->uri->segment(2) == 'forgot' || $this->uri->segment(2) == 'forgotusername'){?>
        
        <script type="text/javascript" language="javascript">
                function trim(stringToTrim) {
                    return stringToTrim.replace(/^\s+|\s+$/g,"");
                }
                $(document).ready(function() {
					
				$('#emailshow').click(function(e){
					e.preventDefault();
					$('.emailpage').slideToggle("slow");
				
				});
                            
                <?php if( $this->uri->segment(1) == 'login' && $this->uri->segment(2) == '') { ?>
			
				    $("#btnsubmit").click(function () {
                        
                        var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                        if( trim($("#email").val()) == "" )
                        {
							$("#emailerror").hide();
                            $("#emailrqerror").css('display','table');
                            $("#email").val('').focus();
                            return false;
                        }
                        else
                        {
							$("#emailrqerror").hide();
                            if( !filter.test(trim($("#email").val())) )
                            {
                                $("#emailerror").css('display','table');
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
                            $("#passerror").css('display','table');
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
                            $("#emailrqerror").css('display','table');
                            $("#email").val('').focus();
                            return false;
                        }
                        else
                        {
							$("#emailrqerror").hide();
                            if( !filter.test(trim($("#email").val())) )
                            {
                                $("#emailerror").css('display','table');
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
<section class="container">
  <section class="main_contentarea">
<div class = "account">
	
	<h3>Login to YouGotRated</h3>
	<div class = "account_option">	
		<div class="option facebookcolor" onclick="FBLogin();"><i class="fa fa-facebook facebookboder"></i><span>Login with Facebook</span></div>
		<a href="<?php echo site_url('go/register');?>" id="emailshow" class="option emailcolor"><i class="fa fa-envelope-o emailboder"></i><span>Login with Email</span></a>
	</div>
	
	<div class = "account_option">     
		<div class="account_login">
			<form class="emailpage" id="frmlogin" method="post" action="login" style="display:none;">     
				<div class="account_container">
					
					<input type="text" class="textboxs" placeholder="ENTER YOUR EMAIL" name="email" id="email" required maxlength="250">
					<span class="error" id="emailrqerror">E-mail is required</span>
					<span class="error" id="emailerror">E-mail must be in correct format</span>
					
					<input type="password" class="textboxs" placeholder="ENTER YOUR PASSWORD" name="password" id="password" required maxlength="50">
					<span class="error" id="passerror">Password is required</span>
					
					<a href="<?php echo site_url('login/forgot');?>" class = "login_link" id="forgotpass" title="Click Here">Forgot your password?</a>
					<input type="button" class="login_buttons" title="Login" id="btnsubmit" name="btnsubmit" value="Log in" /> 
							
				</div>
			</form>
		</div>
	</div>
</div>
</section>
</section>
<?php } else if($this->uri->segment(2) && $this->uri->segment(2) == 'forgot' ||  $this->uri->segment(2)=='forgotusername'){?>
<div class = "account">
	<h3>Forgot Password</h3>

	<div class="account_forgotpassword">
	 <form class="form_wrap" id="frmforgot" method="post" action="login/update">
		<div class="account_container">
			<input type="text" class="textboxs" placeholder="ENTER YOUR EMAIL" name="email" id="email" required maxlength="250">
			<span class="error" id="emailrqerror">E-mail is required</span>
			<span class="error" id="emailerror">E-mail must be in correct format</span>
			<input type="hidden" name="forgottype" value="<?php echo $type;?>"/>
			<button type="submit" class="login_buttons" title="Submit" id="btnforgot" name="btnforgot">Send password</button>       
			<a href="<?php echo site_url('login');?>" class = "login_link account_text_center"  title="Back to Login">Go to login</a>
	   </div>
	  </form>
	</div>
</div>
<?php }?>
	<div class="lgn_btnlogo"> <a><img src="images/ygr_logos.png" class="logo_btm" alt="Yougotrated-Mini-Logo" title="Yougotrated"></a> </div>
    </div>
  </section>
</section>
<?php echo $footer;?>
