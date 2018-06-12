function newTbody(json) {

	var index, tbody;
	for(index in json) {

		tbody +="<tr>";
		tbody +="<td>"+json[index].title+"</td>";
		tbody +="<td>"+json[index].author+"</td>";
		tbody +="<td>"+json[index].genre+"</td>";
		tbody +="<td>"+json[index].library_section+"</td>";
		tbody +="<td><button data-toggle='modal' data-target='#borrow_modal' class='btn btn-sm btn-info' id='borrow_with_modal' value='"+json[index].id+"'>Borrow</button></td>";
		tbody +="</tr>";
	}

	return tbody;
}

function getBooks()
{
	
    $.ajax({

        url: base_url+"home/get_books",
        success:function(result){
        	console.log(result);
        	var json = $.parseJSON(result);
        	$('#myTable tbody').html(newTbody(json));
        }

    });
}

$(document).ready(function() {

	$(document).on('click', '#borrow_with_modal', function() {

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
				$('#warning-msge').html('Are you sure you want to borrow <strong>'+json[0].title+'?</strong>');
			}
		});
		// var status = 1;
		// console.log(id);

		// $.ajax({
		// 	type:"POST",
		// 	data: {'id': id, 'status':status},
		// 	url: base_url+"book/borrow_return",
		// 	success: function(result) {
		// 		alert(result);
		// 		location.reload();
		// 	}
		// });
	});

	$('#borrow').on('click', function() {

		var id = $('#book_id').val();
		var title = $('#book_title').val();
		var book_status = 1;
		//console.log(title);
		$.ajax({
			type:"POST",
			data: {'id': id, 'title':title, 'book_status':book_status},
			url: base_url+"book/borrow_return",
			success: function(result) {
				var json = $.parseJSON(result);
			
				if(json.status == false) {
					$('#b_error').html('<div class="alert alert-danger">'+json.message+'</div>');
				} else if(json.status == true) {
					$('#close_borrow_modal').trigger('click');
					getBooks();
					$('#success').html('<div class="alert alert-success">'+json.message+'</div>');
				}
			}
		});
	});



	$('#search_title').on('keyup', function() {

		var like = $(this).val();
		var column = 'title';
		//console.log(like);
		$.ajax({

			type:"POST",
			data:{'like':like, 'column':column},
			url:base_url+'book/search',
			success:function(result) {
				//console.log(result);
				var json = $.parseJSON(result);

				$('#myTable tbody').html(newTbody(json));

			},


		});
	});

	$('#search_author').on('keyup', function() {

		var like = $(this).val();
		var column = 'author';

		$.ajax({

			type:"POST",
			data:{'like':like, 'column':column},
			url:base_url+'book/search',
			success:function(result) {

				var json = $.parseJSON(result);
				$('#myTable tbody').html(newTbody(json));
			},


		});
	});

	$('#search_genre').on('keyup', function() {

		var like = $(this).val();
		var column = 'genre';
		console.log(like);
		$.ajax({

			type:"POST",
			data:{'like':like, 'column':column},
			url:base_url+'book/search',
			success:function(result) {
				console.log(result);
				var json = $.parseJSON(result);
				$('#myTable tbody').html(newTbody(json));
			},


		});
	});

	$('#search_library_section').on('keyup', function() {

		var like = $(this).val();
		var column = 'library_section';

		$.ajax({

			type:"POST",
			data:{'like':like, 'column':column},
			url:base_url+'book/search',
			success:function(result) {

				var json = $.parseJSON(result);
				$('#myTable tbody').html(newTbody(json));
			},


		});
	});




});