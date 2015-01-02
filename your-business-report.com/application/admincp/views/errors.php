<?php echo $header; ?>

<!-- #content -->

<div id="content"> 
  
  <!-- breadcrumbs -->
  <div class="breadcrumbs">
    <ul>
      <li class="home">
      <a href="<?php echo site_url('errors');?>"><?php echo $section_title;?></a> 
      </li>
    </ul>
  </div>
  <!-- /breadcrumbs --> 
  
  <!-- box -->
  <div class="box">
    <div class="headlines">
      <h2><span>Error Logs</span></h2>
    </div>


    <div class="heading">
      
   <div class="button">
            <a href="<?php echo site_url('errors/clear');?>" style="float:none;"><span class="btn btn-primary btn-medium">Clear Log</span></a>
          </div>
    </div>
    <div class="boxcontent" style="height:200px;">
     
          <?php if(($this->session->userdata['youg_admin'])){?>
<textarea wrap="off" style="padding: 5px; border: 1px solid #CCCCCC; background: #FFFFFF; overflow: scroll;margin-top:5px;width:99%" class="textarea" rows="15"><?php echo $log; ?></textarea>
    
        <?php }?>
         

    </div>


  </div>
  <!-- /box --> 
  
</div>
<!-- /#content --> 

<!-- #sidebar -->
<?php include('leftmenu.php'); ?>
<!-- /#sidebar --> 

<!-- #footer --> 
<?php echo $footer; ?>