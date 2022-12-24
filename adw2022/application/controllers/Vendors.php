<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Vendors extends CI_Controller
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

        $this->load->model('VendorModel');
    }

    public function index()
    {
        $dt = array();
        $dt['total'] = $this->VendorModel->count();
        $dt['data'] = $this->VendorModel->data();

        // $dt['individualTop'] = $this->CustomerModel->topindividualCustomer();

        if ($this->session->userdata('logged_in')) {
            $this->data['view']    = 'page/vendor';
            $this->data['param']    = $dt;
            $this->data['js']    = 'vendor.js';
            $this->load->view('template/default', $this->data);
        } else {
            redirect('Auth');
        }
    }

    public function vendorChart()
    {
        $tahun = $this->input->post('tahun');
        $kuartal = $this->input->post('kuartal');
        $bulan = $this->input->post('bulan');
        $data = $this->VendorModel->chartVendor($tahun, $kuartal, $bulan);



        $callback = array('vendor' => $data);
        echo json_encode($callback);
    }

    

    // public function topIndividual()
    // {

    //     $data = $this->CustomerModel->topindividualCustomer();



    //     $callback = array('individual' => $data);
    //     echo json_encode($callback);
    // }

    // public function topReseller()
    // {

    //     $data = $this->CustomerModel->topResellerCustomer();



    //     $callback = array('reseller' => $data);
    //     echo json_encode($callback);
    // }
}
