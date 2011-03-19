<?php

class Movie extends Controller {

	function Movie()
	{
		parent::Controller();
		$this->output->enable_profiler(FALSE);	
	}
	
	function test() {
		$data['titleComplement'] = 'Test';
		
		$this->load->view('header', $data);
		$this->load->view('movie/test', $data);
		$this->load->view('footer');
		
	}
	
	function managewaitingmovies($wmid = 0) {
		if(!$this->session->userdata("user")) {
			redirect("accueil/index", "refresh");
		}
		
		$data['titleComplement'] = 'Gestion des films en attente de validation';
		
		$wm = $this->Waitingmovies->getAllFromUser($this->session->userdata("user")->id);
		
		$data['waitingmovies'] = $wm;
		
		if(count($wm) > 0) {
		
			if($wmid == 0) {
				$wmid = $data['waitingmovies'][0]->id;
			}
			
			foreach($data['waitingmovies'] as $m) {
				if($m->id == $wmid) {
					$data['chosenwm'] = $m;
					break;
				}
				
			}
			
			$allocinemovies = array();
			foreach($data['chosenwm']->allocinecodes as $ac) {
				array_push($allocinemovies, $this->getAllocineMovie($ac));
			}
			
			$data['allocinemovies'] = $allocinemovies;
			
		}
		
		$this->load->view('header', $data);
		$this->load->view('movie/managewaitingmovies', $data);
		$this->load->view('footer');
	}
	
	function getAllocineMovie($allocinecode) {
		$allocine_api_url = "http://api.allocine.fr/xml/movie?code=".$allocinecode."&partner=3&profile=small";
		$filmXml = simplexml_load_file($allocine_api_url);
		
		return $filmXml;
	}
	
	function validatewm() {
		$allocine_api_url = "http://api.allocine.fr/xml/movie?code=".$this->input->post('accode')."&partner=3&profile=medium";
		$movieXml = simplexml_load_file($allocine_api_url);
		$waitingMovie = $this->Waitingmovies->get($this->input->post('wmid'));
		
		$actors = array();
		$genders = array();
		$productors = array();
		$compositor = null;
		
		foreach($movieXml->casting->castMember as $castMember) {
			$castMemberAC = (int) $castMember->person["code"];
			$acficheprofil = "http://www.allocine.fr/personne/fichepersonne_gen_cpersonne=".$castMemberAC.".html";
			if(isset($castMember->picture)) {
				$castMemberPicture = (string) $castMember->picture["href"];
			} else {
				$castMemberPicture = "./public/images/nopicture.png";//default value
			}
			
			switch((string) $castMember->activity["code"]) {
				case "8002": /*director*/
					$directorTmp = $this->Directors->getWithAllocinecode($castMemberAC);
					if($directorTmp == null) {
						$director = $this->Directors->create($castMemberAC, (string) $castMember->person, $acficheprofil, $castMemberPicture);
					} else {
						$director = $directorTmp->id;
					}
					break;
				case "8001": /*actor*/
					$actorTmp = $this->Actors->getWithAllocinecode($castMemberAC);
					if($actorTmp == null) {
						array_push($actors, $this->Actors->create($castMemberAC, (string) $castMember->person, $acficheprofil, $castMemberPicture));
					} else {
						array_push($actors, $actorTmp->id);
					}
					break;
				case "8029": /*productor*/
					$productorTmp = $this->Productors->getWithAllocinecode($castMemberAC);
					if($productorTmp == null) {
						array_push($productors, $this->Productors->create($castMemberAC, (string) $castMember->person, $acficheprofil, $castMemberPicture));
					} else {
						array_push($productors, $productorTmp->id);
					}
					break;
				case "8003": /*compositor*/
					$compositorTmp = $this->Compositors->getWithAllocinecode($castMemberAC);
					if($compositorTmp == null) {
						$compositor = $this->Compositors->create($castMemberAC, (string) $castMember->person, $acficheprofil, $castMemberPicture);
					} else {
						$compositor = $compositorTmp->id;
					}
					break;
			}
		}
		
		foreach($movieXml->genreList->genre as $g) {
			$genderTmp = $this->Genders->getWithAllocinecode((int) $g["code"]);
			if($genderTmp == null) {
				array_push($genders, $this->Genders->create((int) $g["code"], (string) $g));
			} else {
				array_push($genders, $genderTmp->id);
			}
		}
		
		$acPosterHref = (string) $movieXml->poster["href"];
		if($acPosterHref == "") {
			$acPosterHref = './public/images/defaultposter.png';
			$localFile = './public/images/defaultposter.png';
		} else {
			$acPosterHrefArray = explode("/", $acPosterHref);
			$acPosterFileName = $acPosterHrefArray[count($acPosterHrefArray) - 1];
			$localFile = "./public/posters/".$acPosterFileName;
			copy($acPosterHref, $localFile);
		} 
		$poster = $this->Posters->create($acPosterHref, $localFile);
		
		$acTrailerCode = (int) $movieXml->trailer["code"];
		$acTrailerHref = (string) $movieXml->trailer["href"];
		$trailer = $this->Trailers->create($acTrailerCode, $acTrailerHref);
		
		
		$this->Movies->create($this->input->post('accode'), (string) $movieXml->title, (string) $movieXml->originalTitle, (int) $movieXml->productionYear, (int) $movieXml->runtime, (string) $movieXml->synopsis, $director, $productors, $compositor, $poster, $trailer, $waitingMovie->homeinfo->id, $actors, $genders, date("d/m/Y H:i:s"));
		
		$this->Waitingmovies->delete($waitingMovie->id);
		
		redirect("movie/managewaitingmovies", "refresh");
	}
	
