jQuery(document).ready(function()
 {
 jQuery('.tooltip').tooltipster({

 theme: 'widget-tooltip',
 position: 'bottom',
 contentAsHTML: true

 });

 jQuery('.fancybox').fancybox();

 jQuery('.widget_close').click(function(){
 jQuery('.fancybox-overlay').hide();
 });
 });

 function countme(rid,vote)
 {
 jQuery.ajax({
 type : "POST",
 url : "<?php echo site_url('review/countme');?>",
 dataType : "json",
 data : {reviewid:rid,vote : vote},
 cache : false,
 success : function(data)
 {
 $('#'+vote+'_'+rid).html("<b>"+data.total+"</b>&nbsp;"+vote);

 }
 });
 }

 function check(ip,rid,vote)
 {

 jQuery.ajax({
 type : "POST",
 url : "<?php echo site_url('review/checkvote');?>",
 dataType : "json",
 data : { ip:ip,reviewid:rid,vote : vote},
 cache : false,
 success : function(data)
 {
 if(data.message == 'deleted')
 {
 $('#'+vote+'_'+rid).removeClass('vote-disable');
 $('#'+vote+'_'+rid).addClass('vote');
 }
 if(data.message == 'added')
 {
 $('#'+vote+'_'+rid).removeClass('vote');
 $('#'+vote+'_'+rid).addClass('vote-disable');
 }
 countme(rid,vote);
 }


 });

}
