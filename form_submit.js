  $(function() {
    $('.error').hide();
    $(".button").click(function() {
      // validate and process form here
      
      $('.error').hide();
  	  var first = $("input#first").val();
  		if (first == "") {
        $("label#first_error").show();
        $("input#first").focus();
        return false;
      }
  		var last = $("input#last").val();
  		if (last == "") {
        $("label#last_error").show();
        $("input#last").focus();
        return false;
      }
  		var email = $("input#email").val();
  		if (email == "") {
        $("label#email_error").show();
        $("input#email").focus();
        return false;
      }
      
	  
var dataString = 'first='+ first + '&last=' + last + '&email=' + email;
  //(dataString);return false;
  $.ajax({
    type: "POST",
    url: "submit.php",
    data: dataString,
    success: function() {
      $('#job_form').html("<div id='message'></div>");
      $('#message').html("<h2>Contact Form Submitted!</h2>")
      .append("<p>We will be in touch soon.</p>")
      .hide()
      .fadeIn(1500, function() {
        $('#message').append("<img id='checkmark' src='images/check.png' />");
      });
    }
  });
  return false;
  
	  
    });
  });
        