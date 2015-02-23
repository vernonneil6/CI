<?php echo $header;?>
 <?php if($this->uri->segment(1) == 'login' || $this->uri->segment(2) == 'forgot' || $this->uri->segment(2) == 'forgotusername'){?>
        
        <script type="text/javascript" language="javascript">
                function trim(stringToTrim) {
                    return stringToTrim.replace(/^\s+|\s+$/g,"");
                }
                $(document).ready(function() {
                            
                <?php if( $this->uri->segment(1) == 'login' && $this->uri->segment(2) == '') { ?>
			
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
<section class="container">
  <section class="main_contentarea">
    <div class="innr_wrap">
      <div class="login_head"><a><img src="images/LoginPage_Header.png" alt="Login" title="<?php echo $site_name;?> Login"></a></div>
     <?php if( (!$this->uri->segment(2) && $this->uri->segment(2) == '')  || ($this->uri->segment(2) && $this->uri->segment(2) == 'index' ) ) { ?>
     
      
      <form class="form_wrap" id="frmlogin" method="post" action="login">
        
        <div class="login_lft">
          <div class="row">
            <h2 class="user_lbl">Email</h2>
            <input type="text" class="txt_box" placeholder="ENTER YOUR EMAIL" name="email" id="email" required maxlength="250">
            <?php /*?><span>FORGOT YOUR USERNAME? <a href="#" title="Click Here">CLICK HERE</a></span><?php */?> </div>
          <div class="row">
            <h2 class="user_lbl">Password</h2>
            <input type="password" class="txt_box" placeholder="ENTER YOUR PASSWORD" name="password" id="password" required maxlength="50">
            <span>FORGOT YOUR PASSWORD? <a href="<?php echo site_url('login/forgot');?>" title="Click Here">CLICK HERE</a></span>
            <span>FORGOT YOUR USERNAME? <a href="<?php echo site_url('login/forgotusername');?>" title="Click Here">CLICK HERE</a></span>
             </div>
          <div class="row">
			<!--  
            <button type="submit" class="lgn_btn" title="Login" id="btnsubmit" name="btnsubmit" style="font-size:24px !important;">Login</button>            
            <button onclick="FBLogin();" title="Signin in with facebook" style="cursor:pointer;font-size:24px !important;" class="lgn_btn">LOGIN WITH FACEBOOK</button>
            -->
            <input type="button" class="lgn_btn" title="Login" id="btnsubmit" name="btnsubmit" style="font-size:24px !important;" value="Login" />
            <input type="button" onclick="FBLogin();" value="LOGIN WITH FACEBOOK" title="Signin in with facebook" style="cursor:pointer;font-size:24px !important;" class="lgn_btn"/>
          </div> 
        </div>
        <div class="lgn_rgt">
          <div class="new_user">
            <h1>NEW USER?</h1>
            <a href="<?php echo site_url('go/register');?>" title="Click Here to Signup">CLICK HERE TO SIGN-UP</a></div>
        </div>
        <div class="lgn_btnlogo"> <a><img src="images/ygr_logos.png" class="logo_btm" alt="Yougotrated" title="Yougotrated"></a> </div>
      </form>
    <?php } 
    else if($this->uri->segment(2) && $this->uri->segment(2) == 'forgot' ||  $this->uri->segment(2)=='forgotusername'){?>
    <form class="form_wrap" id="frmforgot" method="post" action="login/update">
        <div class="login_lft">
          <div class="row">
            <h2 class="user_lbl">Email</h2>
            <input type="text" class="txt_box" placeholder="ENTER YOUR EMAIL" name="email" id="email" required maxlength="250">
            <?php /*?><span>FORGOT YOUR USERNAME? <a href="#" title="Click Here">CLICK HERE</a></span><?php */?> </div>
          
          <div class="row">
            <input type="hidden" name="forgottype" value="<?php echo $type;?>"/>
            <button type="submit" class="lgn_btn" title="Submit" id="btnforgot" name="btnforgot">Submit</button>
          </div>
        </div>
        <div class="lgn_rgt">
          <div class="new_user">
            <h1></h1>
            <a href="<?php echo site_url('login');?>" title="Back to Login">BACK TO LOGIN</a></div>
        </div>
       <div class="lgn_btnlogo"> <a><img src="images/ygr_logos.png" class="logo_btm" alt="Yougotrated" title="Yougotrated"></a> </div>
      </form>
	<?php }?>
    </div>
  </section>
</section>
<?php echo $footer;?>
