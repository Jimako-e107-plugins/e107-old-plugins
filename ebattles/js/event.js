jQuery(function() {
	jQuery().ajaxError(function(a, b, e) {
		throw e;
	});

	// our form submit and valiation
	var form_event_settings = $("#form-event-settings").validate({
		ignore: ".ignore",

		// rules/messages are for the validation
		rules: {
			eventname: "required",
			startdate: "required"
		},
		messages: {
			eventname: "Please enter the event name.",
			startdate: "Please enter the start date"
		}
	});

	// our form submit and valiation
	var aform = $("#form-signup").validate({

		// make sure we show/hide both blocks
		errorContainer: "#errorblock-div1, #errorblock-div2",

		//errorLabelContainer : this is the id (or any jquery selector string) of the element that will contain the error labels generated for each invalid field
		// put all error messages in a UL
		errorLabelContainer: "#errorblock-div2 ul",

		// wrap all error messages in an LI tag
		wrapper: "li",

		ignore: ".ignore",

		// rules/messages are for the validation
		rules: {
			joinEventPassword: "required",
			gamername: "required"
		},
		messages: {
			joinEventPassword: "Please enter the event password.",
			gamername: "Please enter your gamer name."
		}
	});

	// our modal dialog setup
	var amodal = $("#modal-form-signup").dialog({
		bgiframe: true,
		autoOpen: false,
		height: 350,
		width: 300,
		modal: true,
		draggable: false,
		resizable: false,
		buttons: {
			'Submit': function()
			{
				// submit the form
				$("#form-signup").submit();
			},
			Cancel: function()
			{
				// close the dialog, reset the form
				$(this).dialog('close');
				aform.resetForm();
			}
		}
	});

	// onclick action for our button
	var abutton = $('#joinevent').click(function() {
		$('#modal-form-signup').dialog('open');
	});

	$('.matchreport_link').popUpForm({  
		title : 'Match Report',
		container   : '#matchreportcontainer',  
		form        : '#matchreportform',  
		width       : 440,  
		draggable   : false,
		resizable   : false,
		beforeSubmit: function() { 
			//alert('matchreport_link beforeSubmit!');
		},  
		onSuccess   : function() { 
			//alert('matchreport_link onSuccess!');

			window.location.href = window.location.href;
		},  
		onError     : function(error) {
			alert('Sorry there was an error submitting your form: '+error);
		}  
	});
	
/*
	$('#approvematch_form').ajaxForm(function() { 
		window.location.href = window.location.href; 
	});
*/
}); // end main jQuery function start

