<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PengajuanCutiModel extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getFromTable($select, $table, $whereClause, $params){
        $this->db->select($select);
        $this->db->from($table);
        $this->db->where($whereClause, $params);
        $result = $this->db->get();
        return $result->row();  
    }

    public function nomorPengajuan($noreg){
        $sql = "SELECT EXISTS(Select 1 from tb_t_pengajuan_cuti where noreg = '$noreg') as result";
        $query = $this->db->query($sql);
        $result = $query->row();
        if($result->result == 0){
            $nomorPengajuan = $noreg.'/'.substr(date('Y'), 2).'-1';
            return $nomorPengajuan;
        }else{
            $rejectedCuti = "SELECT nomor_cuti, is_approve FROM tb_t_pengajuan_cuti WHERE noreg = '$noreg' ORDER BY id DESC LIMIT 1";
            $getRejectedCuti = $this->db->query($rejectedCuti);
            $getRejectedCutiVal = $getRejectedCuti->row();
            if($getRejectedCutiVal->is_approve != 1){
                $i = 1;
                $checkOrder = "
                    SELECT DISTINCT SUBSTRING(REVERSE(cuti.NOMOR_CUTI), 1, (INSTR(REVERSE(cuti.NOMOR_CUTI), '-') - 1)) as result
                    FROM tb_t_pengajuan_cuti cuti 
                    WHERE cuti.noreg = '$noreg'
                    ORDER BY result ASC
                ";
                $executeOrder = $this->db->query($checkOrder);
                $getOrderNumber = $executeOrder->result();
                foreach($getOrderNumber as $orderNumber){
                    if($orderNumber->result != $i){
                        break;
                    }
                    $i++;
                }
                $nomorPengajuan = $noreg.'/'.substr(date('Y'), 2).'-'.$i;
                return $nomorPengajuan;
            }else{
                return $getRejectedCutiVal->nomor_cuti;
            }
        }
    }

    public function getPic($noreg){
        $sql = "
            SELECT emp2.email, emp2.position, emp2.noreg, emp2.division
            FROM tb_r_employee emp1
            JOIN tb_r_employee emp2
            ON emp2.noreg = emp1.pic
            WHERE emp1.noreg = '$noreg'
        ";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result; 
    }

    public function checkIsInRejection($nomorPengajuan, $currentDate){
        $query = $this->getLastRejectionDate($nomorPengajuan);
        $result = $query->row();
        if($query->num_rows() != 0){
            if($currentDate < $result->until_dt){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function getLastRejectionDate($nomorPengajuan){
        $sql = "
            SELECT until_dt
            FROM tb_t_pengajuan_cuti
            WHERE nomor_cuti = '$nomorPengajuan' AND is_approve = 1
        ";
        $query = $this->db->query($sql);
        return $query;
    }
    
    public function checkIsCutiPresen($nomorPengajuan){
        $sql = "SELECT EXISTS(Select 1 from tb_t_pengajuan_cuti where nomor_cuti = '$nomorPengajuan') as result";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result;
    }

    public function insertIntoDatabase($table, $data){
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }
}
?>