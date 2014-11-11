<?php echo $header; ?>
<div id="content">

<?php if($this->uri->segment(1)=='marketer' && $this->uri->segment(2)=='') { ?>
	
	<div class="breadcrumbs">
    <ul>
      <li class="home"><a href="<?php echo site_url('marketer');?>" title="Dashboard">Dashboard</a></li>
    </ul>
  </div>


	<div class="box">
    <div class="headlines">
      <h2><span><?php echo "Add Broker" ?></span></h2>
    </div>
    <div class="box-content"> 
    	<?php echo form_open('mainbroker/add',array('class'=>'formBox broker')); ?>
	 <fieldset>
        <div class="clearfix">
          <div class="lab">
            <label for="name">Subbroker Name</label><?php echo $data;?>
          </div>
          <div class="con">
         <input type="text" class="input" placeholder="enter minimum 4 characters to search company" id="company" name="company" maxlength="30" required>
          </div>
        </div>
        <?php echo form_input(array('name'=>'submitbroker','class'=>'button','type'=>'submit','value'=>'Submit')); ?>
      </fieldset>
       <?php echo form_close(); ?>
    </div>
	</div>
	
<?php }?>



<?php if($this->uri->segment(1)=='marketer' && $this->uri->segment(2)=='agent') { ?>
 <div class="breadcrumbs">
    <ul>
      <li class="home"><a href="<?php echo site_url('marketer/agent');?>" title="agent">Agent</a></li>
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
		<td>Url</td>
		<td>Username</td>
		<td>Password</td>
		<td>Signup</td>
      </tr>
      <?php foreach($allagent as $agents){ ?>
      <tr>
		<td><?php echo $agents['url']; ?></td>
		<td><?php echo $agents['name']; ?></td>
        <td><?php echo $agents['password']; ?></td>
        <td><?php echo $agents['signup']; ?></td>
      </tr>
      <?php } ?>
    </table>
    <?php } ?>
    
	</div>
	</div>

<?php } ?>


<?php if($this->uri->segment(1)=='marketer' && $this->uri->segment(2)=='addagent') { ?>

	<div class="breadcrumbs">
		<ul>
		  <li class="home"><a href="<?php echo site_url('marketer/addagent');?>" title="addagent">Add Agent</a></li>
		</ul>
	  </div>


	<div class="box">
    <div class="headlines">
      <h2><span><?php echo "Add Agent" ?></span></h2>
    </div>
    <div class="box-content"> 
		
    <?php echo form_open('marketer/addagent',array('class'=>'formBox broker')); ?>
	<fieldset>
	<div class="clearfix">
          <div class="lab">
            <label for="name">Agent Name</label>
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

</div>

<?php include('marketerleftmenu.php'); ?>
<?php echo $footer; ?>


<script type="text/javascript">
$(document).ready(function(){
$(function(){
  $("#company").autocomplete({
    source: "index.php/marketer/get_companyname" 
  });
});
});
</script>
