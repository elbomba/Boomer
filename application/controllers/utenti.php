<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

session_start();

class Utenti extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model(array('utenti_model', 'function_model'));
		$this->load->helper(array('html', 'url', 'form'));
		$this->load->library(array('session', 'form_validation'));
	}
	
	public function nuovo_utente() {
		if (!$this->session->userdata('logged_in')) {
			redirect('', 'refresh');
		}
		
		$data['title'] = site_name()." - Amministrazione - Nuovo Utente";
		$data['message'] = $this->session->flashdata('message');
		$data['printMessage'] = $this->function_model->printMessage();
		
		//Valido il form
		$this->form_validation->set_rules('tipo', 'Tipo Utente', 'trim|required');
		$this->form_validation->set_rules('login', 'Nome Utente', 'trim|required|unique[User.user_login]');
		$this->form_validation->set_rules('email', 'E-mail Utente', 'trim|required|valid_email|unique[User.user_email]');
		$this->form_validation->set_rules('nome', 'Nome', 'trim');
		$this->form_validation->set_rules('cognome', 'Cognome', 'trim');
		$this->form_validation->set_rules('password', 'Password Utente', 'trim|required|matches[confirm_password]|md5');
		$this->form_validation->set_rules('confirm_password', 'Conferma Password', 'trim|required|md5');
		
		if ($this->form_validation->run() == FALSE) {
			//Form non validato correttamente
			if (validation_errors()) {
				$data['message'] = '
					<div id="dialog-message" title="Error">
						'.validation_errors().'
					</div>
				';
			}
			
			$this->load->view('templates/admin-header', $data);
			$this->load->view('templates/admin-menu');
			$this->load->view('admin/utenti/nuovo-utente', $data);
			$this->load->view('templates/admin-footer');
		} else {
			// Form valido, aggiorno i dati
			if ($this->utenti_model->add_user()) {
				//Articolo aggiunto correttamente
				$message = '
					<div id="dialog-message" title="Utente Aggiunto">
						Utente Aggiunto Correttamente.
					</div>
				';
				$this->session->set_flashdata('message', $message);
				
				redirect('admin/utenti', 'refresh');
			} else {
				$data['message'] = '
					<div id="dialog-message" title="Errore Nel Database">
						Errore salvataggio utente.
					</div>
				';
				
				$this->load->view('templates/admin-header', $data);
				$this->load->view('templates/admin-menu');
				$this->load->view('admin/utenti/nuovo-utente', $data);
				$this->load->view('templates/admin-footer');
			}
		}
	}
	
	public function modifica_utente($utente = false) {
		if (!$this->session->userdata('logged_in')) {
			redirect('', 'refresh');
		}
		
		if (!$utente) {
			redirect('admin/utenti', 'refresh');
		}
		
		$data['title'] = site_name()." - Amministrazione - Modifica Utente";
		$data['user'] = $this->utenti_model->get_user($utente);
		$data['message'] = $this->session->flashdata('message');
		$data['printMessage'] = $this->function_model->printMessage();
		
		//Valido il form
		$this->form_validation->set_rules('login', 'Login Utente', 'trim|required|unique[User.user_login]');
		$this->form_validation->set_rules('email', 'Email Utente', 'trim|required|valid_email|unique[User.user_email]');
		if ($this->input->post('new_password') != "") {
			$this->form_validation->set_rules('new_password', 'Nuova Password Utente', 'trim|required|matches[confirm_new_password]|md5');
			$this->form_validation->set_rules('confirm_new_password', 'Conferma Nuova Password', 'trim|required|md5');
			$this->form_validation->set_rules('old_password', 'Vecchia Password', 'trim|required|md5');
		}
		
		if ($this->form_validation->run() == FALSE) {
			//Form non validato correttamente
			if (validation_errors()) {
				$data['message'] = '
					<div id="dialog-message" title="Error">
						'.validation_errors().'
					</div>
				';
			}
		
			$this->load->view('templates/admin-header', $data);
			$this->load->view('templates/admin-menu');			
			$this->load->view('admin/utenti/modifica-utente', $data);
			$this->load->view('templates/admin-footer');
		} else {
			//Form validato aggiorno i dati
			if ($this->utenti_model->aggiorna_utente($utente)) {
				//Utente aggiornato correttamente
				$message = '
					<div di="dialog-message" title="Utente Modificato">
						Utente Modificato Correttamente.
					</div>
				';
				$this->session->set_flashdata('message', $message);
				
				redirect('admin/utenti', 'refresh');
			} else {
				//Errore nel database
				$data['message'] = $this->session->flashdata('message');
				
				$this->load->view('templates/admin-header', $data);
				$this->load->view('templates/admin-menu');
				$this->load->view('admin/utenti/modifica-utente', $data);
				$this->load->view('templates/admin-footer');
			}
		}
	}
	
	public function elimina_utente($utente = false) {
		if (!$this->session->userdata('logged_in')) {
			redirect('', 'refresh');
		}
		
		if (!$utente) {
			redirect('admin/utenti', 'refresh');
		}
		
		if ($utente == $this->session->userdata('id')) {
			$message = '
				<div id="dialog-message" title="Utente non eliminato">
					Impossibile eliminare se stessi.
				</div>
			';
			$this->session->set_flashdata('message', $message);
			redirect('admin/utenti', 'refresh');
		}
		
		$data['title'] = site_name()." - Amministrazione - Elimina Utente";
		
		if ($this->utenti_model->elimina_utente($utente)) {
			//Utente Eliminato
			$message = '
				<div id="dialog-message" title="Utente Eliminato">
					Utente eliminato.
				</div>
			';
			$this->session->set_flashdata('message', $message);
			
			redirect('admin/utenti', 'refresh');
		} else {
			//Utente non eliminato
			$message = '
				<div id="dialog-message" title="Utente non eliminato">
					Utente non eliminato.
				</div>
			';
			$this->session->set_flashdata('message', $message);
			
			redirect('admin/utenti', 'refresh');
		}
	}
}