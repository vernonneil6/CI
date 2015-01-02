<?php if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'view' ) ) { ?>
<!-- box -->

<div class="box">
  <div class="headlines">
    <h2><span>Comment Detail</span></h2>
  </div>
  <?php if( count($couponcomment)>0 ) { ?>
  <?php $user=$this->users->get_user_byid($couponcomment[0]['commentby'])?>
  <?php $coupon=$this->coupons->get_coupon_byid($couponcomment[0]['couponid'])?>
  <table>
    <tr>
      <td width="120" valign="top"><b>Coupon</b></td>
      <td valign="top"><b>:</b></td>
      <td><?php if(count($coupon)>0) {
					echo nl2br(stripslashes($coupon[0]['title'])); } ?></td>
    </tr>
    <tr>
      <td width="120" valign="top"><b>Comment</b></td>
      <td valign="top"><b>:</b></td>
      <td><?php echo nl2br(stripslashes($couponcomment[0]['comment'])); ?></td>
    </tr>
    <tr>
      <td width="120" valign="top"><b>Comment by</b></td>
      <td valign="top"><b>:</b></td>
      <td><?php if(count($user)>0) {
					echo stripslashes($user[0]['firstname'].' '.$user[0]['lastname']); } ?></td>
    </tr>
    <tr>
      <td width="120"><b>Comment Date</b></td>
      <td><b>:</b></td>
      <td><?php echo date('d M y',strtotime($couponcomment[0]['commentdate']));?></td>
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
else { ?>
<?php echo $heading; ?> 
<!-- #content -->
<div id="content"> 
  
  <!-- breadcrumbs -->
  <div class="breadcrumbs">
    <ul>
      <li class="home"><a href="<?php echo site_url('dashboard');?>" title="Dashboard">Dashboard</a></li>
      <li><a href="<?php echo site_url('couponcomment');?>" title="<?php echo $section_title; ?>"><?php echo $section_title; ?></a></li>
    </ul>
  </div>
  <!-- /breadcrumbs -->
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
      <h2><span>Search Comments</span></h2>
    </div>
    <div class="box-content"> <?php echo form_open('couponcomment/searchcomment',array('class'=>'formBox','id'=>'frmsearch')); ?>
      <fieldset>
        
        <!-- Error form message -->
        
        <div class="form-cols"><!-- two form cols -->
          <div class="col1">
            <div class="clearfix">
              <div class="lab">
                <label for="keysearch">Keyword<span>*</span></label>
              </div>
              <div class="con"> <?php echo form_input( array( 'name'=>'keysearch','id'=>'keysearch','class'=>'input','type'=>'text','placeholder'=>'search comment by user or keyword')); ?> </div>
            </div>
          </div>
          <div id="keysearcherror" style="display:none;" class="error" align="right">Enter Keyword.</div>
        </div>
        <div class="btn-submit"> 
          <!-- Submit form --> 
          <?php echo form_input(array('name'=>'btnsearch','id'=>'btnsearch','class'=>'button','type'=>'submit','value'=>'Search','style'=>'margin-left:-48px;')); ?> or <a href="<?php echo site_url('couponcomments');?>" class="Cancel">Cancel</a> </div>
      </fieldset>
      <?php echo form_close(); ?> </div>
  </div>
  <!-- /box-content -->
  <?php } else { ?>
  <!-- box -->
  <div class="box">
    <div class="headlines">
      <h2><span>
        <?php if($this->uri->segment(2) && $this->uri->segment(2)=='searchresult')
	   {
	   	?>
        search results for '<?php echo $this->uri->segment(3);?>'
        <?php
	   } else { ?>
        <?php echo "Comments on coupons"; } ?></span></h2>
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
		
  });
</script>
    <?php if($this->uri->segment(2) && $this->uri->segment(2)=='searchresult')
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
    
    <div class="box-content"> <?php echo form_open('couponcomment/searchcomment',array('class'=>'formBox','id'=>'frmsearch')); ?>
      <fieldset>
        
        <!-- Error form message -->
        
        <div class="form-cols"><!-- two form cols -->
          <div class="col1">
            <div class="clearfix">
              <div class="lab">
                <label for="keysearch">Keyword<span>*</span></label>
              </div>
              <div class="con"> <?php echo form_input( array( 'name'=>'keysearch','id'=>'keysearch','class'=>'input','type'=>'text','placeholder'=>'search comment by user or keyword','value'=>$this->uri->segment(3))); ?> </div>
            </div>
          </div>
          <div id="keysearcherror" style="display:none;" class="error" align="right">Enter Keyword.</div>
        </div>
        <div class="btn-submit"> 
          <!-- Submit form --> 
          <?php echo form_input(array('name'=>'btnsearch','id'=>'btnsearch','class'=>'button','type'=>'submit','value'=>'Search','style'=>'margin-left:-48px;')); ?> or <a href="<?php echo site_url('couponcomment');?>" class="Cancel">Cancel</a> </div>
      </fieldset>
      <?php echo form_close(); ?> </div>
    <?php }?>
    <?php if( count($couponcomments) > 0 ) { ?>
    <!-- table -->
    <table class="tab tab-drag">
      <tr class="top nodrop nodrag">
        <th width="60%">Title</th>
        <th width="20%">Submitted by</th>
        <th width="10%">status</th>
        <th width="10%">View</th>
      </tr>
      <?php for($i=0;$i<count($couponcomments);$i++) { ?>
      <?php $user=$this->users->get_user_byid($couponcomments[$i]['commentby'])?>
      <tr>
        <td><?php echo nl2br(stripslashes(substr($couponcomments[$i]['comment'],0,100))).'...'; ?></td>
        <td><?php if(count($user)>0) {?>
          <div class="task-photo"> <img width="60" height="40" src="<?php if( $user[0]['avatarbig'] ){ echo $this->settings->get_setting_value('2').substr($this->config->item('user_thumb_upload_path'),3);?><?php echo stripslashes($user[0]['avatarbig']); } else{echo $this->settings->get_setting_value('2').substr($this->config->item('user_thumb_upload_path'),3)."/no-image.gif"; } ?>" alt="<?php echo stripslashes($user[0]['firstname'].' '.$user[0]['lastname']);?>" title="<?php echo stripslashes($user[0]['firstname'].' '.$user[0]['lastname']);?>"/> </div>
          <?php } else { echo "Anonymous"; } ?></td>
        <td><?php if( stripslashes($couponcomments[$i]['status']) == 'Enable' ) { ?>
          <a href="<?php echo site_url('couponcomment/disable/'.$couponcomments[$i]['id']);?>" title="Click to Disable" class="btn btn-small btn-success" onClick="return confirm('Are you sure to Disable this complaint?');"><span>Enable</span></a>
          <?php } ?>
          <?php if( stripslashes($couponcomments[$i]['status']) == 'Disable' ) { ?>
          <a href="<?php echo site_url('couponcomment/enable/'.$couponcomments[$i]['id']);?>" title="Click to Enable" class="btn btn-small btn-info" style="cursor:default; color: #CD0B1C;" onClick="return confirm('Are you sure to Enable this complaint?');"><span>Disable</span></a>
          <?php } ?></td>
        <td><a href="<?php echo site_url('couponcomment/view/'.$couponcomments[$i]['id']); ?>" title="View Detail" class="colorbox"><img width="16" height="17" border="0" src="images/detail.jpeg" alt="view"></a></td>
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

<!-- #sidebar -->
<?php include('leftmenu.php'); ?>
<!-- /#sidebar --> 

<!-- #footer --> 
<?php echo $footer; ?>
<?php } ?>
