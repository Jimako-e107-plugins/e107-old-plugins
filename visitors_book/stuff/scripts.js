zeigen = true;

$(document).ready(function() {
	$(".vibo-hide").hide();
	$(".vibo-hide-tr").hide(); 
	
	$("#vibo-com-button").click(function() {
		$(".vibo-hide").fadeToggle("slow");
	});
	$(".vibo-com-button").click(function() {
		$(this).next("tr.vibo-hide-tr").fadeToggle("slow");
	});

});