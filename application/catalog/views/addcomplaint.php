<?php echo $header;?>
 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css">
<script type="text/javascript">
	function searchcompany(company)
	{
		//alert(company);
		if (company.length > 3)
		{
			//alert(company.length);
			if( searchcompany != '' )
			{
			//$("#couponcodeerror").hide();
			//Return from conroller in php code : echo json_encode(array("result"=>"exist"));
			$.ajax({
				type 				: "POST",
				url 				: "<?php echo site_url('welcome/searchcompany'); ?>",
				data				:	{ 'company' : company },
				dataType 			: "json",
				cache				: false,
				beforeSend			: function(){
					$('#imgload').show();
					},
				success				: function(data){
											
												//console.log(data);
												$('#imgload').hide();
												$('#company').autocomplete({ 
				source: data,
				
				select: function (event, ui) {
					if ( ui.item ) {
					 $('#companyid').val(ui.item.value);
					  this.value = ui.item.label;
					  return false;
					}
				}
			});
			$(".ui-autocomplete").css("max-height", "250px");
			$(".ui-autocomplete").css("overflow-y", "auto");
												
											}
			});
		}
			else
			{
			
			return false;
			}
		}
		else
		{
			return false;
		}
	}
</script>
<script>		 
						 $(document).ready(function(){
							$('#datecompany').datepicker({
							//	dateFormat : 'mm/dd/yy', maxDate: new Date

							});
										
							$("#btncompany").click(function () {
							  if(($("#company").val()) == "")
							  {
								  $("#companyerror").show();
								  
								  $("#company").val('').focus();
								  return false;
							  }
							  else
							  {
								   $("#companyerror").hide();
								   
								  
							  }
							  
							  if(($("#damagesinamt").val()) == "")
							  {
								  $("#damageerror").show();
								  
								  $("#damagesinamt").val('').focus();
								  return false;
							  }
							  else
							  {
								  if( isNaN(($("#damagesinamt").val())) )
								  {
									  $("#damageerror").hide();
									  $("#damageverror").show();
									 
									  $("#damagesinamt").val('').focus();
									  return false;
								  }
								  else
								  {
									  $("#damageerror").hide();
									  $("#damageverror").hide();
									  
								  }
							  }
							  
							  if( ($("#datecompany").val()) == "" )
							  {
								  $("#dateerror").show();
								  
								  $("#datecompany").val('').focus();
								  return false;
							  }
							  else
							  {
								  $("#dateerror").hide();
								 
							  }
								
					  	//var namefilter = /^[a-zA-Z0-9. -]+$/;
						
						if( ($("#detail").val()) == "" ||  ($("#detail").val().length) < 20 )
							  {
								  $("#detailerror").show();
								  
								  $("#detail").focus();
								 
								  return false;
							  }
							  else
							  {
								  $("#detailerror").hide();
								  
							  }
							  
							  if( ($("#city").val()) == "" )
							  {
								  $("#cityerror").show();
								  
								  $("#city").val('').focus();
								  return false;
							  }
							  else
							  {
								  $("#cityerror").hide();
								  
							  }
							  
							  if( ($("#state").val()) == "" )
							  {
								  $("#stateerror").show();
								  
								  $("#state").val('').focus();
								  return false;
							  }
							  else
							  {
								  $("#stateerror").hide();
								  
							  }
							  
							  if(($("#zip").val()) == "")
							  {
								  $("#ziperror").show();
								  
								  $("#zip").val('').focus();
								  return false;
							  }
							  else
							  {
								  if( isNaN(($("#zip").val())) )
								  {
									  $("#ziperror").show();
									 
									  $("#zip").val('').focus();
									  return false;
								  }
								  else
								  {
									  $("#ziperror").hide();
									  
								  }
							  }
							  
							  if(($("#phone").val()) == "")
							  {
								  $("#phoneerror").show();
								  
								  $("#phone").val('').focus();
								  return false;
							  }
							  else
							  {
								  if( isNaN(($("#phone").val())) )
								  {
									  $("#phoneerror").show();
									 
									  $("#phone").val('').focus();
									  return false;
								  }
								  else
								  {
									  $("#phoneerror").hide();
									  
								  }
							  }
							//  alert("");
							   var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
					  		   if( ($("#email").val()) == "" )
					  		   {	
									  $("#emailverror").hide();
									  $("#emailerror").show();
									  $("#email").val('').focus();
									 
									  return false;
					  			}
							  else
							  	{
									if( !filter.test(($("#email").val())) )
						  			{
							  			$("#emailerror").hide();
									    $("#emailverror").show();
										$("#email").val('').focus();
										
										return false;
						  			}
						  			else
						  			{
							  			$("#emailerror").hide();
										$("#emailverror").hide();
										
						  			}
					  		    }
								
								if( ($("#siteurl").val()) == "" )
							  	{
									  $("#siteurlerror").show();
									  
									  $("#siteurl").val('').focus();
									  return false;
							  	}
							  	else
							  	{
									  $("#siteurlerror").hide();
								 	  
							  	}
								
							    if(!$("#am_2").is(":checked") )
		                      	{
        			                 alert("Please read Terms and Conditions")
			                         return false;
            		          	}
								else
								{
								}
								
								if(!$("#am_1").is(":checked") )
		                      	{
        			                 
									 alert("Please Agree with Terms and Conditions")
									 return false;
            		          	}
								else{}
		            	        
									$("#frmcompany").submit();
									return false;
						  
						  });
						 });
						
						</script>
