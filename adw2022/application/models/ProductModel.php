<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class ProductModel extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function count()
    {
        return $this->db->query('select count(ProductID) as jumlah from dim_product')->row()->jumlah;
    }

    function topProductSales($tahun = 'all', $kuarter = 'all', $bulan = 'all')
    {
        $sql = "";
        if ($tahun == 'all' && $kuarter == 'all' && $bulan == 'all') {
            $sql = "select dp.ProductName ,sum(fs.Qty) as terjual from fact_sales fs join dim_product dp on fs.ProductID =dp.ProductID group by fs.ProductID order by sum(fs.Qty) desc limit 5";
        } else  if ($tahun != 'all' && $kuarter == 'all' && $bulan == 'all') {
            $sql = "select dp.ProductName ,sum(fs.Qty) as terjual from fact_sales fs join dim_product dp on fs.ProductID =dp.ProductID join dim_time dt on fs.timeID =dt.timeID where dt.`Year` ='" . $tahun . "' and fs.EmployeeID is not null group by fs.ProductID order by sum(fs.Qty) desc limit 5";
        } else  if ($tahun == 'all' && $kuarter != 'all' && $bulan == 'all') {
            $sql = "select dp.ProductName ,sum(fs.Qty) as terjual from fact_sales fs join dim_product dp on fs.ProductID =dp.ProductID join dim_time dt on fs.timeID =dt.timeID where dt.`Quarter` ='" . $kuarter . "'  group by fs.ProductID order by sum(fs.Qty) desc limit 5";
        } else  if ($tahun == 'all' && $kuarter == 'all' && $bulan != 'all') {
            $sql = "select dp.ProductName ,sum(fs.Qty) as terjual from fact_sales fs join dim_product dp on fs.ProductID =dp.ProductID join dim_time dt on fs.timeID =dt.timeID where dt.`Month` ='" . $bulan . "'  group by fs.ProductID order by sum(fs.Qty) desc limit 5";
        } else  if ($tahun != 'all' && $kuarter != 'all' && $bulan != 'all') {
            $sql = "select dp.ProductName ,sum(fs.Qty) as terjual from fact_sales fs join dim_product dp on fs.ProductID =dp.ProductID join dim_time dt on fs.timeID =dt.timeID where (dt.`Year` ='" . $tahun . "' and dt.Quarter='" . $kuarter . "' and dt.Month='" . $bulan . "')  group by fs.ProductID order by sum(fs.Qty) desc limit 5";
        } else  if ($tahun != 'all' && $kuarter != 'all' && $bulan == 'all') {
            $sql = "select dp.ProductName ,sum(fs.Qty) as terjual from fact_sales fs join dim_product dp on fs.ProductID =dp.ProductID join dim_time dt on fs.timeID =dt.timeID where (dt.`Year` ='" . $tahun . "' and dt.Quarter='" . $kuarter . "')  group by fs.ProductID order by sum(fs.Qty) desc limit 5";
        } else  if ($tahun != 'all' && $kuarter == 'all' && $bulan != 'all') {
            $sql = "select dp.ProductName ,sum(fs.Qty) as terjual from fact_sales fs join dim_product dp on fs.ProductID =dp.ProductID join dim_time dt on fs.timeID =dt.timeID where (dt.`Year` ='" . $tahun . "' and dt.`Month` ='" . $bulan . "')  group by fs.ProductID order by sum(fs.Qty) desc limit 5";
        } else  if ($tahun == 'all' && $kuarter != 'all' && $bulan != 'all') {
            $sql = "select dp.ProductName ,sum(fs.Qty) as terjual from fact_sales fs join dim_product dp on fs.ProductID =dp.ProductID join dim_time dt on fs.timeID =dt.timeID where (dt.Quarter  ='" . $kuarter . "' and dt.`Month` ='" . $bulan . "')  group by fs.ProductID order by sum(fs.Qty) desc limit 5";
        } else {
            $sql = "select dp.ProductName ,sum(fs.Qty) as terjual from fact_sales fs join dim_product dp on fs.ProductID =dp.ProductID group by fs.ProductID order by sum(fs.Qty) desc limit 5";
        }
        return $this->db->query($sql)->result();
    }

    function topProductPurchase($tahun = 'all', $kuarter = 'all', $bulan = 'all')
    {
        $sql = "";
        if ($tahun == 'all' && $kuarter == 'all' && $bulan == 'all') {
            $sql = "select dp.ProductName ,sum(fs.Qty) as dibeli from fact_purchase fs join dim_product dp on fs.ProductID =dp.ProductID group by fs.ProductID order by sum(fs.Qty) desc limit 5";
        } else  if ($tahun != 'all' && $kuarter == 'all' && $bulan == 'all') {
            $sql = "select dp.ProductName ,sum(fs.Qty) as dibeli from fact_purchase fs join dim_product dp on fs.ProductID =dp.ProductID join dim_time dt on fs.timeID =dt.timeID where dt.`Year` ='" . $tahun . "' and fs.EmployeeID is not null group by fs.ProductID order by sum(fs.Qty) desc limit 5";
        } else  if ($tahun == 'all' && $kuarter != 'all' && $bulan == 'all') {
            $sql = "select dp.ProductName ,sum(fs.Qty) as dibeli from fact_purchase fs join dim_product dp on fs.ProductID =dp.ProductID join dim_time dt on fs.timeID =dt.timeID where dt.`Quarter` ='" . $kuarter . "'  group by fs.ProductID order by sum(fs.Qty) desc limit 5";
        } else  if ($tahun == 'all' && $kuarter == 'all' && $bulan != 'all') {
            $sql = "select dp.ProductName ,sum(fs.Qty) as dibeli from fact_purchase fs join dim_product dp on fs.ProductID =dp.ProductID join dim_time dt on fs.timeID =dt.timeID where dt.`Month` ='" . $bulan . "'  group by fs.ProductID order by sum(fs.Qty) desc limit 5";
        } else  if ($tahun != 'all' && $kuarter != 'all' && $bulan != 'all') {
            $sql = "select dp.ProductName ,sum(fs.Qty) as dibeli from fact_purchase fs join dim_product dp on fs.ProductID =dp.ProductID join dim_time dt on fs.timeID =dt.timeID where (dt.`Year` ='" . $tahun . "' and dt.Quarter='" . $kuarter . "' and dt.Month='" . $bulan . "')  group by fs.ProductID order by sum(fs.Qty) desc limit 5";
        } else  if ($tahun != 'all' && $kuarter != 'all' && $bulan == 'all') {
            $sql = "select dp.ProductName ,sum(fs.Qty) as dibeli from fact_purchase fs join dim_product dp on fs.ProductID =dp.ProductID join dim_time dt on fs.timeID =dt.timeID where (dt.`Year` ='" . $tahun . "' and dt.Quarter='" . $kuarter . "')  group by fs.ProductID order by sum(fs.Qty) desc limit 5";
        } else  if ($tahun != 'all' && $kuarter == 'all' && $bulan != 'all') {
            $sql = "select dp.ProductName ,sum(fs.Qty) as dibeli from fact_purchase fs join dim_product dp on fs.ProductID =dp.ProductID join dim_time dt on fs.timeID =dt.timeID where (dt.`Year` ='" . $tahun . "' and dt.`Month` ='" . $bulan . "')  group by fs.ProductID order by sum(fs.Qty) desc limit 5";
        } else  if ($tahun == 'all' && $kuarter != 'all' && $bulan != 'all') {
            $sql = "select dp.ProductName ,sum(fs.Qty) as dibeli from fact_purchase fs join dim_product dp on fs.ProductID =dp.ProductID join dim_time dt on fs.timeID =dt.timeID where (dt.Quarter  ='" . $kuarter . "' and dt.`Month` ='" . $bulan . "')  group by fs.ProductID order by sum(fs.Qty) desc limit 5";
        } else {
            $sql = "select dp.ProductName ,sum(fs.Qty) as dibeli from fact_purchase fs join dim_product dp on fs.ProductID =dp.ProductID group by fs.ProductID order by sum(fs.Qty) desc limit 5";
        }
        return $this->db->query($sql)->result();
    }

    // function kategori($tahun = 'all', $kuarter = 'all', $bulan = 'all')
    // {
    //     $sql = "";
    //     if ($tahun == 'all' && $kuarter == 'all' && $bulan == 'all') {
    //         $sql = "select dp.Category,sum(fs.Qty) as terjual,round(((count(dp.ProductID)*100)/s.total ))  as persen  from fact_sales fs join dim_product dp on fs.ProductID =dp.ProductID cross join (select count(*) as total from fact_sales) s group  by dp.Category ";
    //     } else  if ($tahun != 'all' && $kuarter == 'all' && $bulan == 'all') {
    //         $sql = "select dp.Category,sum(fs.Qty) as terjual,round(((count(dp.ProductID)*100)/s.total ))  as persen  from fact_sales fs join dim_product dp on fs.ProductID =dp.ProductID join dim_time dt on fs.timeID =dt.timeID cross join (select count(*) as total from fact_sales f join dim_time t on f.timeID =t.timeID where t.Year ='" . $tahun . "') s where dt.Year ='" . $tahun . "' group  by dp.Category ";
    //     } else  if ($tahun == 'all' && $kuarter != 'all' && $bulan == 'all') {
    //         $sql = "select dp.Category,sum(fs.Qty) as terjual,round(((count(dp.ProductID)*100)/s.total ))  as persen  from fact_sales fs join dim_product dp on fs.ProductID =dp.ProductID join dim_time dt on fs.timeID =dt.timeID cross join (select count(*) as total from fact_sales f join dim_time t on f.timeID =t.timeID where t.Quarter ='" . $kuarter . "') s where dt.Quarter ='" . $kuarter . "' group  by dp.Category ";
    //     } else  if ($tahun == 'all' && $kuarter == 'all' && $bulan != 'all') {
    //         $sql = "select dp.Category,sum(fs.Qty) as terjual,round(((count(dp.ProductID)*100)/s.total ))  as persen  from fact_sales fs join dim_product dp on fs.ProductID =dp.ProductID join dim_time dt on fs.timeID =dt.timeID cross join (select count(*) as total from fact_sales f join dim_time t on f.timeID =t.timeID where t.Month ='" . $bulan . "') s where dt.Month ='" . $bulan . "' group  by dp.Category ";
    //     } else  if ($tahun != 'all' && $kuarter != 'all' && $bulan != 'all') {
    //         $sql = "select dp.Category,sum(fs.Qty) as terjual,round(((count(dp.ProductID)*100)/s.total ))  as persen  from fact_sales fs join dim_product dp on fs.ProductID =dp.ProductID join dim_time dt on fs.timeID =dt.timeID cross join (select count(*) as total from fact_sales f join dim_time t on f.timeID =t.timeID where (t.Year='" . $tahun . "' and t.Quarter  ='" . $kuarter . "' and t.Month='" . $bulan . "')) s where (dt.Year='" . $tahun . "' and dt.Quarter  ='" . $kuarter . "' and dt.Month='" . $bulan . "') group  by dp.Category ";
    //     } else  if ($tahun != 'all' && $kuarter != 'all' && $bulan == 'all') {
    //         $sql = "select dp.Category,sum(fs.Qty) as terjual,round(((count(dp.ProductID)*100)/s.total ))  as persen  from fact_sales fs join dim_product dp on fs.ProductID =dp.ProductID join dim_time dt on fs.timeID =dt.timeID cross join (select count(*) as total from fact_sales f join dim_time t on f.timeID =t.timeID where (t.Year='" . $tahun . "' and t.Quarter  ='" . $kuarter . "')) s where (dt.Year='" . $tahun . "' and dt.Quarter  ='" . $kuarter . "') group  by dp.Category ";
    //     } else  if ($tahun != 'all' && $kuarter == 'all' && $bulan != 'all') {
    //         $sql = "select dp.Category,sum(fs.Qty) as terjual,round(((count(dp.ProductID)*100)/s.total ))  as persen  from fact_sales fs join dim_product dp on fs.ProductID =dp.ProductID join dim_time dt on fs.timeID =dt.timeID cross join (select count(*) as total from fact_sales f join dim_time t on f.timeID =t.timeID where (t.Year='" . $tahun . "'  and t.Month='" . $bulan . "')) s where (dt.Year='" . $tahun . "'  and dt.Month='" . $bulan . "') group  by dp.Category ";
    //     } else  if ($tahun == 'all' && $kuarter != 'all' && $bulan != 'all') {
    //         $sql = "select dp.Category,sum(fs.Qty) as terjual,round(((count(dp.ProductID)*100)/s.total ))  as persen  from fact_sales fs join dim_product dp on fs.ProductID =dp.ProductID join dim_time dt on fs.timeID =dt.timeID cross join (select count(*) as total from fact_sales f join dim_time t on f.timeID =t.timeID where (t.Quarter  ='" . $kuarter . "' and t.Month='" . $bulan . "')) s where (dt.Quarter  ='" . $kuarter . "' and dt.Month='" . $bulan . "') group  by dp.Category ";
    //     } else {
    //         $sql = "select dp.Category,sum(fs.Qty) as terjual,round(((count(dp.ProductID)*100)/s.total ))  as persen  from fact_sales fs join dim_product dp on fs.ProductID =dp.ProductID cross join (select count(*) as total from fact_sales) s group  by dp.Category ";
    //     }
    //     return $this->db->query($sql)->result();
    // }



    // function subKategori($tahun = 'all', $kuarter = 'all', $bulan = 'all', $kat = '')
    // {
    //     $sql = "";
    //     if ($tahun == 'all' && $kuarter == 'all' && $bulan == 'all') {
    //         $sql = "select dp.SubCategory,sum(fs.Qty) as terjual,round(((count(dp.ProductID)*100)/s.total ))  as persen  from fact_sales fs join dim_product dp on fs.ProductID =dp.ProductID cross join (select count(*) as total from fact_sales f join dim_product p on f.ProductID=p.ProductID where   p.Category='" . $kat . "') s  where   dp.Category='" . $kat . "' group  by dp.SubCategory ";
    //     } else  if ($tahun != 'all' && $kuarter == 'all' && $bulan == 'all') {
    //         $sql = "select dp.SubCategory,sum(fs.Qty) as terjual,round(((count(dp.ProductID)*100)/s.total ))  as persen  from fact_sales fs join dim_product dp on fs.ProductID =dp.ProductID join dim_time dt on fs.timeID =dt.timeID cross join (select count(*) as total from fact_sales  f join dim_product p on f.ProductID=p.ProductID  join dim_time t on f.timeID =t.timeID where t.Year ='" . $tahun . "' and  p.Category='" . $kat . "') s where dt.Year ='" . $tahun . "' and   dp.Category='" . $kat . "' group  by dp.SubCategory ";
    //     } else  if ($tahun == 'all' && $kuarter != 'all' && $bulan == 'all') {
    //         $sql = "select dp.SubCategory,sum(fs.Qty) as terjual,round(((count(dp.ProductID)*100)/s.total ))  as persen  from fact_sales fs join dim_product dp on fs.ProductID =dp.ProductID join dim_time dt on fs.timeID =dt.timeID cross join (select count(*) as total from fact_sales f join dim_product p on f.ProductID=p.ProductID join dim_time t on f.timeID =t.timeID where t.Quarter ='" . $kuarter . "' and  p.Category='" . $kat . "') s where dt.Quarter ='" . $kuarter . "' and   dp.Category='" . $kat . "' group  by dp.SubCategory ";
    //     } else  if ($tahun == 'all' && $kuarter == 'all' && $bulan != 'all') {
    //         $sql = "select dp.SubCategory,sum(fs.Qty) as terjual,round(((count(dp.ProductID)*100)/s.total ))  as persen  from fact_sales fs join dim_product dp on fs.ProductID =dp.ProductID join dim_time dt on fs.timeID =dt.timeID cross join (select count(*) as total from fact_sales f join dim_product p on f.ProductID=p.ProductID join dim_time t on f.timeID =t.timeID where t.Month ='" . $bulan . "' and  p.Category='" . $kat . "') s where dt.Month ='" . $bulan . "' and   dp.Category='" . $kat . "' group  by dp.SubCategory ";
    //     } else  if ($tahun != 'all' && $kuarter != 'all' && $bulan != 'all') {
    //         $sql = "select dp.SubCategory,sum(fs.Qty) as terjual,round(((count(dp.ProductID)*100)/s.total ))  as persen  from fact_sales fs join dim_product dp on fs.ProductID =dp.ProductID join dim_time dt on fs.timeID =dt.timeID cross join (select count(*) as total from fact_sales f join dim_product p on f.ProductID=p.ProductID join dim_time t on f.timeID =t.timeID where (t.Year='" . $tahun . "' and t.Quarter  ='" . $kuarter . "' and t.Month='" . $bulan . "') and  p.Category='" . $kat . "') s where (dt.Year='" . $tahun . "' and dt.Quarter  ='" . $kuarter . "' and dt.Month='" . $bulan . "') and   dp.Category='" . $kat . "' group  by dp.SubCategory ";
    //     } else  if ($tahun != 'all' && $kuarter != 'all' && $bulan == 'all') {
    //         $sql = "select dp.SubCategory,sum(fs.Qty) as terjual,round(((count(dp.ProductID)*100)/s.total ))  as persen  from fact_sales fs join dim_product dp on fs.ProductID =dp.ProductID join dim_time dt on fs.timeID =dt.timeID cross join (select count(*) as total from fact_sales f join dim_product p on f.ProductID=p.ProductID join dim_time t on f.timeID =t.timeID where (t.Year='" . $tahun . "' and t.Quarter  ='" . $kuarter . "') and  p.Category='" . $kat . "') s where (dt.Year='" . $tahun . "' and dt.Quarter  ='" . $kuarter . "') and   dp.Category='" . $kat . "' group  by dp.SubCategory ";
    //     } else  if ($tahun != 'all' && $kuarter == 'all' && $bulan != 'all') {
    //         $sql = "select dp.SubCategory,sum(fs.Qty) as terjual,round(((count(dp.ProductID)*100)/s.total ))  as persen  from fact_sales fs join dim_product dp on fs.ProductID =dp.ProductID join dim_time dt on fs.timeID =dt.timeID cross join (select count(*) as total from fact_sales f join dim_product p on f.ProductID=p.ProductID join dim_time t on f.timeID =t.timeID where (t.Year='" . $tahun . "'  and t.Month='" . $bulan . "') and  p.Category='" . $kat . "') s where (dt.Year='" . $tahun . "'  and dt.Month='" . $bulan . "') and   dp.Category='" . $kat . "' group  by dp.SubCategory ";
    //     } else  if ($tahun == 'all' && $kuarter != 'all' && $bulan != 'all') {
    //         $sql = "select dp.SubCategory,sum(fs.Qty) as terjual,round(((count(dp.ProductID)*100)/s.total ))  as persen  from fact_sales fs join dim_product dp on fs.ProductID =dp.ProductID join dim_time dt on fs.timeID =dt.timeID cross join (select count(*) as total from fact_sales f join dim_product p on f.ProductID=p.ProductID join dim_time t on f.timeID =t.timeID where (t.Quarter  ='" . $kuarter . "' and t.Month='" . $bulan . "') and  p.Category='" . $kat . "') s where (dt.Quarter  ='" . $kuarter . "' and dt.Month='" . $bulan . "') and   dp.Category='" . $kat . "' group  by dp.SubCategory ";
    //     } else {
    //         $sql = "select dp.SubCategory,sum(fs.Qty) as terjual,round(((count(dp.ProductID)*100)/s.total ))  as persen  from fact_sales fs join dim_product dp on fs.ProductID =dp.ProductID cross join (select count(*) as total from fact_sales f join dim_product p on f.ProductID=p.ProductID where   p.Category='" . $kat . "') s  where   dp.Category='" . $kat . "' group  by dp.SubCategory ";
    //     }
    //     return $this->db->query($sql)->result();
    // }


    function kategori()
    {
        $sql = "select dp.Category,count(*) as jumlah,round(((count(dp.ProductID)*100)/s.total ))  as persen  from  dim_product dp  cross join (select count(*) as total from dim_product) s group  by dp.Category ";
        return $this->db->query($sql)->result();
    }

    function subKategori($kat = '')
    {
        $sql = "select dp.SubCategory,count(*) as jumlah,round(((count(dp.ProductID)*100)/s.total ))  as persen  from dim_product dp  cross join (select count(*) as total from dim_product p where   p.Category='" . $kat . "') s  where   dp.Category='" . $kat . "' group  by dp.SubCategory ";

        return $this->db->query($sql)->result();
    }
}
