/*----------------------------------------------------------------------------\
|                               Tab Pane                                      |
|-----------------------------------------------------------------------------|
*/

$(function() {
	$("#tabs").tabs({ 
		activate: function (e, ui) { 
			$.cookie('selected-tab', ui.newTab.index(), { path: '/' }); 
		}, 
		active: $.cookie('selected-tab')        
	});
});