<?php echo $header; ?>

<div id="content">
  <div class="breadcrumbs">
    <ul>
      <li class="home"><a href="<?php echo site_url('dashboard');?>" title="Dashboard">Dashboard</a></li>
      <li><a href="<?php echo site_url('dispute');?>" title="<?php echo $section_title; ?>"><?php echo $section_title; ?></a></li>
      <li><?php if($this->uri->segment(2) == 'review'){echo 'Dispute Review';} ?></li>
    </ul>
  </div>

<div class="box">
    <div class="headlines">
      <h2><span><?php echo "Dispute Review" ?></span></h2>
    </div>
      <div class="box-content">
          
    <!-- table -->
      
    	<?php echo form_open('dispute/review',array('class'=>'formBox broker')); ?>
		 <fieldset>
					
					<div class="clearfix">
						  <div class="lab">
							<label for="name">CompanyName</label>
						  </div>
						  <div class="con">
							  <input type="text" class="input" id="companyname" value="<?php echo $companyname;?>"> 
							  <input type="hidden" id="companyid" value="<?php echo $companyid;?>"> 
						  </div>
					</div>
					<div class="clearfix">
						  <div class="lab">
							<label for="name">CompanyEmail</label>
						  </div>
						  <div class="con">
							  <input type="text" class="input" id="companyemail" value="<?php echo $companyemail;?>"> 
						  </div>
					</div>
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
							<label for="name">Issue Status(refund proceedings)</label>
						  </div>
						  <div class="con">
							  <?php if(empty($issue)){ ?>
							  <input type="text" class="input" id="issue" value="Pending">
							   <?php } else { ?>
							  <input type="text" class="input" id="issue" value="<?php echo $issue;?>">
							  <?php } ?>
						  </div>
					</div>
					<div class="clearfix">
						  <div class="lab">
							<label for="name">Company Review Over the Dispute</label>
						  </div>
						  <div class="con">
							  <textarea name="review" class="input"><?php echo $companyreview;?></textarea>
						  </div>
					</div>
					<div class="clearfix">
						  <div class="lab">
							<label for="name">Date Filed</label>
						  </div>
						  <div class="con">
							  <?php  $ondate=substr($date,0,11); ?>
							  <input type="text" class="input" id="date" value="<?php echo $dates=date("d-M-Y", strtotime($ondate)); ?>">
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
								<?php $closed=substr($closedate,0,11); ?>  
							  <input type="text" class="input" id="closedate" value="<?php echo $close=date("d-M-Y",strtotime($closed)); ?>">
							  <?php } ?>
						  </div>
					</div>
					
					
			  </fieldset>
       <?php echo form_close(); ?>
    </div>
</div>
    
    <!-- /table -->

   
    </div>
    
</div>


</div>

<?php include('leftmenu.php'); ?>
<?php echo $footer; ?>
