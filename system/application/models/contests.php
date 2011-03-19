<?php
class Contests extends Model {

    function Contests()
    {
        parent::Model();
    }
    
    function get($id_contest) {
    	$this->db->from('contests')->where('id = '.$id_contest);
    	$query = $this->db->get();
    	
    	$result = $query->result();
    	
    	return $result[0];
    }
    
    function delete($id_contest) {
    	$this->db->where('id = '.$id_contest);
		$this->db->delete('contests');
    }
    
    function update($data, $id_contest) {   
    	$this->db->where('id = '.$id_contest);
    	$this->db->update('contests', $data);
    }
    
    function create($name, $date) {    
    	$data = array(
               'id' => '' ,
               'name' => $name,
               'date' => $date
            );

		$query = $this->db->insert('contests', $data);
		
		$newId = $this->db->insert_id();
				
		return $newId;
    }
}

/* End of file contests.php */
/* Location: ./system/application/models/contests.php */