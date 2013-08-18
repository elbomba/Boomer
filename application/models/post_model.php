<?php

class Post_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}
	
	function get_posts($cat = 0) {
		if ($cat == 0) {
			$this->db->order_by('post_tipo');
			return $this->db->get('Post');
		} else {
			$this->db->order_by('post_tipo');
			return $this->db->get_where('Post', array('post_tipo' => $cat));
		}
	}
	
	function get_promo($data) {
		return $this->db->get_where('Post', array('post_data_da <' => $data, 'post_data_a >' => $data));
	}
	
	function get_post($post) {
		$this->db->where('ID_post', $post);
		$this->db->or_where('post_titolo', $post);
		$this->db->or_where('post_url_nome', $post);
		return $this->db->get('Post')->row();
	}
	
	function get_homepage() {
		$this->db->where('post_tipo', 1);
		return $this->db->get('Post')->row();
	}
	
	function has_son($id) {
		if ($this->db->get_where('Post', array('post_genitore' => $id))->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	function get_son($id) {
		$this->db->order_by('post_ordine');
		return $this->db->get_where('Post', array('post_genitore' => $id));
	}
	
	function get_root_posts($cat = 0) {
		if ($cat == 0) {
			//Recupero tutti
			$this->db->order_by('post_tipo, post_ordine');
			return $this->db->get_where('Post', array('post_genitore' => 0));
		} else {
			//Recupero solo quelli della categoria
			$this->db->order_by('post_tipo');
			return $this->db->get_where('Post', array('post_genitore' => 0, 'post_tipo' => $cat));
		}		
	}
	
	function get_linkable_post() {
		$sql = '
			SELECT *
			FROM Post 
			INNER JOIN Categorie 
			ON Post.post_tipo = Categorie.ID_categoria 
			WHERE Categorie.categoria_linkable = ?
		';
		return $this->db->query($sql, 1);
	}
	
	function get_root_linkable_post() {
		$sql = '
			SELECT *
			FROM Post 
			INNER JOIN Categorie 
			ON Post.post_tipo = Categorie.ID_categoria 
			WHERE Categorie.categoria_linkable = ? AND Post.post_genitore = ?
		';
		return $this->db->query($sql, array(1, 0));
	}
	
	function aggiungi_post() {
		// Creo il nome url della pagina
		$url_nome = str_replace(' ', '-', strtolower($this->input->post('titolo')));
		
		$cat_id = $this->input->post('tipo');
		if ($this->categorie_model->get_categoria($cat_id)->categoria_linkable) {
			//periodico
			$data = array(
				'post_autore' => $this->input->post('autore'),
				'post_titolo' => $this->input->post('titolo'),
				'post_url_nome' => $url_nome,
				'post_genitore' => $this->input->post('genitore'),
				'post_imagetitle' => $this->input->post('imagetitle'),
				'post_ordine' => $this->input->post('ordine'),
				'post_stato' => $this->input->post('stato'),
				'post_content' => $this->input->post('contenuto'),
				'post_script' => $this->input->post('script'),
				'post_tipo' => $this->input->post('tipo'),
				'post_data_da' => $this->input->post('data_da'),
				'post_data_a' => $this->input->post('data_a')
			);
		} else {
			//non periodico
			$data = array(
				'post_autore' => $this->input->post('autore'),
				'post_titolo' => $this->input->post('titolo'),
				'post_url_nome' => $url_nome,
				'post_genitore' => $this->input->post('genitore'),
				'post_imagetitle' => $this->input->post('imagetitle'),
				'post_ordine' => $this->input->post('ordine'),
				'post_stato' => $this->input->post('stato'),
				'post_content' => $this->input->post('contenuto'),
				'post_script' => $this->input->post('script'),
				'post_tipo' => $this->input->post('tipo')
			);
		}
		
		return $this->db->insert('Post', $data);
	}
	
	function modifica_post($id) {
		// Ricreo l'url nome anche se non  cambiato il nome del post
		$url_nome = str_replace(' ', '-', strtolower($this->input->post('titolo')));
		
		$cat_id = $this->post_model->get_post($id)->post_tipo;
		if ($this->categorie_model->get_categoria($cat_id)->categoria_linkable) {
			//periodico
			$data = array(
				'post_titolo' => $this->input->post('titolo'),
				'post_url_nome' => $url_nome,
				'post_genitore' => $this->input->post('genitore'),
				'post_imagetitle' => $this->input->post('imagetitle'),
				'post_ordine' => $this->input->post('ordine'),
				'post_stato' => $this->input->post('stato'),
				'post_content' => $this->input->post('contenuto'),
				'post_script' => $this->input->post('script'),
				'post_data_da' => $this->input->post('data_da'),
				'post_data_a' => $this->input->post('data_a')
			);
		} else {
			$data = array(
				'post_titolo' => $this->input->post('titolo'),
				'post_url_nome' => $url_nome,
				'post_genitore' => $this->input->post('genitore'),
				'post_imagetitle' => $this->input->post('imagetitle'),
				'post_ordine' => $this->input->post('ordine'),
				'post_stato' => $this->input->post('stato'),
				'post_content' => $this->input->post('contenuto'),
				'post_script' => $this->input->post('script')
			);
		}
		$this->db->where('ID_post', $id);
		return $this->db->update('Post', $data);
	}
	
	function elimina_post($id) {
		//Vedo se c' menu con questa pagina
		$menu = $this->db->get_where('Menu_Item', array('menu_item_link' => $id));
		if ($menu->num_rows() > 0) {
			// Errore impossibile cancellare il post
			return false;
		} else {
			$this->db->where('ID_post', $id);
			return $this->db->delete('Post');
		}
	}
	
	//Funzione che restituisce i possibili genitori di un post
	function get_possible_parent($id) {
		//Trovo i genitori non possibili
		$not_possible = $this->post_model->get_sons_id($id);
		//Recupero la categoria del post
		$cat = $this->db->get_where('Post', array('ID_post' => $id))->row()->post_tipo;
		$this->db->where('post_tipo', $cat);
		$this->db->where_not_in('ID_post', $not_possible);
		return $this->db->get('Post');
	}
	
	//Funzione che restituisce l'id di tutti i figli (anche annidati) di un post
	function get_sons_id($id) {
		//Tolgo il post stesso dalle soluzioni
		$elements[] = $id;
		
		//Vedo se il menu ha figli
		if ($this->post_model->has_son($id)) {
			//Recupero i figli
			$sons = $this->post_model->get_son($id);
			foreach($sons->result() as $row) {
				//vedo se il figlio ha figli
				if ($this->post_model->has_son($row->ID_post)) {
					//il figlio ha figli
					$ris = $this->post_model->get_sons_id($row->ID_post);
					foreach($ris as $el) {
						$elements[] = $el;
					}
				} else {
					//il figlio non ha figli
					//lo aggiungo all'array
					$elements[] = $row->ID_post;
				}
			}
		}
		// Se non ha figli basta togliere lui
	
		return $elements;
	}
	
	// Funzione che mostra se l'url  corretto o se la pagina con l'url selezionato non esiste
	function is_correct_url($array, $n = 0, $root = null) {
		if ($n == 0) {
			$res = $this->post_model->get_root_posts();
		} else {
			if ($this->post_model->has_son($root)) {
				$res = $this->post_model->get_son($root);
			} else {
				show_404();
			}
			
		}
		
		foreach($res->result() as $row) {
			$nomi[] = $row->post_url_nome;
		}
		
		if (in_array($array[$n], $nomi)) {
			if (count($array)-1 == $n) {
				// Finito il pathname
				// Caso in cui finisca senza /
				return true;
			} else {
				if ($array[$n+1] == null) {
					// Finito il pathname
					// Caso in cui finisca con /
					return true;
				} else {
					// Ancora pathname da verificare
					// Recupero l'ID del post
					$id = $this->post_model->get_post($array[$n])->ID_post;
					// elimino il primo elemento dell'array
					return $this->post_model->is_correct_url($array, $n+1, $id);
				}
			}
		} else {
			show_404();
		}
	}
}

?>