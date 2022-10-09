<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Skpd extends CI_Controller {
        public function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
        $this->load->model('skpd_model');
        $this->load->model('auditor_model');
        $this->load->model('timTindakLanjut_model');
    }
    
    public function index($id_skpd)
    {
        if(!$this->session->userdata('logged_in')) {
            redirect('Login');
        }elseif ($this->session->userdata('id_jenis_user') != '4') {
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
        $data['title'] = 'Halaman Skpd';
        $data['sesuai'] = $this->skpd_model->count_rows2($id_skpd, 'Sesuai');
        $data['belum_sesuai'] = $this->skpd_model->count_rows2($id_skpd, 'Belum Sesuai');
        $data['belum_ditindak_lanjuti'] = $this->skpd_model->count_rows2($id_skpd, 'Belum Ditindak-lanjuti');
        $this->load->view('Templates/headerSKPD', $data);
        $this->load->view('Templates/sidebarSkpd', $data);
        $this->load->view('Skpd/dashboard', $data);
        $this->load->view('Templates/footerAdmin');
    }

    public function temuan($id)
    {
        if(!$this->session->userdata('logged_in')) {
            redirect('Login');
        }elseif ($this->session->userdata('id_jenis_user') != '4') {
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
        $this->load->view('Templates/headerSkpd', $data);
        $this->load->view('Templates/sidebarSkpd', $data);
        $this->load->view('Skpd/temuan', $data);
        $this->load->view('Templates/footerSkpd');
    }

    public function detail($id_lhp)
    {
        if(!$this->session->userdata('logged_in')) {
            redirect('Login');
        }elseif ($this->session->userdata('id_jenis_user') != '4') {
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
        $this->load->view('Templates/headerSKPD', $data);
        $this->load->view('Templates/sidebarSkpd', $data);
        $this->load->view('Skpd/detailLHP', $data);
        $this->load->view('Templates/footerSkpd');
    }

    public function lihatRekomendasi($id_temuan)
    {
        if(!$this->session->userdata('logged_in')) {
            redirect('Login');
        }elseif ($this->session->userdata('id_jenis_user') != '4') {
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
        $this->load->view('Templates/headerSKPD', $data);
        $this->load->view('Templates/sidebarSkpd', $data);
        $this->load->view('Skpd/lihatRekomendasi', $data);
        $this->load->view('Templates/footerSkpd');
    }

    public function lihatRekomendasiTL($id_temuan)
    {
        if(!$this->session->userdata('logged_in')) {
            redirect('Login');
        }elseif ($this->session->userdata('id_jenis_user') != '4') {
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
        $this->load->view('Templates/headerSKPD', $data);
        $this->load->view('Templates/sidebarSkpd', $data);
        $this->load->view('Skpd/rekomendasiTL', $data);
        $this->load->view('Templates/footerSkpd');
    }


    public function TindakLanjut($id= NULL){
        if(!$this->session->userdata('logged_in')) {
            redirect('Login');
        }elseif ($this->session->userdata('id_jenis_user') != '4') {
            redirect('Login/logout');
        }
        $data3['result'] = $this->auditor_model->get_rekomendasi_by_id($id);
        $data = $this->admin_model->ambil_data($this->session->userdata['username']);
        $data = array (
            'username' => $data->username,
            'nama_user' => $data->nama_user,
            'id_skpd' => $data->id_skpd,
            'id_user' => $data->id_user,
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
            $this->load->view('Templates/headerSKPD', $data);
            $this->load->view('Templates/sidebarSkpd', $data);
            $this->load->view('Skpd/tindakLanjut', $data3);
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
            redirect('Skpd/Sukses');

        }
    }

    public function BelumSesuai($id= NULL){
        if(!$this->session->userdata('logged_in')) {
            redirect('Login');
        }elseif ($this->session->userdata('id_jenis_user') != '4') {
            redirect('Login/logout');
        }
        $data3['result'] = $this->skpd_model->get_rekomendasiTL_by_id($id);
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
            $this->load->view('Templates/headerSKPD', $data);
            $this->load->view('Templates/sidebarSkpd', $data);
            $this->load->view('Skpd/belumSesuai', $data3);
            $this->load->view('Templates/footerSkpd');
        } else {
            $imageinput =  $_FILES['image']['name'];
            $datainfo = array();
            $files = $_FILES;
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
                $config['max_size']     = 35600;
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
            redirect('Skpd/Sukses');

        }
    }

    public function DataTindakLanjut($id)
    {
        if(!$this->session->userdata('logged_in')) {
            redirect('Login');
        }elseif ($this->session->userdata('id_jenis_user') != '4') {
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
        $this->load->view('Templates/headerSkpd', $data);
        $this->load->view('Templates/sidebarSkpd', $data);
        $this->load->view('Skpd/dataTindakLanjut', $data);
        $this->load->view('Templates/footerSkpd');
    }

    public function detailTindakLanjut($id_lhp)
    {
        if(!$this->session->userdata('logged_in')) {
            redirect('Login');
        }elseif ($this->session->userdata('id_jenis_user') != '4') {
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
        $this->load->view('Templates/headerSkpd', $data);
        $this->load->view('Templates/sidebarSkpd', $data);
        $this->load->view('Skpd/detailTindakLanjut', $data);
        $this->load->view('Templates/footerSkpd');
    }

    public function detailTL($id_rekomendasi)
    {
        if(!$this->session->userdata('logged_in')) {
            redirect('Login');
        }elseif ($this->session->userdata('id_jenis_user') != '4') {
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
        $data['lhpdata'] = $this->skpd_model->getDetailLHP_by_id_rekomendasi($id_rekomendasi);
        $data['file'] = $this->skpd_model->get_file($id_rekomendasi);
        $this->load->view('Templates/headerSkpd', $data);
        $this->load->view('Templates/sidebarSkpd', $data);
        $this->load->view('Skpd/detailRekomendasi', $data);
        $this->load->view('Templates/footerSkpd');
    }

    

    public function Sukses()
    {
        if(!$this->session->userdata('logged_in')) {
            redirect('Login');
        }elseif ($this->session->userdata('id_jenis_user') != '4') {
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
        $data['title'] = 'Sukses Upload File';
        $this->load->view('Templates/headerSkpd', $data);
        $this->load->view('Templates/sidebarSkpd', $data);
        $this->load->view('Skpd/sukses', $data);
        $this->load->view('Templates/footerSkpd');
    }

    public function gantiPassword($id_user) {
        if(!$this->session->userdata('logged_in')) {
            redirect('Login');
        }elseif ($this->session->userdata('id_jenis_user') != '4') {
            redirect('Login');
        }
        $data = $this->admin_model->ambil_data($this->session->userdata['username']);
        $data = array (
            'username' => $data->username,
            'nama_user' => $data->nama_user,
            'id_skpd' => $data->id_skpd,
            'id_user' => $data->id_user,
            'foto_user' => $data->foto_user,
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
            $this->load->view('Templates/headerSkpd', $data);
            $this->load->view('Templates/sidebarSkpd', $data);
            $this->load->view('Skpd/editPassword');
            $this->load->view('Templates/footerDataTable');
        } else {
            $id_skpd = $this->input->post('id_skpd');
            $enc_password           = md5($this->input->post('password'));
            $data_update    = array(
                'password'          => $enc_password
            );
            $this->admin_model->UpdateData($data_update, $id_user);
            redirect('Skpd/index/'.$id_skpd, $data);
        }
    }
}
/* End of file Skpd.php */
