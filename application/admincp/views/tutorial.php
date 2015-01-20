<?php echo $header; ?>

<div id="content">
  <div class="breadcrumbs">
    <ul>
      <li class="home"><a href="<?php echo site_url('dashboard');?>" title="Dashboard">Dashboard</a></li>
      <li><a href="<?php echo site_url('tutorial');?>" title="<?php echo $section_title; ?>"><?php echo $section_title; ?></a></li>
      <li>
        <?php if($this->uri->segment(2) == 'add'){echo 'Add tutorial';} else if($this->uri->segment(2) == 'edit') {echo 'Update tutorial'; }?>
      </li>
    </ul>
  </div>

  <?php if( $this->uri->segment(2) && $this->uri->segment(2) == 'add' ) { ?>
	  
<script type="text/javascript">
$(document).ready(function() {
$('#filetype').change(function(){
	if($('#filetype').val() == 'video'){
	   $('#videos').show(); 
	   $('#uploader').hide();
	} else {
	   $('#videos').hide();
	   $('#uploader').show(); 
	   }
});
});
</script>
 	  
  
  <div class="box">
    <div class="headlines">
      <h2><span>Add Elite Admin tutorial</span></h2>
    </div>
    <div class="box-content">
	<?php echo form_open_multipart('tutorial/add',array('class'=>'formBox')); ?>
	 <fieldset>
	  <div class="clearfix">
          <div class="lab">
            <label for="zone">File Type <span class="errorsign">*</span></label>
          </div>
          <div class="con">
            <?php $types = array(''=>'Select','pdf'=>'PDF','image'=>'Image','doc'=>'Doc','video'=>'Video');?>
			<?php if($this->uri->segment(2) == 'add') { ?>

            <?php $types = array(''=>'Select','pdf'=>'PDF','image'=>'Image','doc'=>'Doc','video'=>'Video');?>
            <?php echo form_dropdown('filetype',$types,'Select',"id='filetype' class='select'"); ?>
            
            <?php } ?>
            <?php if($this->uri->segment(2) == 'edit') { ?>

            <?php $types = array(''=>'Select','pdf'=>'PDF','image'=>'Image','doc'=>'Doc','video'=>'Video');?>
            <?php echo form_dropdown('filetype',$types,"id='filetype' class='select'"); ?>
            <?php } ?>
          </div>
     </div>	 
    <div class="clearfix">
          <div class="lab">
            <label for="title">Title </label>
          </div>
          <div class="con slider_text">
            <?php echo form_input( array('name'=>'title','class'=>'input','type'=>'text','placeholder'=>'Enter Title here') ); ?>
          </div>
    </div>
    <div class="clearfix" id="videos" style="display:none">
          <div class="lab">
            <label for="title">Video url</label>
          </div>
          <div class="con slider_text">
            <?php echo form_input( array( 'name'=>'videourl','id'=>'videourl','class'=>'input','type'=>'text','placeholder'=>'Enter youtube video url here'));?>
          </div>
    </div>
	<div class="clearfix file" id="uploader">
          <div class="lab slider_area" > <label for="image">Upload</label> </div>
          <div class="con slider_upload"> <?php echo form_input( array( 'name'=>'images','class'=>'input file upload-file','type'=>'file') ); ?> </div>
        </div>
        <?php echo form_input(array('name'=>'submitimage','class'=>'button','type'=>'submit','value'=>'Add')); ?>
      </fieldset>
	
	<?php echo form_close(); ?>
    </div>
  </div>
  
  <?php } elseif( $this->uri->segment(2) && $this->uri->segment(2) == 'edit' ) { ?>

  <div class="box">
    <div class="headlines">
      <h2><span>Update Elite Admin tutorial</span></h2>
    </div>
    <div class="box-content">
	<?php echo form_open_multipart('tutorial/edit/'.$id,array('class'=>'formBox')); ?>
	<fieldset>
        <div class="clearfix">
          <div class="lab">
            <label for="title">Title </label>
          </div>
          <div class="con">
            <?php echo form_input( array( 'name'=>'title','class'=>'input','type'=>'text' ,'value'=> $title)); ?>
            <?php echo form_input( array( 'name'=>'filetype','class'=>'input','type'=>'hidden','value'=> $type)); ?>
          </div>
        </div>
	<div class="clearfix file">
          
          <?php if($type !='video') { ?>
			  
			  <div class="lab" style="width:13%"> <label for="image">Upload <?php echo ucfirst($type);?></label> </div>
			  <div class="con" style="width:40%; float:left"> <?php echo form_input( array( 'name'=>'images','id'=>'images','class'=>'input file upload-file','type'=>'file') ); ?> <input type="hidden" value="<?php echo $file;?>" name="hiddenimage"></div>
			  <div class="con slider_text" style="width:70%; float:left"><br><a href="<?php echo $file;?>" style="font-size: 15px;margin-left: 28%;"><?php echo $file;?></a> </div>
		      
		  <?php } else { ?>
			  <div class="lab" style="width:13%"> <label for="image">Video Url</label> </div>
			  <div class="con slider_text" style="width:40%; float:left">
			   <?php echo form_input( array('name'=>'videourl','id'=>'videourl','class'=>'input','type'=>'text' ,'value'=>$file ) ); ?>
              </div> 
        <?php } ?>
        </div>
        <br>
        <?php echo form_input(array('name'=>'submitimage','class'=>'button','type'=>'submit','value'=>'Update')); ?> or <a href="<?php echo site_url('tutorial');?>" class="Cancel">Cancel</a>
      </fieldset>
	<?php echo form_close(); ?>
    </div>
  </div>

<?php }
else { ?>

  <div class="box">
    <div class="headlines">
      <h2><span><?php echo "List of Elite Admin Tutorials" ?></span></h2>
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

<?php if( count($tutorial) > 0 ) { ?>
    <!-- table -->
    <table class="tab tab-drag">
      <tr class="top nodrop nodrag">
        <th>Title</th>
        <th>Type</th>
        <th>File</th>
        <th>status</th>
        <th class="action">Action</th>
      </tr>
      <?php foreach($tutorial as $sliders){ ?>
     <tr>
        <td><?php echo ucfirst($sliders->title); ?></td>
        <td><?php echo ucfirst($sliders->type); ?></td>
        <?php  if($sliders->type =='pdf' || $sliders->type =='doc') { ?>
			<td><a href="../uploads/tutorial/<?php echo $sliders->file;?>" title="<?php echo $sliders->file;?>" TARGET="_blank"><?php echo $sliders->file;?></td>	
		
		<?php } else if($sliders->type =='video'){ ?>
					<td>
					  <a href="<?php echo $sliders->file;?>" title="<?php echo $sliders->file;?>" TARGET="_blank"><?php echo $sliders->file;?>
					</td>
			<?php } else { ?>	
					<td>
					  <a href="../uploads/tutorial/<?php echo $sliders->file;?>" TARGET="_blank"><img src="../uploads/tutorial/<?php echo $sliders->file;?>" width="30" height="30" alt="<?php echo $image;?>"></a>
					</td>
            <?php } ?>
        <td>
			<?php if($sliders->status=='Enable') {?>
			
			<a href="<?php echo site_url('tutorial/disable/'.$sliders->id);?>" title="Click to Disable" class="btn btn-small btn-success" onClick="return confirm('Are you sure to Disable this tutorial?');"><span>Enable</span></a>
		    
		    <?php } else { ?>
			
			<a href="<?php echo site_url('tutorial/enable/'.$sliders->id);?>" title="Click to Enable" class="btn btn-small btn-info" style="cursor:default; color: #CD0B1C;" onClick="return confirm('Are you sure to Enable this tutorial?');"><span>Disable</span></a>
			<?php } ?>	
		</td>
		<td class="action">		  
			<a href="<?php echo site_url('tutorial/delete/'.$sliders->id);?>" title="Delete" class="ico ico-delete" onClick="return confirm('Are you sure to Delete this tutorial file?');">Delete</a>
			<a href="<?php echo site_url('tutorial/edit/'.$sliders->id); ?>" title="Edit" class="ico ico-edit">Edit</a>
		</td>
      </tr>
      <?php } ?>
    </table>
    <!-- /table -->
<?php } else { ?>
	
	<table class="tab tab-drag">
      <tr class="top nodrop nodrag">
        <th>Title</th>
        <th>Image</th>
        <th class="action">Action</th>
      </tr>
      <tr>
       <td>No Tutorials available.</td>
      
      </tr>
      
      </table>
	
<?php } ?>	

  </div>
<?php } ?>
</div>

<?php include('leftmenu.php'); ?>
<?php echo $footer; ?>
