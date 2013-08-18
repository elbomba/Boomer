<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

session_start();

class Categorie extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model(array('categorie_model', 'function_model'));
		$this->load->helper(array('html', 'url', 'form'));
		$this->load->library(array('session', 'form_validation'));
	}
	
	public function nuova_categoria() {
		if (!$this->session->userdata('logged_in')) {
			redirect('', 'refresh');
		}
		
		$data['title'] = site_name()." - Amministrazione - Nuova Categoria";
		$data['message'] = $this->session->flashdata('message');
		$data['printMessage'] = $this->function_model->printMessage();
		
		//Valido il Form (nome, data, periodico)
		$this->form_validation->set_rules('nome', 'Nome Categoria', 'trim|required');
		$this->form_validation->set_rules('linkable', 'Linkabile', 'trim');
		$this->form_validation->set_rules('periodico', 'Evento Periodico', 'trim');
		$this->form_validation->set_rules('genitori', 'Parentabile', 'trim');
		$this->form_validation->set_rules('multimedia', 'Multimedia', 'trim');
		$this->form_validation->set_rules('imagetitle', 'ImageTitle', 'trim');
		
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
			$this->load->view('admin/categorie/nuova-categoria', $data);
			$this->load->view('templates/admin-footer');
		} else {
			//Form validato
			if ($this->categorie_model->aggiungi_categoria()) {
				//Categoria aggiunta correttamente
				$message = '
					<div id="dialog-message" title="Categoria Aggiunta">
						Categoria aggiunta correttamente.
					</div>
				';
				$this->session->set_flashdata('message', $message);
				
				redirect('admin/categorie', 'refresh');
			} else {
				//Categoria non aggiunta
				$data['message'] = '
					<div id="dialog-message" title="Categoria Non Aggiunta">
						Categoria non aggiunta.
					</div>
				';
			}
		}
	}
	
	public function elimina_categoria($categoria = false) {
		if (!$this->session->userdata('logged_in')) {
			redirect('', 'refresh');
		}
		
		if (!$categoria) {
			redirect('admin/categorie', 'refresh');
		}
		
		if ($categoria <= 3) {
			$message = '
				<div id="dialog-message" title="Categoria non eliminata">
					Impossibile eliminare le categorie di base.
				</div>
			';
			$this->session->set_flashdata('message', $message);
			redirect('admin/categorie', 'refresh');
		}
		
		$data['title'] = site_name()." - Amministrazione - Elimina Categoria";
		
		if ($this->categorie_model->elimina_categoria($categoria)) {
			//Categoria eliminata
			$message = '
				<div id="dialog-message" title="Categoria eliminata">
					Categoria eliminata correttamente.
				</div>
			';
			$this->session->set_flashdata('message', $message);

			redirect('admin/categorie', 'refresh');
		} else {
			//Categoria non eliminata
			redirect('admin/categorie', 'refresh');
		}
	}
	
	public function modifica_categoria($categoria = false) {
		if (!$this->session->userdata('logged_in')) {
			redirect('', 'refresh');
		}
		
		if (!$categoria) {
			redirect('admin/categorie', 'refresh');
		}
		
		$data['title'] = site_name()." - Amministrazione - Modifica Categoria";
		$data['categoria'] = $this->categorie_model->get_categoria($categoria);
		$data['message'] = $this->session->flashdata('message');
		$data['printMessage'] = $this->function_model->printMessage();
		
		//Valido il form
		$this->form_validation->set_rules('nome', 'Nome Categoria', 'trim|required');
		$this->form_validation->set_rules('linkable', 'Linkabile', 'trim');
		$this->form_validation->set_rules('periodico', 'Evento Periodico', 'trim');
		$this->form_validation->set_rules('genitori', 'Parentabile', 'trim');
		$this->form_validation->set_rules('multimedia', 'Multimedia', 'trim');
		$this->form_validation->set_rules('imagetitle', 'ImageTitle', 'trim');
		
		if ($this->form_validation->run() == FALSE) {
			//Form non validato
			if (validation_errors()) {
				$data['message'] = '
					<div id="dialog-message" title="Error">
						'.validation_errors().'
					</div>
				';
			}
			
			$this->load->view('templates/admin-header', $data);
			$this->load->view('templates/admin-menu');
			$this->load->view('admin/categorie/modifica-categoria', $data);
			$this->load->view('templates/admin-footer');
		} else {
			//Form validato
			//Aggiorno i dati
			if ($this->categorie_model->aggiorna_categoria($categoria)) {
				//Aggiornato
				$message = '
					<div di="dialog-message" title="Categoria modificata">
						Categoria modificata correttamente.
					</div>
				';
				$this->session->set_flashdata('message', $message);
				
				redirect('admin/categorie', 'refresh');
			} else {
				//Non Aggiornato
				$data['message'] = '
					<div id="dialog-message" title="Categoria non modificata">
						Categoria non modificata.
					</div>
				';
				
				$this->load->view('templates/admin-header', $data);
				$this->load->view('templates/admin-menu');
				$this->load->view('admin/categorie/modifica-categoria', $data);
				$this->load->view('templates/admin-footer');
			}
		}
	}
}