<?php echo $header;?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css">
<script type="text/javascript">
	$(document).ready(function(){
	$('#submit').click(function(){
		if( !$('#transactionid').val()){			
			$('#trans-error').show();		
			return false;			
		}else{
			if($('#transactionid').val() != '<?php echo $companyid; ?>'){	
				$('#trans-error').html('Please Enter the correct Transaction ID');
				$('#trans-error').show();
							
				return false;
			}else{		
				$('#trans-error').hide();		
			}
		}	
		if (!$("#terms-conditions").is(":checked")) {
				$('#terms-error').show();
				return false;
			}else{
				$('#terms-error').hide();
				return true;
			}
		});
	});
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
<section class="container">
<section class="main_contentarea">
<div class="container">

<?php 
if( $this->session->userdata('youg_user') ) 
{
?>
 
     <div class="reg_frm_wrap dis_width">
     <div class="reg-row dispute">
		 <div>
			<span class="form-col-1">
				<span class="form-circle">1</span>
			</span>
			<span class="form_left">
				<label class="names">Dispute form</label><br><div class="reg_fld">PLEASE PROVIDE ALL DETAILS OF YOUR DISPUTE HERE.</div><br>
			</span>
		</div>  
	</div>
           
			<?php echo form_open('complaint/dispute_insert'); ?>
			
			<div class="reg-row company">
				 <div>
					<span class="form-col-1">
						<span class="form-circle">2</span>
					</span>
					<span class="form_left">
						<label class="names">companyname</label>
						<div>
							<?php echo form_input(array('name'=>'companyname','type'=>'text','class'=>'reg_txt_box','value'=>$companys))."<br>"; ?>
					
		
							<?php $company_id = $this->uri->segment(3, 0);?>
							
							
							<?php echo form_input(array('name'=>'companyid','type'=>'hidden','class'=>'reg_txt_box','value'=>$company_id)); ?>
							
								
							<?php echo form_input(array('name'=>'companyemail','type'=>'hidden','class'=>'reg_txt_box','value'=>$emails)); ?>
							
							
							<?php $data=$this->session->userdata('youg_user'); ?>	
							 
								
							<?php 
							
							if(!empty($data['userid'])){
								echo form_input(array('name'=>'userid','type'=>'hidden','class'=>'reg_txt_box','value'=>$data['userid'])); 
							}
							
							?>			
						</div>
					</span>
				 </div> 
			</div> 
				 
				 
			<div class="reg-row">
				 <div>
					<span class="form-col-1">
						<span class="form-circle">3</span>
					</span>
					<span class="form_left">
						<label class="names">username</label>	
						<div>
							<?php 
							if(!empty($data['name'])){
								echo form_input(array('name'=>'username','type'=>'text','class'=>'reg_txt_box','value'=>$data['name']))."<br>";  
							
							}			

							if(!empty($data['emailid'])){
								echo form_input(array('name'=>'useremail','type'=>'hidden','class'=>'reg_txt_box','value'=>$data['emailid'])); 
							}
							
							?> 
						</div>		
					</span>
				 </div> 
			</div>	
			<div class="reg-row transaction">
				<div>
					<span class="form-col-1">
						<span class="form-circle">4</span>
					</span>
					<span class="form_left">
						<label class="names">REASON FOR DISPUTE</label>
						<div>
			               <select class="reg_txt_box fix_height" name="reasondispute" id="reasondispute">
							  <option>Select option</option>
							  <option value="Item Not Received">Item Not Received</option>
							  <option value="Item Not as Described">Item Not as Described (Merchant Pays for Shipping)</option>
							  <option value="Item Received Damaged">Item Received Damaged (Merchant Pays for Shipping)</option>
							  <option value="Items Missing from the Order">Items Missing from the Order</option>
							  <option value="Not Satisfied with Purchase would like a Refund">Not Satisfied with Purchase, would like a Refund (Buyer Pays for Shipping)</option>
							  <option value="Seller Not Willing to Honor the Return Policy">Seller Not Willing to Honor the Return Policy</option>
						   </select>
						</div>
					</span>
				 </div> 
			</div>			   
			<div class="reg-row transaction">
				<div>
					<span class="form-col-1">
						<span class="form-circle">5</span>
					</span>
					<span class="form_left">
						<label class="names">WHAT RESOLUTION DO YOU EXPECT FROM MERCHANT</label>
						<div>
							<select class="reg_txt_box fix_height" name="merchantresolution" id="merchantresolution">
								  <option >Select option</option>
								  <option value="Ship the Item and/or Provide Proof of Shipping">Ship the Item and/or Provide Proof of Shipping</option>
								  <option value="Would like a Full Refund">Would like a Full Refund</option>
								  <option value="Would like a Replacement item">Would like a Replacement item</option>
								  <option value="Would like the missing items to be shipped immediately">Would like the missing items to be shipped immediately</option>
								  <option value="Would like a Partial Refund for the missing items">Would like a Partial Refund for the missing items</option>
						   </select>
					   </div>			 
					</span>
				 </div> 
			</div>
			<div class="reg-row transaction">
				<div>
					<span class="form-col-1">
						<span class="form-circle">6</span>
					</span>
					<span class="form_left">
						<label class="names">Transaction Details</label>
						<div>
							<small class="reg_fld">This is the ID provided by the business, that helps us ensure you have actually purchased from this business.</small>							
							<?php echo form_input(array('id'=>'transactionid','name'=>'transactionid','type'=>'text', 'class'=>'reg_txt_box','value'=>'','placeholder'=>'Please enter Transaction ID'))."<br>"; ?>
							<div><label id="trans-error" style='display:none;color:#ff0000;font-family: myriadpro-regular;font-size:14px;text-transform: lowercase;'>Please Enter Your Transcation Id</label></div>
							
							<?php echo form_input(array('name'=>'transactionamt','type'=>'text','class'=>'reg_txt_box','value'=>'','placeholder'=>'Please enter Transaction Amount'))."<br>"; ?>
							<?php echo form_input(array('name'=>'transactiondate','type'=>'text','class'=>'reg_txt_box','value'=>'','placeholder'=>'Please enter Transaction Date'))."<br>"; ?>
							
							
							<?php echo form_input(array('name'=>'status','type'=>'hidden','class'=>'reg_txt_box','value'=>'open')); ?>
							
							<?php $rand=rand(0,999999); ?>
							<?php echo form_input(array('name'=>'msglink','type'=>'hidden','class'=>'reg_txt_box','value'=>$rand)); ?>
							
							<?php $date=date('Y-m-d : H:i:s'); ?>
							<?php echo form_input(array('name'=>'ondate','type'=>'hidden','class'=>'reg_txt_box','value'=>$date)); ?>
						</div>
					</span>
				 </div> 
			</div>
			<div class="review_txt_box inline_block">
				 <div>
					<span class="form-col-1">
						&nbsp;
					</span>
					<span class="form_left">
						<div id="termscondn" class="font_myraid">
							<input type="checkbox" id="terms-conditions" />
							<label>I understand that by posting this complaint, my name and email address will be shared with the merchant.</label>
							<div><label id="terms-error" style='display:none;color:#ff0000;'>Please indicate that you accept the Terms and Conditions</label></div>
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
						<input type="submit" name="mysubmit" value="submit" class="lgn_btn" id="submit">
					</span>
				 </div>
			</div>
			<?php echo form_close(); ?>
<?php
 }
else
{
?>
	  	 <div class="reg-row"><a href="/login"><label style="cursor:pointer;">Log in to Continue</label></a></div>
<?php
}
?>			
    <div class="lgn_btnlogo" > <a href="<?php echo base_url();?>">
                        <img src="images/ygr_logos.png" class="logo_btm" alt="Yougotrated" title="Yougotrated"></a></div>
             </div>
  </div>

</div>
</section>
</section>
<?php echo $footer;?>
