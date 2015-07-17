<?php echo $header; ?>

<div id="content">
  <div class="breadcrumbs">
    <ul>
      <li class="home"><a href="<?php echo site_url('dashboard');?>" title="Dashboard">Dashboard</a></li>
      <li><a href="<?php echo site_url('homelogoslider');?>" title="<?php echo $section_title; ?>"><?php echo $section_title; ?></a></li>
      <li>
        <?php if($this->uri->segment(2) == 'add'){echo 'Add Logo Slider Image';} else if($this->uri->segment(2) == 'edit') {echo 'Update Logo Slider Image'; }?>
      </li>
    </ul>
  </div>
<!--Add Logo Slider-->
<?php if( $this->uri->segment(2) && $this->uri->segment(2) == 'add' ) { ?>
	
	 <div class="box">
    <div class="headlines">
      <h2><span>Add Logo Slider Image</span></h2>
    </div>
    <div class="box-content">
	<?php echo form_open_multipart('homelogoslider/add',array('class'=>'formBox')); ?>
	 <fieldset>
        <div class="clearfix">
			<div class="lab">
            <label for="zone">Zone <span class="errorsign">*</span></label>
          </div>
          <div class="con">
          
            <?php $zones = array(''=>'Select','top'=>'Top','bottom'=>'Bottom');?>
            <?php echo form_dropdown('zone',$zones,'Select',"id='zone' class='select'"); ?>
          </div>
          <div id="zoneerror" class="error" style="width:auto">Select Zone.</div>
			
		</div>
		<div class="clearfix file">
          <div class="lab slider_area" > <label for="image">Image</label> <div class = "slider_caption"><label>(Photos must be 400 x 400 in size)</label></div></div>
          <div class="con slider_upload"> <?php echo form_input( array( 'name'=>'images','class'=>'input file upload-file','type'=>'file') ); ?> </div>
        </div>
        <?php echo form_input(array('name'=>'submitlogoimage','class'=>'button','type'=>'submit','value'=>'Add')); ?>
      </fieldset>
      <?php echo form_close(); ?>
    </div>
  </div>
  
  <?php } elseif( $this->uri->segment(2) && $this->uri->segment(2) == 'edit' ) { ?>
	  
	   <div class="box">
    <div class="headlines">
      <h2><span>Update Logo Slider Image</span></h2>
    </div>
    <div class="box-content">
	<?php echo form_open_multipart('homelogoslider/edit/'.$id,array('class'=>'formBox')); ?>
	<fieldset>
        <div class="clearfix">
          <div class="lab slider_title_space">
            <label for="title">Zone <span class="errorsign">*</span></label>
          </div>
         
          <div class="con slider_text">
           <?php $zones = array(''=>'Select','top'=>'Top','bottom'=>'Bottom');?>
            <?php echo form_dropdown('zone',$zones,stripslashes($zone),"id='zone' class='select'"); ?>
          </div>
        </div>
	<div class="clearfix file">
          <div class="lab" style="width:13%"> <label for="image">Image</label> </div>
          <div class="con" style="width:40%; float:left"> <?php echo form_input( array( 'name'=>'images','class'=>'input file upload-file','type'=>'file') ); ?> <input type="hidden" value="<?php echo $logoimages;?>" name="hiddenimage"></div>
          <div class="task-photo"><img src="../uploads/logoslider/<?php echo $logoimages;?>" width="50" height="40" alt="<?php echo $logoimages;?>"></div>
        </div>
        <?php echo form_input(array('name'=>'submitlogoimage','class'=>'button','type'=>'submit','value'=>'Update')); ?>
      </fieldset>
	<?php echo form_close(); ?>
    </div>
  </div>
  <?php }else { ?>
	   <div class="box">
    <div class="headlines">
      <h2><span><?php echo "Home Page Slider" ?></span></h2>
    </div>
    <div class="box-content"> </div>
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

<?php if( count($logosliderimage) > 0 ) { ?>
    <!-- table -->
    <table class="tab tab-drag">
      <tr class="top nodrop nodrag">
        <th>Slider Text</th>
        <th>Image</th>
        <th class="action">Action</th>
      </tr>
      <?php foreach($logosliderimage as $sliders){ ?>
      <tr>
        <td><?php echo strip_tags($sliders->zone); ?></td>
        <td><img src="../uploads/logoslider/<?php echo $sliders->image;?>" width="40" height="30" alt="<?php echo $image;?>"></td>
		<td class="action">		  
			<a href="<?php echo site_url('homelogoslider/delete/'.$sliders->id);?>" title="Delete" class="ico ico-delete" onClick="return confirm('Are you sure to Delete this slider image?');">Delete</a>
			<a href="<?php echo site_url('homelogoslider/edit/'.$sliders->id); ?>" title="Edit" class="ico ico-edit">Edit</a>
		</td>
      </tr>
      <?php } ?>
    </table>
    <!-- /table -->
<?php } else{ ?>
<table class="tab tab-drag">
			<tr >
				<th align="center">No Records Found</th>
		  <tr> </table><?php }?>
</div>
<?php } ?>
</div>
	  
<?php include('leftmenu.php'); ?>
<?php echo $footer; ?>	
