<?php echo $header;?>
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
         
    
    <section class="container">
      <section class="main_contentarea">
      		
          <div class="regr_lnk">
          	<div class="innr_wrap">
	            <div class="new_usr">
            	CHANGE PASSWORD
                            </div>
            	
            </div>
          </div>
          <div class="container">
          		<div class="reg_step_edit"></div>
              <div class="reg_frm_wrap">
              
                   <form class="reg_frm" action="user/update" id="frmuser" method="post" enctype="multipart/form-data">
                  	<div class="reg-row">
                    	<label>YOUR CURRENT PASSWORD</label>
                      
                      <input type="password" class="reg_txt_box" placeholder="CURRENT PASSWORD" id="oldpassword" name="oldpassword" maxlength="25" />
<div id="oldpasserror" class="error">Old Password is required.</div>
 
                    </div>
                    <div class="reg-row">
                    	<label>YOUR NEW PASSWORD</label>
                      
                      <input type="password" class="reg_txt_box" placeholder="NEW PASSWORD" id="newpassword" name="newpassword" maxlength="25"  />
<div id="newpasserror" class="error">New Password is required.</div>
 
                    </div>
                    <div class="reg-row">
                    	<label>CONFIRM NEW PASSWORD</label>
                      
                      <input type="password" class="reg_txt_box" placeholder="CONFIRM PASSWORD" id="repassword" name="repassword" maxlength="25" />
<div id="repasserror" class="error">New Password and Re-Password dont match.</div>
 
                    </div>
                    
                    
                    
                    
                    
                    <div class="reg-row" style="margin-top:27px;">
                    	
                      
                       <button type="submit" class="lgn_btn" style="margin-top:32px;" title="UPDATE ACCOUNT" id="btnpassupdate" name="btnpassupdate">UPDATE PASSWORD</button>
                    </div>
                    <input type="hidden" name="userpassid" value="<?php echo $this->encrypt->encode($user[0]['id']);?>" />
                  </form>
                   <?php
				   ?>
                   <div class="lgn_btnlogo" >
		                <a href="<?php echo base_url();?>" title="<?php echo $site_name;?>" ><img src="images/YouGotRated_Essential_YGR-Logo-Small.png" alt="<?php echo $site_name;?>" title="Yougotrated"></a>
    	            </div>
              </div>
          </div>
      </section>
    </section>
<?php echo $footer;?>