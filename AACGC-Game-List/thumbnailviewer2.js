// -------------------------------------------------------------------
// Image Thumbnail Viewer II
// Last updated: Feb 5th, 2007
// -------------------------------------------------------------------

var thumbnailviewer2={
enableTitle: true, //Should "title" attribute of link be used as description?
enableTransition: true, //Enable fading transition in IE?
hideimgmouseout: false, //Hide enlarged image when mouse moves out of anchor link? (if enlarged image is hyperlinked, always set to false!)

/////////////No need to edit beyond here/////////////////////////

iefilterstring: 'progid:DXImageTransform.Microsoft.GradientWipe(GradientSize=1.0 Duration=0.7)', //IE specific multimedia filter string
iefiltercapable: document.compatMode && window.createPopup? true : false, //Detect browser support for IE filters
preloadedimages:[], //array to preload enlarged images (ones set to display "onmouseover"
targetlinks:[], //array to hold participating links (those with rel="enlargeimage:initType")
alreadyrunflag: false, //flag to indicate whether init() function has been run already come window.onload

loadimage:function(linkobj){
var imagepath=linkobj.getAttribute("href") //Get URL to enlarged image
var showcontainer=document.getElementById(linkobj.getAttribute("rev").split("::")[0]) //Reference container on page to show enlarged image in
var dest=linkobj.getAttribute("rev").split("::")[1] //Get URL enlarged image should be linked to, if any
var description=(thumbnailviewer2.enableTitle && linkobj.getAttribute("title"))? linkobj.getAttribute("title") : "" //Get title attr
var imageHTML='<img src="'+imagepath+'" style="border-width: 0" />' //Construct HTML for enlarged image
if (typeof dest!="undefined") //Hyperlink the enlarged image?
imageHTML='<a href="'+dest+'">'+imageHTML+'</a>'
if (description!="") //Use title attr of the link as description?
imageHTML+='<br />'+description
if (this.iefiltercapable){ //Is this an IE browser that supports filters?
showcontainer.style.filter=this.iefilterstring
showcontainer.filters[0].Apply()
}
showcontainer.innerHTML=imageHTML
this.featureImage=showcontainer.getElementsByTagName("img")[0] //Reference enlarged image itself
this.featureImage.onload=function(){ //When enlarged image has completely loaded
if (thumbnailviewer2.iefiltercapable) //Is this an IE browser that supports filters?
showcontainer.filters[0].Play()
}
this.featureImage.onerror=function(){ //If an error has occurred while loading the image to show
if (thumbnailviewer2.iefiltercapable) //Is this an IE browser that supports filters?
showcontainer.filters[0].Stop()
}
},

hideimage:function(linkobj){
var showcontainer=document.getElementById(linkobj.getAttribute("rev").split("::")[0]) //Reference container on page to show enlarged image in
showcontainer.innerHTML=""
},


cleanup:function(){ //Clean up routine on page unload
if (this.featureImage){this.featureImage.onload=null; this.featureImage.onerror=null; this.featureImage=null}
this.showcontainer=null
for (var i=0; i<this.targetlinks.length; i++){
this.targetlinks[i].onclick=null
this.targetlinks[i].onmouseover=null
this.targetlinks[i].onmouseout=null
}
},

addEvent:function(target, functionref, tasktype){ //assign a function to execute to an event handler (ie: onunload)
var tasktype=(window.addEventListener)? tasktype : "on"+tasktype
if (target.addEventListener)
target.addEventListener(tasktype, functionref, false)
else if (target.attachEvent)
target.attachEvent(tasktype, functionref)
},

init:function(){ //Initialize thumbnail viewer script
this.iefiltercapable=(this.iefiltercapable && this.enableTransition) //True or false: IE filters supported and is enabled by user
var pagelinks=document.getElementsByTagName("a")
for (var i=0; i<pagelinks.length; i++){ //BEGIN FOR LOOP
if (pagelinks[i].getAttribute("rel") && /enlargeimage:/i.test(pagelinks[i].getAttribute("rel"))){ //Begin if statement: Test for rel="enlargeimage"
var initType=pagelinks[i].getAttribute("rel").split("::")[1] //Get display type of enlarged image ("click" or "mouseover")
if (initType=="mouseover"){ //If type is "mouseover", preload the enlarged image for quicker display
this.preloadedimages[this.preloadedimages.length]=new Image()
this.preloadedimages[this.preloadedimages.length-1].src=pagelinks[i].href
pagelinks[i]["onclick"]=function(){ //Cancel default click action
return false
}
}
pagelinks[i]["on"+initType]=function(){ //Load enlarged image based on the specified display type (event)
thumbnailviewer2.loadimage(this) //Load image
return false
}
if (this.hideimgmouseout)
pagelinks[i]["onmouseout"]=function(){
thumbnailviewer2.hideimage(this)
}
this.targetlinks[this.targetlinks.length]=pagelinks[i] //store reference to target link
} //end if statement
} //END FOR LOOP


} //END init() function

}


if (document.addEventListener) //Take advantage of "DOMContentLoaded" event in select Mozilla/ Opera browsers for faster init
thumbnailviewer2.addEvent(document, function(){thumbnailviewer2.alreadyrunflag=1; thumbnailviewer2.init()}, "DOMContentLoaded") //Initialize script on page load
else if (document.all && document.getElementsByTagName("a").length>0){ //Take advantage of "defer" attr inside SCRIPT tag in IE for instant init
thumbnailviewer2.alreadyrunflag=1
thumbnailviewer2.init()
}
thumbnailviewer2.addEvent(window, function(){if (!thumbnailviewer2.alreadyrunflag) thumbnailviewer2.init()}, "load") //Default init method: window.onload
thumbnailviewer2.addEvent(window, function(){thumbnailviewer2.cleanup()}, "unload")