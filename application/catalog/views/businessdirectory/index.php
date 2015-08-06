<?php echo $header;?>

<section class="container">
  <section class="main_contentarea">
    <div class="innr_wrap">
		<div class="bus_dir_head">
			<h1 class="bannertextcoupon">
				<span class="bannertextregular">Business </span>Directory
     		</h1>
		</div>
		
		<div class='headersearch'>
			
		<form method="GET" action="searchresult" id="business_search_form" class="formBox">
			<input type="text" class="headersearchbar" name="query" placeholder="Search for a Business..."  id="suggest"
				autocomplete="off" value="<?php isset($_GET['query'])?htmlentities($_GET['query']):''?>">

			<input type="hidden" class="input-large" name="city" id="city"  value="<?=isset($_GET['city'])?htmlentities($_GET['city']):''?>"> 
			<input type="hidden" class="input-large" name="state" id="state"  value="<?=isset($_GET['state'])?htmlentities($_GET['state']):''?>"> 
							
			<button id="send" type="submit" class="headersearchbtn fa fa-search" value="Submit" name="btnsearch"></button>
			
		<div class="orwrp">
		<div class="orinnrwrp"> </div>
		<h1 class="bus_tag"><a href="<?php echo site_url('businessdirectory/add');?>" title="Submit Business To YouGotRated Directory" class="complaintlist">SUBMIT A NEW BUSINESS</a></h1>
		</div>
		<div class="lgn_btnlogo"> <a href="<?php echo base_url();?>"><img src="images/ygr_logos.png" class="logo_btm" alt="Yougotrated" title="Yougotrated"></a> </div>

		</form>					 
		</div>
    </div>
  </section>
</section>
<?php echo $footer;?>
