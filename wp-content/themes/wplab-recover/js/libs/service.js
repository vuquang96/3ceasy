jQuery(document).ready(function($){
	$(".select-store select").change(function(){
		var email = $(this).find(':selected').data('email');
		$(".single-service .email_store").val(email);
	});

	$( window ).load(function() {
	  	var brand = $(".single-service .breadcrumbs .0-item a").text();
	  	var device = $(".single-service .breadcrumbs .1-item a").text();
	  	var symptom = $(".single-service .breadcrumbs .2-item a").text();
		
		$(".single-service .info .brand").text(brand);
		$(".single-service .info .device").text(device);
		$(".single-service .info .symptom").text(symptom);

		$(".single-service input[name='category']").val(symptom);

	});

	$(document).on("click", ".single-service .btn-check", function(){
		var flag = false;
		var name = $(".single-service input[name='name']").val();
		var phone = $(".single-service input[name='phone']").val();
		var email = $(".single-service input[name='email']").val();
		var local = $(".single-service input[name='local']").val();
		var store = $(".single-service select[name='store']").val();
		var date = $(".single-service input[name='date']").val();
		var capcha = $("#recaptcha-anchor").attr("aria-checked");
		var response = grecaptcha.getResponse();

		
		if(name == ''){
			flag = true;
			$(".single-service input[name='name']").addClass("service-danger");
		}else{
			$(".single-service input[name='name']").removeClass("service-danger");
		}

		if(phone == ''){
			flag = true;
			$(".single-service input[name='phone']").addClass("service-danger");
		}else{
			$(".single-service input[name='phone']").removeClass("service-danger");
		}

		if(email == ''){
			flag = true;
			$(".single-service input[name='email']").addClass("service-danger");
		}else{
			$(".single-service input[name='email']").removeClass("service-danger");
		}

		if(local == ''){
			flag = true;
			$(".single-service input[name='local']").addClass("service-danger");
		}else{
			$(".single-service input[name='local']").removeClass("service-danger");
		}

		if(store == "0"){
			flag = true;
			$(".single-service select[name='store']").addClass("service-danger");
		}else{
			$(".single-service select[name='store']").removeClass("service-danger");
		}

		if(date == ""){
			flag = true;
			$(".single-service input[name='date']").addClass("service-danger");
		}else{
			$(".single-service input[name='date']").removeClass("service-danger");
		}

		if(response.length == 0){
		    $(".single-service .text-danger").css("display", "block");
		}else{
		    $(".single-service .text-danger").css("display", "none");
		    if(!flag){
		    	$(".single-service .btn-submit-service").trigger("click");
		    }
		}
	});

});