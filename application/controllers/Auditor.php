<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Auditor extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
        
    }
    

    public function index()
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
        $data2['title'] = 'Halaman Auditor';
        $this->load->view('Templates/headerAuditor', $data2);
        $this->load->view('Templates/sidebarAuditor', $data);
        $this->load->view('Auditor/dashboard');
        $this->load->view('Templates/footerAdmin');
    }

    public function gantiPassword($id_user) {
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
        $data2['title'] = 'Edit Password';
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('password', 'Password', 'required',
            array(
                'required'      => ' %s harus di isi!',
                'alpha_dash_space'         => ' %s harus di isi hanya dengan huruf!'
            ));
            
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('Templates/headerAuditor', $data2);
            $this->load->view('Templates/sidebarAuditor', $data);
            $this->load->view('Auditor/editPassword');
            $this->load->view('Templates/footerDataTable');
        } else {
            $enc_password           = md5($this->input->post('password'));
            $data_update    = array(
                'password'          => $enc_password
            );
            $this->admin_model->UpdateData($data_update, $id_user);
            redirect('Auditor', $data);
        }
    }

}

/* End of file Auditor.php */

?>