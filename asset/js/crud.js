function newTbody(json) {

	var index, tbody;
	for(index in json) {

		tbody +="<tr>";
		tbody +="<td>"+json[index].title+"</td>";
		tbody +="<td>"+json[index].author+"</td>";
		tbody +="<td>"+json[index].genre+"</td>";
		tbody +="<td>"+json[index].library_section+"</td>";
		tbody +="<td>";
		tbody +="<button style='margin:0px 2px;' data-toggle='modal' data-target='#update_modal' id='edit' class='btn btn-sm btn-info' value='"+json[index].id+"'>Edit</button>";
		tbody +="<button style='margin:0px 2px;' data-toggle='modal' data-target='#delete_modal' class='btn btn-sm btn-danger' id='delete_with_modal' value='"+json[index].id+"'>Delete</button>";
		if(json[index].status == 1) {
			tbody += "<button data-toggle='modal' data-target='#return_modal' style='margin:0px 2px;' id='return_with_modal' class='btn btn-sm btn-warning' value='"+json[index].id+"'>Return</button>";
		} else {
			tbody += "<button data-toggle='modal' data-target='#return_modal' style='margin:0px 2px;' disabled id='return_with_modal' class='btn btn-sm btn-warning' value='"+json[index].id+"'>Return</button>";
		}
		tbody +="</td>";
		tbody +="</tr>";
	}

	return tbody;
}


$(document).ready(function() {

	function getBooks()
    {
        $.ajax({
            url: base_url+"book/get_books",
            success:function(result){
            	console.log(result);
            	var json = $.parseJSON(result);
            	$('#myTable tbody').html(newTbody(json));
            }

        });
    }


	$('#submit').on('click', function() {

		var data = $('#add_form').serialize();
		console.log(data);
		$.ajax({
			type:"POST",
			data:data,
			url:base_url+"book/insert",
			success:function(result) {
				var json = $.parseJSON(result);
				console.log(json);
				if(json.status == false) {
					$('#error').html('<div class="alert alert-danger">'+json.message+'</div>');
				} else if(json.status == true) {
					
					$('#close').trigger('click');
					getBooks();
					$('#success').html('<div class="alert alert-success">'+json.message+'</div>');
				}
				
				
			}
		});

		
	});

	$(document).on('click', '#edit', function() {

		var id = $(this).val();
		console.log(id);

		$.ajax({
			type:"POST",
			data:{'id':id},
			url:base_url+"book/get_certain_book",
			success:function(result){
				console.log(result);

				var json = $.parseJSON(result);
				$('#id').empty().val(json[0].id);
				$('#edit_title').empty().val(json[0].title);
				$('#edit_author').empty().val(json[0].author);
				$('#edit_genre option[value="'+json[0].genre+'"]').prop("selected", true);
				$('#edit_library_section option[value="'+json[0].library_section+'"]').prop("selected", true);
			}

		})
	});

	$('#update_book').on('click', function() {

		var data = $('#update_form').serialize();

		$.ajax({
			type:"POST",
			data:data,
			url:base_url+"book/update",
			success:function(result) {
				var json = $.parseJSON(result);
				
				if(json.status == false) {
					$('#error').html('<div class="alert alert-danger">'+json.message+'</div>');
				} else if(json.status == true) {
					
					$('#close_update_modal').trigger('click');
					getBooks();
					$('#success').html('<div class="alert alert-success">'+json.message+'</div>');
				}
				
			}
		});

		
	});

	$(document).on('click', '#delete_with_modal', function() {
		var id = $(this).val();
		//console.log(id);

		$.ajax({
			type:"POST",
			data: {'id': id},
			url: base_url+"book/get_certain_book",
			success: function(result) {
				var json = $.parseJSON(result);
				$('#delete_id').empty().val(json[0].id)
				$('#delete_title').empty().val(json[0].title)
				//console.log(json);
				$('#warning-msge').html('Are you sure you want to delete <strong>'+json[0].title+'?</strong>');
			}
		});
		
	});

	$('#delete').on('click', function() {

		var id = $('#delete_id').val();
		var title = $('#delete_title').val();
		console.log(id);
		$.ajax({
			type:"POST",
			data: {'id': id, 'title':title},
			url: base_url+"book/delete",
			success: function(result) {
				var json = $.parseJSON(result);
			
				if(json.status == false) {
					$('#d_error').html('<div class="alert alert-danger">'+json.message+'</div>');
				} else if(json.status == true) {
					$('#close_delete_modal').trigger('click');
					getBooks();
					$('#success').html('<div class="alert alert-success">'+json.message+'</div>');
				}
			}
		});
	})

	$(document).on('click', '#return_with_modal', function() {

		var id = $(this).val();


		$.ajax({
			type:"POST",
			data: {'id': id},
			url: base_url+"book/get_certain_book",
			success: function(result) {
				var json = $.parseJSON(result);
				console.log(json)
				$('#book_id').empty().val(json[0].id)
				$('#book_title').empty().val(json[0].title)
				//console.log(json);
				$('#return-warning-msge').html('Are you sure you want to return <strong>'+json[0].title+'?</strong>');
			}
		});
		
	});

	$('#return').on('click', function() {

		var id = $('#book_id').val();
		var title = $('#book_title').val();
		var book_status = 0;
		console.log(id);
		$.ajax({
			type:"POST",
			data: {'id': id, 'title':title, 'book_status':book_status},
			url: base_url+"book/borrow_return",
			success: function(result) {
				var json = $.parseJSON(result);
			
				if(json.status == false) {
					$('#d_error').html('<div class="alert alert-danger">'+json.message+'</div>');
				} else if(json.status == true) {
					$('#close_return_modal').trigger('click');
					getBooks();
					$('#success').html('<div class="alert alert-warning">'+json.message+'</div>');
				}
			}
		});
	});




});