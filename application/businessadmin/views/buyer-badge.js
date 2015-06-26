
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
document.getElementById("sample-buyer-seals").oncontextmenu=clickNS4;
document.getElementById("sample-buyer-seals1").oncontextmenu=clickNS4;
document.getElementById("buyer-seals").oncontextmenu=clickNS4;
document.getElementById("buyer-seals1").oncontextmenu=clickNS4;

}
else if (document.all&&!document.getElementById){
document.getElementById("sample-buyer-seals").oncontextmenu=clickIE4;
document.getElementById("sample-buyer-seals1").oncontextmenu=clickIE4;
document.getElementById("buyer-seals").oncontextmenu=clickIE4;
document.getElementById("buyer-seals1").oncontextmenu=clickIE4;
}

document.getElementById("sample-buyer-seals").oncontextmenu=new Function("alert(message);return false");

document.getElementById("sample-buyer-seals1").oncontextmenu=new Function("alert(message);return false");

document.getElementById("buyer-seals").oncontextmenu=new Function("alert(message);return false");

document.getElementById("buyer-seals1").oncontextmenu=new Function("alert(message);return false");

function disableRightClick(event) {
	
		alert('This is an copyright seal');
        console.log("This is an copyright seal");
		return false;
}
