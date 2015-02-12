<?php echo $header; ?>
<div id="content">

<?php if($this->uri->segment(1)=='agent' && $this->uri->segment(2)=='') { ?>

<div class="breadcrumbs">
    <ul>
      <li class="home"><a href="<?php echo site_url('agent');?>" title="Dashboard">Dashboard</a></li>
    </ul>
  </div>


	<div class="box">
    <div class="headlines">
      <h2><span><?php echo "Agent Url" ?></span></h2>
    </div>
    <div class = "broker_heading"><label>Welcome to the YouGotRated Agent dashboard! You can use this link below to give potential Elite Members to sign up, which will give you and your business credit for the signup.You can also use the links to the left to view your signed up members, and take newsignups over the phone.</label></div>
    <table class="tab tab-drag">
     <tbody><tr class="top nodrop nodrag"> </tr>       
     <tr class="odd">
        <td>Agent Url</td>
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




<?php if($this->uri->segment(1)=='agent' && $this->uri->segment(2)=='elitemembers') {?>
	
	
	<div class="breadcrumbs">
    <ul>
      <li class="home"><a href="<?php echo site_url('agent');?>" title="Dashboard">Dashboard</a></li>
      <li><a href="<?php echo site_url('agent/elitemember');?>" title="Elite Member">Elite Member</a></li>
    </ul>
  </div>


	<div class="box">
    <div class="headlines">
      <h2><span><?php echo "Elite Member" ?></span></h2>
    </div>
    <div class="box-content"> 
		<style>
		.tab th, .tab td{padding: 8px 26px;	}
		
		</style>	
	<a href="<?php echo site_url('agent/getmycsv/'.$this->session->userdata['agent_data'][0]->id.'/'.'agent');?>">Download Total Agent Elite CSV Report</a>	
     
		<?php if( count($elitemembers) > 0 ) { ?>
		<table class="tab tab-drag">
		  <tr class="top nodrop nodrag">
			<td>Agent Name</td>
			<td>Type</td>
			<td>Company</td>
			<td>Email</td>
			<td>Date signed</td>
			<td>Monthly fee</td>
			<td>Status</td>
		
		  </tr>
			<?php  foreach($elitemembers as $elite) { ?>
			
			<tr>
				<td><?php echo $elite['ycbrokerid']; ?></td>
				<td><?php echo $elite['ycbrokertype']; ?></td>
				<td><?php echo $elite['yccompany']; ?></td>
				<td><?php echo $elite['ycemail']; ?></td>
			    <td><?php echo $elite['ycreg']; ?></td>
				<td><?php echo $elite['ysamt']; ?></td>
				<td><?php echo $elite['ycstatus']; ?></td>
			</tr>
			<?php 
			} 
			}
			?>
		</table>

		
    
	</div>
	</div>
	
	
<?php } ?>


<?php if($this->uri->segment(1)=='agent' && $this->uri->segment(2)=='userprofile') { ?>
	
	<div class="breadcrumbs">
		<ul>
		  <li class="home"><a href="<?php echo site_url('agent');?>" title="Dashboard">Dashboard</a></li>
		  <li><a href="<?php echo site_url('agent/userprofile');?>" title="User Profile">User Profile</a></li>
		</ul>
	  </div>


	<div class="box">
		<div class="headlines">
		  <h2><span><?php echo "User Profile" ?></span></h2>
		</div>
		
		<div class="box-content"> 
		<?php echo form_open('agent/resetpassword/'.$getdata['id'], array('class'=>'formBox broker')); ?>	
		<fieldset>
			<div class="clearfix">
				  <div class="lab">
					<label>Username</label>
				  </div>
				  <div class="lab">
					<?php echo $getdata['name'] ?>
				  </div>
			</div>
			<div class="clearfix">
				  <div class="lab">
					<label>Password</label>
				  </div>
				  <div class="lab">
					<?php echo $getdata['password'] ?>
				  </div>
			 </div>
			 <?php echo form_input(array('name'=>'updatepassword','class'=>'button','type'=>'submit','value'=>'Update')); ?>
		 </fieldset>
		 
		 <?php echo form_close(); ?>
 
		</div>
	</div>
	
	
<?php } ?>

<?php if($this->uri->segment(1)=='agent' && $this->uri->segment(2)=='resetpassword') { ?>
	    
    <?php if( $this->session->flashdata('error') ) { ?>
		<div class="lab form-message error1">
		  <p><?php echo $this->session->flashdata('error'); ?></p>
		</div>
    <?php } ?>	
	
	<div class="breadcrumbs">
		<ul>
		  <li class="home"><a href="<?php echo site_url('agent');?>" title="Dashboard">Dashboard</a></li>
		  <li><a href="<?php echo site_url('agent/resetpassword');?>" title="Reset Password">Reset Password</a></li>
		</ul>
	</div>


	<div class="box">
		<div class="headlines">
		  <h2><span><?php echo "User Profile" ?></span></h2>
		</div>
		
		<div class="box-content"> 
		<?php echo form_open('agent/resetpassword/'.$getdata['id'], array('class'=>'formBox broker')); ?>	
		<fieldset>
			<div class="clearfix">
				  <div class="lab">
					<label>Old Password</label>
				  </div>
				  <div class="con">
					 <?php echo form_input( array( 'name'=>'oldpassword', 'class'=>'input','type'=>'password','required'=>'required' ) ); ?>
				  </div>
			</div>
			<div class="clearfix">
				  <div class="lab">
					<label>New Password</label>
				  </div>
				  <div class="con">
					 <?php echo form_input( array( 'name'=>'password', 'class'=>'input','type'=>'password','required'=>'required' ) ); ?>
				  </div>
			 </div>
			 <div class="clearfix">
				  <div class="lab">
					<label>Retype Password</label>
				  </div>
				  <div class="con">
					 <?php echo form_input( array( 'name'=>'retypepassword','class'=>'input','type'=>'password','required'=>'required' ) ); ?>
				  </div>
			 </div>
			 <input type = "hidden" value = "<?php echo $getdata['password']; ?>" name = "pwd">
			 <?php echo form_input(array('name'=>'newpassword','class'=>'button','type'=>'submit','value'=>'Submit')); ?>
		 </fieldset>
		 <?php echo form_close(); ?>
		</div>
	</div>
	
	
<?php } ?>


</div>

<?php include('agentleftmenu.php'); ?>
<?php echo $footer; ?>
