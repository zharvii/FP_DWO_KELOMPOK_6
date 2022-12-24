<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer extends CI_Controller
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

        $this->load->model('CustomerModel');
    }

    public function index()
    {
        $dt = array();
        $dt['totalCustomer'] = $this->CustomerModel->count();
        $dt['totalAktif'] = $this->CustomerModel->countCustomerActive();
        // $dt['individualTop'] = $this->CustomerModel->topindividualCustomer();

        if ($this->session->userdata('logged_in')) {
            $this->data['view']    = 'page/customer';
            $this->data['param']    = $dt;
            $this->data['js']    = 'customer.js';
            $this->load->view('template/default', $this->data);
        } else {
            redirect('Auth');
        }
    }

    public function jenisCustomer()
    {

        $data = $this->CustomerModel->customerType();



        $callback = array('tipe' => $data);
        echo json_encode($callback);
    }

    public function topIndividual()
    {
        $tahun = $this->input->post('tahun');
        $kuartal = $this->input->post('kuartal');
        $bulan = $this->input->post('bulan');
        $data = $this->CustomerModel->topindividualCustomer($tahun, $kuartal, $bulan);



        $callback = array('individual' => $data);
        echo json_encode($callback);
    }

    public function topReseller()
    {
        $tahun = $this->input->post('tahun');
        $kuartal = $this->input->post('kuartal');
        $bulan = $this->input->post('bulan');
        $data = $this->CustomerModel->topResellerCustomer($tahun, $kuartal, $bulan);



        $callback = array('reseller' => $data);
        echo json_encode($callback);
    }
}
