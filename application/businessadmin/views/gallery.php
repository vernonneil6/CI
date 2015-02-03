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
					
			if( $("#frmgallery").submit() )
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
      <li><a href="<?php echo site_url('gallery');?>" title="<?php echo $section_title; ?>"><?php echo $section_title; ?></a></li>
      <li>
        <?php if($this->uri->segment(2) == 'add'){echo 'Add  Galleries';} else if($this->uri->segment(2) == 'edit') {echo 'Edit  Galleries'; }?>
      </li>
      <li> Photos </li>
    </ul>
  </div>
  <!-- /breadcrumbs -->
  
  <?php if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'add' || $this->uri->segment(2) == 'edit' ) ) { ?>
  
  <!-- box -->
  <div class="box">
    <div class="headlines">
      <h2><span>
        <?php if($this->uri->segment(2) == 'add') { echo "Add  Galleries"; } ?>
        <?php if($this->uri->segment(2) == 'edit') { echo "Edit  Galleries"; } ?>
        </span></h2>
    </div>
    <div class="box-content"> <?php echo form_open_multipart('gallery/update',array('class'=>'formBox','id'=>'frmgallery')); ?>
      <fieldset>
        <div class="form-cols"><!-- two form cols -->
          <div class="col1" style="width:100%">
            <div class="clearfix">
              <div class="lab" style="width: 8% !important;">
                <label for="title">Title <span class="errorsign">*</span></label>
              </div>
              <div class="con" style="width: 59% !important; float:left">
                <?php if($this->uri->segment(2) == 'add') { ?>
                <input type="hidden" value="addgallery" name="addgallery">
				<?php echo form_input( array( 'name'=>'title','id'=>'title','class'=>'input','type'=>'text' ) ); ?>
                <?php } ?>
                <?php if($this->uri->segment(2) == 'edit') { ?>
                <input type="hidden" value="editgallery" name="editgallery">
				<?php echo form_input( array( 'name'=>'title','id'=>'title','class'=>'input','type'=>'text','value'=>ucfirst(stripslashes($gallery[0]['title'])) ) ); ?>
                <?php echo form_hidden( array( 'name'=>'editgallery','id'=>'editgallery','type'=>'hidden' ) ); ?>
                <?php } ?>
              </div>
              <div id="titleerror" class="error" style="width:159px">Title is required.</div>
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
          or <a href="<?php echo site_url('gallery');?>" class="Cancel">Cancel</a> </div>
      </fieldset>
      <?php if($this->uri->segment(2) == 'edit') { ?>
      <?php echo form_hidden( array( 'id' => $this->encrypt->encode($gallery[0]['id']) ) ); ?>
      <?php } ?>
      <?php echo form_close(); ?> </div>
  </div>
  <!-- /box-content -->
  
  <?php } 
