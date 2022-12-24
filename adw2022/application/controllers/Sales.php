<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sales extends CI_Controller
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
    }

    public function index()
    {
        $dt = array();
        $dt['revenue'] = $this->SalesModel->totalRevenue();
        $dt['total'] = $this->SalesModel->count();


        if ($this->session->userdata('logged_in')) {
            $this->data['view']    = 'page/sales';
            $this->data['param']    = $dt;
            $this->data['js']    = 'sales.js';
            $this->load->view('template/default', $this->data);
        } else {
            redirect('Auth');
        }
    }



    public function salesType()
    {
        $tahun = $this->input->post('tahun');
        $kuartal = $this->input->post('kuartal');
        $bulan = $this->input->post('bulan');

        $data = $this->SalesModel->salesType($tahun, $kuartal, $bulan);

        $callback = array('data' => $data);
        echo json_encode($callback);
    }

    public function salesRev()
    {

        $data = $this->SalesModel->salesTahun();
        $tahun = array();

        foreach ($data as $g) {
            $obj = new stdClass;
            $obj->tahun = $g->Year;
            $obj->total = (int)$g->revenue;
            $drill = array();
            $bulan = $this->SalesModel->salesBulan($g->Year);

            foreach ($bulan as $t) {
                $month_name = date("F", mktime(0, 0, 0, (int) $t->Month, 10));

                array_push($drill, [$month_name, (int)$t->revenue]);
            }

            $obj->drill = $drill;
            array_push($tahun, $obj);
        }
        echo json_encode($tahun);
    }

    public function salesTrend()
    {

        $data = $this->SalesModel->salesTrendTahun();
        $tahun = array();

        foreach ($data as $g) {
            $obj = new stdClass;
            $obj->tahun = $g->Year;
            $obj->total = (int)$g->trend;
            $drill = array();
            $bulan = $this->SalesModel->salesTrendBulan($g->Year);

            foreach ($bulan as $t) {
                $month_name = date("F", mktime(0, 0, 0, (int) $t->Month, 10));

                array_push($drill, [$month_name, (int)$t->trend]);
            }

            $obj->drill = $drill;
            array_push($tahun, $obj);
        }
        echo json_encode($tahun);
    }
}
