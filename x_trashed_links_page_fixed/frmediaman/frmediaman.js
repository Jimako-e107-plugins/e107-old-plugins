$(document).ready(function()
{ 

		$('body').on('hidden', '.modal', function () {
			$(this).removeData('modal');
			 $('#uiModal .modal-label').text('Loading...');
			$('#uiModal .modal-body').html('&nbsp;');
			});
		
		$('a[data-toggle="modal"]').on('click', function()
			{
				var link = $(this).attr('href');
				var caption  = $(this).attr('data-modal-caption');
				var height 		= ($(window).height() * 0.9) - 50;
				
				 $('#uiModal .modal-caption').text(caption);
				 $('.modal').height(height);
				// $('#uiModal .modal-label').text('Loading...');
				// $('#uiModal .modal-body').html(link);
				// alert(caption);
			}
		);
 
		
		/*  Bootstrap Modal window within an iFrame */
		$('.e-modal').on('click', function(e) 
		{

			e.preventDefault();

            if($(this).attr('data-cache') == 'false')
            {
                $('#uiModal').on('shown.bs.modal', function () {
                    $(this).removeData('bs.modal');
                });
            }
            
			var url 		= $(this).attr('href');
			var caption  	= $(this).attr('data-modal-caption');
			var height 		= ($(window).height() * 0.7) - 120;

            if(caption === undefined)
            {
                caption = '';
            }

    		$('.modal-body').html('<div class="well"><iframe id="e-modal-iframe" width="100%" height="'+height+'px" frameborder="0" scrolling="auto" style="display:block;background-color:transparent" allowtransparency="true" src="' + url + '"></iframe></div>');
    		$('.modal-caption').html(caption + ' <i id="e-modal-loading" class="fa fa-spin fa-spinner"></i>');
    		$('.modal').modal('show');
    		
    		$("#e-modal-iframe").on("load", function () {
				 $('#e-modal-loading').hide(); 
			});
    	});	
 
 
		$('.e-noclick').click(function(e) {
	    	e.stopPropagation();
	  	});
	
 
		// plugin navigation hash
		if(/^#nav-+/.test(window.location.hash)) {
			$("a[href='" + window.location.hash.replace('nav-', '') + "']").click();
		} 
 
 
});



