<?php echo $heading; ?>
<!-- #content -->

<div id="content">
  <div class="breadcrumbs">
    <ul>
      <li class="home"><a href="<?php echo site_url('dashboard');?>" title="Dashboard">Dashboard</a></li>
      <li><a href="<?php echo site_url('elite');?>" title="<?php echo $section_title; ?>"><?php echo $section_title; ?></a></li>
    </ul>
  </div>

  <div class="box">
    <div class="headlines">
      <h2><span> List of Tutorials</span></h2>
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
    
    <?php if( count($tutorials) > 0 ) { ?>
    <!-- table -->
    <table class="tab tab-drag">
      <tr class="top nodrop nodrag">
        <th>Title</th>
        <th>Type</th>
        <th>File</th>
      </tr>
      <?php for($i=0;$i<count($tutorials);$i++) { ?>
      <tr>
         <td><?php echo ucfirst($tutorials[$i]['title']);?></td>
         <td><?php echo ucfirst($tutorials[$i]['type']);?></td>
         <?php  if($tutorials[$i]['type'] =='pdf' || $tutorials[$i]['type']=='doc') { ?>
		  
		  <td><a href="../uploads/tutorial/<?php echo $tutorials[$i]['file'];?>" title="<?php echo $tutorials[$i]['file'];?>" TARGET="_blank"><?php echo $tutorials[$i]['file'];?></td>	
        
        <?php } else if($tutorials[$i]['type'] =='video') { ?>
        
         <td>
		  <a href="<?php echo $tutorials[$i]['file'];?>" title="<?php echo $tutorials[$i]['file'];?>" TARGET="_blank"><?php echo $tutorials[$i]['file'];?>
         </td>
        
        <?php } else { ?>
		 <td>
		  <a href="../uploads/tutorial/<?php echo $tutorials[$i]['file'];?>" TARGET="_blank"><img src="../uploads/tutorial/<?php echo $tutorials[$i]['file'];?>" width="30" height="30" alt="<?php echo $image;?>"></a>
         </td>
			
		<?php } ?>	
     </tr>
      <?php } ?>
    </table>
    <?php } 
	else { ?>
    <!-- Warning form message -->
    <div class="form-message warning">
      <p>No Tutorials found.</p>
    </div>
    <?php } ?>
  </div>

</div>
<!-- /#content -->
<?php  ?>
<!-- #sidebar -->

<?php include('leftmenu.php'); ?>
<!-- /#sidebar --> 
<!-- #footer --> 
<?php echo $footer; ?> 
