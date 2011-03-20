<?php

class User extends Controller {

	function User()
	{
		parent::Controller();
		$this->output->enable_profiler(FALSE);	
	}
	
	function index() {
		if(!$this->session->userdata("user")) {
			redirect("accueil/index", "refresh");
		}
		
		$data['titleComplement'] = 'Profil';
		
		$this->load->view('header', $data);
		$this->load->view('user/index', $data);
		$this->load->view('footer');
	}
	
	function login() {
		$data['titleComplement'] = 'Se connecter';
		
		$this->form_validation->set_message('required', 'Le champs "%s" est n&eacute;cessaire. Veuillez le compl&eacute;ter.');

		$this->form_validation->set_rules('email', 'Adresse Mail', 'trim|required|xss_clean|valid_email');
		$this->form_validation->set_rules('password', 'Mot de passe', 'trim|required|xss_clean');
		
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('header', $data);
			$this->load->view('user/login');
			$this->load->view('footer');		
		} else {
			$user = $this->Users->check_user($this->input->post('email'), $this->input->post('password'));
			if($user!=null) {
				$user = $this->Users->get($user->id);
				$newdata = array(
                 	  'user'  => $user,
               		);

				$this->session->set_userdata($newdata);
				
				$this->load->view('header', $data);
				$this->load->view('user/loginok');
				$this->load->view('footer');
			} else {
				$data['connexion_error'] = "L'adresse mail ou le mot de passe est erroné.";
				$this->load->view('header', $data);
				$this->load->view('user/login', $data);
				$this->load->view('footer');
			}
		}
	}
	
	function register() {
		$data['titleComplement'] = 'S\'enregistrer';
		
		$this->form_validation->set_message('required', 'Le champs "%s" est n&eacute;cessaire. Veuillez le compl&eacute;ter.');
		$this->form_validation->set_message('min_length', 'Le champs "%s" doit contenir minimum 6 caract&egrave;res. Veuillez le compl&eacute;ter.');

		$this->form_validation->set_rules('email', 'Adresse Mail', 'trim|required|xss_clean|valid_email');
		$this->form_validation->set_rules('password', 'Mot de passe', 'trim|required|xss_clean|min_length[6]');
		
		if ($this->form_validation->run() == FALSE) {
			$data['connexion_error'] = "L'adresse mail n'est pas valide ou le mot de passe est manquant.";
			$this->load->view('header', $data);
			$this->load->view('user/register');
			$this->load->view('footer');		
		} else {
			$email = $this->input->post('email');
		
			if ($this->Users->email_exists($email)) {
				$data['connexion_error'] = "Cette adresse mail est d&eacute;j&agrave; utilis&eacute;e.";
				$this->load->view('header', $data);
				$this->load->view('user/register');
				$this->load->view('footer');
			} else if($this->input->post('password') != $this->input->post('password2')) {
				$data['connexion_error'] = "Les mots de passe tapp&eacute;s ne correspondent pas.";
				$this->load->view('header', $data);
				$this->load->view('user/register');
				$this->load->view('footer');
			} else {
				$userId = $this->Users->create($this->input->post('status'), $email, $this->input->post('password'));
				$user = $this->Users->get($userId);
				$newdata = array(
					  'user'  => $user,
					);

				$this->session->set_userdata($newdata);
				
				$this->load->view('header', $data);
				$this->load->view('user/registerok');
				$this->load->view('footer');
			}
		}
	}
	
	function logout() {
		if(!$this->session->userdata("user")) {
			redirect("accueil/index", "refresh");
		}
		
		$data['titleComplement'] = 'Se déconnecter';
		
		$this->session->unset_userdata(array('user' => ''));
		session_destroy();
		// $this->session->destroy_session();
		
		$this->load->view('header', $data);
		$this->load->view('user/logoutok');
		$this->load->view('footer');
	}
}

/* End of file user.php */
/* Location: ./system/application/controllers/user.php */