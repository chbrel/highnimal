<?php
class Animals extends Model {

    function Animals()
    {
        parent::Model();
    }
    
    function get($id_animal) {
    	$this->db->from('animals')->where('id = '.$id_animal);
    	$query = $this->db->get();
    	
    	$result = $query->result();
    	
    	return $result[0];
    }
    
    function create($name, $species, $race, $birthdate, $sex, $bloodgroup, $vaccines, $color, $appearance, $pedigree, $mother = null, $father = null) {    
    	
    	if($mother != null) {
    		$id_mother = $mother->id;
    	} else {
    		$id_mother = null;
    	}
    	
    	if($father != null) {
    		$id_father = $father->id;
    	} else {
    		$id_father = null;
    	}
    	
    	$data = array(
               'id' => '' ,
               'name' => $name,
               'species' => $species,
               'race' => $race,
               'birthdate' => $birthdate,
               'sex' => $sex,
               '$bloodgroup' => $bloodgroup,
               '$vaccines' => $vaccines,
               '$color' => $color,
               '$appearance' => $appearance,
               '$pedigree' => $pedigree,
               'mother' => $id_mother,
               'father' => $id_father,
            );

		$query = $this->db->insert('animals', $data);
		
		$newId = $this->db->insert_id();
				
		return $newId;
    }
    
    function update($data, $id_animal) {
    	$this->db->where('id = '.$id_animal);
    	$this->db->update('animals', $data);
    }
    
    function delete($id_animal) {
    	$this->db->where('id = '.$id_animal);
		$this->db->delete('animals');
    }
}

/* End of file users.php */
/* Location: ./system/application/models/users.php */