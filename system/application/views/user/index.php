
	<h2>Profil</h2>
	<div class="profil">
	<div><b>Nom : </b> <?php if($this->session->userdata("user")->name == "") { echo "<span style=\"color:red\">Non renseigné</span>"; } else { echo $this->session->userdata("user")->name; } ?></div>
	<div><b>Statut : </b> <?php echo $this->session->userdata("user")->status; ?></div>	
	<div><b>Adresse Mail : </b> <?php echo $this->session->userdata("user")->email; ?></div>
	<div><b>T&eacute;l&eacute;phone : </b> <?php if($this->session->userdata("user")->phone == "") { echo "<span style=\"color:red\">Non renseigné</span>"; } else { echo $this->session->userdata("user")->phone; } ?></div>
	<div><b>Lieu : </b> <?php if($this->session->userdata("user")->location == "") { echo "<span style=\"color:red\">Non renseigné</span>"; } else { echo $this->session->userdata("user")->location; } ?></div>
	<div><b>Immatriculation : </b> <?php if($this->session->userdata("user")->registration == "") { echo "<span style=\"color:red\">Non renseigné</span>"; } else { echo $this->session->userdata("user")->registration; } ?></div>
	<div><b>Cr&eacute;dits disponible : </b> <?php echo $this->session->userdata("user")->credits; ?></div>
	<div><b>Autre : </b> <?php if($this->session->userdata("user")->other == "") { echo "Néant"; } else {  echo $this->session->userdata("user")->other; } ?></div>
	</div>
	
	<h2>Animaux</h2>
	<div id="animals">
	<?php
	foreach($this->session->userdata("user")->animals as $animal)
	{
	?>
		
		<div class="animal">
			<div class="animal_photo"></div>
			<div class="animal_infos">
				<div class="animal_title">"<?php echo $animal->name; ?>" : <?php echo $animal->species->name; ?> <?php if($animal->sex == 'male') { echo 'Mâle'; } ?><?php if($animal->sex == 'female') { echo "Femelle"; } ?></div>
				<div class="animal_race"><b>Race : </b> <?php echo $animal->race; ?></div>
				<div class="animal_color"><b>Couleur : </b> <?php echo $animal->color; ?></div>
				<div class="animal_birth"><b>Date de naissance : </b><?php $date = explode('-', $animal->birthdate); echo $date[2].'/'.$date[1].'/'.$date[0]; ?></div>
				<div class="animal_bloodgroup"><b>Groupe Sanguin : </b> <?php echo $animal->bloodgroup; ?></div>
				<div class="animal_pedigree"><b>Pedigree : </b> <?php echo $animal->pedigree; ?></div>
				<div class="animal_vaccines"><b>Vaccins / Tests Médicaux : </b> <?php if($animal->vaccines == "") { echo "Non Renseigné"; } else { echo $animal->vaccines; } ?></div>
				<div class="animal_appearance"><b>Particularités Physiques : </b> <?php if($animal->appearance == "") { echo "Néant";} else { echo $animal->appearance; } ?></div>
				
			</div>
			<div class="clear"> </div>
		</div>
	<?php
	}
	?>
	</div>
</div>