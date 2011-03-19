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
				<div id="logout"><?=anchor('user/logout', 'Log Out ('.$this->session->userdata("user")->email.')', array('title' => 'log out')); ?></div>
			<?php } ?>
		</div>
	</div>
	
	<?=anchor('search/index', 'Recherche', array('title' => 'Recherche')); ?>
	
	<div id="section-main" role="main">