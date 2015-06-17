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
	
			if( trim($("#category").val()) == "" )
			{
				$("#error").attr('style','display:block;');
				$("#categoryerror").show();
				$("#category").val('').focus();
				return false;
			}
			else
			{
				$("#categoryerror").hide();
			}
			
			<?php if( $this->uri->segment(2) == 'add' ) { ?>
					
			if( trim($("#image").val()) == "" )
			{
				$("#error").attr('style','display:block;');
				$("#imageerror").show();
				$("#image").val('').focus();
				return false;
			}
			else
			{
				$("#imageerror").hide();
			}
			<?php } ?>
			if( $("#frmcategory").submit() )
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
      <li><a href="<?php echo site_url('category');?>" title="<?php echo $section_title; ?>"><?php echo $section_title; ?></a></li>
      <li>
        <?php if($this->uri->segment(2) == 'add'){echo 'Add Business Category';} else if($this->uri->segment(2) == 'edit') {echo 'Edit Business Category'; }?>
      </li>
    </ul>
  </div>
  <!-- /breadcrumbs -->
  
  <?php if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'add' || $this->uri->segment(2) == 'edit' ) ) { ?>
  
  <!-- box -->
  <div class="box">
    <div class="headlines">
      <h2><span>
        <?php if($this->uri->segment(2) == 'add') { echo "Add Business Category"; } ?>
        <?php if($this->uri->segment(2) == 'edit') { echo "Edit Business Category"; } ?>
        </span></h2>
    </div>
    <div class="box-content"> <?php echo form_open_multipart('category/update',array('class'=>'formBox','id'=>'frmcategory')); ?>
      <fieldset>
        <div class="form-cols"><!-- two form cols -->
          <div class="col1" style="width:100%">
            <div class="clearfix">
              <div class="lab" style="width: 18% !important;">
                <label for="category">Category <span class="errorsign">*</span></label>
              </div>
              <div class="con" style="width: 59% !important; float:left">
                <?php if($this->uri->segment(2) == 'add') { ?>
                <?php echo form_input( array( 'name'=>'category','id'=>'category','class'=>'input','type'=>'text' ) ); ?>
                <?php } ?>
                <?php if($this->uri->segment(2) == 'edit') { ?>
                <?php echo form_input( array( 'name'=>'category','id'=>'category','class'=>'input','type'=>'text','value'=>$category[0]['category'] ) ); ?>
                <input type="hidden" name="hiddenimage" value="<?php echo $category[0]['image'];?>"/>
				<?php } ?>
                
              </div>
              <div id="categoryerror" class="error" style="width:159px">Category is required.</div>
            </div>
          </div>
        </div>
        <div class="form-cols"><!-- two form cols -->
          <div class="col1" style="width:100%">
            <div class="clearfix">
              <div class="lab" style="width: 18% !important;">
                <label for="Image">Image <span class="errorsign">*</span></label>
              </div>
              <div class="con" style="width: 59% !important; float:left">
                <?php if($this->uri->segment(2) == 'add') { ?>
                <?php echo form_input( array( 'name'=>'image','id'=>'image','class'=>'input','type'=>'file' ) ); ?>
                <?php } ?>
                <?php if($this->uri->segment(2) == 'edit') { ?>
                <?php echo form_input( array( 'name'=>'image','id'=>'image','class'=>'input','type'=>'file') ); ?>
                <?php } ?>
              </div>
              <div id="imageerror" class="error" style="width:159px">image is required.</div>
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
          or <a href="<?php echo site_url('category');?>" class="Cancel">Cancel</a> </div>
      </fieldset>
      <?php if($this->uri->segment(2) == 'edit') { ?>
      <?php echo form_hidden( array( 'id' => $this->encrypt->encode($category[0]['id']) ) ); ?>
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
      <h2><span>Search Business Category</span></h2>
    </div>
    <div class="box-content"> <?php echo form_open('category/searchcategory',array('class'=>'formBox','id'=>'frmsearch')); ?>
      <fieldset>
        
        <!-- Error form message -->
        
        <div class="form-cols"><!-- two form cols -->
          <div class="col1">
            <div class="clearfix">
              <div class="lab">
                <label for="keysearch">Keyword<span>*</span></label>
              </div>
              <div class="con"> <?php echo form_input( array( 'name'=>'keysearch','id'=>'keysearch','class'=>'input','type'=>'text','placeholder'=>'Search Business Category')); ?> </div>
            </div>
          </div>
          <div id="keysearcherror" style="display:none;" class="error" align="right">Enter Keyword.</div>
        </div>
        <div class="btn-submit"> 
          <!-- Submit form --> 
          <?php echo form_input(array('name'=>'btnsearch','id'=>'btnsearch','class'=>'button','type'=>'submit','value'=>'Search','style'=>'margin-left:-48px;')); ?> or <a href="<?php echo site_url('category');?>" class="Cancel">Cancel</a> </div>
      </fieldset>
      <?php echo form_close(); ?> </div>
  </div>
  <!-- /box-content -->
  <?php } 
else { ?>
  
  <!-- box -->
  <div class="box">
    <div class="headlines">
      <h2><span>Business Categories </span></h2>
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
    <?php //if($this->uri->segment(2) && $this->uri->segment(2)=='searchresult') { ?>
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
    
    <div class="box-content"> <?php echo form_open('category/searchcategory',array('class'=>'formBox','id'=>'frmsearch')); ?>
      <fieldset>
        <!-- Error form message -->
        <div class="form-cols"><!-- two form cols -->
          <div class="col1">
            <div class="clearfix">
              <div class="lab">
                <label for="keysearch">Keyword<span>*</span></label>
              </div>
              <div class="con"> <?php echo form_input( array( 'name'=>'keysearch','id'=>'keysearch','class'=>'input','type'=>'text','placeholder'=>'Search Business Category','value' => '')); ?> </div>
            </div>
          </div>
          <div id="keysearcherror" style="display:none;" class="error" align="right">Enter Keyword.</div>
        </div>
        <div class="btn-submit"> 
          <!-- Submit form --> 
          <?php echo form_input(array('name'=>'btnsearch','id'=>'btnsearch','class'=>'button','type'=>'submit','value'=>'Search','style'=>'margin-left:-48px;')); ?> or <a href="<?php echo site_url('category');?>" class="Cancel">Cancel</a> </div>
            <?php if(!empty($_GET['s']))
			{	   
				echo "<div style='margin-top:1em;'> Search results for <span style='color:#1a2e4d'>' ". $_GET['s'] . " ' </span> </div>";
			}
			
		?>
          
      </fieldset>
      <?php echo form_close(); ?> </div>
    <?php //} ?>
    <?php if( count($categories) > 0 ) { ?>
    <!-- table -->
    
    <table class="tab tab-drag">
		<thead>
			<tr class="top nodrop nodrag">
			<?php foreach($fields as $field_name => $field_display): ?>
			<th <?php if ($sort_by == $field_name) echo "class=\"sort_$sort_order sorttitle \"" ?>>
				<?php 
					if($sort_by == $field_name){ 
						$field_display .= "<img alt='desc' src='".site_url("images/sort_".$sort_order.".gif")."'/>";
					}
				 ?>
				<?php echo anchor("category/index/$field_name/" .
					(($sort_order == 'asc' && $sort_by == $field_name) ? 'desc' : 'asc') ,
					$field_display,array('class' => 'sorttitle')); ?>
			</th>
			
			
			<?php endforeach; ?>
			<th>Action</th>
			</tr>
		</thead>
		
		<tbody>
			<?php foreach($categories as $category): ?>
			<tr>
				<?php foreach($fields as $field_name => $field_display): ?>
				<td>
					<?php
						if ($field_name == 'status' ) { 
							if( $category->$field_name == 'Enable' ){ 
					?>
								<a href="<?php echo site_url('category/disable/'.$category->id);?>" title="Click to Disable" class="btn btn-small btn-success" onClick="return confirm('Are you sure to Disable this user?');"><span><?php echo $category->$field_name; ?></span></a>
								
					<?php 
							}else{ ?>
								
							<a href="<?php echo site_url('category/enable/'.$category->id);?>" title="Click to Enable" class="btn btn-small btn-success" style="cursor:default; color: #CD0B1C;" onClick="return confirm('Are you sure to Enable this user?');"><span><?php echo $category->$field_name; ?></span></a>
						 <?php
							}
						  
						  }else{						
							echo $category->$field_name; 
						  }
					?>	
					
				</td>			
				<?php endforeach; ?>
				<td>
					<a href="<?php echo site_url('category/edit/'.$category->id); ?>" title="Edit" class="ico ico-edit">Edit</a> 					
					<a href="<?php echo site_url('category/delete/'.$category->id);?>" title="Delete" class="ico ico-delete" onClick="return confirm('Are you sure to Delete this user?');">Delete</a>
				</td>
			</tr>
			<?php endforeach; ?>			
		</tbody>
		
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
