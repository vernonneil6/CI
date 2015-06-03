<?php if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'view' ) ) { ?>
<!-- box -->

<div class="box">
  <div class="headlines">
    <h2><span>Comment Detail</span></h2>
  </div>
  <?php if( count($couponcomment)>0 ) { ?>
  <?php $user=$this->users->get_user_byid($couponcomment[0]['commentby'])?>
  <?php $coupon=$this->coupons->get_coupon_byid($couponcomment[0]['couponid'])?>
  <table>
    <tr>
      <td width="120" valign="top"><b>Coupon</b></td>
      <td valign="top"><b>:</b></td>
      <td><?php if(count($coupon)>0) {
					echo nl2br(stripslashes($coupon[0]['title'])); } ?></td>
    </tr>
    <tr>
      <td width="120" valign="top"><b>Comment</b></td>
      <td valign="top"><b>:</b></td>
      <td><?php echo nl2br(stripslashes($couponcomment[0]['comment'])); ?></td>
    </tr>
    <tr>
      <td width="120" valign="top"><b>Comment by</b></td>
      <td valign="top"><b>:</b></td>
      <td><?php if(count($user)>0) {
					echo stripslashes($user[0]['firstname'].' '.$user[0]['lastname']); } ?></td>
    </tr>
    <tr>
      <td width="120"><b>Comment Date</b></td>
      <td><b>:</b></td>
      <td><?php echo date('M d Y',strtotime($couponcomment[0]['commentdate']));?></td>
    </tr>
  </table>
  <?php } else { ?>
  <!-- Warning form message -->
  <div class="form-message warning">
    <p>No record found.</p>
  </div>
  <?php } ?>
  <!-- /table --> 
</div>
<!-- /box -->

<?php } 


