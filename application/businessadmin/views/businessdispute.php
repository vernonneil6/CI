<?php echo $header; ?>


<div id="content">

  <div class="breadcrumbs">
    <ul>
      <li class="home"><a href="<?php echo site_url('dashboard');?>" title="Dashboard">Dashboard</a></li>
      <li><a href="<?php echo site_url('businessdispute');?>" title="<?php echo $section_title; ?>"><?php echo $section_title; ?></a></li>
    </ul>
  </div>

<?php
  $order_seg = $this->uri->segment(4,"asc"); 
  if($order_seg == "asc"){ $orderby = "desc";} else { $orderby = "asc"; }

 ?>
<div class="box">
    <div class="headlines">
      <h2><span><?php echo $section_title; ?></span></h2>
    </div>
    
    <table class="tab tab-drag">
        <tr class="top nodrop nodrag">
			<th><a class="sorttitle" href="<?php echo base_url('businessdispute/index/username');?>/<?=$orderby?>">Username</th>
			<th><a class="sorttitle" href="<?php echo base_url('businessdispute/index/complaints');?>/<?=$orderby?>">Complaints</th>
			<th>Case-status</th>
			<th>Resolution-page</th>
			<th>Message</th>
			<th>Review</th>
			
        </tr>
      <?php foreach($companydispute as $cdisp): ?>
        
						<tr>
							<td><?php echo $cdisp->username;?></td>
							<td><?php echo substr($cdisp->dispute,0,8)."....";?></td>
							<?php if($cdisp->status=='open'){ ?>
									<td>Open</td>
							<?php } else { ?>
									 <td>Closed</td>
							<?php } ?>
							<td>
								<a href='businessdispute/resolution/<?php echo $cdisp->id;?>'>Click here</a>
							 </td>
							<td>
							 <a href='businessdispute/messages/<?php echo $cdisp->msglink;?>'>Click here</a>
							</td>
							<td>
							<a href='businessdispute/review/<?php echo $cdisp->id;?>'>Review here</a>
							</td>
							
						</tr>
				
			  <?php  endforeach; ?>
			  
			 <?php if(count($companydispute) ==0) {?>
			  <tr>
			    <td>No Complaints found</td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			  </tr>
		   <?php } ?>
     
    </table>
    
    <?php if(count($companydispute) !=0) {?>
    <?php if($this->pagination->create_links()) { ?>
        <div class="pagination"><?php echo $this->pagination->create_links(); ?></div>
    <?php } ?>
    <?php } ?>  
</div>
</div>


<?php include('leftmenu.php'); ?>
<?php echo $footer; ?>
