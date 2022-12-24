<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Territory extends CI_Controller
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

        $this->load->model('TerritoryModel');
    }

    public function index()
    {
        $dt = array();
        $dt['total'] = $this->TerritoryModel->count();
        $dt['data'] = $this->TerritoryModel->data();
        // $dt['individualTop'] = $this->CustomerModel->topindividualCustomer();

        if ($this->session->userdata('logged_in')) {
            $this->data['view']    = 'page/territory';
            $this->data['param']    = $dt;
            $this->data['js']    = 'territory.js';
            $this->load->view('template/default', $this->data);
        } else {
            redirect('Auth');
        }
    }

    public function salesTerritory()
    {
        $tahun = $this->input->post('tahun');
        $kuartal = $this->input->post('kuartal');
        $bulan = $this->input->post('bulan');
        $data = $this->TerritoryModel->chartGroup($tahun, $kuartal, $bulan);
        $group = array();

        foreach ($data as $g) {
            $obj = new stdClass;
            $obj->group = $g->groups;
            $obj->total = (float)$g->persen;
            $drill = array();
            $tery = $this->TerritoryModel->chartTerritory($tahun, $kuartal, $bulan, $g->groups);

            foreach ($tery as $t) {
                array_push($drill, [$t->Territory, (float)$t->persen]);
            }

            $obj->drill = $drill;
            array_push($group, $obj);
        }
        echo json_encode($group);
        // $drill = array();



        // $callback = array('group' => $data);
        // echo json_encode($callback);
    }

   
}
