<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class TerritoryModel extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function count()
    {
        return $this->db->query('select count(TerritoryID) as jumlah from dim_territory')->row()->jumlah;
    }

    function data()
    {
        return $this->db->query('select * from dim_territory')->result();
    }

    function chartGroup($tahun = 'all', $kuarter = 'all', $bulan = 'all')
    {
        $sql = "";
        if ($tahun == 'all' && $kuarter == 'all' && $bulan == 'all') {
            $sql = "select dt.`groups` ,count(*) as transaksi,((count(fs.SalesOrderNumber)*100)/s.total)  as persen from fact_sales fs join dim_territory dt on fs.TerritoryID =dt.TerritoryID cross join (select count(*) as total from fact_sales f join dim_territory d on f.TerritoryID =d.TerritoryID ) s group by dt.`groups`";
        } else  if ($tahun != 'all' && $kuarter == 'all' && $bulan == 'all') {
            $sql = "select dw.`groups` ,count(*) as transaksi,((count(fs.SalesOrderNumber)*100)/s.total)  as persen from fact_sales fs join dim_territory dw on fs.TerritoryID =dw.TerritoryID join dim_time dt on fs.timeID =dt.timeID cross join (select count(*) as total from fact_sales f join dim_territory d on f.TerritoryID =d.TerritoryID join dim_time t on f.timeID =t.timeID where t.Year ='" . $tahun . "') s  where dt.Year ='" . $tahun . "' group by dw.groups ";
        } else  if ($tahun == 'all' && $kuarter != 'all' && $bulan == 'all') {
            $sql = "select dw.`groups` ,count(*) as transaksi,((count(fs.SalesOrderNumber)*100)/s.total)  as persen from fact_sales fs join dim_territory dw on fs.TerritoryID =dw.TerritoryID join dim_time dt on fs.timeID =dt.timeID cross join (select count(*) as total from fact_sales f join dim_territory d on f.TerritoryID =d.TerritoryID join dim_time t on f.timeID =t.timeID where t.Quarter ='" . $kuarter . "') s where dt.Quarter ='" . $kuarter . "' group by dw.groups ";
        } else  if ($tahun == 'all' && $kuarter == 'all' && $bulan != 'all') {
            $sql = "select dw.`groups` ,count(*) as transaksi,((count(fs.SalesOrderNumber)*100)/s.total)  as persen from fact_sales fs join dim_territory dw on fs.TerritoryID =dw.TerritoryID join dim_time dt on fs.timeID =dt.timeID cross join (select count(*) as total from fact_sales f join dim_territory d on f.TerritoryID =d.TerritoryID join dim_time t on f.timeID =t.timeID where t.Month ='" . $bulan . "') s where dt.Month ='" . $bulan . "' group by dw.groups ";
        } else  if ($tahun != 'all' && $kuarter != 'all' && $bulan != 'all') {
            $sql = "select dw.`groups` ,count(*) as transaksi,((count(fs.SalesOrderNumber)*100)/s.total)  as persen from fact_sales fs join dim_territory dw on fs.TerritoryID =dw.TerritoryID join dim_time dt on fs.timeID =dt.timeID cross join (select count(*) as total from fact_sales f join dim_territory d on f.TerritoryID =d.TerritoryID join dim_time t on f.timeID =t.timeID where (t.Year='" . $tahun . "' and t.Quarter  ='" . $kuarter . "' and t.Month='" . $bulan . "')) s where (dt.Year='" . $tahun . "' and dt.Quarter  ='" . $kuarter . "' and dt.Month='" . $bulan . "')  group by dw.groups";
        } else  if ($tahun != 'all' && $kuarter != 'all' && $bulan == 'all') {
            $sql = "select dw.`groups` ,count(*) as transaksi,((count(fs.SalesOrderNumber)*100)/s.total)  as persen from fact_sales fs join dim_territory dw on fs.TerritoryID =dw.TerritoryID join dim_time dt on fs.timeID =dt.timeID cross join (select count(*) as total from fact_sales f join dim_territory d on f.TerritoryID =d.TerritoryID join dim_time t on f.timeID =t.timeID where (t.Year='" . $tahun . "' and t.Quarter  ='" . $kuarter . "')) s where (dt.Year='" . $tahun . "' and dt.Quarter  ='" . $kuarter . "')  group by dw.groups";
        } else  if ($tahun != 'all' && $kuarter == 'all' && $bulan != 'all') {
            $sql = "select dw.`groups` ,count(*) as transaksi,((count(fs.SalesOrderNumber)*100)/s.total)  as persen from fact_sales fs join dim_territory dw on fs.TerritoryID =dw.TerritoryID join dim_time dt on fs.timeID =dt.timeID cross join (select count(*) as total from fact_sales f join dim_territory d on f.TerritoryID =d.TerritoryID join dim_time t on f.timeID =t.timeID where (t.Year='" . $tahun . "'  and t.Month='" . $bulan . "')) s where (dt.Year='" . $tahun . "'  and dt.Month='" . $bulan . "')  group by dw.groups";
        } else  if ($tahun == 'all' && $kuarter != 'all' && $bulan != 'all') {
            $sql = "select dw.`groups` ,count(*) as transaksi,((count(fs.SalesOrderNumber)*100)/s.total)  as persen from fact_sales fs join dim_territory dw on fs.TerritoryID =dw.TerritoryID join dim_time dt on fs.timeID =dt.timeID cross join (select count(*) as total from fact_sales f join dim_territory d on f.TerritoryID =d.TerritoryID join dim_time t on f.timeID =t.timeID where (t.Quarter  ='" . $kuarter . "' and t.Month='" . $bulan . "')) s where (dt.Quarter  ='" . $kuarter . "' and dt.Month='" . $bulan . "')  group by dw.groups";
        } else {
            $sql = "select dt.groups ,count(*) as transaksi,((count(fs.SalesOrderNumber)*100)/s.total)  as persen from fact_sales fs join dim_territory dt on fs.TerritoryID =dt.TerritoryID cross join (select count(*) as total from fact_sales f join dim_territory d on f.TerritoryID =d.TerritoryID ) s group by dt.groups";
        }
        return $this->db->query($sql)->result();
    }

    function chartTerritory($tahun = 'all', $kuarter = 'all', $bulan = 'all', $group = '')
    {
        $sql = "";
        if ($tahun == 'all' && $kuarter == 'all' && $bulan == 'all') {
            $sql = "select if (dt.region ='United States',concat(dt.name,' ',dt.region),dt.name) as Territory,count(*) as transaksi, ((count(fs.SalesOrderNumber)*100)/s.total) as persen from fact_sales fs join dim_territory dt on fs.TerritoryID =dt.TerritoryID cross join (select count(*) as total from fact_sales f join dim_territory d on f.TerritoryID =d.TerritoryID where d.groups='".$group."') s where dt.groups='" . $group . "' group by dt.TerritoryID";
        } else  if ($tahun != 'all' && $kuarter == 'all' && $bulan == 'all') {
            $sql = "select if (dt.region ='United States',concat(dt.name,' ',dt.region),dt.name) as Territory,count(*) as transaksi, ((count(fs.SalesOrderNumber)*100)/s.total) as persen from fact_sales fs join dim_territory dt on fs.TerritoryID =dt.TerritoryID cross join (select count(*) as total from fact_sales f join dim_territory d on f.TerritoryID =d.TerritoryID join dim_time t on f.timeID =t.timeID where t.Year ='" . $tahun . "' and d.groups='" . $group . "') s join dim_time dw on fs.timeID =dw.timeID where dw.Year ='" . $tahun . "' and  dt.groups='" . $group . "' group by dt.TerritoryID";
        } else  if ($tahun == 'all' && $kuarter != 'all' && $bulan == 'all') {
            $sql = "select if (dt.region ='United States',concat(dt.name,' ',dt.region),dt.name) as Territory,count(*) as transaksi, ((count(fs.SalesOrderNumber)*100)/s.total) as persen from fact_sales fs join dim_territory dt on fs.TerritoryID =dt.TerritoryID cross join (select count(*) as total from fact_sales f join dim_territory d on f.TerritoryID =d.TerritoryID join dim_time t on f.timeID =t.timeID where t.Quarter ='" . $kuarter . "' and d.groups='".$group."') s join dim_time dw on fs.timeID =dw.timeID  where dw.Quarter ='" . $kuarter . "' and  dt.groups='" . $group . "' group by dt.TerritoryID ";
        } else  if ($tahun == 'all' && $kuarter == 'all' && $bulan != 'all') {
            $sql = "select if (dt.region ='United States',concat(dt.name,' ',dt.region),dt.name) as Territory,count(*) as transaksi, ((count(fs.SalesOrderNumber)*100)/s.total) as persen from fact_sales fs join dim_territory dt on fs.TerritoryID =dt.TerritoryID cross join (select count(*) as total from fact_sales f join dim_territory d on f.TerritoryID =d.TerritoryID join dim_time t on f.timeID =t.timeID where t.Month ='" . $bulan . "' and d.groups='".$group."') s join dim_time dw on fs.timeID =dw.timeID  where dw.Month ='" . $bulan . "' and  dt.groups='" . $group . "' group by dt.TerritoryID ";
        } else  if ($tahun != 'all' && $kuarter != 'all' && $bulan != 'all') {
            $sql = "select if (dt.region ='United States',concat(dt.name,' ',dt.region),dt.name) as Territory,count(*) as transaksi, ((count(fs.SalesOrderNumber)*100)/s.total) as persen from fact_sales fs join dim_territory dt on fs.TerritoryID =dt.TerritoryID cross join (select count(*) as total from fact_sales f join dim_territory d on f.TerritoryID =d.TerritoryID join dim_time t on f.timeID =t.timeID where (t.Year='" . $tahun . "' and t.Quarter  ='" . $kuarter . "' and t.Month='" . $bulan . "' and d.groups='".$group."') s join dim_time dw on fs.timeID =dw.timeID  where (dw.Year='" . $tahun . "' and dw.Quarter  ='" . $kuarter . "' and dw.Month='" . $bulan . "') and  dt.groups='" . $group . "'  group by dt.TerritoryID";
        } else  if ($tahun != 'all' && $kuarter != 'all' && $bulan == 'all') {
            $sql = "select if (dt.region ='United States',concat(dt.name,' ',dt.region),dt.name) as Territory,count(*) as transaksi, ((count(fs.SalesOrderNumber)*100)/s.total) as persen from fact_sales fs join dim_territory dt on fs.TerritoryID =dt.TerritoryID cross join (select count(*) as total from fact_sales f join dim_territory d on f.TerritoryID =d.TerritoryID join dim_time t on f.timeID =t.timeID where (t.Year='" . $tahun . "' and t.Quarter  ='" . $kuarter . "') and d.groups='".$group."') s join dim_time dw on fs.timeID =dw.timeID  where (dw.Year='" . $tahun . "' and dw.Quarter  ='" . $kuarter . "') and  dt.groups='" . $group . "'  group by dt.TerritoryID";
        } else  if ($tahun != 'all' && $kuarter == 'all' && $bulan != 'all') {
            $sql = "select if (dt.region ='United States',concat(dt.name,' ',dt.region),dt.name) as Territory,count(*) as transaksi, ((count(fs.SalesOrderNumber)*100)/s.total) as persen from fact_sales fs join dim_territory dt on fs.TerritoryID =dt.TerritoryID cross join (select count(*) as total from fact_sales f join dim_territory d on f.TerritoryID =d.TerritoryID join dim_time t on f.timeID =t.timeID where (t.Year='" . $tahun . "' and t.Quarter  ='" . $kuarter . "') and d.groups='".$group."') s join dim_time dw on fs.timeID =dw.timeID  where (dw.Year='" . $tahun . "'  and dw.Month='" . $bulan . "') and  dt.groups='" . $group . "'  group by dt.TerritoryID";
        } else  if ($tahun == 'all' && $kuarter != 'all' && $bulan != 'all') {
            $sql = "select if (dt.region ='United States',concat(dt.name,' ',dt.region),dt.name) as Territory,count(*) as transaksi, ((count(fs.SalesOrderNumber)*100)/s.total) as persen from fact_sales fs join dim_territory dt on fs.TerritoryID =dt.TerritoryID cross join (select count(*) as total from fact_sales f join dim_territory d on f.TerritoryID =d.TerritoryID join dim_time t on f.timeID =t.timeID where (t.Quarter  ='" . $kuarter . "' and t.Month='" . $bulan . "') and d.groups='".$group."') s join dim_time dw on fs.timeID =dw.timeID  where (dt.Quarter  ='" . $kuarter . "' and dt.Month='" . $bulan . "') and  dt.groups='" . $group . "'  group by dt.TerritoryID";
        } else {
            $sql = "select if (dt.region ='United States',concat(dt.name,' ',dt.region),dt.name) as Territory,count(*) as transaksi, ((count(fs.SalesOrderNumber)*100)/s.total) as persen from fact_sales fs join dim_territory dt on fs.TerritoryID =dt.TerritoryID cross join (select count(*) as total from fact_sales f join dim_territory d on f.TerritoryID =d.TerritoryID where d.groups='".$group."') s where dt.groups='" . $group . "' group by dt.TerritoryID ";
        }
        return $this->db->query($sql)->result();
    }
}
