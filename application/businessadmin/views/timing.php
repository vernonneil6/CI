<?php echo $header; ?>
<!-- #content -->

<div id="content">
  <?php if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'edit' ) ) { ?>
  <link rel="stylesheet" href="<?php echo base_url();?>js/datetimepicker/style.css" type="text/css" media="all" />
  <!--<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js"></script>--> 
  <script src="<?php echo base_url();?>js/jquery-ui.min.js"></script> 
  <script src="<?php echo base_url();?>js/datetimepicker/jquery-ui-timepicker-addon.js"></script> 
  <!--  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">-->
  <link href="<?php echo base_url();?>js/datetimepicker/jquery-ui.css" rel="stylesheet" type="text/css" media="screen" />
  <script type="text/javascript" language="javascript">
	function trim(stringToTrim) {
		return stringToTrim.replace(/^\s+|\s+$/g,"");
	}
	$(document).ready(function() {		
		$('.time').timepicker({});
		$("#btnupdate").click(function () {
			if( $("#frmtiming").submit() )
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
      <li><a href="<?php echo site_url('timing');?>" title="<?php echo $section_title; ?>"><?php echo $section_title; ?></a></li>
      <li>
        <?php if($this->uri->segment(2) == 'edit') {echo 'Edit Hours'; }?>
      </li>
    </ul>
  </div>
  <!-- /breadcrumbs -->
  
  <?php if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'edit' ) ) { ?>
  <!-- box -->
  <div class="box">
    <div class="headlines">
      <h2><span>
        <?php if($this->uri->segment(2) == 'edit') { echo "Edit Hours"; } ?>
        </span></h2>
    </div>
    <div class="box-content"> <?php echo form_open('timing/update',array('class'=>'formBox','id'=>'frmtiming')); ?>
      <?php if( count($timings) > 0 ) { ?>
      <?php for($i=0;$i<count($timings);$i++) {   ?>
      <fieldset>
        <div class="form-cols">
          <div class="col1">
            <div class="clearfix">
              <div class="lab">
                <label for="title"><?php echo ucfirst($timings[$i]['daytype']);?> <span class="errorsign">*</span></label>
              </div>
              <div class="con"> <?php echo form_input( array( 'name'=>'start'.$i,'id'=>'start','class'=>'input time','type'=>'text','value'=>stripslashes($timings[$i]['start']) )); ?></div>
             <input name="day<?php echo $i;?>" value="<?php echo ($timings[$i]['daytype']);?>" type="hidden" />
             <input name="id<?php echo $i;?>" value="<?php echo ($timings[$i]['id']);?>" type="hidden" />
            </div>
          </div>
          <div class="col1">
            <div class="clearfix">
              <div class="lab">
                
              </div>
              <div class="con"> <?php echo form_input( array( 'name'=>'end'.$i,'id'=>'end','class'=>'input time','type'=>'text','readonly'=>'readonly','value'=>stripslashes($timings[$i]['end']) )); ?> </div>
              
            </div>
          </div>
        </div>
        <div class="form-cols">
          <div class="col1">
            <div class="clearfix">
              <div class="lab">
                <label for="timingurl">Off <span class="errorsign">*</span></label>
              </div>
              <div class="con">
                <?php $array = array('Yes'=>'Yes','No'=>'No');?>
                <?php echo form_dropdown('off'.$i,$array,$timings[$i]['off'],'class="select"');?> </div>
            </div>
          </div>
        </div>
      </fieldset>
      <?php } ?>
      <div class="btn-submit"> 
        <!-- Submit form --> 
        
        <?php echo form_input(array('name'=>'btnupdate','id'=>'btnupdate','class'=>'button','type'=>'submit','value'=>'Update')); ?> or <a href="<?php echo site_url('timing');?>" class="Cancel">Cancel</a> </div>
      <?php } ?>
      <?php echo form_close(); ?> </div>
  </div>
  <!-- /box-content -->
  
  <?php } else { ?>
  <div class="box">
    <div class="headlines">
      <h2><span><?php echo 'Hours'; ?></span></h2>
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
    <?php if( count($timings) > 0 ) { ?>
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
        <th width="40%">Day</th>
        <th width="40%">Timing</th>
        <th width="7%">Off</th>
        <th width="13%">Action</th>
      </tr>
      <?php for($i=0;$i<count($timings);$i++) { ?>
      <tr>
        <td><?php echo ucfirst(stripslashes($timings[$i]['daytype'])); ?></td>
        <td><?php echo date("h:i A,",strtotime(stripslashes($timings[$i]['start']))); ?>
         <?php echo date("h:i A,",strtotime(stripslashes($timings[$i]['end']))); ?></td>
        <td><?php echo stripslashes($timings[$i]['off']); ?></td>
        <td style="padding: 8px 4px;"><a href="<?php echo site_url('timing/edit/'); ?>" title="Edit" class="ico ico-edit">Edit</a></td>
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
