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
      <h2><span><?php echo "Buyer" ?></span></h2>
    </div>
    
    <table class="tab tab-drag">
     <tbody><tr class="top nodrop nodrag"> </tr>       
      
      <tr class="odd">
        <td>Buyer Protection Badge Url</td>
        <td>
        <textarea cols='90' rows='10'><a href="<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/complaint/dispute/'.$this->session->userdata['youg_admin']['id'];?>" target="_blank" title="Get Widget">
        <img src="<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/images/BuyersProtection_Badge.png'; ?>" class="logo_btm" alt="Yougotrated" title="Yougotrated"  width='10%' ></a></textarea>
        </td>
     </tr>


     <tr class="odd">
        <td>Sample Image</td>
        <td>
    <a href="<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/complaint/dispute/'.$this->session->userdata['youg_admin']['id'];?>" target="_blank" title="Get Widget">
        <img src="<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/images/BuyersProtection_Badge.png'; ?>" class="logo_btm" alt="Yougotrated" title="Yougotrated"  width='10%' ></a>
        </td>
      </tr>
    
    </tbody>
    </table>	
  
  <table class="tab tab-drag">
     <tbody><tr class="top nodrop nodrag"> </tr> 
      <tr class="odd">
        <td>
        <p>Your purchase is protected by the YouGotRated Buyers Protection program.</p>
        <p>Transaction ID: <?php echo $this->session->userdata['youg_admin']['id'];?> <br>
        To file a complaint -<a href="<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/complaint/dispute/'.$this->session->userdata['youg_admin']['id'];?>" target="_blank" title="File Complaint">Click Here</a><p>
        </td>
    </tr>

  </tbody>
    </table>      
   
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
