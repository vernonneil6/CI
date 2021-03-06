<?php echo $header; ?>
<div id="content">
	
<?php if($this->uri->segment(1)=='subbroker' && $this->uri->segment(2)=='') { ?>
 
  <div class="breadcrumbs">
    <ul>
      <li class="home"><a href="<?php echo site_url('marketer');?>" title="Dashboard">Dashboard</a></li>
    </ul>
  </div>


	<div class="box">
    <div class="headlines">
      <h2><span><?php echo "Sub Broker Url" ?></span></h2>
    </div>
    <div class = "broker_heading"><label>Welcome to your YouGotRated Sub Broker dashboard! You can use the link below to recruit new Elite members, and when signed up - you will receive credit for the signup. You can also use the left column menu to create new Elite members, which will bring you to the creation form that will give you this credit.</label></div>
    <table class="tab tab-drag">
     <tbody>
	 <tr class="odd">
        <td>Sub Broker Url</td>
        <td>
        <textarea cols='90' rows='10'>
			<?php 
				$url = $this->settings->get_url_by_id(17); 
				echo $url[0]['siteurl'].'?affid='.$this->session->userdata['subbroker_data'][0]->id;
			?>
        </textarea>
        </td>
	 </tr>
     </tbody>
    </table>
	</div>
 
<?php } ?>


<?php if($this->uri->segment(1)=='subbroker' && $this->uri->segment(2)=='marketer') {?>
	
  <div class="breadcrumbs">
    <ul>
	  <li class="home"><a href="<?php echo site_url('subbroker');?>" title="Dashboard">Dashboard</a></li>
      <li><a href="<?php echo site_url('subbroker/agent');?>" title="Marketer">Marketer</a></li>
    </ul>
  </div>


	<div class="box">
    <div class="headlines">
      <h2><span><?php echo "Marketer" ?></span></h2>
    </div>
    <div class="box-content"> 
			
	
     
	<?php if( count($allmarketer) > 0 ) { ?>
    <table class="tab tab-drag">
      <tr class="top nodrop nodrag">
		<td>Username</td>
		<td>Password</td>
		<td>Signup</td>
		<td>Action</td>
		 <td>Download report</td>
      </tr>
      <?php foreach($allmarketer as $marketers){ ?>
      <tr>
		<td><?php echo $marketers['name']; ?></td>
        <td><?php echo $marketers['password']; ?></td>
        <td><?php echo date('m-d-Y', strtotime($marketers['signup'])); ?></td>
        <td class="action">
			<a href="<?php echo site_url('subbroker/deletemarketer/'.$marketers['id']);?>" title="Delete" class="ico ico-delete" onClick="return confirm('Are you sure to Delete this Marketer?');">Delete</a>
			<a href="<?php echo site_url('subbroker/editmarketer/'.$marketers['id']); ?>" title="Edit" class="ico ico-edit">Edit</a>
		</td>
		 <td><a href="<?php echo site_url('subbroker/getmycsv/'.$marketers['id'].'/'.'marketer');?>">Elite csv</td>
      </tr>
      <?php } ?>
    </table>
    <?php } ?>
    
	</div>
	</div>
	
<?php } ?>


<?php if($this->uri->segment(1)=='subbroker' && $this->uri->segment(2)=='addmarketer') {?>
	
 <div class="breadcrumbs">
    <ul>
	  <li class="home"><a href="<?php echo site_url('subbroker');?>" title="Dashboard">Dashboard</a></li>
      <li><a href="<?php echo site_url('subbroker/addmarketer');?>" title="Add Marketer">Add Marketer</a></li>
    </ul>
  </div>


	<div class="box">
    <div class="headlines">
      <h2><span><?php echo "Add Marketer" ?></span></h2>
    </div>
    <div class="box-content"> 
		
    	 <?php echo form_open('subbroker/addmarketer',array('class'=>'formBox broker')); ?>
	 <fieldset>
	<div class="clearfix">
          <div class="lab">
            <label for="name">Marketer Username</label>
          </div>
          <div class="con">
            <?php echo form_input( array( 'name'=>'marketername','class'=>'input','type'=>'text' ) ); ?>
          </div>
        </div>
	<div class="clearfix">
          <div class="lab">
            <label for="name">Password</label>
          </div>
          <div class="con">
            <?php echo form_input( array( 'name'=>'marketerpassword','class'=>'input','type'=>'password' ) ); ?>
          </div>
        </div>
        <?php echo form_input(array('name'=>'marketersubmit','class'=>'button','type'=>'submit','value'=>'Submit')); ?>
	
      </fieldset>
       <?php echo form_close(); ?>
       
    </div>
	</div>

	

<?php } ?>



