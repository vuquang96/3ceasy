jQuery(document).ready(function($){
	$(".select-store select").change(function(){
		var email = $(this).find(':selected').data('email');
		$(".single-service .store_mail").val(email);
	});

	$( window ).load(function() {
	  	var brand = $(".single-service .breadcrumbs .0-item a").text();
	  	var device = $(".single-service .breadcrumbs .1-item a").text();
	  	var symptom = $(".single-service .breadcrumbs .2-item a").text();
		
		$(".single-service .info .brand").text(brand);
		$(".single-service .info .device").text(device);
		$(".single-service .info .symptom").text(symptom);

	});
	
});