
//Disable right mouse click Script

var message="This is an copyright seal";

///////////////////////////////////
function clickIE4(){
if (event.button==2){
alert(message);
return false;
}
}

function clickNS4(e){
if (document.layers||document.getElementById&&!document.all){
if (e.which==2||e.which==3){
alert(message);
return false;
}
}
}

if (document.layers){
document.captureEvents(Event.MOUSEDOWN);
document.getElementById("sample-badge-seals").oncontextmenu=clickNS4;

}
else if (document.all&&!document.getElementById){
document.getElementById("sample-badge-seals").oncontextmenu=clickIE4;
}

document.getElementById("sample-badge-seals").oncontextmenu=new Function("alert(message);return false");

