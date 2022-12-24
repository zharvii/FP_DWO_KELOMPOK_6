<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class PurchaseModel extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function totalExpanses($tahun = 'all', $kuarter = 'all', $bulan = 'all')
    {
        $sql = "";
        if ($tahun == 'all' && $kuarter == 'all' && $bulan == 'all') {
            $sql = "select sum(PurchaseAmount) as total from fact_purchase fs";
        } else  if ($tahun != 'all' && $kuarter == 'all' && $bulan == 'all') {
            $sql = "select sum(PurchaseAmount) as total from fact_purchase fs join dim_time dt on fs.timeID =dt.timeID where dt.`Year` ='" . $tahun . "'";
        } else  if ($tahun == 'all' && $kuarter != 'all' && $bulan == 'all') {
            $sql = "select sum(PurchaseAmount) as total from fact_purchase fs join dim_time dt on fs.timeID =dt.timeID where dt.`Quarter` ='" . $kuarter . "'";
        } else  if ($tahun == 'all' && $kuarter == 'all' && $bulan != 'all') {
            $sql = "select sum(PurchaseAmount) as total from fact_purchase fs join dim_time dt on fs.timeID =dt.timeID where dt.`Month` ='" . $bulan . "'";
        } else  if ($tahun != 'all' && $kuarter != 'all' && $bulan != 'all') {
            $sql = "select sum(PurchaseAmount) as total from fact_purchase fs join dim_time dt on fs.timeID =dt.timeID where (dt.Year='" . $tahun . "' and dt.Quarter  ='" . $kuarter . "' and dt.Month='" . $bulan . "')";
        } else  if ($tahun != 'all' && $kuarter != 'all' && $bulan == 'all') {
            $sql = "select sum(PurchaseAmount) as total from fact_purchase fs join dim_time dt on fs.timeID =dt.timeID where (dt.Year='" . $tahun . "' and dt.Quarter  ='" . $kuarter . "')";
        } else  if ($tahun != 'all' && $kuarter == 'all' && $bulan != 'all') {
            $sql = "select sum(PurchaseAmount) as total from fact_purchase fs join dim_time dt on fs.timeID =dt.timeID where (dt.Quarter  ='" . $kuarter . "' and dt.Month='" . $bulan . "')";
        } else  if ($tahun == 'all' && $kuarter != 'all' && $bulan != 'all') {
            $sql = "select sum(PurchaseAmount) as total from fact_purchase fs join dim_time dt on fs.timeID =dt.timeID where (dt.Quarter  ='" . $kuarter . "' and dt.Month='" . $bulan . "')";
        } else {
            $sql = "select sum(PurchaseAmount) as total from fact_purchase fs";
        }
        return $this->db->query($sql)->row()->total;
    }

    function avgExpanses()
    {
        return $this->db->query('select avg(PurchaseAmount) as rata from fact_purchase')->row()->rata;
    }

    function purchaseTahun()
    {
        $sql = "select dt.`Year` ,sum(fs.PurchaseAmount) as expanses from fact_purchase  fs join dim_time dt ON fs.timeID =dt.timeID group by dt.`Year`";

        return $this->db->query($sql)->result();
    }

    function purchaseBulan($tahun)
    {
        $sql = "select dt.`Month`,sum(fs.PurchaseAmount) as expanses  from fact_purchase  fs join dim_time dt ON fs.timeID =dt.timeID where dt.`Year` ='" . $tahun . "' group by dt.`Month` ";
        return $this->db->query($sql)->result();
    }

    function avgTahun()
    {
        $sql = "select dt.`Year` ,avg(fs.PurchaseAmount) as rata from fact_purchase  fs join dim_time dt ON fs.timeID =dt.timeID group by dt.`Year`";

        return $this->db->query($sql)->result();
    }

    function avgBulan($tahun)
    {
        $sql = "select dt.`Month`,avg(fs.PurchaseAmount) as rata  from fact_purchase  fs join dim_time dt ON fs.timeID =dt.timeID where dt.`Year` ='" . $tahun . "' group by dt.`Month` ";
        return $this->db->query($sql)->result();
    }
}
