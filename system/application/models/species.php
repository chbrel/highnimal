<?php
class Species extends Model {

    function Species()
    {
        parent::Model();
    }
    
    function get($id_species) {
    	$this->db->from('species')->where('id = '.$id_species);
    	$query = $this->db->get();
    	
    	$result = $query->result();
    	
    	return $result[0];
    }
    
    function getAll() {
    	$this->db->from('species');
    	$query = $this->db->get();
    	
    	return $query->result();
    }
    
    function create($name) {    
    	$data = array(
               'id' => '' ,
               'name' => $name
            );

		$query = $this->db->insert('species', $data);
		
		$newId = $this->db->insert_id();
				
		return $newId;
    }
    
    function update($data, $id_species) {
    	$this->db->where('id = '.$id_species);
    	$this->db->update('species', $data);
    }
    
    function delete($id_species) {
    	$this->db->where('id = '.$id_species);
		$this->db->delete('species');
    }
}
