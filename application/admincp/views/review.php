<?php if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'view' ) ) { ?>
<!-- box -->

<div class="box">
  <div class="headlines">
    <h2><span>Complaint Detail</span></h2>
  </div>
  <?php if( count($review)>0 ) { ?>
  <?php $company=$this->companys->get_company_byid($review[0]['companyid'])?>
  <?php $user=$this->users->get_user_byid($review[0]['reviewby'])?>
  <table>
    <tr>
      <td width="120" valign="top"><b>Review</b></td>
      <td valign="top"><b>:</b></td>
      <td><?php echo stripslashes($review[0]['comment']); ?></td>
    </tr>
    <tr>
      <td width="120"><b>Review To</b></td>
      <td><b>:</b></td>
      <td><?php if(count($company)>0) {
									echo stripslashes($company[0]['company']); }?></td>
    </tr>
    <tr>
      <td width="120"><b>Review by</b></td>
      <td><b>:</b></td>
      <td><?php if(count($user)>0) {
			 					 echo stripslashes(ucfirst($user[0]['firstname']).' '.ucfirst($user[0]['lastname'] )); }?></td>
    </tr>
    <tr>
      <td width="120"><b>Ratings</b></td>
      <td><b>:</b></td>
      <td><img src="<?php echo site_url();?>/images/stars/<?php echo $review[0]['rate']?>.png" alt="<?php echo $review[0]['rate']; ?> stars" title="<?php echo $review[0]['rate']; ?> stars"/></td>
    </tr>
    <tr>
      <td width="120"><b>Reviewed on</b></td>
      <td><b>:</b></td>
      <td><?php echo date('M d Y',strtotime($review[0]['reviewdate'])); ?></td>
    </tr>
  </table>
  <?php } else { ?>
  <!-- Warning form message -->
  <div class="form-message warning">
    <p>No record found.</p>
  </div>
  <?php } ?>
  <!-- /table --> 
</div>
<!-- /box -->


<?php }  else if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'removed' ) ) { ?>
	

<?php echo $heading; ?>	
<?php echo link_tag('colorbox/colorbox.css'); ?> 
<script language="javascript" type="text/javascript" src="<?php echo base_url();?>colorbox/jquery.colorbox.js"></script> 
<script language="javascript" type="text/javascript">
  $(document).ready(function(){
		$('.colorbox').colorbox({'width':'55%','height':'80%'});
  });
</script> 

<div id="content"> 
  
  <!-- breadcrumbs -->
  <div class="breadcrumbs">
    <ul>
      <li class="home"><a href="<?php echo site_url('dashboard');?>" title="Dashboard">Dashboard</a></li>
      <li><a href="<?php echo site_url('review');?>" title="Business Reviews">Business Reviews</a></li>
      <li><a href="<?php echo site_url('review/removed');?>" title="Removed Reviews">Removed Reviews</a></li>
    </ul>
  </div>
  
  
<div class="box">
    <div class="headlines">
      <h2><span>Removed Reviews</span></h2>
    </div>
    <?php if(count($reviewsremoved) > 0 ) { 
		$order_seg = $this->uri->segment(4,"asc"); 
		if($order_seg == "asc"){ $orderby = "desc";} else { $orderby = "asc"; }
		
		?>
    <table class="tab tab-drag complaint">
      <tr class="top nodrop nodrag">
        <th width="40%"><a class="sorttitle" href="<?php echo base_url('review/removed/title');?>/<?=$orderby?>">Review</th>
	    <th><a class="sorttitle" href="<?php echo base_url('review/removed/reviewby');?>/<?=$orderby?>">Review by</th>
        <!--<th>Review to</th>-->
        <th><a class="sorttitle" href="<?php echo base_url('review/removed/reviewdate');?>/<?=$orderby?>">Review Date</th>
        <th><a class="sorttitle" href="<?php echo base_url('review/removed/removaldate');?>/<?=$orderby?>">Removal Date</th>
        <th>Action</th>
        <th>Print History</th>
      </tr>
   
      <?php for($i=0;$i<count($reviewsremoved);$i++) { ?>
      <?php $company=$this->reviews->get_company_byid($reviewsremoved[$i]['companyid'])?>
      <?php $user=$this->users->get_user_byid($reviewsremoved[$i]['reviewby'])?>
      <?php $reviewremovedate=$this->reviews->select_removal_review_date($reviewsremoved[$i]['companyid'],$reviewsremoved[$i]['reviewby'],$reviewsremoved[$i]['id'],$orderby);?>

       <tr>  
        <td>
			<?php echo substr(stripslashes($reviewsremoved[$i]['comment']),0,150).'...'; ?>
		</td>
        <td>   
			<?php if($user){ echo ucfirst($user[0]['username']); } else{ echo ucfirst($reviewsremoved[$i]['reviewby']); } ?>		
        </td> 
        <!--<td>
			<?php //echo ucfirst($company[0]['company']);?>
        </td>-->
        <td><?php echo date('m-d-Y', strtotime($reviewsremoved[$i]['reviewdate'])); ?></td>
        <td><?php echo date('m-d-Y', strtotime($reviewremovedate['date'])); ?></td>
        <td><a href="<?php echo site_url('review/removeview/'.$reviewsremoved[$i]['id'].'/'.$reviewsremoved[$i]['companyid'].'/'.$reviewsremoved[$i]['reviewby']); ?>" title="View Detail" class="colorbox"><img width="16" height="17" border="0" src="images/detail.jpeg" alt="view"></a></td>
        <td><a href="<?php echo site_url('review/printhistory/'.$reviewsremoved[$i]['id'].'/'.$reviewsremoved[$i]['companyid']); ?>">Click Here</a></td>
      </tr>
      <?php } ?>
    </table>
    <?php  if($this->pagination->create_links()) { ?>
		<div class="pagination"><?php echo $this->pagination->create_links(); ?></div>
    <?php } ?>
    <?php } 
	else { ?>
    <div class="form-message warning">
      <p>No records found.</p>
    </div>
    <?php } ?>
</div>
</div>
<?php include('leftmenu.php'); ?>
<?php echo $footer; ?>


<?php } else if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'removeview' ) ) { ?>

    <div class="box">
    <div class="headlines">
      <h2><span>Review Detail</span></h2>
    </div>
    <?php if(count($reviewremove) > 0 ) { ?>
    <?php $company=$this->reviews->get_company_byid($reviewremove[0]['companyid'])?>
    <?php $user=$this->users->get_user_byid($reviewremove[0]['reviewby'])?>
    
    <table class="tab tab-drag complaint">
      <tr><td><b>Review</b></td><td><?php echo $reviewremove[0]['comment']; ?></td></tr>
      <tr><td><b>Review by</b></td><td><?php if($user){ echo ucfirst($user[0]['username']); } else{ echo ucfirst($reviewremove[0]['reviewby']); } ?></td></tr>
      <tr><td><b>Review to</b></td><td><?php echo ucfirst($company[0]['company']);?></td></tr>
      <tr><td><b>Review Date</b></td><td><?php echo date('m-d-Y', strtotime($reviewremove[0]['reviewdate'])); ?></td></tr>
    </table>
    
    <?php if( $review_date != '') { ?>
    <table class="tab tab-drag complaint">
      <tr class="top nodrop nodrag">
        <th>Date</th>
	    <th>Status</th>
	   </tr>
	  <?php foreach($review_date as $date) { ?>
      <tr>
        <td><?php echo date('m-d-Y', strtotime($date['date'])); ?></td>
        <td>
			<?php if($date['status'] == '0') { echo "Started review removal process";}?>
			<?php if($date['status'] == '1') { echo "Email sent to customer requesting they agree to remove review";}?>
			<?php if($date['status'] == '2') { echo "Customer submitted information about how to resolve";}?>
			<?php if($date['status'] == '3') { echo "Email sent to customer with shipping information of merchant";}?>
			<?php if($date['status'] == '4') { echo "Customer submitted shipping information of the product";}?>
			<?php if($date['status'] == '5') { echo "Email sent to customer with proof of refund";}?>
			<?php if($date['status'] == '6') { echo "Email sent to customer with shipping information";}?>
			<?php if($date['status'] == '7') { echo "Email sent to customer with new shipping information";}?>
			<?php if($date['status'] == '8') { echo "Waiting for customer to close the case";}?>
		</td>
      </tr>
      <?php } ?>
	</table>
	<?php } ?>
    <?php } 
	else { ?>
    <div class="form-message warning">
      <p>No records found.</p>
    </div>
    <?php } ?>
</div>
<?php } else { if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'viewcomments')) { ?>
			<?php echo $heading; ?> 
			<!-- #content -->
			<div id="content"> 
			  
			  <!-- breadcrumbs -->
			  <div class="breadcrumbs">
				<ul>
				  <li class="home"><a href="<?php echo site_url('dashboard');?>" title="Dashboard">Dashboard</a></li>
				  <li><a href="<?php echo site_url('review');?>" title="Business Reviews">Business Reviews</a></li>
				  <li><?php echo $section_title; ?></li>
				</ul>
			  </div>
			  <!-- /breadcrumbs --> 
			  <!-- box -->
			  <div class="box">
				<div class="headlines">
				  <h2><span><?php echo $section_title; ?></span></h2>
				</div>
				
				<!-- Correct form message -->
				<?php if( $this->session->flashdata('success') ) { ?>
				<div class="form-message correct">
				  <p><?php echo $this->session->flashdata('success'); ?></p>
				</div>
				<?php } ?>
				<!-- Error form message -->
				<?php if( $this->session->flashdata('error') ) { ?>
				<div class="form-message error1">
				  <p><?php echo $this->session->flashdata('error'); ?></p>
				</div>
				<?php } ?>
				<?php if( count($comments) > 0 ) { ?>
				<!-- table -->
				<table class="tab tab-drag">
				  <tr class="top nodrop nodrag">
					<th width="70%">Comment</th>
					<th width="7%">Comment By</th>
					<th width="7%">Commented on</th>
				   <th width="7%">IP</th>
					<th width="9%">status</th>
					
				  </tr>
				  <?php for($i=0;$i<count($comments);$i++) { ?>
				  <?php $user=$this->users->get_user_byid($comments[$i]['commentby'])?>
				  <tr>
					<td><?php echo nl2br(stripslashes($comments[$i]['comment'])); ?></td>
					<td><?php if(count($user)>0) {?>
					  <img width="60" height="40" src="<?php if( $user[0]['avatarbig'] ){ echo $this->settings->get_setting_value('2').substr($this->config->item('user_thumb_upload_path'),3);?><?php echo stripslashes($user[0]['avatarbig']); } else{echo $this->settings->get_setting_value('2').substr($this->config->item('user_thumb_upload_path'),3)."/no_image.png"; } ?>" alt="<?php echo stripslashes($user[0]['avatarbig']); ?>" title="<?php echo stripslashes($user[0]['firstname'].' '.$user[0]['lastname']);?>"/>
					  <?php } else { echo "Anonymous"; } ?></td>
					<td><?php echo date('d M y',strtotime($comments[$i]['commentdate']));?></td>
					<td><?php echo $comments[$i]['commentip'];?></td>
					<td><?php if( stripslashes($comments[$i]['status']) == 'Enable' ) { ?>
					  <a href="<?php echo site_url('review/comdisable/'.$comments[$i]['id']);?>" title="Click to Disable" class="btn btn-small btn-success" onClick="return confirm('Are you sure to Disable this comment?');"><span>Enable</span></a>
					  <?php } ?>
					  <?php if( stripslashes($comments[$i]['status']) == 'Disable' ) { ?>
					  <a href="<?php echo site_url('review/comenable/'.$comments[$i]['id']);?>" title="Click to Enable" class="btn btn-small btn-info" style="cursor:default; color: #CD0B1C;" onClick="return confirm('Are you sure to Enable this comments?');"><span>Disable</span></a>
					  <?php } ?></td>
				  </tr>
				  <?php } ?>
				</table>
				<!-- /table --> 
				<!-- /pagination -->
				<?php  if($this->pagination->create_links()) { ?>
				<div class="pagination"> <?php echo $this->pagination->create_links(); ?> </div>
				<?php } ?>
				<!-- /pagination -->
				<?php } 
				else { ?>
				<!-- Warning form message -->
					<div class="form-message warning">
					  <p>No records found.</p>
					</div>
					<?php } ?>
				  </div>
			  <!-- /box --> 
			  
</div>
<!-- /#content --> 

<?php } else { ?>
<?php echo $heading; ?> 
<!-- #content -->
<div id="content">
  <div class="breadcrumbs">
    <ul>
      <li class="home"><a href="<?php echo site_url('dashboard');?>" title="Dashboard">Dashboard</a></li>
      <li><a href="<?php echo site_url('review');?>" title="<?php echo $section_title; ?>"><?php echo $section_title; ?></a></li>
      <?php if($this->uri->segment(2) && ( $this->uri->segment(2) == 'printhistory' ) ){ ?><li>Removed Review History</li> <?php } ?>
    </ul>
  </div>

  <?php if( ($this->uri->segment(2) !='printhistory') && ( $this->uri->segment(2) == 'search' ) ) { ?>
					  <script type="text/javascript" language="javascript">
						function trim(stringToTrim) {
							return stringToTrim.replace(/^\s+|\s+$/g,"");
						}
						$(document).ready(function() {
							
							
							
							
							$("#btnsearch").click(function () {
						
								if( trim($("#keysearch").val()) == "" )
								{
									$("#error").attr('style','display:block;');
									$("#keysearcherror").show();
									$("#keysearch").val('').focus();
									return false;
								}
								else
								{
									$("#keysearcherror").hide();
								}
								
								if( $("#frmsearch").submit() )
								{
									$("#error").attr('style','display:none;');
								}
							});
						
						});
					</script> 
					  <!-- box -->
					  <div class="box">
						<div class="headlines">
						  <h2><span>Search Business Reviews</span></h2>
						</div>
						<div class="box-content"> <?php echo form_open('review/searchreview',array('class'=>'formBox','id'=>'frmsearch')); ?>
						  <fieldset>
							
							<!-- Error form message -->
							
							<div class="form-cols"><!-- two form cols -->
							  <div class="col1">
								<div class="clearfix">
								  <div class="lab">
									<label for="keysearch">Keyword<span>*</span></label>
								  </div>
								  <div class="con"> <?php echo form_input( array( 'name'=>'keysearch','id'=>'keysearch','class'=>'input','type'=>'text','placeholder'=>'search reivew by company name or user or keyword')); ?> </div>
								</div>
							  </div>
							  <div id="keysearcherror" style="display:none;" class="error" align="right">Enter Keyword.</div>
							</div>
							<div class="btn-submit"> 
							  <!-- Submit form --> 
							  <?php echo form_input(array('name'=>'btnsearch','id'=>'btnsearch','class'=>'button','type'=>'submit','value'=>'Search','style'=>'margin-left:-48px;')); ?> or <a href="<?php echo site_url('review');?>" class="Cancel">Cancel</a> </div>
						  </fieldset>
						  <?php echo form_close(); ?> </div>
					  </div>
					  <!-- /box-content -->
					  <?php } else if($this->uri->segment(2) && ( $this->uri->segment(2) == 'printhistory' ) ){?>
					  
					  
					  
					  <div class="box">
							<div class="headlines">
							  <h2><span><?php echo "Removed Review History" ?></span></h2>
							</div>
							<div class="box-content"> 

							 <?php if($review_date != '') { ?>
							<table class="tab tab-drag complaint">
							  <tr class="top nodrop nodrag">
								<th style="width: 40%;">Date</th>
								<th style="width: 40%;">Status</th>
							   </tr>
							  <?php foreach($review_date as $date) { ?>
							  <tr>
								<td><?php echo date('m-d-Y', strtotime($date['date'])); ?></td>
								<td>
									<?php if($date['status'] == '0') { echo "Started review removal process";}?>
									<?php if($date['status'] == '1') { echo "Email sent to customer requesting they agree to remove review";}?>
									<?php if($date['status'] == '2') { echo "Customer submitted information about how to resolve";}?>
									<?php if($date['status'] == '3') { echo "Email sent to customer with shipping information of merchant";}?>
									<?php if($date['status'] == '4') { echo "Customer submitted shipping information of the product";}?>
									<?php if($date['status'] == '5') { echo "Email sent to customer with proof of refund";}?>
									<?php if($date['status'] == '6') { echo "Email sent to customer with shipping information";}?>
									<?php if($date['status'] == '7') { echo "Email sent to customer with new shipping information";}?>
									<?php if($date['status'] == '8') { echo "Waiting for customer to close the case";}?>
								</td>
							  </tr>
							  <?php } ?>
							</table>
							<?php } else { ?>
								<table class="tab tab-drag complaint">
							  <tr class="top nodrop nodrag">
								<th style="width: 40%;">Date</th>
								<th style="width: 40%;">Status</th>
							   </tr>
							   <tr>
							     <td>No Records found.</td>
							     <td></td>
							   </tr>
							   </table>

                            <?php } ?>
						   </div>
						</div>	
					  
					  
					  
					  
					  
					  
					 <?php } else { ?>
					  
					  <!-- breadcrumbs --> 
					  
					  <!-- /breadcrumbs --> 
					  <!-- box -->
					  <div class="box">
						<div class="headlines">
						  <h2><span>
							<?php if($this->uri->segment(2) && $this->uri->segment(2)=='searchresult')
						   {} else { ?>
							<?php echo "Business Reviews"; } ?></span></h2>
							<h2>
							   <span>
									<a href="<?php echo site_url('review/csv/'.$keyword); ?>" title="Export as CSV file">
										<img src="<?php echo base_url(); ?>images/csv.jpeg" alt="" title="Export as CSV file" width="20" height="20"/>&nbsp;CSV 
									</a>
								</span>
							</h2>
						</div>
						
    <!-- Correct form message -->
    <?php if( $this->session->flashdata('success') ) { ?>
    <div class="form-message correct">
      <p><?php echo $this->session->flashdata('success'); ?></p>
    </div>
    <?php } ?>
    <!-- Error form message -->
    <?php if( $this->session->flashdata('error') ) { ?>
    <div class="form-message error1">
      <p><?php echo $this->session->flashdata('error'); ?></p>
    </div>
    <?php } ?>
    <?php echo link_tag('colorbox/colorbox.css'); ?> 
    <script language="javascript" type="text/javascript" src="<?php echo base_url();?>colorbox/jquery.colorbox.js"></script> 
    <script language="javascript" type="text/javascript">
  $(document).ready(function(){
		//$('.colorbox').colorbox({'width':'55%'});
		$('.colorbox').colorbox({'width':'55%','height':'75%'});
		/*$('.colorbox').colorbox({ 
			onComplete : function() { 
			   $(this).colorbox.resize();
			}
		});*/
  });
</script>

    <script type="text/javascript" language="javascript">
	function trim(stringToTrim) {
		return stringToTrim.replace(/^\s+|\s+$/g,"");
	}
	$(document).ready(function() {
		$("#btnsearch").click(function () {
	
			if( trim($("#keysearch").val()) == "" )
			{
				$("#error").attr('style','display:block;');
				$("#keysearcherror").show();
				$("#keysearch").val('').focus();
				return false;
			}
			else
			{
				$("#keysearcherror").hide();
			}
			
			if( $("#frmsearch").submit() )
			{
				$("#error").attr('style','display:none;');
			}
    	});
	
	});
</script> 
    <!-- box -->
    
    <div class="box-content"> <?php echo form_open('review/searchreview',array('class'=>'formBox','id'=>'frmsearch','method'=>'POST')); ?>
      <fieldset>
        
        <!-- Error form message -->
        
        <div class="form-cols"><!-- two form cols -->
          <div class="col1">
            <div class="clearfix">
              <div class="lab">
                <label for="keysearch">Keyword<span>*</span></label>
              </div>
              <div class="con"> <?php echo form_input( array( 'name'=>'keysearch','id'=>'keysearch','class'=>'input','type'=>'text','placeholder'=>'search reivew by company name or user or keyword','value'=>$keyword)); ?> </div>
            </div>
          </div>
          <div id="keysearcherror" style="display:none;" class="error" align="right">Enter Keyword.</div>
        </div>
        <div class="btn-submit"> 
          <!-- Submit form --> 
          <?php echo form_input(array('name'=>'btnsearch','id'=>'btnsearch','class'=>'button','type'=>'submit','value'=>'Search','style'=>'margin-left:-48px;')); ?> or <a href="<?php echo site_url('review');?>" class="Cancel">Cancel</a> </div>
      </fieldset>
      <?php echo form_close(); ?> </div>
   
    
    
    
    <?php if( count($reviews) > 0 ) { 
	  $order_seg = $this->uri->segment(4,"asc"); 
	  if($order_seg == "asc"){ $orderby = "desc";} else { $orderby = "asc"; }
	?>
		<script language="javascript">
		
		
$(function(){
 
    // add multiple select / deselect functionality
    $("#selectall").click(function () {
          $('.case').attr('checked', this.checked);
    });
 
    // if all checkbox are selected, check the selectall checkbox
    // and viceversa
    $(".case").click(function(){
 
        if($(".case").length == $(".case:checked").length) {
            $("#selectall").attr("checked", "checked");
        } else {
            $("#selectall").removeAttr("checked");
        }
 
    });
});

function submitfrm()
{
	var len =$('[name="foo[]"]:checked').length;
	
	if(len==0)
	{
		alert("Select atleast one review");
		return false;
	}
	
	
	$('#get_id').submit();
}
</script>
    <!-- table -->
    <?php
   // echo "<pre>";
	//print_r($reviews);
	//die();
	?><form action="review/foo" id="get_id" method="post" class="formBox"><table class="">
      <tr class="">
      <td>
    <div style="height:25px;width:150px !important;" class="con">
    <select id="checktype" class="select" name="checktype" style="padding-top:1px;">
<option value="Enable">Enable</option>
<option value="Disable">Disable</option>
<option value="Delete">Delete</option>
</select>
	
                
              </div>
              </td> <td><a onclick="submitfrm();" title="Submit" style="cursor:pointer;">Submit</a></td>
    </tr>
    </table>
    <table class="tab tab-drag">
      <th width="7%"><input type="checkbox" id="selectall" name="maincheck"/></th>
        <th width="51%"><a class="sorttitle" href="<?php echo base_url('review/index/review');?>/<?=$orderby?>">Review</a></th>
        <th width="7%"><a class="sorttitle" href="<?php echo base_url('review/index/to');?>/<?=$orderby?>">Review to</a></th>
        <th width="7%"><a class="sorttitle" href="<?php echo base_url('review/index/by');?>/<?=$orderby?>">Review by</a></th>
        <th width="7%"><a class="sorttitle" href="<?php echo base_url('review/index/ip');?>/<?=$orderby?>">IP</a></th>
        <th width="7%"><a class="sorttitle" href="<?php echo base_url('review/index/reviewdate');?>/<?=$orderby?>">Date Reviewed</a></th>
        <th width="7%">status</th>
        <th width="7%">&nbsp;View&nbsp;</th>
      </tr>
      <?php for($i=0;$i<count($reviews);$i++) { ?>
      <?php // $company=$this->reviews->get_company_byid($reviews[$i]['companyid'])?>
      <?php //$user=$this->users->get_user_byid($reviews[$i]['reviewby'])?>
      <tr>
		  
        
        <td><input type="checkbox" class="case" name="foo[]" value="<?php echo $reviews[$i]['id'];?>" /></td>
        <td>
		
		<?php echo substr(stripslashes($reviews[$i]['comment']),0,150).'...'; ?></td>
        <td>
			<?php echo ucfirst($reviews[$i]['company']);?>
        </td>
        <td>
        <?php if(strlen($reviews[$i]['avatarbig'])>5){?>
			<?php echo ucfirst($reviews[$i]['firstname'].' '.$reviews[$i]['lastname']);?>
		<?php } else { echo $reviews[$i]['reviewby'];} ?>
          </td>
        <td><?php echo $reviews[$i]['reviewip']; ?></td>
        <td><?php echo date('m-d-Y', strtotime($reviews[$i]['reviewdate'])); ?></td>
        <td><?php if( stripslashes($reviews[$i]['status']) == 'Enable' ) { ?>
          <a href="<?php echo site_url('review/disable/'.$reviews[$i]['id']);?>" title="Click to Disable" class="btn btn-small btn-success" onClick="return confirm('Are you sure to Disable this review?');"><span>Enable</span></a>
          <?php } ?>
          <?php if( stripslashes($reviews[$i]['status']) == 'Disable' ) { ?>
          <a href="<?php echo site_url('review/enable/'.$reviews[$i]['id']);?>" title="Click to Enable" class="btn btn-small btn-info" style="cursor:default; color: #CD0B1C;" onClick="return confirm('Are you sure to Enable this review?');"><span>Disable</span></a>
          <?php } ?></td>
        <td><a href="<?php echo site_url('review/view/'.$reviews[$i]['id']); ?>" title="View Detail" class="colorbox"><img width="16" height="17" border="0" src="images/detail.jpeg" alt="view" ></a><br />
          <?php $total=$this->reviews->get_all_comments($reviews[$i]['id']); ?>
          <?php if(count($total)>0) { ?>
          <a href="<?php echo site_url('review/viewcomments/'.$reviews[$i]['id']); ?>" title="View Comments"> Comments(<?php echo count($total);?>)</a>
          <?php } else { ?>
          Comments(<?php echo count($total);?>)
          <?php } ?></td>
      </tr>
      <?php } ?>
    </table>
    <!-- /table --> 
    <!-- /pagination -->
    <?php  if($this->pagination->create_links()) { ?>
    <div class="pagination"> <?php echo $this->pagination->create_links(); ?> </div>
    <?php } ?>
    <!-- /pagination -->
    <?php } 
	else { ?>
    <!-- Warning form message -->
    <div class="form-message warning">
      <p>No records found.</p>
    </div>
    <?php } ?>
  </div>
  <!-- /box -->
  <?php } ?>
</div>
<!-- /#content -->
<?php  ?>
<!-- #sidebar -->
<?php } ?>
<?php include('leftmenu.php'); ?>
<!-- /#sidebar --> 
<!-- #footer --> 
<?php echo $footer; ?>
<?php } ?>
