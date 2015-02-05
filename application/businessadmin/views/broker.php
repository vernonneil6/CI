<?php echo $header; ?>
<div id="content">
	
<?php if($this->uri->segment(1)=='broker' && $this->uri->segment(2)=='') { ?>
 
  <div class="breadcrumbs">
    <ul>
      <li class="home"><a href="<?php echo site_url('marketer');?>" title="Dashboard">Dashboard</a></li>
    </ul>
  </div>


	<div class="box">
    <div class="headlines">
      <h2><span><?php echo "Broker Url" ?></span></h2>
    </div>
    <div class = "broker_heading"><label>Welcome to your YouGotRated Broker dashboard! You can use the link below to recruit new Elite members, and when signed up - you will receive credit for the signup. You can also use the left column menu to create new Elite members, which will bring you to the creation form that will give you this credit.</label></div>
    <table class="tab tab-drag">
     <tbody>
	 <tr class="odd">
        <td>Sub Broker Url</td>
        <td>
        <textarea cols='90' rows='10'>
			<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/signuppage/affid/'.$this->session->userdata['broker_data'][0]->id;?>
        </textarea>
        </td>
	 </tr>
     </tbody>
    </table>
	</div>
 
<?php } ?>


<?php if($this->uri->segment(1)=='broker' && $this->uri->segment(2)=='subbroker') {?>
	
  <div class="breadcrumbs">
    <ul>
	  <li class="home"><a href="<?php echo site_url('broker');?>" title="Dashboard">Dashboard</a></li>
      <li><a href="<?php echo site_url('broker/subbroker');?>" title="subbroker">subbroker</a></li>
    </ul>
  </div>
	<div class="box">
    <div class="headlines">
      <h2><span><?php echo "subbroker" ?></span></h2>
    </div>
    <div class="box-content"> 
			
	
     
	<?php if( count($allsubbroker) > 0 ) { ?>
    <table class="tab tab-drag">
      <tr class="top nodrop nodrag">
		<td>Username</td>
		<td>Password</td>
		<td>Signup</td>
		<td>Action</td>
      </tr>
      <?php foreach($allsubbroker as $subbrokers){ ?>
      <tr>
		<td><?php echo $subbrokers['name']; ?></td>
        <td><?php echo $subbrokers['password']; ?></td>
        <td><?php echo date('m-d-Y', strtotime($subbrokers['signup'])); ?></td>
        <td class="action">
			<a href="<?php echo site_url('broker/deletesubbroker/'.$subbrokers['id']);?>" title="Delete" class="ico ico-delete" onClick="return confirm('Are you sure to Delete this Subbroker?');">Delete</a>
			<a href="<?php echo site_url('broker/editsubbroker/'.$subbrokers['id']); ?>" title="Edit" class="ico ico-edit">Edit</a>
		</td>
      </tr>
      <?php } ?>
    </table>
    <?php } ?>
    
	</div>
	</div>
	
<?php } ?>

<?php if($this->uri->segment(1)=='broker' && $this->uri->segment(2)=='addsubbroker') {?>
	
 <div class="breadcrumbs">
    <ul>
	  <li class="home"><a href="<?php echo site_url('broker');?>" title="Dashboard">Dashboard</a></li>
      <li><a href="<?php echo site_url('broker/addsubbroker');?>" title="Add subbroker">Add subbroker</a></li>
    </ul>
  </div>


	<div class="box">
    <div class="headlines">
      <h2><span><?php echo "Add subbroker" ?></span></h2>
    </div>
    <div class="box-content"> 
		
    	 <?php echo form_open('broker/addsubbroker',array('class'=>'formBox broker')); ?>
	 <fieldset>
	<div class="clearfix">
          <div class="lab">
            <label for="name">Subbroker Username</label>
          </div>
          <div class="con">
            <?php echo form_input( array( 'name'=>'subbrokername','class'=>'input','type'=>'text' ) ); ?>
          </div>
        </div>
	<div class="clearfix">
          <div class="lab">
            <label for="name">Password</label>
          </div>
          <div class="con">
            <?php echo form_input( array( 'name'=>'subbrokerpassword','class'=>'input','type'=>'password' ) ); ?>
          </div>
        </div>
        <?php echo form_input(array('name'=>'subbrokersubmit','class'=>'button','type'=>'submit','value'=>'Submit')); ?>
	
      </fieldset>
       <?php echo form_close(); ?>
       
    </div>
	</div>

	

<?php } ?>

