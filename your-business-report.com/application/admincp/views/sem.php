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
			
			var url =/^(http|https):\/\/[\w\-_]+(\.[\w\-_]+)+([\w\-\.,@?^=%&amp;:\+#]*[\w\-\@?^=%&amp;\+#])?/; 
			if(trim($("#txturl").val()) == "")
			{
				$("#urlerror").show();
				$("#txturl").val('').focus();
				return false;
			}
			else
			{
				if( !url.test(trim($("#txturl").val())))
				{
					$("#urlerror").hide();
					$("#error").attr('style','display:block;');
					$("#urlverror").show();
					$("#txturl").focus();
					return false;
				}
				else
				{
					$("#urlerror").hide();
					$("#urlverror").hide();
				}
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
        <?php if($this->uri->segment(2) == 'add'){echo 'Add SEM';} else if($this->uri->segment(2) == 'edit') {echo 'Edit SEM'; }?>
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
          <div id="urlverror" class="error">Enter valid URL example(https://www.google.co.in/)</div>
        </div>
        <div class="clearfix file">
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
      <?php echo form_hidden( array( 'txtintid' => $this->encrypt->encode($sem[0]['intid']) ) ); ?>
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
      <h2><span><?php echo "SEMs"; ?></span></h2>
    </div>
    <div class="box-content"> <?php echo form_open('sem/searchsem',array('class'=>'formBox','id'=>'frmsearch')); ?>
      <fieldset>
        <!-- Error form message -->
        <div class="form-cols"><!-- two form cols -->
          <div class="col1">
            <div class="clearfix">
              <div class="lab">
                <label for="keysearch">Keyword<span>*</span></label>
              </div>
              <div class="con"> <?php echo form_input( array( 'name'=>'keysearch','id'=>'keysearch','class'=>'input','type'=>'text','placeholder'=>'Search SEM by keyword','value'=>$this->uri->segment(3))); ?> </div>
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
      <?php echo form_close(); ?> </div>
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
	$url = explode("/admincp",$site);
	$path = $url[0];
	?>
      <?php for($i=0;$i<count($sems);$i++) { ?>
      <tr>
        <td><?php echo stripslashes($sems[$i]['title']); ?></td>
        <td><a href="<?php echo stripslashes($sems[$i]['url']); ?>" title="<?php echo stripslashes($sems[$i]['title']); ?>" target="_blank"><?php echo stripslashes($sems[$i]['url']); ?> </a></td>
        <td><?php if(stripslashes($sems[$i]['thumbimg'])!='') { ?>
          <img src="<?php echo $path;?>/uploads/sem/thumb/<?php echo stripslashes($sems[$i]['thumbimg']); ?>" title="<?php echo stripslashes($sems[$i]['title']); ?>" alt="<?php echo stripslashes($sems[$i]['title']); ?>" style="height:45px;width:45px;border:none;" />
          <?php } else { echo "No Image"; } ?></td>
        <td><?php if( stripslashes($sems[$i]['status']) == 'Enable' ) { ?>
          <a href="<?php echo site_url('sem/disable/'.$sems[$i]['intid']);?>" title="Click to Disable" class="btn btn-small btn-success" onClick="return confirm('Are you sure to Disable this SEM?');"><span>Enable</span></a>
          <?php } ?>
          <?php if( stripslashes($sems[$i]['status']) == 'Disable' ) { ?>
          <a href="<?php echo site_url('sem/enable/'.$sems[$i]['intid']);?>" title="Click to Enable" class="btn btn-small btn-info" style="cursor:default; color: #CD0B1C;" onClick="return confirm('Are you sure to Enable this SEM?');"><span>Disable</span></a>
          <?php } ?></td>
        <td><a href="<?php echo site_url('sem/edit/'.$sems[$i]['intid']); ?>" title="Edit" class="ico ico-edit" style="margin:3px 15px 0;">Edit</a></td>
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