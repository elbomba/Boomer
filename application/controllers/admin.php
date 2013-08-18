<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

session_start();

class Admin extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('function_model');
		$this->load->helper(array('html', 'url', 'form'));
		$this->load->library(array('session', 'form_validation'));
	}

	public function index() {
		$this->load->model('utenti_model');
		
		if (!$this->session->userdata('logged_in')) {
			//Utente non loggato
			$data['title'] = site_name()." - Amministrazione - Login";
			$data['message'] = $this->session->flashdata('message');
			$data['printMessage'] = $this->function_model->printMessage();
			
			//Valido il form
			$this->form_validation->set_rules('user', 'Login o Password', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|md5');
			
			if ($this->form_validation->run() == FALSE) {
				//Form non validato correttamente
				if (validation_errors()) {
					$data['message'] = '
						<div id="dialog-message" title="Errore Login">
							'.validation_errors().'
						</div>
					';
				}
				$this->load->view('templates/admin-header', $data);
				$this->load->view('admin/login', $data);
				$this->load->view('templates/admin-footer');
			} else {
				//Form validato correttamente
				if ($this->utenti_model->login()) {
					//Loggato
					//Creo e passo il messaggio
					$message = '
						<div id="dialog-message" title="Login Effettuato">
							Login effettuato corretamente.
						</div>
					';
					$this->session->set_flashdata('message', $message);
					
					//Creo la sessione

					$utente = $this->utenti_model->get_user(set_value('user'));
					$sess_array = array(
						'id' => $utente->ID_user,
						'nome' => $utente->user_login,
						'email' => $utente->user_email,
						'logged_in' => true
					);
					$this->session->set_userdata($sess_array);
					
					//Aggiorno la pagina
					redirect('admin', 'refresh');
				} else {
					//Non loggato
					$data['message'] = $this->session->flashdata('message');
					
					$this->load->view('templates/admin-header', $data);
					$this->load->view('admin/login', $data);
					$this->load->view('templates/admin-footer');
				}
			}
		} else {
			//Già loggato
			$data['title'] = site_name()." - Amministrazione";
			$data['message'] = $this->session->flashdata('message');
			$data['printMessage'] = $this->function_model->printMessage();

			$this->load->view('templates/admin-header', $data);
			$this->load->view('templates/admin-menu');
			$this->load->view('admin/index');
			$this->load->view('templates/admin-footer');
		}
	}
	
	public function logout() {
		$this->load->model('utenti_model');
		
		if ($this->utenti_model->logout()) {
			//Database aggiornato
			//Rimuovo la sessione
			$this->session->unset_userdata('logged_in');
			session_destroy();
			
			$message = '
				<div id="dialog-message" title="Logout">
					Sei uscito con successo.
				</div>
			';
			$this->session->set_flashdata('message', $message);

			redirect('', 'refresh');
		} else {
			//Logout fallito
			//Database non aggiornato
			$message = '
				<div id="dialog-message" title="Errore Logout">
					Errore nel logout.
				</div>
			';
			
			$this->session->set_flashdata('message', $message);

			redirect('admin', 'refresh');
		}
	}
	
	public function utenti() {
		if (!$this->session->userdata('logged_in')) {
			redirect('', 'refresh');
		}
		
		$this->load->model('utenti_model');

		$data['title'] = site_name()." - Amministrazione - Vedi Utenti";
		
		$data['message'] = $this->session->flashdata('message');
		$data['printMessage'] = $this->function_model->printMessage();
		
		// Vedo se la ricerca è refinita
		if (isset($_GET['tipo'])) {
			$data['utenti'] = $this->utenti_model->get_users($_GET['tipo']);
		} else {
			$data['utenti'] = $this->utenti_model->get_users();
		}
		$data['num_all'] = $this->utenti_model->count_users();
		$data['num_adm'] = $this->utenti_model->count_users('admin');
		$data['num_mod'] = $this->utenti_model->count_users('moderator');
		$data['num_usr'] = $this->utenti_model->count_users('user');
		
		$this->load->view('templates/admin-header', $data);
		$this->load->view('templates/admin-menu');
		$this->load->view('admin/utenti/vedi-utenti');
		$this->load->view('templates/admin-footer');
	}
	
	public function post() {
		if (!$this->session->userdata('logged_in')) {
			redirect('', 'refresh');
		}
		
		$this->load->model(array('post_model', 'categorie_model', 'utenti_model'));
		
		$data['title'] = site_name()." - Amministrazione - Vedi Post";
		$data['message'] = $this->session->flashdata('message');
		$data['printMessage'] = $this->function_model->printMessage();
		$data['categorie'] = $this->categorie_model->get_categorie();
		$data['sel_cat'] = $this->input->post('ricerca');
		$data['posts'] = $this->post_model->get_posts();
		
		//Valido il form
		$this->form_validation->set_rules('ricerca', 'Ricerca', 'trim');
		
		if ($this->form_validation->run() == FALSE) {
			//Non validato
			if (validation_errors()) {
				$data['message'] = '
					<div id="dialog-message" title="Error">
						'.validation_errors().'
					</div>
				';
			}
			
			$data['root_post'] = $this->post_model->get_root_posts();

			$this->load->view('templates/admin-header', $data);
			$this->load->view('templates/admin-menu');
			$this->load->view('admin/post/vedi-post', $data);
			$this->load->view('templates/admin-footer');
		} else {
			//form validato
			$data['root_post'] = $this->post_model->get_root_posts($this->input->post('ricerca'));
			
			$this->load->view('templates/admin-header', $data);
			$this->load->view('templates/admin-menu');
			$this->load->view('admin/post/vedi-post', $data);
			$this->load->view('templates/admin-footer');
		}		
	}
	
	public function media() {
		if (!$this->session->userdata('logged_in')) {
			redirect('', 'refresh');
		}
		
		$this->load->model(array('media_model'));
		
		$data['title'] = site_name()." - Amministrazione - Vedi Media";
		$data['message'] = $this->session->flashdata('message');
		$data['printMessage'] = $this->function_model->printMessage();
		
		//Valido il form
		$this->form_validation->set_rules('ricerca', 'Ricerca', 'trim');
		
		if ($this->form_validation->run() == FALSE) {
			//Non validato
			if (validation_errors()) {
				$data['message'] = '
					<div id="dialog-message" title="Error">
						'.validation_errors().'
					</div>
				';
			}
			
			$data['media'] = $this->media_model->get_all_media();

			$this->load->view('templates/admin-header', $data);
			$this->load->view('templates/admin-menu');
			$this->load->view('admin/media/vedi-media', $data);
			$this->load->view('templates/admin-footer');
		} else {
			//form validato
			$data['media'] = $this->media_model->get_all_media($this->input->post('ricerca'));
			
			$this->load->view('templates/admin-header', $data);
			$this->load->view('templates/admin-menu');
			$this->load->view('admin/media/vedi-media', $data);
			$this->load->view('templates/admin-footer');
		}
	}
	
	public function menu() {
		if (!$this->session->userdata('logged_in')) {
			redirect('', 'refresh');
		}
		
		$this->load->model('menu_model');
		
		$data['message'] = $this->session->flashdata('message');
		$data['printMessage'] = $this->function_model->printMessage();
		
		if (isset($_GET['menu'])) {
			$menu_id = $this->menu_model->get_menu($_GET['menu'])->ID_menu;
			$data['title'] = site_name()." - Amministrazione - Vedi ".$_GET['menu'];
			$data['root_menu'] = $this->menu_model->get_root_menu_items($menu_id);
			$data['menu'] = $this->menu_model->get_menu($_GET['menu']);
			$data['menu_nome'] = $_GET['menu'];
			
			// Vedi il menu selezionato
			$this->load->view('templates/admin-header', $data);
			$this->load->view('templates/admin-menu');
			$this->load->view('admin/menu/vedi-menu', $data);
			$this->load->view('templates/admin-footer');
		} else {
			$data['title'] = site_name()." - Amministrazione - Vedi Menu";
			$data['menus'] = $this->menu_model->get_menus();
		
			// Vedi tutti i menu 	
			$this->load->view('templates/admin-header', $data);
			$this->load->view('templates/admin-menu');
			$this->load->view('admin/menu/vedi-tutti', $data);
			$this->load->view('templates/admin-footer');
		}
	}
	
	public function categorie() {
		if (!$this->session->userdata('logged_in')) {
			redirect('', 'refresh');
		}
		
		$this->load->model('categorie_model');
		
		$data['title'] = site_name()." - Amministrazione - Vedi Categorie";
		$data['categorie'] = $this->categorie_model->get_categorie();
		$data['message'] = $this->session->flashdata('message');
		$data['printMessage'] = $this->function_model->printMessage();
		
		$this->load->view('templates/admin-header', $data);
		$this->load->view('templates/admin-menu');
		$this->load->view('admin/categorie/vedi-categorie');
		$this->load->view('templates/admin-footer');
	}
	
	public function statistiche() {
		if (!$this->session->userdata('logged_in')) {
			redirect('', 'refresh');
		}
		
		$data['title'] = site_name()." - Amministrazione - Vedi Statistiche";
		$data['message'] = $this->session->flashdata('message');
		$data['printMessage'] = $this->function_model->printMessage();
		
		$this->load->view('templates/admin-header', $data);
		$this->load->view('templates/admin-menu');
		$this->load->view('admin/statistiche/riepilogo');
		$this->load->view('templates/admin-footer');
	}
}