<?php

class Accueil extends Controller {

	function Accueil()
	{
		parent::Controller();
		$this->output->enable_profiler(FALSE);	
	}
	
	function index() {
		$data['titleComplement'] = 'Bienvenue';
		$data['totalAnimals'] = $this->Animals->getTotalNumber();
		
		$this->load->view('header', $data);
		$this->load->view('accueil/index');
		$this->load->view('footer');
	}
}
