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
	  <?php echo form_open('businessdirectory/search',array('class'=>'formBox','name'=>'frmsearch','id'=>'frmsearch')); ?>
          <?php if( $this->uri->segment(1)=='complaint' && $this->uri->segment(2)=='search') { $serkeyword=base64_decode($this->uri->segment(3));} else { $serkeyword =''; } ?>
		<input type='text'  class='headersearchbar' placeholder="Search for a Business..." name="searchcomp"  id="search" value="<?php echo $serkeyword;?>" required maxlength="30">
		<input type="submit" class="headersearchbtn" value="SEARCH" name="btnsearch">
	 <?php echo form_close();?> 
    </div>
     <?php /* <form class="busdt_wrap" method="post" id="frmcompany" action="businessdirectory/search">
        <div class="main_bd_srchwrp">
          <div class="bdsrch_wrp">
            <h2>Search</h2>
            <div class="bd_srchwrp">
              <input type="text" class="bdsrch_txtbx" placeholder="ENTER CITY OR COMPANY NAME HERE" id="searchcomp" name="searchcomp" maxlength="100" required>
              <input type="submit" class="bdsrch_btn" title="Search" id="btnsearch" name="btnsearch" value="">
            </div>
          </div>
        </div>
        <div class="orwrp">
          <div class="orinnrwrp"> </div>
          <h1 class="bus_tag"><a href="<?php echo site_url('businessdirectory/add');?>" title="Submit Business To YouGotRated Directory" style="color:#0080FF;">SUBMIT A NEW BUSINESS</a></h1>
        </div>
        <div class="lgn_btnlogo"> <a href="<?php echo base_url();?>"><img src="images/ygr_logos.png" class="logo_btm" alt="Yougotrated" title="Yougotrated"></a> </div>
      </form>*/ ?>
    </div>
  </section>
</section>
<?php echo $footer;?>
