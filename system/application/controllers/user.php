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
		$this->load->view('user/index');
		$this->load->view('footer');
	}
	
	function login() {
		$data['titleComplement'] = 'Se connecter';
		
		$this->form_validation->set_message('required', 'Le champs "%s" est n&eacute;cessaire. Veuillez le compl&eacute;ter.');

		$this->form_validation->set_rules('login', 'Login', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Mot de passe', 'trim|required|xss_clean');
		
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('header', $data);
			$this->load->view('user/login');
			$this->load->view('footer');		
		} else {
			$user = $this->Users->check_user($this->input->post('login'), $this->input->post('password'));
			if($user!=null) {
				$newdata = array(
                 	  'user'  => $user,
               		);

				$this->session->set_userdata($newdata);
				
				$this->load->view('header', $data);
				$this->load->view('user/loginok');
				$this->load->view('footer');
			} else {
				$data['connexion_error'] = "Le login ou le mot de passe est erroné.";
				$this->load->view('header', $data);
				$this->load->view('user/login', $data);
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
		
		$this->load->view('header', $data);
		$this->load->view('user/logoutok');
		$this->load->view('footer');
	}
}

/* End of file user.php */
/* Location: ./system/application/controllers/user.php */