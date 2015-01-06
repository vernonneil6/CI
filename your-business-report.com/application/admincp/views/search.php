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
	
			var seofilter  = /^[a-zA-Z0-9_- ]+$/;
			
			if( trim($("#keyword").val()) == "" || !seofilter.test(trim($("#keyword").val())) )
			{
				$("#error").attr('style','display:block;');
				$("#keyworderror").show();
				$("#keyword").val('').focus();
				return false;
			}
			else
			{
				$("#keyworderror").hide();
			}
			
			if( $("#frmsearch").submit() )
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
      <li><a href="<?php echo site_url('search');?>" title="<?php echo $section_title; ?>"><?php echo $section_title; ?></a></li>
      <li>
        <?php if($this->uri->segment(2) == 'add'){echo 'Add Trending Search';} else if($this->uri->segment(2) == 'edit') {echo 'Edit Trending Search'; }?>
      </li>
    </ul>
  </div>
  <!-- /breadcrumbs -->
  
  <?php if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'add' || $this->uri->segment(2) == 'edit' ) ) { ?>
  
  <!-- box -->
  <div class="box">
    <div class="headlines">
      <h2><span>
        <?php if($this->uri->segment(2) == 'add') { echo "Add Trending Search"; } ?>
        <?php if($this->uri->segment(2) == 'edit') { echo "Edit Trending Search"; } ?>
        </span></h2>
    </div>
    <div class="box-content"> <?php echo form_open_multipart('search/update',array('class'=>'formBox','id'=>'frmsearch')); ?>
      <fieldset>
        <div class="form-cols"><!-- two form cols -->
          <div class="col1" style="width:65%">
            <div class="clearfix">
              <div class="lab" style="width:auto">
                <label for="keyword">Search Keyword <span class="errorsign">*</span></label>
              </div>
              <div class="con">
                <?php if($this->uri->segment(2) == 'add') { ?>
                <?php echo form_input( array( 'name'=>'keyword','id'=>'keyword','class'=>'input','type'=>'text' ) ); ?>
                <?php } ?>
                <?php if($this->uri->segment(2) == 'edit') { ?>
                <?php echo form_input( array( 'name'=>'keyword','id'=>'keyword','class'=>'input','type'=>'text','value'=>ucfirst(stripslashes($search[0]['keyword'])) ) ); ?>
                <?php } ?>
              </div>
            </div>
          </div>
          <div id="keyworderror" class="error" style="width:auto">Only 'a-z,A-Z,0-9,-,_, ' allowed characters for Search Keyword.</div>
        </div>
        <div class="btn-submit"> 
          <!-- Submit form -->
          <?php if($this->uri->segment(2) == 'add') { ?>
          <?php echo form_input(array('name'=>'btnsubmit','id'=>'btnsubmit','class'=>'button','type'=>'submit','value'=>'Submit')); ?>
          <?php } ?>
          <?php if($this->uri->segment(2) == 'edit') { ?>
          <?php echo form_input(array('name'=>'btnupdate','id'=>'btnupdate','class'=>'button','type'=>'submit','value'=>'Update')); ?>
          <?php } ?>
          or <a href="<?php echo site_url('search');?>" class="Cancel">Cancel</a> </div>
      </fieldset>
      <?php if($this->uri->segment(2) == 'edit') { ?>
      <?php echo form_hidden( array( 'id' => $this->encrypt->encode($search[0]['id']) ) ); ?>
      <?php } ?>
      <?php echo form_close(); ?> </div>
  </div>
  <!-- /box-content -->
  
  <?php } 
else { ?>
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
      <h2><span><?php echo "Trending Searches"; ?></span></h2>
    </div>
    <div class="box-content"> <?php echo form_open('search/searchsearch',array('class'=>'formBox','id'=>'frmsearch')); ?>
      <fieldset>
        <!-- Error form message -->
        <div class="form-cols"><!-- two form cols -->
          <div class="col1">
            <div class="clearfix">
              <div class="lab">
                <label for="keysearch">Keyword<span>*</span></label>
              </div>
              <div class="con"> 
			  <?php if($this->uri->segment(2)=='searchresult') { 
			  	  	echo form_input( array( 'name'=>'keysearch','id'=>'keysearch','class'=>'input','type'=>'text','placeholder'=>'Search trending search by keyword','value'=>$this->uri->segment(3)));
			  													}
			  		else
			  	{
			  		echo form_input( array( 'name'=>'keysearch','id'=>'keysearch','class'=>'input','type'=>'text','placeholder'=>'Search trending search by keyword' ));
			  }
			  ?>
              
              </div>
            </div>
          </div>
          <div class="col1">
            <div class="clearfix">
             <div><?php echo form_input(array('name'=>'btnsearch','id'=>'btnsearch','class'=>'button','type'=>'submit','value'=>'Search','style'=>'margin-left:15px;')); ?></div>
            </div>
          </div>
          <div id="keysearcherror" style="display:none;" class="error" align="right">Enter Keyword.</div>
        </div>
      </fieldset>
      <?php echo form_close(); ?> 
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
    <?php if( count($searchs) > 0 ) { ?>
    <!-- table -->
    <table class="tab tab-drag">
      <tr class="top nodrop nodrag">
        <th>Keyword</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
      <?php 
	$site = site_url();			
	$url = explode("/admincp",$site);
	$path = $url[0];
	?>
      <?php for($i=0;$i<count($searchs);$i++) { ?>
      <tr>
        <td><?php echo stripslashes($searchs[$i]['keyword']); ?></td>
        <?php /*?>   <td><?php echo stripslashes($searchs[$i]['gender']); ?></td><?php */?>
        <td><?php if( stripslashes($searchs[$i]['status']) == 'Enable' ) { ?>
          <a href="<?php echo site_url('search/disable/'.$searchs[$i]['id']);?>" title="Click to Disable" class="btn btn-small btn-success" onClick="return confirm('Are you sure to Disable this search keyword?');"><span>Enable</span></a>
          <?php } ?>
          <?php if( stripslashes($searchs[$i]['status']) == 'Disable' ) { ?>
          <a href="<?php echo site_url('search/enable/'.$searchs[$i]['id']);?>" title="Click to Enable" class="btn btn-small btn-info" style="color: #CD0B1C;" onClick="return confirm('Are you sure to Enable this search keyword?');"><span>Disable</span></a>
          <?php } ?></td>
        <td><a href="<?php echo site_url('search/edit/'.$searchs[$i]['id']); ?>" title="Edit" class="ico ico-edit">Edit</a> <a href="<?php echo site_url('search/delete/'.$searchs[$i]['id']);?>" title="Delete" class="ico ico-delete" onClick="return confirm('Are you sure to Delete this search keyword?');">Delete</a></td>
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