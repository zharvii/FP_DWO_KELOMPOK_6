<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
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
        $this->load->model('SalesModel');
        $this->load->model('PurchaseModel');
        $this->load->model('CustomerModel');
        $this->load->model('TerritoryModel');
        $this->load->model('VendorModel');
        $this->load->model('ProductModel');
    }

    public function index()
    {
        $dt = array();
        // $dt['totalRevenue'] = $this->SalesModel->totalRevenue();
        // $dt['totalExpanses'] = $this->PurchaseModel->totalExpanses();
        $dt['totalCustomer'] = $this->CustomerModel->count();
        $dt['totalTerritory'] = $this->TerritoryModel->count();
        $dt['totalVendor'] = $this->VendorModel->count();
        $dt['totalProduct'] = $this->ProductModel->count();

        if ($this->session->userdata('logged_in')) {
            $this->data['view']    = 'page/dashboard';
            $this->data['param']    = $dt;
            $this->data['js']    = 'dashboard.js';
            $this->load->view('template/default', $this->data);
        } else {
            redirect('Auth');
        }
    }

    public function fakta()
    {
        $tahun = $this->input->post('tahun');
        $kuartal = $this->input->post('kuartal');
        $bulan = $this->input->post('bulan');

        $data1 = $this->SalesModel->totalRevenue($tahun, $kuartal, $bulan);
        $data2 = $this->PurchaseModel->totalExpanses($tahun, $kuartal, $bulan);

        $callback = array('sales' => $data1, 'po' => $data2);
        echo json_encode($callback);
    }
}
