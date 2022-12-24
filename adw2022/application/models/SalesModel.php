<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class SalesModel extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function totalRevenue($tahun = 'all', $kuarter = 'all', $bulan = 'all')
    {
        $sql = "";
        if ($tahun == 'all' && $kuarter == 'all' && $bulan == 'all') {
            $sql = "select sum(SalesAmount) as total from fact_sales fs";
        } else  if ($tahun != 'all' && $kuarter == 'all' && $bulan == 'all') {
            $sql = "select sum(SalesAmount) as total from fact_sales fs join dim_time dt on fs.timeID =dt.timeID where dt.`Year` ='" . $tahun . "'";
        } else  if ($tahun == 'all' && $kuarter != 'all' && $bulan == 'all') {
            $sql = "select sum(SalesAmount) as total from fact_sales fs join dim_time dt on fs.timeID =dt.timeID where dt.`Quarter` ='" . $kuarter . "'";
        } else  if ($tahun == 'all' && $kuarter == 'all' && $bulan != 'all') {
            $sql = "select sum(SalesAmount) as total from fact_sales fs join dim_time dt on fs.timeID =dt.timeID where dt.`Month` ='" . $bulan . "'";
        } else  if ($tahun != 'all' && $kuarter != 'all' && $bulan != 'all') {
            $sql = "select sum(SalesAmount) as total from fact_sales fs join dim_time dt on fs.timeID =dt.timeID where (dt.Year='" . $tahun . "' and dt.Quarter  ='" . $kuarter . "' and dt.Month='" . $bulan . "')";
        } else  if ($tahun != 'all' && $kuarter != 'all' && $bulan == 'all') {
            $sql = "select sum(SalesAmount) as total from fact_sales fs join dim_time dt on fs.timeID =dt.timeID where (dt.Year='" . $tahun . "' and dt.Quarter  ='" . $kuarter . "')";
        } else  if ($tahun != 'all' && $kuarter == 'all' && $bulan != 'all') {
            $sql = "select sum(SalesAmount) as total from fact_sales fs join dim_time dt on fs.timeID =dt.timeID where (dt.Quarter  ='" . $kuarter . "' and dt.Month='" . $bulan . "')";
        } else  if ($tahun == 'all' && $kuarter != 'all' && $bulan != 'all') {
            $sql = "select sum(SalesAmount) as total from fact_sales fs join dim_time dt on fs.timeID =dt.timeID where (dt.Quarter  ='" . $kuarter . "' and dt.Month='" . $bulan . "')";
        } else {
            $sql = "select sum(SalesAmount) as total from fact_sales fs";
        }
        return $this->db->query($sql)->row()->total;
    }

    function count()
    {
        return $this->db->query('select count(distinct  fs.SalesOrderNumber) as total from fact_sales fs')->row()->total;
    }

    function salesType($tahun = 'all', $kuarter = 'all', $bulan = 'all')
    {
        $sql = "";
        if ($tahun == 'all' && $kuarter == 'all' && $bulan == 'all') {
            $sql = "select if (dc.`type` ='Individual','Online Sales','Reseller Sales') as tipe  ,count(*) as jumlah,round(((count(dc.CustomerID)*100)/s.total )) as persen  from fact_sales fs join dim_customer dc on fs.CustomerID =dc.CustomerID  cross join (select count(*) as total from fact_sales) s group by dc.`type`";
        } else  if ($tahun != 'all' && $kuarter == 'all' && $bulan == 'all') {
            $sql = "select if (dc.`type` ='Individual','Online Sales','Reseller Sales') as tipe  ,count(*) as jumlah,round(((count(dc.CustomerID)*100)/s.total )) as persen  from fact_sales fs join dim_customer dc on fs.CustomerID =dc.CustomerID join dim_time dt on fs.timeID =dt.timeID  cross join (select count(*) as total from fact_sales f join dim_time t on f.timeID =t.timeID where t.`Year`='" . $tahun . "') s where dt.`Year` ='" . $tahun . "' group by dc.`type`";
        } else  if ($tahun == 'all' && $kuarter != 'all' && $bulan == 'all') {
            $sql = "select if (dc.`type` ='Individual','Online Sales','Reseller Sales') as tipe  ,count(*) as jumlah,round(((count(dc.CustomerID)*100)/s.total )) as persen  from fact_sales fs join dim_customer dc on fs.CustomerID =dc.CustomerID join dim_time dt on fs.timeID =dt.timeID  cross join (select count(*) as total from fact_sales f join dim_time t on f.timeID =t.timeID where t.`Quarter`='" . $kuarter . "') s where dt.`Quarter` ='" . $kuarter . "' group by dc.`type`";
        } else  if ($tahun == 'all' && $kuarter == 'all' && $bulan != 'all') {
            $sql = "select if (dc.`type` ='Individual','Online Sales','Reseller Sales') as tipe  ,count(*) as jumlah,round(((count(dc.CustomerID)*100)/s.total )) as persen  from fact_sales fs join dim_customer dc on fs.CustomerID =dc.CustomerID join dim_time dt on fs.timeID =dt.timeID  cross join (select count(*) as total from fact_sales f join dim_time t on f.timeID =t.timeID where t.`Month`='" . $bulan . "') s where dt.`Month` ='" . $bulan . "' group by dc.`type`";
        } else  if ($tahun != 'all' && $kuarter != 'all' && $bulan != 'all') {
            $sql = "select if (dc.`type` ='Individual','Online Sales','Reseller Sales') as tipe  ,count(*) as jumlah,round(((count(dc.CustomerID)*100)/s.total )) as persen  from fact_sales fs join dim_customer dc on fs.CustomerID =dc.CustomerID join dim_time dt on fs.timeID =dt.timeID  cross join (select count(*) as total from fact_sales f join dim_time t on f.timeID =t.timeID where (t.Year='" . $tahun . "' and t.Quarter  ='" . $kuarter . "' and t.Month='" . $bulan . "')) s where (dt.Year='" . $tahun . "' and dt.Quarter  ='" . $kuarter . "' and dt.Month='" . $bulan . "') group by dc.`type`";
        } else  if ($tahun != 'all' && $kuarter != 'all' && $bulan == 'all') {
            $sql = "select if (dc.`type` ='Individual','Online Sales','Reseller Sales') as tipe  ,count(*) as jumlah,round(((count(dc.CustomerID)*100)/s.total )) as persen  from fact_sales fs join dim_customer dc on fs.CustomerID =dc.CustomerID join dim_time dt on fs.timeID =dt.timeID  cross join (select count(*) as total from fact_sales f join dim_time t on f.timeID =t.timeID where (t.Year='" . $tahun . "' and t.Quarter  ='" . $kuarter . "')) s where (dt.Year='" . $tahun . "' and dt.Quarter  ='" . $kuarter . "') group by dc.`type`";
        } else  if ($tahun != 'all' && $kuarter == 'all' && $bulan != 'all') {
            $sql = "select if (dc.`type` ='Individual','Online Sales','Reseller Sales') as tipe  ,count(*) as jumlah,round(((count(dc.CustomerID)*100)/s.total )) as persen  from fact_sales fs join dim_customer dc on fs.CustomerID =dc.CustomerID join dim_time dt on fs.timeID =dt.timeID  cross join (select count(*) as total from fact_sales f join dim_time t on f.timeID =t.timeID where (t.Year='" . $tahun . "'  and t.Month='" . $bulan . "')) s where (dt.Year='" . $tahun . "'  and dt.Month='" . $bulan . "') group by dc.`type`";
        } else  if ($tahun == 'all' && $kuarter != 'all' && $bulan != 'all') {
            $sql = "select if (dc.`type` ='Individual','Online Sales','Reseller Sales') as tipe  ,count(*) as jumlah,round(((count(dc.CustomerID)*100)/s.total )) as persen  from fact_sales fs join dim_customer dc on fs.CustomerID =dc.CustomerID join dim_time dt on fs.timeID =dt.timeID  cross join (select count(*) as total from fact_sales f join dim_time t on f.timeID =t.timeID where (t.Quarter  ='" . $kuarter . "' and t.Month='" . $bulan . "')) s where (dt.Quarter  ='" . $kuarter . "' and dt.Month='" . $bulan . "') group by dc.`type`";
        } else {
            $sql = "select if (dc.`type` ='Individual','Online Sales','Reseller Sales') as tipe  ,count(*) as jumlah,round(((count(dc.CustomerID)*100)/s.total )) as persen  from fact_sales fs join dim_customer dc on fs.CustomerID =dc.CustomerID  cross join (select count(*) as total from fact_sales) s group by dc.`type`";
        }
        return $this->db->query($sql)->result();
    }

    function salesTahun()
    {
        $sql = "select dt.`Year` ,sum(fs.SalesAmount) as revenue from fact_sales fs join dim_time dt ON fs.timeID =dt.timeID group by dt.`Year` ";

        return $this->db->query($sql)->result();
    }

    function salesBulan($tahun)
    {
        $sql = "select dt.`Month`,sum(fs.SalesAmount) as revenue  from fact_sales fs join dim_time dt ON fs.timeID =dt.timeID where dt.`Year` ='" . $tahun . "' group by dt.`Month` ";
        return $this->db->query($sql)->result();
    }

    function salesTrendTahun()
    {
        $sql = "select dt.`Year` ,count(distinct  fs.SalesOrderNumber) as trend from fact_sales fs join dim_time dt ON fs.timeID =dt.timeID group by dt.`Year` ";

        return $this->db->query($sql)->result();
    }

    function salesTrendBulan($tahun)
    {
        $sql = "select dt.`Month`,count(distinct  fs.SalesOrderNumber) as trend  from fact_sales fs join dim_time dt ON fs.timeID =dt.timeID where dt.`Year` ='" . $tahun . "' group by dt.`Month` ";
        return $this->db->query($sql)->result();
    }
}
