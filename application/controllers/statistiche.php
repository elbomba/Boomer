<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

session_start();

class Statistiche extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('function_model');
		$this->load->helper(array('html', 'url', 'form'));
		$this->load->library(array('session', 'form_validation'));
	}
        
        public function dati_demografici() {
                if (!$this->session->userdata('logged_in')) {
			redirect('', 'refresh');
		}
                
		//Dati pagina
		$data['title'] = site_name()." - Amministrazione - Statistiche - Dati Demografici";
		$data['message'] = $this->session->flashdata('message');
		$data['printMessage'] = $this->function_model->printMessage();
                
                $this->load->view('templates/admin-header', $data);
                $this->load->view('templates/admin-menu');
                $this->load->view('admin/statistiche/dati-demografici', $data);
                $this->load->view('templates/admin-footer');
        }
        
        public function device() {
                if (!$this->session->userdata('logged_in')) {
			redirect('', 'refresh');
		}
		
		//Dati pagina
		$data['title'] = site_name()." - Amministrazione - Statistiche - Dati Demografici";
		$data['message'] = $this->session->flashdata('message');
		$data['printMessage'] = $this->function_model->printMessage();
                
                $this->load->view('templates/admin-header', $data);
                $this->load->view('templates/admin-menu');
                $this->load->view('admin/statistiche/device', $data);
                $this->load->view('templates/admin-footer');
        }
        
        public function load($pagina = null) {
            if (!$this->session->userdata('logged_in') || $pagina == null) {
		redirect('', 'refresh');
	    }
            
            $data['ga_email'] = 'davide.bombardier@gmail.com';
            $data['ga_password'] = 'typhoon90';
            $data['ga_profile_id'] = '74832270';
            
            switch($pagina) {
                case "riepilogo":
                    $this->load->view('admin/statistiche/stat-riepilogo', $data);
                    break;
                case "demografica":
                    $this->load->view('admin/statistiche/stat-demografici', $data);
                    break;
                case "device":
                    $this->load->view('admin/statistiche/stat-device', $data);
                    break;
            }
        }
}