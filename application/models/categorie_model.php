<?php

class Categorie_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}
	
	function get_categorie() {
		return $this->db->get('Categorie');
	}
	
	function get_categoria($data) {
		$this->db->where('ID_categoria', $data);
		$this->db->or_where('categoria_nome', $data);
		return $this->db->get('Categorie')->row();
	}
	
	function aggiungi_categoria() {
		if ($this->input->post('periodico')) {
			$periodico = 1;
		} else {
			$periodico = 0;
		}
		if ($this->input->post('linkable')) {
			$linkable = 1;
		} else {
			$linkable = 0;
		}
		if ($this->input->post('genitori')) {
			$genitori = 1;
		} else {
			$genitori = 0;
		}
		if ($this->input->post('multimedia')) {
			$multimedia = 1;
		} else {
			$multimedia = 0;
		}
		if ($this->input->post('imagetitle')) {
			$imagetitle = 1;
		} else {
			$imagetitle = 0;
		}
		if ($this->input->post('commentabile')) {
			$commentabile = 1;
		} else {
			$commentabile = 0;
		}
		$data = array(
			'categoria_nome' => $this->input->post('nome'),
			'categoria_periodico' => $periodico,
			'categoria_linkable' => $linkable,
			'categoria_genitori' => $genitori,
			'categoria_multimedia' => $multimedia,
			'categoria_imagetitle' => $imagetitle,
			'categoria_commentabile' => $commentabile
		);
		return $this->db->insert('Categorie', $data);
	}
	
	function elimina_categoria($id) {
		//Verifico che non ci siano pagine con questa categoria
		$this->db->where('post_tipo', $id);
		if ($this->db->get('Post')->num_rows() > 0) {
			//Non posso cancellare in quanto vi sono pagine con questa categoria
			$message = '
				<div id="dialog-message" title="Errore">
					Impossibile cancellare la categoria.<br>
					La categoria &egrave utilizzata da alcune pagine.
				</div>
			';
			$this->session->set_flashdata('message', $message);
			return false;
		} else {
			$this->db->where('ID_categoria', $id);
			if ($this->db->delete('Categorie')) {
				//Categoria eliminata
				return true;
			} else {
				//Categoria non eliminata
				$message = '
					<div id="dialog-message" title="Categoria non eliminata">
						Categoria non eliminata.
					</div>
				';
				$this->session->set_flashdata('message', $message);
				return false;
			}
		}
	}
	
	function aggiorna_categoria($id) {
		if ($this->input->post('periodico')) {
			$periodico = 1;
		} else {
			$periodico = 0;
		}
		if ($this->input->post('linkable')) {
			$linkable = 1;
		} else {
			$linkable = 0;
		}
		if ($this->input->post('genitori')) {
			$genitori = 1;
		} else {
			$genitori = 0;
		}
		if ($this->input->post('multimedia')) {
			$multimedia = 1;
		} else {
			$multimedia = 0;
		}
		if ($this->input->post('imagetitle')) {
			$imagetitle = 1;
		} else {
			$imagetitle = 0;
		}
		if ($this->input->post('commentabile')) {
			$commentabile = 1;
		} else {
			$commentabile = 0;
		}
		$data = array(
			'categoria_nome' => $this->input->post('nome'),
			'categoria_linkable' => $linkable,
			'categoria_periodico' => $periodico,
			'categoria_genitori' => $genitori,
			'categoria_multimedia' => $multimedia,
			'categoria_imagetitle' => $imagetitle,
			'categoria_commentabile' => $commentabile
		);
		$this->db->where('ID_categoria', $id);
		return $this->db->update('Categorie', $data);
	}
}

?>