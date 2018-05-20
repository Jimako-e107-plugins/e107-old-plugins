jQuery(function() {
	jQuery().ajaxError(function(a, b, e) {
		throw e;
	});

	// our form submit and valiation
	var form_clan_settings = $("#form-clan-settings").validate({
		ignore: ".ignore",

		// rules/messages are for the validation
		rules: {
			clanname: "required",
		},
		messages: {
			clanname: "Please enter the team name.",
		}
	});

	// our form submit and valiation
	var aform = $("#form-signup").validate({

		// make sure we show/hide both blocks
		errorContainer: "#errorblock-div1, #errorblock-div2",

		// put all error messages in a UL
		errorLabelContainer: "#errorblock-div2 ul",

		// wrap all error messages in an LI tag
		wrapper: "li",

		ignore: ".ignore",

		// rules/messages are for the validation
		rules: {
			joindivisionPassword: "required",
			gamername: "required"
		},
		messages: {
			joindivisionPassword: "Please enter the division password.",
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
	var abutton = $('#joindivision').click(function() {
		$('#modal-form-signup').dialog('open');
	});

}); // end main jQuery function start

