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
	<?=anchor('accueil/index', '<div id="mainheader">', array('title' => 'Highline')); ?>
	</div>
	
	<div id="navigation" role="navigation">
		<div id="actions">
			<?=anchor('animal/offer', '<div id="offre" class="action">&nbsp;</div>', array('title' => 'Poster une offre')); ?>
			<?=anchor('animal/demand', '<div id="demande" class="action">&nbsp;</div>', array('title' => 'Poster une demande')); ?>
		</div>
		<div id="connexion">
			<?php if(!$this->session->userdata("user")) { ?>
				<?=anchor('user/register', '<div id="register">&nbsp;</div>', array('title' => 'Créer un compte')); ?>
				<?=anchor('user/login', '<div id="login">&nbsp;</div>', array('title' => 'Se connecter')); ?>
			<?php } else { ?>
				<div id="monprofil"><?=anchor('user/index', 'Consulter mon profil', array('title' => 'Consulter mon profil')); ?></div>
				<div id="logout"><?=anchor('user/logout', 'Se d&eacute;connecter ('.$this->session->userdata("user")->email.')', array('title' => 'Se déconnecter')); ?></div>
			<?php } ?>
		</div>
	</div>
	<div class="clear"> </div>
	<div id="search">
		<div id="direct_search">
		<div id="loupe"> </div>
		<?php
			echo form_open('animal/search');
			$params = array(
              'name'        => 'search_input',
              'id'          => 'search_input',
              'value'       => 'Mots Clefs',
              'size' => '50',
            );
//			echo form_label('', 'search_input');
			echo form_input($params);
			echo form_submit('Rechercher', 'Rechercher');
			echo form_close();
		
		?>
		</div>
		<?=anchor('search/index', 'Recherche Avancée', array('title' => 'Recherche Avancée', 'id' => 'advanced_search')); ?>
		<div class="clear"> </div>
	</div>
	
	<div id="infos">
		Actuellement, il y a 1234 offres et 789 demandes sur Highnimal!
	</div>
	
	<div id="content" role="main">