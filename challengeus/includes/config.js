function CheckFormat(id){
	var obj1 = document.getElementById('format1');
	var obj2 = document.getElementById('format2');
	var obj3 = document.getElementById('format3');
	var selval1 = obj1.options[obj1.selectedIndex].text;
	var selval2 = obj2.options[obj2.selectedIndex].text;
	var selval3 = obj3.options[obj3.selectedIndex].text;
	var listops = new Array("dd","mm","yyyy");
	
	if(id == 1){
		obj2.length = 0;
		obj3.length = 0;
		var j=0;
		for(i=0;i<=2;i++){
			if(listops[i] != selval1){
				obj2.options[obj2.length] = new Option(listops[i],listops[i]);
				if(selval2 == listops[i]){
					obj2.selectedIndex = j;
				}
				j++;
			}
		}
	selval2 = obj2.options[obj2.selectedIndex].text;
	
		for(i=0;i<=2;i++){
			if(listops[i] != selval1 && listops[i] != selval2){
				obj3.options[obj3.length] = new Option(listops[i],listops[i]);
			}
		}
	}else{
		obj3.length = 0;
		for(i=0;i<=2;i++){
			if(listops[i] != selval1 && listops[i] != selval2){
				obj3.options[obj3.length] = new Option(listops[i],listops[i]);
			}
		}
	}
}

function submitenter(e){
	var keycode;
	if (window.event) keycode = window.event.keyCode;
	else if (e) keycode = e.which;
	else return true;
	
	if (keycode == 13){
	   AddUserToList();
	   return false;
	}else{
	   return true;
	}
}

join_jq().ready(function() {
	join_jq("#addtolist").autocomplete('admin.php?Search', {
		matchContains: true,
		selectFirst: false,
		mustMatch: true,
		autoFill: true,
		minChars: 1
	}).result(function(){AddUserToList();});
});

function AddUserToList(){
	var newop = document.getElementById('addtolist').value;
	if(newop !=""){
		var obj = document.getElementById('specialprivs');
		obj.options[obj.length] = new Option(newop,newop);
	}
	document.getElementById('addtolist').value = "";
	BuildUserList();
}
function DelUser(obj){
	if(obj.length > 0){
		if(obj.options[obj.selectedIndex] !=""){
			var sure = confirm(suredeluser);
			if(sure){
				obj.remove(obj.selectedIndex);
			}
			BuildUserList();
		}
	}
}
function unique(a){
   var r = new Array();
   o:for(var i = 0, n = a.length; i < n; i++)
   {
      for(var x = 0, y = r.length; x < y; x++)
      {
         if(r[x]==a[i]) continue o;
      }
      r[r.length] = a[i];
   }
   return r;
}
function BuildUserList(){
	var obj = document.getElementById('specialprivs');
	var newlist = new Array();
	var userlist = "";
	for(var i=0;i<obj.options.length;i++){
		if(obj.options[i].value !=""){
			newlist[i] = obj.options[i].value;
		}
	}
	newlist = unique(newlist);	
	newlist.sort();	
	for(var i=0;i<newlist.length;i++){
		userlist += ","+newlist[i];
	}
	document.getElementById('newspecialprivs').value = userlist.substring(1);
}	 