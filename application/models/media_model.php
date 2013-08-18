<?php

class Media_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}
	
	public function get_media($id) {
		return $this->db->get_where('Media', array('ID_media' => $id))->row();
	}
	
	public function get_all_media($tipo = null) {
		if ($tipo == null) {
			return $this->db->get('Media');
		} else {
			return $this->db->get_where('Media', array('media_tipo' => $tipo));
		}
		
	}
	
	public function modifica_media($id) {
		$data = array('media_nome' => $this->input->post('nome'));
		$this->db->where('ID_media', $id);
		return $this->db->update('Media', $data);
	}
	
	public function elimina_media($id) {
		$this->db->where('ID_media', $id);
		return $this->db->delete('Media');
	}
}