	function auto_add() {
		$user = $this->Users->check_user($this->input->post('login'), $this->input->post('mdp'), true);
		if($user!=null) {
			$allocine_api_url = "http://api.allocine.fr/xml/search?q=".$this->input->post('film')."&partner=3&profile=small";
			$filmsXml = simplexml_load_file($allocine_api_url);
			$m = $filmsXml->movie;
			if(count($m) > 0) {
				$internurl = $this->input->post('internurl');
				if(! $this->Homeinfos->alreadyExist($internurl)) {
					$homeinfoid = $this->Homeinfos->create($user->id, $internurl);
					$allocinecodes = array();
					foreach($m as $movie) {
						if(! $this->Movies->alreadyExist((int) $movie["code"])) {
							if(! in_array((int) $movie["code"], $allocinecodes)) {
								array_push($allocinecodes, (int) $movie["code"]);
							}
						}
					}
					if(count($allocinecodes) > 0) {
						$this->Waitingmovies->create($this->input->post('film'), $homeinfoid, $allocinecodes);
						echo "L'ajout du film '".str_replace("+", " ", $this->input->post('film'))."' a bien &eacute;t&eacute; pris en compte.Vous pouvez valider cet ajout en vous rendant sur le site Gallion Film Manager ou en cliquant sur le lien suivant: ???";
					} else {
						$this->Homeinfos->delete($homeinfoid);
						echo "Ce film a déjà été ajouté avec un autre emplacement.";
					}
				} else {
					echo "Le film à l'emplacement suivant: ".$internurl.", existe déjà dans la base de données.";
				}
			} else {
				echo "Aucun film correspondant à la recherche n'a été trouvé...";
			}
		} else {
			echo "Erreur de connexion";
		}
	}
	
	function listall($lettre = 'a') {
		if(!$this->session->userdata("user")) {
			redirect("accueil/index", "refresh");
		}
		
		$data['titleComplement'] = 'Liste des films';
		
		$m = $this->Movies->getAll();
		
		$data['movies'] = array();
		
		foreach($m as $movie) {
			if($lettre == 'all' || substr(strtolower((string)$movie->title), 0, 1) == $lettre || substr(strtolower((string)$movie->original_title), 0, 1) == $lettre) {
				$movie->poster = $this->Posters->get($movie->poster);
				
				array_push($data['movies'], $movie);
			}
		}

		$data['lettre'] = $lettre;
		
		$this->load->view('header', $data);
		$this->load->view('movie/listall', $data);
		$this->load->view('footer');
	}
	
	function fiche($movieid) {
		if(!$this->session->userdata("user")) {
			redirect("accueil/index", "refresh");
		}
		
		$movie = $this->Movies->get($movieid);
		
		$mtitle = "Film non trouvé";
		
		if($movie != null) {
			$mtitle = $movie->title;
			
			$movie->director = $this->Directors->get($movie->director);
			if($movie->compositor != null) {
				$movie->compositor = $this->Compositors->get($movie->compositor);
			}
			$movie->poster = $this->Posters->get($movie->poster);
			$movie->trailer = $this->Trailers->get($movie->trailer);
			$movie->homeinfo = $this->Homeinfos->get($movie->homeinfo);
			$movie->homeinfo->owner = $this->Users->get($movie->homeinfo->owner);
			
			$actors = array();
			foreach($movie->actors as $a) {
				array_push($actors, $this->Actors->get($a));
			}
			$movie->actors = $actors;
			
			$productors = array();
			foreach($movie->productors as $p) {
				array_push($productors, $this->Productors->get($p));
			}
			$movie->productors = $productors;
			
			$genders = array();
			foreach($movie->genders as $g) {
				array_push($genders, $this->Genders->get($g));
			}
			$movie->genders = $genders;
		}
		
		$data['titleComplement'] = 'Fiche du Film: '.$mtitle;
		
		$data["movie"] = $movie;
		
		$this->load->view('header', $data);
		$this->load->view('movie/fiche', $data);
		$this->load->view('footer');
	}
}

/* End of file user.php */
/* Location: ./system/application/controllers/user.php */