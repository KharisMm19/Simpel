<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class DataSkpd extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
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
            'nama_user' => $data->nama_user,
            'id_user' => $data->id_user,
            'foto_user' => $data->foto_user,
            'logged_in' =>true,
        );
        $this->session->set_userdata($data);
        $data2['title'] = 'Data SKPD';
        $data3['result'] = $this->admin_model->getSkpd();
        $this->load->view('Templates/headerAdmin', $data2);
        $this->load->view('Templates/sidebarAdmin', $data);
        $this->load->view('Admin/dataSKPD', $data3);
        $this->load->view('Templates/footerAdmin');
    }

    function alpha_dash_space($str)
    {
        return ( ! preg_match("/^([-a-z_ ])+$/i", $str)) ? FALSE : TRUE;
    }

    public function tambah(){
        if(!$this->session->userdata('logged_in')) {
            redirect('Login');
        }

        $this->form_validation->set_rules('nama_skpd', 'Nama SKPD', 'required',
            array(
                'required'      => ' %s harus di isi!'
            ));
        

        $data = $this->admin_model->ambil_data($this->session->userdata['username']);
        $data = array (
            'username' => $data->username,
            'nama_user' => $data->nama_user,
            'id_user' => $data->id_user,
            'foto_user' => $data->foto_user,
            'logged_in' =>true,
        );
        $data2['title'] = 'Tambah Data SKPD';
        if($this->form_validation->run() === FALSE){
            $this->load->view('Templates/headerAdmin', $data2);
            $this->load->view('Templates/sidebarAdmin', $data);
            $this->load->view('Admin/tambahSKPD');
            $this->load->view('Templates/footerAdmin');
        } else {
            $post_data = array(
                'nama_skpd'       => $this->input->post('nama_skpd')
            );

            if( empty($data['upload_error']) ) {
                $res = $this->admin_model->InsertDataSKPD($post_data);
                redirect('DataSkpd');
            }       
        }
    }

    public function edit($id= NULL){
        if(!$this->session->userdata('logged_in')) {
            redirect('Login');
        }elseif ($this->session->userdata('id_jenis_user') != '1') {
            redirect('Login/logout');
        }   
        
        $data3['result'] = $this->admin_model->get_skpd_by_id($id);
        $data = $this->admin_model->ambil_data($this->session->userdata['username']);
        $data = array (
            'username' => $data->username,
            'nama_user' => $data->nama_user,
            'id_user' => $data->id_user,
            'foto_user' => $data->foto_user,
        );
        $data2['title'] = 'Edit Data SKPD';
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('nama_skpd', 'Nama SKPD', 'required',
            array(
                'required'      => ' %s harus di isi!'
            ));
        
            
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('Templates/headerAdmin', $data2);
            $this->load->view('Templates/sidebarAdmin', $data);
            $this->load->view('Admin/editSKPD', $data3);
            $this->load->view('Templates/footerAdmin');
        } 
        else {
            
            $nama_skpd                = $_POST['nama_skpd'];
            $data_update    = array(
                'nama_skpd'           => $nama_skpd
            );

            if( empty($data['upload_error']) ) {
                $this->admin_model->UpdateDataSKPD($data_update, $id);
                redirect('DataSkpd', $data);
            }
        }
    }

    public function delete($id){
        $where  = array('id_skpd' => $id);
        $res    = $this->admin_model->DeleteData('skpd',$where);
        if($res>=1){
            $this->session->set_flashdata('pesan','Delete Data Sukses');
            redirect('DataSkpd');
        }
    }

}

/* End of file DataUser.php */

?>