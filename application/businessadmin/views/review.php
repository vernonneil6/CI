<?php echo $heading; ?>
<link rel="stylesheet" href="<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/';?>css/fancybox.css" type="text/css">
<script type="text/javascript" src="<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/';?>js/fancybox.js"></script>
<script type="text/javascript" language="javascript">	
	
	$(document).ready(function() 
	{
		$('.readmore').fancybox();
	});

</script>
<!-- #content -->
<div id="content">
  <div class="breadcrumbs">
    <ul>
      <li class="home"><a href="<?php echo site_url('dashboard');?>" title="Dashboard">Dashboard</a></li>
      <li><a href="<?php echo site_url('review');?>" title="<?php echo $section_title; ?>"><?php echo $section_title; ?></a></li>
    </ul>
  </div>
  <!-- box -->
  <div class="box">
    <div class="headlines">
      <h2><span> Reviews</span></h2>
    </div>          
     <?php $id = $this->session->userdata('siteid');?>
      <?php $url1 = $this->reviews->get_url_byid($id);?>
	  <?php $pageurl = $url1[0]['siteurl'].'review/browse/';?>
    <?php if( $this->uri->segment(1) == 'review' && ( $this->uri->segment(2) == 'index' || $this->uri->segment(2) == '' ) )
	{
    if( $this->uri->segment(1) == 'review' && $this->uri->segment(2) == '' )
  	{ ?>
    <script language="javascript" type="text/javascript">
	  $(document).ready(function(){
		$('#uploadcsv').click(function() {
			$('#divupload').show();
			$('#submitupload').show();
		});
	  });
	</script> 
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
    <?php echo form_open_multipart('review/import_csv',array('class'=>'formBox','id'=>'frmupload')); ?>
    <?php 
	$site = site_url();			
	$url = explode("/businessadmin",$site);
	$path = $url[0];
	?>
    <div class="clearfix file uploadbox" style="width:auto">
      <div class = "review_download">Elite member review upload tool</div>
	  <div class = "review_download">Use the template below to format your reviews in Excel with the same columns and formatting. When ready, upload your file to populate your elite business profile page with your preferred business reviews!</div>
	  
      <div id="divlink"><a title="Upload CSV" id="uploadcsv" style="cursor:pointer; display:block">Upload CSV</a> or <a title="Download Sample CSV" href="<?php echo site_url('review/download');?>" id="downloadcsv" style="cursor:pointer">( Download Sample CSV )</a></div>
      <div class="con" id="divupload"> <?php echo form_input( array( 'name'=>'csvfile','id'=>'csvfile','class'=>'input file upload-file','type'=>'file') ); ?> </div>
      <div class="btn-submit" id="submitupload"> <?php echo form_input(array('name'=>'btnupload','id'=>'btnupload','class'=>'button','type'=>'submit','value'=>'Submit')); ?> or <a href="<?php echo site_url('review');?>" class="Cancel">Cancel</a> </div>
    </div>
    <?php echo form_close();?>
    <?php } ?>
    <?php if( count($reviews) > 0 ) { ?>
    <!-- table -->
    <table class="tab tab-drag">
      <tr class="top nodrop nodrag">
        <th width="10%">Title</th>
        <th width="50%">Review</th>
        <th width="8%">User</th>
        <th width="8%">Rating</th>
        <th width="20%">Review Date</th>
        <th width="15%">Share On</th>
        
      </tr>

      <?php for($i=0;$i<count($reviews);$i++) { ?>
      <tr>
        <td><?php echo (stripslashes($reviews[$i]['reviewtitle'])); ?></td>
        <td><?php echo nl2br(stripslashes($reviews[$i]['comment'])); ?></td>
        <td>
		<?php
			 $username = $this->reviews->get_user_bysingleid($reviews[$i]['reviewby']);
			 if($username)
			 {
				echo ucwords(stripslashes($username['firstname']." ".$username['lastname']));
			 }
			 else
			 {
				 echo $reviews[$i]['reviewby'];
			 }
		?>
		</td>
        <td><img src="images/stars/<?php echo stripslashes($reviews[$i]['rate']); ?>.png" title="<?php echo stripslashes($reviews[$i]['rate']); ?> Stars" /></td>
        <td><?php echo date("m d Y",strtotime($reviews[$i]['reviewdate'])); ?></td>
        <td>  <?php $title=urlencode('My post');
                $url=urlencode($pageurl.$reviews[$i]['seokeyword']);
                $image=urlencode('http://livemarketnews.com/dressfinity/skin/frontend/default/default/images/logo.jpg');
                ?>
                <a onClick="window.open('http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo $title;?>&amp;p[url]=<?php echo $url; ?>&amp;&p[images][0]=<?php echo $image;?>', 'sharer', 'toolbar=0,status=0,width=548,height=325');" target="_parent" href="javascript: void(0)" title="Facebook">
                    <img width="16" height="17" border="0" src="images/fa.png" alt="fbshare">
                </a>
                <a href="https://plus.google.com/share?url=<?php echo urlencode($pageurl.$reviews[$i]['seokeyword']);?>" title="Google+"><img width="16" height="17" border="0" src="images/go.jpg" alt="googleshare"></a>
          		<a href="https://twitter.com/share" class="twitter-share-button" data-url="google.com" data-text="<?php echo $pageurl.$reviews[$i]['id'];?>" data-count="none">Tweet</a>
				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>        
		</td>
		
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
    <?php } 
    }
    
    
	if( $this->uri->segment(1) == 'review' && $this->uri->segment(2) == 'reviews' )
	{ ?>
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
    <?php } 
    if( count($reviews) > 0 ) {	 ?>
    <!-- table -->
    <table class="tab tab-drag">
      <tr class="top nodrop nodrag">
        <th>Review</th>
        <th>User</th>
        <th>Review Date</th>
        <th>Removal Request</th>
        <th>Resolution</th>
        <th width="15%">Share On</th>
		<th width="20%">Status</th>
      </tr>
      <?php for($i=0;$i<count($reviews);$i++) { ?>
      <?php $user = $this->settings->get_user_byid($reviews[$i]['reviewby']);?>
      <?php $reviewstatus =$this->reviews->get_reviewstatus_by_reviewid($reviews[$i]['id']); ?>
      <tr>
        <td>
			<?php echo substr(stripslashes($reviews[$i]['comment']), 0, 70);
			if(strlen($reviews[$i]['comment']) > 70)
			{ 
			?>
				...<a href = "#readmore<?php echo $i; ?>" class = "readmore">Read More</a>
			<?php
			}
			?>
        </td>
        
<div id = "readmore<?php echo $i; ?>" style = "width : 500px; display : none">
	<h3>Review</h3>
	<div>
		<?php echo $reviews[$i]['comment']; ?>
	</div>
</div>


        <td><?php if(count($user)>0) { echo ucwords(stripslashes($user[0]['firstname'] .' '.$user[0]['lastname'])); } else { echo "---"; } ?></td>
        <td><?php echo date("M d Y",strtotime($reviews[$i]['reviewdate'])); ?></td>
       <?php if(count($user)>0) { ?>
        <td><?php if($reviews[$i]['flag'] == 2 or $reviews[$i]['flag'] == 1) { ?>
          <a title="REQUEST ALREADY SENT"><span><img width="16" height="17" border="0" src="images/button_ok.png" alt="SENT"></span></a>
          <?php } else { ?>
          <a href="<?php echo site_url('review/request/'.$reviews[$i]['id'].'/'.$user[0]['id']);?>" title="REQUEST FOR REVIEW REMOVAL" onClick="return confirm('Are you sure to sent removal request to this user?');"><span><img width="16" height="17" border="0" src="images/delete-icon.png" alt="REQUEST"></span></a>
          <?php } ?></td>
          <?php }else{?>
          <td>---</td>
		  <?php }?>
		  <td><a href="<?php echo site_url('review/resolution/'.$reviews[$i]['id']); ?>">Click Here</a></td>
          <td>  <?php $title=urlencode('My post');
                $url=urlencode($pageurl.$reviews[$i]['seokeyword']);
                $image=urlencode('http://livemarketnews.com/dressfinity/skin/frontend/default/default/images/logo.jpg');
                ?>
                <a onClick="window.open('http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo $title;?>&amp;p[url]=<?php echo $url; ?>&amp;&p[images][0]=<?php echo $image;?>', 'sharer', 'toolbar=0,status=0,width=548,height=325');" target="_parent" href="javascript: void(0)" title="Facebook">
                    <img width="16" height="17" border="0" src="images/fa.png" alt="fbshare">
                </a>
                <a href="https://plus.google.com/share?url=<?php echo urlencode($pageurl.$reviews[$i]['seokeyword']);?>" title="Google+"><img width="16" height="17" border="0" src="images/go.jpg" alt="googleshare"></a>
          		<a href="https://twitter.com/share" class="twitter-share-button" data-url="google.com" data-text="<?php echo $pageurl.$reviews[$i]['id'];?>" data-count="none">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
        
        </td>
		<td>
		<?php 
			$status = $this->reviews->get_reviewmail_bysinglereviewid($reviews[$i]['id']); 
			$initial_status = $this->reviews->get_review_bysingleid($reviews[$i]['id']); 
			if($initial_status['flag'] == '0'){ echo "No Removal Request"; } 
			else if($initial_status['flag'] == '1') { echo "Removal Requested"; } 
			else if($status['status'] == '0' or $status['status'] == '2'){echo "Pending Client Feedback";} 
			else if($status['status'] == '1'){echo "Pending Elite Feedback";}
		?>
		</td>
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
    <?php } 
    }
    if( $this->uri->segment(1) == 'review' && $this->uri->segment(2) == 'resolution' )
  	{
	?>
	<div class="box-content">
    <fieldset>
	<?php if( $review_date != '') { ?>
	<table class="tab tab-drag">
      <tr class="top nodrop nodrag">
        <th width="50%">Date</th>
        <th width="50%">Status</th>
      </tr>

      <?php foreach($review_date as $date) { ?>
      <tr>
        <td><?php echo date('n/d/y', strtotime($date['date'])); ?></td>
        <td>
			<?php if($date['status'] == '0') { echo "Started review removal process";}?>
			<?php if($date['status'] == '1') { echo "Email sent to customer requesting they agree to remove review";}?>
			<?php if($date['status'] == '2') { echo "Customer submitted information about how to resolve";}?>
			<?php if($date['status'] == '3') { echo "Email sent to customer with shipping information of merchant";}?>
			<?php if($date['status'] == '4') { echo "Customer submitted shipping information of the product";}?>
			<?php if($date['status'] == '5') { echo "Email sent to customer with proof of refund";}?>
			<?php if($date['status'] == '6') { echo "Email sent to customer with shipping information";}?>
			<?php if($date['status'] == '7') { echo "Email sent to customer with new shipping information";}?>
		</td>
      </tr>
      <?php } ?>
    </table>
	<?php } ?>
	<?php if($review['resolution'] == '1'  || $review['resolution'] == '4' && $review['status'] == '0') { ?>
	<form action="review/review_updates" method="post" class ="formBox broker">
		<div class="clearfix">
			<div class="lab">
				<label for="name">Resolution</label>
			</div>
			<div class="con">
				<input type = "text" value="<?php echo $review['resolution']; ?>" class="input" readonly>
			</div>
		</div>
		
		<div class="clearfix">
			<div class="lab">
				<label for="name">Comments</label>
			</div>
			<div class="con">
				<input type = "text" value="<?php echo $review['comment']; ?>" class="input" readonly>
			</div>
		</div>
		
		<div class="clearfix">
			<div class="lab">
				<label for="name">Carrier</label>
			</div>
			<div class="con">
				<input type = "text" value="" class="input" name = "carrier">
			</div>
		</div>
		
		<div class="clearfix">
			<div class="lab">
				<label for="name">Tracking Number</label>
			</div>
			<div class="con">
				<input type = "text" value="" class="input" name = "trackingno" >
			</div>
		</div>
		
		<div class="clearfix">
			<div class="lab">
				<label for="name">Date Shipped</label>
			</div>
			<div class="con">
				<input type = "text" value="" class="input" name = "dateshipped" >
			</div>
		</div>
		<input type = "hidden" value = "<?php echo $review['id'];?>" name = "id" >
		<input type = "hidden" value = "<?php echo $review['user_id'];?>" name = "userid" >
		<input type = "hidden" value = "<?php echo $review['company_id'];?>" name = "companyid" >
		<input type = "hidden" value = "<?php echo $review['review_id'];?>" name = "reviewid" >
		<div class="btn-submit" style = "padding : 15px 0 0 14%; border : none;">
			<input class="button" type="submit" value="Submit" name="submit">
		</div>
		
	</form>
	<?php } ?>
	
	<?php 
	if($review['resolution'] == '4' && $review['status'] == '2') 
	{ 
	?>
		
	<?php 
	}
	?>
	
	<?php if($review['resolution'] == '2') { ?>
	<?php if($review['status'] == 0) { ?>
		
	<?php } ?>
	<?php if($review['status'] == 1) { ?>
	<form action="review/review_refund" method="post" class ="formBox broker" enctype = "multipart/form-data">
		<div class="clearfix">
			<div class="lab">
				<label for="name">Upload Proof</label>
			</div>
			<div class="con">
				<input type = "file" name="refundproof" value="">
			</div>
		</div>
		
		<input type = "hidden" value = "<?php echo $review['id'];?>" name = "id" >
		<input type = "hidden" value = "<?php echo $review['user_id'];?>" name = "userid" >
		<input type = "hidden" value = "<?php echo $review['company_id'];?>" name = "companyid" >
		<input type = "hidden" value = "<?php echo $review['review_id'];?>" name = "reviewid" >
		<div class="btn-submit" style = "padding : 15px 0 0; border : none;">
			<input class="button" type="submit" value="Submit" name="submit">
		</div>
		
	</form>
	<?php } ?>
	<?php if($review['status'] == 2) { ?>
		
	<?php } ?>
	<?php } ?>
	
	<?php if($review['resolution'] == '5') { ?>
	<?php if($review['status'] == '0') { ?>
	<form action="review/review_gift" method="post" class ="formBox broker" enctype = "multipart/form-data">
		<div class="clearfix">
			<div class="lab">
				<label for="name">Upload Proof</label>
			</div>
			<div class="con">
				<input type = "file" name="refundproof" value="">
			</div>
		</div>
		
		<input type = "hidden" value = "<?php echo $review['id'];?>" name = "id" >
		<input type = "hidden" value = "<?php echo $review['user_id'];?>" name = "userid" >
		<input type = "hidden" value = "<?php echo $review['company_id'];?>" name = "companyid" >
		<input type = "hidden" value = "<?php echo $review['review_id'];?>" name = "reviewid" >
		<div class="btn-submit" style = "padding : 15px 0 0; border : none;">
			<input class="button" type="submit" value="Submit" name="submit">
		</div>
		
	</form>
	<?php } ?>
	<?php if($review['status'] == '2') { ?>
	
	<?php } ?>
	<?php } ?>
	
	<?php if($review['resolution'] == '3') { ?>	
	<?php if($review['status'] == 0) { ?>
		
	<?php } ?>
	<?php if($review['status'] == 1) { ?>
	<form action="review/review_replacement" method="post" class ="formBox broker">
		<div class="clearfix">
			<div class="lab">
				<label for="name">Resolution</label>
			</div>
			<div class="con">
				<input type = "text" value="<?php echo $review['resolution']; ?>" class="input" readonly>
			</div>
		</div>
		
		<div class="clearfix">
			<div class="lab">
				<label for="name">Comments</label>
			</div>
			<div class="con">
				<input type = "text" value="<?php echo $review['comment']; ?>" class="input" readonly>
			</div>
		</div>
		
		<div class="clearfix">
			<div class="lab">
				<label for="name">Carrier</label>
			</div>
			<div class="con">
				<input type = "text" value="" class="input" name = "carrier">
			</div>
		</div>
		
		<div class="clearfix">
			<div class="lab">
				<label for="name">Tracking Number</label>
			</div>
			<div class="con">
				<input type = "text" value="" class="input" name = "trackingno" >
			</div>
		</div>
		
		<div class="clearfix">
			<div class="lab">
				<label for="name">Date Shipped</label>
			</div>
			<div class="con">
				<input type = "text" value="" class="input" name = "dateshipped" >
			</div>
		</div>
		<input type = "hidden" value = "<?php echo $review['id'];?>" name = "id" >
		<input type = "hidden" value = "<?php echo $review['user_id'];?>" name = "userid" >
		<input type = "hidden" value = "<?php echo $review['company_id'];?>" name = "companyid" >
		<input type = "hidden" value = "<?php echo $review['review_id'];?>" name = "reviewid" >
		<div class="btn-submit" style = "padding : 15px 0 0 14%; border : none;">
			<input class="button" type="submit" value="Submit" name="submit">
		</div>
		
	</form>
	<?php } ?>
	<?php if($review['status'] == 2) { ?>
		
	<?php } ?>
	<?php } ?>
	
	
	<?php if($review_status['flag'] == '0') { echo "Review has not been requested to be removed."; }?>
	
	</fieldset>
    </div>
	<?php
	}
	?>
	
<?php if($this->uri->segment(1) == 'review' && $this->uri->segment(2) == 'removalrequest') { ?>	
<div class="removal_request">	Dear <?php echo $companyname;?> : </div>

<ul class="removal_request1">
	
<li>By choosing to have the review removed from your profile, you must agree to </li>
<li>work with your customer to resolve their complaint. These are the available </li>
<li class="removal_text">options that will be presented to your buyer on your behalf.</li>

<li>Please understand that YouGotRated cannot influence your buyer's decision, and </li>
<li class="removal_text">that it is entirely up to you and your buyer to reach an amicable resolution.</li>

<li>The following are the options that will be emailed to your buyer.</li>
<li>Your buyer will have 7 days to respond to the email with their selection. If for any </li>
<li>reason, they choose not to respond, the negative review will be permanently </li>
<li class="removal_text">deleted from the site and this case will be closed.</li>

<li>If the buyer responds within 7 days, you will receive an email with their selected </li>
<li>choice and it is up to you to complete the process to have the review permanently </li>
<li class="removal_text">deleted.</li>
</ul>
	
<ul>

<ul class="removal_request2">
	
<li class="first">Options that will be presented to the Buyer on your behalf:</li>

<li>a) Item not received: Ship the purchased item and provide Proof of Shipping.</li>

<li>b) Would like a Full Refund.</li>

<li>c) Item is damaged or defective / Would like a Replacement item.</li>

<li>d) Would like the missing items to be shipped immediately.</li>

<li class = "request_middle">e) Would like a Partial Refund and/or Gift Card in compensation for the service received.</li>



<li class = "request_result"> We have emailed your Buyer and we expect to resolve this matter as quickly and fairly as possible. We </li>
<li class = "request_result"> will contact you as soon as your buyer responds.</li>


<li class = "request_last">Sincerely,</li>

<li>YouGotRated</li>

<li class = "request_footer">Copyright 2014 YouGotRated, LLC. All rights reserved. YouGotRated, Tampa, FL 33624.</li>

</ul>
<?php } ?>

  </div>
  <!-- /box --> 
  
</div>
<!-- /#content -->
<?php  ?>
<!-- #sidebar -->

<?php include('leftmenu.php'); ?>
<!-- /#sidebar --> 
<!-- #footer --> 
<?php echo $footer; ?> 
