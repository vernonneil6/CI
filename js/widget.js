function popupwindow(w, h) {
  var left = (screen.width/2)-(w/2);
  var top = (screen.height/2)-(h/2);
  document.getElementById("review_popup").style.left = left+'px'; 
  document.getElementById("review_popup").style.top = top+'px';
  document.getElementById("review_popup").style.width = w+'px';
  document.getElementById("review_popup").style.height = h+'px';  
}

function showPopup(){
 
 document.getElementById('review_cover').style.display = 'block';
 document.getElementById('review_cover').style.visibility = 'visible';
}

function closePopup(){
 document.getElementById('review_cover').style.display = 'none'; 
 document.getElementById('review_cover').style.visibility = 'hidden';
}

popupwindow('500','560');
