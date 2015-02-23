<?php echo $header; ?>

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
	
			if( trim($("#txttitle").val()) == "" )
			{
				$("#error").attr('style','display:block;');
				$("#titleerror").show();
				$("#txttitle").val('').focus();
				return false;
			}
			else
			{
				$("#titleerror").hide();
			}
			
			if( trim($("#txturl").val()) == "" )
			{
				$("#error").attr('style','display:block;');
				$("#urlerror").show();
				$("#txturl").val('').focus();
				return false;
			}
			else
			{
				$("#urlerror").hide();
			}
			
			<?php if( $this->uri->segment(2) != 'edit' ) { ?>
			if( trim($("#logoimage").val()) == "" )
			{
				$("#error").attr('style','display:block;');
				$("#logoerror").show();
				$("#logoimage").val('').focus();
				return false;
			}
			else
			{
				$("#logoerror").hide();
			}
			<?php } ?>
			
			if( $("#frmsem").submit() )
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
      <li><a href="<?php echo site_url('sem');?>" title="<?php echo $section_title; ?>"><?php echo $section_title; ?></a></li>
      <li>
        <?php if($this->uri->segment(2) == 'add'){echo 'Add Social Media';} else if($this->uri->segment(2) == 'edit') {echo 'Edit Social Media'; }?>
      </li>
    </ul>
  </div>
  <!-- /breadcrumbs -->
  
  <?php if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'add' || $this->uri->segment(2) == 'edit' ) ) { ?>
  
  <!-- box -->
  <div class="box">
    <div class="headlines">
      <h2><span>
        <?php if($this->uri->segment(2) == 'add') { echo "Add ".$section_title; } ?>
        <?php if($this->uri->segment(2) == 'edit') { echo "Edit ".$section_title; } ?>
        </span></h2>
    </div>
    <div class="box-content"> <?php echo form_open_multipart('sem/update',array('class'=>'formBox','id'=>'frmsem')); ?>
      <fieldset>
        <div class="form-cols"><!-- two form cols -->
          <div class="col1" style="width:60%">
            <div class="clearfix">
              <div class="lab" style="width:17%">
                <label for="txttitle">Title <span class="errorsign">*</span></label>
              </div>
              <div class="con" style="width:80%">
                <?php if($this->uri->segment(2) == 'add') { ?>
                <?php echo form_input( array( 'name'=>'txttitle','id'=>'txttitle','class'=>'input','type'=>'text' ) ); ?>
                <?php } ?>
                <?php if($this->uri->segment(2) == 'edit') { ?>
                <?php echo form_input( array( 'name'=>'txttitle','id'=>'txttitle','class'=>'input','type'=>'text','value'=>stripslashes($sem[0]['title']) ) ); ?>
                <?php } ?>
              </div>
            </div>
          </div>
          <div id="titleerror" class="error">Title is required.</div>
        </div>
        <div class="form-cols">
          <div class="col1" style="width:60%">
            <div class="clearfix">
              <div class="lab" style="width:17%">
                <label for="txturl">URL <span class="errorsign">*</span></label>
              </div>
              <div class="con" style="width:80%">
                <?php if($this->uri->segment(2) == 'add') { ?>
                <?php echo form_input( array( 'name'=>'txturl','id'=>'txturl','class'=>'input','type'=>'text' ) ); ?>
                <?php } ?>
                <?php if($this->uri->segment(2) == 'edit') { ?>
                <?php echo form_input( array( 'name'=>'txturl','id'=>'txturl','class'=>'input','type'=>'text','value'=>stripslashes($sem[0]['url']) ) ); ?>
                <?php } ?>
              </div>
            </div>
          </div>
          <div id="urlerror" class="error">URL is required.</div>
        </div>
        <div class="clearfix file" style = "display:none;">
          <div class="lab" style="width:17%">
            <label for="logoimage">Upload Logo</label>
          </div>
          <div class="con" style="width:44%; float:left"> <?php echo form_input( array( 'name'=>'logoimage','id'=>'logoimage','class'=>'input file upload-file','type'=>'file','style'=>'width: 95% !important') ); ?> </div>
          <div id="logoerror" class="error">Logo is required.</div>
        </div>
        <div class="btn-submit"> 
          <!-- Submit form -->
          <?php if($this->uri->segment(2) == 'add') { ?>
          <?php echo form_input(array('name'=>'btnsubmit','id'=>'btnsubmit','class'=>'button','type'=>'submit','value'=>'Submit')); ?>
          <?php } ?>
          <?php if($this->uri->segment(2) == 'edit') { ?>
          <?php echo form_input(array('name'=>'btnupdate','id'=>'btnupdate','class'=>'button','type'=>'submit','value'=>'Update')); ?>
          <?php } ?>
          or <a href="<?php echo site_url('sem');?>" class="Cancel">Cancel</a> </div>
      </fieldset>
      <?php if($this->uri->segment(2) == 'edit') { ?>
      <?php echo form_hidden( array( 'txtintid' => $this->encrypt->encode($sem[0]['id']) ) ); ?>
      <?php echo form_hidden( array( 'type' => $sem[0]['type'] ) ); ?>
      <?php } ?>
      <?php echo form_close(); ?> </div>
  </div>
  <!-- /box-content -->
  
  <?php } 
