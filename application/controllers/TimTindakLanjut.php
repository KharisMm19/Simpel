<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class TimTindakLanjut extends CI_Controller {

    
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
        }elseif ($this->session->userdata('id_jenis_user') != '3') {
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
        $data['title'] = 'Halaman Tim Tindak Lanjut';
        $data['temuan'] = $this->timTindakLanjut_model->count_temuan();
        $data['rekomendasi'] = $this->timTindakLanjut_model->count_rekomendasi();
        $data['sesuai'] = $this->timTindakLanjut_model->count_rows2('Sesuai');
        $data['belum_sesuai'] = $this->timTindakLanjut_model->count_rows2('Belum Sesuai');
        $data['belum_ditindak_lanjuti'] = $this->timTindakLanjut_model->count_rows2('Belum Ditindak-lanjuti');
        $this->load->view('Templates/headerTimTindakLanjut', $data);
        $this->load->view('Templates/sidebarTimTindakLanjut', $data);
        $this->load->view('TimTindakLanjut/dashboard', $data);
        $this->load->view('Templates/footerAdmin');
    }

    public function TindakLanjut()
    {
        if(!$this->session->userdata('logged_in')) {
            redirect('Login');
        }elseif ($this->session->userdata('id_jenis_user') != '3') {
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
        $data['result'] = $this->timTindakLanjut_model->get_tindak_lanjut();
        $this->load->view('Templates/headerTimTindakLanjut', $data);
        $this->load->view('Templates/sidebarTimTindakLanjut', $data);
        $this->load->view('TimTindakLanjut/tindakLanjut', $data);
        $this->load->view('Templates/footerSkpd');
    }

    public function detailTindakLanjut($id_lhp)
    {
        if(!$this->session->userdata('logged_in')) {
            redirect('Login');
        }elseif ($this->session->userdata('id_jenis_user') != '3') {
            redirect('Login/logout');
        }
        $data = $this->admin_model->ambil_data($this->session->userdata['username']);
        $data = array (
            'username' => $data->username,
            'nama_user' => $data->nama_user,
            'id_user' => $data->id_user,
            'id_skpd' => $data->id_skpd,
            'foto_user' => $data->foto_user
        );
        $data['title'] = 'Detail Tindak Lanjut';
        $data['lhpdata'] = $this->auditor_model->getDetailLHP($id_lhp);
        $data['temuan'] = $this->auditor_model->getTemuanLHP($id_lhp);
        $data['sesuai'] = $this->skpd_model->count_rows($id_lhp, 'Sesuai');
        $data['belum_sesuai'] = $this->skpd_model->count_rows($id_lhp, 'Belum Sesuai');
        $data['belum_ditindak_lanjuti'] = $this->skpd_model->count_rows($id_lhp, 'Belum Ditindak-lanjuti');
        $this->load->view('Templates/headerTimTindakLanjut', $data);
        $this->load->view('Templates/sidebarTimTindakLanjut', $data);
        $this->load->view('TimTindakLanjut/detailTindakLanjut', $data);
        $this->load->view('Templates/footerSkpd');
    }

    public function lihatRekomendasiTL($id_temuan)
    {
        if(!$this->session->userdata('logged_in')) {
            redirect('Login');
        }elseif ($this->session->userdata('id_jenis_user') != '3') {
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
        $data['rekomendasi'] = $this->skpd_model->getRekomendasi($id_temuan);
        $this->load->view('Templates/headerTimTindakLanjut', $data);
        $this->load->view('Templates/sidebarTimTindakLanjut', $data);
        $this->load->view('TimTindakLanjut/rekomendasiTL', $data);
        $this->load->view('Templates/footerSkpd');
    }

    public function detailTL($id_rekomendasi)
    {
        if(!$this->session->userdata('logged_in')) {
            redirect('Login');
        }elseif ($this->session->userdata('id_jenis_user') != '3') {
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
        $this->load->view('Templates/headerTimTindakLanjut', $data);
        $this->load->view('Templates/sidebarTimTindakLanjut', $data);
        $this->load->view('TimTindakLanjut/detailRekomendasi', $data);
        $this->load->view('Templates/footerSkpd');
    }

    public function halamanVerifikasi($id= NULL){
        if(!$this->session->userdata('logged_in')) {
            redirect('Login');
        }elseif ($this->session->userdata('id_jenis_user') != '3') {
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
            $this->load->view('Templates/headerTimTindakLanjut', $data);
            $this->load->view('Templates/sidebarTimTindakLanjut', $data);
            $this->load->view('TimTindakLanjut/halamanTindakLanjut', $data2);
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
            redirect('TimTindakLanjut/detailTL/'.$id_rekomendasi, $data);
        }
    }

    public function dataSkpd() {
        if(!$this->session->userdata('logged_in')) {
            redirect('Login');
        }elseif ($this->session->userdata('id_jenis_user') != '3') {
            redirect('Login/logout');
        }
        $data = $this->admin_model->ambil_data($this->session->userdata['username']);
        $data = array (
            'username' => $data->username,
            'nama_user' => $data->nama_user,
            'id_user' => $data->id_user,
            'foto_user' => $data->foto_user,
        );
        $data['title'] = 'Halaman Tim Tindak Lanjut';
        $data['skpd'] = $this->timTindakLanjut_model->get_skpd();
        $this->load->view('Templates/headerTimTindakLanjut', $data);
        $this->load->view('Templates/sidebarTimTindakLanjut', $data);
        $this->load->view('TimTindakLanjut/dataSkpd');
        $this->load->view('Templates/footerDataTable');
    }

    public function listLHP($id_skpd)
    {
        if(!$this->session->userdata('logged_in')) {
            redirect('Login');
        }elseif ($this->session->userdata('id_jenis_user') != '3') {
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
        $data['title'] = 'Halaman List LHP';
        $data['lhp'] = $this->timTindakLanjut_model->get_lhp($id_skpd);
        $this->load->view('Templates/headerTimTindakLanjut', $data);
        $this->load->view('Templates/sidebarTimTindakLanjut', $data);
        $this->load->view('TimTindakLanjut/listLHP', $data);
        $this->load->view('Templates/footerDataTable');
    }

    public function status($id_lhp)
    {
        if(!$this->session->userdata('logged_in')) {
            redirect('Login');
        }elseif ($this->session->userdata('id_jenis_user') != '3') {
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
        $data['title'] = 'Halaman Status';
        $data['lhpdata'] = $this->auditor_model->getDetailLHP($id_lhp);
        $data['temuan'] = $this->timTindakLanjut_model->count_temuan2($id_lhp);
        $data['rekomendasi'] = $this->timTindakLanjut_model->count_rekomendasi2($id_lhp);
        $data['sesuai'] = $this->timTindakLanjut_model->count_rowsbylhp($id_lhp, 'Sesuai');
        $data['belum_sesuai'] = $this->timTindakLanjut_model->count_rowsbylhp($id_lhp, 'Belum Sesuai');
        $data['belum_ditindak_lanjuti'] = $this->timTindakLanjut_model->count_rowsbylhp($id_lhp, 'Belum Ditindak-lanjuti');
        $this->load->view('Templates/headerTimTindakLanjut', $data);
        $this->load->view('Templates/sidebarTimTindakLanjut', $data);
        $this->load->view('TimTindakLanjut/status', $data);
        $this->load->view('Templates/footerAdmin');
    }

    public function download($id){
        $this->load->helper('download');
        $fileinfo = $this->auditor_model->download($id);
        $file = './uploads/files/TindakLanjut/'.$fileinfo->file_name;
        force_download($file, NULL);
    }

    public function gantiPassword($id_user) {
        if(!$this->session->userdata('logged_in')) {
            redirect('Login');
        }elseif ($this->session->userdata('id_jenis_user') != '3') {
            redirect('Login');
        }
        $data = $this->admin_model->ambil_data($this->session->userdata['username']);
        $data = array (
            'username' => $data->username,
            'nama_user' => $data->nama_user,
            'id_skpd' => $data->id_skpd,
            'id_user' => $data->id_user,
            'foto_user' => $data->foto_user,
            'logged_in' => true
        );
        $data['title'] = 'Edit Password';
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('password', 'Password', 'required',
            array(
                'required'      => ' %s harus di isi!',
                'alpha_dash_space'         => ' %s harus di isi hanya dengan huruf!'
            ));
            
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('Templates/headerTimTindakLanjut', $data);
            $this->load->view('Templates/sidebarTimTindakLanjut', $data);
            $this->load->view('TimTindakLanjut/editPassword');
            $this->load->view('Templates/footerDataTable');
        } else {
            $id_skpd = $this->input->post('id_skpd');
            $enc_password           = md5($this->input->post('password'));
            $data_update    = array(
                'password'          => $enc_password
            );
            $this->admin_model->UpdateData($data_update, $id_user);
            redirect('TimTindakLanjut', $data);
        }
    }

}

/* End of file TimTindakLanjut.php */

?> 