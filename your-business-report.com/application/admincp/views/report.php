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