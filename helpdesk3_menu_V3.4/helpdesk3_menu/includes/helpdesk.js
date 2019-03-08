
function hdu_show(hduTable,showfin,showcom){
	if (hduTable=="ticket") {
		document.getElementById('hduTableTicket').style.display='';
		document.getElementById('hdu_t').disabled=true;
		document.getElementById('hdu_d').disabled=false;
		document.getElementById('hduTableDetails').style.display='none';
		if(showfin==1)
		{
			document.getElementById('hduTableFinance').style.display='none';
			document.getElementById('hdu_f').disabled=false;
		}
		if(showcom==1)
		{
			document.getElementById('hdu_c').disabled=false;
			document.getElementById('hduTableComment').style.display='none';
		}
	}
	if (hduTable=="details") {
		document.getElementById('hdu_t').disabled=false;
		document.getElementById('hdu_d').disabled=true;
		document.getElementById('hduTableTicket').style.display='none';
		document.getElementById('hduTableDetails').style.display='';
		if(showfin==1)
		{
			document.getElementById('hdu_f').disabled=false;
			document.getElementById('hduTableFinance').style.display='none';
		}
		if(showcom==1)
		{
			document.getElementById('hdu_c').disabled=false;
			document.getElementById('hduTableComment').style.display='none';
		}
	}
	if (hduTable=="finance") {
		document.getElementById('hdu_t').disabled=false;
		document.getElementById('hdu_d').disabled=false;
		document.getElementById('hduTableTicket').style.display='none';
		document.getElementById('hduTableDetails').style.display='none';
		if(showfin==1)
		{
			document.getElementById('hdu_f').disabled=true;
			document.getElementById('hduTableFinance').style.display='';
		}
		if(showcom==1)
		{
			document.getElementById('hdu_c').disabled=false;
			document.getElementById('hduTableComment').style.display='none';
		}
	}
	if (hduTable=="comment") {
		document.getElementById('hdu_t').disabled=false;
		document.getElementById('hdu_d').disabled=false;

		document.getElementById('hduTableTicket').style.display='none';
		document.getElementById('hduTableDetails').style.display='none';
		if(showfin==1)
		{
			document.getElementById('hdu_f').disabled=false;
			document.getElementById('hduTableFinance').style.display='none';
		}
		//if(showcom==1)
		//{
			document.getElementById('hduTableComment').style.display='';
			document.getElementById('hdu_c').disabled=true;
		//}
	}

}
