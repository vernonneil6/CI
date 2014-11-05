<?php echo $header; ?>

<!-- #content -->

<div id="content"> 
  <!-- breadcrumbs -->
  <div class="breadcrumbs">
    <ul>
      <li class="home"><a href="<?php echo site_url('dashboard');?>" title="Dashboard">Dashboard</a></li>
      <li><a href="<?php echo site_url('report');?>" title="<?php echo $section_title; ?>"><?php echo $section_title; ?></a></li>
      <li> Reports </li>
    </ul>
  </div>
  <!-- /breadcrumbs --> 
  
  <!-- box -->
  <div class="box">
    <div class="headlines">
      <h2><span><?php echo "Reports"; ?> <img src="<?php echo base_url(); ?>images/csv.jpeg" alt="" title="Export as CSV file" width="20" height="20"/>&nbsp;CSV </span></h2>
    </div>
     
     <div class="box-content"> <?php echo form_open('report/reportsearch',array('class'=>'formBox','id'=>'frmsearch')); ?>
      <fieldset>
        
        <!-- Error form message -->
        
        <div class="form-cols"><!-- two form cols -->
          <div class="col1">
            <div class="clearfix">
              <div class="lab">
                <label for="keysearch">Keyword<span>*</span></label>
              </div>
              <div class="con"> 
				<?php echo form_input( array( 'name'=>'keysearch','id'=>'keysearch','class'=>'input','type'=>'text','placeholder'=>'Search Reports by')); ?> 
				<input type="hidden" name="searchdate" value="<?php echo date('Y-m-d H:i:s');?>">
				</div>
				<div class="lab">
                <label for="keysearch"></label>
              </div>
              <div class="con" style="margin-top:5px;">
			   <select name="type" class="select" >
					   <option>Select options</option>
					   <option value="signupdate">SignUp-date</option>
					   <option value="broker">Broker</option>
					   <option value="marketer">Marketer</option>
					   <option value="agent">Agent</option>
			  </select>
			  </div>	
			 </div>
         </div>
          <div id="keysearcherror" style="display:none;" class="error" align="right">Enter Keyword.</div>
        </div>
        <div class="btn-submit"> 
          <!-- Submit form --> 
          <?php echo form_input(array('name'=>'btnsearch','id'=>'btnsearch','class'=>'button','type'=>'submit','value'=>'Search','style'=>'margin-left:-48px;')); ?> or <a href="<?php echo site_url('report');?>" class="Cancel">Cancel</a> </div>
      </fieldset>
      <?php echo form_close(); ?> </div>
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
    
    <!-- table -->
    <style>
	.tab td {
		padding: 8px 10px;
	}
    .tab th {
		padding: 8px 10px;
	}
	</style>
	
	
	<?php if( count($reports) > 0 ) {
		
		 ?>
    <!-- table -->
    <table class="tab tab-drag">
      <tr class="top nodrop nodrag">
        <th>Subbroker</th>
        <th>Marketer</th>
        <th>Agent</th>
        <th>Action</th>
        <th>Add Coupon</th>
        <th>Make Elite</th>
      </tr>
      <?php 
	$site = site_url();			
	$url = explode("/admincp",$site);
	$path = $url[0];
	?>
      <?php echo count($reports);die;
      
      for($i=0;$i<count($reports);$i++) { 	   ?>
      <tr>
        <td><a href="<?php echo site_url('company/view/'.$reports['subbroker']); ?>" title="View Detail of <?php echo stripslashes($reports[$i]['company']); ?>" class="colorbox" style="color: #404040;"><?php echo stripslashes($reports['subbroker']); ?></a></td>        
        <td><?php echo stripslashes($reports['marketername']); ?></td>
        <td><?php echo stripslashes($reports['username']); ?></td>
        <?php /*?>        <td><?php echo stripslashes($reports[$i]['siteurl']); ?></td><?php */?>
        <td><?php if( stripslashes($reports[$i]['status']) == 'Enable' ) { ?>
          <a href="<?php echo site_url('company/disable/'.$reports[$i]['id']);?>" title="Click to Disable" class="btn btn-small btn-success" onClick="return confirm('Are you sure to Disable this company?');"><span>Enable</span></a>
          <?php } ?>
          <?php if( stripslashes($reports[$i]['status']) == 'Disable' ) { ?>
          <a href="<?php echo site_url('company/enable/'.$reports[$i]['id']);?>" title="Click to Enable" class="btn btn-small btn-info" style="cursor:default; color: #CD0B1C;" onClick="return confirm('Are you sure to Enable this company?');"><span>Disable</span></a>
          <?php } ?></td>
        <td width="100px"><a href="<?php echo site_url('company/edit/'.$reports[$i]['id']); ?>" title="Edit" class="ico ico-edit">Edit</a> <a href="<?php echo site_url('company/view/'.$reports[$i]['id']); ?>" title="View Detail of <?php echo stripslashes($reports[$i]['company']); ?>" class="colorbox"><img width="16" height="17" border="0" src="images/detail.jpeg" alt="view"></a> <a href="<?php echo site_url('company/delete/'.$reports[$i]['id']);?>" title="Delete" class="ico ico-delete" onClick="return confirm('Are you sure to Delete this company?');">Delete</a></td>
        <td><a href="<?php echo site_url('coupon/add'); ?>" title="Add Coupon">
        <img width="16" height="17" border="0" src="images/Add-icon.png" alt="view">
        </a></td>
        <td>
        <?php $mem = $this->settings->get_elite_status_of_companyid($reports[$i]['id']);?>
        <?php if(count($mem)==0)
		{?>
        <a href="<?php echo site_url('company/makeelite/'.base64_encode($reports[$i]['id'])); ?>" title="Make Elite Member" onClick="return confirm('Are you sure to Make this company an Elite Member ?');">
        <img width="16" height="17" border="0" src="images/Add-icon.png" alt="view">
        </a>
        <?php }
		else
		{
		"Already a Member";
		} ?>
        </td>
      </tr>
      <?php } ?>
    </table>
    <?php  if($this->pagination->create_links()) { ?>
    <tr style="background:#ffffff">
      <td></td>
      <td></td>
      <td></td>
      <td style="padding:10px"><div class="pagination"><?php echo $this->pagination->create_links(); ?></div></td>
    </tr>
    <?php } ?>
    <?php } 
	else { ?>
    <!-- Warning form message -->
    <div class="form-message warning">
      <p>No records found.</p>
    </div>
    <?php } ?>
	
    <table class="tab tab-drag">
      <tr class="top nodrop nodrag"> </tr>
      <tr>
        <td><a href="<?php echo site_url('report/csv/allenable'); ?>" title="Export as CSV file"> Download Reports for Elite members that are currently Enabled status</a></td>
      	</tr>
      <tr>
        <td><a href="<?php echo site_url('report/csv/alldisable'); ?>" title="Export as CSV file"> Download Reports for all Elite members with Disabled accounts </a></td>
      </tr>
      <tr>
        <td><a href="<?php echo site_url('report/csv/allelite'); ?>" title="Export as CSV file"> Download Reports for all Enabled and Disabled accounts</a></td>
        </tr>
        <tr>
        <td><a href="<?php echo site_url('report/csv/allenablewithcode'); ?>" title="Export as CSV file">Download Reports for elite members that used a promotional code and a currently in Enabled Status</a></td>
        </tr>
        <tr>
        <td><a href="<?php echo site_url('report/csv/alldisablewithcode'); ?>" title="Export as CSV file">Download Reports for all Elite members with Disabled accounts that used a promotional code </a></td>
        </tr>
        <tr>
        <td><a href="<?php echo site_url('report/csv/callcenter'); ?>" title="Export as CSV file">Download Reports for all Elite members with call center checkout process </a></td>
      </tr>
      <tr>
      <td><a href="<?php echo site_url('report/csv/removedreviews'); ?>" title="Export as CSV file">
      Download Reports for all removed Reviews</a>
      </td>
      </tr>
      <tr>
      <td><a href="<?php echo site_url('report/csv/removedcomplaints'); ?>" title="Export as CSV file">
      Download Reports for all removed Complaints</a>
      </td>
      </tr>
    </table>
    <!-- /table --> 
    
  </div>
  <!-- /box --> 
  
</div>
<!-- /#content --> 

<!-- #sidebar -->
<?php include('leftmenu.php'); ?>
<!-- /#sidebar --> 

<!-- #footer --> 
<?php echo $footer; ?>
