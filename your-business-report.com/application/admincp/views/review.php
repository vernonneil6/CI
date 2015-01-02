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
      <td><?php echo date('d M Y',strtotime($review[0]['reviewdate'])); ?></td>
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

<?php }
else
{
 if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'viewcomments')) {
	 ?>
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
        <th width="10%">Comment By</th>
        <th width="10%">Commented on</th>
        <th width="10%">status</th>
      </tr>
      <?php for($i=0;$i<count($comments);$i++) { ?>
      <?php $user=$this->users->get_user_byid($comments[$i]['commentby'])?>
      <tr>
        <td><?php echo nl2br(stripslashes($comments[$i]['comment'])); ?></td>
        <td><?php if(count($user)>0) {?>
          <img width="60" height="40" src="<?php if( $user[0]['avatarbig'] ){ echo $this->settings->get_setting_value('2').substr($this->config->item('user_thumb_upload_path'),3);?><?php echo stripslashes($user[0]['avatarbig']); } else{echo $this->settings->get_setting_value('2').substr($this->config->item('user_thumb_upload_path'),3)."/no-image.gif"; } ?>" alt="<?php echo stripslashes($user[0]['avatarbig']); ?>" title="<?php echo stripslashes($user[0]['firstname'].' '.$user[0]['lastname']);?>"/>
          <?php } else { echo "Anonymous"; } ?></td>
        <td><?php echo date('d M y',strtotime($comments[$i]['commentdate']));?></td>
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

<!-- #sidebar -->
<?php //include('leftmenu.php'); ?>
<!-- /#sidebar --> 

<!-- #footer -->
<?php //echo $footer; ?>
<?php 
	}
else { ?>
<?php echo $heading; ?> 
<!-- #content -->
<div id="content">
  <div class="breadcrumbs">
    <ul>
      <li class="home"><a href="<?php echo site_url('dashboard');?>" title="Dashboard">Dashboard</a></li>
      <li><a href="<?php echo site_url('review');?>" title="<?php echo $section_title; ?>"><?php echo $section_title; ?></a></li>
    </ul>
  </div>
  <?php if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'search' ) ) { ?>
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
    <?php if( $this->uri->segment(2)=='searchreview')
	   {
	   	?>
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
    <?php }?>
    <?php if( count($reviews) > 0 ) { ?>
    <!-- table -->
    <?php
   // echo "<pre>";
	//print_r($reviews);
	//die();
	?>
    <table class="tab tab-drag">
      <tr class="top nodrop nodrag">
        <th width="60%">Review</th>
        <th width="8%">Review to</th>
        <th width="8%">Review by</th>
        <th width="5%">status</th>
        <th width="14%">&nbsp;View&nbsp;</th>
      </tr>
      <?php for($i=0;$i<count($reviews);$i++) { ?>
      <?php // $company=$this->reviews->get_company_byid($reviews[$i]['companyid'])?>
      <?php //$user=$this->users->get_user_byid($reviews[$i]['reviewby'])?>
      <tr>
        <td><?php echo substr(stripslashes($reviews[$i]['comment']),0,150).'...'; ?></td>
        <td>
          <img width="40" height="40" src="<?php if( $reviews[$i]['logo'] ){ echo $site_url.substr($this->config->item('company_thumb_upload_path'),3);?><?php echo stripslashes($reviews[$i]['logo']); } else{echo $site_url.substr($this->config->item('company_thumb_upload_path'),3)."/no-image.gif"; } ?>" alt="<?php echo stripslashes($reviews[$i]['company']);?>" title="<?php echo stripslashes($reviews[$i]['company']);?>"/>
          </td>
        <td>
        <?php if(strlen($reviews[$i]['avatarbig'])>5){?>
          <img width="40" height="40" src="<?php if( $reviews[$i]['avatarbig'] ){ echo $site_url.substr($this->config->item('user_thumb_upload_path'),3);?><?php echo stripslashes($reviews[$i]['avatarbig']); } else{echo $site_url.substr($this->config->item('user_thumb_upload_path'),3)."/no-image.gif"; } ?>" alt="<?php echo stripslashes($reviews[$i]['firstname'].' '.$reviews[$i]['firstname']['lastname']);?>" title="<?php echo stripslashes($reviews[$i]['firstname'].' '.$reviews[$i]['lastname']);?>"/>
          <?php } else { echo $reviews[$i]['reviewby'];} ?>
          </td>
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
