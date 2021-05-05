<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PersetujuanCutiModel extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getNomorCuti($noreg){
        // $param = array('emp.noreg' => $noreg, 'cuti.is_approve' => 2);
        $param = array('emp.noreg' => $noreg);
        $this->db->select('cuti.id, cuti.nomor_cuti, cuti.alasan, cuti.start_dt, cuti.until_dt');
        $this->db->from('tb_t_pengajuan_cuti cuti');
        $this->db->join('tb_r_employee emp', 'cuti.noreg = emp.noreg');
        $this->db->where($param);
        $this->db->order_by('id', 'desc');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_object();
    }

    public function getListApproval($idCuti){
        $listApproval = [];
        $sql = "
            SELECT approval_1, approval_2, approval_3
            FROM tb_t_pengajuan_cuti
            WHERE id = '$idCuti'
            ORDER BY id DESC LIMIT 1
        ";
        // WHERE id = '$idCuti' and is_approve = 2
        $query = $this->db->query($sql);
        $result = $query->row_array();
        return $result;
    }

    public function getReadDt($idCuti, $pic){
        $sql = "
            SELECT email.updated_dt
            FROM tb_r_email email
            JOIN tb_t_pengajuan_cuti cuti
                ON email.id_cuti = cuti.id
            WHERE cuti.id = $idCuti AND email.receiver = '$pic'
        ";
        $query = $this->db->query($sql);
        $result = $query->row_object();
        return $result;
    }

    public function getPicDivision($noreg){
        $sql = "
            SELECT divs.description
            FROM tb_r_employee emp
            JOIN tb_m_division divs
                ON emp.division = divs.id
            WHERE emp.noreg = '$noreg'
        ";
        $query = $this->db->query($sql);
        $result = $query->row_object();
        return $result;
    }

}
?>