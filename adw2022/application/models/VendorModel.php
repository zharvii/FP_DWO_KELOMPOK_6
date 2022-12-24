<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class VendorModel extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function count()
    {
        return $this->db->query('select count(VendorID) as jumlah from dim_vendor')->row()->jumlah;
    }

    function data()
    {
        return $this->db->query('select * from dim_vendor')->result();
    }

    function chartVendor($tahun = 'all', $kuarter = 'all', $bulan = 'all')
    {
        // select dv.VendorName ,count(*)  from fact_purchase fp join dim_vendor dv on fp.VendorID =dv.VendorID group by fp.VendorID 

        $sql = "";
        if ($tahun == 'all' && $kuarter == 'all' && $bulan == 'all') {
            $sql = "select dv.VendorName ,sum(fp.PurchaseAmount) as expanses from fact_purchase fp join dim_vendor dv on fp.VendorID =dv.VendorID group by fp.VendorID order by sum(fp.PurchaseAmount) desc limit 5";
        } else  if ($tahun != 'all' && $kuarter == 'all' && $bulan == 'all') {
            $sql = "select dv.VendorName ,sum(fp.PurchaseAmount) as expanses from fact_purchase fp join dim_vendor dv on fp.VendorID =dv.VendorID join dim_time dt on fp.timeID =dt.timeID  where dt.Year ='" . $tahun . "' group by fp.VendorID order by sum(fp.PurchaseAmount) desc limit 5";
        } else  if ($tahun == 'all' && $kuarter != 'all' && $bulan == 'all') {
            $sql = "select dv.VendorName ,sum(fp.PurchaseAmount) as expanses from fact_purchase fp join dim_vendor dv on fp.VendorID =dv.VendorID join dim_time dt on fs.timeID =dt.timeID  where dt.Quarter ='" . $kuarter . "' group by fp.VendorID order by sum(fp.PurchaseAmount) desc limit 5";
        } else  if ($tahun == 'all' && $kuarter == 'all' && $bulan != 'all') {
            $sql = "select dv.VendorName ,sum(fp.PurchaseAmount) as expanses from fact_purchase fp join dim_vendor dv on fp.VendorID =dv.VendorID join dim_time dt on fs.timeID =dt.timeID  where dt.Month ='" . $bulan . "' group by fp.VendorID order by sum(fp.PurchaseAmount) desc limit 5";
        } else  if ($tahun != 'all' && $kuarter != 'all' && $bulan != 'all') {
            $sql = "select dv.VendorName ,sum(fp.PurchaseAmount) as expanses from fact_purchase fp join dim_vendor dv on fp.VendorID =dv.VendorID join dim_time dt on fs.timeID =dt.timeID  where (dt.Year='" . $tahun . "' and dt.Quarter  ='" . $kuarter . "' and dt.Month='" . $bulan . "') group by  fp.VendorID order by sum(fp.PurchaseAmount) desc limit 5";
        } else  if ($tahun != 'all' && $kuarter != 'all' && $bulan == 'all') {
            $sql = "select dv.VendorName ,sum(fp.PurchaseAmount) as expanses from fact_purchase fp join dim_vendor dv on fp.VendorID =dv.VendorID join dim_time dt on fs.timeID =dt.timeID  where (dt.Year='" . $tahun . "' and dt.Quarter  ='" . $kuarter . "') group by fp.VendorID order by sum(fp.PurchaseAmount) desc limit 5";
        } else  if ($tahun != 'all' && $kuarter == 'all' && $bulan != 'all') {
            $sql = "select dv.VendorName ,sum(fp.PurchaseAmount) as expanses from fact_purchase fp join dim_vendor dv on fp.VendorID =dv.VendorID join dim_time dt on fs.timeID =dt.timeID  where (dt.Year='" . $tahun . "'  and dt.Month='" . $bulan . "') group by  fp.VendorID order by sum(fp.PurchaseAmount) desc limit 5";
        } else  if ($tahun == 'all' && $kuarter != 'all' && $bulan != 'all') {
            $sql = "select dv.VendorName ,sum(fp.PurchaseAmount) as expanses from fact_purchase fp join dim_vendor dv on fp.VendorID =dv.VendorID join dim_time dt on fs.timeID =dt.timeID  where (dt.Quarter  ='" . $kuarter . "' and dt.Month='" . $bulan . "')  group by fp.VendorID order by sum(fp.PurchaseAmount) desc limit 5";
        } else {
            $sql = "select dv.VendorName ,sum(fp.PurchaseAmount) as expanses from fact_purchase fp join dim_vendor dv on fp.VendorID =dv.VendorID group by fp.VendorID order by sum(fp.PurchaseAmount) desc limit 5";
        }
        return $this->db->query($sql)->result();
    }
}
