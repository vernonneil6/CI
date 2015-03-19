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

							 

							
							  if( ($("#username").val()) == "" )
							  {
								  $("#usernameerror").show();
								  
								  $("#username").val('').focus();
								  return false;
							  }
							  else
							  {
								  $("#usernameerror").hide();
								 
							  }

							  if( ($("#mailaddress").val()) == "" )
							  {
								  $("#mailaddresserror").show();
								  
								  $("#mailaddress").val('').focus();
								  return false;
							  }
							  else
							  {
								  $("#mailaddresserror").hide();
								 
							  }

							   if( ($("#caseid").val()) == "" )
							  {
								  $("#caseiderror").show();
								  
								  $("#caseid").val('').focus();
								  return false;
							  }
							  else
							  {
								  $("#caseiderror").hide();
								 
							  }



							 if( ($("#transid").val()) == "" )
							  {
								  $("#transiderror").show();
								  
								  $("#transid").val('').focus();
								  return false;
							  }
							  else
							  {
								  $("#transiderror").hide();
								 
							  }
							  if( ($("#transamt").val()) == "" )
							  {
								  $("#transamterror").show();
								  
								  $("#transamt").val('').focus();
								  return false;
							  }
							  else
							  {
								  $("#transamterror").hide();
								 
							  }

							if( ($("#transdate").val()) == "" )
							  {
								  $("#transdateerror").show();
								  
								  $("#transdate").val('').focus();
								  return false;
							  }
							  else
							  {
								  $("#transdateerror").hide();
								 
							  }


							
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
<div class="container">
  <div>
	  <?php $company_id=$this->uri->segment(3);?>
    <form class="reg_frm" action="welcome/updates/<?php echo $company_id;?>" id="frmcompany" method="post" enctype="multipart/form-data">
	<div class="align_center">
		<small>This business is not a Verified Member and their transactions are not eligible for the Yougotrated Buyer's Protection Program.</small>
	</div>
	

	 <div class="reg-row">
		 <div>
			<span class="form-col-1">
				<span class="form-circle">1</span>
			</span>
			<span class="form_left">
					<label>YOUR INFORMATION</label>
					<div class="reg_fld"></div>
					 <input type="text" class="reg_txt_box-lg" placeholder="Full Name" id="username" name="username"  maxlength="15">
					<div id="usernameerror" class="error">Enter Username.</div>
						<input type="text" class="reg_txt_box-lg" placeholder="E-mail Address" id="mailaddress" name="mailaddress">
					<div id="mailaddresserror" class="error">Enter Email.</div>
						<input type="text" class="reg_txt_box-lg" placeholder="YouGotRated Case ID" id="caseid" name="caseid" maxlength="30">
					<div id="caseiderror" class="error">Enter Caseid.</div>
				 </div>
			</span>
		</div>  
	</div>  
	<div class="reg-row">
		<div>
			<span class="form-col-1">
				<span class="form-circle">2</span>
			</span>
			<span class="form_left">
				<label>TRANSACTION DETAILS</label>
				
				<div class="reg_fld"></div>
				<div class = "id_prov_business">This is the ID provided by the business, that helps us ensure you have actually purchased from this business.</div>
				 <input type="text" class="reg_txt_box-lg" placeholder="Merchant Transaction ID" id="transid" value = "<?php if($cmpyid!=null){ echo $cmpyid; } else { echo '';} ?>" name="transid"  maxlength="15" readonly>
				<div id="transiderror" class="error">Enter Transaction id.</div>
					<input type="text" class="reg_txt_box-lg" placeholder="Transaction Amount" id="transamt" name="transamt">
				<div id="transamterror" class="error">Enter Transaction Amount.</div>
					<input type="text" class="reg_txt_box-lg" placeholder="Transaction Date" id="transdate" name="transdate" maxlength="30" >
				<div id="transdateerror" class="error">Enter Transaction Date.</div>
			</span>
		</div>  
	</div>  



	<div class="reg-row">
		<div>
			<span class="form-col-1">
				<span class="form-circle">3</span>
			</span>
			<span class="form_left">
				<label>COMPLAINT DETAILS</label>
				<?php if(empty($cmpyid)){ ?>
					<div class="reg_fld">Company Name</div>
					<div>		
						<div class="input_container">
						<input type="text" id="company_name" class="reg_txt_box-lg" name="company_name"  onkeyup="autocomplet()">
						<input type="hidden" id="company_id" class="reg_txt_box-lg" name="company_id">
									<ul id="country_list_id"></ul>
						</div>		
					</div>
				<?php } ?>

				<div class="reg_fld">DATE OF COMPLAINT</div>
				<div>
					<input type="text" class="reg_txt_box-lg" name="complaintdate" id="datecompany" readonly="readonly">
				</div>

				<div class="reg_fld">REASON FOR COMPLAINT</div>
				<div>
				<select class="reg_txt_box fix_height" name="reasondispute" id="reasondispute">
					  <option value="Item Not Received">Item Not Received</option>
					  <option value="Item Not as Described (Merchant Pays for Shipping)">Item Not as Described (Merchant Pays for Shipping)</option>
					  <option value="Item Received Damaged (Merchant Pays for Shipping)">Item Received Damaged (Merchant Pays for Shipping)</option>
				  <option value="Items Missing from the Order">Items Missing from the Order</option>
				  <option value="Not Satisfied with Purchase, would like a Refund (Buyer Pays for Shipping)">Not Satisfied with Purchase, would like a Refund (Buyer Pays for Shipping)</option>
				  <option value="Seller Not Willing to Honor the Return Policy">Seller Not Willing to Honor the Return Policy</option>
				  <option value="other">Other</option>
					</select>
				</div>
				
					<div class="reg_fld">WHAT RESOLUTION DO YOU EXPECT FROM MERCHANT</div>
				<div>
				<select class="reg_txt_box fix_height" name="merchantresolution" id="merchantresolution">
					  <option value="Ship the Item and/or Provide Proof of Shipping">Ship the Item and/or Provide Proof of Shipping</option>
					  <option value="Would like a Full Refund">Would like a Full Refund</option>
					  <option value="Would like a Replacement item">Would like a Replacement item</option>
				  <option value="Would like the missing items to be shipped immediately">Would like the missing items to be shipped immediately</option>
				  <option value="Would like a Partial Refund for the missing items">Would like a Partial Refund for the missing items</option>
				  <option value="other">Other</option>
					</select>
				</div>

					<div class="reg_fld">PLEASE PROVIDE A DETAILED DESCRIPTION OF YOUR COMPLAINT.</div>

				  <textarea style="height:160px;" class="txt_box_complaint" placeholder="Details" id="detail" name="detail" maxlength="400"></textarea>

				  <div id="dateerror" class="error">Date is required. </div>
				<div id="detailerror" class="error"> Minimum 20 characters required.</div>
				

				<div class="reg_fld">File or Photo Upload(s)</div>
				<div>
					<input type="file" name="multipleupload[]">
					<input type="file" name="multipleupload[]">
					<input type="file" name="multipleupload[]">
					<input type="file" name="multipleupload[]">
				</div>


				</div>
			</span>
		</div>  
	</div>  
      <div class="reg-row">
		<div>
			<span class="form-col-1">
				<span class="form-circle">4</span>
			</span>
			<span class="form_left">
				<label>TERMS AND CONDITIONS</label>
				<div class="reg_fld">PLEASE COMPLETE THESE FINAL STEPS TO SUBMIT YOUR COMPLAINT.</div>
				<div dir="seltdterms" class="term_tag chechbox_custom noborder nopadding">
				  <input type="checkbox" style="display:block;" name="readterms" value="Yes" id="am_2" class="">
				  <label for="am_2">I HAVE READ AND AGREE TO THE YOUGOTRATED <a target="_blank" title="TERMS AND CONDITIONS" href="terms">TERMS AND CONDITIONS</a>.</label>
				</div>
				<div dir="seltdterms" class="term_tag chechbox_custom ckbox_hgt noborder nopadding">
				  <input type="checkbox" style="display:block;" name="terms" value="Yes" id="am_1" class="">
				  <label for="am_1">I understand that by posting this complaint that my name and email address will be shared with the merchant.</label>
				</div>
				<div class="reg_fld">PLEASE VERIFY THAT ALL INFORMATION ENTERED ABOVE IS CORRECT.</div>
			  </div>   			  
			</span>
		</div>  
	</div>  
	
	<div>
		 <div>
			<span class="form-col-1">
				&nbsp;
			</span>
			<span class="form_left">	
				<button name="btncompany" id="btncompany" title="Submit" style="margin-top:32px;" class="lgn_btn" type="submit">SUBMIT</button>
			</span>
		 </div>
	</div>

    </form>
    <div class="lgn_btnlogo" > <a href="#"><img src="images/ygr_logos.png" class="logo_btm" alt="Yougotrated" title="Yougotrated"></a> </div>
  </div>
