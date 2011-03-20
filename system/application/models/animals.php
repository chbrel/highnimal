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
    	
    	$animal = $result[0];
		
    	$this->db->from('species')->where('id = '.$animal->id_species);
    	$query = $this->db->get();
    	$result = $query->result();
		$animal->species = $result[0];
		
		if($animal->id_mother != null)
		{
			$animal->mother = $animal->id_mother;
		}
		else
		{
			$animal->mother = null;
		}
		
		if($animal->id_father != null)
		{
			$animal->father = $animal->id_father;
		}
		else
		{
			$animal->father = null;
		}
		
		return $animal;
    }
    
    function getTotalNumber() {
    	$this->db->from('animals');
    	$query = $this->db->get();
    	$result = $query->result();
    	
    	return count($result);
    }
    

	function search($searchkeys)
	{
		$allSearchKeys = explode(' ', trim($searchkeys));
	
		$results = array();		
		foreach($allSearchKeys as $searchKey)
		{
			$query = $this->db->query("SELECT a.id AS id FROM animals a INNER JOIN species s ON a.id_species = s.id WHERE s.name LIKE '%".$searchKey."%'");
			$result = $query->result();
			
			$ids = array();
			foreach($result as $r)
			{
				array_push($ids, $r->id);
			}
			
			$results = array_merge($results, $ids);
		}
		
		foreach(explode(' ', trim($searchkeys)) as $searchkey)
		{
			$this->db->select('id')
					 ->like('name', $searchkey)
					 ->or_like('race', $searchkey)
					 ->or_like('sex', $searchkey)
					 ->or_like('bloodgroup', $searchkey)
					 ->or_like('vaccines', $searchkey)
					 ->or_like('color', $searchkey)
					 ->or_like('appearance', $searchkey)
					 ->or_like('pedigree', $searchkey);
			
			$query = $this->db->get('animals');
			$result = $query->result();
			
			$ids = array();
			foreach($result as $r) {
				array_push($ids, $r->id);
			}
			
			$results = array_unique(array_merge($results, $ids));
		}
		
		$objects = array();
		foreach($results as $result)
		{
			array_push($objects, $this->get($result));
		}
		
		return $objects;
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
               'id_species' => $species->id,
               'race' => $race,
               'birthdate' => $birthdate,
               'sex' => $sex,
               'bloodgroup' => $bloodgroup,
               'vaccines' => $vaccines,
               'color' => $color,
               'appearance' => $appearance,
               'pedigree' => $pedigree,
               'id_mother' => $id_mother,
               'id_father' => $id_father,
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