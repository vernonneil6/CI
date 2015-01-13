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
   if( $this->session->userdata('youg_user')) { ?>
	  <div class="submit_message"></div>
	  
	    <div class="container">
			<div class="pr_detlwrp">
      <div class="titl_pr_rel">
        <div class="pre_rls_rating"> </div>
        <h1>"MESSAGE"</h1>
        <p>- CUSTOMER SUPPORT CORNER -</p>
      </div>
      <div class="pr_countwrp"> </div>
      <div class="pr_testmnl_wrp">
       
       <?php
        $data=$this->session->userdata('youg_user');  	
       	foreach($messages as $me)
		{ 
		?>
		<?php
		
		if($data['userid'] == $me->fromid) { ?>
        <div class="message_holder">
        <p><div class="rat_title"><h2><?php echo $me->username;?>:</h2></div><br>
						<br>
						 <a title="message"><?php echo $me->messages;?></a>
						<br>
						
						<?php if($me->upload!='nofile') { ?>
								<div>
								<br>	
								<b>File attached: &nbsp;</b>
								<a title="<?php echo $me->upload; ?>" href="/uploads/message/<?php echo $me->upload; ?>"><?php echo $me->upload; ?></a>
								<br>
								<img src="../uploads/message/<?php echo $me->upload;?>" alt="file" title="<?php echo $me->upload; ?>"> 
								</div>
								<br>
															
						<?php } else { ?>
								<span>&nbsp;&nbsp;</span><br>
						<?php } ?>
						<span class="time_show">
							<i>Messaged at:</i>&nbsp;
						    <?php 
								$date = date_default_timezone_set('UTC');                             
								$date = date('m/d/Y',strtotime($me->date));
								$today = date('m/d/Y');
								$d1 = strtotime(date('Y-m-d H:i:s'));
								$d2 = strtotime($me->date);
								$newdate =round(($d1-$d2)/60);
								if($newdate > 60){$diff = round(($d1-$d2)/60/60).' hours ago';}else{$diff = $newdate.' minutes ago';}
								echo ($date==$today)?$diff:date('m/d/Y',strtotime($me->date)); 
							?>
							</span>
						<br>
		</p>
		</div>
		<?php } else { ?>
        <div class="message_holder">
        <p><div class="rat_title"><h2><?php echo $me->companyname;?>:</h2></div><br>
						<br>
						 <a title="message"><?php echo $me->messages;?></a>
						<br>
						<?php if($me->upload!='nofile') { ?>
								<div><b>File attached: &nbsp;</b>
								<a title="<?php echo $me->upload; ?>" href="/uploads/message/<?php echo $me->upload; ?>"><?php echo $me->upload; ?></a>
								<br>
								<img src="../uploads/message/<?php echo $me->upload;?>" alt="file" title="<?php echo $me->upload; ?>"> 
								</div>
								<br>
														
						<?php } else { ?>
								<span>&nbsp;&nbsp;</span><br>
						<?php } ?>
						<span class="time_show">
							<i>Messaged at:</i>&nbsp;
						    <?php 
								$date = date_default_timezone_set('UTC');                             
								$date = date('m/d/Y',strtotime($me->date));
								$today = date('m/d/Y');
								$d1 = strtotime(date('Y-m-d H:i:s'));
								$d2 = strtotime($me->date);
								$newdate =round(($d1-$d2)/60);
								if($newdate > 60){$diff = round(($d1-$d2)/60/60).' hours ago';}else{$diff = $newdate.' minutes ago';}
								echo ($date==$today)?$diff:date('m/d/Y',strtotime($me->date)); 
							?>
						</span>
						<br>
		</p>
		</div>
		<?php } }?>
         
                
      </div>
    </div>
			
		<div class="form_wraps">
						 
				<?php echo form_open_multipart('dispute/message_insert'); ?>
				
					<div class="reg-row">
						<label style="color:#0080FF">DISPUTE FILED</label>
						<label style="border-bottom: 1px solid #000000;font-size: 30px;line-height: 41px;width:600px;margin-top: -16px;"><h5>"<?php echo $dispute;?>"</h5></label>
					</div><br>
					
					<div class="reg-row"><label>companyname</label></div><br>
					<?php 
						 echo form_input(array('name'=>'companyname','type'=>'text','class'=>'reg_txt_box','value'=>$company))."<br>"; 
						 echo form_input(array('name'=>'toid','type'=>'hidden','class'=>'reg_txt_box','value'=>$cmpid)); 
						 echo form_input(array('name'=>'companyid','type'=>'hidden','class'=>'reg_txt_box','value'=>$cmpid)); 
						 echo form_input(array('name'=>'disputeid','type'=>'hidden','class'=>'reg_txt_box','value'=>$id)); 
					?>
					
									
					<div class="reg-row"><label>username</label></div><br>		
					<?php 
						$data=$this->session->userdata('youg_user'); 
						echo form_input(array('name'=>'fromid','type'=>'hidden','class'=>'reg_txt_box','value'=>$data['userid'])); 
						echo form_input(array('name'=>'userid','type'=>'hidden','class'=>'reg_txt_box','value'=>$data['userid'])); 
						echo form_input(array('name'=>'username','type'=>'text','class'=>'reg_txt_box','value'=>$data['name']))."<br>";  
					 ?> 
				    
					<div class="reg-row"><label>File Upload</label></div><br>
					<table>
						 <tr>
							<td class="box_label" width="180px" valign="middle"><box_labelel for="photo">File upload here</box_labelel>
							<span class="error-sign"></span></td>
							<td><?php echo form_input( array( 'name'=>'img','class'=>'input file upload-file','type'=>'file','style'=>'float:left') ); ?></td>
						</tr>
                   </table>
                   <div class="reg-row"><label>Message</label></div><br>		
					<?php
						 echo form_textarea(array('name'=>'messages','style'=>'width: 502px; height: 172px;','required' => 'required'))."<br>"; 
						 echo form_input(array('name'=>'status','type'=>'hidden','class'=>'reg_txt_box','value'=>$casestatus))."<br>"; 
						 echo form_input(array('name'=>'dispute','type'=>'hidden','class'=>'reg_txt_box','value'=>$dispute))."<br>"; 
						 echo form_input(array('name'=>'msglink','type'=>'hidden','class'=>'reg_txt_box','value'=>$msglink)); 
						 $date=date('Y-m-d : H:i:s'); 
						 echo form_input(array('name'=>'ondate','type'=>'hidden','class'=>'reg_txt_box','value'=>$date)); 
					 ?>
				   
				<input type="submit" name="mysubmit" value="Send" class="lgn_btn">
				<?php echo form_close(); ?>
<?php  } else {  ?>
	  	 <div class="reg-row"><a href="/login"><label style="cursor:pointer;">Log in to Continue</label></a></div>
<?php  } ?>			
    <div class="lgn_btnlogo" > <a href="<?php echo base_url();?>">
                        <img src="images/ygr_logos.png" class="logo_btm" alt="Yougotrated" title="Yougotrated"></a></div>
             </div>
  </div>

</div>
</section>
</section>
<?php echo $footer;?>
