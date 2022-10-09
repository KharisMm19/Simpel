<?php  
defined('BASEPATH') OR exit('No direct script access allowed'); 
 
class auditor_model extends CI_Model{ 
    function __construct() { 
        $this->tableName = 'lhp'; 
    }

    public function getAllFiles(){
        $query = $this->db->get('lhp');
        return $query->result(); 
    }
    
    public function insertfile($file){
        return $this->db->insert('lhp', $file);
    }

    public function download($id){       
        $this->db->where('id', $id);
        return $this->db->get('files')->row();        
    }

    public function DeleteData($tabelNama, $where){
        $res = $this->db->delete($tabelNama, $where);
        return $res;
    }

    public function getRows($id = ''){ 
        $this->db->select('id_skpd,file_name,uploaded_on'); 
        $this->db->from('lhp'); 
        if($id){ 
            $this->db->where('id_skpd',$id); 
            $query = $this->db->get(); 
            $result = $query->row_array(); 
        }else{ 
            $this->db->order_by('uploaded_on','desc'); 
            $query = $this->db->get(); 
            $result = $query->result_array(); 
        } 
        return !empty($result)?$result:false; 
    } 
    
    public function insert($data = array()){ 
        $insert = $this->db->insert_batch('lhp',$data); 
        return $insert?true:false; 
    }

    public function InsertData($data){
        $res = $this->db->insert('lhp',$data);
        return $res;
    }

