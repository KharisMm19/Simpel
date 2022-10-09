<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class skpd_model extends CI_Model {

    public function get_lhp_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('lhp');
        $this->db->join('skpd', 'skpd.id_skpd = lhp.id_skpd', 'left');
        $this->db->where('lhp.id_skpd', $id);
        return $this->db->get()->result_array();
    }

    public function get_tindak_lanjut_by_id($id)
    {
        $this->db->distinct();
        $this->db->select('tindak_lanjut.*,
        lhp.*');
        $this->db->from('tindak_lanjut');
        $this->db->join('lhp', 'lhp.id_lhp = tindak_lanjut.id_lhp', 'left');
        $this->db->where('tindak_lanjut.id_skpd', $id);
        $this->db->order_by('tindak_lanjut.id_lhp', 'ASC');
        $this->db->group_by('tindak_lanjut.id_lhp');
        return $this->db->get()->result_array();
    }

    public function count_rows($id_lhp, $status) {
        $this->db->distinct();
        $this->db->join('status', 'status.id_status = rekomendasi.id_status', 'left');
        $array = array('id_lhp' => $id_lhp, 'status' => $status);
        $this->db->where($array);
        $this->db->group_by('id_rekomendasi');
        return $this->db->get('rekomendasi')->num_rows();
    }

    public function count_rows2($id_skpd, $status) {
        $this->db->join('status', 'status.id_status = rekomendasi.id_status', 'left');
        $array = array('id_skpd' => $id_skpd, 'status' => $status);
        $this->db->where($array);
        $this->db->group_by('id_rekomendasi');
        return $this->db->get('rekomendasi')->num_rows();
    }

    public function UpdateDataRekomendasi($data,$id){
        if ( !empty($data) && !empty($id) ){
            $update = $this->db->update( 'rekomendasi', $data, array('id_rekomendasi'=>$id) );
            return $update ? true : false;
        } else {
            return false;
        }
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

    public function get_file($id_rekomendasi)
    {
        $this->db->join('rekomendasi', 'rekomendasi.id_rekomendasi = files.id_rekomendasi');
        $this->db->order_by('files.file_name', 'ASC');
        $this->db->where('files.id_rekomendasi', $id_rekomendasi);
        $det = $this->db->get('files')->result_array();
        return $det;
    }

    public function get_rekomendasiTL_by_id($id)
    {
        $this->db->select ( '
            lhp.*,
            temuan.*,
            skpd.nama_skpd,
            rekomendasi.*
        ' );
        $this->db->join('lhp', 'lhp.id_lhp = rekomendasi.id_lhp');
        $this->db->join('skpd', 'skpd.id_skpd = rekomendasi.id_skpd');
        $this->db->join('temuan', 'temuan.id_temuan = rekomendasi.id_temuan');
        $query = $this->db->get_where('rekomendasi', array('rekomendasi.id_rekomendasi' => $id));
        return $query->row();
    }
    
    public function getDetailLHP($id_lhp)
    {
        $this->db->join('files', 'files.id = detail_lhp.id_file');
        $this->db->join('lhp', 'lhp.id_lhp = detail_lhp.id_lhp');
        $this->db->join('skpd', 'skpd.id_skpd = lhp.id_skpd');
        $this->db->where('detail_lhp.id_lhp', $id_lhp);
        $det = $this->db->get('detail_lhp')->result_array();
        return $det;
    }

    public function getDetailTindakLanjut($id_lhp)
    {
        $this->db->join('skpd', 'skpd.id_skpd = tindak_lanjut.id_skpd');
        $this->db->where('tindak_lanjut.id_lhp', $id_lhp);
        $det = $this->db->get('tindak_lanjut')->result_array();
        return $det;
    }

    public function generate_noLHP_dropdown($id)
    {
        $this->db->select ('
            lhp.id_lhp,
            lhp.no_lhp,
            lhp.tahun,
            lhp.id_skpd
        ');
        $this->db->from('lhp');
        $this->db->join('skpd', 'skpd.id_skpd = lhp.id_skpd', 'left');
        $this->db->where('lhp.id_skpd', $id);
        $this->db->order_by('no_lhp');

        return $this->db->get()->result_array();
    }

    public function InsertData($data){
        $res = $this->db->insert('tindak_lanjut',$data);
        return $res;
    }

    public function getDetailLHP_by_id_rekomendasi($id_rekomendasi)
    {
        $this->db->join('lhp', 'lhp.id_lhp = rekomendasi.id_lhp');
        $this->db->join('temuan', 'temuan.id_temuan = rekomendasi.id_temuan');
        $this->db->join('status', 'status.id_status = rekomendasi.id_status');
        $this->db->join('skpd', 'skpd.id_skpd = rekomendasi.id_skpd');
        $this->db->where('rekomendasi.id_rekomendasi', $id_rekomendasi);
        $det = $this->db->get('rekomendasi')->result_array();
        return $det;
    }
}

/* End of file skpd_model.php */

?>