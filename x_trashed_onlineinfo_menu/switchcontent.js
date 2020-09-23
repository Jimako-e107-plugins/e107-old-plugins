// -------------------------------------------------------------------
// Switch Content Script- By Dynamic Drive, available at: http://www.dynamicdrive.com
// Created: Jan 5th, 2007
// Last updated: Jan 25th, 2007. Fixed defaultExpanded() feature not working when persistence is enabled (applicable only for 1st page load)
// -------------------------------------------------------------------

function switchcontent(className){
this.className=className
this.collapsePrev=false //Default: Collapse previous content each time
this.enablePersist=false //Default: Disable session only persistence
//Limit type of element to scan for on page for switch contents if 2nd function parameter is defined, for efficiency sake (ie: "div")
this.filter_content_tag=(arguments.length==2)? arguments[1].toLowerCase() : ""
}

switchcontent.prototype.setStatus=function(openHTML, closeHTML){ //PUBLIC: Set open/ closing HTML indicator. Optional
this.statusOpen=openHTML
this.statusClosed=closeHTML
}

switchcontent.prototype.setColor=function(openColor, closeColor){ //PUBLIC: Set open/ closing color of switch header. Optional
this.colorOpen=openColor
this.colorClosed=closeColor
}

switchcontent.prototype.setPersist=function(bool){ //PUBLIC: Enable/ disable persistence. Default is true.
this.enablePersist=bool
}

switchcontent.prototype.collapsePrevious=function(bool){ //PUBLIC: Enable/ disable collapse previous content. Default is false.
this.collapsePrev=bool
}


switchcontent.prototype.sweepToggle=function(setting){ //PUBLIC: Expand/ contract all contents method. (Values: "contract"|"expand")
if (typeof this.headers!="undefined" && this.headers.length>0){ //if there are switch contents defined on the page
for (var i=0; i<this.headers.length; i++){
if (setting=="expand")
this.expandcontent(this.headers[i]) //expand each content
else if (setting=="contract")
this.contractcontent(this.headers[i]) //contract each content
}
}
}


// -------------------------------------------------------------------
// PUBLIC: defaultExpanded(indices_of_contents)- Set contents that should be expanded by default when the page loads.
// Note that the persistence feature (if enabled) overrides this setting.
// Pass in the position of the contents relative to the rest of the contents ie: defaultExpanded(0,2,3) would expand the 1st, 3rd, and 4th contents by default
// -------------------------------------------------------------------

switchcontent.prototype.defaultExpanded=function(){
var expandedindices=[] //Array to hold indices (position) of content to be expanded by default
//Loop through function arguments, and store each one within array
//Two test conditions: 1) End of Arguments array, or 2) If "collapsePrev" is enabled, only the first entered index (as only 1 content can be expanded at any time)
for (var i=0; (!this.collapsePrev && i<arguments.length) || (this.collapsePrev && i==0); i++)
expandedindices[expandedindices.length]=arguments[i]
this.expandedindices=expandedindices.join(",") //convert array into a string of the format: "0,2,3" for later parsing by script
}


//PRIVATE: Sets color of switch header.

switchcontent.prototype.togglecolor=function(header, status){
if (typeof this.colorOpen!="undefined")
header.style.color=status
}


//PRIVATE: Sets status indicator HTML of switch header.

switchcontent.prototype.togglestatus=function(header, status){
if (typeof this.statusOpen!="undefined")
header.firstChild.innerHTML=status
}


//PRIVATE: Contracts a content based on its corresponding header entered

switchcontent.prototype.contractcontent=function(header){
var innercontent=document.getElementById(header.id.replace("-title", "")) //Reference content for this header
innercontent.style.display="none"
this.togglestatus(header, this.statusClosed)
this.togglecolor(header, this.colorClosed)
}


//PRIVATE: Expands a content based on its corresponding header entered

switchcontent.prototype.expandcontent=function(header){
var innercontent=document.getElementById(header.id.replace("-title", ""))
innercontent.style.display="block"
this.togglestatus(header, this.statusOpen)
this.togglecolor(header, this.colorOpen)
}

// -------------------------------------------------------------------
// PRIVATE: toggledisplay(header)- Toggles between a content being expanded or contracted
// If "Collapse Previous" is enabled, contracts previous open content before expanding current
// -------------------------------------------------------------------

switchcontent.prototype.toggledisplay=function(header){
var innercontent=document.getElementById(header.id.replace("-title", "")) //Reference content for this header
if (innercontent.style.display=="block")
this.contractcontent(header)
else{
this.expandcontent(header)
if (this.collapsePrev && typeof this.prevHeader!="undefined" && this.prevHeader.id!=header.id) // If "Collapse Previous" is enabled and there's a previous open content
this.contractcontent(this.prevHeader) //Contract that content first
}
if (this.collapsePrev)
this.prevHeader=header //Set current expanded content as the next "Previous Content"
}


// -------------------------------------------------------------------
// PRIVATE: collectElementbyClass()- Searches and stores all switch contents (based on shared class name) and their headers in two arrays
// Each content should carry an unique ID, and for its header, an ID equal to "CONTENTID-TITLE"
// -------------------------------------------------------------------

