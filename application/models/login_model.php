<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class login_model extends CI_Model {

    public function cek_login($username, $password)
    {
        $this->db->where("username", $username);
        $this->db->where("password", $password);
        return $this->db->get('users');
    }

}

/* End of file login_model.php */

?>