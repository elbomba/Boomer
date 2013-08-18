<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

session_start();

class Menu extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model(array('menu_model', 'function_model', 'post_model'));
		$this->load->helper(array('html', 'url', 'form'));
		$this->load->library(array('session', 'form_validation'));
	}
	
	public function nuovo_menu() {
		if (!$this->session->userdata('logged_in')) {
			redirect('', 'refresh');
		}
		
		//Dati pagina
		$data['title'] = site_name()." - Amministrazione - Nuovo Menu";
		$data['message'] = $this->session->flashdata('message');
		$data['printMessage'] = $this->function_model->printMessage();
		
		// Validazione del form
		$this->form_validation->set_rules('nome', 'Nome Menu', 'trim|required');
		$this->form_validation->set_rules('desc', 'Descrizione Menu', 'trim');
		
		if ($this->form_validation->run() == FALSE) {
			// Vedo se il form è stato passato o meno
			if (validation_errors()) {
				$data['message'] = '
					<div id="dialog-message" title="Errore">
						'.validation_errors().'
					</div>
				';
			}
			
			//Carico la pagina
			$this->load->view('templates/admin-header', $data);
			$this->load->view('templates/admin-menu');
			$this->load->view('admin/menu/nuovo-menu');
			$this->load->view('templates/admin-footer');
		} else {
			//Form valido
			//Aggiungo il menu nel database
			if ($this->menu_model->add_menu()) {
				//Menu creato
				$message = '
					<div id="dialog-message" title="Menu Creato">
						Menu creato correttamente.
					</div>
				';
				$this->session->set_flashdata('message', $message);
				
				redirect('admin/menu?menu='.$this->input->post('nome'), 'refresh');
			} else {
				$data['message'] = '
					<div id="dialog-message" title="Errore Nel Database">
						Errore salvataggio menu.
					</div>
				';
			}
		}
	}
	
	public function modifica_menu($menu = false) {
		if (!$this->session->userdata('logged_in')) {
			redirect('', 'refresh');
		}
		
		if (!$menu) {
			redirect('admin/menu', 'refresh');
		}
		
		//Dati della pagina
		$data['title'] = site_name()." - Amministrazione - Modifica Menu";
		$data['message'] = $this->session->flashdata('message');
		$data['printMessage'] = $this->function_model->printMessage();
		$data['menu'] = $this->menu_model->get_menu($menu);
		
		//Validazione del form
		$this->form_validation->set_rules('nome', 'Nome menu', 'trim|required');
		$this->form_validation->set_rules('desc', 'Descrizione menu', 'trim');
		
		//Valido il form
		if ($this->form_validation->run() == FALSE) {
			//Form validato
			if (validation_errors()) {
				$data['message'] = '
					<div id="dialog-message" title="Errore">
						'.validation_errors().'
					</div>
				';
			}
		
			//Carico le pagine
			$this->load->view('templates/admin-header', $data);
			$this->load->view('templates/admin-menu');
			$this->load->view('admin/menu/modifica-menu', $data);
			$this->load->view('templates/admin-footer');
		} else {
			//Form non validato
			//Modifico i dati nel database
			if ($this->menu_model->aggiorna_menu($menu)) {
				//Dati aggiornati
				$message = '
					<div id="dialog-message" title="Menu aggiornato">
						Menu aggiornato con successo.
					</div>
				';
				$this->session->set_flashdata('message', $message);
				
				redirect('admin/menu?menu='.$this->menu_model->get_menu($menu)->menu_nome, 'refresh');
			} else {
				//Errore aggiornamento
				$data['message'] = '
					<div id="dialog-message" title="Menu non aggiornato">
						Errore nell\'aggiornamento del database.
					</div>
				';
				
				//Carico le pagine
				$this->load->view('templates/admin-header', $data);
				$this->load->view('templates/admin-menu');
				$this->load->view('admin/menu/modifica-menu', $data);
				$this->load->view('templates/admin-footer');
			}
		}
	}
	
	public function elimina_menu($menu = false) {
		if (!$this->session->userdata('logged_in')) {
			redirect('', 'refresh');
		}
		
		if (!$menu) {
			redirect('admin/menu', 'refresh');
		}
		
		$data['title'] = site_name()." - Amministrazione - Elimina Menu";
		
		if ($this->menu_model->elimina_menu($menu)) {
			//Menu eliminato
			$message = '
				<div id="dialog-message" title="Menu eliminato">
					Menu eliminato correttamente.
				</div>
			';
			$this->session->set_flashdata('message', $message);

			redirect('admin/menu', 'refresh');
		} else {
			//Menu non eliminato
			redirect('admin/menu?menu='.$this->menu_model->get_menu($menu)->menu_nome, 'refresh');
		}
	}
	
	public function nuova_voce($menu = false) {
		if (!$this->session->userdata('logged_in')) {
			redirect('', 'refresh');
		}
		
		if (!$menu) {
			redirect('admin/menu', 'refresh');
		}
		
		//Dati pagina
		$data['title'] = site_name()." - Amministrazione - Nuova Voce";
		$data['message'] = $this->session->flashdata('message');
		$data['printMessage'] = $this->function_model->printMessage();
		$data['nome'] = $menu;
		$data['root_menu'] = $this->menu_model->get_root_menu_items();
		$data['pagine'] = $this->post_model->get_root_linkable_post();
		
		// Validazione del form
		$this->form_validation->set_rules('main', 'Menu genitore', 'trim|required');		
		$this->form_validation->set_rules('nome', 'Nome voce', 'trim|required');
		$this->form_validation->set_rules('ordine', 'Ordine', 'trim');
		$this->form_validation->set_rules('pagine', 'Pagina collegata', 'trim');
		$this->form_validation->set_rules('genitore', 'Voce Genitore', 'trim');
		
		if ($this->form_validation->run() == FALSE) {
			// Vedo se il form è stato passato o meno
			if (validation_errors()) {
				$data['message'] = '
					<div id="dialog-message" title="Errore">
						'.validation_errors().'
					</div>
				';
			}
			
			//Carico la pagina
			$this->load->view('templates/admin-header', $data);
			$this->load->view('templates/admin-menu');
			$this->load->view('admin/menu/nuova-voce', $data);
			$this->load->view('templates/admin-footer');
		} else {
			//Form valido
			//Aggiungo il menu nel database
			if ($this->menu_model->add_menu_item($this->input->post('main'))) {
				//Menu creato
				$message = '
					<div id="dialog-message" title="Voce creata">
						Voce di menu creata correttamente.
					</div>
				';
				$this->session->set_flashdata('message', $message);
				
				redirect('admin/menu?menu='.$menu, 'refresh');
			} else {
				$data['message'] = '
					<div id="dialog-message" title="Errore Nel Database">
						Errore salvataggio della voce di menu.
					</div>
				';
				
				//Stampo le pagine
				$this->load->view('templates/admin-header', $data);
				$this->load->view('templates/admin-menu');
				$this->load->view('admin/menu/nuova-voce', $data);
				$this->load->view('templates/admin-footer');
			}
		}
	}
	
	public function modifica_voce($voce = false) {
		if (!$this->session->userdata('logged_in')) {
			redirect('', 'refresh');
		}
		
		if (!$voce) {
			redirect('admin/menu', 'refresh');
		}
		
		$menu_id = $this->menu_model->get_menu_item($voce)->menu_item_main;
		$nome_menu = $this->menu_model->get_menu($menu_id)->menu_nome;
		
		//Dati della pagina
		$data['title'] = site_name()." - Amministrazione - Modifica Menu";
		$data['message'] = $this->session->flashdata('message');
		$data['printMessage'] = $this->function_model->printMessage();
		$data['voce'] = $this->menu_model->get_menu_item($voce);
		$data['root_menu'] = $this->menu_model->get_root_menu_items($menu_id);
		$data['pagine'] = $this->post_model->get_root_linkable_post();
		$data['pos_menu'] = $this->menu_model->get_possible_parent($voce);
		$data['nome_menu'] = $nome_menu;
		
		//Valido il form
		$this->form_validation->set_rules('nome', 'Nome voce', 'trim|required');
		$this->form_validation->set_rules('ordine', 'Ordine', 'trim');
		$this->form_validation->set_rules('pagine', 'Pagina collegata', 'trim');
		$this->form_validation->set_rules('genitore', 'Voce Genitore', 'trim');
		
		if ($this->form_validation->run() == FALSE) {
			//Form non validato
			if (validation_errors()) {
				$data['message'] = '
					<div id="dialog-message" title="Errore">
						'.validation_errors().'
					</div>
				';
			}
			
			//Carico la pagina
			$this->load->view('templates/admin-header', $data);
			$this->load->view('templates/admin-menu');
			$this->load->view('admin/menu/modifica-voce', $data);
			$this->load->view('templates/admin-footer');
		} else {
			//Form validato
			//Aggiorno i dati
			if ($this->menu_model->aggiorna_menu_item($voce)) {
				//Voce aggiornata
				$message = '
					<div id="dialog-message" title="Voce aggiornata">
						Voce di menu aggiornata correttamente.
					</div>
				';
				$this->session->set_flashdata('message', $message);
				
				redirect('admin/menu?menu='.$nome_menu, 'refresh');
			} else {
				//Errore aggiornamento database
				$data['message'] = '
					<div id="dialog-message" title="Voce non aggiornata">
						Errore nell\'aggiornamento del database.
					</div>
				';
				
				//Carico la pagina
				$this->load->view('templates/admin-header', $data);
				$this->load->view('templates/admin-menu');
				$this->load->view('admin/menu/modifica-voce', $data);
				$this->load->view('templates/admin-footer');
			}
		}
	}
	
	public function elimina_voce($voce = false) {
		if (!$this->session->userdata('logged_in')) {
			redirect('', 'refresh');
		}
		
		if (!$voce) {
			redirect('admin/menu', 'refresh');
		}
		
		$data['title'] = site_name()." - Amministrazione - Elimina Voce";
		$menu_id = $this->menu_model->get_menu_item($voce)->menu_item_main;
		$nome_menu = $this->menu_model->get_menu($menu_id)->menu_nome;
		
		if ($this->menu_model->elimina_menu_item($voce)) {
			//Menu eliminato
			$message = '
				<div id="dialog-message" title="Voce eliminata">
					Voce di menu eliminata correttamente.
				</div>
			';
			$this->session->set_flashdata('message', $message);

			redirect('admin/menu?menu='.$nome_menu, 'refresh');
		} else {
			//Menu non eliminato
			redirect('admin/menu?menu='.$nome_menu, 'refresh');
		}
	}
}