    public function get_lhp_by_id($id)
    {
        $this->db->select ( '
            lhp.*,
            skpd.id_skpd as ju, 
            skpd.nama_skpd,
        ' );
        $this->db->join('skpd', 'skpd.id_skpd = lhp.id_skpd');

        $query = $this->db->get_where('lhp', array('lhp.id_lhp' => $id));
        return $query->row();
    }

    public function get_temuan_by_id($id)
    {
        $this->db->select ( '
            temuan.*,
            lhp.*,
            skpd.nama_skpd
        ' );
        $this->db->join('lhp', 'lhp.id_lhp = temuan.id_lhp');
        $this->db->join('skpd', 'skpd.id_skpd = lhp.id_skpd');
        $query = $this->db->get_where('temuan', array('temuan.id_temuan' => $id));
        return $query->row();
    }

    public function get_rekomendasi_by_id($id)
    {
        $this->db->select ( '
            rekomendasi.*,
            lhp.*,
            temuan.*,
            skpd.nama_skpd
        ' );
        $this->db->join('lhp', 'lhp.id_lhp = rekomendasi.id_lhp');
        $this->db->join('skpd', 'skpd.id_skpd = lhp.id_skpd');
        $this->db->join('temuan', 'temuan.id_temuan = rekomendasi.id_temuan');
        $query = $this->db->get_where('rekomendasi', array('rekomendasi.id_rekomendasi' => $id));
        return $query->row();
    }

    public function UpdateData($data,$id){
        if ( !empty($data) && !empty($id) ){
            $update = $this->db->update( 'lhp', $data, array('id_lhp'=>$id) );
            return $update ? true : false;
        } else {
            return false;
        }
    }

    public function UpdateDataTemuan($data,$id){
        if ( !empty($data) && !empty($id) ){
            $update = $this->db->update( 'temuan', $data, array('id_temuan'=>$id) );
            return $update ? true : false;
        } else {
            return false;
        }
    }

    public function UpdateDataRekomendasi($data,$id){
        if ( !empty($data) && !empty($id) ){
            $update = $this->db->update( 'rekomendasi', $data, array('id_rekomendasi'=>$id) );
            return $update ? true : false;
        } else {
            return false;
        }
    }

    public function getLHP2() {
        $this->db->join('skpd', 'skpd.id_skpd = lhp.id_skpd');
        $this->db->order_by('nama_skpd', 'ASC');
        $det = $this->db->get('lhp')->result_array();
        return $det;
    }

    public function getDetailLHP($id_lhp)
    {
        $this->db->join('lhp', 'lhp.id_lhp = detail_lhp.id_lhp');
        $this->db->join('temuan', 'temuan.id_lhp = detail_lhp.id_lhp');
        $this->db->join('skpd', 'skpd.id_skpd = lhp.id_skpd');
        $this->db->where('detail_lhp.id_lhp', $id_lhp);
        $det = $this->db->get('detail_lhp')->result_array();
        return $det;
    }

    public function getDetailLHP_by_id_temuan($id_temuan)
    {
        $this->db->join('lhp', 'lhp.id_lhp = detail_lhp.id_lhp');
        $this->db->join('temuan', 'temuan.id_temuan = detail_lhp.id_temuan');
        $this->db->join('skpd', 'skpd.id_skpd = lhp.id_skpd');
        $this->db->where('detail_lhp.id_temuan', $id_temuan);
        $det = $this->db->get('detail_lhp')->result_array();
        return $det;
    }

    public function getTemuanLHP($id_lhp)
    {
        $this->db->join('lhp', 'lhp.id_lhp = temuan.id_lhp');
        $this->db->order_by('temuan', 'ASC');
        $this->db->where('temuan.id_lhp', $id_lhp);
        $det = $this->db->get('temuan')->result_array();
        return $det;
    }

    public function getRekomendasi($id_temuan)
    {
        $this->db->join('temuan', 'temuan.id_temuan = rekomendasi.id_temuan');
        $this->db->join('status', 'status.id_status = rekomendasi.id_status');
        $this->db->order_by('rekomendasi', 'ASC');
        $this->db->where('rekomendasi.id_temuan', $id_temuan);
        $det = $this->db->get('rekomendasi')->result_array();
        return $det;
    }

    public function upload($data = array()){ 
        return $this->db->insert_batch('files', $data); 
    }

    public function ambil_data($id) {
        $this->db->where('username', $id);
        return $this->db->get('users')->row();
    }
    
    public function getLhp() {
        $det = $this->db->query('SELECT * FROM lhp order by nama_skpd'); 
        return $det->result_array();
    }
    public function delete($table, $where)
    {
        $this->db->where($where);
        return $this->db->delete($table);
    }
    public function where($table, $filter)
    {
        $this->db->where($filter);
        return $this->db->get($table);
    }

    public function get_skpd()
    {
        $this->db->order_by("nama_skpd", "ASC");
        $query = $this->db->get("skpd");
        return $query->result_array();
    }

    public function fetch_LHP($id_skpd)
    {
        $this->db->where('id_skpd', $id_skpd);
        $this->db->order_by('nama_lhp', 'ASC');
        $query = $this->db->get('lhp');
        $output = '<option value="">Please Select</option>';
        foreach($query->result() as $row)
        {
            $output .= '<option value="'.$row->id_lhp.'">'.$row->no_lhp.'</option>';
        }
        return $output;
    }

    function fetch_Temuan($id_lhp)
    {
        $this->db->where('id_lhp', $id_lhp);
        $this->db->order_by('temuan', 'ASC');
        $query = $this->db->get('temuan');
        $output = '<option value="">Please Select</option>';
        foreach($query->result() as $row)
        {
            $output .= '<option value="'.$row->id_temuan.'">'.$row->temuan.'</option>';
        }
        return $output;
    }

    public function getLHP3($id_skpd) {
        return $this->db->get_where('lhp', ['id_skpd' => $id_skpd])->result();
    }

    public function get_skpd2() {
        $this->db->order_by("nama_skpd", "ASC");
        $query = $this->db->get("skpd");
        return $query->result();
    }

    public function get_lhp($id_skpd)
    {
        $this->db->select ( '
            lhp.*,
            skpd.id_skpd as ju, 
            skpd.nama_skpd,
        ' );
        $this->db->order_by("createdAt", "DESC");
        $this->db->join('skpd', 'skpd.id_skpd = lhp.id_skpd');

        $query = $this->db->get_where('lhp', array('lhp.id_skpd' => $id_skpd));
        return $query->result();
    }

    public function get_temuan($id_lhp)
    {
        $this->db->select ( '
            temuan.*,
            lhp.id_lhp as ju, 
            lhp.no_lhp,
        ' );
        $this->db->order_by("temuan", "ASC");
        $this->db->join('lhp', 'lhp.id_lhp = temuan.id_lhp');

        $query = $this->db->get_where('temuan', array('temuan.id_lhp' => $id_lhp));
        return $query->result();
    }
}