<?php echo $header; ?>

<div id="content">
  <div class="breadcrumbs">
    <ul>
      <li class="home"><a href="<?php echo site_url('dashboard');?>" title="Dashboard">Dashboard</a></li>
      <li><a href="<?php echo site_url('dispute');?>" title="<?php echo $section_title; ?>"><?php echo $section_title; ?></a></li>
    </ul>
  </div>

<div class="box">
    <div class="headlines">
      <h2><span><?php echo "Disputes" ?></span></h2>
      <h2>
	    <span>
			<a href="<?php if($this->uri->segment(2)=='searchresult'){ echo site_url('dispute/csv/'.$this->uri->segment(3)); } else { echo site_url('dispute/csv'); } ?>" title="Export as CSV file">
				<img src="<?php echo base_url(); ?>images/csv.jpeg" alt="" title="Export as CSV file" width="20" height="20"/>&nbsp;CSV 
			</a>
		</span>
	  </h2>
    </div>
    
    <div class="box-content"> 
	  <?php echo form_open('dispute/searchdispute',array('class'=>'formBox','id'=>'frmsearch')); ?>  
      <fieldset>
        <div class="form-cols"><!-- two form cols -->
          <div class="col1">
            <div class="clearfix">
              <div class="lab">
                <label for="keysearch">Keyword<span>*</span></label>
              </div>
              <div class="con"> <?php echo form_input( array( 'name'=>'keysearch','id'=>'keysearch','class'=>'input','type'=>'text','placeholder'=>'Search elite member by name')); ?> </div>
            </div>
          </div>
          <div id="keysearcherror" style="display:none;" class="error" align="right">Enter Keyword.</div>
        </div>
        <div class="btn-submit"> 
      <?php echo form_input(array('name'=>'btnsearch','id'=>'btnsearch','class'=>'button','type'=>'submit','value'=>'Search','style'=>'margin-left:-48px;')); ?> or <a href="<?php echo site_url('dispute');?>" class="Cancel">Cancel</a> </div>
      </fieldset>
      <?php echo form_close(); ?> 
    </div>


    <div class="box-content">
     <?php if( count($dispute) > 0 ) { ?>
    <!-- table -->
    <table class="tab tab-drag">
        <tr class="top nodrop nodrag">
			<th><a class="sorttitle" href="<?php echo base_url('dispute/index/company'); ?>">Companyname</a></th>
			<th><a class="sorttitle" href="<?php echo base_url('dispute/index/username'); ?>">Username</a></th>
			<th><a class="sorttitle" href="<?php echo base_url('dispute/index/dispute'); ?>">Dispute</a></th>
			<th><a class="sorttitle" href="<?php echo base_url('dispute/index/status'); ?>">Status</a></th>
			<th><a class="sorttitle" href="<?php echo base_url('dispute/index'); ?>">Date</a></th>
			<th>Dispute Review</th>
        </tr>
      <?php foreach($dispute as $disp){ ?>
        <tr>
			<td><?php echo $disp->companyname; ?></td>
			<td><?php echo $disp->username;?></td>
			<td><?php echo substr($disp->dispute,0,8)."....";?></td>
			<td><?php echo $disp->status;?></td>
			<td>
			<?php 
				 $dates=substr($disp->ondate,0,11);
				 echo $change=date("M d Y",strtotime($dates));
			?>
			</td>
			<td><a href='dispute/review/<?php echo $disp->id;?>'>Click here</a></td>
        </tr>
      <?php } ?>
      
      
	   
    </table>
    <!-- /table -->
    <?php 
		if($this->pagination->create_links()) { ?>
        <div class="pagination"><?php echo $this->pagination->create_links(); ?></div>
        <?php } 
	   ?>
<?php } ?>
   
    </div>
    
</div>


</div>

<?php include('leftmenu.php'); ?>
<?php echo $footer; ?>
