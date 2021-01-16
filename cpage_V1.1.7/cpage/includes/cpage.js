/*
+---------------------------------------------------------------+
|        Enhanced Custom Pages for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2009
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
var cpage_current_id;
var cpage_current_page;
var cpage_typeofnp;
var cpage_oldhref;
var cpage_current_url=window.location.href;
var cpage_comvisible=false;
var cpage_comments_active=false;

//var nowon=0;
//var maxpages=0;
cpage_set_page_visibles();
cpage_set_links();
/**
 *
 * @access public
 * @return void
 **/

function cpage_set_links(){

	if(cpage_current_url.indexOf('.html')>0){
		// seo style urls
		// get the bit after -cpage-
		var cpage_afterbits=cpage_current_url.split('cpage-');
	//	alert(cpage_afterbits[1]);
		var cpage_secondbit = cpage_afterbits[1];
    	var fred=cpage_secondbit.split('-');
    	cpage_current_id=parseInt(fred[0]);
    	cpage_current_page=parseInt(fred[1]);
	}
	else {
	// non seo
    	var fred=cpage_current_url.split('?');
    	var tim=fred[1];
    	var bert=tim.split('.');
    	cpage_current_id=parseInt(bert[0]);
    	cpage_current_page=parseInt(bert[1]);
    }
    if(isNaN(cpage_current_page)){
		cpage_current_page=0;
    }

	 $$('.cpage_pagelinks').each(function(item) {
		cpage_typeofnp='old';
        Event.observe(item, 'click', function(event){
        	Event.stop(event);
            var href_clicked = item.readAttribute('href');
            //var fred=href_clicked.split('?');
            //var tim=fred[1];
            //var bert=tim.split('.');
            //var rec=bert[0];
            //var pag=bert[1];
            //cpage_goto(rec,pag);
            if(href_clicked.indexOf('.html')>0){
				// seo
					var cpage_afterbits=href_clicked.split('cpage-');
					var cpage_secondbit = cpage_afterbits[1];
					var fred=cpage_secondbit.split('-');
	    			var rec=parseInt(fred[0]);
    				var pag=parseInt(fred[1]);
    				var title='';
    				for(index=2;index<fred.length;++index){
    					title=title+fred[index]+'-';
    				}
    				// remove last -
    				title = title.slice(0, -1)
			}
			else {
			// non seo
    			var fred=href_clicked.split('?');
    			var tim=fred[1];
    			var bert=tim.split('.');
    			var rec=parseInt(bert[0]);
    			var pag=parseInt(bert[1]);
    		}
            //alert(rec);
           // alert(pag);

			cpage_goto(rec,pag);
        });
    });
    $$('.npbutton').each(function(item) {
    	cpage_typeofnp='new';
        Event.observe(item, 'click', function(event){
            Event.stop(event);
            var href_clicked = item.readAttribute('href');
			if(href_clicked.indexOf('.html')>0){
				// seo
					var cpage_afterbits=href_clicked.split('cpage-');
					var cpage_secondbit = cpage_afterbits[1];
					var fred=cpage_secondbit.split('-');
	    			var rec=parseInt(fred[0]);
    				var pag=parseInt(fred[1]);
    				var title='';
    				for(index=2;index<fred.length;++index){
    					title=title+fred[index]+'-';
    				}
    				// remove last -
    				title = title.slice(0, -1)
			}
			else {
			// non seo
    			var fred=href_clicked.split('?');
    			var tim=fred[1];
    			var bert=tim.split('.');
    			var rec=parseInt(bert[0]);
    			var pag=parseInt(bert[1]);
    		}
            //alert(rec);
           // alert(pag);

			cpage_goto(rec,pag);
        });
    });
    if(cpage_typeofnp=='new'){
    	var selector=$('cpageSelect');
		selector.setAttribute('onChange','cpage_selchange(this.value)');
        //Event.observe(selector,'change',function(event){
        //	Event.stop(event);
        //	alert("W");
        //});

    }
	if(cpage_typeofnp=='old'){
 		var dislink='cpage_goto-'+cpage_current_id+'-'+cpage_current_page;
		var element=$(dislink);
		cpage_oldhref= element.getAttribute('href');
		element.removeAttribute('href');
	}
	if(cpage_typeofnp=='new'){
		var element=$('cpage_prev');
		if(cpage_current_page==0){
			element.style.visibility='hidden';
		}
		else{
			element.style.visibility='visible';
		}
	}
}
/**
 *
 * @access public
 * @return void
 **/
