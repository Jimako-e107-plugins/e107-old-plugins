

;(function($) {  
    var alog = window.console ? console.log : alert;  
  
    $.fn.popUpForm = function(options) {  
        // REQUIRE a container  
        if(!options.container) { alert('Container Option Required'); return; }  
  
        // Defaults and options  
        var defaults = {  
            container   : '',
            form        : '',
			position    : ['center', 40],
            modal       : true,  
            resizeable  : false,  
            draggable   : false,  
            width       : 440,  
            title       : 'Website Form',  
            beforeOpen  : function(container) {},
			beforeSubmit: function(container) {},
            onSuccess   : function(container) {},  
            onError     : function(container) {}  
        };  
        var opts = $.extend({}, defaults, options);  
  
       return this.each(function() {
            var obj = $(this);  
  
            /* we only want to process an item if it's a link and 
             * has an href value 
             */  
            if (!obj.is('a') || obj.attr('href') == '' || obj.attr('href-data') == '') { alert('Not a link'); return ; } 
 
			obj.click(function() {
				/* For a $.load() function, the param is the url followed by 
				 * the ID selector for the section of the page to grab 
				 */ 
				var url = obj.attr('href-data') + ' ' + opts.container; 
				//var url = obj.attr('href'); 
				var name = obj.attr('name');
				
				// show a spinner or something via css
				var popup_dialog = $('<div id="popupdialog" style="display:none" class="loading"></div>').appendTo('body');
				// open the dialog
				popup_dialog.dialog({
					// add a close listener to prevent adding multiple divs to the document
					close: function(event, ui) {
						// remove div with all data and events
						popup_dialog.remove();
					},
					modal: true,
                    position    : opts.position, 
                    width       : opts.width, 
                    modal       : opts.modal, 
                    resizable   : opts.resizeable, 
                    draggable   : opts.draggable, 
                    title       : name 
 				});
				// load remote content
				popup_dialog.load(
					url, 
					{}, // omit this param object to issue a GET request instead a POST request, otherwise you may provide post parameters within the object
					function (responseText, textStatus, XMLHttpRequest) {
						initDatePicker();
						initMatchReportForm();
					
						// remove the loading class
						popup_dialog.removeClass('loading');

						var ajaxForm_options = { 
							target: '#popupdialog',
							beforeSubmit:  opts.beforeSubmit,  // pre-submit callback 
							success:       function(response) {  
								console.log(response);
								if(response == 'match reported')
								{
									popup_dialog.dialog('close');
									opts.onSuccess.call(obj[0], opts.container);   
								}
								else
								{
									initDatePicker();
									initMatchReportForm();
									$(opts.form).ajaxForm(ajaxForm_options); 
								}
							}    // post-submit callback 
					 
							// other available options: 
							//url:       url         // override for form's 'action' attribute 
							//type:      type        // 'get' or 'post', override for form's 'method' attribute 
							//dataType:  null        // 'xml', 'script', or 'json' (expected server response type) 
							//clearForm: true        // clear all form fields after successful submit 
							//resetForm: true        // reset the form after successful submit 
					 
							// $.ajax options can be used here too, for example: 
							//timeout:   3000 
						}; 

						$(opts.form).ajaxForm(ajaxForm_options); 		

					}
				);

				//prevent the browser to follow the link
				return false;
			});

        });  
 
    }
})(jQuery);  
