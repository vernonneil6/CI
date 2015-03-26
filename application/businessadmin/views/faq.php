<?php if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'view' ) ) { ?>
<!-- box -->
<div class="box">
    <!-- table -->
    <table class="tab">
    <?php if( count($faqs)>0 ) { ?>
    <tr>
        <th valign="top">Question</th>
        <td><?php echo nl2br(stripslashes($faqs[0]['question'])) ?></td>
    </tr>
    <tr>
        <th valign="top">Answer</th>
        <td><?php echo nl2br(stripslashes($faqs[0]['answer'])) ?></td>
    </tr>
    <?php } else { ?>
    <!-- Warning form message -->
    <div class="form-message warning"><p>No record found.</p></div>
    <?php } ?>
    </table>
    <!-- /table -->
</div>
<!-- /box -->
<?php } else { ?>
<?php echo $heading; ?>
<!-- #content -->
<?php echo link_tag('colorbox/colorbox.css'); ?> 
<script language="javascript" type="text/javascript" src="<?php echo base_url();?>colorbox/jquery.colorbox.js"></script> 
<script language="javascript" type="text/javascript">
  $(document).ready(function(){
		$('.colorbox').colorbox({'width':'55%','height':'60%'});
  });
</script>
<div id="content">
  <div class="breadcrumbs">
    <ul>
      <li class="home"><a href="<?php echo site_url('dashboard');?>" title="Dashboard">Dashboard</a></li>
      <li><a href="<?php echo site_url('elite');?>" title="<?php echo $section_title; ?>"><?php echo $section_title; ?></a></li>
    </ul>
  </div>

  <div class="box">
    <div class="headlines">
      <h2><span> List of faqs</span></h2>
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
    
    <?php if( count($faqs) > 0 ) { ?>
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
      <tr class="top nodrop nodrag">
        <th width="40%">Question</th>
        <th width="40%">Answer</th>
        <th width="20%">Action</th>
      </tr>
      <?php for($i=0;$i<count($faqs);$i++) { ?>
      <tr>
         <td style="width: 210px;"><?php echo ucfirst($faqs[$i]['question']);?></td>
         <td><?php echo substr(stripslashes($faqs[$i]['answer']),0,100)."...";?></td>
         <td><a href="<?php echo site_url('faq/view/'.$faqs[$i]['id']); ?>" title="View Detail" class="colorbox"><img width="16" height="17" border="0" src="images/detail.jpeg" alt="view"></a></td></td>
      </tr>
      <?php } ?>
    </table>
    <?php } 
	else { ?>
    <!-- Warning form message -->
    <div class="form-message warning">
      <p>No faqs found.</p>
    </div>
    <?php } ?>
  </div>

</div>
<!-- /#content -->
<?php  ?>
<!-- #sidebar -->

<?php include('leftmenu.php'); ?>
<!-- /#sidebar --> 
<!-- #footer --> 
<?php echo $footer; ?> 
<?php } ?>
