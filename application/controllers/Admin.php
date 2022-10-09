<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
        $this->load->model('auditor_model');
        $this->load->model('skpd_model');
        $this->load->model('timTindakLanjut_model');
    }
    

    public function index()
    {
        if(!$this->session->userdata('logged_in')) {
            redirect('Login');
        }elseif ($this->session->userdata('id_jenis_user') != '1') {
            redirect('Login/logout');
        }
        $data = $this->admin_model->ambil_data($this->session->userdata['username']);
        $data = array (
            'username' => $data->username,
            'id_user' => $data->id_user,
            'nama_user' => $data->nama_user,
            'foto_user' => $data->foto_user,
        );
        $data['title'] = 'Halaman Tim Tindak Lanjut';
        $data['temuan'] = $this->timTindakLanjut_model->count_temuan();
        $data['rekomendasi'] = $this->timTindakLanjut_model->count_rekomendasi();
        $data['sesuai'] = $this->timTindakLanjut_model->count_rows2('Sesuai');
        $data['belum_sesuai'] = $this->timTindakLanjut_model->count_rows2('Belum Sesuai');
        $data['belum_ditindak_lanjuti'] = $this->timTindakLanjut_model->count_rows2('Belum Ditindak-lanjuti');
        $data2['title'] = 'Halaman Admin';
        $this->load->view('Templates/headerAdmin', $data2);
        $this->load->view('Templates/sidebarAdmin', $data);
        $this->load->view('Admin/dashboard');
        $this->load->view('Templates/footerAdmin');
    }

    public function get_admin_by_id($id)
    {
        $this->db->select ( '
            users.*, 
            skpd.id_skpd as sk, 
            skpd.nama_skpd,
            jenis_user.id_jenis_user as ju, 
            jenis_user.nama_jenis_user,
        ' );
        $this->db->join('skpd', 'skpd.id_skpd = users.id_skpd');
        $this->db->join('jenis_user', 'jenis_user.id_jenis_user = users.id_jenis_user');

        $query = $this->db->get_where('users', array('users.id_user' => $id));
        return $query->row();
    }

    public function gantiPassword($id_user) {
        if(!$this->session->userdata('logged_in')) {
            redirect('Login');
        }elseif ($this->session->userdata('id_jenis_user') != '1') {
            redirect('Login');
        }
        $data = $this->admin_model->ambil_data($this->session->userdata['username']);
        $data = array (
            'username' => $data->username,
            'nama_user' => $data->nama_user,
            'id_user' => $data->id_user,
            'foto_user' => $data->foto_user,
        );
        $data2['title'] = 'Edit Password';
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('password', 'Password', 'required',
            array(
                'required'      => ' %s harus di isi!',
                'alpha_dash_space'         => ' %s harus di isi hanya dengan huruf!'
            ));
            
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('Templates/headerAdmin', $data2);
            $this->load->view('Templates/sidebarAdmin', $data);
            $this->load->view('Admin/editPassword');
            $this->load->view('Templates/footerDataTable');
        } else {
            $enc_password           = md5($this->input->post('password'));
            $data_update    = array(
                'password'          => $enc_password
            );
            $this->admin_model->UpdateData($data_update, $id_user);
            redirect('Admin', $data);
        }
    }

    /* Auditor */
    public function DataLHP()
    {
        if(!$this->session->userdata('logged_in')) {
            redirect('Login');
        }elseif ($this->session->userdata('id_jenis_user') != '1') {
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
        $this->load->view('Templates/headerAdmin', $data2);
        $this->load->view('Templates/sidebarAdmin', $data);
        $this->load->view('Admin/dataLHP', $data3);
        $this->load->view('Templates/footerDataTable');
    }

    public function tambah(){
        if(!$this->session->userdata('logged_in')) {
            redirect('Login');
        }elseif ($this->session->userdata('id_jenis_user') != '1') {
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
            $this->load->view('Templates/headerAdmin', $data);
            $this->load->view('Templates/sidebarAdmin', $data);
            $this->load->view('Admin/tambahLHP', $data);
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
            redirect('Admin/tambahRekomendasi');
        }
    }

    public function edit($id= NULL){
        if(!$this->session->userdata('logged_in')) {
            redirect('Login');
        }elseif ($this->session->userdata('id_jenis_user') != '1') {
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
            $this->load->view('Templates/headerAdmin', $data2);
            $this->load->view('Templates/sidebarAdmin', $data);
            $this->load->view('Admin/editLHP', $data3);
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
            redirect('Admin/DataLHP', $data);

        }
    }

    public function editTemuan($id= NULL){
        if(!$this->session->userdata('logged_in')) {
            redirect('Login');
        }elseif ($this->session->userdata('id_jenis_user') != '1') {
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
            $this->load->view('Templates/headerAdmin', $data2);
            $this->load->view('Templates/sidebarAdmin', $data);
            $this->load->view('Admin/editTemuanLHP', $data3);
            $this->load->view('Templates/footerDataTable');
        } else {
            $id_lhp           = $_POST['id_lhp'];
            $temuan           = $_POST['temuan'];
            $data_update      = array(
                'id_lhp'           => $id_lhp,
                'temuan'            => $temuan
            );
            $this->auditor_model->UpdateDataTemuan($data_update, $id);
            redirect('Admin/detail/'.$id_lhp, $data);

        }
    }

    public function editRekomendasi($id= NULL){
        if(!$this->session->userdata('logged_in')) {
            redirect('Login');
        }elseif ($this->session->userdata('id_jenis_user') != '1') {
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
            $this->load->view('Templates/headerAdmin', $data2);
            $this->load->view('Templates/sidebarAdmin', $data);
            $this->load->view('Admin/editRekomendasi', $data3);
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
            redirect('Admin/lihatRekomendasi/'.$id_temuan, $data);
        }
    }

    public function deletefile($id_file)
    {
        if(!$this->session->userdata('logged_in')) {
            redirect('Login');
        }elseif ($this->session->userdata('id_jenis_user') != '1') {
            redirect('Login');
        }
        $this->db->where('id', $id_file);
        $data = $this->db->get('files')->row();
        $detail  = $this->auditor_model->where('detail_lhp', ['id_file'=> $id_file])->row();
        unlink('./uploads/files/'. $data->file_name);
        $this->auditor_model->delete('files', ['id', $id_file]);
        $this->auditor_model->delete('detail_lhp', ['id_file'=> $id_file]);
        redirect('Admin/DataLHP');
    }
    
    public function detail($id_lhp)
    {
        if(!$this->session->userdata('logged_in')) {
            redirect('Login');
        }elseif ($this->session->userdata('id_jenis_user') != '1') {
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
        $this->load->view('Templates/headerAdmin', $data);
        $this->load->view('Templates/sidebarAdmin', $data);
        $this->load->view('Admin/detailLHP', $data);
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
        }elseif ($this->session->userdata('id_jenis_user') != '1') {
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
        redirect('Admin/DataLHP');
    }

    public function deleteTemuan($id, $id_lhp){
        if(!$this->session->userdata('logged_in')) {
            redirect('Login');
        }elseif ($this->session->userdata('id_jenis_user') != '1') {
            redirect('Login');
        }
        $detail_lhp = $this->auditor_model->where('detail_lhp', ['id_temuan' => $id])->result_array();
        
        foreach ($detail_lhp as $key => $value) {
            $this->auditor_model->delete('detail_lhp', ['id_temuan' => $id]);
            $this->auditor_model->delete('rekomendasi', ['id_temuan' => $id]);
        }
        $this->auditor_model->delete('temuan', ['id_temuan' => $id]);
        $this->session->set_flashdata('pesan','Delete Data Sukses');
        redirect('Admin/detail/'.$id_lhp);
    }

    public function deleteRekomendasi($id, $id_temuan){
        if(!$this->session->userdata('logged_in')) {
            redirect('Login');
        }elseif ($this->session->userdata('id_jenis_user') != '1') {
            redirect('Login');
        }
        $detail_lhp = $this->auditor_model->where('detail_lhp', ['id_rekomendasi' => $id])->result_array();
        
        foreach ($detail_lhp as $key => $value) {
            $this->auditor_model->delete('detail_lhp', ['id_rekomendasi' => $id]);
        }
        $this->auditor_model->delete('rekomendasi', ['id_rekomendasi' => $id]);
        $this->session->set_flashdata('pesan','Delete Data Sukses');
        redirect('Admin/lihatRekomendasi/'.$id_temuan);
    }

    public function tambahRekomendasi(){
        if(!$this->session->userdata('logged_in')) {
            redirect('Login');
        }elseif ($this->session->userdata('id_jenis_user') != '1') {
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
            $this->load->view('Templates/headerAdmin', $data);
            $this->load->view('Templates/sidebarAdmin', $data);
            $this->load->view('Admin/rekomendasi', $data);
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
            redirect('Admin/sukses');
        }
    }

    public function lihatRekomendasi($id_temuan)
    {
        if(!$this->session->userdata('logged_in')) {
            redirect('Login');
        }elseif ($this->session->userdata('id_jenis_user') != '1') {
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
        $this->load->view('Templates/headerAdmin', $data);
        $this->load->view('Templates/sidebarAdmin', $data);
        $this->load->view('Admin/lihatRekomendasi', $data);
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
        }elseif ($this->session->userdata('id_jenis_user') != '1') {
            redirect('Login/logout');
        }
        $data = $this->admin_model->ambil_data($this->session->userdata['username']);
        $data = array (
            'username' => $data->username,
            'nama_user' => $data->nama_user,
            'id_user' => $data->id_user,
            'id_skpd' => $data->id_skpd,
            'foto_user' => $data->foto_user,
        );
        $data2['title'] = 'Halaman Admin';
        $this->load->view('Templates/headerAdmin', $data2);
        $this->load->view('Templates/sidebarAdmin', $data);
        $this->load->view('Admin/sukses', $data);
        $this->load->view('Templates/footerDataTable');
    }
    
    /* SKPD */
    public function temuan($id)
    {
        if(!$this->session->userdata('logged_in')) {
            redirect('Login');
        }elseif ($this->session->userdata('id_jenis_user') != '1') {
            redirect('Login/logout');
        }
        $data = $this->admin_model->ambil_data($this->session->userdata['username']);
        $data = array (
            'username' => $data->username,
            'nama_user' => $data->nama_user,
            'id_user' => $data->id_user,
            'id_skpd' => $data->id_skpd,
            'foto_user' => $data->foto_user,
        );
        $data['title'] = 'Data Temuan';
        $data['lhp'] = $this->skpd_model->get_lhp_by_id($id);
        $this->load->view('Templates/headerAdmin', $data);
        $this->load->view('Templates/sidebarAdmin', $data);
        $this->load->view('Admin/temuan', $data);
        $this->load->view('Templates/footerSkpd');
    }

    public function detail2($id_lhp)
    {
        if(!$this->session->userdata('logged_in')) {
            redirect('Login');
        }elseif ($this->session->userdata('id_jenis_user') != '1') {
            redirect('Login/logout');
        }
        $data = $this->admin_model->ambil_data($this->session->userdata['username']);
        $data = array (
            'username' => $data->username,
            'nama_user' => $data->nama_user,
            'id_user' => $data->id_user,
            'id_skpd' => $data->id_skpd,
            'foto_user' => $data->foto_user,
        );
        $data['title'] = 'Detail Temuan';
        $data['lhpdata'] = $this->auditor_model->getDetailLHP($id_lhp);
        $data['temuan'] = $this->auditor_model->getTemuanLHP($id_lhp);
        $this->load->view('Templates/headerAdmin', $data);
        $this->load->view('Templates/sidebarAdmin', $data);
        $this->load->view('Admin/detailLHP2', $data);
        $this->load->view('Templates/footerSkpd');
    }

    public function lihatRekomendasi2($id_temuan)
    {
        if(!$this->session->userdata('logged_in')) {
            redirect('Login');
        }elseif ($this->session->userdata('id_jenis_user') != '1') {
            redirect('Login/logout');
        }        
        $data = $this->admin_model->ambil_data($this->session->userdata['username']);
        $data = array (
            'username' => $data->username,
            'nama_user' => $data->nama_user,
            'id_user' => $data->id_user,
            'id_skpd' => $data->id_skpd,
            'foto_user' => $data->foto_user,
        );
        $data['title'] = 'Detail Rekomendasi';
        $data['lhpdata'] = $this->auditor_model->getDetailLHP_by_id_temuan($id_temuan);
        $data['rekomendasi'] = $this->auditor_model->getRekomendasi($id_temuan);
        $this->load->view('Templates/headerAdmin', $data);
        $this->load->view('Templates/sidebarAdmin', $data);
        $this->load->view('Admin/lihatRekomendasi2', $data);
        $this->load->view('Templates/footerSkpd');
    }

    public function TindakLanjut($id= NULL){
        if(!$this->session->userdata('logged_in')) {
            redirect('Login');
        }elseif ($this->session->userdata('id_jenis_user') != '1') {
            redirect('Login/logout');
        }
        $data3['result'] = $this->auditor_model->get_rekomendasi_by_id($id);
        $data = $this->admin_model->ambil_data($this->session->userdata['username']);
        $data = array (
            'username' => $data->username,
            'nama_user' => $data->nama_user,
            'id_user' => $data->id_user,
            'id_skpd' => $data->id_skpd,
            'foto_user' => $data->foto_user,
        );
        $data['title'] = 'Halaman Tindak Lanjut';
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required',
            array(
                'required'      => ' %s harus di isi!',
                'alpha_dash_space'         => ' %s harus di isi hanya dengan huruf!'
            ));
            
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('Templates/headerAdmin', $data);
            $this->load->view('Templates/sidebarAdmin', $data);
            $this->load->view('Admin/tindakLanjut', $data3);
            $this->load->view('Templates/footerSkpd');
        } else {
            $imageinput =  $_FILES['image']['name'];
            $datainfo = array();
            $files = $_FILES;
            $id_tindak_lanjut = rand();
            $tindak_lanjut = [
                'id_tindak_lanjut' => $id_tindak_lanjut,
                'id_lhp' => $this->input->post('id_lhp'),
                'id_skpd' => $this->input->post('id_skpd')
            ];
            $this->db->insert('tindak_lanjut', $tindak_lanjut);
            $data_update    = array(
                'keterangan'           => $this->input->post('keterangan')
            );
            $this->skpd_model->UpdateDataRekomendasi($data_update, $id);
            foreach ($imageinput as $key => $value) {
                $_FILES['userfile']['name']= $files['image']['name'][$key];
                $_FILES['userfile']['type']= $files['image']['type'][$key];
                $_FILES['userfile']['tmp_name']= $files['image']['tmp_name'][$key];
                $_FILES['userfile']['error']= $files['image']['error'][$key];
                $_FILES['userfile']['size']= $files['image']['size'][$key];
                $this->load->library('upload');
                $config = array();
                $config['upload_path'] = './uploads/files/TindakLanjut/';
                $config['allowed_types'] = 'pdf|xls|docx|doc|ppt|pptx|csv|xlsx|xls|zip|rar';
                $config['max_size']     = '5048';
                $config['remove_spaces'] = TRUE;                           
                $this->upload->initialize($config);
                $this->upload->do_upload();
                $datainfo[] = $this->upload->data();
                $imageData = $this->upload->data();
                $id_file = rand();
                $fileData = [
                    'id' => $id_file,
                    'id_rekomendasi' => $this->input->post('id_rekomendasi'),
                    'file_name' => $imageData['file_name']
                ];
                $this->db->insert('files', $fileData);
            };
            redirect('DataSkpd');
        }
    }

    public function DataTindakLanjut($id)
    {
        if(!$this->session->userdata('logged_in')) {
            redirect('Login');
        }elseif ($this->session->userdata('id_jenis_user') != '1') {
            redirect('Login/logout');
        }
        $data = $this->admin_model->ambil_data($this->session->userdata['username']);
        $data = array (
            'username' => $data->username,
            'nama_user' => $data->nama_user,
            'id_skpd' => $data->id_skpd,
            'id_user' => $data->id_user,
            'foto_user' => $data->foto_user
        );
        $data['title'] = 'Data Tindak Lanjut';
        $data['result'] = $this->skpd_model->get_tindak_lanjut_by_id($id);
        $this->load->view('Templates/headerAdmin', $data);
        $this->load->view('Templates/sidebarAdmin', $data);
        $this->load->view('Admin/dataTindakLanjut', $data);
        $this->load->view('Templates/footerSkpd');
    }

    /* Tim Tindak Lanjut */
    public function detailTindakLanjut($id_lhp)
    {
        if(!$this->session->userdata('logged_in')) {
            redirect('Login');
        }elseif ($this->session->userdata('id_jenis_user') != '1') {
            redirect('Login/logout');
        }
        $data = $this->admin_model->ambil_data($this->session->userdata['username']);
        $data = array (
            'username' => $data->username,
            'nama_user' => $data->nama_user,
            'id_skpd' => $data->id_skpd,
            'id_user' => $data->id_user,
            'foto_user' => $data->foto_user
        );
        $data['title'] = 'Detail Tindak Lanjut';
        $data['lhpdata'] = $this->auditor_model->getDetailLHP($id_lhp);
        $data['temuan'] = $this->auditor_model->getTemuanLHP($id_lhp);
        $data['temuan2'] = $this->timTindakLanjut_model->count_temuan2($id_lhp);
        $data['rekomendasi'] = $this->timTindakLanjut_model->count_rekomendasi2($id_lhp);
        $data['sesuai'] = $this->skpd_model->count_rows($id_lhp, 'Sesuai');
        $data['belum_sesuai'] = $this->skpd_model->count_rows($id_lhp, 'Belum Sesuai');
        $data['belum_ditindak_lanjuti'] = $this->skpd_model->count_rows($id_lhp, 'Belum Ditindak-lanjuti');
        $this->load->view('Templates/headerAdmin', $data);
        $this->load->view('Templates/sidebarAdmin', $data);
        $this->load->view('Admin/detailTindakLanjut', $data);
        $this->load->view('Templates/footerSkpd');
    }

    public function lihatRekomendasiTL($id_temuan)
    {
        if(!$this->session->userdata('logged_in')) {
            redirect('Login');
        }elseif ($this->session->userdata('id_jenis_user') != '1') {
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
        $data['title'] = 'Detail Rekomendasi';
        $data['lhpdata'] = $this->auditor_model->getDetailLHP_by_id_temuan($id_temuan);
        $data['rekomendasi'] = $this->skpd_model->getRekomendasi($id_temuan);
        $this->load->view('Templates/headerAdmin', $data);
        $this->load->view('Templates/sidebarAdmin', $data);
        $this->load->view('Admin/rekomendasiTL', $data);
        $this->load->view('Templates/footerSkpd');
    }

    public function detailTL($id_rekomendasi)
    {
        if(!$this->session->userdata('logged_in')) {
            redirect('Login');
        }elseif ($this->session->userdata('id_jenis_user') != '1') {
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
        $data['title'] = 'Detail Rekomendasi';
        $data['lhpdata'] = $this->timTindakLanjut_model->getDetailLHP_by_id_rekomendasi($id_rekomendasi);
        $data['rekomendasi'] = $this->skpd_model->get_file($id_rekomendasi);
        $this->load->view('Templates/headerAdmin', $data);
        $this->load->view('Templates/sidebarAdmin', $data);
        $this->load->view('Admin/detailRekomendasi', $data);
        $this->load->view('Templates/footerSkpd');
    }

    public function halamanVerifikasi($id= NULL){
        if(!$this->session->userdata('logged_in')) {
            redirect('Login');
        }elseif ($this->session->userdata('id_jenis_user') != '1') {
            redirect('Login/logout');
        }    
        
        $data2['result'] = $this->timTindakLanjut_model->get_rekomendasi_by_id($id);
        $data2['status'] = $this->timTindakLanjut_model->generate_status_dropdown();
        $data = $this->admin_model->ambil_data($this->session->userdata['username']);
        $data = array (
            'username' => $data->username,
            'nama_user' => $data->nama_user,
            'id_user' => $data->id_user,
            'foto_user' => $data->foto_user,
        );
        $data['title'] = 'Halaman Tindak LHP';
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('rekomendasi', 'Rekomendasi', 'required',
            array(
                'required'      => ' %s harus di isi!',
                'alpha_dash_space'         => ' %s harus di isi hanya dengan huruf!'
            ));
            
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('Templates/headerAdmin', $data);
            $this->load->view('Templates/sidebarAdmin', $data);
            $this->load->view('Admin/halamanTindakLanjut', $data2);
            $this->load->view('Templates/footerDataTable');
        } else {
            $keterangan         = $_POST['keterangan'];
            $id_rekomendasi         = $_POST['id_rekomendasi'];
            $status             = $_POST['status'];
            $data_update        = array(
                'keterangan'        => $keterangan,
                'id_status'         => $status
            );
            $this->timTindakLanjut_model->UpdateDataTindakLanjut($data_update, $id);
            redirect('Admin/detailTL/'.$id_rekomendasi, $data);
        }
    }

}

/* End of file Admin.php */

?>