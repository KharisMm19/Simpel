<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class admin_model extends CI_Model {
    public function UpdateDataSKPD($data,$id){
        if ( !empty($data) && !empty($id) ){
            $update = $this->db->update( 'skpd', $data, array('id_skpd'=>$id) );
            return $update ? true : false;
        } else {
            return false;
        }
    }

    public function get_skpd_by_id($id)
    {
        $this->db->select ( '
            skpd.*,
        ' );

        $query = $this->db->get_where('skpd', array('skpd.id_skpd' => $id));
        return $query->row();
    }

    public function getSkpd() {
        $det = $this->db->query('SELECT * FROM skpd order by nama_skpd'); 
        return $det->result_array();
    }

    public function DeleteData($tabelNama, $where){
        $res = $this->db->delete($tabelNama, $where);
        return $res;
    }

    public function UpdateData($data,$id){
        if ( !empty($data) && !empty($id) ){
            $update = $this->db->update( 'users', $data, array('id_user'=>$id) );
            return $update ? true : false;
        } else {
            return false;
        }
    }

    function get_nama_jenis_user() {
        $results = array();
        $this->db->select('id_jenis_user, nama_jenis_user');
        $this->db->from('jenis_user');

        $query = $this->db->get();

        if($query->num_rows() > 0) {
            $results = $query->result();
        }
        return $results;
    }

    function get_nama_skpd() {
        $results = array();
        $this->db->select('id_skpd, nama_skpd');
        $this->db->from('skpd');

        $query = $this->db->get();

        if($query->num_rows() > 0) {
            $results = $query->result();
        }
        return $results;
    }

    public function get_admin_by_id($id)
    {
        $this->db->select ( '
            users.*, 
            jenis_user.id_jenis_user as ju, 
            jenis_user.nama_jenis_user,
            skpd.id_skpd as ju, 
            skpd.nama_skpd,
        ' );
        $this->db->join('jenis_user', 'jenis_user.id_jenis_user = users.id_jenis_user');
        $this->db->join('skpd', 'skpd.id_skpd = users.id_skpd');

        $query = $this->db->get_where('users', array('users.id_user' => $id));
        return $query->row();
    }  

    public function InsertData($data){
        $res = $this->db->insert('users',$data);
        return $res;
    }

    public function InsertDataSKPD($data){
        $res = $this->db->insert('skpd',$data);
        return $res;
    }

    public function GetAdmin()
    {
        $det = $this->db->query('SELECT * FROM users as a 
        join jenis_user as l on l.id_jenis_user = a.id_jenis_user 
        join skpd as s on s.id_skpd = a.id_skpd'); 
        return $det->result_array();
    }

    public function ambil_data($id) {
        $this->db->where('username', $id);
        return $this->db->get('users')->row();
    }

    public function generate_skpd_dropdown()
    {
        $this->db->select ('
            skpd.id_skpd,
            skpd.nama_skpd
        ');

        $this->db->order_by('nama_skpd');

        $result = $this->db->get('skpd');

        $dropdown[''] = 'Please Select';

        if ($result->num_rows() > 0) {
            
            foreach ($result->result_array() as $row) {
                
                $dropdown[$row['id_skpd']] = $row['nama_skpd'];
            }
        }

        return $dropdown;
    }

    public function generate_level_dropdown()
    {
        $this->db->select ('
            jenis_user.id_jenis_user,
            jenis_user.nama_jenis_user
        ');

        $this->db->order_by('nama_jenis_user');

        $result = $this->db->get('jenis_user');
        
        $dropdown[''] = 'Please Select';

        if ($result->num_rows() > 0) {
            
            foreach ($result->result_array() as $row) {
                
                $dropdown[$row['id_jenis_user']] = $row['nama_jenis_user'];
            }
        }

        return $dropdown;
    }

}

/* End of file admin_model.php */

?>