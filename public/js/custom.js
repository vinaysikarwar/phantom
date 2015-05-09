jQuery(document).ready(function($){
	// Script for data table
	$('#extensionlist').dataTable( {
        "ajax": "extension/getExtensionList",
		"dataSrc": "",
        "columns": [
            { "data": "avatar" },
            { "data": "name" },
            { "data": "author" },
			{ "data": "short_description" },
			{ "data": "url" }
        ]
    } );
	
	// Flex Slider Script
	$('.flexslider').flexslider({
		slideshowSpeed: 6000,
		directionNav:false,
		pauseOnHover:true,
        animation: "slide",
        start: function(slider){
          //$('body').removeClass('loading');
        }
      });
    
});