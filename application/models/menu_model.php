<?php

class Menu_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}
	
	public function add_menu() {
		$data = array(
			'menu_nome' => $this->input->post('nome'),
			'menu_descrizione' => $this->input->post('desc')
		);
		return $this->db->insert('Menu', $data);
	}
	
	public function add_menu_item() {
		$data = array(
			'menu_item_main' => $this->input->post('main'),
			'menu_item_nome' => $this->input->post('nome'),
			'menu_item_link' => $this->input->post('link'),
			'menu_item_genitore' => $this->input->post('genitore'),
			'menu_item_ordine' => $this->input->post('ordine')
		);
		return $this->db->insert('Menu_Item', $data);
	}
	
	public function aggiorna_menu($id) {
		$data = array (
			'menu_nome' => $this->input->post('nome'),
			'menu_descrizione' => $this->input->post('desc')
		);
		$this->db->where('ID_menu', $id);
		return $this->db->update('Menu', $data);
	}
	
	public function aggiorna_menu_item($id) {
		$data = array (
			'menu_item_nome' => $this->input->post('nome'),
			'menu_item_link' => $this->input->post('pagina'),
			'menu_item_genitore' => $this->input->post('genitore'),
			'menu_item_ordine' => $this->input->post('ordine')
		);
		$this->db->where('ID_menu_item', $id);
		return $this->db->update('Menu_Item', $data);
	}
	
	public function get_menus() {
		return $this->db->get('Menu');
	}
	
	public function get_menu($data) {
		$this->db->where('ID_menu', $data);
		$this->db->or_where('menu_nome', $data);
		return $this->db->get('Menu')->row();
	}
	
	public function get_menu_item($id) {
		return $this->db->get_where('Menu_Item', array('ID_menu_item' => $id))->row();
	}
	
	public function get_root_menu_items($id = 0) {
		$this->db->where('menu_item_genitore', 0);
		$this->db->where('menu_item_main', $id);
		$this->db->order_by('menu_item_ordine');
		return $this->db->get('Menu_Item');
	}
	
	public function get_son($id) {
		$this->db->where('menu_item_genitore', $id);
		return $this->db->get('Menu_Item');
	}
	
	public function has_son($id) {
		$this->db->where('menu_item_genitore', $id);
		if ($this->db->get('Menu_Item')->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	// funzione che vede se m1 è padre di m2
	public function is_father($m1, $m2) {
		if ($this->menu_model->get_menu($m2)->menu_item_genitore == $m1) {
			return true;
		} else {
			return false;
		}
	}
	
	//Funzione che restituisce i possibili genitori di un menu
	public function get_possible_parent($id) {
		$not_possible = $this->menu_model->get_sons_id($id);
		$this->db->where_not_in('ID_menu_item', $not_possible);
		return $this->db->get('Menu_Item');
	}
	
	//Funzione che restituisce tutti i figli (anche annidati) di un menu
	public function get_sons_id($id) {
		//Tolgo il menu stesso dalle soluzioni
		$elements[] = $id;
		
		//Vedo se il menu ha figli
		if ($this->menu_model->has_son($id)) {
			//Recupero i figli
			$sons = $this->menu_model->get_son($id);
			foreach($sons->result() as $row) {
				//vedo se il figlio ha figli
				if ($this->menu_model->has_son($row->ID_menu_item)) {
					//il figlio ha figli
					$ris = $this->menu_model->get_sons_id($row->ID_menu_item);
					foreach($ris as $el) {
						$elements[] = $el;
					}
				} else {
					//il figlio non ha figli
					//lo aggiungo all'array
					$elements[] = $row->ID_menu_item;
				}
			}
		}
		// Se non ha figli basta togliere lui
	
		return $elements;
	}
	
	public function has_father($id) {
		$el = $this->db->get_where('Menu_Item', array('ID_menu_item' => $id))->row();
		if ($el->menu_item_genitore != 0) {
			return true;
		} else {
			return false;
		}
	}
	
	public function has_page_linked($id) {
		$el = $this->db->get_where('Menu_Item', array('ID_menu_item' => $id))->row();
		if ($el->menu_item_link == 0) {
			return false;
		} else {
			return true;
		}
	}
	
	public function get_page_linked($id) {
		$el = $this->db->get_where('Menu_Item', array('ID_menu_item' => $id))->row();
		return $page_id = $this->db->get_where('Post', array('ID_post' => $el->menu_item_link))->row()->ID_post;
	}
 	
	public function elimina_menu($id) {
		//Il menu principale non si può eliminare
		if ($id == 1) {
			$message = '
				<div di="dialog-message" title="Menu non cancellato">
					Impossibile cancellare il menu principale.
					Errore nella cancellazione dal database.
				</div>
			';
			$this->session->set_flashdata('message', $message);
			redirect('admin/menu?menu='.$this->menu_model->get_menu($id)->menu_nome, 'refresh');
			return false;
			exit;
		} else {
			$this->db->where('ID_menu', $id);
			if ($this->db->delete('Menu')) {
				//Cancellato
				return true;
			} else {
				$message = '
					<div di="dialog-message" title="Menu non cancellato">
						Errore nella cancellazione dal database.
					</div>
				';
				$this->session->set_flashdata('message', $message);
			
				return false;
			}
		}
	}
	
	public function elimina_menu_item($id) {
		if ($this->menu_model->has_son($id)) {
			//Il menu ha dei figli
			
			//Vedo se il menu iniziale ha un genitore
			if ($this->menu_model->has_father($id)) {
				//Ha un genitore
				//Assegno come valore del genitore dei figli quello del genitore del menu che verrà eliminato
				$data = array('menu_item_genitore' => $this->menu_model->get_menu($id)->menu_genitore);
			} else {
				//Non ha un genitore
				//rendo il menu di root
				$data = array('menu_item_genitore' => 0);
			}
			
			//recupero i figli
			$sons = $this->menu_model->get_son($id);
			foreach($sons->result() as $row) {
				//Aggiorno i figli
				$this->db->where('ID_menu_item', $row->ID_menu_item);
				if (!$this->db->update('Menu_Item', $data)) {
					//Non aggiornati
					$message = '
						<div id="dialog-message" title="Error">
							Errore nella cancellazione del menu.
							Impossibile aggiornare i menu figli.
						</div>
					';
					$this->session->set_flashdata('message', $message);
					return false;
					exit;
				}
			}
			//Procedo con l'eliminazione del menu
			$this->db->where('ID_menu_item', $id);
			if ($this->db->delete('Menu_Item')) {
				//Menu eliminato
				return true;
			} else {
				//Menu non cancellato
				$message = '
					<div di="dialog-message" title="Error">
						Impossibile cancellare il menu.
						Errore nella cancellazione dal database.
					</div>
				';
				$this->session->set_flashdata('message', $message);
				return false;
			}
		} else {
			//Il menu non ha figli
			//Elimino direttamente il menu
			$this->db->where('ID_menu_item', $id);
			if ($this->db->delete('Menu_Item')) {
				//Menu eliminato
				return true;
			} else {
				//Menu non cancellato
				$message = '
					<div di="dialog-message" title="Error">
						Impossibile cancellare il menu.
						Errore nella cancellazione dal database.
					</div>
				';
				$this->session->set_flashdata('message', $message);
				return false;
			}
		}
	}
}

?>