<?php echo $header;?>
<section class="container">
  <section class="main_contentarea">
    <div class="pr_testmnl_wrp brd_btm">
      <div class="head_sb_rvw">
      </div>
    </div>
    <div class="pr_testmnl_wrp tp_spc6">
      <?php echo form_open('review/feedbacks');?>
      <div class="rvw_fillwrp fdbk">
        <textarea class="txrareawrp fdbk_txt" id="review" name="review" maxlength="500"></textarea>
      </div>
      <div class="subt_btnn">
		<button type="submit" title="Submit"  id="btnsubmit" name="btnsubmit">Submit</button>
      </div>
      <?php echo form_close();?> </div>
           <div class="lgn_btnlogo" > <a href="<?php echo base_url();?>">
                        <img src="images/ygr_logos.png" class="logo_btm" alt="Yougotrated" title="Yougotrated"></a></div>
             </div>
  </section>
</section>

