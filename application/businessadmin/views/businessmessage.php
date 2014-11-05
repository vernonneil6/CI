<?php echo $header; ?>


<div id="content">

  <div class="breadcrumbs">
    <ul>
      <li class="home"><a href="<?php echo site_url('dashboard');?>" title="Dashboard">Dashboard</a></li>
      <li><a href="<?php echo site_url('businessdispute');?>" title="<?php echo $section_title; ?>"><?php echo $section_title; ?></a></li>
      <li><?php if($this->uri->segment(2) == 'messages'){echo 'Business Dispute messages';} ?></a></li>
    </ul>
  </div>


<div class="box">
    <div class="headlines">
      <h2><span><?php echo "Business Dispute messages" ?></span></h2>
    </div>
		<table class="tab tab-drag">
		     <center><h2>Message</h2></center>
		    <tbody>
				<tr class="top nodrop nodrag"> </tr>       
				 <tr class="odd">
				    <td>
					    <div cols='90' rows='10'>
							
							<?php $check=$this->session->userdata['youg_admin']['id'];
							
							foreach($showmessage as $sm)
							{
								  if($check!= $sm->fromid) { ?>
								  
										   <p><b><?php echo strtoupper($sm->username);?></b>
											  <br>
											  <?php echo $sm->messages;?>        
											  <br>
											 <?php if($sm->upload!='nofile') { ?>
													
													<div><b>File attached: &nbsp;</b>
													<a title="<?php echo $sm->upload; ?>" href="/uploads/message/<?php echo $sm->upload; ?>"><?php echo $sm->upload; ?></a>
													<br>
													<img src="../uploads/message/<?php echo $sm->upload;?>"  alt="file" title="<?php echo $sm->upload; ?>"> 
													</div>
													<br>
																					
											<?php } else { ?>
															
															<span>&nbsp;&nbsp;</span><br>
												
												 <?php  } ?>
											    <u>
												  <span>
												  <i>Messaged at:</i>&nbsp;
														   <?php 
																$date = date_default_timezone_set('UTC');                             
																$date = date('m/d/Y',strtotime($sm->date));
																$today = date('m/d/Y');
																$d1 = strtotime(date('Y-m-d H:i:s'));
																$d2 = strtotime($sm->date);
																$newdate =round(($d1-$d2)/60);
																if($newdate > 60){$diff = round(($d1-$d2)/60/60).' hours ago';}else{$diff = $newdate.' minutes ago';}
																echo ($date==$today)?$diff:date('d M,Y',strtotime($sm->date)); 
															?>
													
												  </span>
											    </u>
											<br>
										</p> 
								<?php } else { ?>
									
									<p><b><?php echo strtoupper($sm->companyname);?></b>
									  <br>
									  <?php echo $sm->messages;?>        
									 <br>
									  <?php if($sm->upload!='nofile') { ?>
													<div><b>File attached: &nbsp;</b>
													<a title="<?php echo $sm->upload; ?>" href="/uploads/message/<?php echo $sm->upload; ?>"><?php echo $sm->upload; ?></a>
													<br>
													<img src="../uploads/message/<?php echo $sm->upload;?>"  alt="file" title="<?php echo $sm->upload; ?>"> 
													</div>
													<br>
																			
											<?php } else { ?>
													<span>&nbsp;&nbsp;</span><br>
											<?php } ?>
									  <u><span>
									  <i>Messaged at:</i>&nbsp;
												<?php 
													$date = date_default_timezone_set('UTC');                             
													$date = date('m/d/Y',strtotime($sm->date));
													$today = date('m/d/Y');
													$d1 = strtotime(date('Y-m-d H:i:s'));
													$d2 = strtotime($sm->date);
													$newdate =round(($d1-$d2)/60);
													if($newdate > 60){$diff = round(($d1-$d2)/60/60).' hours ago';}else{$diff = $newdate.' minutes ago';}
													echo ($date==$today)?$diff:date('d M,Y',strtotime($sm->date)); 
												?> 
									  </span></u>
									<br>
								</p> 
								
								  
					<?php } }?>
						</div>
					</td>
				</tr>
		 
		   </tbody>
		</table>					   
					
    <div class="box-content">
         	
    	<?php echo form_open_multipart('businessdispute/message_insert',array('class'=>'formBox broker')); ?>
		 <fieldset>
		    		<div class="clearfix">
						  <div class="lab">
							<label for="name">Username</label>
						  </div>
						  <div class="con">
							  <input type="hidden" class="input" name="companyname" value="<?php echo $companyname;?>"> 
					          <input type="hidden" name="fromid" value="<?php echo $companyid;?>"> 
					          <input type="hidden" name="companyid" value="<?php echo $companyid;?>"> 
							  <input type="text" class="input" name="username" id="username" value="<?php echo $username;?>"> 
							  <input type="hidden" name="toid" value="<?php echo $userid;?>"> 
							  <input type="hidden" name="userid" value="<?php echo $userid;?>"> 
							  <input type="hidden" name="msglink" value="<?php echo $msglink;?>"> 
						  </div>
					</div>
					
					<div class="clearfix">
						  <div class="lab">
							<label for="name">Dispute Filed</label>
						  </div>
						  <div class="con">
							  <p class="input"  name="dispute" disabled><?php echo $dispute;?></p> 
							  <input type="hidden"  name="disputeid" value="<?php echo $disputeid;?>">
							  <input type="hidden" class="input" name="status" value="<?php echo $status;?>"> 
						  </div>
					</div>
					
					<div class="clearfix">
						  <div class="lab">
							<label for="name">Message</label>
						  </div>
						  <div class="con">
							 <textarea name="messages" class="input"></textarea>
							 <input type="hidden" name="date" value="<?php echo date('Y-m-d H:i:s');?>">
						  </div>
					</div>
					
					<input type="submit" name="postmessage" value="Send" class="button">
			  </fieldset>
       <?php echo form_close(); ?>
    </div>
    
      
</div>
</div>


<?php include('leftmenu.php'); ?>
<?php echo $footer; ?>
