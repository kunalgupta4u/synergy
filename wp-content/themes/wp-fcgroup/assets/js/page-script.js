(function($){
	"use strict";
	$(document).ready(function(){
		var post = getUrlParameter('post');
		if(post == 'undefined'){
			return;
		}
		jQuery.post(
		    ajaxurl, 
		    {
		        'action': 'get_sliders_meta_page',
		        'post': post
		    }, 
		    function(response){
		        if(typeof $.fn.select2 == 'function'){
		        	$('#header_banner-select').html(response).select2();
		        }
		    }
		);
	
	})
})(jQuery);
var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};