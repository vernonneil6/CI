<?php echo $header;?>
<script type="text/javascript" src="js/rating/jquery.raty.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/font-awesome.css" type="text/css">
<style>
@font-face {
  font-family: 'FontAwesome';
  src: url('<?php echo base_url(); ?>/font/Font-Awesome/fontawesome-webfont.eot');
  src: url('<?php echo base_url(); ?>/font/Font-Awesome/fontawesome-webfont.eot?#iefix') format('embedded-opentype'),
    url('<?php echo base_url(); ?>/font/Font-Awesome/fontawesome-webfont.woff') format('woff'),
    url('<?php echo base_url(); ?>/font/Font-Awesome/fontawesome-webfont.ttf') format('truetype');
  font-weight: normal;
  font-style: normal;
}
</style>
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
					
					if($('#autopost').val() == "")
					{
					  $("#posterror").show();
                      $("#thumb-up").focus();
                      return false;
					}
					else
					{
					  $("#posterror").hide();
					}
					
					
				  if (!$("#terms-conditions").is(":checked")) {
						$('#terms-error').show();
						return false;
					}
					else
					{
						$('#terms-error').hide();
						return true;
					}
					
				  $("#form4").submit();
                   
              });
  
			$('#thumb-up').toggle(function(){
				$('#thumb-down').hide();
				$('#thumb-up').css({"color" : "#2c6a99"});
				$('#autopost').val("1");
			},function(){
				$('#thumb-down').show();
				$('#thumb-up').css({"color" : "black"});
				$('#autopost').val("");
			});
			
			$('#thumb-down').toggle(function(){
				$('#thumb-up').hide();
				$('#thumb-down').css({"color" : "#2c6a99"});
				$('#autopost').val("0");
			},function(){
				$('#thumb-up').show();
				$('#thumb-down').css({"color" : "black"});
				$('#autopost').val("");
			});
			
			
			
           });
      </script> 
      <?php echo form_open('review/update',array('class'=>'','id'=>'form4'));?>
      <div class="rvw_fillwrp">
        <div id="reviewtitleerror" class="error">Review title is required.</div>
        <div id="reviewerror" class="error">Review is required.</div>
        <div id="rateerror" class="error">Please choose a star rating.</div>
        <div id="posterror" class="error">Please choose review about your company.</div>
        <h3>HOW WOULD YOU RATE THIS COMPANY? <i class="rating_review"></i></h3>
        <h3>HOW WOULD YOU REVIEW THIS COMPANY? <i class="fa fa-thumbs-up thumb" id = "thumb-up"></i><i class="fa fa-thumbs-down thumb" id = "thumb-down"></i></h3>
        <h3>WHAT DO YOU HAVE TO SAY ABOUT THIS COMPANY?</h3>
		<input type = "hidden" value = "" name = "autopost" id = "autopost">
        <input class="txt_box review_txt_box" id="reviewtitle" name="reviewtitle" maxlength="80" placeholder="review title"/>
        <textarea class="txrareawrp" id="review" name="review" maxlength="500"></textarea>
        <div id="termscondn" class="review_txt_box">
			<input type="checkbox" id="terms-conditions" />
			<label>I understand that by posting this review that my name and email address will be shared with the merchant.</label>
			<div><label id="terms-error" style='display:none;color:#ff0000;'>Please indicate that you accept the Terms and Conditions</label></div>
		</div>
        <button type="submit" title="Submit" class="rev_sbt_btn " id="btnsubmit" name="btnsubmit">Submit</button><?php echo form_hidden( array( 'companyid' => $this->encrypt->encode($companyid) ) ); ?>
      </div>
      
      <?php echo form_close();?> </div>
           <div class="lgn_btnlogo" > <a href="<?php echo base_url();?>">
                        <img src="images/ygr_logos.png" class="logo_btm" alt="Yougotrated" title="Yougotrated"></a></div>
             </div>
  </section>
</section>
<?php echo $footer;?>