<?php if($this->uri->segment(1)=='subbroker' && $this->uri->segment(2)=='editmarketer') {?>
	
 <div class="breadcrumbs">
    <ul>
	  <li class="home"><a href="<?php echo site_url('subbroker');?>" title="Dashboard">Dashboard</a></li>
      <li><a href="<?php echo site_url('subbroker/editmarketer');?>" title="Edit Marketer">Edit Marketer</a></li>
    </ul>
  </div>


	<div class="box">
    <div class="headlines">
      <h2><span><?php echo "Edit Marketer" ?></span></h2>
    </div>
    <div class="box-content"> 
		
    	 <?php echo form_open('subbroker/editmarketer/'.$getmarketerdata['id'],array('class'=>'formBox broker')); ?> 
	 <fieldset>
	<div class="clearfix">
          <div class="lab">
            <label for="name">Marketer Username</label>
          </div>
          <div class="con">
            <?php echo form_input( array( 'name'=>'marketername','value' => $getmarketerdata['name'] ,'class'=>'input','type'=>'text' ) ); ?>
          </div>
        </div>
	<div class="clearfix">
          <div class="lab">
            <label for="name">Password</label>
          </div>
          <div class="con">
            <?php echo form_input( array( 'name'=>'marketerpassword','value' => $getmarketerdata['password'],'class'=>'input','type'=>'password' ) ); ?>
          </div>
        </div>
        <?php echo form_input(array('name'=>'marketersubmit','class'=>'button','type'=>'submit','value'=>'Submit')); ?>
	
      </fieldset>
       <?php echo form_close(); ?>
       
    </div>
	</div>

	

<?php } ?>



<?php if($this->uri->segment(1)=='subbroker' && $this->uri->segment(2)=='agent') { ?>
 <div class="breadcrumbs">
    <ul>
	  <li class="home"><a href="<?php echo site_url('subbroker');?>" title="Dashboard">Dashboard</a></li>
      <li><a href="<?php echo site_url('subbroker/agent');?>" title="Agent">Agent</a></li>
    </ul>
  </div>


	<div class="box">
    <div class="headlines">
      <h2><span><?php echo "Agent" ?></span></h2>
    </div>
    <div class="box-content"> 
			
	
     
	<?php if( count($allagent) > 0 ) { ?>
    <table class="tab tab-drag">
      <tr class="top nodrop nodrag">
		<td>Username</td>
		<td>Password</td>
		<td>Signup</td>
		<td>Action</td>
		<td>Download report</td>
      </tr>
      <?php foreach($allagent as $agents){ ?>
      <tr>
		<td><?php echo $agents['name']; ?></td>
        <td><?php echo $agents['password']; ?></td>
        <td><?php echo date('m-d-Y', strtotime($agents['signup'])); ?></td>
        <td class="action">
			<a href="<?php echo site_url('subbroker/deleteagent/'.$agents['id']);?>" title="Delete" class="ico ico-delete" onClick="return confirm('Are you sure to Delete this Agent?');">Delete</a>
			<a href="<?php echo site_url('subbroker/editagent/'.$agents['id']); ?>" title="Edit" class="ico ico-edit">Edit</a>
		</td>
		<td><a href="<?php echo site_url('subbroker/getmycsv/'.$agents['id'].'/'.'agent');?>">Elite csv</td>
      </tr>
      <?php } ?>
    </table>
    <?php } ?>
    
	</div>
	</div>

<?php } ?>


<?php if($this->uri->segment(1)=='subbroker' && $this->uri->segment(2)=='addagent') { ?>

	<div class="breadcrumbs">
		<ul>
		  <li class="home"><a href="<?php echo site_url('subbroker');?>" title="Dashboard">Dashboard</a></li>
		  <li><a href="<?php echo site_url('subbroker/addagent');?>" title="Add Agent">Add Agent</a></li>
		</ul>
	  </div>


	<div class="box">
    <div class="headlines">
      <h2><span><?php echo "Add Agent" ?></span></h2>
    </div>
    <div class="box-content"> 
		
    	 <?php echo form_open('subbroker/addagent',array('class'=>'formBox broker')); ?>
	 <fieldset>
	<div class="clearfix">
          <div class="lab">
            <label for="name">Marketer Username</label>
          </div>
          <div class="con">
				<select name="agentmarketer" class="select">
					<?php foreach($marketername as $name) { ?>
						<option value="<?php echo $name['id']; ?>"><?php echo $name['name']; ?></option>
					<?php } ?>
				</select>
          </div>
    </div>
	<div class="clearfix">
          <div class="lab">
            <label for="name">Agent Username</label>
          </div>
          <div class="con">
            <?php echo form_input( array( 'name'=>'agentname','class'=>'input','type'=>'text' ) ); ?>
          </div>
        </div>
	<div class="clearfix">
          <div class="lab">
            <label for="name">Password</label>
          </div>
          <div class="con">
            <?php echo form_input( array( 'name'=>'agentpassword','class'=>'input','type'=>'password' ) ); ?>
          </div>
        </div>
        <?php echo form_input(array('name'=>'agentsubmit','class'=>'button','type'=>'submit','value'=>'Submit')); ?>
	
      </fieldset>
       <?php echo form_close(); ?>
       
    </div>
	</div>


<?php } ?>



