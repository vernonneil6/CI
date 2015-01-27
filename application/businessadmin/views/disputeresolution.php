<?php echo $header; ?>


<div id="content">

  <div class="breadcrumbs">
    <ul>
      <li class="home"><a href="<?php echo site_url('dashboard');?>" title="Dashboard">Dashboard</a></li>
      <li><a href="<?php echo site_url('businessdispute');?>" title="<?php echo $section_title; ?>"><?php echo $section_title; ?></a></li>
      <li><?php if($this->uri->segment(2) == 'resolution'){echo "Resolution Page";} ?></a></li>
    </ul>
  </div>


<div class="box">
    <div class="headlines">
      <h2><span><?php echo "Resolution Page" ?></span></h2>
    </div>
    
    <div class="box-content">
          
    <!-- table -->
    
    	
    	<?php echo  form_open_multipart('businessdispute/resolution_update/'.$disputeid,array('class'=>'formBox broker')) ?>
		 <fieldset>
					
			
					<input type="hidden" class="input" name="companyname" value="<?php echo $companyname;?>"> 
					<input type="hidden" class="input" name="companyid" value="<?php echo $companyid;?>"> 
					<input type="hidden" class="input" name="companyemail" value="<?php echo $companyemail;?>">
					
					<input type="hidden" class="input" name="username" value="<?php echo $username;?>"> 
					<input type="hidden" class="input" name="userid" value="<?php echo $userid;?>">  
					<input type="hidden" class="input" name="useremail" value="<?php echo $useremail;?>">
					<input type="hidden" class="input" name="emailflag" value="1">
					<input type="hidden" class="input" name="msglink" value="<?php echo $msglink;?>">
					
					
					<input type="hidden" class="input" name="disputeid" value="<?php echo $disputeid;?>"> 
					<input type="hidden" class="input" name="status" value="<?php echo $status;?>">	 
					
					<div class="clearfix">
						  <div class="lab">
							<label for="name">Dispute Filed</label>
						  </div>
						  <div class="con">
							    <input class="input" name="dispute" value="<?php echo $dispute;?>"/>
						  </div>
					</div>
					<div class="clearfix">
						  <div class="lab">
							<label for="name">Resolution Expected</label>
						  </div>
						  <div class="con">
							  <input type="text" class="input" name="resolutionexpect" value="<?php echo $resolutionexpect;?>">	 
						  </div>
					</div>
					<div class="clearfix">
						  <div class="lab">
							<label for="name">Resolution </label>
						  </div>
						  <div class="con">
							    <select name="resolutionopt" class="select">
									<option>Select option</option>
									<option value="Upload Shipping Information">Upload Shipping Information (Carrier, Tracking Number and Date Shipped)</option>
									<option value="Buyer must return the merchandise for a full refund">Buyer must return the merchandise for a full refund </option>
									<option value="Offer Buyer a Replacement Item">Offer Buyer a Replacement Item</option>
									<option value="Offer Buyer a Partial Refund for the missing Items">Offer Buyer a Partial Refund for the missing Items</option>
									<option value="Offer Buyer to ship missing items">Offer Buyer to ship missing items</option>
									<option value="Offer Buyer a full refund with no further action required from buyer">Offer Buyer a full refund with no further action required from buyer</option>
									<option value="Transaction already Refunded (You must upload Proof of Refund)">Transaction already Refunded (You must upload Proof of Refund)</option>
								</select> 
						  </div>
					</div>
					<div class="clearfix">
						  <div class="lab">
							<label for="name"></label>
						  </div>
						  <div class="con">
							    <textarea class="input" name="notes" maxlength="600" style="margin: 2px 0px;width: 484px;height: 194px;"></textarea>
						  </div>
					</div>
					<div class="clearfix">
						  <div class="lab">
							<label for="file">Enter details</label>
						  </div>
						  <div class="con">
							
							 <?php if(trim($dispute)=='Item Not Received'){  ?>
							   
							   <input type="text" name="carrier" value="<?php echo $carrier; ?>" class="input" placeholder="enter carrier information">
							   <input type="text" name="tracking" class="input" value="<?php echo $tracking; ?>" placeholder="enter tracking Number:">
							   <input type="text" name="dateshipped" value="<?php echo $dateshipped; ?>" class="input" placeholder="enter Dateshipped(DD-MM-YYYY)">
						     
						     <?php } else if(trim($dispute)=='Item Not as Described' || 'Item Received Damaged' || 'Not Satisfied with Purchase would like a Refund' || 'Seller Not Willing to Honor the Return Policy') { ?>      

								   <input type="text" name="merchantname" class="input" placeholder="enter merchantname" value="<?php echo $m_company;?>" />
								   <input type="text" name="address" class="input" placeholder="enter address" value="<?php echo $m_streetaddress; ?>" />
								   <input type="text" name="city"  class="input" placeholder="enter city" value="<?php echo $m_city;?>" />
								   <input type="text" name="state"  class="input" placeholder="enter state" value="<?php echo $m_state;?>" />
								   <input type="text" name="zipcode"  class="input" placeholder="enter zipcode" value="<?php echo $m_zip;?>" />
							<?php } else if(trim($dispute)=='Items Missing from the Order'){?> 
						            
						            <p>Missing items from order</p>
						   
						        <?php } ?>
							</div>
					</div>
					<div class="clearfix file">
						  <div class="lab">
							<label for="file">Multiple fileupload</label>
						  </div>
						  <div class="con">
							         
							    <?php $show=explode(",",$uploads);?>
						     <div><input type='file' name='images[]' /><span><a href="/uploads/message/<?php echo $show[0];?>"><?php echo $show[0];?></a></span></div>
							 <div><input type='file' name='images[]' /><span><a href="/uploads/message/<?php echo $show[1];?>"><?php echo $show[1];?></a></span></div>
							 <div><input type='file' name='images[]' /><span><a href="/uploads/message/<?php echo $show[2];?>"><?php echo $show[2];?></a></span></div>
							    <input name="resolutiondate" type="hidden" value="<?php echo date('Y-m-d  H:i:s'); ?>">
								<div class="btn-submit">
								<input type="submit" name="mysubmit" value="Submit" class="button">
								</div>
						  </div>
					</div>
					
					</div>
					
			  </fieldset>
			  
			  
			  <div class="form-message" style="margin-top: 5px;">
			  <p>We're working to resolve this matter as quickly and fairly as possible, and we will contact you as soon as the issue is resolved. We will make every
effort to resolve this claim within 30 days although we may require additional time to complete our investigation.</p>
               </div> 
       <?php echo form_close(); ?>
    </div>
    
      
</div>
</div>

<?php include('leftmenu.php'); ?>
<?php echo $footer; ?>
