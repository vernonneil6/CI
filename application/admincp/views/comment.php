<?php if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'view' ) ) { ?>
<!-- box -->

<div class="box">
  <div class="headlines">
    <h2><span>Comment Detail</span></h2>
  </div>
  <?php if( count($comment)>0 ) { ?>
  <?php $user=$this->users->get_user_byid($comment[0]['commentby'])?>
  <?php $review=$this->reviews->get_review_byid($comment[0]['reviewid'])?>
  <table>
    <tr>
      <td width="120" valign="top"><b>Review</b></td>
      <td valign="top"><b>:</b></td>
      <td><?php if(count($review)>0) {
					echo nl2br(stripslashes($review[0]['comment'])); } ?></td>
    </tr>
    <tr>
      <td width="120" valign="top"><b>Comment</b></td>
      <td valign="top"><b>:</b></td>
      <td><?php echo nl2br(stripslashes($comment[0]['comment'])); ?></td>
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
      <td><?php echo date('M d Y',strtotime($comment[0]['commentdate']));?></td>
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
else { ?>
<?php echo $heading; ?> 
<!-- #content -->
<?php echo link_tag('colorbox/colorbox.css'); ?> 
  <script language="javascript" type="text/javascript" src="<?php echo base_url();?>colorbox/jquery.colorbox.js"></script> 
  <script language="javascript" type="text/javascript">
  $(document).ready(function(){
		
		$('.colorbox').colorbox({'width':'55%','height':'60%'});

 });
</script> 


<div id="content"> 
  
  <!-- breadcrumbs -->
  <div class="breadcrumbs">
    <ul>
      <li class="home"><a href="<?php echo site_url('dashboard');?>" title="Dashboard">Dashboard</a></li>
      <li><a href="<?php echo site_url('comment');?>" title="<?php echo $section_title; ?>"><?php echo $section_title; ?></a></li>
    </ul>
  </div>
  <!-- /breadcrumbs -->
  <?php //if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'search' ) ) { ?>
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
  <div class="box">
    <div class="headlines">		
			<h2><span> Comments on review: </span></h2>
       
        <h2><span>

        <a href="<?php if(!empty($_GET['s'])){ echo site_url('comment/csv/'.$_GET['s']); } else { echo site_url('comment/csv'); } ?>" title="Export as CSV file">
       <img src="<?php echo base_url(); ?>images/csv.jpeg" alt="" title="Export as CSV file" width="20" height="20"/>&nbsp;CSV </a>
        </span></h2>
	</div>
     <div class="box-content"> <?php echo form_open('comment/searchcomment',array('class'=>'formBox','id'=>'frmsearch')); ?>
      <fieldset>
        <!-- Error form message -->
        <div class="form-cols"><!-- two form cols -->
          <div class="col1">
            <div class="clearfix">
              <div class="lab">
                <label for="keysearch">Keyword<span>*</span></label>
              </div>
              <div class="con"> <?php echo form_input( array( 'name'=>'keysearch','id'=>'keysearch','class'=>'input','type'=>'text','placeholder'=>'Search comments by title or username','value'=>"")); ?> </div>
            </div>
          </div>
          <div id="keysearcherror" style="display:none;" class="error" align="right">Enter Keyword.</div>
        </div>
        <div class="btn-submit"> 
          <!-- Submit form --> 
          <?php echo form_input(array('name'=>'btnsearch','id'=>'btnsearch','class'=>'button','type'=>'submit','value'=>'Search','style'=>'margin-left:-48px;')); ?> or <a href="<?php echo site_url('user');?>" class="Cancel">Cancel</a> </div>
          
          <?php if(!empty($_GET['s']))
			{	   
				echo "<div style='margin-top:1em;'> Search results for <span style='color:#1a2e4d'>' ". $_GET['s'] . " ' </span> </div>";
			}
			
		?>
         
      </fieldset>
      <?php echo form_close(); ?> </div>
      
    
    <?php if( count($comments) > 0 ) { 
	  $order_seg = $this->uri->segment(4,"asc"); 
	  if($order_seg == "asc"){ $orderby = "desc";} else { $orderby = "asc"; }?>
	  <script language="javascript">
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

<form action="comment/foo" id="get_id" method="post" class="formBox">
    <!-- table --><table class="">
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
    
        <table class="tab tab-drag">
		<thead>
			<tr class="top nodrop nodrag">
			<?php 			
			
			foreach($fields as $field_name => $field_display): ?>
				<?php if($field_name == 'id') { ?>
				<th><input type="checkbox" id="selectall" name="maincheck"/></th>
			<?php }else{ ?>
			<th <?php if ($sort_by == $field_name) echo "class=\"sort_$sort_order sorttitle \"" ?>>
				<?php
				
				if($this->uri->segment(2) && $this->uri->segment(2)=='searchresult'){
					 echo anchor("comment/searchresult/$field_name/" .
						(($sort_order == 'asc' && $sort_by == $field_name) ? 'desc' : 'asc') ,
						$field_display,array('class' => 'sorttitle'));
				}else{ 					
					 echo anchor("comment/index/$field_name/" .
					(($sort_order == 'asc' && $sort_by == $field_name) ? 'desc' : 'asc') ,
					$field_display,array('class' => 'sorttitle')); 
				} ?>	
			</th>
			<?php } ?>
			
			<?php endforeach; ?>
			<th>View</th>
			</tr>
		</thead>
		
		<tbody>
			<?php foreach($comments as $comment): 
			
			?>
			<tr>
				<?php foreach($fields as $field_name => $field_display): ?>
				<td>
					<?php if($field_name == 'id'){ ?>
						
						<input type="checkbox" class="case" name="foo[]" value="<?php echo $comment->id;?>" />
				 <?php					
					}elseif ($field_name == 'comment'){
						echo nl2br(substr($comment->comment,0,100)).'...';
					}
					elseif($field_name == 'commentby'){
						
						 $username = $this->comments->get_user_bysingleid($comment->commentby); 
						 echo $username['username'];
						
									
					}elseif($field_name == 'commentdate'){
						echo date('m-d-Y', strtotime($comment->commentdate));
					}					
					elseif ($field_name == 'status' ) { ?>
							<?php
							if( $comment->$field_name == 'Enable' ){ ?>
								<a href="<?php echo site_url('comment/disable/'.$comment->id);?>" title="Click to Disable" class="btn btn-small btn-success" onClick="return confirm('Are you sure to Disable this user?');"><span><?php echo $comment->$field_name; ?></span></a>
								
							<?php 
							}else{ ?>
								
							<a href="<?php echo site_url('comment/enable/'.$comment->id);?>" title="Click to Enable" class="btn btn-small btn-success" style="cursor:default; color: #CD0B1C;" onClick="return confirm('Are you sure to Enable this user?');"><span><?php echo $comment->$field_name; ?></span></a>
						 <?php
							}
					}
					else{
						echo $comment->$field_name; 
					 }
					?>	
					
				</td>			
				<?php endforeach; ?>
				 <td>
					<?php if($this->uri->segment(2) && $this->uri->segment(2)=='searchresult') { ?>
						<a href="<?php echo site_url('comment/view/'.$comment->cid); ?>" title="View Detail" class="colorbox"><img width="16" height="17" border="0" src="images/detail.jpeg" alt="view">
						</a>
					<?php } else { ?>
						<a href="<?php echo site_url('comment/view/'.$comment->id); ?>" title="View Detail" class="colorbox"><img width="16" height="17" border="0" src="images/detail.jpeg" alt="view">
						</a>
					<?php } ?>
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
  <?php //} ?>
</div>
<!-- /#content --> 

<!-- #sidebar -->
<?php include('leftmenu.php'); ?>
<!-- /#sidebar --> 

<!-- #footer --> 
<?php echo $footer; ?>
<?php } ?>
