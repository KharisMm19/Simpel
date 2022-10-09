<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class DataLHP extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('auditor_model');
        $this->load->model('admin_model');
    }

    public function index()
    {
        if(!$this->session->userdata('logged_in')) {
            redirect('Login');
        }elseif ($this->session->userdata('id_jenis_user') != '2') {
            redirect('Login');
        }

        $data = $this->auditor_model->ambil_data($this->session->userdata['username']);
        $data = array (
            'username' => $data->username,
            'nama_user' => $data->nama_user,
            'id_user' => $data->id_user,
            'foto_user' => $data->foto_user,
            'logged_in' =>true,
        );
        $this->session->set_userdata($data);
        $data2['title'] = 'Data LHP';
        $data3['result'] = $this->auditor_model->GetLHP2();
        $this->load->view('Templates/headerAuditor', $data2);
        $this->load->view('Templates/sidebarAuditor', $data);
        $this->load->view('Auditor/dataLHP', $data3);
        $this->load->view('Templates/footerDataTable');
    }

    public function edit($id= NULL){
        if(!$this->session->userdata('logged_in')) {
            redirect('Login');
        }elseif ($this->session->userdata('id_jenis_user') != '2') {
            redirect('Login');
        }    
        
        $data3['result'] = $this->auditor_model->get_lhp_by_id($id);
        $data = $this->admin_model->ambil_data($this->session->userdata['username']);
        $data = array (
            'username' => $data->username,
            'nama_user' => $data->nama_user,
            'id_user' => $data->id_user,
            'foto_user' => $data->foto_user,
        );
        $data2['title'] = 'Edit Data LHP';
        $data3['skpd'] = $this->admin_model->generate_skpd_dropdown();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('no_lhp', 'No_lhp', 'required',
            array(
                'required'      => ' %s harus di isi!',
                'alpha_dash_space'         => ' %s harus di isi hanya dengan huruf!'
            ));
        $this->form_validation->set_rules('nama_skpd', 'Nama_skpd', 'required',
            array(
                'required'      => ' %s harus di isi!'
            ));
            
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('Templates/headerAuditor', $data2);
            $this->load->view('Templates/sidebarAuditor', $data);
            $this->load->view('Auditor/editLHP', $data3);
            $this->load->view('Templates/footerDataTable');
        } else {
            $id_skpd          = $_POST['nama_skpd'];
            $no_lhp           = $_POST['no_lhp'];
            $judul_lhp          = $_POST['judul_lhp'];
            $tahun          = $_POST['tahun'];
            $data_update    = array(
                'id_skpd'           => $id_skpd,
                'no_lhp'            => $no_lhp,
                'judul_lhp'         => $judul_lhp,
                'tahun'             => $tahun
            );
            $this->auditor_model->UpdateData($data_update, $id);
            redirect('DataLHP', $data);

        }
    }

    public function editTemuan($id= NULL){
        if(!$this->session->userdata('logged_in')) {
            redirect('Login');
        }elseif ($this->session->userdata('id_jenis_user') != '2') {
            redirect('Login');
        }    
        
        $data3['result'] = $this->auditor_model->get_temuan_by_id($id);
        $data = $this->admin_model->ambil_data($this->session->userdata['username']);
        $data = array (
            'username' => $data->username,
            'nama_user' => $data->nama_user,
            'id_user' => $data->id_user,
            'foto_user' => $data->foto_user,
        );
        $data2['title'] = 'Edit Temuan LHP';
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('temuan', 'Temuan', 'required',
            array(
                'required'      => ' %s harus di isi!',
                'alpha_dash_space'         => ' %s harus di isi hanya dengan huruf!'
            ));
            
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('Templates/headerAuditor', $data2);
            $this->load->view('Templates/sidebarAuditor', $data);
            $this->load->view('Auditor/editTemuanLHP', $data3);
            $this->load->view('Templates/footerDataTable');
        } else {
            $id_lhp           = $_POST['id_lhp'];
            $temuan           = $_POST['temuan'];
            $data_update      = array(
                'id_lhp'           => $id_lhp,
                'temuan'            => $temuan
            );
            $this->auditor_model->UpdateDataTemuan($data_update, $id);
            redirect('DataLHP/detail/'.$id_lhp, $data);

        }
    }

    public function editRekomendasi($id= NULL){
        if(!$this->session->userdata('logged_in')) {
            redirect('Login');
        }elseif ($this->session->userdata('id_jenis_user') != '2') {
            redirect('Login');
        }    
        
        $data3['result'] = $this->auditor_model->get_rekomendasi_by_id($id);
        $data = $this->admin_model->ambil_data($this->session->userdata['username']);
        $data = array (
            'username' => $data->username,
            'nama_user' => $data->nama_user,
            'id_user' => $data->id_user,
            'foto_user' => $data->foto_user,
        );
        $data2['title'] = 'Edit Rekomendasi LHP';
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('rekomendasi', 'Rekomendasi', 'required',
            array(
                'required'      => ' %s harus di isi!',
                'alpha_dash_space'         => ' %s harus di isi hanya dengan huruf!'
            ));
            
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('Templates/headerAuditor', $data2);
            $this->load->view('Templates/sidebarAuditor', $data);
            $this->load->view('Auditor/editRekomendasi', $data3);
            $this->load->view('Templates/footerDataTable');
        } else {
            $id_lhp           = $_POST['id_lhp'];
            $id_temuan        = $_POST['id_temuan'];
            $rekomendasi      = $_POST['rekomendasi'];
            $data_update      = array(
                'id_lhp'            => $id_lhp,
                'id_temuan'         => $id_temuan,
                'rekomendasi'       => $rekomendasi
            );
            $this->auditor_model->UpdateDataRekomendasi($data_update, $id);
            redirect('DataLHP/lihatRekomendasi/'.$id_temuan, $data);
        }
    }

    public function deletefile($id_file)
    {
        if(!$this->session->userdata('logged_in')) {
            redirect('Login');
        }elseif ($this->session->userdata('id_jenis_user') != '2') {
            redirect('Login');
        }
        $this->db->where('id', $id_file);
        $data = $this->db->get('files')->row();
        $detail  = $this->auditor_model->where('detail_lhp', ['id_file'=> $id_file])->row();
        unlink('./uploads/files/'. $data->file_name);
        $this->auditor_model->delete('files', ['id', $id_file]);
        $this->auditor_model->delete('detail_lhp', ['id_file'=> $id_file]);
        redirect('DataLHP');
    }

    public function tambah(){
        if(!$this->session->userdata('logged_in')) {
            redirect('Login');
        }elseif ($this->session->userdata('id_jenis_user') != '2') {
            redirect('Login');
        }

        $data = $this->auditor_model->ambil_data($this->session->userdata['username']);
        $data = array (
            'username' => $data->username,
            'nama_user' => $data->nama_user,
            'id_user' => $data->id_user,
            'foto_user' => $data->foto_user,
            'logged_in' =>true,
        );
        $this->session->set_userdata($data);
        $data['title'] = 'Tambah Data LHP';
        $data['skpd'] = $this->admin_model->generate_skpd_dropdown();
        
        $this->form_validation->set_rules('nama_skpd', 'Nama_skpd', 'required',
            array(
                'required'      => ' %s harus di isi!',
                'alpha_dash_space'         => ' %s harus di isi hanya dengan huruf!'
            ));
        $this->form_validation->set_rules('no_lhp', 'No_lhp', 'required',
            array(
                'required'      => ' %s harus di isi!'
            ));

        if($this->form_validation->run() === FALSE){
            $this->load->view('Templates/headerAuditor', $data);
            $this->load->view('Templates/sidebarAuditor', $data);
            $this->load->view('Auditor/tambahLHP', $data);
            $this->load->view('Templates/footerDataTable');
        } else {
            $temuaninput =  $this->input->post('temuan');
            if(!empty($temuaninput)){
                $id_lhp = rand();
                $post_data = array(
                    'id_lhp' => $id_lhp,
                    'no_lhp' => $this->input->post('no_lhp'),
                    'judul_lhp' => $this->input->post('judul_lhp'),
                    'id_skpd' => $this->input->post('nama_skpd'),   
                    'tahun' => $this->input->post('tahun')  
                );
                $this->auditor_model->InsertData($post_data);
                foreach ($temuaninput as $key => $value) {
                    $id_temuan = rand();
                    $temuanData = [
                        'id_temuan' => $id_temuan,
                        'id_lhp' => $id_lhp,
                        'id_skpd' => $this->input->post('nama_skpd'),
                        'temuan' => $value
                    ];
                    $this->db->insert('temuan',$temuanData);
                }
            }
            redirect('DataLHP/tambahRekomendasi');
        }
    }
    
    public function detail($id_lhp)
    {
        if(!$this->session->userdata('logged_in')) {
            redirect('Login');
        }elseif ($this->session->userdata('id_jenis_user') != '2') {
            redirect('Login');
        }
        $data = $this->admin_model->ambil_data($this->session->userdata['username']);
        $data = array (
            'username' => $data->username,
            'nama_user' => $data->nama_user,
            'id_user' => $data->id_user,
            'foto_user' => $data->foto_user,
        );
        $data['title'] = 'Detail LHP';
        $data['lhpdata'] = $this->auditor_model->getDetailLHP($id_lhp);
        $data['temuan'] = $this->auditor_model->getTemuanLHP($id_lhp);
        $this->load->view('Templates/headerAuditor', $data);
        $this->load->view('Templates/sidebarAuditor', $data);
        $this->load->view('Auditor/detailLHP', $data);
        $this->load->view('Templates/footerDataTable');
    }

    public function download($id){
        $this->load->helper('download');
        $fileinfo = $this->auditor_model->download($id);
        $file = './uploads/files/'.$fileinfo->file_name;
        force_download($file, NULL);
    }

    public function delete($id){
        if(!$this->session->userdata('logged_in')) {
            redirect('Login');
        }elseif ($this->session->userdata('id_jenis_user') != '2') {
            redirect('Login');
        }
        $detail_lhp = $this->auditor_model->where('detail_lhp', ['id_lhp' => $id])->result_array();
        
        foreach ($detail_lhp as $key => $value) {
            $this->auditor_model->delete('detail_lhp', ['id_lhp' => $id]);
            $this->auditor_model->delete('rekomendasi', ['id_lhp' => $id]);
            $this->auditor_model->delete('temuan', ['id_lhp' => $id]);
        }
        $this->auditor_model->delete('lhp', ['id_lhp' => $id]);
        $this->session->set_flashdata('pesan','Delete Data Sukses');
        redirect('DataLHP');
    }

    public function deleteTemuan($id, $id_lhp){
        if(!$this->session->userdata('logged_in')) {
            redirect('Login');
        }elseif ($this->session->userdata('id_jenis_user') != '2') {
            redirect('Login');
        }
        $detail_lhp = $this->auditor_model->where('detail_lhp', ['id_temuan' => $id])->result_array();
        
        foreach ($detail_lhp as $key => $value) {
            $this->auditor_model->delete('detail_lhp', ['id_temuan' => $id]);
            $this->auditor_model->delete('rekomendasi', ['id_temuan' => $id]);
        }
        $this->auditor_model->delete('temuan', ['id_temuan' => $id]);
        $this->session->set_flashdata('pesan','Delete Data Sukses');
        redirect('DataLHP/detail/'.$id_lhp);
    }

    public function deleteRekomendasi($id, $id_temuan){
        if(!$this->session->userdata('logged_in')) {
            redirect('Login');
        }elseif ($this->session->userdata('id_jenis_user') != '2') {
            redirect('Login');
        }
        $detail_lhp = $this->auditor_model->where('detail_lhp', ['id_rekomendasi' => $id])->result_array();
        
        foreach ($detail_lhp as $key => $value) {
            $this->auditor_model->delete('detail_lhp', ['id_rekomendasi' => $id]);
        }
        $this->auditor_model->delete('rekomendasi', ['id_rekomendasi' => $id]);
        $this->session->set_flashdata('pesan','Delete Data Sukses');
        redirect('DataLHP/lihatRekomendasi/'.$id_temuan);
    }

    public function tambahRekomendasi(){
        if(!$this->session->userdata('logged_in')) {
            redirect('Login');
        }elseif ($this->session->userdata('id_jenis_user') != '2') {
            redirect('Login');
        }

        $data = $this->auditor_model->ambil_data($this->session->userdata['username']);
        $data = array (
            'username' => $data->username,
            'nama_user' => $data->nama_user,
            'foto_user' => $data->foto_user,
            'id_user' => $data->id_user,
            'logged_in' =>true,
        );
        $this->session->set_userdata($data);
        $data['title'] = 'Tambah Rekomendasi Data LHP';
        $data['skpd'] = $this->auditor_model->get_skpd2();
        
        $this->form_validation->set_rules('skpd', 'Skpd', 'required',
            array(
                'required'      => ' %s harus di isi!',
                'alpha_dash_space'         => ' %s harus di isi hanya dengan huruf!'
            ));
        $this->form_validation->set_rules('lhp', 'Lhp', 'required',
            array(
                'required'      => ' %s harus di isi!'
            ));

        if($this->form_validation->run() === FALSE){
            $this->load->view('Templates/headerAuditor', $data);
            $this->load->view('Templates/sidebarAuditor', $data);
            $this->load->view('Auditor/rekomendasi', $data);
            $this->load->view('Templates/footerRekomendasi');
        } else {
            $rekomendasi_input =  $this->input->post('rekomendasi');
            if(!empty($rekomendasi_input)){
                foreach ($rekomendasi_input as $key => $value) {
                    $id_rekomendasi = rand();
                    $id_lhp = $this->input->post('lhp');
                    $id_temuan = $this->input->post('temuan');
                    $rekomendasiData = [
                        'id_rekomendasi' => $id_rekomendasi,
                        'id_temuan' => $id_temuan,
                        'id_lhp' => $id_lhp,
                        "id_skpd" => $this->input->post('skpd'),
                        'rekomendasi' => $value
                    ];
                    $this->db->insert('rekomendasi',$rekomendasiData);
                    $detailLHP = [
                        "id_detail_lhp" => rand(),
                        "id_skpd" => $this->input->post('skpd'),
                        "id_lhp" => $id_lhp,
                        "id_temuan" => $id_temuan,
                        "id_rekomendasi" => $id_rekomendasi
                    ];
                    $this->db->insert('detail_lhp', $detailLHP);
                }
            
            }
            redirect('DataLHP/sukses');
        }
    }

    public function lihatRekomendasi($id_temuan)
    {
        if(!$this->session->userdata('logged_in')) {
            redirect('Login');
        }elseif ($this->session->userdata('id_jenis_user') != '2') {
            redirect('Login');
        }        
        $data = $this->admin_model->ambil_data($this->session->userdata['username']);
        $data = array (
            'username' => $data->username,
            'nama_user' => $data->nama_user,
            'id_user' => $data->id_user,
            'foto_user' => $data->foto_user,
        );
        $data['title'] = 'Detail Rekomendasi';
        $data['lhpdata'] = $this->auditor_model->getDetailLHP_by_id_temuan($id_temuan);
        $data['rekomendasi'] = $this->auditor_model->getRekomendasi($id_temuan);
        $this->load->view('Templates/headerAuditor', $data);
        $this->load->view('Templates/sidebarAuditor', $data);
        $this->load->view('Auditor/lihatRekomendasi', $data);
        $this->load->view('Templates/footerDataTable');
    }

    

    public function get_lhp()
    {
        $id_skpd = $this->input->post('id_skpd');
        $data = $this->auditor_model->get_lhp($id_skpd);
        $output = '<option value=""> Please Select </option>';
        foreach ($data as $row) {
            $output .= '<option value="'. $row->id_lhp .'" judul_lhp="'. $row->judul_lhp .'" tahun="'. $row->tahun .'">' . $row->no_lhp . '</option>';
        }
        // echo json_encode($data);
        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }

    public function get_temuan()
    {
        $id_lhp = $this->input->post('id_lhp');
        $data = $this->auditor_model->get_temuan($id_lhp);
        $output = '<option value=""> Please Select </option>';
        foreach ($data as $row) {
            $output .= '<option value="' . $row->id_temuan . '">' . $row->temuan . '</option>';
        }
        // echo json_encode($data);
        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }

    public function Sukses()
    {
        if(!$this->session->userdata('logged_in')) {
            redirect('Login');
        }elseif ($this->session->userdata('id_jenis_user') != '2') {
            redirect('Login/logout');
        }
        $data = $this->admin_model->ambil_data($this->session->userdata['username']);
        $data = array (
            'username' => $data->username,
            'nama_user' => $data->nama_user,
            'id_skpd' => $data->id_skpd,
            'id_user' => $data->id_user,
            'foto_user' => $data->foto_user,
        );
        $data2['title'] = 'Halaman Auditor';
        $this->load->view('Templates/headerAuditor', $data2);
        $this->load->view('Templates/sidebarAuditor', $data);
        $this->load->view('Auditor/sukses', $data);
        $this->load->view('Templates/footerDataTable');
    }

}

/* End of file DataLHP.php */

?>