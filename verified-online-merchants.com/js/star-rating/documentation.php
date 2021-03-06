<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head> 
 <title>jQuery Star Rating Plugin v4.11 (2013-03-14)</title>
 <!--// plugin-specific resources //-->
	<script src='jquery.js' type="text/javascript"></script>
	<script src='jquery.MetaData.js' type="text/javascript" language="javascript"></script>
 <script src='jquery.rating.js' type="text/javascript" language="javascript"></script>
 <link href='jquery.rating.css' type="text/css" rel="stylesheet"/>
 <!--// documentation resources //-->
 <!--<script src="http://code.jquery.com/jquery-migrate-1.1.1.js" type="text/javascript"></script>-->
 <link type="text/css" href="/@/js/jquery/ui/jquery.ui.css" rel="stylesheet" />
 <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/jquery-ui.min.js" type="text/javascript"></script>
 <link href='documentation/documentation.css' type="text/css" rel="stylesheet"/>
	<script src='documentation/documentation.js' type="text/javascript"></script>
</head>
<body>
<div class="Clear" id="wrap">
 <div class="Clear" id="head">

   
   <div id="tab-Testing">
    <h2>Test Suite</h2>
<script type="text/javascript" language="javascript">
$(function(){ 
 $('#form1 :radio.star').rating(); 
 $('#form2 :radio.star').rating({cancel: 'Cancel', cancelValue: '0'}); 
 $('#form3 :radio.star').rating(); 
 $('#form4 :radio.star').rating(); 
});
</script>
<script>
$(function(){
 $('#tab-Testing form').submit(function(){
  $('.test',this).html('');
  $('input',this).each(function(){
   if(this.checked) $('.test',this.form).append(''+this.name+': '+this.value+'<br/>');
		});
  return false;
 });
});
</script>

<div class="Clear">&nbsp;</div>


<script>
$(function(){
 $('.hover-star').rating({
  focus: function(value, link){
    // 'this' is the hidden form element holding the current value
    // 'value' is the value selected
    // 'element' points to the link element that received the click.
    var tip = $('#hover-test');
    tip[0].data = tip[0].data || tip.html();
    tip.html(link.title || 'value: '+value);
  },
  blur: function(value, link){
    var tip = $('#hover-test');
    $('#hover-test').html(tip[0].data || '');
  }
 });
});
</script>
<form id="form3B">
<strong style='font-size:150%'>Test 3-B</strong> - With hover effects
<table width="100%" cellspacing="10"> <tr>
  <td valign="top" width="">
<div class="Clear">
    Rating 1:
    (1 - 3, default 2)
    <div>
     <input class="hover-star" type="radio" name="test-3B-rating-1" value="1" title="Very poor"/>
     <input class="hover-star" type="radio" name="test-3B-rating-1" value="2" title="Poor"/>
     <input class="hover-star" type="radio" name="test-3B-rating-1" value="3" title="OK"/>
     <input class="hover-star" type="radio" name="test-3B-rating-1" value="4" title="Good"/>
     <input class="hover-star" type="radio" name="test-3B-rating-1" value="5" title="Very Good"/>
     <span id="hover-test" style="margin:0 0 0 20px;">Hover tips will appear in here</span>
    </div>
   </div>
   <div class="Clear">
    <pre class="code"><code class="js">$('.hover-star').rating({
  focus: function(value, link){
    var tip = $('#hover-test');
    tip[0].data = tip[0].data || tip.html();
    tip.html(link.title || 'value: '+value);
  },
  blur: function(value, link){
    var tip = $('#hover-test');
    $('#hover-test').html(tip[0].data || '');
  }
});</code></pre>
   </div>
  </td>
  <td valign="top" width="5">&nbsp;</td>  <td valign="top" width="50">
   <input type="submit" value="Submit scores!" />  </td>
  <td valign="top" width="5">&nbsp;</td>  <td valign="top" width="160">
   <u>Test results</u>:<br/><br/>
   <div class="test Smaller">
    <span style="color:#FF0000">Results will be displayed here</span>
   </div>
  </td>
 </tr>
</table>
</form>

<div class="Clear">&nbsp;</div><div class="Clear">&nbsp;</div>

