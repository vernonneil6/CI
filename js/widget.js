function popupwindow(w, h,src) {
	
  var left = (screen.width/2)-(w/2);
  var top = (screen.height/2)-(h/2);
  document.getElementById("review_popup").style.left = '50%'; 
  document.getElementById("review_popup").style.top = '50%';
  document.getElementById("review_popup").style.width = w+'px';
  document.getElementById("review_popup").style.height = h+'px';  
  document.getElementById("review_popup").style.transform = 'translateX(-50%) translateY(-50%)';  
	//var iframe = document.getElementById("container_frame");
//var iframe_contents = iframe.contentDocument.body.innerHTML;
//alert(iframe_contents);
var target = document.getElementById("review_popup");
ifrm = document.createElement("IFRAME");
ifrm.setAttribute("src", src);
ifrm.style.width =  w+'px';
ifrm.style.height = h+'px';  
target.appendChild(ifrm);
  
}

function showPopup(src){
 popupwindow('500','565',src);
 document.body.style.overflow = "hidden";
 document.getElementById('review_cover').style.display = 'block';
 document.getElementById('review_cover').style.visibility = 'visible';
  
}

function closePopup(){
 document.getElementById('review_cover').style.display = 'none'; 
 document.body.style.overflow = "visible";
 document.getElementById('review_cover').style.visibility = 'hidden';
}


