<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class timTindakLanjut_model extends CI_Model {

    public function get_tindak_lanjut()
    {
        $this->db->distinct();
        $this->db->select('*');
        $this->db->from('tindak_lanjut');
        $this->db->join('skpd', 'skpd.id_skpd = tindak_lanjut.id_skpd', 'left');
        $this->db->join('lhp', 'lhp.id_lhp = tindak_lanjut.id_lhp', 'left');
        $this->db->order_by('lhp.no_lhp', 'ASC');
        $this->db->group_by('tindak_lanjut.id_lhp');
        return $this->db->get()->result_array();
    }

    public function getRekomendasi($id_temuan)
    {
        $this->db->join('temuan', 'temuan.id_temuan = tindak_lanjut.id_temuan');
        $this->db->join('rekomendasi', 'rekomendasi.id_rekomendasi = tindak_lanjut.id_rekomendasi');
        $this->db->join('status', 'status.id_status = tindak_lanjut.id_status');
        $this->db->order_by('rekomendasi.rekomendasi', 'ASC');
        $this->db->where('tindak_lanjut.id_temuan', $id_temuan);
        $det = $this->db->get('tindak_lanjut')->result_array();
        return $det;
    }

    public function get_detail($id_rekomendasi)
    {
        $this->db->join('temuan', 'temuan.id_temuan = tindak_lanjut.id_temuan');
        $this->db->join('rekomendasi', 'rekomendasi.id_rekomendasi = tindak_lanjut.id_rekomendasi');
        $this->db->order_by('files.file_name', 'ASC');
        $this->db->where('tindak_lanjut.id_rekomendasi', $id_rekomendasi);
        $det = $this->db->get('tindak_lanjut')->result_array();
        return $det;
    }

    public function get_skpd() {
        $this->db->order_by('nama_skpd', 'ASC');
        $det = $this->db->get('skpd')->result_array();
        return $det;
    }

    public function get_lhp($id_skpd) {
        $this->db->order_by('tahun', 'ASC');
        $this->db->where('id_skpd', $id_skpd);
        $det = $this->db->get('lhp')->result_array();
        return $det;
    }

    public function get_nama_skpd($id_skpd) {
        $this->db->where('skpd.id_skpd', $id_skpd);
        $det = $this->db->get('skpd')->result_array();
        return $det;
    }

    public function count_rows($id_skpd, $status) {
        $this->db->join('status', 'status.id_status = tindak_lanjut.id_status', 'left');
        $array = array('id_skpd' => $id_skpd, 'status' => $status);
        $this->db->where($array);
        $this->db->group_by('id_rekomendasi');
        return $this->db->get('tindak_lanjut')->num_rows();
    }

    public function count_rows2($status) {
        $this->db->join('status', 'status.id_status = rekomendasi.id_status', 'left');
        $array = array('status' => $status);
        $this->db->where($array);
        return $this->db->get('rekomendasi')->num_rows();
    }

    public function count_rowsbylhp($id_lhp, $status) {
        $this->db->join('status', 'status.id_status = rekomendasi.id_status', 'left');
        $array = array('id_lhp' => $id_lhp, 'status' => $status);
        $this->db->where($array);
        return $this->db->get('rekomendasi')->num_rows();
    }

    public function count_temuan() {
        return $this->db->get('temuan')->num_rows();
    }

    public function count_rekomendasi() {
        return $this->db->get('rekomendasi')->num_rows();
    }

    public function count_temuan2($id_lhp) {
        $this->db->where('id_lhp', $id_lhp);
        return $this->db->get('temuan')->num_rows();
    }

    public function count_rekomendasi2($id_lhp) {
        $this->db->where('id_lhp', $id_lhp);
        return $this->db->get('rekomendasi')->num_rows();
    }

    public function getDetailLHP_by_id_rekomendasi($id_rekomendasi)
    {
        $this->db->join('lhp', 'lhp.id_lhp = rekomendasi.id_lhp');
        $this->db->join('temuan', 'temuan.id_temuan = rekomendasi.id_temuan');
        $this->db->join('status', 'status.id_status = rekomendasi.id_status');
        $this->db->join('skpd', 'skpd.id_skpd = rekomendasi.id_skpd');
        $this->db->where('id_rekomendasi', $id_rekomendasi);
        $det = $this->db->get('rekomendasi')->result_array();
        return $det;
    }

    public function get_rekomendasi_by_id($id)
    {
        $this->db->join('lhp', 'lhp.id_lhp = rekomendasi.id_lhp');
        $this->db->join('skpd', 'skpd.id_skpd = rekomendasi.id_skpd');
        $this->db->join('temuan', 'temuan.id_temuan = rekomendasi.id_temuan');
        $query = $this->db->get_where('rekomendasi', array('rekomendasi.id_rekomendasi' => $id));
        return $query->row();
    }

    public function generate_status_dropdown()
    {
        $this->db->select ('
            status.id_status,
            status.status
        ');
        $this->db->order_by('status');

        $result = $this->db->get('status');

        $dropdown[''] = 'Please Select';

        if ($result->num_rows() > 0) {
            
            foreach ($result->result_array() as $row) {
                
                $dropdown[$row['id_status']] = $row['status'];
            }
        }

        return $dropdown;
    }

    public function UpdateDataTindakLanjut($data,$id){
        if ( !empty($data) && !empty($id) ){
            $update = $this->db->update( 'rekomendasi', $data, array('id_rekomendasi'=>$id) );
            return $update ? true : false;
        } else {
            return false;
        }
    }

}

/* End of file timTindakLanjut_model.php */

?>