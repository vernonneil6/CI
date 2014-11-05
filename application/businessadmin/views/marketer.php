<?php echo $header; ?>
<div id="content">

  <div class="breadcrumbs">
    <ul>
      <li class="home"><a href="<?php echo site_url('marketer');?>" title="Dashboard">Dashboard</a></li>
    </ul>
  </div>


<div class="box">
    <div class="headlines">
      <h2><span><?php echo "Marketer" ?></span></h2>
    </div>

    <?php if( count($marketerall) > 0 ) { ?>
    <table class="tab tab-drag">
      <tr class="top nodrop nodrag">
        <th>Type</th>
	<th>Username</th>
        <th>Password</th>
      </tr>
      <?php foreach($marketerall as $marketers){ ?>
      <tr>
	<td><?php echo $marketers->type; ?></td>
        <td><?php echo $marketers->username; ?></td>
        <td><?php echo $marketers->password; ?></td>
      </tr>
      <?php } ?>
    </table>
    <?php } ?>
</div>
</div>

<?php include('marketerleftmenu.php'); ?>
<?php echo $footer; ?>