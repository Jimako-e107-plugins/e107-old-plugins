// Gold System

/**
 *
 * @access public
 * @return void
 **/
function gold_ConfirmPurchase(item,cost)
{
	return confirm(gold_system_confirm_pre+" - " + item + " - " + gold_system_confirm_post + " " + cost);
}

/**
 *
 * @access public
 * @return void
 **/
function gold_menu(gold_obj)
{
	// check if a parameter passed in
	var gold_paramin=false
	if(typeof gold_obj != "undefined")
	{
		// yes
		gold_paramin=true;
	}
	var gold_divs=goldmenu_sections.length;

	// reads array of div IDs and their open/close status
	if(gold_paramin)
	{
		// an id has been passed in so expand /close that one
		// and set cookie
		// First get the index of the array element into gold_sub
		gold_sub=0;
		for (gold_i =0; gold_i<gold_divs;gold_i++)
		{
			if(goldmenu_sections[gold_i]==gold_obj)
			{
				// scan through the array of sections
				gold_sub=gold_i;
			}
		}
		// get the div's current status
		var gold_status=document.getElementById(goldmenu_sections[gold_sub]).style.display;
		if(gold_status=="none")
		{
		// currently hidden so open it and set cookie
			document.getElementById(goldmenu_sections[gold_sub]).style.display="";
			document.getElementById(goldmenu_sections[gold_sub]+"_div").style.backgroundImage="url('"+gold_menu_img_close+"')";
			goldCookieSet(goldmenu_sections[gold_sub],true,7);
		}
		else
		{
		// currently open so hide it and set cookie
			document.getElementById(goldmenu_sections[gold_sub]).style.display="none";
			document.getElementById(goldmenu_sections[gold_sub]+"_div").style.backgroundImage="url('"+gold_menu_img_open+"')";
			goldCookieSet(goldmenu_sections[gold_sub],false,7);
		}
	}
	else
	{
		// no parameter passed in with the div's id
		gold_divs=goldmenu_sections.length;
		if(goldCookieGet("gold_menu"))
		{
			// We have been through this before so get the cookies and set things as they were last time
			for(gold_i=0;gold_i < gold_divs;gold_i++)
			{
				// for each section get the cookie
				if(goldCookieGet(goldmenu_sections[gold_i])=="true")
				{
					// set to open and save the cookie
					document.getElementById(goldmenu_sections[gold_i]).style.display="";
					document.getElementById(goldmenu_sections[gold_i]+"_div").style.backgroundImage="url('"+gold_menu_img_close+"')";
					goldCookieSet(goldmenu_sections[gold_i],true,7);
				}
				else
				{
					// set to closed and save the cookie
					document.getElementById(goldmenu_sections[gold_i]).style.display="none";
					document.getElementById(goldmenu_sections[gold_i]+"_div").style.backgroundImage="url('"+gold_menu_img_open+"')";
					goldCookieSet(goldmenu_sections[gold_i],false,7);
				}
			}
		}
		else
		{
			// not done the menu before
			// so step through the array goldmenu_sections
			// how many items in the array
			gold_divs=goldmenu_sections.length;
			for(gold_i=0;gold_i < gold_divs;gold_i++)
			{

				if(goldmenu_open[gold_i])
				{
				// if this section is meant to be open (according to goldmenu_open) then open it
					document.getElementById(goldmenu_sections[gold_i]).style.display="";
					document.getElementById(goldmenu_sections[gold_i]+"_div").style.backgroundImage="url('"+gold_menu_img_close+"')";
					goldCookieSet(goldmenu_sections[gold_i],true,7);
				}
				else
				{
				// otherwise close it
					document.getElementById(goldmenu_sections[gold_i]).style.display="none";
					document.getElementById(goldmenu_sections[gold_i]+"_div").style.backgroundImage="url('"+gold_menu_img_open+"')";
					goldCookieSet(goldmenu_sections[gold_i],false,7);
				}
			}
		}
	}
	// we have processed this menu now from the defaults, in future use ethe users settings
	goldCookieSet("gold_menu",true,7);
}

function goldCookieSet(gold_cookname,gold_cookvalue,gold_cookexpires)
{
	var gold_exdate=new Date();
	gold_exdate.setDate(gold_exdate.getDate()+gold_cookexpires);
	document.cookie=gold_cookname+ "=" +escape(gold_cookvalue)+((gold_cookexpires==null) ? "" : ";expires="+gold_exdate.toGMTString());
}

function goldCookieGet(gold_cookname)
{
	if (document.cookie.length>0)
  	{
  		gold_c_start=document.cookie.indexOf(gold_cookname + "=");
  		if (gold_c_start!=-1)
    	{
    		gold_c_start=gold_c_start + gold_cookname.length+1;
    		gold_c_end=document.cookie.indexOf(";",gold_c_start);
    		if (gold_c_end==-1) gold_c_end=document.cookie.length;
    		return unescape(document.cookie.substring(gold_c_start,gold_c_end));
    	}
  	}
	return "";
}

