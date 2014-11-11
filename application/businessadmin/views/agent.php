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

<?php } ?>

</div>

<?php include('agentleftmenu.php'); ?>
<?php echo $footer; ?>

<script type="text/javascript">
$(document).ready(function(){
$(function(){
  $("#company").autocomplete({
    source: "index.php/agent/get_companyname" 
  });
});
});
</script>
