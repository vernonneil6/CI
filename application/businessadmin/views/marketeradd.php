<?php echo $header; ?>
<div id="content">

  <div class="breadcrumbs">
    <ul>
      <li class="home"><a href="<?php echo site_url('marketer');?>" title="Dashboard">Dashboard</a></li>
    </ul>
  </div>


<div class="box">
    <div class="headlines">
      <h2><span><?php echo "Add Agent" ?></span></h2>
    </div>
    <?php
    if($marketercount != $remainingcount)
    {
    ?>
    <?php echo form_open('marketeradd/add',array('class'=>'formBox broker')); ?>
	 <fieldset>
	<div class="clearfix">
          <div class="lab">
            <label for="name">Agent Name</label>
          </div>
          <div class="con">
            <?php echo form_input( array( 'name'=>'brokername','class'=>'input','type'=>'text' ) ); ?>
          </div>
        </div>
	<div class="clearfix">
          <div class="lab">
            <label for="name">Password</label>
          </div>
          <div class="con">
            <?php echo form_input( array( 'name'=>'brokerpassword','class'=>'input','type'=>'password' ) ); ?>
          </div>
        </div>
        <?php echo form_input(array('name'=>'submitbroker','class'=>'button','type'=>'submit','value'=>'Submit')); ?>
	
      </fieldset>
       <?php echo form_close(); ?>
     <?php
     }
     else
     {
     ?>
     <div class="clearfix">
          <div class="lab">
            <label><?php echo "you can create only  "  .$marketercount. "  Agent Account";?> </label>
          </div>
     </div>
     <?php
     }
     ?>
     
</div>
</div>

<?php include('marketerleftmenu.php'); ?>
<?php echo $footer; ?>