elseif( $this->uri->segment(2) && ( $this->uri->segment(2) == 'addphotos' ) ) { ?>

  <?php $photos = $this->gallerys->get_photo_bygalleryid($this->uri->segment(3));?>
  <?php $max = count($photos);?>
  <?php $a = 12 - $max ;?>
  
  <script type="text/javascript" language="javascript">
	function trim(stringToTrim) {
		return stringToTrim.replace(/^\s+|\s+$/g,"");
	}
	$(document).ready(function() {
		$("#btnupload").click(function () {
	
			if( $("#userfile").val()=="" )
			{
				$("#error").attr('style','display:block;');
				$("#userfileerror").show();
				$("#userfile").val('').focus();
				return false;
			}
			else 
			{
			    var a = document.getElementById('userfile').files.length;
				var b = <?php echo $a;?>;
				if(a > b)
					{
						if(b!=0)
						{
							alert("You can upload only <?php echo $a;?> images");
							return false;
						}
						else
						{
							alert("You already uploaded 12 images");
							return false;
						}
					}
					else
					{
						if(b==0)
						{
							
						}
						else
						{
							$("#userfileerror").hide();
						}
					}
				}
			
			if( $("#frmupload").submit() )
			{
				$("#error").attr('style','display:none;');
			}
    	});
	
	});
</script> 
  <!-- box -->
  <div class="box">
    <div class="headlines">
      <h2><span>Add Photos</span></h2>
    </div>
    <div class="box-content"> <?php echo form_open_multipart('gallery/update',array('class'=>'formBox','id'=>'frmupload')); ?>
      <fieldset>
        
        <!-- Error form message -->
        
        <div class="form-cols"><!-- two form cols -->
          <div class="col">
            <div class="clearfix file">
              <div class="lab">
                <label for="keysearch">Multiple Photos<span>*</span></label>
              </div>
              <div class="con">
                <input type="file" multiple name="userfile[]" maxlength="5" id="userfile"/>
              <div id="userfileerror" class="error">Select at least one image.</div>
              </div>

            </div>
          </div>
        </div>
        <div class="form-cols"><!-- two form cols -->
          <div class="col">
            <div class="clearfix file">
              <div class="lab">
                <label for="keysearch"><span></span></label>
              </div>
              <div class="con">
                You can add maximum 12 images to a gallery,<br />
                This gallery contain (<?php echo $max;?>) Images

              </div>

            </div>
          </div>
        </div>
        <div class="btn-submit"> 
          <!-- Submit form --> 
          <?php echo form_input(array('name'=>'btnupload','id'=>'btnupload','class'=>'button','type'=>'submit','value'=>'Upload','style'=>'margin-left:-48px;')); ?> or <a href="<?php echo site_url('gallery');?>" class="Cancel">Cancel</a> </div>
      </fieldset>
      <?php if($this->uri->segment(2) == 'addphotos') { ?>
      <?php echo form_hidden( array( 'galleryid' => $this->encrypt->encode($gallery[0]['id']) ) ); ?>
      <?php } ?>
      <?php echo form_close(); ?> </div>
  </div>
  <!-- /box-content -->
  <?php } 
  elseif( $this->uri->segment(2) && ( $this->uri->segment(2) == 'viewphotos' ) ) { ?>
  
  <!-- box -->
  <div class="box">
    <div class="headlines">
      <h2><span><?php echo $section_title;?>'s photos</span></h2>
    </div>
    <div class="box-content">
      <?php for($i=0;$i<count($photo);$i++) { ?>
      <a href="<?php echo site_url('gallery/deletephoto/'.$photo[$i]['id']);?>" title="Delete Photo" onClick="return confirm('Are you sure to Delete this photo?');"> <img width="200" height="200" src="<?php if( $photo[$i]['photo'] ){ echo $this->settings->get_setting_value('2').substr($this->config->item('gallery_main_upload_path'),3);?><?php echo stripslashes($photo[$i]['photo']); } else{echo $this->settings->get_setting_value('2').substr($this->config->item('gallery_main_upload_path'),3)."/no-image.gif"; } ?>" alt="<?php echo stripslashes($photo[$i]['photo']); ?>"  style="padding:10px;border:3px solid #DFDFDF"/> </a>
      <?php } ?>
    </div>
  </div>
  <!-- /box-content -->
  <?php } 
else { ?>
  
  <!-- box -->
  <div class="box">
    <div class="headlines">
      <h2><span> Galleries </span></h2>
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
    <?php if( count($gallerys) > 0 ) { ?>
    <!-- table -->
    <table class="tab tab-drag">
      <tr class="top nodrop nodrag">
        <th>Title</th>
        <!--        <th>Detail</th>-->
        <th>Status</th>
        <th>Action</th>
        <th>Photos</th>
      </tr>
      <?php 
	$site = site_url();			
	$url = explode("/admincp",$site);
	$path = $url[0];
	?>
      <?php for($i=0;$i<count($gallerys);$i++) { ?>
      <tr>
        <td><?php echo ucfirst(stripslashes($gallerys[$i]['title'])); ?></td>
        <td><?php if( stripslashes($gallerys[$i]['status']) == 'Enable' ) { ?>
          <a href="<?php echo site_url('gallery/disable/'.$gallerys[$i]['id']);?>" title="Click to Disable" class="btn btn-small btn-success" onClick="return confirm('Are you sure to Disable this gallery?');"><span>Enable</span></a>
          <?php } ?>
          <?php if( stripslashes($gallerys[$i]['status']) == 'Disable' ) { ?>
          <a href="<?php echo site_url('gallery/enable/'.$gallerys[$i]['id']);?>" title="Click to Enable" class="btn btn-small btn-info" style="cursor:default; color: #CD0B1C;" onClick="return confirm('Are you sure to Enable this gallery?');"><span>Disable</span></a>
          <?php } ?></td>
        <td><a href="<?php echo site_url('gallery/edit/'.$gallerys[$i]['id']); ?>" title="Edit" class="ico ico-edit">Edit</a> <a href="<?php echo site_url('gallery/delete/'.$gallerys[$i]['id']);?>" title="Delete" class="ico ico-delete" onClick="return confirm('Are you sure to Delete this gallery?');">Delete</a></td>
        <td><a href="<?php echo site_url('gallery/addphotos/'.$gallerys[$i]['id']);?>" title="Add Photos"><span> <img width="16" height="17" border="0" src="images/Add-icon.png" alt="view"> </span></a>
          <?php $numphoto = $this->gallerys->get_photo_bygalleryid($gallerys[$i]['id']);?>
          <?php if(count($numphoto)>0) {?>
          <a href="<?php echo site_url('gallery/viewphotos/'.$gallerys[$i]['id']);?>" title="View Photos"><span><img width="16" height="17" border="0" src="images/detail.jpeg" alt="view"></span></a>
          <?php } else { ?>
          <img width="16" height="17" border="0" src="images/detail.jpeg" alt="view" style="cursor:pointer;" title="no photos"></span>
          <?php } ?></td>
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
