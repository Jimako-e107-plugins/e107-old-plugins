
$(document)
.ajaxStart(function(){
    $('#ajaxSpinnerContainer').show();
})
.ajaxStop(function(){
    $('#ajaxSpinnerContainer').hide();
});

jQuery(function() {
	/*
	// this sets up a hover effect for all buttons
    var abuttonglow = $(".ui-button:not(.ui-state-disabled)")
	.hover(
		function() {
		    $(this).addClass("ui-state-hover");
		},
		function() {
		    $(this).removeClass("ui-state-hover");
		}
	).mousedown(function() {
	    $(this).addClass("ui-state-active");
	})
	.mouseup(function() {
	    $(this).removeClass("ui-state-active");
	});
	*/
	// Return a helper with preserved width of cells
	var fixHelper = function(e, ui) {
    	ui.children().each(function() {
	        $(this).width($(this).width());
    	});
    	return ui;
	};

	$(function() {
		$('.jq-button').button();
		$('.tbox').addClass("ui-widget-content ui-corner-all");
		$('#players_list_sortable tbody').sortable({
			helper: fixHelper,
			cursor: 'move',
			placeholder: "ui-state-highlight",
			update : function () {
				var order = $(this).sortable('serialize');
				//alert(order);
				$.ajax({
					url: 'include/sort_list_players.php',
					type: "post",
					data: order,
					success: function(){
						window.location.reload();
					},
					error: function(){
						alert("Ajax Error");
					}
				});
			}
		}).disableSelection();
		$('#teams_list_sortable tbody').sortable({
			helper: fixHelper,
			cursor: 'move',
			placeholder: "ui-state-highlight",
 			update : function () {
				var order = $(this).sortable('serialize');
				//alert(order);
				$.ajax({
					url: 'include/sort_list_teams.php',
					type: "post",
					data: order,
					success: function(){
						window.location.reload();
					},
					error: function(){
						alert("Ajax Error");
					}
				});
			}
		}).disableSelection();
	}
);

}); // end main jQuery function start