<?php
$counterscript .= '
<script type="text/javascript">
function GetCount$nexteventid(){
	
	dateEnd = new Date('.$nextshowcounter.');
	amount = dateEnd.getTime() - new Date().getTime();		

	if(amount < 0){	document.getElementById("currcountbox'.$nexteventid.'").innerHTML="...";}
	else{
	
		days=0;hours=0;mins=0;secs=0;out="";

		amount = Math.floor(amount/1000);//kill the "milliseconds" so just secs

		days=Math.floor(amount/86400);//days
		amount=amount%86400;

		hours=Math.floor(amount/3600);//hours
		amount=amount%3600;

		mins=Math.floor(amount/60);//minutes
		amount=amount%60;

		secs=Math.floor(amount);//seconds

		if(days != 0){out += days +" day"+((days!=1)?"s":"")+", ";}
		if(days != 0 || hours != 0){out += hours +" hour"+((hours!=1)?"s":"")+", ";}
		if(days != 0 || hours != 0 || mins != 0){out += mins +" minute"+((mins!=1)?"s":"")+", ";}
		out += secs +" seconds";
		document.getElementById("currcountbox'.$nexteventid.'").innerHTML=out;
		setTimeout("GetCount$nexteventid()", 1000);
	
}}

window.onload=GetCount$nexteventid;

</script>		
';
?>