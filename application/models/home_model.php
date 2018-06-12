<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_model extends CI_Model {

	public function get_books($filter = '') {

		$this->db->select('b.id, b.title, b.author, g.genre, ls.library_section, b.status')
		->from('books b')
		->join('genre g', 'b.genre = g.id')
		->join('library_section ls', 'b.library_section = ls.id');

		if($filter != 'all') {
			$this->db->where('b.status = 0')
			->order_by('id', 'asc');

		} else {
			$this->db->order_by('id', 'asc');
		}

		$query = $this->db->get();

		return $query->result();
	}

	
	
	

}