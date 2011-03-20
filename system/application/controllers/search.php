<?php

class Search extends Controller {

	function Search()
	{
		parent::Controller();
		$this->output->enable_profiler(FALSE);	
	}
	
	function run() {
		$data['titleComplement'] = 'Search results';
		
		$this->load->view('header', $data);
		$this->load->view('search/results', $this->S);
		$this->load->view('footer');
	}
}
