$(document).ready(function() {

		
		var v = $('#AssignInput').validate({
			
				rules: {
						classID: "required",
						AssignName: "required",
						AssignAmt: {
								required: true,
								digits: true
							},
						AssignWeight: {
								required: true,
								digits: true
							}
					},
				messages: {
						classID: "Please select a class ID",
						AssignName: "Enter an assignment name",
						AssignAmt: {
								required: "Enter the amount the assignment is worth",
								digits: "Only numbers allowed"
							},
						AssignWeight: {
								required: "Enter the assignment weight",
								digits: "Only numbers allowed"
							}
					},
					
									
					
			submitHandler: function(form) {
				$(form).ajaxSubmit(function() {
					//submit the form, and prepend the newest row toe the table
					var action = $('#action').attr('value');
					var classID = $('#classID').attr('value');
					var AssignName = $('#AssignName').attr('value');
					var AssignAmt = $('#AssignAmt').attr('value');
					var AssignWeight = $('#AssignWeight').attr('value');
					//THIS SUBMITS THE FORM TWICE, AND I DON'T KNOW WHY
					$.ajax({
						type: "POST",
						url: "Assignments",
						data: "action=" + action + "&classID=" + classID + "&AssignName=" + AssignName + "&AssignAmt=" + AssignAmt + "&AssignWeight=" + AssignWeight,
						success: function(){
							//get the newest table row, and prepend it to the table
							//change the page: argument to classes or students for the respective table
							$.get("ajaxCall.php",
								{call:"row",page:"assignments"}, function(returned_data) {
									$("table#table tbody").prepend(returned_data);
									$("#table").trigger("update")
							});
						}
					});
					return false;
				});
		    }
		
		});
});