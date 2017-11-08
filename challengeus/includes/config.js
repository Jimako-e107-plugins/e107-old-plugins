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