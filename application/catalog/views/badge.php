<?php echo $header;?>
<section class="container">
  <section class="main_contentarea">
  <div class="innr_wrap">
	<h1 class="title_review">Review Page</h1>
      <div class="busdt_wrap">
      <?php echo form_open('badge/rating/'.md5($id))?>
      	<div class="main_bd_srchwrp">
      	<div class="bdsrch_wrp badge">
      	<h2 class="badgerating">Rating</h2>
            <div id="rating" class="badgetitle"></div>
        </div>
        <div class="bdsrch_wrp badge">
      	<h2 class="badgetitles">Title</h2>
           <div class="bd_srchwrp badgetitletext" id="rating"><input type='text' value='' name='titles' class="bdsrch_txtbx"></div>
        </div>
        <div class="bdsrch_wrp badge">
      	<h2 class="badgereview">Review</h2>
            <textarea cols='54' class='badgetextarea' rows='10' name='review'></textarea>
        </div>
	<input type='submit' value='Submit' class='badgesubmit ' name='submit'>
	<input type='hidden' value=<?php echo $id;?> name='toid'?>
	<input type='hidden' id='ratings' name='rate'/>  
	</div>
        </form>
      </div>
  </div>
<script>
$(document).ready(function(){
    $('#rating').raty({
    path: 'http://www.yougotrated.writerbin.com/images/',
    scoreName:  'entity.score',
    half: true,
    number:     5,
    click: function(score, evt) {
    $('#ratings').val(score);
    }
  });
});
</script>


<?php if(count($badgedetail)>0) {?>
<div class="hm_rght_panel badgeviews">
	 <div class="hm_live_menus badgesystem">Reviews</div>
        <div class="hm_rvw_wrp">
      
          <div class="review_block">
      
            <div class="review_rgt " style="width: 100% !important">
              <div class="review_ratng_wrp">
                <div class="rating">  </div>
                <div class="rat_title">
              
              <?php foreach($badgedetail as $detail){ ?>
	      <div class="outline_badgesystem">
              <label class="name_badgesystem"><?php if($detail->name!=''){echo $detail->name;}else{echo "Anonymous";}?></label>
	      <label class="rating_badgesystem"><div id='ratingstar' class="rating_system" data-rating=<?php echo $detail->rating; ?>></div></label>
	      <div class="title_badgesystem"><?php echo $detail->titles;?></div>
	      <div class="review_badgesystem"><?php echo $detail->review;?></div>
              </div>
	      <?php } ?>


                 </div>
              </div>
            </div>
          </div>

        
<script>
$(document).ready(function(){
$('.rating_system').raty({
  path: 'http://www.yougotrated.writerbin.com/images/',
  half: true,
  readOnly: true,
  score: function() {
    return $(this).attr('data-rating');
  }
});
});

</script>

        </div>
      </div>
  <?php } ?>


  </section>
</section>
<?php echo $footer;?>
<style>
.badgeviews
{
    margin-top: 50px;
    width: 100%;
}
.badgesystem
{
	background:black;
	color: white;
    font-family: MyriadPro-BlackSemiCn;
    font-size: 30px;
    height: 33px;
    padding: 5px;
}
.outline_badgesystem
{
	margin-bottom: 25px;
}
.name_badgesystem
{
    font-family: MyriadPro-BoldCond;
    font-size: 22px;
}
.rating_badgesystem
{
	float: right;
}
.title_badgesystem
{
}
.review_badgesystem
{
}
</style>