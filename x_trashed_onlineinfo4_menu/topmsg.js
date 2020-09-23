///////////////do not edit below this line////////////////////////////////////////
var ie=document.all
var ieNOTopera=document.all&&navigator.userAgent.indexOf("Opera")==-1

function regenerate(){
window.location.reload()
}

function regenerate2(){
if (document.layers)
setTimeout("window.onresize=regenerate",400)
}

var which=0

function flash(){
if (which==0){
if (document.layers)
topmsg_obj.bgColor=flashtocolor
else
topmsg_obj.style.backgroundColor=flashtocolor
which=1
}
else{
if (document.layers)
topmsg_obj.bgColor=backgroundcolor
else
topmsg_obj.style.backgroundColor=backgroundcolor
which=0
}
}

if (ie||document.getElementById)
document.write('<div id="topmsg" style="position:absolute;visibility:hidden;width:'+guestwidth+';height:'+guestheight+';">'+message+'</div>')

var topmsg_obj=ie? document.all.topmsg : document.getElementById? document.getElementById("topmsg") : document.topmsg

function positionit(){
var dsocleft=ie? document.body.scrollLeft : pageXOffset
var dsoctop=ie? document.body.scrollTop : pageYOffset
var window_width=ieNOTopera? document.body.clientWidth : window.innerWidth-20
var window_height=ieNOTopera? document.body.clientHeight : window.innerHeight

if (ie||document.getElementById){
topmsg_obj.style.left=parseInt(dsocleft)+window_width/2-topmsg_obj.offsetWidth/2
topmsg_obj.style.top=parseInt(dsoctop)+parseInt(window_height)-topmsg_obj.offsetHeight-4
}
else if (document.layers){
topmsg_obj.left=dsocleft+window_width/2-topmsg_obj.document.width/2
topmsg_obj.top=dsoctop+window_height-topmsg_obj.document.height-4

}
}

function setmessage(){
if (displaymode==2&&(!display_msg_or_not()))
return
if (document.layers){
topmsg_obj=new Layer(window.innerWidth)
topmsg_obj.bgColor=backgroundcolor
regenerate2()
topmsg_obj.document.write(message)
topmsg_obj.document.close()
positionit()
topmsg_obj.visibility="show"
if (displayduration!=0)
setTimeout("topmsg_obj.visibility='hide'",displayduration)
}
else{
positionit()
topmsg_obj.style.backgroundColor=backgroundcolor
topmsg_obj.style.visibility="visible"
if (displayduration!=0)
setTimeout("topmsg_obj.style.visibility='hidden'",displayduration)
}
setInterval("positionit()",100)
if (flashmode==1)
setInterval("flash()",1000)
}

function get_cookie(Name) {
var search = Name + "="
var returnvalue = ""
if (document.cookie.length > 0) {
offset = document.cookie.indexOf(search)
if (offset != -1) {
offset += search.length
end = document.cookie.indexOf(";", offset)
if (end == -1)
end = document.cookie.length;
returnvalue=unescape(document.cookie.substring(offset, end))
}
}
return returnvalue;
}

function display_msg_or_not(){
if (get_cookie("displaymsg")==""){
document.cookie="displaymsg=yes"
return true
}
else
return false
}

if (document.layers||ie||document.getElementById)
window.onload=setmessage