<section class="container">
  <section class="main_contentarea">
    <div class="regr_lnk">
      <div class="innr_wrap">
        <div class="new_usr"><a title="New Complaint">NEW Complaint</a> </div>
      </div>
    </div>
    <div class="container">
      <div class="reg_frm_wrap">
        <form class="reg_frm" action="welcome/update" id="frmcompany" method="post" entype="multipart/form-data">
          <div class="reg-row" style="margin-top:-10px !important">
            <div class="reg_fld">Company Name</div>
            <input type="text" class="reg_txt_box-lg" placeholder="enter minimum 4 characters to search company" id="company" name="company" maxlength="30" onkeyup="searchcompany(this.value)">
            <input type="hidden" id="companyid" name="companyid" />
            <div id="companyerror" class="error">Please Select Company Name.</div>
          </div>
         <div class="reg-row" style="margin-top:-10px !important">
            <div class="reg_fld">SELECT COMPLAINT TYPE</div>
              <div class="gdr_female">
              <select name="type" id="type" style="margin:6px 2px 2px -50px !important;">
              <option value="Company">Company</option>
              <option value="Person">Person</option>
              <option value="Phone">Phone</option>
              </select>
              </div>
           
          </div>
          
          <div class="reg-row" style="margin-top:-10px !important">
            <div class="reg-row">
            <label>Complaint Details</label>
            </div>
            <div class="reg_fld">Monetary Damages?</div>
            <input type="text" class="reg_txt_box" placeholder="Total lost in USD" id="damagesinamt" name="damagesinamt"  maxlength="15">
            
            <input type="text" class="reg_txt_box" placeholder="When did this happen?" id="datecompany" name="whendate" readonly="readonly">
            <div id="damageerror" class="error">Monetary Damage is required.</div>
            <div id="damageverror" class="error">Enter Only Digits.</div>
            <div id="dateerror" class="error">Date is required. </div></div>
          <div class="reg-row" style="margin-top:-10px !important">
            <div class="reg_fld">Location</div>
            <input type="text" class="reg_txt_box" placeholder="Location info" id="location" name="location" maxlength="30">
            <div id="fnameerror" class="error">First Name is required.</div>
          </div>
          <div class="reg-row" style="margin-top:-10px !important">
            <div class="reg_fld">Details</div>
            <textarea class="txt_box" placeholder="Details" id="detail" name="detail" maxlength="400" style="height:160px;"></textarea>
            <div id="detailerror" class="error"> Minimum 20 characters required.</div>
          </div>
          <div class="reg-row">
            <label>Company Info</label>
            <div class="reg_fld">WHAT IS YOUR ADDRESS?</div>
            <input type="email" class="reg_txt_box-lg" placeholder="Company Email Address" name="email" id="email"  maxlength="100">
            <input type="text" class="reg_txt_box-lg" placeholder=" Company Website URL" name="siteurl" maxlength="100" id="siteurl">
            <input type="text" class="reg_txt_box-md" placeholder="City/Province" id="city" name="city" maxlength="50" />
            <input type="text" class="reg_txt_box-xsml" placeholder="State" id="state" name="state" maxlength="50" />
            <input type="text" class="reg_txt_box-xsml" placeholder="Zip Code" id="zip" name="zip" maxlength="10" />
            <div style="margin-top:36px;" class="reg_fld">WHAT IS YOUR PHONE NUMBER?</div>
            <div>
              <input type="text" class="reg_txt_box-md" placeholder="Company Phone Number" name="phone" id="phone"  maxlength="12">
            </div>
            <div id="streeterror" class="error">Street Address is required.</div>
            <div id="cityerror" class="error">City/Province is required.</div>
            <div id="stateerror" class="error">State is required.</div>
            <div id="streeterror" class="error">Street Address is required.</div>
            <div id="ziperror" class="error">Enter digits only.</div>
          </div>
          <div id="phonenoerror" class="error">Enter Phone number.</div>
          <div class="reg-row">
            <label>TERMS AND CONDITIONS</label>
            <div class="reg_fld">PLEASE COMPLETE THESE FINAL STEPS TO SUBMIT YOUR COMPLAINT.</div>
            <div class="term_tag" dir="seltdterms">
              <input type="checkbox" class="" id="am_2" value="Yes" name="readterms" style="display:inline;"/>
              <label for="am_2">I HAVE READ AND AGREE TO THE YOUGOTRATED <a href="<?php echo site_url('terms');?>" title="TERMS AND CONDITIONS" target="_blank">TERMS AND CONDITIONS</a>.</label>
            </div>
            <div class="term_tag" dir="seltdterms">
              <input type="checkbox" class="" id="am_1" value="Yes" name="terms" style="display:inline;"/>
              <label for="am_1">I AGREE TO THE YOUGOTRATED TERMS AND CONDITIONS.</label>
            </div>
            <div id="termserror" class="error">Please Agree to TERMS AND CONDITIONS</div>
          </div>
          <div class="reg-row" style="margin-top:15px;">
            <div class="reg_fld">PLEASE VERIFY THAT ALL INFORMATION ENTERED ABOVE IS CORRECT.</div>
            <button type="submit" class="lgn_btn" style="margin-top:32px;" title="Submit" id="btncompany" name="btncompany">SUBMIT</button>
          </div>
        </form>
        <div class="lgn_btnlogo" > <a href="<?php echo base_url();?>" title="<?php echo $site_name;?>" ><img src="images/YouGotRated_Essential_YGR-Logo-Small.png" alt="Yougotrated" title="Yougotrated"></a> </div>
      </div>
    </div>
  </section>
</section>

<style>
.gdr_female select {
    background: none repeat scroll 0 0 #FFFFFF;
    border: 1px solid #DDDDDD;
    margin: 0 !important;
    padding: 5px;
    width: 150px;
}
.term_tag input[type="checkbox"]:checked + label {
	background:none !important;
	
	}
	.term_tag input[type="checkbox"] + label {background:none !important;
	 margin-top: -17px;
	}
</style>
<?php echo $footer;?>
