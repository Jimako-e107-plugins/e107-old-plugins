/*
***********************************************************************************************************
	(C) www.hdu_dhtmlgoodies.com, October 2005

	This is a script from www.hdu_dhtmlgoodies.com. You will find this and a lot of other scripts at our website.

	Updated:
		March, 11th, 2006 - Fixed positioning of tooltip when displayed near the right edge of the browser.
		April, 6th 2006, Using iframe in IE in order to make the tooltip cover select boxes.

	Terms of use:
	You are free to use this script as long as the copyright message is kept intact. However, you may not
	redistribute, sell or repost it without our permission.

	Thank you!

	www.hdu_dhtmlgoodies.com
	Alf Magne Kalleland

**********************************************************************************************************
*/
	var hdu_dhtmlgoodies_tooltip = false;
	var hdu_dhtmlgoodies_tooltipShadow = false;
	var hdu_dhtmlgoodies_shadowSize = 5;
	var hdu_dhtmlgoodies_tooltipMaxWidth = 300;
	var hdu_dhtmlgoodies_tooltipMinWidth = 100;
	var hdu_dhtmlgoodies_iframe = false;
	var tooltip_is_msie = (navigator.userAgent.indexOf('MSIE')>=0 && navigator.userAgent.indexOf('opera')==-1 && document.all)?true:false;
	function hdu_showTooltip(e,tooltipTxt)
	{
		var bodyWidth = Math.max(document.body.clientWidth,document.documentElement.clientWidth) - 20;

		if(!hdu_dhtmlgoodies_tooltip){
			hdu_dhtmlgoodies_tooltip = document.createElement('DIV');
			hdu_dhtmlgoodies_tooltip.id = 'hdu_dhtmlgoodies_tooltip';
			hdu_dhtmlgoodies_tooltipShadow = document.createElement('DIV');
			hdu_dhtmlgoodies_tooltipShadow.id = 'hdu_dhtmlgoodies_tooltipShadow';

			document.body.appendChild(hdu_dhtmlgoodies_tooltip);
			document.body.appendChild(hdu_dhtmlgoodies_tooltipShadow);

			if(tooltip_is_msie){
				hdu_dhtmlgoodies_iframe = document.createElement('IFRAME');
				hdu_dhtmlgoodies_iframe.frameborder='5';
				hdu_dhtmlgoodies_iframe.style.backgroundColor='#FFFFFF';
				hdu_dhtmlgoodies_iframe.src = '#';
				hdu_dhtmlgoodies_iframe.style.zIndex = 100;
				hdu_dhtmlgoodies_iframe.style.position = 'absolute';
				document.body.appendChild(hdu_dhtmlgoodies_iframe);
			}

		}

		hdu_dhtmlgoodies_tooltip.style.display='block';
		hdu_dhtmlgoodies_tooltipShadow.style.display='block';
		if(tooltip_is_msie)hdu_dhtmlgoodies_iframe.style.display='block';

		var st = Math.max(document.body.scrollTop,document.documentElement.scrollTop);
		if(navigator.userAgent.toLowerCase().indexOf('safari')>=0)st=0;
		var leftPos = e.clientX + 10;

		hdu_dhtmlgoodies_tooltip.style.width = null;	// Reset style width if it's set
		hdu_dhtmlgoodies_tooltip.innerHTML = tooltipTxt;
		hdu_dhtmlgoodies_tooltip.style.left = leftPos + 'px';
		hdu_dhtmlgoodies_tooltip.style.top = e.clientY + 10 + st + 'px';


		hdu_dhtmlgoodies_tooltipShadow.style.left =  leftPos + hdu_dhtmlgoodies_shadowSize + 'px';
		hdu_dhtmlgoodies_tooltipShadow.style.top = e.clientY + 10 + st + hdu_dhtmlgoodies_shadowSize + 'px';

		if(hdu_dhtmlgoodies_tooltip.offsetWidth>hdu_dhtmlgoodies_tooltipMaxWidth){	/* Exceeding max width of tooltip ? */
			hdu_dhtmlgoodies_tooltip.style.width = hdu_dhtmlgoodies_tooltipMaxWidth + 'px';
		}

		var tooltipWidth = hdu_dhtmlgoodies_tooltip.offsetWidth;
		if(tooltipWidth<hdu_dhtmlgoodies_tooltipMinWidth)tooltipWidth = hdu_dhtmlgoodies_tooltipMinWidth;


		hdu_dhtmlgoodies_tooltip.style.width = tooltipWidth + 'px';
		hdu_dhtmlgoodies_tooltipShadow.style.width = hdu_dhtmlgoodies_tooltip.offsetWidth + 'px';
		hdu_dhtmlgoodies_tooltipShadow.style.height = hdu_dhtmlgoodies_tooltip.offsetHeight + 'px';

		if((leftPos + tooltipWidth)>bodyWidth){
			hdu_dhtmlgoodies_tooltip.style.left = (hdu_dhtmlgoodies_tooltipShadow.style.left.replace('px','') - ((leftPos + tooltipWidth)-bodyWidth)) + 'px';
			hdu_dhtmlgoodies_tooltipShadow.style.left = (hdu_dhtmlgoodies_tooltipShadow.style.left.replace('px','') - ((leftPos + tooltipWidth)-bodyWidth) + hdu_dhtmlgoodies_shadowSize) + 'px';
		}

		if(tooltip_is_msie){
			hdu_dhtmlgoodies_iframe.style.left = hdu_dhtmlgoodies_tooltip.style.left;
			hdu_dhtmlgoodies_iframe.style.top = hdu_dhtmlgoodies_tooltip.style.top;
			hdu_dhtmlgoodies_iframe.style.width = hdu_dhtmlgoodies_tooltip.offsetWidth + 'px';
			hdu_dhtmlgoodies_iframe.style.height = hdu_dhtmlgoodies_tooltip.offsetHeight + 'px';

		}

	}

	function hdu_hideTooltip()
	{
		hdu_dhtmlgoodies_tooltip.style.display='none';
		hdu_dhtmlgoodies_tooltipShadow.style.display='none';
		if(tooltip_is_msie)hdu_dhtmlgoodies_iframe.style.display='none';
	}





