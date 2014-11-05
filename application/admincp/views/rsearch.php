<?php echo $header; ?>
<!-- #content -->
<div id="content">
	<?php form_open('dashboard/search');?>
<?php $search = array('name'=>'search','id'=>'search','value'=>'');?>
<?php  form_input($search);?><input type=submit value='Search' /></p>
<?php form_close();?>
<div class="box">
    <div class="headlines">
      <h2><span>search</span></h2>
    </div>
    <div class="box-content">
	<?php echo form_open('dashboard/search',array('class'=>'formBox')); ?>
	 <fieldset>
        <div class="clearfix">
          <div class="lab">
            <label for="title">search </label>
          </div>
          <div class="con">
            <?php echo form_input( array( 'name'=>'title','class'=>'input','type'=>'text' ) ); ?>
          </div>
        </div>
        <?php echo form_input(array('name'=>'submitimage','class'=>'button','type'=>'submit','value'=>'Add')); ?>
      </fieldset>
	
	<?php echo form_close(); ?>
    </div>
  </div>
<table>
<tr><th>ID</th><th>Book</th><th>Author</th><th>Published</th><th>Price</th></tr>
<?php foreach($query as $item):?>
<tr>
<td><?= $item->id ?></td>
<td><?= $item->bookname ?></td>
<td><?= $item->author ?></td>
<td><?= $item->datepublished ?></td>
<td><?= $item->price ?></td>
</tr>
<?php endforeach;?>
</table>
</div>
<!-- /#content --> 

<!-- #sidebar -->
<?php include('leftmenu.php'); ?>
<!-- /#sidebar --> 

<!-- #footer --> 
<?php echo $footer; ?>