function cpage_selchange(selector){
    	//var selector=$('cpageSelect');
    	//alert(selector);
	       // var href_clicked = item.readAttribute('href');
            var fred=selector.split('?');
            var tim=fred[1];
            var bert=tim.split('.');
            var rec=bert[0];
            var pag=bert[1];
            cpage_goto(rec,pag);
}
function cpage_goto(recordid,pagenumber,title){
	var url='cpage.php?'+recordid+'.'+pagenumber+'.ajax';
	if(cpage_typeofnp=='old'){
		var dislink='cpage_goto-'+cpage_current_id+'-'+cpage_current_page;
		var element=$(dislink);
		element.setAttribute('href',cpage_oldhref);
		cpage_current_id=recordid;
		cpage_current_page=pagenumber;
		var dislink='cpage_goto-'+cpage_current_id+'-'+cpage_current_page;
		element=$(dislink);
		cpage_oldhref= element.getAttribute('href');
		element.removeAttribute('href');
	}

	new Ajax.Request(url,{
		method:'get',
		onSuccess: function(transport){
		var ajaxResult=transport.responseText;
		var data=ajaxResult.evalJSON();
		nowon=data.nowon;
		cpage_current_id=data.page_id;
		maxpages=data.maxpages;
		//document.title=data.browser_title;
		//$('cpage_ptitle').text=data.browser_title;
		new Effect.SlideUp('cpage_body',{
			afterFinish: function (){
			$('cpage_body_c').update(data.content);
			new Effect.SlideDown('cpage_body',{queue:'end'});
			var prevp=nowon-1;
        	var nextp=nowon+1;
        	if(prevp<1){
        		prevp=0;
        	}
			if(cpage_typeofnp=='new'){
				// select dropdown for pages
		      	var seler=	$('cpageSelect');
      			seler.selectedIndex=nowon;

				var cpage_current_url=window.location.href;
				var baz=cpage_current_url.split('/');
				var endo=baz[baz.length-1];
    			var fred=endo.split('-');
    			var firstbit=baz.length-1;
    			var firsturl='';
				for(var index=0;index<firstbit;++index)
				{
					firsturl=firsturl+baz[index]+'/';
				}
    			new_url=firsturl+'cpage-'+cpage_current_id+'-'+prevp+'.html';
				$('cpage_prev').href=new_url;
				//	alert(new_url);
	    		new_url=firsturl+'cpage-'+cpage_current_id+'-'+nextp+'.html';
				$('cpage_next').href=new_url;
				element=$('cpage_prev');
				if(nowon<1){
					element.style.visibility='hidden';
				}
				else{
					element.style.visibility='visible';
				}
				//alert(nextp);
				element=$('cpage_next');
				if(nextp >= maxpages){
					nextp=maxpages;
					element.style.visibility='hidden';
				}
				else{
					element.style.visibility='visible';
				}
				$('cpage_ptitle').innerHTML=data.browser_title;
			}
			else
			{
				var cpage_current_url=window.location.href;
        		var fred=cpage_current_url.split('?');
				new_url=fred[0]+'?'+cpage_current_id+'.'+prevp;
				$('cpage_prev').href=new_url;
        		new_url=fred[0]+'?'+cpage_current_id+'.'+nextp;
				$('cpage_next').href=new_url;
			}
		}
		});
	},
	onFailure: function(){
		//failure handling
		alert('ajax request failed');
	}
});
}
/**
 *
 * @access public
 * @return void
 **/
function cpage_gosel(){

}

/**
 *
 * @access public
 * @return void
 **/
function toggle_comments(){
	if(cpage_comvisible===true){
		Effect.SlideUp('cpage_comments',{
			duration:1,
			beforeStart:function(){
				$('cpage_showcomments').style.visibility='hidden';
				},
			afterFinish: function(){
				$('cpage_showcomments').value='Show Comments';
				$('cpage_showcomments').style.visibility='visible';
			}
	});
			cpage_comvisible=false;
	}else{
		Effect.SlideDown('cpage_comments',{
			duration:1,
			beforeStart:function(){
				$('cpage_showcomments').style.visibility='hidden';
				},
			afterFinish: function(){
				$('cpage_showcomments').value='Hide Comments';
				$('cpage_showcomments').style.visibility='visible';
			}
	});
			cpage_comvisible=true;

	}

}
/**
 *
 * @access public
 * @return void
 **/
function cpage_set_page_visibles(){
	if($('cpageSelect')!=undefined){
		$('cpageSelect').style.display='inline';
	}
	cpage_comvisible=false;
	if ($('cpage_showcomments') == undefined){
	cpage_comments_active=false;
	}else{
	$('cpage_comments').style.display='none';
	$('cpage_showcomments').style.visibility='visible';
	cpage_comments_active=true;
	}

}