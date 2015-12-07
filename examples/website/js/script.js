$(document).ready(function(){

//------------------------------------- Navigation setup ------------------------------------------------//
	

//--------- Scroll navigation ---------------//

$("#mainNav a, #quote a, #logo a").click(function(event){

	event.preventDefault();
	var full_url = this.href;
	var parts = full_url.split("#");
	var trgt = parts[1];
	var target_offset = $("#"+trgt).offset();
	var target_top = target_offset.top;

	$('html,body').animate({scrollTop:target_top -80}, 800);
	
});

//-------------Highlight the current section in the navigation bar------------//
var sections = $("section");
	var navigation_links = $("#mainNav a");
	
	sections.waypoint({
		handler: function(event, direction) {
		
			var active_section;
			active_section = $(this);
			if (direction === "up"){
				active_section = active_section.prev();
				}
 
			
			var active_link = $('#mainNav a[href="#' + active_section.attr("id") + '"]');
			navigation_links.removeClass("active");
			active_link.addClass("active");
			
			
	

		},
		offset: '35%'
	});


//------------------------------------- End navigation setup ------------------------------------------------//




//---------------------------------- Testimonials-----------------------------------------//
$('#testimonials').slides({
	preload: false,
	generateNextPrev: false,
	play: 4500,
	container: 'testimoniaContainer'
});
//---------------------------------- End testimonials-----------------------------------------//


//---------------------------------- Form validation-----------------------------------------//
$("#notForm").validate();
//---------------------------------- End form validation-----------------------------------------//



//---------------------------------- Count down ----------------------------------------//


});





