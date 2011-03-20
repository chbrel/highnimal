<?php

class Accueil extends Controller {

	function Accueil()
	{
		parent::Controller();
		$this->output->enable_profiler(FALSE);	
	}
	
	function index() {
		$data['titleComplement'] = 'Bienvenue';
		
		$this->load->view('header', $data);
		$this->load->view('accueil/index');
		$this->load->view('footer');
	}
	
	function search() {
		$data['titleComplement'] = 'Résultats de la recherche';
		$data2['search_results'] = $this->Animals->search($this->input->post('search_input'));
		
		$this->load->view('header', $data);
		$this->load->view('search/results', $data2);
		$this->load->view('footer');
	}
}
