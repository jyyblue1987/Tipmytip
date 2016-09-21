$( document ).ready(function() {



	$("#invitation_first_name").focus();
	
	$("#slider-mobile").click(function() {
	    $('html, body').animate({
	        scrollTop: $("#form").offset().top -55
	    }, 1000);
	    return false;
	});
	
	$("form li.question-type div").click(function() {	
		$("form li.question-type div").removeClass("active");
		$(this).toggleClass("active");
	});
	
	$("#thankyoubg").click(function() {	
		$("#thankyoucontent").fadeOut();
		$("#thankyoubg").fadeOut();
	});
	
	$("#thankyoucontent > .close").click(function() {	
		$("#thankyoucontent").fadeOut();
		$("#thankyoubg").fadeOut();
	});

	/*
	 * Contact Form Controller
	 * 
	 */
	
	$("#contactbg").click(function() {	
		$("#contactcontent").fadeOut();
		$("#contactbg").fadeOut();
	});
	
	$("#contactcontent > .close").click(function() {	
		$("#contactcontent").fadeOut();
		$("#contactbg").fadeOut();
	});
	
	$("#contactcontent #contact_first_name").focus(function() {	
		if ($("#contactcontent #contact_first_name").val() == "First Name") {
			$("#contactcontent #contact_first_name").val("");	
			$("#contactcontent #contact_first_name").toggleClass("active");
		}		
	});
	
	$("#contactcontent #contact_first_name").focusout(function() {	
		if ($("#contactcontent #contact_first_name").val() == "") {
			$("#contactcontent #contact_first_name").val("First Name");	
			$("#contactcontent #contact_first_name").removeClass("active");	
		}		
	});
	
	$("#contactcontent #contact_last_name").focus(function() {	
		if ($("#contactcontent #contact_last_name").val() == "Family Name") {
			$("#contactcontent #contact_last_name").val("");	
			$("#contactcontent #contact_last_name").toggleClass("active");
		}		
	});
	
	$("#contactcontent #contact_last_name").focusout(function() {	
		if ($("#contactcontent #contact_last_name").val() == "") {
			$("#contactcontent #contact_last_name").val("Family Name");	
			$("#contactcontent #contact_last_name").removeClass("active");	
		}		
	});
	
	$("#contactcontent #contact_email").focus(function() {	
		if ($("#contactcontent #contact_email").val() == "E-mail") {
			$("#contactcontent #contact_email").val("");	
			$("#contactcontent #contact_email").toggleClass("active");
		}		
	});
	
	$("#contactcontent #contact_email").focusout(function() {	
		if ($("#contactcontent #contact_email").val() == "") {
			$("#contactcontent #contact_email").val("E-mail");	
			$("#contactcontent #contact_email").removeClass("active");	
		}		
	});
	
	$("#contactcontent #contact_subject").focus(function() {	
		if ($("#contactcontent #contact_subject").val() == "Subject") {
			$("#contactcontent #contact_subject").val("");	
			$("#contactcontent #contact_subject").toggleClass("active");
		}		
	});
	
	$("#contactcontent #contact_subject").focusout(function() {	
		if ($("#contactcontent #contact_subject").val() == "") {
			$("#contactcontent #contact_subject").val("Subject");	
			$("#contactcontent #contact_subject").removeClass("active");	
		}		
	});
	
	$("#contactcontent #contact_message").focus(function() {	
		if ($("#contactcontent #contact_message").val() == "Message") {
			$("#contactcontent #contact_message").val("");	
			$("#contactcontent #contact_message").toggleClass("active");
		}		
	});
	
	$("#contactcontent #contact_message").focusout(function() {	
		if ($("#contactcontent #contact_message").val() == "") {
			$("#contactcontent #contact_message").val("Message");	
			$("#contactcontent #contact_message").removeClass("active");	
		}		
	});
	
	$("body.contact #contactcontent form").submit(function(event) {
		
		if ($("#contact_first_name").val() == "First Name" || $("#contact_first_name").val() == "") {
			$("#contactcontent li p").hide();		
			$("#contact_first_name").focus();
			if ($('body').width() > 768 ){
				$("#contactcontent li.subject").css("margin-top", "20px");
				$("#contactcontent li.message").css("margin-top", "20px");
				$("#contactcontent input[type=submit]").css("margin-top", "20px");

			} else {
				$("#contactcontent li.last-name").css("margin-top", "20px");
				$("#contactcontent li.email").css("margin-top", "20px");
				$("#contactcontent li.subject").css("margin-top", "20px");
				$("#contactcontent li.message").css("margin-top", "20px");
				$("#contactcontent input[type=submit]").css("margin-top", "20px");
			}
			$("#contactcontent li.first-name p").show();
			return false;		
		} 
		else if ($("#contact_last_name").val() == "Family Name" || $("#contact_last_name").val() == "") {
			$("#contactcontent li p").hide();		
			$("#contact_last_name").focus();
			if ($('body').width() > 768 ){
				$("#contactcontent li.subject").css("margin-top", "20px");
				$("#contactcontent li.message").css("margin-top", "20px");
				$("#contactcontent input[type=submit]").css("margin-top", "20px");

			} else {
				$("#contactcontent li.last-name").css("margin-top", "0");
				$("#contactcontent li.email").css("margin-top", "20px");
				$("#contactcontent li.subject").css("margin-top", "20px");
				$("#contactcontent li.message").css("margin-top", "20px");
				$("#contactcontent input[type=submit]").css("margin-top", "20px");
			}
			$("#contactcontent li.last-name p").show();
			return false;		
		}		
		else if (!isValidEmailAddress( $("#contact_email").val() )) {
			$("#contactcontent li p").hide();		
			$("#contact_email").focus();
			if ($('body').width() > 768 ){
				$("#contactcontent li.subject").css("margin-top", "20px");
				$("#contactcontent li.message").css("margin-top", "20px");
				$("#contactcontent input[type=submit]").css("margin-top", "20px");

			} else {
				$("#contactcontent li.last-name").css("margin-top", "0");
				$("#contactcontent li.email").css("margin-top", "0");
				$("#contactcontent li.subject").css("margin-top", "20px");
				$("#contactcontent li.message").css("margin-top", "20px");
				$("#contactcontent input[type=submit]").css("margin-top", "20px");
			}
			$("#contactcontent li.email p").show();
			return false;		
		}		
		else if ($("#contact_subject").val() == "Subject" || $("#contact_subject").val() == "") {
			$("#contactcontent li p").hide();		
			$("#contact_subject").focus();
			if ($('body').width() > 768 ){
				$("#contactcontent li.subject").css("margin-top", "0");
				$("#contactcontent li.message").css("margin-top", "20px");
				$("#contactcontent input[type=submit]").css("margin-top", "20px");

			} else {
				$("#contactcontent li.last-name").css("margin-top", "0");
				$("#contactcontent li.email").css("margin-top", "0");
				$("#contactcontent li.subject").css("margin-top", "0");
				$("#contactcontent li.message").css("margin-top", "20px");
				$("#contactcontent input[type=submit]").css("margin-top", "20px");
			}
			$("#contactcontent li.subject p").show();
			return false;		
		}	
		else if ($("#contact_message").val() == "Message" || $("#contact_message").val() == "") {
			$("#contactcontent li p").hide();		
			$("#contact_message").focus();
			if ($('body').width() > 768 ){
				$("#contactcontent li.subject").css("margin-top", "0");
				$("#contactcontent li.message").css("margin-top", "0");
				$("#contactcontent input[type=submit]").css("margin-top", "20px");
			} else {
				$("#contactcontent li.last-name").css("margin-top", "0");
				$("#contactcontent li.email").css("margin-top", "0");
				$("#contactcontent li.subject").css("margin-top", "0");
				$("#contactcontent li.message").css("margin-top", "0");
				$("#contactcontent input[type=submit]").css("margin-top", "20px");
			}
			$("#contactcontent li.message p").show();
			return false;		
		}
	});
	
	/*
	 * Landing Page Form Controller
	 * 
	 */
	
	function isValidEmailAddress(emailAddress) {
	    var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
	    return pattern.test(emailAddress);
	};
	
	$("body.lp #invitation form").submit(function(event) {
		
		if ($("#invitation_first_name").val() == "") {
			$("#invitation li p").hide();		
			$("#invitation_first_name").focus();
			if ($('body').width() > 768 ){
				$("#invitation li").css("margin-bottom", "19px");
				$("#invitation li.first-name").css("margin-bottom", "39px");

			} else {
				$("#invitation li").css("margin-bottom", "34px");
				$("#invitation li.first-name").css("margin-bottom", "50px");
			}
			$("#invitation li.first-name p").show();
			return false;		
		}
		else if ($("#invitation_last_name").val() == "") {
			$("#invitation li p").hide();		
			$("#invitation_last_name").focus();
			if ($('body').width() > 768 ){
				$("#invitation li").css("margin-bottom", "19px");
				$("#invitation li.family-name").css("margin-bottom", "39px");

			} else {
				$("#invitation li").css("margin-bottom", "34px");
				$("#invitation li.first-name").css("margin-bottom", "50px");
			}
			$("#invitation li.family-name p").show();
			return false;		
		}
		else if ($("#invitation_email").val() == "" || !isValidEmailAddress( $("#invitation_email").val() )) {
			$("#invitation li p").hide();		
			$("#invitation_email").focus();
			if ($('body').width() > 768 ){
				$("#invitation li").css("margin-bottom", "19px");
				$("#invitation li.email").css("margin-bottom", "39px");

			} else {
				$("#invitation li").css("margin-bottom", "34px");
				$("#invitation li.email").css("margin-bottom", "50px");
			}
			$("#invitation li.email p").show();
			return false;		
		}
		else if ($("#invitation_country").val() == "") {
			$("#invitation li p").hide();		
			$("#invitation_country").focus();
			if ($('body').width() > 768 ){
				$("#invitation li").css("margin-bottom", "19px");
				$("#invitation li.country").css("margin-bottom", "39px");

			} else {
				$("#invitation li").css("margin-bottom", "34px");
				$("#invitation li.country").css("margin-bottom", "50px");
			}
			$("#invitation li.country p").show();
			return false;		
		}
		else if ($("#invitation_city").val() == "") {
			$("#invitation li p").hide();		
			$("#invitation_city").focus();
			if ($('body').width() > 768 ){
				$("#invitation li").css("margin-bottom", "19px");
				$("#invitation li.city").css("margin-bottom", "39px");

			} else {
				$("#invitation li").css("margin-bottom", "34px");
				$("#invitation li.city").css("margin-bottom", "50px");
			}
			$("#invitation li.city p").show();
			return false;		
		}		
		
	});

});