$(function() {

	$(".navbar #btn-toggle").click(function() {

		$("#_sidebar").toggleClass("show");
		$("#content").toggleClass("slider");
		if ($(".navbar #btn-toggle i").hasClass("fa-bars")) {
			$(".navbar #btn-toggle i").removeClass("fa-bars");
			$(".navbar #btn-toggle i").addClass("fa-times");
		} else {
			$(".navbar #btn-toggle i").removeClass("fa-times");
			$(".navbar #btn-toggle i").addClass("fa-bars");
		}

	});

	$(".navbar-search-2 #search-toggle").click(function() {

		$(".navbar-search-2 .dropdown-menu").toggleClass("show");

	});

	$('.custom-file-input').on('change', function() {
		let fileName = $(this).val().split('\\').pop();
		$(this).next('.custom-file-label').addClass("selected").html(fileName);
	});

});

const plus = document.getElementsByClassName('plus');
const minus = document.getElementsByClassName("minus");

var baseUrl = $("#base-url").data('url');
