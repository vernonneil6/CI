<?php echo $header; ?>

<div id="content">
  <div class="breadcrumbs">
    <ul>
      <li class="home"><a href="<?php echo site_url('dashboard');?>" title="Dashboard">Dashboard</a></li>
      <li><a href="<?php echo site_url('homeslider');?>" title="<?php echo $section_title; ?>"><?php echo $section_title; ?></a></li>
      <li>
        <?php if($this->uri->segment(2) == 'add'){echo 'Add Slider Image';} else if($this->uri->segment(2) == 'edit') {echo 'Update Slider Image'; }?>
      </li>
    </ul>
  </div>

  <?php if( $this->uri->segment(2) && $this->uri->segment(2) == 'add' ) { ?>
  
  <div class="box">
    <div class="headlines">
      <h2><span>Add Slider Image</span></h2>
    </div>
    <div class="box-content">
	<?php echo form_open_multipart('homeslider/add',array('class'=>'formBox')); ?>
	 <fieldset>
        <div class="clearfix">
          <div class="lab">
            <label for="title">Title </label>
          </div>
          <div class="con">
            <?php echo form_input( array( 'name'=>'title','class'=>'input','type'=>'text' ) ); ?>
          </div>
        </div>
	<div class="clearfix file">
          <div class="lab" style="width:13%"> <label for="image">Image</label> </div>
          <div class="con" style="width:40%; float:left"> <?php echo form_input( array( 'name'=>'images','class'=>'input file upload-file','type'=>'file') ); ?> </div>
        </div>
        <?php echo form_input(array('name'=>'submitimage','class'=>'button','type'=>'submit','value'=>'Add')); ?>
      </fieldset>
	
	<?php echo form_close(); ?>
    </div>
  </div>
  
  <?php } elseif( $this->uri->segment(2) && $this->uri->segment(2) == 'edit' ) { ?>

  <div class="box">
    <div class="headlines">
      <h2><span>Update Slider Image</span></h2>
    </div>
    <div class="box-content">
	<?php echo form_open_multipart('homeslider/edit/'.$id,array('class'=>'formBox')); ?>
	<fieldset>
        <div class="clearfix">
          <div class="lab">
            <label for="title">Title </label>
          </div>
          <div class="con">
            <?php echo form_input( array( 'name'=>'title','class'=>'input','type'=>'text' ,'value'=> $title) ); ?>
          </div>
        </div>
	<div class="clearfix file">
          <div class="lab" style="width:13%"> <label for="image">Image</label> </div>
          <div class="con" style="width:40%; float:left"> <?php echo form_input( array( 'name'=>'images','class'=>'input file upload-file','type'=>'file') ); ?> <input type="hidden" value="<?php echo $image;?>" name="hiddenimage"></div>
          <div class="task-photo"><img src="../uploads/slider/<?php echo $image;?>" width="50" height="40" alt="<?php echo $image;?>"></div>
        </div>
        <?php echo form_input(array('name'=>'submitimage','class'=>'button','type'=>'submit','value'=>'Update')); ?>
      </fieldset>
	<?php echo form_close(); ?>
    </div>
  </div>

<?php }
else { ?>

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

<?php if( count($sliderimage) > 0 ) { ?>
    <!-- table -->
    <table class="tab tab-drag">
      <tr class="top nodrop nodrag">
        <th>Title</th>
        <th>Image</th>
        <th class="action">Action</th>
      </tr>
      <?php foreach($sliderimage as $sliders){ ?>
      <tr>
        <td><?php echo $sliders->title; ?></td>
        <td><img src="../uploads/slider/<?php echo $sliders->image;?>" width="40" height="30" alt="<?php echo $image;?>"></td>
	<td class="action">
		  
		  <a href="<?php echo site_url('homeslider/delete/'.$sliders->id);?>" title="Delete" class="ico ico-delete" onClick="return confirm('Are you sure to Delete this FAQ?');">Delete</a>
<a href="<?php echo site_url('homeslider/edit/'.$sliders->id); ?>" title="Edit" class="ico ico-edit">Edit</a>
	</td>
      </tr>
      <?php } ?>
    </table>
    <!-- /table -->
<?php } ?>

  </div>
<?php } ?>
</div>

<?php include('leftmenu.php'); ?>
<?php echo $footer; ?>
