<?php echo $header; ?>

<div id="content">
  <div class="breadcrumbs">
    <ul>
      <li class="home"><a href="<?php echo site_url('dashboard');?>" title="Dashboard">Dashboard</a></li>
      <li><a href="<?php echo site_url('mainbrokerview');?>" title="<?php echo $section_title; ?>"><?php echo $section_title; ?></a></li>
    </ul>
  </div>
<?php
if( $this->uri->segment(2) == 'view')
{
?>
<div class="box">
    <div class="headlines">
      <h2><span><?php echo "Subbroker Team Elite sales Details" ?></span></h2>
    </div>
    <div class="box-content"> 

	<table class="tab tab-drag">
      <tr class="top nodrop nodrag">
        <td width="20%">Name</td>
        <td width="20%">BrokerType</td>
        <td width="20%">Company</td>
		<td width="20%">Individual Sale</td>
        <td width="20%">Total Team-sales</td>
      </tr>
     <?php 	foreach($views as $subbroker) {  //echo '<pre>';print_r($subbroker); ?>
	<tr>
		  <td><?php echo ucfirst($subbroker['ybname']); ?></td>
		  <td><?php echo $subbroker['ybtype']; ?></td>
		  <td><?php echo ucfirst($subbroker['yccompany']); ?></td>
		  <td style="padding-left: 8%;"><?php echo $subbroker['count']; ?></td>						  
		  <td style="padding-left: 8%;"><?php echo $subbroker['totalelites']; ?></td>
	</tr>
	<?php } ?> 
   </table>
   </div>
</div>	
<?php
}
if( $this->uri->segment(2) == 'mview')
{
?>
<div class="box">
    <div class="headlines">
      <h2><span><?php echo "Marketer Team Elite sales Details" ?></span></h2>
    </div>
    <div class="box-content"> 

	<table class="tab tab-drag">
      <tr class="top nodrop nodrag">
        <td width="20%">Name</td>
        <td width="20%">BrokerType</td>
        <td width="20%">Company</td>
		<td width="20%">Individual Sale</td>
        <td width="20%">Total Team-sales</td>
      </tr>
     <?php 	foreach($views as $marketer) {   ?>
	<tr>
		  <td><?php echo ucfirst($marketer['ybname']); ?></td>
		  <td><?php echo $marketer['ybtype']; ?></td>
		  <td><?php echo ucfirst($marketer['yccompany']); ?></td>
		  <td style="padding-left: 8%;"><?php echo $marketer['count']; ?></td>						  
		  <td style="padding-left: 8%;"><?php echo $marketer['totalelites']; ?></td>
	</tr>
	<?php } ?> 
   </table>
   </div>
</div>	
<?php
}
if($this->uri->segment(2) == 'aview') 
{
?>
<div class="box">
    <div class="headlines">
      <h2><span><?php echo "Agent Elite sales Details" ?></span></h2>
    </div>
    <div class="box-content"> 

	<table class="tab tab-drag">
      <tr class="top nodrop nodrag">
        <td width="20%">Name</td>
        <td width="20%">BrokerType</td>
        <td width="20%">Company</td>
		<td width="20%">Total Sales</td>
      </tr>
     <?php 	foreach($views as $agent) {  ?>
	<tr>
		  <td><?php echo ucfirst($agent['ybname']); ?></td>
		  <td><?php echo $agent['ybtype']; ?></td>
		  <td><?php echo ucfirst($agent['yccompany']); ?></td>
		  <td style="padding-left: 8%;"><?php echo $agent['count']; ?></td>						  
	</tr>
	<?php } ?> 
   </table>
   </div>
</div>	
<?php
}
?>
</div>
<?php include('leftmenu.php'); ?>
<?php echo $footer; ?>

