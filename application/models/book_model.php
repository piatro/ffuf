<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Book_model extends CI_Model {

	public function get_genre() {
		$this->db->select('*')
		->from('genre');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_library_section() {
		$this->db->select('*')
		->from('library_section');
		$query = $this->db->get();
		return $query->result();
	}

	public function check_book($title, $value) {
		$query = $this->db->get_where('books', array('title' => $title));
		if ($query->num_rows() > 0) {
			
			return false;
		}

		$this->db->insert('books', $value);
		return true;
	}

	public function get_book_info($id) {
		
		$query = $this->db->get_where('books', array('id' => $id));
		if ($query->num_rows() > 0) {
			return $query->result();
		}
		
	}

	public function update_book($id, $value) {
		$this->db->where('id', $id)
		->update('books', $value);
		
		return true;
	}

	public function delete_book($id) {
		$this->db->where('id', $id)
		->delete('books');
		return true;
	}

	public function update_book_status($id, $status) {

		$this->db->set('status', $status)
		->where('id', $id)
		->update('books');
		
		return true;
		// if($status == 1) {
		// 	$msge = "Borrowed";
		// } else {
		// 	$msge = "Returned";
		// }
		// echo "Successfully ".$msge;
	}

	public function search($like, $column) {

		$this->db->select('b.id, b.title, b.author, g.genre , ls.library_section')
		->from('books b')
		->join('genre g', 'b.genre = g.id')
		->join('library_section ls', 'b.library_section = ls.id');

		if($column == 'genre') {

			$where = "g.".$column." LIKE '%".$like."%' ";

		} elseif($column == 'library_section') {

			$where = "ls.".$column." LIKE '%".$like."%' ";
		} else {
			$where = "b.".$column." LIKE '%".$like."%' ";
		}

		$where .='AND b.status=0';

		$this->db->where($where);

		$this->db->order_by('id', 'asc');

		$query = $this->db->get();

		return $query->result();
	}
}