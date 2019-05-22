document.write("<script src='autocomplete/prototype.js' type='text/javascript'></script><script src='autocomplete/scriptaculous.js' type='text/javascript'></script><link rel='stylesheet' href='autocomplete/autocomplete.css' type='text/css' />");

function add_autocomplete_box() { 
  	var ac_var_name = document.getElementById('autocomplete').value;
  if (ac_var_name!='ac_liste'){
    new Insertion.Before(ac_var_name, '<div style="cursor:pointer;" title="Ça, c&#39;est la classe!!!">Autocomplete activé...</div>');
  }
    new Insertion.After(ac_var_name, '<div style="width:400px" id="id_autocomplete" style="display:none;"></div>');	

	var ac_type = document.getElementById(ac_var_name).tagName;
	if (ac_type=='INPUT') {
		new Ajax.Autocompleter(ac_var_name,'id_autocomplete','autocomplete/ac_retrieve.php');
	}
	else{
		new Ajax.Autocompleter(ac_var_name,'id_autocomplete','autocomplete/ac_retrieve.php?comma=true', { tokens: new Array(';','\n') });
  }
} 

            if (window.addEventListener) { 
	            window.addEventListener('load', add_autocomplete_box, false); 
            } else if (document.addEventListener) { 
            	document.addEventListener('load', add_autocomplete_box, false); 
            } else if (window.attachEvent) {	
            	window.attachEvent('onload', add_autocomplete_box); 
            } else if (typeof window.onload == 'function') { 
            	var fnOld = window.onload; window.onload = function(){ fnOld(); add_autocomplete_box(); }; 
            } else { 
            	window.onload = add_autocomplete_box; 
            }
