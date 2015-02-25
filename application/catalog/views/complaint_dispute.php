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
<section class="container">
<section class="main_contentarea">
<div class="container">

<?php 
if( $this->session->userdata('youg_user') ) 
{
?>
  <div class="submit_dispute"></div>
     <div class="reg_frm_wrap">
     <div class="reg-row dispute"><label class="names">Dispute form</label><br><div class="reg_fld">PLEASE PROVIDE ALL DETAILS OF YOUR DISPUTE HERE.</div><br></div>
           
			<?php echo form_open('complaint/dispute_insert'); ?>
			
			<div class="reg-row company"><label class="names">companyname</label></div><br>
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
			
			<div class="reg-row username"><label class="names">username</label></div><br>		
			<?php 
			if(!empty($data['name'])){
				echo form_input(array('name'=>'username','type'=>'text','class'=>'reg_txt_box','value'=>$data['name']))."<br>";  
			
			}			
			?>
			
				
			<?php 
			
			if(!empty($data['emailid'])){
				echo form_input(array('name'=>'useremail','type'=>'hidden','class'=>'reg_txt_box','value'=>$data['emailid'])); 
			}
			
			?> 
		
			<?php /*<div class="reg-row disputenote"><label>dispute</label></div><br>		
			<?php echo form_textarea(array('name'=>'dispute','class'=>'disputenotes','required' => 'required'))."<br>"; ?>*/?>
			
			<div class="reg-row transaction"><label class="names">REASON FOR DISPUTE</label></div><br>
			               <select class="reg_txt_box fix_height" name="reasondispute" id="reasondispute">
							  <option>Select option</option>
							  <option value="Item Not Received">Item Not Received</option>
							  <option value="Item Not as Described">Item Not as Described (Merchant Pays for Shipping)</option>
							  <option value="Item Received Damaged">Item Received Damaged (Merchant Pays for Shipping)</option>
							  <option value="Items Missing from the Order">Items Missing from the Order</option>
							  <option value="Not Satisfied with Purchase would like a Refund">Not Satisfied with Purchase, would like a Refund (Buyer Pays for Shipping)</option>
							  <option value="Seller Not Willing to Honor the Return Policy">Seller Not Willing to Honor the Return Policy</option>
						   </select>
						   
			<div class="reg-row transaction"><label class="names">WHAT RESOLUTION DO YOU EXPECT FROM MERCHANT</label></div><br>
						<select class="reg_txt_box fix_height" name="merchantresolution" id="merchantresolution">
							  <option >Select option</option>
							  <option value="Ship the Item and/or Provide Proof of Shipping">Ship the Item and/or Provide Proof of Shipping</option>
							  <option value="Would like a Full Refund">Would like a Full Refund</option>
							  <option value="Would like a Replacement item">Would like a Replacement item</option>
						      <option value="Would like the missing items to be shipped immediately">Would like the missing items to be shipped immediately</option>
						      <option value="Would like a Partial Refund for the missing items">Would like a Partial Refund for the missing items</option>
					   </select>			 
					     <br><br>
			<div class="reg-row transaction"><label class="names">Transaction Details</label></div><br>
			<small class="reg_fld">This is the ID provided by the business, that helps us ensure you have actually purchased from this business.</small>
			<?php echo form_input(array('name'=>'transactionid','type'=>'text','class'=>'reg_txt_box','value'=>'','placeholder'=>'Please enter Transaction ID'))."<br>"; ?>
			<?php echo form_input(array('name'=>'transactionamt','type'=>'text','class'=>'reg_txt_box','value'=>'','placeholder'=>'Please enter Transaction Amount'))."<br>"; ?>
			<?php echo form_input(array('name'=>'transactiondate','type'=>'text','class'=>'reg_txt_box','value'=>'','placeholder'=>'Please enter Transaction Date'))."<br>"; ?>
			
			
			<?php echo form_input(array('name'=>'status','type'=>'hidden','class'=>'reg_txt_box','value'=>'open')); ?>
			
			<?php $rand=rand(0,999999); ?>
			<?php echo form_input(array('name'=>'msglink','type'=>'hidden','class'=>'reg_txt_box','value'=>$rand)); ?>
			
			<?php $date=date('Y-m-d : H:i:s'); ?>
			<?php echo form_input(array('name'=>'ondate','type'=>'hidden','class'=>'reg_txt_box','value'=>$date)); ?>
		   
			<input type="submit" name="mysubmit" value="submit" class="lgn_btn">
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
