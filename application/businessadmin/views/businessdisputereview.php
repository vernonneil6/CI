<?php echo $header; ?>


<div id="content">

  <div class="breadcrumbs">
    <ul>
      <li class="home"><a href="<?php echo site_url('dashboard');?>" title="Dashboard">Dashboard</a></li>
      <li><a href="<?php echo site_url('businessdispute');?>" title="<?php echo $section_title; ?>"><?php echo $section_title; ?></a></li>
      <li><?php if($this->uri->segment(2) == 'review'){echo 'Business Dispute Review';} ?></a></li>
    </ul>
  </div>


<div class="box">
    <div class="headlines">
      <h2><span><?php echo "Business Dispute Review" ?></span></h2>
    </div>
    
    <div class="box-content">
          
    <!-- table -->
      
    	
    	<?php echo  form_open('businessdispute/update/'.$disputeid,array('class'=>'formBox broker')) ?>
		 <fieldset>
					
			
					<input type="hidden" class="input" id="companyname" value="<?php echo $companyname;?>"> 
					<input type="hidden" id="companyid" value="<?php echo $companyid;?>"> 
					<input type="hidden" class="input" id="companyemail" value="<?php echo $companyemail;?>"> 
						 
					<div class="clearfix">
						  <div class="lab">
							<label for="name">Username</label>
						  </div>
						  <div class="con">
							  <input type="text" class="input" id="username" value="<?php echo $username;?>"> 
							  <input type="hidden" id="userid" value="<?php echo $userid;?>"> 
						  </div>
					</div>
					<div class="clearfix">
						  <div class="lab">
							<label for="name">UserEmail</label>
						  </div>
						  <div class="con">
							  <input type="text" class="input" id="useremail" value="<?php echo $useremail;?>"> 
							
						  </div>
					</div>
					<div class="clearfix">
						  <div class="lab">
							<label for="name">Dispute Filed</label>
						  </div>
						  <div class="con">
							  <p class="input" id="dispute" disabled><?php echo $dispute;?></p> 
							  <input type="hidden" id="disputeid" value="<?php echo $disputeid;?>"> 
						  </div>
					</div>
					<div class="clearfix">
						  <div class="lab">
							<label for="name">Case Status</label>
						  </div>
						  <div class="con">
							  <input type="text" class="input" id="status" value="<?php echo $status;?>">
						  </div>
					</div>
					<div class="clearfix">
						  <div class="lab">
							<label for="name">Issue Status<br>(refund proceedings)</label>
						  </div>
						  <div class="con">
							    <select name="issue" class="select">
									<option>Select option</option>
									<option value="Issue refund">Issue - refund</option>
									<option value="Issue refundafteritemreturned">Issue - refund(after item returned)</option>
									<option value="Disagreed completely">Disagreed completely</option>
								</select> 
						  </div>
					</div>
					<div class="clearfix">
						  <div class="lab">
							<label for="name">Review note</label>
						  </div>
						  <div class="con">
							  <textarea class="input" name="review" placeholder="Company review over the issue"></textarea>
							  <input type="hidden" name="statusclose" value="case closed" />
							  <input type="hidden" name="closedate" value=<?php echo date('Y-m-d : H:i:s');?> />
						  </div>
					</div>
					<div class="clearfix">
						  <div class="lab">
							<label for="name">Date Filed</label>
						  </div>
						  <div class="con">
							  <input type="text" class="input" id="date" value="<?php $dates=substr($date,0,11); echo $change=date("m/d/Y",strtotime($dates));?>">
						  </div>
					</div>
					<div class="clearfix">
						  <div class="lab">
							<label for="name">Dispute closed date</label>
						  </div>
						  <div class="con">
							  <?php if($closedate==0){ ?>
							  <input type="text" class="input" id="closedate" value="Not yet Closed">
							  <?php } else { ?>
								  
							  <input type="text" class="input" id="closedate" value="<?php $closed=substr($closedate,0,11); echo $changes=date("m/d/Y",strtotime($closed));?>">
							  <?php } ?>
						  </div>
					</div>
					
					
			  </fieldset>
			  <input type="submit" name="mysubmit" value="Update" class="button">
       <?php echo form_close(); ?>
    </div>
    
      
</div>
</div>


<?php include('leftmenu.php'); ?>
<?php echo $footer; ?>
