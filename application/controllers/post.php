<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

session_start();

class Post extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model(array('post_model', 'function_model', 'categorie_model'));
		$this->load->helper(array('html', 'url', 'form'));
		$this->load->library(array('session', 'form_validation'));
	}
	
	public function nuovo_post() {
		$data['title'] = site_name()." - Amministrazione - Nuovo Post";
		$data['message'] = $this->session->flashdata('message');
		$data['printMessage'] = $this->function_model->printMessage();
		$data['posts'] = $this->post_model->get_root_posts($this->input->post('tipo'));
		$data['sel_cat'] = $this->categorie_model->get_categorie();
		$data['cat'] = $this->categorie_model->get_categoria($this->input->post('tipo'));
		
		//Valido il form per la selezione del tipo di pagina
		$this->form_validation->set_rules('tipo', 'Tipo', 'trim|required');
		
		if ($this->form_validation->run() == FALSE) {
			//Form non validato
			//Pagina aperta per la prima volta
			//Mostro selezione tipo pagina
			
			$this->load->view('templates/admin-header', $data);
			$this->load->view('templates/admin-menu');
			$this->load->view('admin/post/selezione-tipo', $data);
			$this->load->view('templates/admin-footer');
		} else {
			//Tipo già scelto
			
			//valido il form vero e proprio
			$this->form_validation->set_rules('author', 'Autore', 'trim');
			$this->form_validation->set_rules('titolo', 'Titolo', 'trim|required|unique[Post.post_titolo]');
			$this->form_validation->set_rules('genitore', 'Genitore', 'trim');	
			$this->form_validation->set_rules('imagetitle', 'Url Immagine', 'trim');
			$this->form_validation->set_rules('ordine', 'Ordine', 'trim');
			$this->form_validation->set_rules('stato', 'Stato', 'trim|required');
			$this->form_validation->set_rules('contenuto', 'Contenuto', 'trim|required');
			$this->form_validation->set_rules('script', 'Script', 'trim');
			if ($this->categorie_model->get_categoria($this->input->post('tipo'))->categoria_periodico) {
				$this->form_validation->set_rules('data_da', 'Dal', 'trim|required');
				$this->form_validation->set_rules('data_a', 'Al', 'trim|required');
			}
			
			if ($this->form_validation->run() == FALSE) {
				//Form non validato
				//Vedo se è prima apertura dopo la scelta del tipo
				if (!$this->input->post('first') == 1) {
					//Non lo è quindi stampo gli errori di validazione
					if (validation_errors()) {
						$data['message'] = '
							<div id="dialog-message" title="Error">
								'.validation_errors().'
							</div>
						';
					}
				}
				
				$this->load->view('templates/admin-header', $data);
				$this->load->view('templates/admin-menu');
				$this->load->view('admin/post/nuovo-post', $data);
				$this->load->view('templates/admin-footer');
			} else {
				//Form validato
				if ($this->post_model->aggiungi_post()) {
					//Pagina aggiunta correttamente
					$message = '
						<div di="dialog-message" title="Post Aggiunto">
							Post aggiunto correttamente.
						</div>
					';
					$this->session->set_flashdata('message', $message);

					redirect('admin/post', 'refresh');
				} else {
					//Pagina non aggiunta
					$data['message'] = '
						<div di="dialog-message" title="Post Non Aggiunta">
							Post non aggiunto.
						</div>
					';

					$this->load->view('templates/admin-header', $data);
					$this->load->view('templates/admin-menu');
					$this->load->view('admin/post/nuovo-post', $data);
					$this->load->view('templates/admin-footer');
				}
			}
		}
	}
	
	public function modifica_post($post = false) {
		if (!$this->session->userdata('logged_in')) {
			redirect('', 'refresh');
		}
		
		if (!$post) {
			redirect('admin/post', 'refresh');
		}
		
		$data['title'] = site_name()." - Amministrazione - Modifica Pagina";
		$data['pos_post'] = $this->post_model->get_possible_parent($post);
		$data['root_posts'] = $this->post_model->get_root_posts();
		$data['post'] = $this->post_model->get_post($post);
		$data['message'] = $this->session->flashdata('message');
		$data['printMessage'] = $this->function_model->printMessage();
		$data['cat'] = $this->categorie_model->get_categoria($this->post_model->get_post($post)->post_tipo);
		
		//Valido il form
		$this->form_validation->set_rules('titolo', 'Titolo', 'trim|required|unique[Post.post_titolo]');
		$this->form_validation->set_rules('genitore', 'Genitore', 'trim');	
		$this->form_validation->set_rules('imagetitle', 'Url Immagine', 'trim');
		$this->form_validation->set_rules('ordine', 'Ordine', 'trim');
		$this->form_validation->set_rules('stato', 'Stato', 'trim|required');
		$this->form_validation->set_rules('contenuto', 'Contenuto', 'trim|required');
		$this->form_validation->set_rules('script', 'Script', 'trim');
		if ($this->categorie_model->get_categoria($this->input->post('tipo'))->categoria_periodico) {
			$this->form_validation->set_rules('data_da', 'Dal', 'trim|required');
			$this->form_validation->set_rules('data_a', 'Al', 'trim|required');
		}

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
			$this->load->view('admin/post/modifica-post', $data);
			$this->load->view('templates/admin-footer');
		} else {
			//Form validato
			if ($this->post_model->modifica_post($post)) {
				//Pagina Aggiornata
				$message = '
					<div id="dialog-message" title="Post aggiornato">
						Post aggiornato con successo.
					</div>
				';
				$this->session->set_flashdata('message', $message);
				
				redirect('admin/post', 'refresh');
			} else {
				//Pagina non aggiornata
				$data['message'] = '
					<div id="dialog-message" title="Errore">
						Post non aggiornato.
					</div>
				';
				
				$this->load->view('templates/admin-header', $data);
				$this->load->view('templates/admin-menu');
				$this->load->view('admin/post/modifica-post', $data);
				$this->load->view('templates/admin-footer');
			}
		}
	}
	
	public function elimina_post($post = false) {
		if (!$this->session->userdata('logged_in')) {
			redirect('', 'refresh');
		}
		
		if (!$post) {
			redirect('admin/post', 'refresh');
		}
		
		$data['title'] = site_name()." - Amministrazione - Elimina Post";
		
		if ($this->post_model->elimina_post($post)) {
			//Pagina cancellata
			$message = '
				<div id="dialog-message" title="Post eliminata">
					Post eliminato correttamente.
				</div>
			';
			$this->session->set_flashdata('message', $message);
			
			redirect('admin/post', 'refresh');
		} else {
			//Pagina non cancellata
			$message = '
				<div id="dialog-message" title="Post non eliminato">
					Post non eliminato. <br>
					Verificare che la pagina non sia linkata a qualche voce di menu.
				</div>
			';
			$this->session->set_flashdata('message', $message);
			
			redirect('admin/post', 'refresh');
		}
	}
}