<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk extends CI_Controller
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

        $this->load->model('ProductModel');
    }

    public function index()
    {
        $dt = array();
        $dt['totalProduk'] = $this->ProductModel->count();


        if ($this->session->userdata('logged_in')) {
            $this->data['view']    = 'page/produk';
            $this->data['param']    = $dt;
            $this->data['js']    = 'produk.js';
            $this->load->view('template/default', $this->data);
        } else {
            redirect('Auth');
        }
    }



    public function topProdukSales()
    {
        $tahun = $this->input->post('tahun');
        $kuartal = $this->input->post('kuartal');
        $bulan = $this->input->post('bulan');

        $data = $this->ProductModel->topProductSales($tahun, $kuartal, $bulan);



        $callback = array('product' => $data);
        echo json_encode($callback);
    }

    public function topProdukPurchase()
    {
        $tahun = $this->input->post('tahun');
        $kuartal = $this->input->post('kuartal');
        $bulan = $this->input->post('bulan');

        $data = $this->ProductModel->topProductPurchase($tahun, $kuartal, $bulan);



        $callback = array('product' => $data);
        echo json_encode($callback);
    }

    public function categorySales()
    {

        $data = $this->ProductModel->kategori();
        $kategori = array();

        foreach ($data as $g) {
            $obj = new stdClass;
            $obj->group = $g->Category;
            $obj->total = (float)$g->persen;
            $obj->jumlah = (int) $g->jumlah;
            $drill = array();
            $sub = $this->ProductModel->subKategori($g->Category);

            foreach ($sub as $t) {
                $objsub = new stdClass;
                $objsub->name = $t->SubCategory;
                $objsub->y = (float)$t->persen;
                $objsub->custom = (int) $t->jumlah;
                array_push($drill, $objsub);
            }

            $obj->drill = $drill;
            array_push($kategori, $obj);
        }
        echo json_encode($kategori);
        // $drill = array();



        // $callback = array('group' => $data);
        // echo json_encode($callback);
    }
}
