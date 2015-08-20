$(document).ready(function(){
	$("#search_student").click(function(){
		$("#students_list").html('');
		var year = $("#batch").val();
		var dep = $("#department").val();
		$.get('get/students/'+ year +'/'+ dep, function(data){
			var students = JSON.parse(data);
			for(var i in students){
				$("#students_list").append('<div class="col-md-4"><div class="checkbox"><label><input type="checkbox" value="'+ students[i].id +'"> '+ students[i].roll +'</label></div></div>');
			}
		});
	});

	$("#check_all").click(function(){
		if($("#check_all").prop('checked') == true){
			$("#uncheck_all").prop('checked', false);
			$("#students_list input").each(function(){
				$(this).prop('checked', true);
			});
		}
	});
	$("#uncheck_all").click(function(){
		if($("#uncheck_all").prop('checked') == true){
			$("#check_all").prop('checked', false);
			$("#students_list input").each(function(){
				$(this).prop('checked', false);
			});
		}
	});


	$("#submit_course_offer").click(function(){

		// get students list
		var students_list = [];
		$("#students_list input").each(function(index){
			if($(this).is(':checked')){
				students_list.push($(this).val());
			}			
		});

		// get course list
		var course_list = [];
		$("#course_list input").each(function(index){
			if($(this).is(':checked')){
				course_list.push($(this).val());
			}
		});

		// get year, term, session
		var year = $("#year").val();
		var term = $("#term").val();
		var session = $("#session").val();
		// send data to server
		var post_data = {'students':JSON.stringify(students_list),'courses':JSON.stringify(course_list),'year':year,'term':term,'session':session};
		$.post('offer-course', post_data, function(response){
			if(response == "1"){
				$("#success_msg").show();
			}else{
				$("#error_msg").show();
			}
		});

	});

});