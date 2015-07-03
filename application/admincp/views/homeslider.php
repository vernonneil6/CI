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
          <div class="lab slider_title_space">
            <label for="title">Slider Text </label>
          </div>
          <div class="con slider_text">
            <?php echo form_textarea( array( 'name'=>'title','id'=>'title','class'=> 'tinymce','style'=>'width:900px')) ; ?>
          </div>
        </div>
	<div class="clearfix file">
          <div class="lab slider_area" > <label for="image">Image</label> <div class = "slider_caption"><label>(Photos must be 1200 x 371 in size)</label></div></div>
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
      <h2><span>Update Slider Image</span></h2>
    </div>
    <div class="box-content">
	<?php echo form_open_multipart('homeslider/edit/'.$id,array('class'=>'formBox')); ?>
	<fieldset>
        <div class="clearfix">
          <div class="lab slider_title_space">
            <label for="title">Title </label>
          </div>
          <div class="con slider_text">
            <?php echo form_textarea( array( 'name'=>'title','id'=>'title','class'=> 'tinymce','style'=>'width:900px','value'=> $title)); ?>
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
        <th>Slider Text</th>
        <th>Image</th>
        <th class="action">Action</th>
      </tr>
      <?php foreach($sliderimage as $sliders){ ?>
      <tr>
        <td><?php echo strip_tags($sliders->title); ?></td>
        <td><img src="../uploads/slider/<?php echo $sliders->image;?>" width="40" height="30" alt="<?php echo $image;?>"></td>
		<td class="action">		  
			<a href="<?php echo site_url('homeslider/delete/'.$sliders->id);?>" title="Delete" class="ico ico-delete" onClick="return confirm('Are you sure to Delete this slider image?');">Delete</a>
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
 <script type="text/javascript" src="<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'] ?>/admincp/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
    selector: "textarea.tinymce",
    theme: "modern",
    plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor colorpicker textpattern"
    ],
    toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
    toolbar2: "print preview media | forecolor backcolor emoticons",
    image_advtab: true,
    templates: [
        {title: 'Test template 1', content: 'Test 1'},
        {title: 'Test template 2', content: 'Test 2'}
    ]
});
</script>