<?php if($this->uri->segment(1)=='broker' && $this->uri->segment(2)=='editsubbroker') {?>
	
 <div class="breadcrumbs">
    <ul>
	  <li class="home"><a href="<?php echo site_url('broker');?>" title="Dashboard">Dashboard</a></li>
      <li><a href="<?php echo site_url('broker/editsubbroker');?>" title="Edit subbroker">Edit subbroker</a></li>
    </ul>
  </div>


	<div class="box">
    <div class="headlines">
      <h2><span><?php echo "Edit subbroker" ?></span></h2>
    </div>
    <div class="box-content"> 
		
    	 <?php echo form_open('broker/editsubbroker/'.$getsubbrokerdata['id'],array('class'=>'formBox broker')); ?> 
	 <fieldset>
	<div class="clearfix">
          <div class="lab">
            <label for="name">Subbroker Username</label>
          </div>
          <div class="con">
            <?php echo form_input( array( 'name'=>'subbrokername','value' => $getsubbrokerdata['name'] ,'class'=>'input','type'=>'text' ) ); ?>
          </div>
        </div>
	<div class="clearfix">
          <div class="lab">
            <label for="name">Password</label>
          </div>
          <div class="con">
            <?php echo form_input( array( 'name'=>'subbrokerpassword','value' => $getsubbrokerdata['password'],'class'=>'input','type'=>'password' ) ); ?>
          </div>
        </div>
        <?php echo form_input(array('name'=>'subbrokersubmit','class'=>'button','type'=>'submit','value'=>'Submit')); ?>
	
      </fieldset>
       <?php echo form_close(); ?>
       
    </div>
	</div>

	

<?php } ?>

<?php if($this->uri->segment(1)=='broker' && $this->uri->segment(2)=='elitemember') {?>
	
	
	<div class="breadcrumbs">
		<ul>
		  <li class="home"><a href="<?php echo site_url('broker');?>" title="Dashboard">Dashboard</a></li>
		  <li><a href="<?php echo site_url('broker/elitemember');?>" title="Elite Member">Elite Member</a></li>
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
			
			<?php for($e=0;$e<=count($elitemembers);$e++) {?>
			<tr>
				<td><?php echo $elitemembers[$e]['ybname']; ?></td>
				<td><?php echo $elitemembers[$e]['ybtype']; ?></td>
				<td><?php echo $elitemembers[$e]['yccompany']; ?></td>
				<td><?php echo $elitemembers[$e]['ycemail']; ?></td>
				<td><?php echo $elitemembers[$e]['ycphone']; ?></td>
			</tr>
			<?php } ?>
			</table>
		<?php } else { ?>
			
			<div class="form-message warning">
  <p>No Records Found</p>
</div>
			
		<?php } ?>
		
		</div>
	</div>	
<?php } ?>

<?php if($this->uri->segment(1)=='broker' && $this->uri->segment(2)=='userprofile') { ?>
	
	<div class="breadcrumbs">
		<ul>
		  <li class="home"><a href="<?php echo site_url('broker');?>" title="Dashboard">Dashboard</a></li>
		  <li><a href="<?php echo site_url('broker/userprofile');?>" title="User Profile">User Profile</a></li>
		</ul>
	  </div>


	<div class="box">
		<div class="headlines">
		  <h2><span><?php echo "User Profile" ?></span></h2>
		</div>
		
		<div class="box-content"> 
		<?php echo form_open('broker/resetpassword/'.$getdata['id'], array('class'=>'formBox broker')); ?>	
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

<?php if($this->uri->segment(1)=='broker' && $this->uri->segment(2)=='resetpassword') { ?>
	
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
		  <li class="home"><a href="<?php echo site_url('broker');?>" title="Dashboard">Dashboard</a></li>
		  <li><a href="<?php echo site_url('broker/resetpassword');?>" title="Reset Password">Reset Password</a></li>
		</ul>
	</div>


	<div class="box">
		<div class="headlines">
		  <h2><span><?php echo "User Profile" ?></span></h2>
		</div>
		
		<div class="box-content"> 
		<?php echo form_open('broker/resetpassword/'.$getdata['id'], array('class'=>'formBox broker')); ?>	
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

<?php include('brokerleftmenu.php'); ?>
<?php echo $footer; ?>

