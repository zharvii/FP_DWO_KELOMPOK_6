<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Purchase extends CI_Controller
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

        $this->load->model('PurchaseModel');
    }

    public function index()
    {
        $dt = array();
        $dt['total'] = $this->PurchaseModel->totalExpanses();
        $dt['avg'] = $this->PurchaseModel->avgExpanses();


        if ($this->session->userdata('logged_in')) {
            $this->data['view']    = 'page/purchase';
            $this->data['param']    = $dt;
            $this->data['js']    = 'purchase.js';
            $this->load->view('template/default', $this->data);
        } else {
            redirect('Auth');
        }
    }

    public function purEx()
    {

        $data = $this->PurchaseModel->purchaseTahun();
        $tahun = array();

        foreach ($data as $g) {
            $obj = new stdClass;
            $obj->tahun = $g->Year;
            $obj->total = (int)$g->expanses;
            $drill = array();
            $bulan = $this->PurchaseModel->purchaseBulan($g->Year);

            foreach ($bulan as $t) {
                $month_name = date("F", mktime(0, 0, 0, (int) $t->Month, 10));

                array_push($drill, [$month_name, (int)$t->expanses]);
            }

            $obj->drill = $drill;
            array_push($tahun, $obj);
        }
        echo json_encode($tahun);
    }

    public function purAvg()
    {

        $data = $this->PurchaseModel->avgTahun();
        $tahun = array();

        foreach ($data as $g) {
            $obj = new stdClass;
            $obj->tahun = $g->Year;
            $obj->total = (int)$g->rata;
            $drill = array();
            $bulan = $this->PurchaseModel->avgBulan($g->Year);

            foreach ($bulan as $t) {
                $month_name = date("F", mktime(0, 0, 0, (int) $t->Month, 10));

                array_push($drill, [$month_name, (int)$t->rata]);
            }

            $obj->drill = $drill;
            array_push($tahun, $obj);
        }
        echo json_encode($tahun);
    }
}
