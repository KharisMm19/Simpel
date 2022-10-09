<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function index()
    {
        $data['title'] = 'Selamat Datang di Sistem Informasi Penyelesaian Tindak Lanjut';
        $this->load->view('Templates/headerDashboard', $data);
        $this->load->view('dashboard');
        $this->load->view('Templates/footerDashboard');
    }

}

/* End of file Dashboard.php */

?>