/* ---------------------------------------------------------------------- */
/*	Get Dribbble shot list 
/* ---------------------------------------------------------------------- */

$(document).ready(function(){	
	var $wallcontent=$('#wallcontent'), pagenum=1, $showmore = $('#showmore');
	
	$wallcontent.isotope({
		itemSelector : 'article'
	});	
				
	$showmore.bind('click', loadshots);
	
	function loadshots(){
		$showmore.unbind('click');
		$(this).text('加载中...');
		
		$.getJSON( "data.json?page="+pagenum, function( data ) {
			var items = [];

			$.each(data.shots, function (i, shot) {
				items.push('<article>');
				items.push('<div class="details"><h2>' + shot.title + '</h2></div>');
				items.push('<img src="' + shot.image_teaser_url + '" alt="' + shot.title + '">');
				items.push('</article>');
			});
			
			var newEls = items.join('');

			var testcontent = $(newEls);
			$wallcontent.append(testcontent);
			$wallcontent.imagesLoaded(function(){	
				$wallcontent.isotope('appended', testcontent).isotope('reLayout');
				$showmore.text('更多设计 (More)...').bind('click', loadshots);
			});	
		});
		
		pagenum++;		
	
	}
	
	$showmore.trigger('click');

});


/* ---------------------------------------------------------------------- */
/*	back to up
/* ---------------------------------------------------------------------- */
$(function(){
	$('body').append('<div id="backtotop" class="showme"><div class="bttbg"></div></div>');
	initGoToTop();
});

function initGoToTop() {
	var orig_scroll_height = jQuery("#footer").position().top - jQuery(window).height() - 200;
	
	// fade in #top_button
	jQuery(function () {
		jQuery(window).scroll(function () {
			//console.log(jQuery(this).scrollTop());
			if (jQuery(this).scrollTop() > 100) {
				jQuery('#backtotop').addClass('showme');
			} else {
				jQuery('#backtotop').removeClass('showme');
			}
		});

		// scroll body to 0px on click
		jQuery('#backtotop').click(function () {
			jQuery('body,html').animate({
				scrollTop: 0
			},  400);
			return false;
		});
	});
			
	if (jQuery(window).scrollTop() == 0) {
		jQuery('#backtotop').removeClass('showme');
	}else{
		jQuery('#backtotop').addClass('showme');
	}
}	