<?php if($this->uri->segment(1)=='subbroker' && $this->uri->segment(2)=='editagent') { ?>

	<div class="breadcrumbs">
		<ul>
		  <li class="home"><a href="<?php echo site_url('subbroker');?>" title="Dashboard">Dashboard</a></li>
		  <li><a href="<?php echo site_url('subbroker/editagent');?>" title="Edit Agent">Edit Agent</a></li>
		</ul>
	  </div>


	<div class="box">
    <div class="headlines">
      <h2><span><?php echo "Edit Agent" ?></span></h2>
    </div>
    <div class="box-content"> 
		
    	 <?php echo form_open('subbroker/editagent/'.$getagentdata['id'],array('class'=>'formBox broker')); ?>
	 <fieldset>
	<div class="clearfix">
          <div class="lab">
            <label for="name">Marketer Username</label>
          </div>
          <div class="con">
				<select name="agentmarketer" class="select">
					<?php foreach($marketername as $name) { ?>
						<option value="<?php echo $name['id']; ?>"><?php echo $name['name']; ?></option>
					<?php } ?>
				</select>
          </div>
    </div>
	<div class="clearfix">
          <div class="lab">
            <label for="name">Agent Username</label>
          </div>
          <div class="con">
            <?php echo form_input( array( 'name'=>'agentname','value'=>$getagentdata['name'],'class'=>'input','type'=>'text' ) ); ?>
          </div>
        </div>
	<div class="clearfix">
          <div class="lab">
            <label for="name">Password</label>
          </div>
          <div class="con">
            <?php echo form_input( array( 'name'=>'agentpassword','value'=>$getagentdata['password'],'class'=>'input','type'=>'password' ) ); ?>
          </div>
        </div>
        <?php echo form_input(array('name'=>'agentsubmit','class'=>'button','type'=>'submit','value'=>'Submit')); ?>
	
      </fieldset>
       <?php echo form_close(); ?>
       
    </div>
	</div>


<?php } ?>




<?php if($this->uri->segment(1)=='subbroker' && $this->uri->segment(2)=='elitemembers') {?>
	
	
	<div class="breadcrumbs">
		<ul>
		  <li class="home"><a href="<?php echo site_url('subbroker');?>" title="Dashboard">Dashboard</a></li>
		  <li><a href="<?php echo site_url('subbroker/elitemember');?>" title="Elite Member">Elite Member</a></li>
		</ul>
	</div>


	<div class="box">
		<div class="headlines">
		  <h2><span><?php echo "Elite Member" ?></span></h2>
		</div>
		<div class="box-content"> 
		<a href="<?php echo site_url('subbroker/getmycsv/'.$this->session->userdata['subbroker_data'][0]->id.'/'.'subbroker');?>">Download Total Subbroker Elite CSV Report</a>	
		<?php if( count($elitemembers) > 0 ) { ?>
		<style>
		
		.tab th, .tab td  {padding: 8px 9px;}
		
		</style>
		<table class="tab tab-drag" style="font-size: 11px;">
		  <tr class="top nodrop nodrag">
			<td>Subbroker Name</td>
			<td>Marketer Name</td>
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
				<td><?php echo $elite['ycsubbrokerid']; ?></td>
				<td><?php echo $elite['ycmarketerid']; ?></td>
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

<?php if($this->uri->segment(1)=='subbroker' && $this->uri->segment(2)=='userprofile') { ?>
	
	<div class="breadcrumbs">
		<ul>
		  <li class="home"><a href="<?php echo site_url('subbroker');?>" title="Dashboard">Dashboard</a></li>
		  <li><a href="<?php echo site_url('subbroker/userprofile');?>" title="User Profile">User Profile</a></li>
		</ul>
	  </div>


	<div class="box">
		<div class="headlines">
		  <h2><span><?php echo "User Profile" ?></span></h2>
		</div>
		
		<div class="box-content"> 
		<?php echo form_open('subbroker/resetpassword/'.$getdata['id'], array('class'=>'formBox broker')); ?>	
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

<?php if($this->uri->segment(1)=='subbroker' && $this->uri->segment(2)=='resetpassword') { ?>
	
	<?php if( $this->session->flashdata('success') ) { ?>
		<div class="lab form-message correct">
		  <p><?php echo $this->session->flashdata('success'); ?></p>
		</div>
    <?php } ?>
    
    <?php if( $this->session->flashdata('error') ) { ?>
		<div class="lab form-message error1">
		  <p><?php echo $this->session->flashdata('error'); ?></p>
		</div>
    <?php } ?>	
	
	<div class="breadcrumbs">
		<ul>
		  <li class="home"><a href="<?php echo site_url('subbroker');?>" title="Dashboard">Dashboard</a></li>
		  <li><a href="<?php echo site_url('subbroker/resetpassword');?>" title="Reset Password">Reset Password</a></li>
		</ul>
	</div>


	<div class="box">
		<div class="headlines">
		  <h2><span><?php echo "User Profile" ?></span></h2>
		</div>
		
		<div class="box-content"> 
		<?php echo form_open('subbroker/resetpassword/'.$getdata['id'], array('class'=>'formBox broker')); ?>	
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

<?php include('subbrokerleftmenu.php'); ?>
<?php echo $footer; ?>

