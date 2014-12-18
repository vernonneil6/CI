<?php echo $heading; ?>
<!-- #content -->

<div id="content">
  <div class="breadcrumbs">
    <ul>
      <li class="home"><a href="<?php echo site_url('dashboard');?>" title="Dashboard">Dashboard</a></li>
      <li><a href="<?php echo site_url('elite');?>" title="<?php echo $section_title; ?>"><?php echo $section_title; ?></a></li>
    </ul>
  </div>

  <?php if($this->uri->segment(2)=='cancel_subscribtion')
  {
	  ?>
     <div class="box">
    <div class="headlines">
      <h2><span>Cancel subscription</span></h2>
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
    
    <?php if( count($elite) > 0 ) { ?>
    <!-- table -->
    <table class="tab tab-drag">
      <tr class="top nodrop nodrag">
        <th>Payment Date</th>
        <th>Payment Date</th>
        <th>Membership Status</th>
      </tr>
      <?php for($i=0;$i<count($elite);$i++) { ?>
      <tr>
          <td><?php echo date("M d Y",strtotime($elite[$i]['payment_date'])); ?></td>
          <td>
          <a href="<?php echo site_url('elite/cancel/'.$elite[$i]['subscr_id'].'/'.$elite[$i]['company_id']);?>" title="Click to Cancel Membership" class="btn btn-small btn-success" onClick="return confirm('Are you sure to cancel elite membership,after cancellation of membership you will not any access to your business admin account ?');"><span>Enable</span></a>
          
          </td>
        
      </tr>
      <?php } ?>
    </table>
    <?php } 
	else { ?>
    <!-- Warning form message -->
    <div class="form-message warning">
      <p>No records found.</p>
    </div>
    <?php } ?>
  </div>
      <?php
	  
  }
  else
  {
  ?>
  <div class="box">
    <div class="headlines">
      <h2><span> Elite Membership Status</span></h2>
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
    
    <?php if( count($elite) > 0 ) { ?>
    <!-- table -->
    <table class="tab tab-drag">
      <tr class="top nodrop nodrag">
        <th>Payment Date</th>
        <th>Status</th>
        <th>Start date</th>
        <th>Expire date</th>
        <th>Subscription price</th>
        <th>Total payments</th>
    </tr>
      <?php for($i=0;$i<count($elite);$i++) { ?>
      <tr>
          <td><?php echo date("M d Y",strtotime($elite[$i]['payment_date'])); ?></td>
          <td><?php if( stripslashes($elite[$i]['status']) == 'Enable' ) { ?>
          <a href="<?php echo site_url('elite/disable/'.$elite[$i]['id'].'/'.$elite[$i]['company_id']);?>" title="Click to Cancel Membership" class="btn btn-small btn-success" onClick="return confirm('Are you sure to cancel elite membership,after cancellation of membership you will not any access to your business admin account ?');"><span>Enable</span></a>
          <?php } ?>
          <td><?php echo date('M d Y',strtotime($elitepayment['startdate'])); ?></td>
          <td><?php echo date('M d Y',strtotime($elitepayment['expires'])); ?></td>
          <td><?php echo $elitepayment['sub_amt']; ?></td>
          <td><?php echo $elitepayment['subscription_paynumber']; ?></td>
          </td>
        
      </tr>
      <?php } ?>
    </table>
    <?php } 
	else { ?>
    <!-- Warning form message -->
    <div class="form-message warning">
      <p>No records found.</p>
    </div>
    <?php } ?>
  </div>
  <?php }?>
</div>
<!-- /#content -->
<?php  ?>
<!-- #sidebar -->

<?php include('leftmenu.php'); ?>
<!-- /#sidebar --> 
<!-- #footer --> 
<?php echo $footer; ?> 
