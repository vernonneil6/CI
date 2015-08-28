function ygrembeddedwidgetpopupwindow(w, h,src) {
	  
var target = document.getElementById("review_popup");
ifrm = document.createElement("IFRAME");
ifrm.setAttribute("src", src);
ifrm.setAttribute("id", 'ygrembbediframe');
 target.appendChild(ifrm);
  
}

function ygrembeddedwidgetshowPopup(src){
 ygrembeddedwidgetpopupwindow('500','565',src);
 document.body.style.overflow = "hidden";
 document.getElementById('review_cover').style.display = 'block';
 document.getElementById('review_cover').style.visibility = 'visible';

  
}

function ygrembeddedwidgetclosePopup(){
 document.getElementById('review_cover').style.display = 'none';
 var element = document.getElementById("ygrembbediframe");
element.parentNode.removeChild(element); 

 document.body.style.overflow = "visible";
 document.getElementById('review_cover').style.visibility = 'hidden';

}


