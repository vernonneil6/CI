<?php if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'view' ) ) { ?>
<!-- box -->

<div class="box">
  <div class="headlines">
    <h2><span>Company Detail</span></h2>
  </div>
  <!-- table -->
  <table align="center" width="100%" cellspacing="10" cellpadding="0" border="0">
    <?php if( count($company)>0 ) { ?>
    <tr>
      <td width="120"><b>Company Name</b></td>
      <td><b>:</b></td>
      <td><?php echo stripslashes($company[0]['company']) ?></td>
    </tr>
    <tr>
      <td width="120" style="vertical-align:top"><b>About Company</b></td>
      <td style="vertical-align:top"><b>:</b></td>
      <td <?php if($company[0]['aboutus'] != ''){?>style="text-align:justify; background:#EEEEEE;" <?php } ?>colspan="3"><?php echo nl2br(stripslashes($company[0]['aboutus'])); ?></td>
    </tr>
    <tr>
      <td width="120"><b>Address</b>
        </th>
      <td><b>:</b></td>
      <td><?php echo stripslashes($company[0]['streetaddress']); ?>
      	  ,<?php echo stripslashes($company[0]['city']); ?>
          ,<?php echo stripslashes($company[0]['state']); ?>
          ,<?php echo stripslashes($company[0]['country']); ?>
          -<?php echo stripslashes($company[0]['zip']); ?>
          	
      </td>
    </tr>
    <tr>
      <td width="120"><b>Email</b></td>
      <td><b>:</b></td>
      <td><?php echo stripslashes($company[0]['email']); ?></td>
    </tr>
    <tr>
      <td width="120"><b>Logo</b></td>
      <td><b>:</b></td>
      <td><div class="task-photo"> <img width="60" height="40" src="<?php if( $company[0]['logo'] ){ echo $this->settings->get_setting_value('2').substr($this->config->item('company_thumb_upload_path'),3);?><?php echo stripslashes($company[0]['logo']); } else{echo $this->settings->get_setting_value('2').substr($this->config->item('company_thumb_upload_path'),3)."/no-image.gif"; } ?>" alt="<?php echo stripslashes($company[0]['logo']); ?>"/> </div></td>
    </tr>
    <tr>
      <td width="120"><b>Site Url</b></td>
      <td><b>:</b></td>
      <td><?php echo stripslashes($company[0]['siteurl']); ?></td>
    </tr>
    <tr>
      <td width="120"><b>Phone</b></td>
      <td><b>:</b></td>
      <td><?php echo stripslashes($company[0]['phone']); ?></td>
    </tr>
    <tr>
      <td width="120"><b>Seo keyword</b></td>
      <td><b>:</b></td>
      <td><?php echo stripslashes($company[0]['companyseokeyword']); ?></td>
    </tr>
    <tr>
      <td width="120"><b>Contact Name</b></td>
      <td><b>:</b></td>
      <td><?php echo stripslashes($company[0]['contactname']); ?></td>
    </tr>
    <tr>
      <td width="120"><b>Contact Number</b></td>
      <td><b>:</b></td>
      <td><?php echo stripslashes($company[0]['contactphonenumber']); ?></td>
    </tr>
    <tr>
      <td width="120"><b>Contact Email</b></td>
      <td><b>:</b></td>
      <td><?php echo stripslashes($company[0]['contactemail']); ?></td>
    </tr>
    <?php } else { ?>
    <!-- Warning form message -->
    <div class="form-message warning">
      <p>No record found.</p>
    </div>
    <?php } ?>
  </table>
  <!-- /table --> 
</div>
<!-- /box -->
<?php } 
else{
echo $header; ?>
<!-- #content -->

<div id="content">
  <?php if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'add' || $this->uri->segment(2) == 'edit' ) ) { ?>
  <script type="text/javascript" language="javascript">
	function trim(stringToTrim) {
		return stringToTrim.replace(/^\s+|\s+$/g,"");
	}
	$(document).ready(function() {
		
	<?php if( $this->uri->segment(2) == 'add' ) { ?>
		$("#btnsubmit").click(function () {
	<?php } ?>
	<?php if( $this->uri->segment(2) == 'edit' ) { ?>
		$("#btnupdate").click(function () {
	<?php } ?>
	
			if( trim($("#title").val()) == "" )
			{
				$("#error").attr('style','display:block;');
				$("#titleerror").show();
				$("#title").val('').focus();
				return false;
			}
			else
			{
				$("#titleerror").hide();
			}
			
			<?php if( $this->uri->segment(2) == 'add' ) { ?>
			if( trim($("#pdf").val()) == "" )
			{
				$("#error").attr('style','display:block;');
				$("#pdferror").show();
				$("#pdf").val('').focus();
				return false;
			}
			else
			{
				$("#pdferror").hide();
			}
			<?php } ?>
					
			if( $("#frmpdf").submit() )
			{
				$("#error").attr('style','display:none;');
			}
				
    	});
	
	});
</script>
  <?php } ?>
  
  <!-- breadcrumbs -->
  <div class="breadcrumbs">
    <ul>
      <li class="home"><a href="<?php echo site_url('dashboard');?>" title="Dashboard">Dashboard</a></li>
      <li><a href="<?php echo site_url('pdf');?>" title="<?php echo $section_title; ?>"><?php echo $section_title; ?></a></li>
      <li>
        <?php if($this->uri->segment(2) == 'add'){echo 'Add Profile Docs';} else if($this->uri->segment(2) == 'edit') {echo 'Edit Profile Docs'; }?>
      </li>
      
    </ul>
  </div>
  <!-- /breadcrumbs -->
  
  <?php if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'add' || $this->uri->segment(2) == 'edit' ) ) { ?>
  
  <!-- box -->
  <div class="box">
    <div class="headlines">
      <h2><span>
        <?php if($this->uri->segment(2) == 'add') { echo "Add Profile Docs"; } ?>
        <?php if($this->uri->segment(2) == 'edit') { echo "Edit Profile Docs"; } ?>
        </span></h2>
    </div>
    <div class="box-content"> <?php echo form_open_multipart('pdf/update',array('class'=>'formBox','id'=>'frmpdf')); ?>
      <fieldset>
        <div class="form-cols"><!-- two form cols -->
          <div class="col1" style="width:100%">
            <div class="clearfix">
              <div class="lab" style="width: 8% !important;">
                <label for="title">Title <span class="errorsign">*</span></label>
              </div>
              <div class="con" style="width: 59% !important; float:left">
                <?php if($this->uri->segment(2) == 'add') { ?>
                <input type="hidden" value="addpdf" name="addpdf">
				<?php echo form_input( array( 'name'=>'title','id'=>'title','class'=>'input','type'=>'text' ) ); ?>
                <?php } ?>
                <?php if($this->uri->segment(2) == 'edit') { ?>
                <input type="hidden" value="editpdf" name="editpdf">
				<?php echo form_input( array( 'name'=>'title','id'=>'title','class'=>'input','type'=>'text','value'=>ucfirst(stripslashes($pdf[0]['title'])) ) ); ?>
                <?php echo form_hidden( array( 'name'=>'editpdf','id'=>'editpdf','type'=>'hidden' ) ); ?>
                <?php } ?>
              </div>
              <div id="titleerror" class="error" style="width:159px">Title is required.</div>
            </div>
          </div>
        </div>
        <div class="form-cols"><!-- two form cols -->
          <div class="col1" style="width:100%">
            <div class="clearfix file">
              <div class="lab" style="width: 8% !important;">
                <label for="title">Profile Docs  <span class="errorsign">*</span></label>
              </div>
              <div class="con" style="width: 59% !important; float:left">
                <?php if($this->uri->segment(2) == 'add') { ?>
                
				<?php echo form_input( array( 'name'=>'pdf','id'=>'pdf','type'=>'file' ) ); ?>
                <?php } ?>
                <?php if($this->uri->segment(2) == 'edit') { ?>
                
				<?php echo form_input( array( 'name'=>'pdf','id'=>'pdf','type'=>'file' ) ); ?>
                <?php } ?>
              </div>
              <div id="pdferror" class="error" style="width:159px">file is required.</div>
            </div>
          </div>
        </div>
        <div class="btn-submit"> 
          <!-- Submit form -->
          <?php if($this->uri->segment(2) == 'add') { ?>
          <?php echo form_input(array('name'=>'btnsubmit','id'=>'btnsubmit','class'=>'button','type'=>'submit','value'=>'Submit')); ?>
          <?php } ?>
          <?php if($this->uri->segment(2) == 'edit') { ?>
          <?php echo form_input(array('name'=>'btnupdate','id'=>'btnupdate','class'=>'button','type'=>'submit','value'=>'Update')); ?>
          <?php } ?>
          or <a href="<?php echo site_url('pdf');?>" class="Cancel">Cancel</a> </div>
      </fieldset>
      <?php if($this->uri->segment(2) == 'edit') { ?>
      <?php echo form_hidden( array( 'id' => $this->encrypt->encode($pdf[0]['id']) ) ); ?>
      <?php } ?>
      <?php echo form_close(); ?> </div>
  </div>
  <!-- /box-content -->
  
  <?php } 


