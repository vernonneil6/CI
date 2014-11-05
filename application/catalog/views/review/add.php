<?php echo $header;?>
<script type="text/javascript" src="js/rating/jquery.raty.js"></script>
<script>
	$(document).ready(function() {
<!-------- Rating---------->
		  $('.rating_review').raty({ starOff : 'js/rating/img/star-off.png',
		  starOn : 'js/rating/img/star-on.png'});
	 }); 
</script>

<section class="container">
  <section class="main_contentarea">
    <div class="pr_testmnl_wrp brd_btm">
      <div class="head_sb_rvw">
        <h1><span></span> <?php echo strtoupper($company[0]['company']);?></h1>
        <h5>SUBMIT A REVIEW</h5>
      </div>
    </div>
    <div class="pr_testmnl_wrp tp_spc6"><script type="text/javascript" language="javascript">
          function trim(stringToTrim) {
              return stringToTrim.replace(/^\s+|\s+$/g,"");
          }
          $(document).ready(function() {
              
          
              $("#btnsubmit").click(function () {
          
          	 	if( trim($("#reviewtitle").val()) == "" )
                  {
                      $("#reviewtitleerror").show();
                      $("#reviewtitle").val('').focus();
                      return false;
                  }
                  else
                  {
                      $("#reviewtitleerror").hide();
                  }
				  
				if ($("input[name='score']").val()=='' )
                  {
                      $("#rateerror").show();
                      return false;
                  }
                  else
                  {
                      $("#rateerror").hide();
                  }
									
				 if( trim($("#review").val()) == "" )
                  {
                      $("#reviewerror").show();
                      $("#review").val('').focus();
                      return false;
                  }
                  else
                  {
                      $("#reviewerror").hide();
                  }
									
											$("#form4").submit();
                   
              });
  
           });
      </script> 
      <?php echo form_open('review/update',array('class'=>'','id'=>'form4'));?>
      <div class="rvw_fillwrp">
        <div id="reviewtitleerror" class="error">Review title is required.</div>
        <div id="reviewerror" class="error">Review is required.</div>
        <div id="rateerror" class="error">Please choose a star rating.</div>
        <h3>HOW WOULD YOU RATE THIS COMPANY? <i class="rating_review"></i></h3>
        <h3>WHAT DO YOU HAVE TO SAY ABOUT THIS COMPANY?</h3>
        <input class="txt_box" id="reviewtitle" name="reviewtitle" maxlength="80" placeholder="review title"/>
        <textarea class="txrareawrp" id="review" name="review" maxlength="500"></textarea>
      </div>
      <button type="submit" title="Submit" class="submt_btn" id="btnsubmit" name="btnsubmit">Submit</button><?php echo form_hidden( array( 'companyid' => $this->encrypt->encode($companyid) ) ); ?>
      <?php echo form_close();?> </div>
           <div class="lgn_btnlogo" > <a href="<?php echo base_url();?>">
                        <img src="images/ygr_logos.png" class="logo_btm" alt="Yougotrated" title="Yougotrated"></a></div>
             </div>
  </section>
</section>
<?php echo $footer;?>
