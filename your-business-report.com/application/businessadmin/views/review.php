<?php echo $heading; ?>
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
        <th width="60%">Review</th>
        <th width="8%">User</th>
        <th width="8%">Rating</th>
        <th width="20%">Review Date</th>
      </tr>
      <?php for($i=0;$i<count($reviews);$i++) { ?>
      <tr>
        <td><?php echo nl2br(stripslashes($reviews[$i]['comment'])); ?></td>
        <td><?php echo ucwords(stripslashes($reviews[$i]['reviewby'])); ?></td>
        <td><img src="images/stars/<?php echo stripslashes($reviews[$i]['rate']); ?>.png" title="<?php echo stripslashes($reviews[$i]['rate']); ?> Stars" /></td>
        <td><?php echo date("M d Y",strtotime($reviews[$i]['reviewdate'])); ?></td>
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
        <th width="15%">Share On</th>
      </tr>
      <?php $id = $this->session->userdata('siteid');?>
      <?php $url1 = $this->reviews->get_url_byid($id);?>
	  <?php $pageurl = $url1[0]['siteurl'].'review/browse/';?>
      <?php for($i=0;$i<count($reviews);$i++) { ?>
      <?php $user = $this->settings->get_user_byid($reviews[$i]['reviewby']);?>
      <?php $reviewstatus =$this->reviews->get_reviewstatus_by_reviewid($reviews[$i]['id']); ?>
      <tr>
        <td><?php echo nl2br(stripslashes($reviews[$i]['comment'])); ?></td>
        <td><?php if(count($user)>0) { echo ucwords(stripslashes($user[0]['firstname'] .' '.$user[0]['lastname'])); } else { echo "---"; } ?></td>
        <td><?php echo date("M d Y",strtotime($reviews[$i]['reviewdate'])); ?></td>
       <?php if(count($user)>0) { ?>
        <td><?php if(count($reviewstatus)>0) { ?>
          <a title="REQUEST ALREADY SENT"><span><img width="16" height="17" border="0" src="images/button_ok.png" alt="SENT"></span></a>
          <?php } else { ?>
          <a href="<?php echo site_url('review/request/'.$reviews[$i]['id'].'/'.$user[0]['id']);?>" title="REQUEST FOR REVIEW REMOVAL" onClick="return confirm('Are you sure to sent removal request to this user?');"><span><img width="16" height="17" border="0" src="images/delete-icon.png" alt="REQUEST"></span></a>
          <?php } ?></td>
          <?php }else{?>
          <td>---</td>
		  <?php }?>
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
	?>
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