else { ?>
  
  <!-- box -->
  <div class="box">
    <div class="headlines">
      <h2><span><?php echo "Social Media"; ?></span></h2>
    </div>
    <div class = "review_para">You can view and edit the social media account here. You can add URL to the social media account and also can enable it, So that it can be viewed at the front end of the Profile page in YouGotRated.com website(show publicly in YouGotRated).</div>
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
    <?php if( count($sems) > 0 ) { ?>
    <style>
		.tab td {
			padding: 8px 30px;
		}
		.tab th {
			padding: 8px 30px;
		}
	</style>
    <!-- table -->
    <table class="tab tab-drag">
      <tr class="top nodrop nodrag">
        <th>Title</th>
        <th>URL</th>
        <th>Logo</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
      <?php 
	$site = site_url();			
	$url = explode("/businessadmin",$site);
	$path = $url[0];
	?>
      <?php for($i=0;$i<count($sems);$i++) { ?>
      <tr>
        <td><?php echo stripslashes($sems[$i]['title']); ?></td>
        <td><a href="<?php echo stripslashes($sems[$i]['url']); ?>" title="<?php echo stripslashes($sems[$i]['title']); ?>" target="_blank"><?php echo stripslashes($sems[$i]['url']); ?> </a></td>
        <td><?php if(stripslashes($sems[$i]['thumbimg'])!='') { ?>
			<?php if($sems[$i]['title']=='ebay') {?>
             <img src="<?php echo $path;?>/uploads/companysem/thumb/<?php echo stripslashes($sems[$i]['thumbimg']); ?>" title="<?php echo stripslashes($sems[$i]['title']); ?>" alt="<?php echo stripslashes($sems[$i]['title']); ?>" style="height:25px;width:40px;border:none;" />
          <?php } else { ?>
             <img src="<?php echo $path;?>/uploads/companysem/thumb/<?php echo stripslashes($sems[$i]['thumbimg']); ?>" title="<?php echo stripslashes($sems[$i]['title']); ?>" alt="<?php echo stripslashes($sems[$i]['title']); ?>" style="height:40px;width:40px;border:none;" />
          <?php } ?>
          <?php } else { echo "No Image"; } ?></td>
        <td><?php if( stripslashes($sems[$i]['status']) == 'Enable' ) { ?>
          <a href="<?php echo site_url('sem/disable/'.$sems[$i]['id']);?>" title="Click to Disable" class="btn btn-small btn-success" onClick="return confirm('Are you sure to Disable this SEM?');"><span>Enabled</span></a>
          <?php } ?>
          <?php if( stripslashes($sems[$i]['status']) == 'Disable' ) { ?>
          <a href="<?php echo site_url('sem/enable/'.$sems[$i]['id']);?>" title="Click to Enable" class="btn btn-small btn-info" style="cursor:default; color: #CD0B1C;" onClick="return confirm('Are you sure to Enable this SEM?');"><span>Disabled</span></a>
          <?php } ?></td>
        <td><a href="<?php echo site_url('sem/edit/'.$sems[$i]['id']); ?>" title="Edit" class="ico ico-edit" style="margin:3px 15px 0;">Edit</a></td>
      </tr>
      <?php } ?>
    </table>
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
<?php echo $footer; ?>
