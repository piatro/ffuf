<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct() {

		parent::__construct();
		$this->load->model('home_model');
		
	}


	public function index()
	{

		$data['title'] = "Available Books";

		$data['book_list'] = $this->home_model->get_books();

		$this->load->view('home', $data);


	}

	public function get_books() {
		$books = $this->home_model->get_books();
		echo json_encode($books);
	}

	
}
