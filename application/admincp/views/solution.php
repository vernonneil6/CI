<?php if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'view' ) ) { ?>
<!-- box -->

<div class="box">
  <div class="headlines">
    <h2><span>Business Solution Detail</span></h2>
  </div>
  <!-- table -->
  <table align="center" width="100%" cellspacing="10" cellpadding="0" border="0">
    <?php if( count($solution)>0 ) { ?>
    <tr>
      <td width="120"><b>Title</b></td>
      <td><b>:</b></td>
      <td><?php echo stripslashes($solution[0]['title']); ?></td>
    </tr>
    <tr>
      <td width="120" valign="top"><b>Detail</b></td>
      <td valign="top"><b>:</b></td>
      <td <?php if($solution[0]['detail'] != ''){?>style="text-align:justify; background:#EEEEEE;vertical-align:top" <?php } ?>colspan="3"><?php echo nl2br(stripslashes($solution[0]['detail'])); ?></td>
    </tr>
    <tr>
      <td width="120" valign="top"><b>Image</b></td>
      <td valign="top"><b>:</b></td>
      <td> <?php if($solution[0]['image'] != ''){?><img src="<?php echo $site_url.'uploads/solution/thumb/'.$solution[0]['image'];?>" />
	  
      <?php } ?>
      </td>
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
else { ?>
<?php echo $header; ?> <?php echo link_tag('colorbox/colorbox.css'); ?> 
<script language="javascript" type="text/javascript" src="<?php echo base_url();?>colorbox/jquery.colorbox.js"></script> 
<script language="javascript" type="text/javascript">
  $(document).ready(function(){
		//$('.colorbox').colorbox({'width':'55%'});
	    $('.colorbox').colorbox({'width':'60%','height':'65%'});
		/*$('.colorbox').colorbox({ 
			onComplete : function() { 
			   $(this).colorbox.resize();
			}
		});*/
  });
</script> 
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
					
			if( $("#frmsolution").submit() )
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
      <li><a href="<?php echo site_url('solution');?>" title="<?php echo $section_title; ?>"><?php echo $section_title; ?></a></li>
      <li>
        <?php if($this->uri->segment(2) == 'add'){echo 'Add Business Solution';} else if($this->uri->segment(2) == 'edit') {echo 'Edit Business Solution'; }?>
      </li>
    </ul>
  </div>
  <!-- /breadcrumbs -->
  
  <?php if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'add' || $this->uri->segment(2) == 'edit' ) ) { ?>
  
  <!-- box -->
  <div class="box">
    <div class="headlines">
      <h2><span>
        <?php if($this->uri->segment(2) == 'add') { echo "Add Business Solution"; } ?>
        <?php if($this->uri->segment(2) == 'edit') { echo "Edit Business Solution"; } ?>
        </span></h2>
    </div>
    <div class="box-content"> <?php echo form_open_multipart('solution/update',array('class'=>'formBox','id'=>'frmsolution')); ?>
      <fieldset>
        <div class="form-cols"><!-- two form cols -->
          <div class="col1" style="width:100%">
            <div class="clearfix">
              <div class="lab" style="width: 8% !important;">
                <label for="title">Title <span class="errorsign">*</span></label>
              </div>
              <div class="con" style="width: 59% !important; float:left">
                <?php if($this->uri->segment(2) == 'add') { ?>
                <?php echo form_input( array( 'name'=>'title','id'=>'title','class'=>'input','type'=>'text' ) ); ?>
                <?php } ?>
                <?php if($this->uri->segment(2) == 'edit') { ?>
                <?php echo form_input( array( 'name'=>'title','id'=>'title','class'=>'input','type'=>'text','value'=>ucfirst(stripslashes($solution[0]['title'])) ) ); ?>
                <?php } ?>
              </div>
              <div id="titleerror" class="error" style="width:159px">Title is required.</div>
            </div>
          </div>
        </div>
        <div class="form-cols"><!-- two form cols -->
          <div class="col1" style="width:100%">
            <div class="clearfix">
              <div class="lab" style="width: 8% !important;">
                <label for="image">Image</label>
                </div>
                              <div class="con" style="width: 59% !important; float:left">
                <?php if($this->uri->segment(2) == 'add') { ?>
                <?php echo form_input( array( 'name'=>'image','id'=>'image','class'=>'input','type'=>'file' ) ); ?>
                <?php } ?>
                <?php if($this->uri->segment(2) == 'edit') { ?>
                <?php echo form_input( array( 'name'=>'image','id'=>'image','class'=>'input','type'=>'file' ) ); ?>
                <input type="hidden" name="solutionhiddenimage" id="solutionhiddenimage" value="<?php echo stripslashes($solution[0]['image']);?>"/>
                <?php } ?>
              </div>
              
            </div>
          </div>
        </div>

        <div class="clearfix">
          <div class="lab" style="float:none; padding-bottom:5px;">
            <label for="detail">Detail <!--<span class="errorsign">*</span>--></label>
          </div>
          <div class="con" style="float:none; width:99%">
            <?php 
		if($this->uri->segment(2) == 'add') {
		echo form_textarea( array( 'name'=>'detail','id'=>'detail','class'=> 'cleditor','style'=>'width:900px' ) );
		echo display_ckeditor($ckeditor);
		 } ?>
            <?php if($this->uri->segment(2) == 'edit') {
		echo form_textarea( array( 'name'=>'detail','id'=>'detail','class'=> 'cleditor','value'=> stripslashes($solution[0]['detail']),'style'=>'width:900px' ) );
		echo display_ckeditor($ckeditor);
		?>
            <?php } ?>
          </div>
          <div id="detailerror" class="error">Detail is required.</div>
        </div>
        <div class="btn-submit"> 
          <!-- Submit form -->
          <?php if($this->uri->segment(2) == 'add') { ?>
          <?php echo form_input(array('name'=>'btnsubmit','id'=>'btnsubmit','class'=>'button','type'=>'submit','value'=>'Submit')); ?>
          <?php } ?>
          <?php if($this->uri->segment(2) == 'edit') { ?>
          <?php echo form_input(array('name'=>'btnupdate','id'=>'btnupdate','class'=>'button','type'=>'submit','value'=>'Update')); ?>
          <?php } ?>
          or <a href="<?php echo site_url('solution');?>" class="Cancel">Cancel</a> </div>
      </fieldset>
      <?php if($this->uri->segment(2) == 'edit') { ?>
      <?php echo form_hidden( array( 'id' => $this->encrypt->encode($solution[0]['id']) ) ); ?>
      <?php } ?>
      <?php echo form_close(); ?> </div>
  </div>
  <!-- /box-content -->
  
  <?php } 
elseif( $this->uri->segment(2) && ( $this->uri->segment(2) == 'search' ) ) { ?>
  <script type="text/javascript" language="javascript">
	function trim(stringToTrim) {
		return stringToTrim.replace(/^\s+|\s+$/g,"");
	}
	$(document).ready(function() {
		$("#btnsearch").click(function () {
	
			if( trim($("#keysearch").val()) == "" )
			{
				$("#error").attr('style','display:block;');
				$("#keysearcherror").show();
				$("#keysearch").val('').focus();
				return false;
			}
			else
			{
				$("#keysearcherror").hide();
			}
			
			if( $("#frmsearch").submit() )
			{
				$("#error").attr('style','display:none;');
			}
    	});
	
	});
</script> 
  <!-- box -->
  <div class="box">
    <div class="headlines">
      <h2><span>Search Business Solution</span></h2>
    </div>
    <div class="box-content"> <?php echo form_open('solution/searchsolution',array('class'=>'formBox','id'=>'frmsearch')); ?>
      <fieldset>
        
        <!-- Error form message -->
        
        <div class="form-cols"><!-- two form cols -->
          <div class="col1">
            <div class="clearfix">
              <div class="lab">
                <label for="keysearch">Keyword<span>*</span></label>
              </div>
              <div class="con"> <?php echo form_input( array( 'name'=>'keysearch','id'=>'keysearch','class'=>'input','type'=>'text','placeholder'=>'Search Business Solution')); ?> </div>
            </div>
          </div>
          <div id="keysearcherror" style="display:none;" class="error" align="right">Enter Keyword.</div>
        </div>
        <div class="btn-submit"> 
          <!-- Submit form --> 
          <?php echo form_input(array('name'=>'btnsearch','id'=>'btnsearch','class'=>'button','type'=>'submit','value'=>'Search','style'=>'margin-left:-48px;')); ?> or <a href="<?php echo site_url('solution');?>" class="Cancel">Cancel</a> </div>
      </fieldset>
      <?php echo form_close(); ?> </div>
  </div>
  <!-- /box-content -->
  <?php } 
else { ?>
  
  <!-- box -->
  <div class="box">
    <div class="headlines">
      <h2><span>
        <?php if($this->uri->segment(2) && $this->uri->segment(2)=='searchresult')
	   {
	   	?>
        search results for '<?php echo $this->uri->segment(3);?>'
        <?php
	   } else { echo "Business Solutions"; } ?>
        </span></h2>
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
    <?php if($this->uri->segment(2) && $this->uri->segment(2)=='searchresult') { ?>
    <script type="text/javascript" language="javascript">
	function trim(stringToTrim) {
		return stringToTrim.replace(/^\s+|\s+$/g,"");
	}
	$(document).ready(function() {
		$("#btnsearch").click(function () {
	
			if( trim($("#keysearch").val()) == "" )
			{
				$("#error").attr('style','display:block;');
				$("#keysearcherror").show();
				$("#keysearch").val('').focus();
				return false;
			}
			else
			{
				$("#keysearcherror").hide();
			}
			
			if( $("#frmsearch").submit() )
			{
				$("#error").attr('style','display:none;');
			}
    	});
	
	});
</script> 
    <!-- box -->
    
    <div class="box-content"> <?php echo form_open('solution/searchsolution',array('class'=>'formBox','id'=>'frmsearch')); ?>
      <fieldset>
        <!-- Error form message -->
        <div class="form-cols"><!-- two form cols -->
          <div class="col1">
            <div class="clearfix">
              <div class="lab">
                <label for="keysearch">Keyword<span>*</span></label>
              </div>
              <div class="con"> <?php echo form_input( array( 'name'=>'keysearch','id'=>'keysearch','class'=>'input','type'=>'text','placeholder'=>'Search Business Solution','value' => $this->uri->segment(3))); ?> </div>
            </div>
          </div>
          <div id="keysearcherror" style="display:none;" class="error" align="right">Enter Keyword.</div>
        </div>
        <div class="btn-submit"> 
          <!-- Submit form --> 
          <?php echo form_input(array('name'=>'btnsearch','id'=>'btnsearch','class'=>'button','type'=>'submit','value'=>'Search','style'=>'margin-left:-48px;')); ?> or <a href="<?php echo site_url('solution');?>" class="Cancel">Cancel</a> </div>
      </fieldset>
      <?php echo form_close(); ?> </div>
    <?php } ?>
    <?php if( count($solutions) > 0 ) { ?>
    <!-- table -->
    <table class="tab tab-drag">
      <tr class="top nodrop nodrag">
        <th>Title</th>
        <!--        <th>Detail</th>-->
        <th>Status</th>
        <th>Action</th>
      </tr>
      <?php 
	$site = site_url();			
	$url = explode("/admincp",$site);
	$path = $url[0];
	?>
      <?php for($i=0;$i<count($solutions);$i++) { ?>
      <tr>
        <td><a href="<?php echo site_url('solution/view/'.$solutions[$i]['id']); ?>" title="View Detail of <?php echo stripslashes($solutions[$i]['title']);?>" class="colorbox" style="color: #404040;"><?php echo ucfirst(stripslashes($solutions[$i]['title'])); ?></a></td>
        <?php /*?> <td align="justify"><?php echo nl2br(stripslashes($solutions[$i]['detail'])); ?></td><?php */?>
        <td><?php if( stripslashes($solutions[$i]['status']) == 'Enable' ) { ?>
          <a href="<?php echo site_url('solution/disable/'.$solutions[$i]['id']);?>" title="Click to Disable" class="btn btn-small btn-success" onClick="return confirm('Are you sure to Disable this solution?');"><span>Enable</span></a>
          <?php } ?>
          <?php if( stripslashes($solutions[$i]['status']) == 'Disable' ) { ?>
          <a href="<?php echo site_url('solution/enable/'.$solutions[$i]['id']);?>" title="Click to Enable" class="btn btn-small btn-info" style="cursor:default; color: #CD0B1C;" onClick="return confirm('Are you sure to Enable this solution?');"><span>Disable</span></a>
          <?php } ?></td>
        <td><a href="<?php echo site_url('solution/edit/'.$solutions[$i]['id']); ?>" title="Edit" class="ico ico-edit">Edit</a> <a href="<?php echo site_url('solution/delete/'.$solutions[$i]['id']);?>" title="Delete" class="ico ico-delete" onClick="return confirm('Are you sure to Delete this solution?');">Delete</a> <a href="<?php echo site_url('solution/view/'.$solutions[$i]['id']); ?>" title="View Detail of <?php echo stripslashes($solutions[$i]['title']);?>" class="colorbox"><img width="16" height="17" border="0" src="images/detail.jpeg" alt="view"></a></td>
      </tr>
      <?php } ?>
     
    </table>
    <!-- /pagination -->
	<?php  if($this->pagination->create_links()) { ?>
	<div class="pagination"> <?php echo $this->pagination->create_links(); ?> </div>
	<?php } ?>
	<!-- /pagination -->
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
<?php } ?>
