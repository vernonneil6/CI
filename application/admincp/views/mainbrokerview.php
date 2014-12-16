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
      <h2><span><?php echo "Main Broker" ?></span></h2>
    </div>
    <div class="box-content"> 

	<table class="tab tab-drag">
      <tr class="top nodrop nodrag">
        <td width="30%">Name</td>
        <td width="30%">BrokerType</td>
        <td width="20%">Company</td>
		<td width="20%">Individual Elites</td>
        <td width="20%">Total Elitesales</td>
      </tr>
     <?php 	foreach($views as $subbroker) {  //echo '<pre>';print_r($subbroker); ?>
	<tr>
		  <td><?php echo $subbroker['ybname']; ?></td>
		  <td><?php echo $subbroker['ybtype']; ?></td>
		  <td><?php echo $subbroker['yccompany']; ?></td>
		  <td><?php echo $subbroker['count']; ?></td>						  
		  <td><?php echo $subbroker['totalelites']; ?></td>
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