else if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'edit' ) ) { ?>

<?php echo $heading; ?> 
<div id="content"> 
  
  <div class="breadcrumbs">
    <ul>
      <li class="home"><a href="<?php echo site_url('dashboard');?>" title="Dashboard">Dashboard</a></li>
      <li><a href="<?php echo site_url('couponcomment');?>" title="<?php echo $section_title; ?>"><?php echo $section_title; ?></a></li>
      <li><a href="<?php echo site_url('couponcomment/edit');?>" title="<?php echo 'Edit Comment'; ?>"><?php echo 'Edit Comment'; ?></a></li>
    </ul>
  </div>

  <div class="box">
    <div class="headlines">
      <h2><span>Edit Comment</span></h2>
    </div>
    <div class="box-content"> 
	  <?php echo form_open('couponcomment/update',array('class'=>'formBox')); ?>
      <fieldset>
        <div class="form-cols">
          <div class="col1" style="width:100%">
            <div class="clearfix">
              <div class="lab" style="width: 20% !important;">
                <label for="title">Title <span class="errorsign">*</span></label>
              </div>
              <div class="con" style="width: 77% !important; float:left">
                <input type = "text" value="<?php echo $edit[0]['comment']; ?>" class="input" name="title" required>
              </div>
            </div>
          </div>
        </div>
      </fieldset>
      <input type = "hidden" value=<?php echo $id; ?> name='id'>
      <input type = "submit" value="Update" class='button'>
      <?php echo form_close(); ?> 
    </div>
  </div>

</div>
<?php include('leftmenu.php'); ?>
<?php echo $footer; ?>


<?php } else { ?>
<?php echo $heading; ?> 
<!-- #content -->
<div id="content"> 
  
  <!-- breadcrumbs -->
  <div class="breadcrumbs">
    <ul>
      <li class="home"><a href="<?php echo site_url('dashboard');?>" title="Dashboard">Dashboard</a></li>
      <li><a href="<?php echo site_url('couponcomment');?>" title="<?php echo $section_title; ?>"><?php echo $section_title; ?></a></li>
    </ul>
  </div>
  <!-- /breadcrumbs -->
  <?php if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'search' ) ) { ?>
  <script type="text/javascript" language="javascript">
	function trim(stringToTrim) {
		return stringToTrim.replace(/^\s+|\s+$/g,"");
	}
	$(document).ready(function() {
		$("#btnsearch").click(function () {
	
			if( trim($("#keysearch").val()) == "" )
			{
				$("#error").attr('style','display:block;');
				$("#keysearcherror").show();
				$("#keysearch").val('').focus();
				return false;
			}
			else
			{
				$("#keysearcherror").hide();
			}
			
			if( $("#frmsearch").submit() )
			{
				$("#error").attr('style','display:none;');
			}
    	});
	
	});
</script> 
  <!-- box -->
  <div class="box">
    <div class="headlines">
      <h2><span>Search Comments</span></h2>
    </div>
    <div class="box-content"> <?php echo form_open('couponcomment/searchcomment',array('class'=>'formBox','id'=>'frmsearch')); ?>
      <fieldset>
        
        <!-- Error form message -->
        
        <div class="form-cols"><!-- two form cols -->
          <div class="col1">
            <div class="clearfix">
              <div class="lab">
                <label for="keysearch">Keyword<span>*</span></label>
              </div>
              <div class="con"> <?php echo form_input( array( 'name'=>'keysearch','id'=>'keysearch','class'=>'input','type'=>'text','placeholder'=>'search comment by user or keyword')); ?> </div>
            </div>
          </div>
          <div id="keysearcherror" style="display:none;" class="error" align="right">Enter Keyword.</div>
        </div>
        <div class="btn-submit"> 
          <!-- Submit form --> 
          <?php echo form_input(array('name'=>'btnsearch','id'=>'btnsearch','class'=>'button','type'=>'submit','value'=>'Search','style'=>'margin-left:-48px;')); ?> or <a href="<?php echo site_url('couponcomments');?>" class="Cancel">Cancel</a> </div>
      </fieldset>
      <?php echo form_close(); ?> </div>
  </div>
  <!-- /box-content -->
  <?php } else { ?>
  <!-- box -->
  <div class="box">
    <div class="headlines">
      <h2><span>
        <?php if($this->uri->segment(2) && $this->uri->segment(2)=='searchresult')
	   {
	   	?>
        search results for '<?php echo $this->uri->segment(3);?>'
        <?php
	   } else { ?>
        <?php echo "Comments on coupons"; } ?></span></h2>
    </div>
    
    <!-- Correct form message -->
    <?php if( $this->session->flashdata('success') ) { ?>
    <div class="form-message correct">
      <p><?php echo $this->session->flashdata('success'); ?></p>
    </div>
    <?php } ?>
    <!-- Error form message -->
    <?php if( $this->session->flashdata('error') ) { ?>
    <div class="form-message error1">
      <p><?php echo $this->session->flashdata('error'); ?></p>
    </div>
    <?php } ?>
    <?php echo link_tag('colorbox/colorbox.css'); ?> 
    <script language="javascript" type="text/javascript" src="<?php echo base_url();?>colorbox/jquery.colorbox.js"></script> 
    <script language="javascript" type="text/javascript">
  $(document).ready(function(){
		//$('.colorbox').colorbox({'width':'55%'});
		$('.colorbox').colorbox({'width':'55%','height':'75%'});
		
  });
</script>

    <script type="text/javascript" language="javascript">
	function trim(stringToTrim) {
		return stringToTrim.replace(/^\s+|\s+$/g,"");
	}
	$(document).ready(function() {
		$("#btnsearch").click(function () {
	
			if( trim($("#keysearch").val()) == "" )
			{
				$("#error").attr('style','display:block;');
				$("#keysearcherror").show();
				$("#keysearch").val('').focus();
				return false;
			}
			else
			{
				$("#keysearcherror").hide();
			}
			
			if( $("#frmsearch").submit() )
			{
				$("#error").attr('style','display:none;');
			}
    	});
	
	});
</script> 
    <!-- box -->
    
    <div class="box-content"> <?php echo form_open('couponcomment/searchcomment',array('class'=>'formBox','id'=>'frmsearch')); ?>
      <fieldset>
        
        <!-- Error form message -->
        
        <div class="form-cols"><!-- two form cols -->
          <div class="col1">
            <div class="clearfix">
              <div class="lab">
                <label for="keysearch">Keyword<span>*</span></label>
              </div>
              <div class="con"> <?php echo form_input( array( 'name'=>'keysearch','id'=>'keysearch','class'=>'input','type'=>'text','placeholder'=>'search comment by user or keyword','value'=>$this->uri->segment(3))); ?> </div>
            </div>
          </div>
          <div id="keysearcherror" style="display:none;" class="error" align="right">Enter Keyword.</div>
        </div>
        <div class="btn-submit"> 
          <!-- Submit form --> 
          <?php echo form_input(array('name'=>'btnsearch','id'=>'btnsearch','class'=>'button','type'=>'submit','value'=>'Search','style'=>'margin-left:-48px;')); ?> or <a href="<?php echo site_url('couponcomment');?>" class="Cancel">Cancel</a> </div>
      </fieldset>
      <?php echo form_close(); ?> </div>


    <?php if( count($couponcomments) > 0 ) { ?><script language="javascript">
$(function(){
 
    // add multiple select / deselect functionality
    $("#selectall").click(function () {
          $('.case').attr('checked', this.checked);
    });
 
    // if all checkbox are selected, check the selectall checkbox
    // and viceversa
    $(".case").click(function(){
 
        if($(".case").length == $(".case:checked").length) {
            $("#selectall").attr("checked", "checked");
        } else {
            $("#selectall").removeAttr("checked");
        }
 
    });
});

function submitfrm()
{
	var len =$('[name="foo[]"]:checked').length;
	
	if(len==0)
	{
		alert("Select atleast one comment");
		return false;
	}
	
	
	$('#get_id').submit();
}
</script>
    <!-- table -->
    <form action="couponcomment/foo" id="get_id" method="post" class="formBox">
    <table class="">
      <tr class="">
      <td>
    <div style="height:25px;width:150px !important;" class="con">
    <select id="checktype" class="select" name="checktype" style="padding-top:1px;">
<option value="Enable">Enable</option>
<option value="Disable">Disable</option>
</select>
	
                
              </div>
              </td> <td><a onclick="submitfrm();" title="Submit" style="cursor:pointer;">Submit</a></td>
    </tr>
    </table>
    
    
    <table class="tab tab-drag couponcomments">
		<thead>
			<tr class="top nodrop nodrag">
			<?php 
			
			
			foreach($fields as $field_name => $field_display): ?>
				<?php if($field_name == 'id') { ?>
				<th><input type="checkbox" id="selectall" name="maincheck"/></th>
			<?php }else{ ?>
			<th <?php if ($sort_by == $field_name) echo "class=\"sort_$sort_order sorttitle \"" ?>>
				<?php
				if($sort_by == $field_name){ 
						$field_display .= "<img alt='desc' src='".site_url("images/sort_".$sort_order.".gif")."'/>";
				}?>
				
				<?php echo anchor("couponcomment/index/$field_name/" .
					(($sort_order == 'asc' && $sort_by == $field_name) ? 'desc' : 'asc') ,
					$field_display,array('class' => 'sorttitle')); ?>
			</th>
			<?php } ?>
			
			<?php endforeach; ?>
			<th>Action</th>
			
			</tr>
		</thead>
		
		<tbody>
			<?php foreach($couponcomments as $couponcomment): 
			
			?>
			<tr>
				<?php foreach($fields as $field_name => $field_display): ?>
				
				
				<td>
					<?php if($field_name == 'id'){ ?>
						
						<input type="checkbox" class="case" name="foo[]" value="<?php echo $couponcomment->id;?>" />
				 <?php					
					}elseif ($field_name == 'couponid'){
						$coupon = $this->couponcomments->get_coupon_byid($couponcomment->couponid); 
						echo $coupon['title'];
					}elseif ($field_name == 'commentby'){
						$user = $this->couponcomments->get_user_bysingleid($couponcomment->commentby); 
						echo $user['username'];
					}
					elseif ($field_name == 'status' ) { ?>
							<?php
							if( $couponcomment->$field_name == 'Enable' ){ ?>
								<a href="<?php echo site_url('couponcomment/disable/'.$couponcomment->id);?>" title="Click to Disable" class="btn btn-small btn-success" onClick="return confirm('Are you sure to Disable this user?');"><span><?php echo $couponcomment->$field_name; ?></span></a>
								
							<?php 
							}else{ ?>
								
							<a href="<?php echo site_url('couponcomment/enable/'.$couponcomment->id);?>" title="Click to Enable" class="btn btn-small btn-success" style="cursor:default; color: #CD0B1C;" onClick="return confirm('Are you sure to Enable this user?');"><span><?php echo $couponcomment->$field_name; ?></span></a>
						 <?php
							}
					}elseif($field_name == 'commentdate'){
						echo date('m-d-Y', strtotime($couponcomment->commentdate));
					}					
					else{
						echo $couponcomment->$field_name; 
					 }
					?>	
					
				</td>			
				<?php endforeach; ?>
				<td style='padding: 8px 4px;'>
					<a href="<?php echo site_url('couponcomment/edit/'.$couponcomment->id); ?>" title="Edit" class="ico ico-edit">Edit</a>
					<a href="<?php echo site_url('couponcomment/delete/'.$couponcomment->id);?>" title="Delete" class="ico ico-delete" onClick="return confirm('Are you sure to Delete this Coupon?');">Delete</a>
					<a href="<?php echo site_url('couponcomment/view/'.$couponcomment->id); ?>" title="View Detail" class="colorbox"><img width="16" height="17" border="0" src="images/detail.jpeg" alt="view"></a>
				</td>			
			</tr>
			<?php endforeach; ?>			
		</tbody>
		
	</table> 
    </form>
    
    <!-- /table --> 
    <!-- /pagination -->
    <?php  if($this->pagination->create_links()) { ?>
    <div class="pagination"> <?php echo $this->pagination->create_links(); ?> </div>
    <?php } ?>
    <!-- /pagination -->
    <?php } 
	else { ?>
    <!-- Warning form message -->
    <div class="form-message warning">
      <p>No records found.</p>
    </div>
    <?php } ?>
  </div>
  <!-- /box -->
  <?php } ?>
</div>
<!-- /#content --> 

<!-- #sidebar -->
<?php include('leftmenu.php'); ?>
<!-- /#sidebar --> 

<!-- #footer --> 
<?php echo $footer; ?>
<?php } ?>
