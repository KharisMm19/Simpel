<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
    }

    public function index()
    {
        $data['title'] = 'Halaman Login';
        $this->load->view('Templates/headerLogin', $data);
        $this->load->view('login');
        $this->load->view('Templates/footerLogin');
    }

    public function proses_login() {
        $this->form_validation->set_rules('username', 'username', 'required',[
            'required' => 'Username wajib diisi!'
        ]);
        $this->form_validation->set_rules('password', 'password', 'required',[
            'required' => 'Password wajib diisi!'
        ]);

        if ($this->form_validation->run() == FALSE) {
            redirect('Login','refresh');
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $username = $username;
            $pass = MD5($password);

            $cek = $this->login_model->cek_login($username, $pass);

            if ($cek->num_rows() > 0) {
                foreach ($cek->result() as $ck) {
                    $sess_data['username'] = $ck->username;
                    $sess_data['nama_user'] = $ck->nama_user;
                    $sess_data['id_skpd'] = $ck->id_skpd;
                    $sess_data['id_jenis_user'] = $ck->id_jenis_user;
                    $sess_data['logged_in'] = true;
                    
                    $this->session->set_userdata($sess_data);
                }
                if ($sess_data['id_jenis_user'] == '1') {
                    redirect('Admin');
                }elseif ($sess_data['id_jenis_user'] == '2') {
                    redirect('Auditor');
                }elseif ($sess_data['id_jenis_user'] == '3') {
                    redirect('TimTindakLanjut');
                }elseif ($sess_data['id_jenis_user'] == '4') {
                    redirect('Skpd/index/'.$sess_data['id_skpd']);
                }else {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                        <strong>Email atau Password Salah</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');
                    redirect('Login');
                }
            }else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                    <strong>Email atau Password Salah</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');
                    redirect('Login');
            }
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('Login');
    }

}

/* End of file Login.php */

?>