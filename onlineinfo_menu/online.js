
var onlineinfooffsetxpoint=-60 //Customize x offset of tooltip
var onlineinfooffsetypoint=20 //Customize y offset of tooltip
var isie=document.all
var isns6=document.getElementById && !document.all
var onlineinfoenabletip=false
if (isie||isns6)
var onlineinfotipobj=document.all? document.all["onlineinfodhtmltooltip"] : document.getElementById? document.getElementById("onlineinfodhtmltooltip") : ""

function ietruebody(){
return (document.compatMode && document.compatMode!="BackCompat")? document.documentElement : document.body
}

function onlineinfoddrivetip(thetext, thecolor, thewidth){
if (isns6||isie){
if (typeof thewidth!="undefined") onlineinfotipobj.style.width=thewidth+"px"
if (typeof thecolor!="undefined" && thecolor!="") onlineinfotipobj.style.backgroundColor=thecolor
onlineinfotipobj.innerHTML=thetext
onlineinfoenabletip=true
return false
}
}

function onlineinfopositiontip(e){
if (onlineinfoenabletip){
var curX=(isns6)?e.pageX : event.clientX+ietruebody().scrollLeft;
var curY=(isns6)?e.pageY : event.clientY+ietruebody().scrollTop;
//Find out how close the mouse is to the corner of the window
var rightedge=isie&&!window.opera? ietruebody().clientWidth-event.clientX-onlineinfooffsetxpoint : window.innerWidth-e.clientX-onlineinfooffsetxpoint-20
var bottomedge=isie&&!window.opera? ietruebody().clientHeight-event.clientY-onlineinfooffsetypoint : window.innerHeight-e.clientY-onlineinfooffsetypoint-20

var leftedge=(onlineinfooffsetxpoint<0)? onlineinfooffsetxpoint*(-1) : -1000

//if the horizontal distance isnt enough to accomodate the width of the context menu
if (rightedge<onlineinfotipobj.offsetWidth)
//move the horizontal position of the menu to the left by its width
onlineinfotipobj.style.left=isie? ietruebody().scrollLeft+event.clientX-onlineinfotipobj.offsetWidth+"px" : window.pageXOffset+e.clientX-onlineinfotipobj.offsetWidth+"px"
else if (curX<leftedge)
onlineinfotipobj.style.left="5px"
else
//position the horizontal position of the menu where the mouse is positioned
onlineinfotipobj.style.left=curX+onlineinfooffsetxpoint+"px"

//same concept with the vertical position
if (bottomedge<onlineinfotipobj.offsetHeight)
onlineinfotipobj.style.top=isie? ietruebody().scrollTop+event.clientY-onlineinfotipobj.offsetHeight-onlineinfooffsetypoint+"px" : window.pageYOffset+e.clientY-onlineinfotipobj.offsetHeight-onlineinfooffsetypoint+"px"
else
onlineinfotipobj.style.top=curY+onlineinfooffsetypoint+"px"
onlineinfotipobj.style.visibility="visible"
}
}

function hideonlineinfoddrivetip(){
if (isns6||isie){
onlineinfoenabletip=false
onlineinfotipobj.style.visibility="hidden"
onlineinfotipobj.style.left="-1000px"
onlineinfotipobj.style.backgroundColor=""
onlineinfotipobj.style.width=""
}
}

document.onmousemove=onlineinfopositiontip