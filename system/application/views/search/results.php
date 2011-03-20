<h1>Résultats de la recherche (<?php echo count($search_results); ?>)</h1>
<div id="animals">
<?php
foreach($search_results as $animal)
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