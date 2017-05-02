$(document).ready(function() {

	//On click signup, hide login and show registration form
	$("#signup").click(function() {
		$("#first").slideUp("slow", function(){
			$("#second").slideDown("slow");
		});
	});

	//On click signup, hide registration and show login form
	$("#signin").click(function() {
		$("#second").slideUp("slow", function(){
			$("#first").slideDown("slow");
		});
	});

	//On click signup, hide login and show registration form
	$("#forgot_password").click(function() {
		$("#first").slideUp("slow", function(){
			$("#third").slideDown("slow");
		});
	});

	reset_password_login
	//On click signup, hide login and show registration form
	$("#reset_password_login").click(function() {
		$("#third").slideUp("slow", function(){
			$("#first").slideDown("slow");
		});
	});


	// //On click signup, hide login and show registration form
	// $("#fourth_button").click(function() {
	// 	$("#third").slideUp("slow", function(){
	// 		$("#first").hide();
	// 		$("#fifth").slideDown("slow");
	// 	});
	// });

	// //On click signup, hide login and show registration form
	// // $("#fourth_button").click(function() {
	// // 	$("#fourth").slideUp("slow", function(){
	// // 		$("#first").hide();
	// // 		$("#fifth").slideDown("slow");
	// // 	});
	// // });

	// //On click signup, hide login and show registration form
	// $("#fifth_button").click(function() {
	// 	$("#fifth").slideUp("slow", function(){
	// 		$("#first").slideDown("slow");
	// 	});
	// });

});

