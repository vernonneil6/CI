<?php echo $header; ?>
<div id="content">

  <div class="breadcrumbs">
    <ul>
      <li class="home"><a href="<?php echo site_url('agentdashboard');?>" title="Dashboard">Dashboard</a></li>
    </ul>
  </div>


<div class="box">
    <div class="headlines">
      <h2><span><?php echo "Agent" ?></span></h2>
    </div>

    <?php if( count($agentall) > 0 ) { ?>
    <table class="tab tab-drag">
      <tr class="top nodrop nodrag">
        <th>Type</th>
	<th>Username</th>
        <th>Password</th>
      </tr>
      <?php foreach($agentall as $agents){ ?>
      <tr>
	<td><?php echo $agents->type; ?></td>
        <td><?php echo $agents->username; ?></td>
        <td><?php echo $agents->password; ?></td>
      </tr>
      <?php } ?>
    </table>
    <?php } ?>
</div>
</div>

<?php include('agentleftmenu.php'); ?>
<?php echo $footer; ?>