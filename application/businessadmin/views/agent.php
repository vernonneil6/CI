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
      <h2><span><?php echo "Agent Url" ?></span></h2>
    </div>
    <table class="tab tab-drag">
     <tbody><tr class="top nodrop nodrag"> </tr>       
     <tr class="odd">
        <td>Subbroker Url</td>
        <td>
        <textarea cols='90' rows='10'>
			<?php echo 'http://localhost/index.php/signuppage/affid/'.$this->session->userdata['agent_data'][0]->id;?>
        </textarea>
        </td>
	 </tr>
     </tbody>
    </table>
	</div>

<?php } ?>

</div>

<?php include('agentleftmenu.php'); ?>
<?php echo $footer; ?>