else { ?>
<?php echo link_tag('colorbox/colorbox.css'); ?> 
  <script language="javascript" type="text/javascript" src="<?php echo base_url();?>colorbox/jquery.colorbox.js"></script> 
  <script language="javascript" type="text/javascript">
  $(document).ready(function(){
		//$('.colorbox').colorbox({'width':'55%'});
		$('.colorbox').colorbox({'width':'60%','height':'70%'});
	
	   	$('#uploadcsv').click(function() {
			$('#divupload').show();
			$('#submitupload').show();
		});
  });
</script> 
  
  <!-- box -->
  <div class="box">
    <div class="headlines">
      <h2><span> Profile Docs </span></h2>
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
    <?php if( count($pdfs) > 0 ) { ?>
    <!-- table -->
    <table class="tab tab-drag">
      <tr class="top nodrop nodrag">
        <th>Title</th>
        <th>Status</th>
        <th>Action</th>
        
      </tr>
      <?php 
	$site = site_url();			
	$url = explode("/admincp",$site);
	$path = $url[0];
	?>
      <?php for($i=0;$i<count($pdfs);$i++) { ?>
      <tr>
        <td><?php echo ucfirst(stripslashes($pdfs[$i]['title'])); ?></td>
        <td><?php if( stripslashes($pdfs[$i]['status']) == 'Enable' ) { ?>
          <a href="<?php echo site_url('pdf/disable/'.$pdfs[$i]['id']);?>" title="Click to Disable" class="btn btn-small btn-success" onClick="return confirm('Are you sure to Disable this pdf?');"><span>Enable</span></a>
          <?php } ?>
          <?php if( stripslashes($pdfs[$i]['status']) == 'Disable' ) { ?>
          <a href="<?php echo site_url('pdf/enable/'.$pdfs[$i]['id']);?>" title="Click to Enable" class="btn btn-small btn-info" style="cursor:default; color: #CD0B1C;" onClick="return confirm('Are you sure to Enable this pdf?');"><span>Disable</span></a>
          <?php } ?></td>
        <td><a href="<?php echo site_url('pdf/edit/'.$pdfs[$i]['id']); ?>" title="Edit" class="ico ico-edit">Edit</a> <a href="<?php echo site_url('pdf/delete/'.$pdfs[$i]['id']);?>" title="Delete" class="ico ico-delete" onClick="return confirm('Are you sure to Delete this pdf?');">Delete</a>
        	<script>
			function PopupCenter(pageURL, title,w,h)
			 {
			  var left = (screen.width/2)-(w/2);
		  	  var top = (screen.height/2)-(h/2);
			  var targetWin = window.open (pageURL, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
  
}
			</script>
            <?php $file =$this->settings->get_setting_value('2').substr($this->config->item('pdf_main_upload_path'),3).$pdfs[$i]['pdf'];?>
            <?php $title = ucfirst(stripslashes($pdfs[$i]['title'])); ?>
            <a style="cursor: pointer;" onclick="PopupCenter('<?php echo $file;?>','<?php echo $title;?>','800','500');" target="_blank">
<img width="16" height="17" border="0" src="images/detail.jpeg" alt="view">
</a>
      
        </td>
        
      </tr>
      <?php } ?>
    </table><?php  if($this->pagination->create_links()) { ?>
    <div class="pagination"> <?php echo $this->pagination->create_links(); ?> </div>
    <?php } ?>
    <!-- /table -->
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
<?php echo $footer; }?>
