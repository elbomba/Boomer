<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

session_start();

class Home extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model(array('function_model', 'categorie_model', 'post_model'));
		$this->load->helper(array('html', 'url', 'form'));
		$this->load->library(array('session', 'form_validation'));
	}

	public function index($page = null) {
            
            $path = $_SERVER['PHP_SELF'];
            $path_array = explode('/', $path);
            
            //Rimuovo i primi tre elementi che non fanno parte del path finale
            unset($path_array[0]); unset($path_array[1]); unset($path_array[2]);
            $path_array = array_values($path_array);
            $data['percorso'] = $path_array;
            
            // Verifico che non sia la homepage
            if (count($path_array) > 0) {
                // Verifico che la pagina esista a quell'url
                if (!$this->post_model->is_correct_url($path_array)) {
                    show_404();
                }
            }
            
            // Recupero la categoria della pagina
            if (!$page) {
                // Nessuna pagina quindi è l'homapega
                $cat = 'Homepage';
                $data['post'] = $this->post_model->get_homepage();
            } else {
                // Vedo se esiste la pagina
                if ($post = $this->post_model->get_post($page)) {
                    $cat = $this->categorie_model->get_categoria($post->post_tipo)->categoria_nome;
                    $data['post'] = $post;
                } else {
                    // La pagina non esiste
                    // Errore 404
                    show_404();
                }
            }
            
            include_once 'adds-on/detector/Mobile_Detect.php';
            
            $detect = new Mobile_Detect;
            $isMobile = $detect->isMobile();
            
            $data['message'] = $this->session->flashdata('message');
            $data['printMessage'] = $this->function_model->printMessage();            
            
            //Verifico il passaggio della mail per i contatti
            if ($this->input->post('c-email')) {
                //Valido il Form (nome, data, periodico)
                $this->form_validation->set_rules('c-email', 'Email', 'trim|required|valid_email');
                $this->form_validation->set_rules('c-oggetto', 'Oggetto', 'trim|required');
                $this->form_validation->set_rules('c-content', 'Testo', 'trim|required');
            
                if ($this->form_validation->run() == FALSE) {
                    //Form non validato correttamente
                    if (validation_errors()) {
                        $data['message'] = '
                            <div di="dialog-message" title="Errore">
                                '.validation_errors().'
                            </div>
                        ';
                    }
                } else {
                    $to = admin_mail();
                    $subject = $this->input->post('c-oggetto');
                    $message = $this->input->post('c-content');
                    $from = 'From: '.$this->input->post('c-email');
                    if(mail($to, $subject, $message, $from)) {
                        $data['message'] = '
                            <div di="dialog-message" title="Iscrizione Avvenuta">
                                Iscrizione avvenuta con successo.
                            </div>
                        ';
                    } else {
                        $data['message'] = '
                            <div di="dialog-message" title="Errore">
                                Impossibile iscrivere alla Newsletter.<br>
                                Riprova più tardi.
                            </div>
                        ';
                    }
                }
            }
            
            //Verifico il passaggio della newsletter
            if ($this->input->post('n-email')) {
                //Valido il Form (nome, data, periodico)
                $this->form_validation->set_rules('n-email', 'Email', 'trim|required|valid_email');
            
                if ($this->form_validation->run() == FALSE) {
                    //Form non validato correttamente
                    if (validation_errors()) {
                        $data['message'] = '
                            <div di="dialog-message" title="Errore">
                                '.validation_errors().'
                            </div>
                        ';
                    }
                } else {
                    $to = admin_mail();
                    $subject = 'Iscrizione alla Newsletter';
                    $message = 'Vorrei essere iscritto alla Newsletter';
                    $from = 'From: '.$this->input->post('n-email');
                    if(mail($to, $subject, $message, $from)) {
                        $data['message'] = '
                            <div di="dialog-message" title="Iscrizione Avvenuta">
                                Iscrizione avvenuta con successo.
                            </div>
                        ';
                    } else {
                        $data['message'] = '
                            <div di="dialog-message" title="Errore">
                                Impossibile iscrivere alla Newsletter.<br>
                                Riprova più tardi.
                            </div>
                        ';
                    }
                }
            }
            
            if ($isMobile && !$this->session->userdata('desktop_to_mobile')) {
                if ($cat == 'Homepage') {
                    $data['title'] = site_name();
                        
                    $this->load->view('../../user-themes/'.theme_name().'/templates/mobile-header', $data);
                    $this->load->view('../../user-themes/'.theme_name().'/mobile/content-homepage', $data);
                    $this->load->view('../../user-themes/'.theme_name().'/templates/mobile-footer');
                } else {
                    $data['title'] = site_name().' - '.$post->post_titolo;
                        
                    $this->load->view('../../user-themes/'.theme_name().'/templates/mobile-header', $data);
                    $this->load->view('../../user-themes/'.theme_name().'/mobile/content-'.strtolower($cat), $data);
                    $this->load->view('../../user-themes/'.theme_name().'/templates/mobile-footer');
                }
            } else if ($this->session->userdata('desktop_to_mobile')) {
                if ($cat == 'Homepage') {
                    $data['title'] = site_name();
                        
                    $this->load->view('../../user-themes/'.theme_name().'/templates/header', $data);
                    $this->load->view('../../user-themes/'.theme_name().'/desktop/content-homepage', $data);
                    $this->load->view('../../user-themes/'.theme_name().'/templates/mobile-footer');
                } else {
                    $data['title'] = site_name().' - '.$post->post_titolo;
                        
                    $this->load->view('../../user-themes/'.theme_name().'/templates/header', $data);
                    $this->load->view('../../user-themes/'.theme_name().'/desktop/content-'.strtolower($cat), $data);
                    $this->load->view('../../user-themes/'.theme_name().'/templates/mobile-footer');
                }
            } else {
                if ($cat == 'Homepage') {
                    $data['title'] = site_name();
                        
                    $this->load->view('../../user-themes/'.theme_name().'/templates/header', $data);
                    $this->load->view('../../user-themes/'.theme_name().'/desktop/content-homepage', $data);
                    $this->load->view('../../user-themes/'.theme_name().'/templates/footer');
                } else {
                    $data['title'] = site_name().' - '.$post->post_titolo;
                        
                    $this->load->view('../../user-themes/'.theme_name().'/templates/header', $data);
                    $this->load->view('../../user-themes/'.theme_name().'/desktop/content-'.strtolower($cat), $data);
                    $this->load->view('../../user-themes/'.theme_name().'/templates/footer');
                }
            }
            
        }
        
        public function to_desktop() {
            $this->session->set_userdata(array('desktop_to_mobile' => true));
            redirect('', 'refresh');
        }
        
        public function to_mobile() {
            $this->session->set_userdata(array('desktop_to_mobile' => false));
            redirect('', 'refresh');
        }
}