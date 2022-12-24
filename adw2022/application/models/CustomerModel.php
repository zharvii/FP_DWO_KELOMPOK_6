<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class CustomerModel extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function count()
    {
        return $this->db->query('select count(CustomerID) as jumlah from dim_customer')->row()->jumlah;
    }

    function countCustomerActive()
    {
        return $this->db->query('select count(distinct CustomerID) as jumlah from fact_sales')->row()->jumlah;
    }

    function customerType()
    {
        return $this->db->query('select dc.`type` ,count(*) as jumlah,round(((count(dc.`type`)*100)/c.total ))  as persen  from dim_customer dc  cross join (select count(*) as total from dim_customer)  c group by dc.`type` ')->result();
    }

    function topindividualCustomer($tahun = 'all', $kuarter = 'all', $bulan = 'all')
    {
        $sql = "";
        if ($tahun == 'all' && $kuarter == 'all' && $bulan == 'all') {
            $sql = "select fs.CustomerID,dc.Name  ,count(fs.CustomerID) as jumlah,sum(fs.SalesAmount) as total  from fact_sales fs join dim_customer dc on fs.CustomerID =dc.CustomerID where dc.type ='Individual' group by fs.CustomerID order by count(fs.CustomerID) desc limit 5";
        } else  if ($tahun != 'all' && $kuarter == 'all' && $bulan == 'all') {
            $sql = "select fs.CustomerID,dc.Name  ,count(fs.CustomerID) as jumlah,sum(fs.SalesAmount) as total  from fact_sales fs join dim_customer dc on fs.CustomerID =dc.CustomerID join dim_time dt on fs.timeID =dt.timeID  where dt.Year ='" . $tahun . "' and dc.type ='Individual' group by fs.CustomerID order by count(fs.CustomerID) desc limit 5";
        } else  if ($tahun == 'all' && $kuarter != 'all' && $bulan == 'all') {
            $sql = "select fs.CustomerID,dc.Name  ,count(fs.CustomerID) as jumlah,sum(fs.SalesAmount) as total  from fact_sales fs join dim_customer dc on fs.CustomerID =dc.CustomerID join dim_time dt on fs.timeID =dt.timeID  where dt.Quarter ='" . $kuarter . "' and dc.type ='Individual' group by fs.CustomerID order by count(fs.CustomerID) desc limit 5";
        } else  if ($tahun == 'all' && $kuarter == 'all' && $bulan != 'all') {
            $sql = "select fs.CustomerID,dc.Name  ,count(fs.CustomerID) as jumlah,sum(fs.SalesAmount) as total  from fact_sales fs join dim_customer dc on fs.CustomerID =dc.CustomerID join dim_time dt on fs.timeID =dt.timeID  where dt.Month ='" . $bulan . "' and dc.type ='Individual' group by fs.CustomerID order by count(fs.CustomerID) desc limit 5";
        } else  if ($tahun != 'all' && $kuarter != 'all' && $bulan != 'all') {
            $sql = "select fs.CustomerID,dc.Name  ,count(fs.CustomerID) as jumlah,sum(fs.SalesAmount) as total  from fact_sales fs join dim_customer dc on fs.CustomerID =dc.CustomerID join dim_time dt on fs.timeID =dt.timeID  where (dt.Year='" . $tahun . "' and dt.Quarter  ='" . $kuarter . "' and dt.Month='" . $bulan . "') and dc.type ='Individual' group by fs.CustomerID order by count(fs.CustomerID) desc limit 5";
        } else  if ($tahun != 'all' && $kuarter != 'all' && $bulan == 'all') {
            $sql = "select fs.CustomerID,dc.Name  ,count(fs.CustomerID) as jumlah,sum(fs.SalesAmount) as total  from fact_sales fs join dim_customer dc on fs.CustomerID =dc.CustomerID join dim_time dt on fs.timeID =dt.timeID  where (dt.Year='" . $tahun . "' and dt.Quarter  ='" . $kuarter . "' ) and dc.type ='Individual' group by fs.CustomerID order by count(fs.CustomerID) desc limit 5";
        } else  if ($tahun != 'all' && $kuarter == 'all' && $bulan != 'all') {
            $sql = "select fs.CustomerID,dc.Name  ,count(fs.CustomerID) as jumlah,sum(fs.SalesAmount) as total  from fact_sales fs join dim_customer dc on fs.CustomerID =dc.CustomerID join dim_time dt on fs.timeID =dt.timeID  where (dt.Year='" . $tahun . "'  and dt.Month='" . $bulan . "') and dc.type ='Individual' group by fs.CustomerID order by count(fs.CustomerID) desc limit 5";
        } else  if ($tahun == 'all' && $kuarter != 'all' && $bulan != 'all') {
            $sql = "select fs.CustomerID,dc.Name  ,count(fs.CustomerID) as jumlah,sum(fs.SalesAmount) as total  from fact_sales fs join dim_customer dc on fs.CustomerID =dc.CustomerID join dim_time dt on fs.timeID =dt.timeID  where (dt.Quarter  ='" . $kuarter . "' and dt.Month='" . $bulan . "') and dc.type ='Individual' group by fs.CustomerID order by count(fs.CustomerID) desc limit 5";
        } else {
            $sql = "select fs.CustomerID,dc.Name  ,count(fs.CustomerID) as jumlah,sum(fs.SalesAmount) as total  from fact_sales fs join dim_customer dc on fs.CustomerID =dc.CustomerID where dc.type ='Individual' group by fs.CustomerID order by count(fs.CustomerID) desc limit 5";
        }
        return $this->db->query($sql)->result();
    }

    function topResellerCustomer($tahun = 'all', $kuarter = 'all', $bulan = 'all')
    {
        $sql = "";
        if ($tahun == 'all' && $kuarter == 'all' && $bulan == 'all') {
            $sql = "select fs.CustomerID,dc.Name  ,count(fs.CustomerID) as jumlah,sum(fs.SalesAmount) as total  from fact_sales fs join dim_customer dc on fs.CustomerID =dc.CustomerID where dc.type ='Reseller' group by fs.CustomerID order by count(fs.CustomerID) desc limit 5";
        } else  if ($tahun != 'all' && $kuarter == 'all' && $bulan == 'all') {
            $sql = "select fs.CustomerID,dc.Name  ,count(fs.CustomerID) as jumlah,sum(fs.SalesAmount) as total  from fact_sales fs join dim_customer dc on fs.CustomerID =dc.CustomerID join dim_time dt on fs.timeID =dt.timeID  where dt.Year ='" . $tahun . "' and dc.type ='Reseller' group by fs.CustomerID order by count(fs.CustomerID) desc limit 5";
        } else  if ($tahun == 'all' && $kuarter != 'all' && $bulan == 'all') {
            $sql = "select fs.CustomerID,dc.Name  ,count(fs.CustomerID) as jumlah,sum(fs.SalesAmount) as total  from fact_sales fs join dim_customer dc on fs.CustomerID =dc.CustomerID join dim_time dt on fs.timeID =dt.timeID  where dt.Quarter ='" . $kuarter . "' and dc.type ='Reseller' group by fs.CustomerID order by count(fs.CustomerID) desc limit 5";
        } else  if ($tahun == 'all' && $kuarter == 'all' && $bulan != 'all') {
            $sql = "select fs.CustomerID,dc.Name  ,count(fs.CustomerID) as jumlah,sum(fs.SalesAmount) as total  from fact_sales fs join dim_customer dc on fs.CustomerID =dc.CustomerID join dim_time dt on fs.timeID =dt.timeID  where dt.Month ='" . $bulan . "' and dc.type ='Reseller' group by fs.CustomerID order by count(fs.CustomerID) desc limit 5";
        } else  if ($tahun != 'all' && $kuarter != 'all' && $bulan != 'all') {
            $sql = "select fs.CustomerID,dc.Name  ,count(fs.CustomerID) as jumlah,sum(fs.SalesAmount) as total  from fact_sales fs join dim_customer dc on fs.CustomerID =dc.CustomerID join dim_time dt on fs.timeID =dt.timeID  where (dt.Year='" . $tahun . "' and dt.Quarter  ='" . $kuarter . "' and dt.Month='" . $bulan . "') and dc.type ='Reseller' group by fs.CustomerID order by count(fs.CustomerID) desc limit 5";
        } else  if ($tahun != 'all' && $kuarter != 'all' && $bulan == 'all') {
            $sql = "select fs.CustomerID,dc.Name  ,count(fs.CustomerID) as jumlah,sum(fs.SalesAmount) as total  from fact_sales fs join dim_customer dc on fs.CustomerID =dc.CustomerID join dim_time dt on fs.timeID =dt.timeID  where (dt.Year='" . $tahun . "' and dt.Quarter  ='" . $kuarter . "' ) and dc.type ='Reseller' group by fs.CustomerID order by count(fs.CustomerID) desc limit 5";
        } else  if ($tahun != 'all' && $kuarter == 'all' && $bulan != 'all') {
            $sql = "select fs.CustomerID,dc.Name  ,count(fs.CustomerID) as jumlah,sum(fs.SalesAmount) as total  from fact_sales fs join dim_customer dc on fs.CustomerID =dc.CustomerID join dim_time dt on fs.timeID =dt.timeID  where (dt.Year='" . $tahun . "'  and dt.Month='" . $bulan . "') and dc.type ='Reseller' group by fs.CustomerID order by count(fs.CustomerID) desc limit 5";
        } else  if ($tahun == 'all' && $kuarter != 'all' && $bulan != 'all') {
            $sql = "select fs.CustomerID,dc.Name  ,count(fs.CustomerID) as jumlah,sum(fs.SalesAmount) as total  from fact_sales fs join dim_customer dc on fs.CustomerID =dc.CustomerID join dim_time dt on fs.timeID =dt.timeID  where (dt.Quarter  ='" . $kuarter . "' and dt.Month='" . $bulan . "') and dc.type ='Reseller' group by fs.CustomerID order by count(fs.CustomerID) desc limit 5";
        } else {
            $sql = "select fs.CustomerID,dc.Name  ,count(fs.CustomerID) as jumlah,sum(fs.SalesAmount) as total  from fact_sales fs join dim_customer dc on fs.CustomerID =dc.CustomerID where dc.type ='Reseller' group by fs.CustomerID order by count(fs.CustomerID) desc limit 5";
        }
        return $this->db->query($sql)->result();
    }
}
