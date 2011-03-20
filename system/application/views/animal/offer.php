<h1>Fiche Highnimal</h1>
<h3>Les champs marqués d'une étoile (*) sont obligatoires!</h3>
<?php echo validation_errors(); ?>
<?php
if(isset($connexion_error)) {
	echo "<p>".$connexion_error."</p>";
}
?>
<?php echo form_open('animal/offer');
echo '<ul>';

$data_name = array(
              'name'        => 'name',
              'id'          => 'name',
              'value'       => $this->input->post('name'),
              'size' => '75',
              'maxlength' => '50',
            );
echo '<li>';
echo form_label('(*) Nom de mon Highnimal', 'name');
echo form_input($data_name);
echo '</li>';

$options = array();

foreach($species as $s) {
	$options[$s->id] = $s->name;
}

/*$options = array(
                  'cat'  => 'Professionnel',
                  'dog'    => 'Particulier'
                );
*/

echo '<li>';
echo form_label('(*) Espèce', 'species');
echo form_dropdown('species', $options, '', 'id = "species"');
echo '</li>';

$data_race = array(
              'name'        => 'race',
              'id'          => 'race',
              'value'       => $this->input->post('race'),
              'size' => '75',
              'maxlength' => '50'
            );
echo '<li>';
echo form_label('(*) Race', 'race');
echo form_input($data_race);
echo '</li>';

$options_jj = array();

for($i = 1; $i < 31 ; $i++) {
	if($i < 10) {
		$jj = "0".$i;
	} else {
		$jj = "".$i;
	}
	$options_jj[$jj] = $jj;
}

$options_mm = array();

for($i = 1; $i < 13 ; $i++) {
	if($i < 10) {
		$mm = "0".$i;
	} else {
		$mm = "".$i;
	}
	$options_mm[$mm] = $mm;
}

$options_aaaa = array();

for($i = 1900; $i < date("Y") ; $i++) {
	$options_aaaa["".$i] = "".$i;
}

echo '<li>';
echo form_label('(*) Date de naissance', 'birth_jj');
echo form_dropdown('birth_jj', $options_jj, '', 'id = "birth_jj"');
echo form_dropdown('birth_mm', $options_mm, '', 'id = "birth_mm"');
echo form_dropdown('birth_aaaa', $options_aaaa, '', 'id = "birth_aaaa"');
echo '</li>';

$options_sex = array(
                  'male'  => 'Mâle',
                  'female'    => 'Femelle'
                );

echo '<li>';
echo form_label('(*) Sexe', 'sex');
echo form_dropdown('sex', $options_sex, '', 'id = "sex"');
echo '</li>';

$data_bloodgroup = array(
              'name'        => 'bloodgroup',
              'id'          => 'bloodgroup',
              'value'       => $this->input->post('bloodgroup'),
              'size' => '75',
              'maxlength' => '50'
            );
echo '<li>';
echo form_label('(*) Groupe Sanguin', 'bloodgroup');
echo form_input($data_bloodgroup);
echo '</li>';

$data_vaccines = array(
              'name'        => 'vaccines',
              'id'          => 'vaccines',
              'value'       => $this->input->post('vaccines'),
              'cols' => '50',
              'rows' => '5'
            );
echo '<li>';
echo form_label('Vaccins/Tests Médicaux', 'vaccines');
echo form_textarea($data_vaccines);
echo '</li>';

$data_color = array(
              'name'        => 'color',
              'id'          => 'color',
              'value'       => $this->input->post('color'),
              'size' => '75',
              'maxlength' => '50'
            );
echo '<li>';
echo form_label('(*) Couleur', 'color');
echo form_input($data_color);
echo '</li>';

$data_appearance = array(
              'name'        => 'appearance',
              'id'          => 'appearance',
              'value'       => $this->input->post('appearance'),
              'cols' => '50',
              'rows' => '5'
            );
echo '<li>';
echo form_label('Particularités Physique', 'appearance');
echo form_textarea($data_appearance);
echo '</li>';

$data_pedigree = array(
              'name'        => 'pedigree',
              'id'          => 'pedigree',
              'value'       => $this->input->post('pedigree'),
              'size' => '75',
              'maxlength' => '50'
            );
echo '<li>';
echo form_label('(*) Pedigree', 'pedigree');
echo form_input($data_pedigree);
echo '</li>';

echo form_submit('Ajouter cet highnimal', 'Ajouter cet highnimal');
//<div><input type="submit" value="Submit" /></div>
echo '</ul>';

echo form_close();
?>