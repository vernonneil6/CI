<?php echo $header; ?>

<div id="content">
  <div class="breadcrumbs">
    <ul>
      <li class="home"><a href="<?php echo site_url('dashboard');?>" title="Dashboard">Dashboard</a></li>
      <li><a href="<?php echo site_url('dispute');?>" title="<?php echo $section_title; ?>"><?php echo $section_title; ?></a></li>
    </ul>
  </div>

<div class="box">
    <div class="headlines">
      <h2><span><?php echo "Disputes" ?></span></h2>
    </div>
    <div class="box-content">
     <?php if( count($dispute) > 0 ) { ?>
    <!-- table -->
    <table class="tab tab-drag">
        <tr class="top nodrop nodrag">
			<th>Companyname</th>
			<th>Username</th>
			<th>Dispute</th>
			<th>Status</th>
			<th>Date</th>
			<th>Dispute Review</th>
        </tr>
      <?php foreach($dispute as $disp){ ?>
        <tr>
			<td><?php echo $disp->companyname; ?></td>
			<td><?php echo $disp->username;?></td>
			<td><?php echo substr($disp->dispute,0,8)."....";?></td>
			<td><?php echo $disp->status;?></td>
			<td>
			<?php 
				 $dates=substr($disp->ondate,0,11);
				 echo $change=date("M d Y",strtotime($dates));
			?>
			</td>
			<td><a href='dispute/review/<?php echo $disp->id;?>'>Click here</a></td>
        </tr>
      <?php } ?>
      
      
	   
    </table>
    <!-- /table -->
    <?php 
		if($this->pagination->create_links()) { ?>
        <div class="pagination"><?php echo $this->pagination->create_links(); ?></div>
        <?php } 
	   ?>
<?php } ?>
   
    </div>
    
</div>


</div>

<?php include('leftmenu.php'); ?>
<?php echo $footer; ?>
