<?php echo $header; ?>
<div id="content">

<?php if($this->uri->segment(1)=='agent' && $this->uri->segment(2)=='') { ?>

<div class="breadcrumbs">
    <ul>
      <li class="home"><a href="<?php echo site_url('marketer');?>" title="Dashboard">Dashboard</a></li>
    </ul>
  </div>


	<div class="box">
    <div class="headlines">
      <h2><span><?php echo "Agent Url" ?></span></h2>
    </div>
    <div class = "broker_heading"><label>Welcome to your YouGotRated Sub Broker dashboard! You can use the link below to recruit new Elite members, and when signed up - you will receive credit for the signup. You can also use the left column menu to create new Elite members, which will bring you to the creation form that will give you this credit.</label></div>
    <table class="tab tab-drag">
     <tbody><tr class="top nodrop nodrag"> </tr>       
     <tr class="odd">
        <td>Subbroker Url</td>
        <td>
        <textarea cols='90' rows='10'>
			<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/signuppage/affid/'.$this->session->userdata['agent_data'][0]->id;?>
        </textarea>
        </td>
	 </tr>
     </tbody>
    </table>
	</div>

<?php } ?>




<?php if($this->uri->segment(1)=='agent' && $this->uri->segment(2)=='elitemember') {?>
	
	
	<div class="breadcrumbs">
    <ul>
      <li class="home"><a href="<?php echo site_url('agent/elitemember');?>" title="elitemember">Elite Member</a></li>
    </ul>
  </div>


	<div class="box">
    <div class="headlines">
      <h2><span><?php echo "Elite Member" ?></span></h2>
    </div>
    <div class="box-content"> 
			
	
     
		<?php if( count($elitemembers) > 0 ) { ?>
		<table class="tab tab-drag">
		  <tr class="top nodrop nodrag">
			<td>Name</td>
			<td>Type</td>
			<td>Company</td>
			<td>Email</td>
			<td>Phone</td>
		  </tr>
		  <?php  foreach($elitemembers as $elite) { 
		 	if($elite['ybid']==$this->session->userdata['agent_data'][0]->id) { ?>
			<tr>
				<td><?php echo $elite['ybname']; ?></td>
				<td><?php echo $elite['ybtype']; ?></td>
				<td><?php echo $elite['yccompany']; ?></td>
				<td><?php echo $elite['ycemail']; ?></td>
				<td><?php echo $elite['ycphone']; ?></td>
			</tr>
			<?php } } ?>
		</table>
		<?php } ?>
		
    
	</div>
	</div>
	
	
<?php } ?>
</div>

<?php include('agentleftmenu.php'); ?>
<?php echo $footer; ?>
