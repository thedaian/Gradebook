$(document).ready(function() {

		
		var v = $('#StudentInput').validate({
			
				rules: {
						StudentID: "required",
						StudentFirst: "required",
						StudentLast: "required",
						StudentEmail: {
							required: true,
							email: true
						}
					},
				messages: {
						StudentID: "Please enter a student ID",
						StudentFirst: "Please enter a first name",
						StudentLast: "Please enter a last name",
						StudentEmail: {
							required: "Please enter an Email address",
							email: "Please enter a valid Email address"
						}
					},
					
									
					
			submitHandler: function(form) {
				$(form).ajaxSubmit(function() {
				
            
			});
			
		    }
		
		});
});