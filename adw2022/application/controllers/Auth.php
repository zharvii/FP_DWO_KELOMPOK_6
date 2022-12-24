<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */

    function __construct()
    {
        parent::__construct();
        $this->load->model('AuthModel');
    }

    public function index()
    {
        if ($this->session->userdata('logged_in')) {
            redirect('Dashboard');
        } else {
            $this->data['view']    = 'page/login';
            $this->data['param']    = '';
            $this->data['js']    = 'login.js';
            $this->load->view('template/empty', $this->data);
        }
    }

    public function login()
    {
        $uname   = $this->input->post('user', TRUE);
        $password = $this->input->post('pass', TRUE);
        $validate = $this->AuthModel->validate($uname, $password);


        if ($validate == "UserNotFund") {
            echo "<script>javascript:alert('Username Tidak Terdaftar'); window.location = '" . base_url('Auth') . "'</script>";
        } else if ($validate == "PasswordWrong") {
            echo "<script>javascript:alert('Password Salah'); window.location = '" . base_url('Auth') . "'</script>";
        } else {
            $sesdata = array(
                'id' => $validate->userid,
                'username' => $validate->username,
                'logged_in' => TRUE
            );
            $this->session->set_userdata($sesdata);
            echo "<script>javascript:alert('Login Sukses, Selamat Datang " . $validate->username . "'); window.location = '" . base_url('Dashboard') . "'</script>";
        }
    }

    function logout()
    {
        $this->session->sess_destroy();
        redirect('Dashboard');
    }
}