switchcontent.prototype.collectElementbyClass=function(classname){ //Returns an array containing DIVs with specified classname
var classnameRE=new RegExp("(^|\\s+)"+classname+"($|\\s+)", "i") //regular expression to screen for classname within element
this.headers=[], this.innercontents=[]
if (this.filter_content_tag!="") //If user defined limit type of element to scan for to a certain element (ie: "div" only)
var allelements=document.getElementsByTagName(this.filter_content_tag)
else //else, scan all elements on the page!
var allelements=document.all? document.all : document.getElementsByTagName("*")
for (var i=0; i<allelements.length; i++){
if (typeof allelements[i].className=="string" && allelements[i].className.search(classnameRE)!=-1){
if (document.getElementById(allelements[i].id+"-title")!=null){ //if header exists for this inner content
this.headers[this.headers.length]=document.getElementById(allelements[i].id+"-title") //store reference to header intended for this inner content
this.innercontents[this.innercontents.length]=allelements[i] //store reference to this inner content
}
}
}
}


//PRIVATE: init()- Initializes Switch Content function (collapse contents by default unless exception is found)

switchcontent.prototype.init=function(){
var instanceOf=this
this.collectElementbyClass(this.className) //Get all headers and its corresponding content based on shared class name of contents
if (this.headers.length==0)
return //If no headers are present (no contents to switch), just exit
// Get ids of open contents below. Three possible scenerios:
// 1) Persistence is enabled AND corresponding cookie contains a non blank ("") string, indicating this isn't the first page load
// 2) Or, check to see if there are contents that should be enabled by default (even if persistence is enabled and this IS the first page load)
// 3) Or, default to no contents should be expanded on page load ("" value)
var opencontents_ids=(this.enablePersist && switchcontent.getCookie(this.className)!="")? ','+switchcontent.getCookie(this.className)+',' : (this.expandedindices)? ','+this.expandedindices+',' : ""
for (var i=0; i<this.headers.length; i++){ //BEGIN FOR LOOP (1)
if (typeof this.statusOpen!="undefined") //If open/ closing HTML indicator is enabled/ set
this.headers[i].innerHTML='<span class="status"></span>'+this.headers[i].innerHTML //Add a span element to original HTML to store indicator
if (opencontents_ids.indexOf(','+i+',')!=-1){ //(2) if index "i" exists within cookie string or default-enabled string (i=position of the content to expand)
this.expandcontent(this.headers[i]) //Expand each content per stored indices (if ""Collapse Previous" is set, only one content)
if (this.collapsePrev) //If "Collapse Previous" set
this.prevHeader=this.headers[i]  //Indicate the expanded content's corresponding header as the last clicked on header (for logic purpose)
}
else //else if no indices found in stored string
this.contractcontent(this.headers[i]) //Contract each content by default
this.headers[i].onclick=function(){instanceOf.toggledisplay(this)}
}
if (this.enablePersist)
switchcontent.dotask(window, function(){instanceOf.rememberpluscleanup()}, "unload") //Call persistence method onunload
}


// -------------------------------------------------------------------
// PRIVATE: rememberpluscleanup()- Stores the indices of content that are expanded inside session only cookie
// If "Collapse Previous" is enabled, only 1st expanded content index is stored
// -------------------------------------------------------------------

switchcontent.prototype.rememberpluscleanup=function(){ //store index of opened ULs relative to other ULs in Tree into cookie
// Define array to hold ids of open content that should be persisted
// Default to just "none" to account for the case where no contents are open when user leaves the page (and persist that):
var opencontents=new Array("none")
for (var i=0; i<this.innercontents.length; i++){
//If persistence enabled, content in question is expanded, and either "Collapse Previous" is disabled, or if enabled, this is the first expanded content
if (this.enablePersist && this.innercontents[i].style.display=="block" && (!this.collapsePrev || (this.collapsePrev && opencontents.length<2)))
opencontents[opencontents.length]=i //save the index of the opened UL (relative to the entire list of ULs) as an array element
this.headers[i].onclick=null //Cleanup code
}
if (opencontents.length>1) //If there exists open content to be persisted
opencontents.shift() //Boot the "none" value from the array, so all it contains are the ids of the open contents
if (typeof this.statusOpen!="undefined") //Cleanup code
this.statusOpen=this.statusClosed=null //Cleanup code
switchcontent.setCookie(this.className, opencontents.join(",")) //populate cookie with indices of open contents: classname=1,2,3,etc
}


// -------------------------------------------------------------------
// A few utility functions below:
// -------------------------------------------------------------------


switchcontent.dotask=function(target, functionref, tasktype){ //assign a function to execute to an event handler (ie: onunload)
var tasktype=(window.addEventListener)? tasktype : "on"+tasktype
if (target.addEventListener)
target.addEventListener(tasktype, functionref, false)
else if (target.attachEvent)
target.attachEvent(tasktype, functionref)
}

switchcontent.getCookie=function(Name){ 
var re=new RegExp(Name+"=[^;]+", "i"); //construct RE to search for target name/value pair
if (document.cookie.match(re)) //if cookie found
return document.cookie.match(re)[0].split("=")[1] //return its value
return ""
}

switchcontent.setCookie=function(name, value){
document.cookie = name+"="+value
}