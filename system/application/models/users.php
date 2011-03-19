<?php
class Users extends Model {

    function Users()
    {
        parent::Model();
    }
    
    function get($id_user) {
    	$this->db->from('users')->where('id = '.$id_user);
    	$query = $this->db->get();
    	
    	$result = $query->result();
    	
    	return $result[0];
    }
    
    function create($name, $status, $email, $password) {    
    	$data = array(
               'id' => '' ,
               'name' => $name,
               'status' => $status,
               'email' => $email,
               'password' => md5($password),
               'credits' => 0
            );

		$query = $this->db->insert('users', $data);
		
		$newId = $this->db->insert_id();
				
		return $newId;
    }
    
    function update($data, $id_user) {
    	$this->db->where('id = '.$id_user);
    	$this->db->update('users', $data);
    }
    
    function delete($id_user) {
    	$this->db->where('id = '.$id_user);
		$this->db->delete('users');
    }
    
    function check_user($email, $password, $md5 = false) {
    	$this->db->from('users')->where("email = '".$email."'");
    	$query = $this->db->get();
    	
    	$result = $query->result();
    	
    	if(count($result) > 0) {
    		if($md5) {
    			$passwd = $password;
    		} else {
    			$passwd = md5($password);
    		}
    		
    		if($result[0]->password == $passwd) {
    			return $result[0];
    		} else {
    			return null;
    		}
    	} else {
    		return null;
    	}
    }
}

/* End of file users.php */
/* Location: ./system/application/models/users.php */