$(document).ready(function() {

		
		var v = $('#ClassInput').validate({
			
				rules: {
						ClassName: "required",
						ClassSubject: "required",
						ClassSection: "required",
						ClassStartTime: "required",
						stime: "required",
						ClassEndTime: "required",
						etime: "required"
					},
				messages: {
						ClassName: "Please enter a class name",
						ClassSubject: "Please select a subject",
						ClassSection: "Please enter a subject number",
						ClassStartTime: "Please select a start time",
						stime: "Please select AM or PM",
						ClassEndTime: "Please select an end time",
						etime: "Please select AM or PM"
					},
					
									
					
			submitHandler: function(form) {
				$(form).ajaxSubmit(function() {
				
            
			});
			
		    }
		
		});
});