<?php echo $header; ?>


<div id="content">

  <div class="breadcrumbs">
    <ul>
      <li class="home"><a href="<?php echo site_url('dashboard');?>" title="Dashboard">Dashboard</a></li>
      <li><a href="<?php echo site_url('badge');?>" title="<?php echo $section_title; ?>"><?php echo $section_title; ?></a></li>
    </ul>
  </div>


<div class="box">
    <div class="headlines">
      <h2><span><?php echo "Badge" ?></span></h2>
    </div>
    
    <table class="tab tab-drag">
     <tbody><tr class="top nodrop nodrag"> </tr>       
     <tr class="odd">
        <td>Badge Url</td>
        <td>
        <textarea cols='90' rows='10'><a href="<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/badge/rating/'.md5($this->session->userdata['youg_admin']['id']);?>" target="_blank" title="Get Widget">
        <img src="<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/images/badge.png'; ?>" class="logo_btm" alt="Yougotrated" title="Yougotrated"  width='10%' ></a></textarea></td></tr>
        <tr class="odd">
        <td>Sample Image</td>
        <td>
		<a href="<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/badge/rating/'.md5($this->session->userdata['youg_admin']['id']);?>" target="_blank" title="Get Widget">
        <img src="<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/images/badge.png'; ?>" class="logo_btm" alt="Yougotrated" title="Yougotrated"  width='10%' ></a>
        </td>
      </tr>
    </tbody>
    </table>	
    
    <?php if( count($badges) > 0 ) { ?>
    <table class="tab tab-drag">
      <tr class="top nodrop nodrag">
        <th>Name</th>
        <th>Title</th>
        <th>Rating</th>
        <th>Review</th>
      </tr>
      <?php foreach($badges as $badge){ ?>
      <tr>
        <td><?php echo $badge->name; ?></td>
        <td><?php echo $badge->titles; ?></td>
        <td><div class='rating'  data-rating=<?php echo $badge->rating; ?>></div></td>
        <td><?php echo $badge->review; ?></td>
      </tr>
      <?php } ?>
    </table>
    <?php } ?>
   
</div>
<script>
$(document).ready(function(){
$('.rating').raty({
  path: '/images/',
  half: true,
  readOnly: true,
  score: function() {
    return $(this).attr('data-rating');
  }
});
});

</script>
</div>


<?php include('leftmenu.php'); ?>
<?php echo $footer; ?>
