/* Sticky Tooltip script (v1.0)
* Created: Nov 25th, 2009. This notice must stay intact for usage 
* Author: Dynamic Drive at http://www.dynamicdrive.com/
* Visit http://www.dynamicdrive.com/ for full source code
*/


var stickytooltip_p={
	tooltipoffsets: [20, -30], //additional x and y offset from mouse cursor for tooltips
	fadeinspeed: 200, //duration of fade effect in milliseconds
	rightclickstick: true, //sticky tooltip when user right clicks over the triggering element (apart from pressing "s" key) ?
	stickybordercolors: ["black", "darkred"], //border color of tooltip depending on sticky state
	stickynotice1: ["Klicke bitte Taste \"s\"", "oder rechte maustaste", "zum Box"], //customize tooltip status message
	stickynotice2: "Click outside this box to hide it", //customize tooltip status message

	//***** NO NEED TO EDIT BEYOND HERE

	isdocked: false,

	positiontooltip:function($, $tooltip, e){
		var x=e.pageX+this.tooltipoffsets[0], y=e.pageY+this.tooltipoffsets[1]
		var tipw=$tooltip.outerWidth(), tiph=$tooltip.outerHeight(), 
		x=(x+tipw>$(document).scrollLeft()+$(window).width())? x-tipw-(stickytooltip_p.tooltipoffsets[0]*2) : x
		y=(y+tiph>$(document).scrollTop()+$(window).height())? $(document).scrollTop()+$(window).height()-tiph-10 : y
		$tooltip.css({left:x, top:y})
	},
	
	showbox:function($, $tooltip, e){
		$tooltip.fadeIn(this.fadeinspeed)
		this.positiontooltip($, $tooltip, e)
	},

	hidebox:function($, $tooltip){
		if (!this.isdocked){
			$tooltip.stop(false, true).hide()
			$tooltip.css({borderColor:'black'}).find('.stickystatus:eq(0)').css({background:this.stickybordercolors[0]}).html(this.stickynotice1)
		}
	},

	docktooltip:function($, $tooltip, e){
		this.isdocked=true
		$tooltip.css({borderColor:'darkred'}).find('.stickystatus:eq(0)').css({background:this.stickybordercolors[1]}).html(this.stickynotice2)
	},


	init:function(targetselector, tipid){
		jQuery(document).ready(function($){
			var $targets=$(targetselector)
			var $tooltip=$('#'+tipid).appendTo(document.body)
			if ($targets.length==0)
				return
			var $alltips=$tooltip.find('div.atip')
			if (!stickytooltip_p.rightclickstick)
				stickytooltip_p.stickynotice1[1]=''
			stickytooltip_p.stickynotice1=stickytooltip_p.stickynotice1.join(' ')
			stickytooltip_p.hidebox($, $tooltip)
			$targets.bind('mouseenter', function(e){
				$alltips.hide().filter('#'+$(this).attr('data-tooltip')).show()
				stickytooltip_p.showbox($, $tooltip, e)
			})
			$targets.bind('mouseleave', function(e){
				stickytooltip_p.hidebox($, $tooltip)
			})
			$targets.bind('mousemove', function(e){
				if (!stickytooltip_p.isdocked){
					stickytooltip_p.positiontooltip($, $tooltip, e)
				}
			})
			$tooltip.bind("mouseenter", function(){
				stickytooltip_p.hidebox($, $tooltip)
			})
			$tooltip.bind("click", function(e){
				e.stopPropagation()
			})
			$(this).bind("click", function(e){
				if (e.button==0){
					stickytooltip_p.isdocked=false
					stickytooltip_p.hidebox($, $tooltip)
				}
			})
			$(this).bind("contextmenu", function(e){
				if (stickytooltip_p.rightclickstick && $(e.target).parents().andSelf().filter(targetselector).length==1){ //if oncontextmenu over a target element
					stickytooltip_p.docktooltip($, $tooltip, e)
					return false
				}
			})
			$(this).bind('keypress', function(e){
				var keyunicode=e.charCode || e.keyCode
				if (keyunicode==115){ //if "s" key was pressed
					stickytooltip_p.docktooltip($, $tooltip, e)
				}
			})
		}) //end dom ready
	}
}

//stickytooltip_p.init("targetElementSelector", "tooltipcontainer")
stickytooltip_p.init("*[data-tooltip]", "mystickytooltip_p")