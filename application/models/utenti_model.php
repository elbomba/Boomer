<?php

	class Utenti_model extends CI_Model {
		public function __construct() {
			$this->load->database();
		}
		
		function login() {
			$this->db->where('user_login', $this->input->post('user'));
			$this->db->or_where('user_email', $this->input->post('user'));
			$user = $this->db->get('User')->row();
			if ($user->user_password == $this->input->post('password')) {
				//Login ok aggiorno database per mettere online
				$data = array(
					'user_status' => 1
				);
				$this->db->where('ID_user', $user->ID_user);
				$this->db->update('User', $data);
				
				return true;
			} else {
				$message = '
					<div di="dialog-message" title="Login errato">
						Username o Password errati.
					</div>
				';
				$this->session->set_flashdata('message', $message);
				return false;
			}
		}
		
		function logout() {
			//Aggiorno il database
			$data = array(
				'user_status' => 0
			);
			$this->db->where('ID_user', $this->session->userdata('id'));
			return $this->db->update('User', $data);
		}
		
		function count_users($tipo = null) {
			if ($tipo) {
				$this->db->where('user_tipo', $tipo);
				$this->db->from('User');
				$res = $this->db->count_all_results();
			} else {
				$this->db->from('User');
				$res = $this->db->count_all_results();
			}
			return $res;
		}
		
		function get_users($tipo = null) {
			if ($tipo) {
				$this->db->order_by('user_tipo asc, user_login asc');
				return $this->db->get_where('User', array('user_tipo' => $tipo));
			} else {
				$this->db->order_by('user_tipo asc, user_login asc');
				return $this->db->get('User');
			}
		}
		
		// Function to get the user data using the id or the login or email 
		function get_user($data) {
			$this->db->where('ID_user', $data);
			$this->db->or_where('user_login', $data);
			$this->db->or_where('user_email', $data);
			return $this->db->get('User')->row();
		}
		
		function add_user() {
			$data = array(
				'user_login' => $this->input->post('login'),
				'user_email' => $this->input->post('email'),
				'user_nome' => $this->input->post('nome'),
				'user_cognome' => $this->input->post('cognome'),
				'user_password' => $this->input->post('password'),
				'user_tipo' => $this->input->post('tipo')
			);
			return $this->db->insert('User', $data);
		}
		
		function elimina_utente($id) {
			$this->db->where('ID_user', $id);
			return $this->db->delete('User');
		}
		
		function aggiorna_utente($id) {
			$pass = $this->db->get_where('User', array('ID_user' => $id))->row()->user_password;
			if ($this->input->post('new_password') != "") {
				if ($pass == $this->input->post('old_password')) {
					$data = array(
						'user_login' => $this->input->post('login'),
						'user_email' => $this->input->post('email'),
						'user_nome' => $this->input->post('nome'),
						'user_cognome' => $this->input->post('cognome'),
						'user_password' => $this->input->post('new_password'),
						'user_tipo' => $this->input->post('tipo')
					);
					$this->db->where('ID_user', $id);
					if ($this->db->update('User', $data)) {
						return true;
					} else {
						$message = '
							<div id="dialog-message" title="Utente non aggiornato">
								Errore aggiornamento database.
							</div>
						';
						$this->session->set_flashdata('message', $message);
						return false;
					}
				} else {
					$message = '
						<div id="dialog-message" title="Utente non aggiornato">
							Password errata.
						</div>
					';
					$this->session->set_flashdata('message', $message);
					return false;
				}
			} else {
				$data = array(
						'user_login' => $this->input->post('login'),
						'user_email' => $this->input->post('email'),
						'user_nome' => $this->input->post('nome'),
						'user_cognome' => $this->input->post('cognome'),
						'user_tipo' => $this->input->post('tipo')
					);
					$this->db->where('ID_user', $id);
					if ($this->db->update('User', $data)) {
						return true;
					} else {
						$message = '
							<div id="dialog-message" title="Utente non aggiornato">
								Errore aggiornamento database.
							</div>
						';
						$this->session->set_flashdata('message', $message);
						return false;
					}
			}
		}
	}

?>