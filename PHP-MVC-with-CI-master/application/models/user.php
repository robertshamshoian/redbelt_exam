<?php
class User extends CI_Model {

    function get_all_users($id)
     {
         return $this->db->query("SELECT * FROM users WHERE id <> ?", array($id))->result_array();
     }

     public function get_user_by_email($email)
     {
         return $this->db->query("SELECT * FROM users WHERE email = ?", array($email))->row_array();
     }
    public function get_user_by_id($id)
     {
         return $this->db->query("SELECT * FROM users WHERE id = ?", array($id))->row_array();
     }
     public function register($user)
    {
        $query = "INSERT INTO users (name,alias,email,password,birth_date,poke_history,created_at, updated_at)
                  VALUES(?,?,?,?,?,?,NOW(), NOW())";
        $values = array($user['name'], $user['alias'],$user['email'],$user['password'],$user['birth_date'],$user['poke_history']);          
        return $this->db->query($query,$values);       
    }
    public function poke($user)
    {
        $query = "UPDATE users 
                SET poke_history = ? , updated_at = now()
                WHERE id= ?";
        return $this->db->query($query, array($user['poke_history'],$user['id']));
    }
    public function poke_log($poke)
    {
        $query = "INSERT INTO pokes (poke_id,alias,recipient_id,created_at,updated_at)
                  VALUES(?, ?, ?,NOW(), NOW())";
        $values = array($poke['poke_id'],$poke['alias'],$poke['recipient_id']);          
        return $this->db->query($query,$values);
    }
     // public function count_pokes($pokes)
     // {
     //    $query = "SELECT * FROM pokes
     //              WHERE poke_id = ?
     //              AND recipient_id = ?";
     //    $values = array($pokes['poke_id'],$pokes['recipient_id']);          
     //    return $this->db->query($query,$values)->row_array(); 
     // }


    public function count_pokes($poke)
    {
        $query = "SELECT count(*) 
                  FROM pokes 
                  WHERE poke_id = ? 
                  AND recipient_id = ?";
        $values = array($poke['poke_id'],$poke['recipient_id']);
        return $this->db->query($query,$values)->row_array();
    }

/*    public function add_to_poke_count($poke)
    {
        $query = "UPDATE pokes 
                SET poke_count = ? , updated_at = now()
                WHERE poke_id = ?, recipient_id= ?";
        return $this->db->query($query, array($poke['poke_count'],$poke['poke_id']),$poke['recipient_id']);
    }
*/

}