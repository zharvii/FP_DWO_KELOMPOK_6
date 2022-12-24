<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class EmployeeModel extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function count()
    {
        return $this->db->query('select count(EmployeeID) as jumlah from dim_employee')->row()->jumlah;
    }

    function countSalesActive()
    {
        return $this->db->query('select count(distinct EmployeeID) as jumlah from fact_sales')->row()->jumlah;
    }


    function employeeGender()
    {
        return $this->db->query('select de.Gender,count(*) as jumlah  ,round(((count(de.Gender)*100)/e.total ))  as persen from dim_employee de  cross join (select count(*) as total from dim_employee)  e group by de.Gender')->result();
    }

    function employeeTitle()
    {
        return $this->db->query('select de.Title ,count(*) as jumlah from dim_employee de group by de.Title')->result();
    }

    function topSalesEmployee($tahun = 'all', $kuarter = 'all', $bulan = 'all')
    {
        $sql = "";
        if ($tahun == 'all' && $kuarter == 'all' && $bulan == 'all') {
            $sql = "select fs.EmployeeID,de.Name ,count(fs.EmployeeID) as jumlah,sum(fs.SalesAmount) as revenue  from fact_sales fs join dim_employee de on fs.EmployeeID =de.EmployeeID  where fs.EmployeeID is not null group by fs.EmployeeID  order by count(fs.EmployeeID) desc limit 5";
        } else  if ($tahun != 'all' && $kuarter == 'all' && $bulan == 'all') {
            $sql = "select fs.EmployeeID,de.Name ,count(fs.EmployeeID)  as jumlah,sum(fs.SalesAmount) as revenue  from fact_sales fs join dim_employee de on fs.EmployeeID =de.EmployeeID join dim_time dt on fs.timeID =dt.timeID  where dt.`Year` ='" . $tahun . "' and fs.EmployeeID is not null group by fs.EmployeeID  order by count(fs.EmployeeID) desc limit 5";
        } else  if ($tahun == 'all' && $kuarter != 'all' && $bulan == 'all') {
            $sql = "select fs.EmployeeID,de.Name ,count(fs.EmployeeID)  as jumlah,sum(fs.SalesAmount) as revenue  from fact_sales fs join dim_employee de on fs.EmployeeID =de.EmployeeID join dim_time dt on fs.timeID =dt.timeID  where dt.`Quarter` ='" . $kuarter . "' and fs.EmployeeID is not null group by fs.EmployeeID  order by count(fs.EmployeeID) desc limit 5";
        } else  if ($tahun == 'all' && $kuarter == 'all' && $bulan != 'all') {
            $sql = "select fs.EmployeeID,de.Name ,count(fs.EmployeeID)  as jumlah,sum(fs.SalesAmount) as revenue  from fact_sales fs join dim_employee de on fs.EmployeeID =de.EmployeeID join dim_time dt on fs.timeID =dt.timeID  where dt.`Month` ='" . $bulan . "' and fs.EmployeeID is not null group by fs.EmployeeID  order by count(fs.EmployeeID) desc limit 5";
        } else  if ($tahun != 'all' && $kuarter != 'all' && $bulan != 'all') {
            $sql = "select fs.EmployeeID,de.Name ,count(fs.EmployeeID)  as jumlah,sum(fs.SalesAmount) as revenue  from fact_sales fs join dim_employee de on fs.EmployeeID =de.EmployeeID join dim_time dt on fs.timeID =dt.timeID  where (dt.`Year` ='" . $tahun . "' and dt.Quarter='" . $kuarter . "' and dt.Month='" . $bulan . "') and fs.EmployeeID is not null group by fs.EmployeeID  order by count(fs.EmployeeID) desc limit 5";
        } else  if ($tahun != 'all' && $kuarter != 'all' && $bulan == 'all') {
            $sql = "select fs.EmployeeID,de.Name ,count(fs.EmployeeID)  as jumlah,sum(fs.SalesAmount) as revenue  from fact_sales fs join dim_employee de on fs.EmployeeID =de.EmployeeID join dim_time dt on fs.timeID =dt.timeID  where (dt.`Year` ='" . $tahun . "' and dt.Quarter='" . $kuarter . "') and fs.EmployeeID is not null group by fs.EmployeeID  order by count(fs.EmployeeID) desc limit 5";
        } else  if ($tahun != 'all' && $kuarter == 'all' && $bulan != 'all') {
            $sql = "select fs.EmployeeID,de.Name ,count(fs.EmployeeID)  as jumlah,sum(fs.SalesAmount) as revenue  from fact_sales fs join dim_employee de on fs.EmployeeID =de.EmployeeID join dim_time dt on fs.timeID =dt.timeID  where (dt.`Year` ='" . $tahun . "' and dt.`Month` ='" . $bulan . "') and fs.EmployeeID is not null group by fs.EmployeeID  order by count(fs.EmployeeID) desc limit 5";
        } else  if ($tahun == 'all' && $kuarter != 'all' && $bulan != 'all') {
            $sql = "select fs.EmployeeID,de.Name ,count(fs.EmployeeID)  as jumlah,sum(fs.SalesAmount) as revenue  from fact_sales fs join dim_employee de on fs.EmployeeID =de.EmployeeID join dim_time dt on fs.timeID =dt.timeID  where (dt.Quarter  ='" . $kuarter . "' and dt.`Month` ='" . $bulan . "') and fs.EmployeeID is not null group by fs.EmployeeID  order by count(fs.EmployeeID) desc limit 5";
        } else {
            $sql = "select fs.EmployeeID,de.Name ,count(fs.EmployeeID) as jumlah,sum(fs.SalesAmount) as revenue  from fact_sales fs join dim_employee de on fs.EmployeeID =de.EmployeeID  where fs.EmployeeID is not null group by fs.EmployeeID  order by count(fs.EmployeeID) desc limit 5";
        }
        return $this->db->query($sql)->result();
    }
}