<form id="form4">
<strong style='font-size:150%'>Test 4</strong> - <strong>Half Stars</strong> and <strong>Split Stars</strong>
<table width="100%" cellspacing="10"> <tr>
  <td valign="top" width="">
   <table width="100%">
    <tr>
     <td width="50%">
   <div class="Clear">
    Rating 1:
    (N/M/Y/?)
    <div><small><pre class="code"><code class="html">&lt;input class="star {half:true}"</code></pre></small></div>
    <input class="star {half:true}" type="radio" name="test-4-rating-1" value="N" title="No"/>
    <input class="star {half:true}" type="radio" name="test-4-rating-1" value="M" title="Maybe"/>
    <input class="star {half:true}" type="radio" name="test-4-rating-1" value="Y" title="Yes"/>
    <input class="star {half:true}" type="radio" name="test-4-rating-1" value="?" title="Don't Know"/>
   </div>
   <br/>
   <div class="Clear">
    Rating 2:
    (10 - 60)
    <div><small><pre class="code"><code class="html">&lt;input class="star {split:3}"</code></pre></small></div>
    <input class="star {split:3}" type="radio" name="test-4-rating-2" value="10"/>
    <input class="star {split:3}" type="radio" name="test-4-rating-2" value="20"/>
    <input class="star {split:3}" type="radio" name="test-4-rating-2" value="30"/>
    <input class="star {split:3}" type="radio" name="test-4-rating-2" value="40"/>
    <input class="star {split:3}" type="radio" name="test-4-rating-2" value="50"/>
    <input class="star {split:3}" type="radio" name="test-4-rating-2" value="60"/>
   </div>
   <br/>
   <div class="Clear">
    Rating 3:
    (0-5.0, default 3.5)
    <div><small><pre class="code"><code class="html">&lt;input class="star {split:2}"</code></pre></small></div>
    <input class="star {split:2}" type="radio" name="test-4-rating-3" value="0.5"/>
    <input class="star {split:2}" type="radio" name="test-4-rating-3" value="1.0"/>
    <input class="star {split:2}" type="radio" name="test-4-rating-3" value="1.5"/>
    <input class="star {split:2}" type="radio" name="test-4-rating-3" value="2.0"/>
    <input class="star {split:2}" type="radio" name="test-4-rating-3" value="2.5"/>
    <input class="star {split:2}" type="radio" name="test-4-rating-3" value="3.0"/>
    <input class="star {split:2}" type="radio" name="test-4-rating-3" value="3.5" checked="checked"/>
    <input class="star {split:2}" type="radio" name="test-4-rating-3" value="4.0"/>
    <input class="star {split:2}" type="radio" name="test-4-rating-3" value="4.5"/>
    <input class="star {split:2}" type="radio" name="test-4-rating-3" value="5.0"/>
   </div>
  </td>
  <td valign="top" width="50%">
   <div class="Clear">
    Rating 4:
    (1-6, default 5)
    <div><small><pre class="code"><code class="html">&lt;input class="star {split:2}"</code></pre></small></div>
    <input class="star {split:2}" type="radio" name="test-4-rating-4" value="1" title="Worst"/>
    <input class="star {split:2}" type="radio" name="test-4-rating-4" value="2" title="Bad"/>
    <input class="star {split:2}" type="radio" name="test-4-rating-4" value="3" title="OK"/>
    <input class="star {split:2}" type="radio" name="test-4-rating-4" value="4" title="Good"/>
    <input class="star {split:2}" type="radio" name="test-4-rating-4" value="5" title="Best" checked="checked"/>
    <input class="star {split:2}" type="radio" name="test-4-rating-4" value="6" title="Bestest!!!"/>
   </div>
   <br/>
   <div class="Clear">
    Rating 5:
    (1-20, default 11, required)
    <div><small><pre class="code"><code class="html">&lt;input class="star {split:4}"</code></pre></small></div>
    <input class="star {split:4} required" type="radio" name="test-4-rating-5" value="1"/>
    <input class="star {split:4}" type="radio" name="test-4-rating-5" value="2"/>
    <input class="star {split:4}" type="radio" name="test-4-rating-5" value="3"/>
    <input class="star {split:4}" type="radio" name="test-4-rating-5" value="4"/>
    <input class="star {split:4}" type="radio" name="test-4-rating-5" value="5"/>
    <input class="star {split:4}" type="radio" name="test-4-rating-5" value="6"/>
    <input class="star {split:4}" type="radio" name="test-4-rating-5" value="7"/>
    <input class="star {split:4}" type="radio" name="test-4-rating-5" value="8"/>
    <input class="star {split:4}" type="radio" name="test-4-rating-5" value="9"/>
    <input class="star {split:4}" type="radio" name="test-4-rating-5" value="10"/>
    <input class="star {split:4}" type="radio" name="test-4-rating-5" value="11" checked="checked"/>
    <input class="star {split:4}" type="radio" name="test-4-rating-5" value="12"/>
    <input class="star {split:4}" type="radio" name="test-4-rating-5" value="13"/>
    <input class="star {split:4}" type="radio" name="test-4-rating-5" value="14"/>
    <input class="star {split:4}" type="radio" name="test-4-rating-5" value="15"/>
    <input class="star {split:4}" type="radio" name="test-4-rating-5" value="16"/>
    <input class="star {split:4}" type="radio" name="test-4-rating-5" value="17"/>
    <input class="star {split:4}" type="radio" name="test-4-rating-5" value="18"/>
    <input class="star {split:4}" type="radio" name="test-4-rating-5" value="19"/>
    <input class="star {split:4}" type="radio" name="test-4-rating-5" value="20"/>
   </div>
   <br/>
   <div class="Clear">
    Rating 6 (readonly):
    (1-20, default 13)
    <div><small><pre class="code"><code class="html">&lt;input class="star {split:4}"</code></pre></small></div>
    <input class="star {split:4}" type="radio" name="test-4-rating-6" value="1" disabled="disabled"/>
    <input class="star {split:4}" type="radio" name="test-4-rating-6" value="2" disabled="disabled"/>
    <input class="star {split:4}" type="radio" name="test-4-rating-6" value="3" disabled="disabled"/>
    <input class="star {split:4}" type="radio" name="test-4-rating-6" value="4" disabled="disabled"/>
    <input class="star {split:4}" type="radio" name="test-4-rating-6" value="5" disabled="disabled"/>
    <input class="star {split:4}" type="radio" name="test-4-rating-6" value="6" disabled="disabled"/>
    <input class="star {split:4}" type="radio" name="test-4-rating-6" value="7" disabled="disabled"/>
    <input class="star {split:4}" type="radio" name="test-4-rating-6" value="8" disabled="disabled"/>
    <input class="star {split:4}" type="radio" name="test-4-rating-6" value="9" disabled="disabled"/>
    <input class="star {split:4}" type="radio" name="test-4-rating-6" value="10" disabled="disabled"/>
    <input class="star {split:4}" type="radio" name="test-4-rating-6" value="11" disabled="disabled"/>
    <input class="star {split:4}" type="radio" name="test-4-rating-6" value="12" disabled="disabled"/>
    <input class="star {split:4}" type="radio" name="test-4-rating-6" value="13" disabled="disabled" checked="checked"/>
    <input class="star {split:4}" type="radio" name="test-4-rating-6" value="14" disabled="disabled"/>
    <input class="star {split:4}" type="radio" name="test-4-rating-6" value="15" disabled="disabled"/>
    <input class="star {split:4}" type="radio" name="test-4-rating-6" value="16" disabled="disabled"/>
    <input class="star {split:4}" type="radio" name="test-4-rating-6" value="17" disabled="disabled"/>
    <input class="star {split:4}" type="radio" name="test-4-rating-6" value="18" disabled="disabled"/>
    <input class="star {split:4}" type="radio" name="test-4-rating-6" value="19" disabled="disabled"/>
    <input class="star {split:4}" type="radio" name="test-4-rating-6" value="20" disabled="disabled"/>
   </div>
     </td>
    </tr>
   </table>
  </td>
  <td valign="top" width="5">&nbsp;</td>  <td valign="top" width="50">
   <input type="submit" value="Submit scores!" />  </td>
  <td valign="top" width="5">&nbsp;</td>  <td valign="top" width="160">
   <u>Test results</u>:<br/><br/>
   <div class="test Smaller">
    <span style="color:#FF0000">Results will be displayed here</span>
   </div>
  </td>
 </tr>
</table>
</form>
   </div><!--// tab-Testing //-->


 </div>
 <div id="push"></div>
</div>


</body>
</html>
