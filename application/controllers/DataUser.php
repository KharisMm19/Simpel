<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class DataUser extends CI_Controller {
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
            'foto_user' => $data->foto_user,
            'id_user' => $data->id_user,
            'logged_in' =>true,
        );
        $this->session->set_userdata($data);
        $data2['title'] = 'Data User';
        $data3['result'] = $this->admin_model->GetAdmin();
        $this->load->view('Templates/headerAdmin', $data2);
        $this->load->view('Templates/sidebarAdmin', $data);
        $this->load->view('Admin/dataUser', $data3);
        $this->load->view('Templates/footerAdmin');
    }

    function alpha_dash_space($str)
    {
        return ( ! preg_match("/^([-a-z_ ])+$/i", $str)) ? FALSE : TRUE;
    }

    public function tambah(){
        if(!$this->session->userdata('logged_in')) {
            redirect('Login');
        }elseif ($this->session->userdata('id_jenis_user') != '1') {
            redirect('Login/logout');
        }

        $this->form_validation->set_rules('nama_user', 'Nama_user', 'required',
            array(
                'required'      => ' %s harus di isi!',
                'alpha_dash_space'         => ' %s harus di isi hanya dengan huruf!'
            ));
        $this->form_validation->set_rules('nama_skpd', 'SKPD', 'required',
            array(
                'required'      => ' %s harus di isi!'
            ));
            $this->form_validation->set_rules('nama_jenis_user', 'Level', 'required',
            array(
                'required'      => ' %s harus di isi!'
            ));
        $this->form_validation->set_rules('email', 'Email', 'required',
            array(
                'required'      => ' %s harus di isi!'
            ));
        $this->form_validation->set_rules('telp_pegawai', 'Telp ', 'numeric',
            array(
                'numeric'         => ' %s harus di isi hanya dengan angka!'
            ));
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]|is_unique[users.username]|alpha',
            array( 
                'required'      => ' %s harus di isi!',
                'is_unique'     => '%s sudah ada',
                'alpha'      => ' %s harus di isi hanya dengan huruf dan tidak boleh menggunakan spasi!'
            ));
        $this->form_validation->set_rules('password', 'Password', 'required|alpha_dash',
            array(
                'required'      => ' %s harus di isi!',
                'alpha_dash'    => ' %s harus di isi hanya dengan huruf, angka, minus dan garis bawah!'
            ));
        $this->form_validation->set_rules('password2', 'Konfirmasi Password', 'required|matches[password]',
            array(
                'required'      => ' %s harus di isi!',
                'matches'       => ' %s salah'
            ));

        $data = $this->admin_model->ambil_data($this->session->userdata['username']);
        $data = array (
            'username' => $data->username,
            'nama_user' => $data->nama_user,
            'foto_user' => $data->foto_user,
            'id_user' => $data->id_user,
            'logged_in' =>true,
        );
        $data2['title'] = 'Tambah Data User';
        $data3['skpd'] = $this->admin_model->generate_skpd_dropdown();
        $data3['level'] = $this->admin_model->generate_level_dropdown();
        if($this->form_validation->run() === FALSE){
            $this->load->view('Templates/headerAdmin', $data2);
            $this->load->view('Templates/sidebarAdmin', $data);
            $this->load->view('Admin/tambahUser', $data3);
            $this->load->view('Templates/footerAdmin');
        } else {
            if ( isset($_FILES['image']) && $_FILES['image']['size'] > 0 )
            {
                $config['upload_path']          = './uploads/fotoUser/';
                $config['allowed_types']        = 'gif|jpg|jpeg|png';
                $config['max_size']             = 35600;
                $config['max_width']            = 0;
                $config['max_height']           = 0;
                $config['remove_space']         = TRUE;

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('image'))
                {
                    $data['upload_error'] = $this->upload->display_errors();

                    $post_image  = '';

                    $this->load->view('admin/tambahUser', $data);
                } else {
                    $img_data = $this->upload->data();
                    $post_image  = $img_data['file_name'];
                }
            } else {
                $post_image  = '';
            }
            $enc_password   = md5($this->input->post('password'));
            $post_data = array(
                'id_skpd'       => $this->input->post('nama_skpd'),
                'id_jenis_user' => $this->input->post('nama_jenis_user'),
                'nama_user'     => $this->input->post('nama_user'),
                'username'      => $this->input->post('username'),
                'password'      => $this->input->post('password'),
                'email'         => $this->input->post('email'),
                'nomor_telepon' => $this->input->post('telp_user'),
                'foto_user'     => $post_image,
                'password'      => $enc_password
            );

            if( empty($data['upload_error']) ) {
                $res = $this->admin_model->insertData($post_data);
                redirect('DataUser');
            }       
        }
    }

    public function edit($id= NULL){
        if(!$this->session->userdata('logged_in')) {
            redirect('Login');
        }elseif ($this->session->userdata('id_jenis_user') != '1') {
            redirect('Login/logout');
        }
        $data3['result'] = $this->admin_model->get_admin_by_id($id);
        $data = $this->admin_model->ambil_data($this->session->userdata['username']);
        $data = array (
            'username' => $data->username,
            'nama_user' => $data->nama_user,
            'id_user' => $data->id_user,
            'foto_user' => $data->foto_user,
        );
        $data2['title'] = 'Edit Data User';
        $data3['skpd'] = $this->admin_model->generate_skpd_dropdown();
        $data3['user'] = $this->db->query("select * from users where id_user = '$id'")->result();
        $data3['level'] = $this->admin_model->generate_level_dropdown();
        $old_image = $data3['result']->foto_user;
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nama_user', 'Nama_user', 'required',
            array(
                'required'      => ' %s harus di isi!',
                'alpha_dash_space'         => ' %s harus di isi hanya dengan huruf!'
            ));
        $this->form_validation->set_rules('nama_skpd', 'SKPD', 'required',
            array(
                'required'      => ' %s harus di isi!'
            ));
            $this->form_validation->set_rules('nama_jenis_user', 'Level', 'required',
            array(
                'required'      => ' %s harus di isi!'
            ));
        $this->form_validation->set_rules('email', 'Email', 'required',
            array(
                'required'      => ' %s harus di isi!'
            ));
        $this->form_validation->set_rules('telp_user', 'Telp ', 'numeric',
            array(
                'numeric'         => ' %s harus di isi hanya dengan angka!'
            ));
        $this->form_validation->set_rules('username', 'Username', 'required',
            array( 
                'required'      => ' %s harus di isi!',
                'is_unique'     => '%s sudah ada',
                'alpha'      => ' %s harus di isi hanya dengan huruf dan tidak boleh menggunakan spasi!'
            ));
        $this->form_validation->set_rules('password', 'Password', 'required|alpha_dash',
            array(
                'required'      => ' %s harus di isi!',
                'alpha_dash'    => ' %s harus di isi hanya dengan huruf, angka, minus dan garis bawah!'
            ));
        $this->form_validation->set_rules('password2', 'Konfirmasi Password', 'required|matches[password]',
            array(
                'required'      => ' %s harus di isi!',
                'matches'       => ' %s salah'
            ));
            
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('Templates/headerAdmin', $data2);
            $this->load->view('Templates/sidebarAdmin', $data);
            $this->load->view('Admin/editUser', $data3);
            $this->load->view('Templates/footerAdmin');
        } 
        else {
            if ( isset($_FILES['image']) && $_FILES['image']['size'] > 0 )
            {
                $config['upload_path']          = './uploads/fotoUser/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 35600;
                $config['max_width']            = 0;
                $config['max_height']           = 0;
                $config['remove_space']         = TRUE;

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('image'))
                {
                    $data['upload_error'] = $this->upload->display_errors();

                    $image = '';

                    $this->load->view('Templates/headerAdmin', $data2);
                    $this->load->view('Templates/sidebarAdmin', $data);
                    $this->load->view('Admin/editUser', $data3);
                    $this->load->view('Templates/footerAdmin');

                } else {

                    if( !empty($old_image) ) {
                        if ( file_exists( './uploads/fotoUser/'.$old_image ) ){
                            unlink( './uploads/fotoUser/'.$old_image );
                        } else {
                            echo 'File tidak ditemukan.';
                        }
                    }

                    $img_data = $this->upload->data();
                    $foto_user = $img_data['file_name'];
                    
                } 
            } else {

                $foto_user = ( !empty($old_image) ) ? $old_image : '';

            } 
            $id_skpd                = $_POST['nama_skpd'];
            $id_jenis_user          = $_POST['nama_jenis_user'];
            $nama_user              = $_POST['nama_user'];
            $email                  = $_POST['email'];
            $nomor_telepon          = $_POST['nomor_telepon'];
            $username               = $_POST['username'];
            $enc_password           = md5($this->input->post('password'));
            
            $data_update    = array(
                'id_skpd'           => $id_skpd,
                'id_jenis_user'     => $id_jenis_user,
                'nama_user'         => $nama_user,
                'email'             => $email,
                'nomor_telepon'     => $nomor_telepon,
                'username'          => $username,
                'password'          => $enc_password,
                'foto_user'         => $foto_user
            );

            if( empty($data['upload_error']) ) {

                $this->admin_model->UpdateData($data_update, $id);
                redirect('DataUser', $data);
            }

        }
    }

    public function delete($id){
        $where  = array('id_user' => $id);
        $res    = $this->admin_model->DeleteData('users',$where);
        if($res>=1){
            $this->session->set_flashdata('pesan','Delete Data Sukses');
            redirect('DataUser');
        }
    }

}

/* End of file DataUser.php */

?>