<h1>Connexion</h1>
<?php echo validation_errors(); ?>
<?php
if(isset($connexion_error)) {
	echo "<p>".$connexion_error."</p>";
}
?>
<?php echo form_open('user/login');
echo '<ul>';

$data_login = array(
              'name'        => 'login',
              'id'          => 'login',
              'value'       => $this->input->post('login'),
              'size' => '75',
              'maxlength' => '50',
            );
echo '<li>';
echo form_label('Login', 'login');
echo form_input($data_login);
echo '</li>';


$data_password = array(
              'name'        => 'password',
              'id'          => 'password',
              'value'       => $this->input->post('password'),
              'size' => '75',
              'maxlength' => '200',
              'type' => 'password'
            );
echo '<li>';
echo form_label('Mot de passe', 'password');
echo form_input($data_password);
echo '</li>';


echo form_submit('Se connecter', 'Se connecter');
//<div><input type="submit" value="Submit" /></div>
echo '</ul>';

echo form_close();
?>