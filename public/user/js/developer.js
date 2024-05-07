// For Developer Use

$(document).ready(function () {
	function readURL(input) {
	    if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function (e) {
		    $('#Profile').attr('src', e.target.result);
		}
		reader.readAsDataURL(input.files[0]);
	    }
	}
	$("#imgInp").change(function () {
	    readURL(this);
	});
});

$(document).ready(function () {
$('#loc_tions').hide();

	$("#editIcon").click(function () {
	    $("#fileInputLabel").toggle();
	});

	function readURL(input) {
	    if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.onload = function (e) {
		    $('#Profile').attr('src', e.target.result);
		}
		reader.readAsDataURL(input.files[0]);
	    }
	}

	$("#imgInp").change(function () {
	    readURL(this);
	});


	$(window).ready(function() { 
		$("#msform").on("keypress", function (event) { 
			var keyPressed = event.keyCode || event.which; 
			if (keyPressed === 13) {
				// alert("You pressed the Enter key!!"); 
				event.preventDefault();
				return false; 
			} 
		}); 
	});
	
	
	$('.select_data').on('click', function(){
		$('.select_data.active').removeClass('active');
		$(this).addClass('active');
		var platform_src = $('.select_data.active .ads_img').attr('src');
		var model_target = $('.select_data.active .ads_img').attr('target');
        $('#selected_ads_img1').attr('src', platform_src);
		$('#selected_ads_img2').attr('src', platform_src);

		var p_name = $('.select_data.active .ads_name').text();
		$('#selected_ads_name1').text(p_name);
		$('#selected_ads_name2').text(p_name);
		$('.social_model').attr('data-bs-target', model_target);
		$('#selected_ads_name3').text(" "+p_name.slice(0, -3)+" ");
		

	});

	$('#msform').on('autocompletechange change click keyup', function(e) {
		// alert('hi');"focus",[selector]
		var campaign_name = $("input[name='campaign_name']").val();
		var web_url = $("input[name='web_url']").val();
		var goal = $('#goal').val();
		var language = $('#language').val();
		var location = $(".select2-selection__rendered").text();

		var select_plateform = $('.select_data.active').attr('platform-val');
		var add_val = $('#platform').val(select_plateform);
		var platform_val = $('#platform').val();
	
		if(campaign_name =='' || web_url =='' || goal =='' || language =='' || location.length == 0){
			$('.next1').prop('disabled', true);
		}else{
			$('.next1').prop('disabled', false);
		}

		if(platform_val ==''){
			$('.next2').prop('disabled', true);
		}else{
			$('.next2').prop('disabled', false);
		}
	});

// ai-optimizer
	$('.blogtitle').on('click', function(){
		$('.blogtitle.active').removeClass('active');
		$(this).addClass('active');
		var get_article = $(this).text();
		$('#blog_title').val(get_article);
	});
	
	// $('.generate_blog').on('click', function(){
	// 	var blog_title = $('.blogtitle.active').text();
	// 	$.ajax({
	// 		type: "GET",
	// 		url: "/user/ai-optimizer-2",
	// 		data: {'blog_title':blog_title},
	// 		success: function(data){
	// 			console.log(data);
	// 		}
	// 	  });
	
	// });

});

// camp-budget
//   $('.b_dot').hide();
function setCustomBudget() {
		
	console.log('Set custom budget clicked');
}

function selectBudget(selectedElement) {
	var allBudgetElements = document.querySelectorAll('.single-day');
	allBudgetElements.forEach(function (element) {
		element.classList.remove('active');
	});

	selectedElement.classList.add('active');
}

function saveSelectedBudget() {
	var selectedBudgetElement = document.querySelector('input[name="selected_budget"]');
	var selectedBudget = document.querySelector('.single-day.active h3').innerText;

	selectedBudgetElement.value = selectedBudget;
	$('.budget').html(selectedBudget);
	$('.budget_div').addClass('collapsed');
	$('.budget_div').attr('aria-expanded','false');
	$('.b_dot').show();

	console.log('Selected Budget:', selectedBudget);

}



// $(document).ready(function(){

//     $('.fb_connect').on('click', function(){
//         alert('yes');
//         $.ajax({
//             type: "GET", 
//             url: '/auth/facebook',
//             success: function(response){
//                 alert('hi')
//             }
//         });
//     });



    
// });

    
