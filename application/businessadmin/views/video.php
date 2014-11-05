<?php echo $header; ?>
<!-- #content -->

<div id="content">
  <?php if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'edit' ) ) { ?>
  <script type="text/javascript" language="javascript">
	function trim(stringToTrim) {
		return stringToTrim.replace(/^\s+|\s+$/g,"");
	}
	$(document).ready(function() {
		
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
			
			if( trim($("#videourl").val()) == "" )
			{
				$("#error").attr('style','display:block;');
				$("#videourlerror").show();
				$("#videovurlerror").hide();
				$("#videourl").val('').focus();
				return false;
			}
			else
			{
				$("#videourlerror").hide();
				var matches = $("#videourl").val().match(/http:\/\/(?:www\.)?youtube.*watch\?v=([a-zA-Z0-9\-_]+)/);
				if (matches) 
				{
			    } 
				else
				{
				   $("#error").attr('style','display:block;');
				   $("#videovurlerror").show();
				   $("#videourl").val('').focus();
				   return false;
				}
			}
				
			
			if( $("#frmvideo").submit() )
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
      <li><a href="<?php echo site_url('video');?>" title="<?php echo $section_title; ?>"><?php echo $section_title; ?></a></li>
      <li>
        <?php if($this->uri->segment(2) == 'edit') {echo 'Edit video'; }?>
      </li>
    </ul>
  </div>
  <!-- /breadcrumbs -->
  
  <?php if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'edit' ) ) { ?>
  <!-- box -->
  <div class="box">
    <div class="headlines">
      <h2><span>
        <?php if($this->uri->segment(2) == 'edit') { echo "Edit video"; } ?>
        </span></h2>
    </div>
    <div class="box-content"> <?php echo form_open('video/update',array('class'=>'formBox','id'=>'frmvideo')); ?>
      <fieldset>
        <div class="clearfix">
          <div class="lab">
            <label for="title">Title <span class="errorsign">*</span></label>
          </div>
          <div class="con">
            <?php if($this->uri->segment(2) == 'add') { ?>
            <?php echo form_input( array( 'name'=>'title','id'=>'title','class'=>'input','type'=>'text' ) ); ?>
            <?php } ?>
            <?php if($this->uri->segment(2) == 'edit') { ?>
            <?php echo form_input( array( 'name'=>'title','id'=>'title','class'=>'input','type'=>'text','value'=>stripslashes($video[0]['title']) )); ?>
            <?php } ?>
          </div>
          <div id="titleerror" class="error" style="width:auto">title is required.</div>
        </div>
        <div class="clearfix">
          <div class="lab">
            <label for="videourl">videourl <span class="errorsign">*</span></label>
          </div>
          <div class="con">
            <?php if($this->uri->segment(2) == 'add') { ?>
            <?php echo form_input( array( 'name'=>'videourl','id'=>'videourl','class'=>'input','type'=>'text','placeholder'=>'just enter youtube video url'));?>
            <?php } ?>
            <?php if($this->uri->segment(2) == 'edit') { ?>
            <?php echo form_input( array( 'name'=>'videourl','id'=>'videourl','class'=>'input','type'=>'text','value'=>stripslashes($video[0]['videourl']),'placeholder'=>'just enter youtube video url'));?>
            <?php } ?>
          </div>
          <div id="videourlerror" class="error" style="width:auto">videourl is required.</div>
          <div id="videovurlerror" class="error" style="width:auto">Invalid url please enter valid url.</div>
        </div>
        <div class="btn-submit"> 
          <!-- Submit form -->
          <?php if($this->uri->segment(2) == 'edit') { ?>
          <?php echo form_input(array('name'=>'btnupdate','id'=>'btnupdate','class'=>'button','type'=>'submit','value'=>'Update')); ?>
          <?php } ?>
          or <a href="<?php echo site_url('video');?>" class="Cancel">Cancel</a> </div>
      </fieldset>
      <?php if($this->uri->segment(2) == 'edit') { ?>
      <?php echo form_hidden( array( 'id' => $this->encrypt->encode($video[0]['id']) ) ); ?>
      <?php echo form_hidden( array( 'videono' => $video[0]['videono'] ) ); ?>
      <?php } ?>
      <?php echo form_close(); ?> </div>
  </div>
  <!-- /box-content -->
  
  <?php } 


 else if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'addvideo' ) ) { ?>
  <!-- box -->
  <div class="box">
    <div class="headlines">
      <h2><span><?php  echo "Add video";  ?> </span></h2>
    </div>
    <div class="box-content"> <?php echo form_open('video/addvideo',array('class'=>'formBox','id'=>'frmvideo')); ?>
      <fieldset>
        <div class="clearfix">
          <div class="lab">
            <label for="title">Title <span class="errorsign">*</span></label>
          </div>
          <div class="con">
            <?php echo form_input( array( 'name'=>'addtitle','id'=>'addtitle','class'=>'input','type'=>'text' ) ); ?>
          </div>
          <div id="titleerror" class="error" style="width:auto">title is required.</div>
        </div>
        <div class="clearfix">
          <div class="lab">
            <label for="videourl">videourl <span class="errorsign">*</span></label>
          </div>
          <div class="con">
            	<?php echo form_input( array( 'name'=>'addvideourl','id'=>'addvideourl','class'=>'input','type'=>'text','placeholder'=>'enter youtube video url'));?>
          </div>
          <div id="videourlerror" class="error" style="width:auto">videourl is required.</div>
          <div id="videovurlerror" class="error" style="width:auto">Invalid url please enter valid url.</div>
        </div>
          <?php echo form_input(array('name'=>'addbtn','id'=>'addbtn','class'=>'button','type'=>'submit','value'=>'Add')); ?>
          or <a href="<?php echo site_url('video');?>" class="Cancel">Cancel</a>
      </fieldset>
      <?php echo form_close(); ?> </div>
  </div>
  <!-- /box-content -->
  
  <?php } else { ?>
  <div class="box">
    <div class="headlines">
      <h2><span><?php echo 'videos'; ?></span></h2>
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
    <?php if( count($videos) > 0 ) { ?>
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
        <th width="40%">Title</th>
        <th width="40%">Videourl</th>
        <th width="7%">Status</th>
        <th width="13%">Action</th>
      </tr>
      <?php for($i=0;$i<count($videos);$i++) { ?>
      <tr>
        <td><?php echo stripslashes($videos[$i]['title']); ?></td>
        <td><?php echo substr(stripslashes($videos[$i]['videourl']),0,100)."..."; ?></td>
        <td><?php if( stripslashes($videos[$i]['status']) == 'Enable' ) { ?>
          <a href="<?php echo site_url('video/disable/'.$videos[$i]['id']);?>" title="Click to Disable" class="btn btn-small btn-success" onClick="return confirm('Are you sure to Disable this video?');" style="cursor:pointer">Enable</a>
          <?php } ?>
          <?php if( stripslashes($videos[$i]['status']) == 'Disable' ) { ?>
          <a href="<?php echo site_url('video/enable/'.$videos[$i]['id']);?>" title="Click to Enable" class="btn btn-small btn-info" style="cursor:pointer" onClick="return confirm('Are you sure to Enable this video?');"><span style="color: #CD0B1C;">Disable</span></a>
          <?php } ?></td>
        <td style="padding: 8px 4px;"><a href="<?php echo site_url('video/edit/'.$videos[$i]['id']); ?>" title="Edit" class="ico ico-edit">Edit</a></td>
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