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
			
			/*if( $("#percentage").val() == 0 )
			{
				$("#error").attr('style','display:block;');
				$("#percentageerror").show();
				$("#percentage").val('').focus();
				return false;
			}
			else
			{
				$("#percentageerror").hide();
			}*/
					
			if( $("#frmdiscount").submit() )
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
      <li><a href="<?php echo site_url('discount');?>" title="<?php echo $section_title; ?>"><?php echo $section_title; ?></a></li>
      <li>
        <?php if($this->uri->segment(2) == 'add'){echo 'Add discount';} else if($this->uri->segment(2) == 'edit') {echo 'Edit discount'; }?>
      </li>
    </ul>
  </div>
  <!-- /breadcrumbs -->
  
  <?php if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'add' || $this->uri->segment(2) == 'edit' ) ) { ?>
  
  <!-- box -->
  <div class="box">
    <div class="headlines">
      <h2><span>
        <?php if($this->uri->segment(2) == 'add') { echo "Add  discount"; } ?>
        <?php if($this->uri->segment(2) == 'edit') { echo "Edit  discount"; } ?>
        </span></h2>
    </div>
    <div class="box-content"> <?php echo form_open('discount/update',array('class'=>'formBox','id'=>'frmdiscount')); ?>
      <fieldset>
        <div class="form-cols"><!-- two form cols -->
          <div class="col1" style="width:100%">
            <div class="clearfix">
              <div class="lab" style="width: 9% !important;">
                <label for="title">Discount Title<span class="errorsign">*</span></label>
              </div>
              <div class="con" style="width: 59% !important; float:left">
                <?php if($this->uri->segment(2) == 'add') { ?>
                <?php echo form_input( array( 'name'=>'title','id'=>'title','class'=>'input','type'=>'text' ) ); ?>
                <?php } ?>
                <?php if($this->uri->segment(2) == 'edit') { ?>
                <?php echo form_input( array( 'name'=>'title','id'=>'title','class'=>'input','type'=>'text','value'=>$discount[0]['title'] ) ); ?>
                <?php } ?>
              </div>
              <div id="titleerror" class="error" style="width:145px">Title is required.</div>
            </div>
          </div>
        </div>
        <div class="form-cols"><!-- two form cols -->
          <div class="col1" style="width:100%">
            <div class="clearfix">
              <div class="lab" style="width: 9% !important;">
                <label for="percentage">Percentage</label>
              </div>
              <div class="con" style="width: 59% !important; float:left">
                <?php $dis = range(0,100);
                      $dis[0]="Select";
    				  $js = "id='percentage' class='select' placeholder='Select'";
					  ?>
				<?php if($this->uri->segment(2) == 'add') { ?>
                
				<?php echo form_dropdown('percentage',$dis,'0',$js);?>
                <?php } ?>
                <?php if($this->uri->segment(2) == 'edit') { ?>
                <?php echo form_dropdown('percentage',$dis,$discount[0]['percentage'],$js);?>
                <?php } ?>
              </div>
              <div id="percentageerror" class="error" style="width:145px">Select percentage.</div>
            </div>
          </div>
        </div>
        <div class="form-cols">
          <div class="col1">
            <div class="clearfix">
              <div class="lab">
                <label for="trial">30 day free trial<span class="errorsign">*</span></label>
              </div>
              <div>
                <?php if($this->uri->segment(2) == 'add') { ?>
                <?php echo form_radio(array('name'=>'discountmethod','type'=>'radio','id'=>'radyes','class'=>'input','value'=>'1','style'=>'float:none;width:5% !important')); ?>
                <label for="radyes">Yes</label>
                <?php echo form_radio(array('name'=>'discountmethod','type'=>'radio','id'=>'radno','class'=>'input','value'=>'0','checked'=>'checked','style'=>'float:none;width:5% !important')); ?>
                <label for="radno">No</label>
                <?php } ?>
                <?php if($this->uri->segment(2) == 'edit') { ?>
                <?php if($discount[0]['discountcodetype'] == '30-days-free-trial'){?>
                <?php echo form_radio(array('name'=>'discountmethod','type'=>'radio','id'=>'radyes','class'=>'input','value'=>'1','checked'=>'checked','style'=>'float:none;width:3% !important'));  } else { ?> <?php echo form_radio(array('name'=>'discountmethod','type'=>'radio','id'=>'radyes','class'=>'input','value'=>'1','style'=>'float:none;width:3% !important')); ?>
                <?php } ?>
                <label for="radyes">Yes</label>
                <?php if($discount[0]['discountcodetype'] == 'normal-discount'){?>
                <?php echo form_radio(array('name'=>'discountmethod','type'=>'radio','id'=>'radno','class'=>'input','value'=>'0','checked'=>'checked','style'=>'float:none;width:3% !important')); } else { ?> <?php echo form_radio(array('name'=>'discountmethod','type'=>'radio','id'=>'radno','class'=>'input','value'=>'0','style'=>'float:none;width:3% !important')); ?>
                <?php } ?>
                <label for="radyes">No</label>
                <?php } ?>
              </div>
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
          or <a href="<?php echo site_url('discount');?>" class="Cancel">Cancel</a> </div>
      </fieldset>
      <?php if($this->uri->segment(2) == 'edit') { ?>
      <?php echo form_hidden( array( 'id' => $this->encrypt->encode($discount[0]['id']) ) ); ?>
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
      <h2><span>Search  discount</span></h2>
    </div>
    <div class="box-content"> <?php echo form_open('discount/searchdiscount',array('class'=>'formBox','id'=>'frmsearch')); ?>
      <fieldset>
        
        <!-- Error form message -->
        
        <div class="form-cols"><!-- two form cols -->
          <div class="col1">
            <div class="clearfix">
              <div class="lab">
                <label for="keysearch">Keyword<span>*</span></label>
              </div>
              <div class="con"> <?php echo form_input( array( 'name'=>'keysearch','id'=>'keysearch','class'=>'input','type'=>'text','placeholder'=>'Search  discount')); ?> </div>
            </div>
          </div>
          <div id="keysearcherror" style="display:none;" class="error" align="right">Enter Keyword.</div>
        </div>
        <div class="btn-submit"> 
          <!-- Submit form --> 
          <?php echo form_input(array('name'=>'btnsearch','id'=>'btnsearch','class'=>'button','type'=>'submit','value'=>'Search','style'=>'margin-left:-48px;')); ?> or <a href="<?php echo site_url('discount');?>" class="Cancel">Cancel</a> </div>
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
	   } else { echo "Discounts"; } ?>
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
    
    <div class="box-content"> <?php echo form_open('discount/searchdiscount',array('class'=>'formBox','id'=>'frmsearch')); ?>
      <fieldset>
        <!-- Error form message -->
        <div class="form-cols"><!-- two form cols -->
          <div class="col1">
            <div class="clearfix">
              <div class="lab">
                <label for="keysearch">Keyword<span>*</span></label>
              </div>
              <div class="con"> <?php echo form_input( array( 'name'=>'keysearch','id'=>'keysearch','class'=>'input','type'=>'text','placeholder'=>'Search  discount','value' => $this->uri->segment(3))); ?> </div>
      </div>
     </div>
     <div id="keysearcherror" style="display:none;" class="error" align="right">Enter Keyword.</div>
    </div>
    <div class="btn-submit"> 
     <!-- Submit form --> 
     <?php echo form_input(array('name'=>'btnsearch','id'=>'btnsearch','class'=>'button','type'=>'submit','value'=>'Search','style'=>'margin-left:-48px;')); ?> or <a href="<?php echo site_url('discount');?>" class="Cancel">Cancel</a> </div>
      </fieldset>
      <?php echo form_close(); ?> </div>
    <?php } ?>
    <?php if( count($discounts) > 0 ) { ?>
    <!-- table -->
    <style>
    .tab th, .tab td
    { padding: 8px 25px!important}
    </style>
    <table class="tab tab-drag">
      <tr class="top nodrop nodrag">
        <th>Description</th>
        <th>Code</th>
        <th>Discount(%)</th>
        <th>Discount Type</th>
        <th>Apply</th>
        <th>Revised Price</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
      <?php for($i=0;$i<count($discounts);$i++) { ?>
      <tr>
        <td><?php echo ucfirst(stripslashes($discounts[$i]['title'])); ?></td>
        <td><?php echo stripslashes($discounts[$i]['code']); ?></td>
        <td><?php echo stripslashes($discounts[$i]['percentage']); ?></td>
        <td><?php echo stripslashes($discounts[$i]['discountcodetype']); ?></td>
        <td>
			<?php if($discounts[$i]['apply']==1){ echo "Worked";?>
			<?php } else if($discounts[$i]['apply']==2) { echo "Not Used ";?>
			<?php } else { echo "Not Working";}?>
		</td>
        <td><?php echo "$".stripslashes($discounts[$i]['discountprice']); ?></td>
        <td><?php if( stripslashes($discounts[$i]['status']) == 'Enable' ) { ?>
          <a href="<?php echo site_url('discount/disable/'.$discounts[$i]['id']);?>" title="Click to Disable" class="btn btn-small btn-success" onClick="return confirm('Are you sure to Disable this discount?');"><span>Enable</span></a>
          <?php } ?>
          <?php if( stripslashes($discounts[$i]['status']) == 'Disable' ) { ?>
          <a href="<?php echo site_url('discount/enable/'.$discounts[$i]['id']);?>" title="Click to Enable" class="btn btn-small btn-info" style="cursor:default; color: #CD0B1C;" onClick="return confirm('Are you sure to Enable this discount?');"><span>Disable</span></a>
          <?php } ?></td>
        <td><a href="<?php echo site_url('discount/edit/'.$discounts[$i]['id']); ?>" title="Edit" class="ico ico-edit">Edit</a> <a href="<?php echo site_url('discount/delete/'.$discounts[$i]['id']);?>" title="Delete" class="ico ico-delete" onClick="return confirm('Are you sure to Delete this discount?');">Delete</a></td>
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
