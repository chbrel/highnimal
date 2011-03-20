<ul>
	<h2>Profil</h2>
	<div class="login"><b>Nom</b> <?php echo $this->session->userdata("user")->name; ?></div>
	<div><b>Status</b> <?php echo $this->session->userdata("user")->status; ?></div>	
	<div><b>EMail</b> <?php echo $this->session->userdata("user")->email; ?></div>
	<div><b>T&eacute;l&eacute;phone</b> <?php echo $this->session->userdata("user")->phone; ?></div>
	<div><b>Lieu</b> <?php echo $this->session->userdata("user")->location; ?></div>
	<div><b>Immatriculation</b> <?php echo $this->session->userdata("user")->registration; ?></div>
	<div><b>Cr&eacute;dits</b> <?php echo $this->session->userdata("user")->credits; ?></div>
	<div><b>Autre</b> <?php echo $this->session->userdata("user")->other; ?></div>
	
	<?php
	foreach($this->session->userdata("user")->animals as $animal)
	{
		?>
		
		<div><b><?php echo $animal->name; ?></b> <?php echo $animal->species; ?></div>
		
		<?php
	}
	?>
</div>

</ul>