<?php
class ParentAnimals extends Model {

    function ParentAnimals()
    {
        parent::Model();
    }
    
    function get($id_parentanimal) {
    	$this->db->from('parentanimals')->where('id = '.$id_parentanimal);
    	$query = $this->db->get();
    	
    	$result = $query->result();
    	
    	$parentAnimal = $result[0];
		
    	$this->db->from('species')->where('id = '.$parentAnimal->id_species);
    	$query = $this->db->get();
    	$result = $query->result();
		$parentAnimal->species = $result[0];
		
		return $parentAnimal;
    }
    
    function create($name, $species, $race, $birthdate, $sex, $pedigree) {    
		$data = array(
               'id' => '' ,
               'species' => $species->id,
			   'race' => $race,
			   'birthdate' => $birthdate,
			   'sex' => $sex,
			   'pedigree' => $pedigree
            );

		$query = $this->db->insert('parentanimals', $data);
		
		$newId = $this->db->insert_id();
				
		return $newId;
    }
    
    function update($data, $id_parentanimal) {
    	$this->db->where('id = '.$id_parentanimal);
    	$this->db->update('parentanimals', $data);
    }
    
    function delete($id_parentanimal) {
    	$this->db->where('id = '.$id_parentanimal);
		$this->db->delete('parentanimals');
    }
}
