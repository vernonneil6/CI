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
						//return true;
					}
					
				  if($("#reviewpromo").val() != ''){
					  var requestData = {
						type: 'checkPromocode',
						companyid: $('#companyid_submit').val(),
						reviewpromo: $("#reviewpromo").val()
					  };
					  $.ajax({
					   type: "POST",
					   url: "/review/ajaxRequest",
					   data: requestData,
					   dataType:"json",
					   success: function(data){
						if(data.checkname=="1")
						{
							$('#reviewvalid').val(data.checkname);
						    $('#promoid').val(data.rpromoid);
							$("#form4").submit();
						}
						else
						{
						  $('#reviewvalid').val(data.checkname);
						  $('#promoid').val(data.rpromoid);
						  $('#promomessage').show();
						  $('#promomessage').html(data.promomsg);
						}
					   }
					  });
				   } else { $("#form4").submit(); }
				  
				  
				  
                   
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
      <?php echo form_open('review/addreview',array('class'=>'','id'=>'form4','onsubmit'=>'return false'));?>
      <div class="rvw_fillwrp">
        <div id="reviewtitleerror" class="error">Review title is required.</div>
        <div id="reviewerror" class="error">Review is required.</div>
        <div id="rateerror" class="error">Please choose a star rating.</div>
        <div id="posterror" class="error">Please choose review about your company.</div>
        <h3>HOW WOULD YOU RATE THIS COMPANY? <i class="rating_review"></i></h3>
        <h3>HOW WOULD YOU REVIEW THIS COMPANY? <i class="fa fa-thumbs-up thumb" id = "thumb-up"></i><i class="fa fa-thumbs-down thumb" id = "thumb-down"></i></h3>
        <h3>WHAT DO YOU HAVE TO SAY ABOUT THIS COMPANY?</h3>
		<input type = "hidden" value = "" name = "autopost" id = "autopost">
        <input class="txt_box review_txt_box" id="reviewtitle" name="reviewtitle" placeholder="review title"/>
        <textarea class="txrareawrp" id="review" name="review"></textarea>
        
        <!--Review Promo-->
       <input class="txt_box review_txt_box" id="reviewpromo" name="reviewpromo" placeholder="Please enter reviewpromo code here"/> <!-- <input type="button" id="applypromo" value="Apply code">  -->
        
        
        <div class = "profile_about_us">
		    <div class = "profile_about_data">
					<a href = "#readmore" class = "readmore font_color_1" id="applypromo1" style='display:none;'>Apply promo</a>
					
					
					<div id="promomessage" class="error" style="margin-left: -20px;"></div><div id="emailmediv" style="margin-top: -18px;margin-left: 12%;display:none">
						
						<a TARGET="_blank" href="<?php echo site_url('review/emailmepromo/'.$this->uri->segment(3).'');?>" id="emailme" name="emailme">Email me this promotion</a>
					</div>
		  </div>
		</div>
		
		<div id="readmore" style="width:500px;display:none">
			<div class = "profile_about_company">
				<h3>Review Promo code</h3>
			</div>
			<div class = "profile_about_data">
				<p>Promo code details:</p>
				<table>
				  <tr><td width="20%">Title</td><td><div id="texter" name="texter"></div></td></tr>
                  <tr><td width="20%">Summary</td><td><div id="sums" name="sums"></div></td></tr>
                  <tr><td width="20%">Coupon Link</td><td><a id="linker" TARGET="_blank">Click here</a></td></tr>
				</table> 
			
			</div>
		</div>
<link rel="stylesheet" href="<?php echo base_url();?>css/fancybox.css" type="text/css">
<script type="text/javascript" src="<?php echo base_url();?>js/fancybox.js"></script>
<script type="text/javascript" language="javascript">	
$(document).ready(function() 
{
	
 $("#applypromo").click(function(){
	 
	 
	  var requestData = {
			type: 'checkPromocode',
			companyid: $('#companyid_submit').val(),
			reviewpromo: $("#reviewpromo").val()
		  };
	  $.ajax({
	   type: "POST",
	   url: "/review/ajaxRequest",
	   data: requestData,
	   dataType:"json",
	   success: function(data){
		if(data.checkname=="1")
	    {
	      $('#reviewvalid').val(data.checkname);
	      $('#promoid').val(data.rpromoid);
	      $('#texter').html(data.title);
	      $('#sums').html(data.sums);
	      $("#linker").attr("href","<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/uploads/coupon'.'/main/';?>"+data.image);
	      $('#promomessage').show();
	      $('#emailmediv').show();
	      $('#promomessage').html(data.promomsg);
	      $('#applypromo1').trigger('click');
	      var emailpromoid=$('#promoid').val();
	      var emailhref = $('#emailme').attr("href");
	      $('#emailme').attr("href",emailhref+'/'+emailpromoid);
	    }
	    else
	    {
	      $('#reviewvalid').val(data.checkname);
	      $('#promoid').val(data.rpromoid);
	      $('#promomessage').show();
	      $('#promomessage').html(data.promomsg);
	    }
	   }
	  });
	  
   
	 $('.readmore').fancybox();
 
});

});

</script>
	 <!--Review Promo-->
        
        <div id="termscondn" class="review_txt_box">
			<input type="checkbox" id="terms-conditions" />
			<label>I understand that by posting this review that my name and email address will be shared with the merchant.</label>
			<div><label id="terms-error" style='display:none;color:#ff0000;'>Please indicate that you accept the Terms and Conditions</label></div>
		</div>
		<input type="hidden" id="promoid" name="promoid" value="">	
		<input type="hidden" id="reviewvalid" name="reviewvalid" value="">
		<input type="hidden" name="companyid" id="companyid_submit" value=<?php echo $this->encrypt->encode($companyid); ?> />
        <button type="submit" title="Submit" class="rev_sbt_btn " id="btnsubmit" name="btnsubmit">Submit</button>
        <?php //echo form_hidden( array( 'companyid' => $this->encrypt->encode($companyid) ) ); ?>
        
      </div>
      
      <?php echo form_close();?> </div>
           <div class="lgn_btnlogo" > <a href="<?php echo base_url();?>">
                        <img src="images/ygr_logos.png" class="logo_btm" alt="Yougotrated" title="Yougotrated"></a></div>
             </div>
  </section>
</section>
<?php echo $footer;?>
