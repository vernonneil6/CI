function popupwindow(w, h) {
  var left = (screen.width/2)-(w/2);
  var top = (screen.height/2)-(h/2);
  document.getElementById("review_popup").style.left = '50%'; 
  document.getElementById("review_popup").style.top = '50%';
  document.getElementById("review_popup").style.width = w+'px';
  document.getElementById("review_popup").style.height = h+'px';  
  document.getElementById("review_popup").style.transform = 'translateX(-50%) translateY(-50%)';  
}

function showPopup(){
 popupwindow('500','565');
 document.body.style.overflow = "hidden";
 document.getElementById('review_cover').style.display = 'block';
 document.getElementById('review_cover').style.visibility = 'visible';
}

function closePopup(){
 document.getElementById('review_cover').style.display = 'none'; 
 document.body.style.overflow = "visible";
 document.getElementById('review_cover').style.visibility = 'hidden';
}


