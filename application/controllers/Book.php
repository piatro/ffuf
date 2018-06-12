<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Book extends CI_Controller {


	public function __construct() {

		parent::__construct();
		$this->load->model('home_model');
		$this->load->model('book_model');
		
	}


	public function index()
	{

		$data['title'] = "Book Archive";

		$data['book_list'] = $this->home_model->get_books('all');
		$data['genre'] = $this->book_model->get_genre();
		$data['library_section'] = $this->book_model->get_library_section();

		
		// echo "<pre>";
		// echo print_r($data);
		// echo "</pre>";
		$this->load->view('book_archive', $data);


	}

	private function json_response($status, $message) {
		echo json_encode(array(
			'status' => $status,
			'message' => $message
		));
	}

	public function get_books() {

		$books = $this->home_model->get_books('all');

		echo json_encode($books);

	}

	public function insert() {

		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('author', 'Author', 'required');
		$this->form_validation->set_rules('genre', 'Genre', 'required');
		$this->form_validation->set_rules('library_section', 'Library Section', 'required');


		if($this->form_validation->run() === false){
			
			$message = validation_errors();
			$this->json_response(false, $message);

		} else {

			$title = $this->input->post('title');
			$author = $this->input->post('author');
			$genre = $this->input->post('genre');
			$library_section = $this->input->post('library_section');

			$value = array(
				'title' => $title,
				'author' => $author,
				'genre' => $genre,
				'library_section' => $library_section
			);

			$result = $this->book_model->check_book($title, $value);

			if($result) {
				$message = "<strong>Successfully Added ".$title."</strong>";
				$this->json_response(true, $message);
			} else {
				$message = "Book already Exist";
				$this->json_response(false, $message);
			}
		}
	}


	public function get_certain_book() {

		$id = $this->input->post('id');
		$book_info = $this->book_model->get_book_info($id);
		
		// foreach($book_info as $bi) {
		// 	$title = $bi->title;
		// 	$author = $bi->author;
		// 	$genre = $bi->genre;
		// 	$library_section = $bi->library_section;
		// }

		// $val = array(
		// 	'title' => $title,
		// 	'author' => $author,
		// 	'genre' => $genre,
		// 	'library_section' => $library_section
		// );
		// echo json_encode($val);
		echo json_encode($book_info);
	}

	public function update() {
		
		$this->form_validation->set_rules('edit_title', 'Title', 'required');
		$this->form_validation->set_rules('edit_author', 'Author', 'required');
		$this->form_validation->set_rules('edit_genre', 'Genre', 'required');
		$this->form_validation->set_rules('edit_library_section', 'Library Section', 'required');


		if($this->form_validation->run() === false){
			
			$message = validation_errors();
			$this->json_response(false, $message);

		} else {
			$id = $this->input->post('id');
			$title = $this->input->post('edit_title');
			$author = $this->input->post('edit_author');
			$genre = $this->input->post('edit_genre');
			$library_section = $this->input->post('edit_library_section');

			$value = array(
				'title' => $title,
				'author' => $author,
				'genre' => $genre,
				'library_section' => $library_section
			);

			$result = $this->book_model->update_book($id, $value);

			if($result) {
				$message = "<strong>Successfully Updated ".$title."</strong>";
				$this->json_response(true, $message);
			} else {
				$message = "Failed to Update";
				$this->json_response(false, $message);
			}

		}
		
		
	}

	public function delete() {

		$id = $this->input->post('id');
		$title = $this->input->post('title');
		$result = $this->book_model->delete_book($id);
		if($result) {
			$message = "<strong>Successfully Deleted </strong>".$title;
			$this->json_response(true, $message);
		} else {
			$message = "Failed to Delete ".$title;
			$this->json_response(false, $message);
		}
	}

	public function borrow_return() {

		$id = $this->input->post('id');
		$title = $this->input->post('title');
		$book_status = $this->input->post('book_status');

		$result = $this->book_model->update_book_status($id, $book_status);

		if($result) {

			if($book_status == 1){
				$message = "<strong>Successfully</strong> Borrowed ".$title;
			
			} else {
				$message = "<strong>Successfully</strong> Returned ".$title;
			}


			$this->json_response(true, $message);
		
		} else {
			$message = "Failed to Borrow/Return ".$title;
			$this->json_response(false, $message);
		}

	}

	public function search() {

		$like = $this->input->post('like');
		$column = $this->input->post('column');
		$data = $this->book_model->search($like, $column);

		echo json_encode($data);

	}

}