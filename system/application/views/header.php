<!DOCTYPE html>
<html lang="fr">
<head>
<title>Highnimal.com<?php if(isset($titleComplement)) { echo ' -- '.$titleComplement; } ?></title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<script src="<?=base_url()?>public/javascript/prototype.js" type="text/javascript"></script>
<script src="<?=base_url()?>public/javascript/effects.js" type="text/javascript"></script>
<script src="<?=base_url()?>public/javascript/dragdrop.js" type="text/javascript"></script>
<script src="<?=base_url()?>public/javascript/controls.js" type="text/javascript"></script>
<link rel="stylesheet" media="screen" type="text/css" title="Main Design" href="<?=base_url()?>public/css/main.css" />
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>
<body>
	<div id="mainheader" class="branding" role="banner">
	</div>
	
	<div id="navigation" role="navigation">
		<div id="actions">
			<div id="offre">Poster une offre</div>
			<div id="demande">Poster une demande</div>
		</div>
		<div id="connexion">
			<?php if(!$this->session->userdata("user")) { ?>
				<div id="register"><?=anchor('user/register', 'Cr&eacute;er un compte', array('title' => 'Créer un compte')); ?></div>
				<div id="login"><?=anchor('user/login', 'Se connecter', array('title' => 'Se connecter')); ?></div>
			<?php } else { ?>
				<div id="logout"><?=anchor('user/logout', 'Se d&eacute;connecter ('.$this->session->userdata("user")->email.')', array('title' => 'Se déconnecter')); ?></div>
			<?php } ?>
		</div>
	</div>
	
	<div id="search">
		<?php
			echo form_open('search/run');
			$data_search = array(
              'name'        => 'search',
              'id'          => 'search',
              'value'       => 'Mots Clefs',
              'size' => '75',
              'maxlength' => '50',
            );
			echo form_label('<img src="'.base_url().'/images/loupe.png" alt="Search" />', 'search');
			echo form_input($data_search);
			echo form_submit('Rechercher', 'Rechercher');
			echo form_close();
		
		?>
		<?php site_url("search/run"); ?>
		<?=anchor('search/index', 'Recherche Avancée', array('title' => 'Recherche Avancée')); ?>
	</div>
	
	<div id="infos">
		Actuellement, il y a 1234 offres et 789 demandes sur Highnimal!
	</div>
	
	<div id="content" role="main">