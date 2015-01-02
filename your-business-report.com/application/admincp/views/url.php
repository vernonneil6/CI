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
			
			if( trim($("#url").val()) == "" )
			{
				$("#error").attr('style','display:block;');
				$("#urlerror").show();
				$("#url").val('').focus();
				return false;
			}
			else
			{
				$("#urlerror").hide();
				var matches = $("#url").val().match(/^(http[s]?:\/\/){0,1}(www\.){0,1}[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,5}[\.]{0,1}/);
				
				if (matches) 
				{
			    	$("#urlverror").hide();
					$("#urlerror").hide();
				}
				else
				{
					$("#error").attr('style','display:block;');
					$("#urlverror").show();
					$("#url").val('').focus();
					return false;
				}
			}
			
			if( trim($("#siteurl").val()) == "" )
			{
				$("#error").attr('style','display:block;');
				$("#siteurlerror").show();
				$("#siteurl").val('').focus();
				return false;
			}
			else
			{
				$("#siteurlerror").hide();
				var matches = $("#siteurl").val().match(/^(http[s]?:\/\/){0,1}(www\.){0,1}[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,5}[\.]{0,1}/);
				
				if (matches) 
				{
			    	$("#siteurlverror").hide();
					$("#siteurlerror").hide();
				}
				else
				{
					$("#error").attr('style','display:block;');
					$("#siteurlverror").show();
					$("#siteurl").val('').focus();
					return false;
				}
			}
			
			if( $("#frmurl").submit() )
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
      <li><a href="<?php echo site_url('url');?>" title="<?php echo $section_title; ?>"><?php echo $section_title; ?></a></li>
      <li>
        <?php if($this->uri->segment(2) == 'add'){echo 'Add Website';} else if($this->uri->segment(2) == 'edit') {echo 'Edit Website'; }?>
      </li>
    </ul>
  </div>
  <!-- /breadcrumbs -->
  
  <?php if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'add' || $this->uri->segment(2) == 'edit' ) ) { ?>
  
  <!-- box -->
  <div class="box">
    <div class="headlines">
      <h2><span>
        <?php if($this->uri->segment(2) == 'add') { echo "Add Website"; } ?>
        <?php if($this->uri->segment(2) == 'edit') { echo "Edit Website"; } ?>
        </span></h2>
    </div>
    <div class="box-content"> <?php echo form_open_multipart('url/update',array('class'=>'formBox','id'=>'frmurl')); ?>
      <fieldset>
        <div class="form-cols"><!-- two form cols -->
          <div class="col1" style="width:100%">
            <div class="clearfix">
              <div class="lab" style="width: 14% !important;">
                <label for="title">Title<span class="errorsign">*</span></label>
              </div>
              <div class="con" style="width: 59% !important; float:left">
                <?php if($this->uri->segment(2) == 'add') { ?>
                <?php echo form_input( array( 'name'=>'title','id'=>'title','class'=>'input','type'=>'text' ) ); ?>
                <?php } ?>
                <?php if($this->uri->segment(2) == 'edit') { ?>
                <?php echo form_input( array( 'name'=>'title','id'=>'title','class'=>'input','type'=>'text','value'=>stripslashes($url[0]['title']) ) ); ?>
                <?php } ?>
              </div>
              <div id="titleerror" class="error" style="width:145px">title is required.</div>
            </div>
          </div>
        </div>
        <div class="form-cols"><!-- two form cols -->
          <div class="col1" style="width:100%">
            <div class="clearfix">
              <div class="lab" style="width: 14% !important;">
                <label for="url">Domain Name<span class="errorsign">*</span></label>
              </div>
              <div class="con" style="width: 59% !important; float:left">
                <?php if($this->uri->segment(2) == 'add') { ?>
                <?php echo form_input( array( 'name'=>'url','id'=>'url','class'=>'input','type'=>'text' ) ); ?>
                <?php } ?>
                <?php if($this->uri->segment(2) == 'edit') { ?>
                <?php echo form_input( array( 'name'=>'url','id'=>'url','class'=>'input','type'=>'text','value'=>stripslashes($url[0]['url']) ) ); ?>
                <?php } ?>
              </div>
              <div id="urlerror" class="error" style="width:145px">Domain name is required.</div>
              <div id="urlverror" class="error" style="width:145px">Enter valid name.</div>
            </div>
          </div>
        </div>
        <div class="form-cols"><!-- two form cols -->
          <div class="col1" style="width:100%">
            <div class="clearfix">
              <div class="lab" style="width: 14% !important;">
                <label for="siteurl">Site URL<span class="errorsign">*</span></label>
              </div>
              <div class="con" style="width: 59% !important; float:left">
                <?php if($this->uri->segment(2) == 'add') { ?>
                <?php echo form_input( array( 'name'=>'siteurl','id'=>'siteurl','class'=>'input','type'=>'text' ) ); ?>
                <?php } ?>
                <?php if($this->uri->segment(2) == 'edit') { ?>
                <?php echo form_input( array( 'name'=>'siteurl','id'=>'siteurl','class'=>'input','type'=>'text','value'=>stripslashes($url[0]['siteurl']) ) ); ?>
                <?php } ?>
              </div>
              <div id="siteurlerror" class="error" style="width:145px">site url is required.</div>
              <div id="siteurlverror" class="error" style="width:145px">Enter valid url.</div>
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
          or <a href="<?php echo site_url('url');?>" class="Cancel">Cancel</a> </div>
      </fieldset>
      <?php if($this->uri->segment(2) == 'edit') { ?>
      <?php echo form_hidden( array( 'id' => $this->encrypt->encode($url[0]['id']) ) ); ?>
      <?php } ?>
      <?php echo form_close(); ?> </div>
  </div>
  <!-- /box-content -->
  
  <?php } 
else { ?>
  <!-- box -->
  <div class="box">
    <div class="headlines">
      <h2><span> Websites </span></h2>
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
    <?php if( count($urls) > 0 ) { ?>
    <!-- table -->
    <table class="tab tab-drag">
      <tr class="top nodrop nodrag">
        <th>Title</th>
        <th>URL</th>
        
        <th>Action</th>
      </tr>
      <?php for($i=0;$i<count($urls);$i++) { ?>
      <tr>
        <td><?php echo ucfirst(stripslashes($urls[$i]['title'])); ?></td>
        <td><?php echo stripslashes($urls[$i]['url']); ?></td>
        
        <td><a href="<?php echo site_url('url/edit/'.$urls[$i]['id']); ?>" title="Edit" class="ico ico-edit">Edit</a> </td>
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