</div>
</section>
</section>
<script>
// autocomplet : this function will be executed every time we change the text
var currentRequest = null;
function autocomplet() {
	$('#country_list_id').html('Loading ...');
	var min_length = 0; // min caracters to display the autocomplete
	var keyword = $('#company_name').val();
	if (keyword.length >= min_length) {
	currentRequest = $.ajax({
			url: '/complaint/get_company_names/',
			type: 'POST',
			beforeSend : function()
				{           
					if(currentRequest != null)
					{
		
						currentRequest.abort();
						
					}
				},
			data: {keyword:keyword},
			success:function(data){
				$('#country_list_id').show();
				$('#country_list_id').html(data);
			}
		});
	} else {
		$('#country_list_id').hide();
	}
}

// set_item : this function will be executed when we select an item
function set_item(item,id) {
	// change input value
	$('#company_name').val(item);
	$('#company_id').val(id);
	// hide proposition list
	$('#country_list_id').hide();
}
</script>
<style>
.input_container ul {
	width: 488px;
	padding-left:10px;	
	border: 1px solid #eaeaea;
	position: absolute;
	z-index: 9;
	background: #f3f3f3;
	list-style: none;
}
.input_container ul li {
	padding: 2px;
}
.input_container ul li:hover {
	background: #eaeaea;
}
</style>
<?php echo $footer;?>
