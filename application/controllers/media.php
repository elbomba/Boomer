<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

session_start();

class Media extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model(array('media_model', 'function_model'));
		$this->load->helper(array('html', 'url', 'form'));
		$this->load->library(array('session', 'form_validation'));
	}
	
	public function nuovo_media() {
		if (!$this->session->userdata('logged_in')) {
			redirect('', 'refresh');
		}
		
		if (isset($_GET['tipo'])) {
			$tipo = $_GET['tipo'];
			$data['tipo'] = $_GET['tipo'];
		} else {
			$tipo = "";
			$data['tipo'] = "";
		}
		
		$data['title'] = site_name()." - Amministrazione - Nuovo Media";
		$data['message'] = $this->session->flashdata('message');
		$data['printMessage'] = $this->function_model->printMessage();
		
		switch ($tipo) {
			case "":
				$this->load->view('templates/admin-header', $data);
				$this->load->view('templates/admin-menu');
				$this->load->view('admin/media/nuovo-media', $data);
				$this->load->view('templates/admin-footer');
				break;
			case "img":
				$this->load->view('templates/admin-header', $data);
				$this->load->view('templates/admin-menu');
				$this->load->view('admin/media/nuovo-media', $data);
				$this->load->view('admin/media/load-img');
				$this->load->view('templates/admin-footer');
				break;
			case "audio":
				$this->load->view('templates/admin-header', $data);
				$this->load->view('templates/admin-menu');
				$this->load->view('admin/media/nuovo-media', $data);
				$this->load->view('admin/media/load-audio');
				$this->load->view('templates/admin-footer');
				break;
			case "vid":
				$this->load->view('templates/admin-header', $data);
				$this->load->view('templates/admin-menu');
				$this->load->view('admin/media/nuovo-media', $data);
				$this->load->view('admin/media/load-vid');
				$this->load->view('templates/admin-footer');
				break;
			case "pdf":
				$this->load->view('templates/admin-header', $data);
				$this->load->view('templates/admin-menu');
				$this->load->view('admin/media/nuovo-media', $data);
				$this->load->view('admin/media/load-pdf');
				$this->load->view('templates/admin-footer');
				break;
		}
	}
	
	public function modifica_media($media = false) {
		if (!$this->session->userdata('logged_in')) {
			redirect('', 'refresh');
		}
		
		if (!$media) {
			redirect('admin/media', 'refresh');
		}
		
		$data['title'] = site_name()." - Amministrazione - Modifica Media";
		$data['message'] = $this->session->flashdata('message');
		$data['printMessage'] = $this->function_model->printMessage();
		$data['media'] = $this->media_model->get_media($media);
		
		$this->form_validation->set_rules('nome', 'Nome', 'trim|required');

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
			$this->load->view('admin/media/modifica-media', $data);
			$this->load->view('templates/admin-footer');
		} else {
			//Form validato
			if ($this->media_model->modifica_media($media)) {
				//Pagina Aggiornata
				$message = '
					<div id="dialog-message" title="Media aggiornato">
						Media aggiornato con successo.
					</div>
				';
				$this->session->set_flashdata('message', $message);
				
				redirect('admin/media', 'refresh');
			} else {
				//Pagina non aggiornata
				$data['message'] = '
					<div id="dialog-message" title="Errore">
						Media non aggiornato.
					</div>
				';
				
				$this->load->view('templates/admin-header', $data);
				$this->load->view('templates/admin-menu');
				$this->load->view('admin/media/modifica-media', $data);
				$this->load->view('templates/admin-footer');
			}
		}
	}
	
	public function elimina_media($media = false) {
		if (!$this->session->userdata('logged_in')) {
			redirect('', 'refresh');
		}
		
		if (!$media) {
			redirect('admin/media', 'refresh');
		}
		
		$data['title'] = site_name()." - Amministrazione - Elimina Media";
		
		if ($this->media_model->elimina_media($media)) {
			//Media cancellato
			$message = '
				<div id="dialog-message" title="Media eliminato">
					Media eliminato correttamente.
				</div>
			';
			$this->session->set_flashdata('message', $message);
			
			redirect('admin/media', 'refresh');
		} else {
			//Media non cancellato
			$message = '
				<div id="dialog-message" title="Media non eliminato">
					Media non eliminato.
				</div>
			';
			$this->session->set_flashdata('message', $message);
			
			redirect('admin/media', 'refresh');
		}
	}
}