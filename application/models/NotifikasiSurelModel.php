<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class NotifikasiSurelModel extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getListMessage($userInfo, $id_email = null, $params = null){
        $sql = "
            SELECT 
                emp.name, emp.photo, email.read_status, email.message, 
                email.receive_dt, emp.position id_position,
                email.subject, occ.position, emp.division, emp.pic,
                emp.division, emp.noreg, email.id id_email,
                cuti.approval_1, cuti.approval_2, cuti.approval_3, cuti.is_approve, cuti.nomor_cuti,
                email.sender
                ".($userInfo->id_position == 2 ? ", emp2.pic pic2" : "")."
            FROM tb_r_email email
            JOIN tb_t_pengajuan_cuti cuti 
                ON cuti.id = email.id_cuti 
            JOIN tb_r_employee emp 
                ON cuti.noreg = emp.noreg 
            JOIN tb_m_occupation occ 
                ON occ.id = emp.position
            ".($userInfo->id_position == 2 ? "JOIN tb_r_employee emp2 ON emp.pic = emp2.noreg" : "")."
        ";
        // $sql = "
        //     SELECT emp.name, emp.photo, email.read_status, email.message, 
        //            email.receive_dt, emp.photo, emp.position id_position,
        //            email.subject, occ.position, emp.division, emp.pic,
        //            emp.division, emp.noreg, email.id id_email
        //            ".($id_position != 4 ? ", cuti.approval_1, cuti.approval_2, cuti.approval_3, cuti.nomor_cuti" : '')." 
        //     FROM tb_r_email email
        //     JOIN tb_r_employee emp ON email.sender = emp.noreg ".($id_position != 4 ? "AND email.receiver = emp.pic" : '')." 
        //     JOIN tb_m_occupation occ ON occ.id = emp.position
        // ";
        if($userInfo->id_position != 4){
            // $sql = $sql."WHERE (email.subject LIKE 'Surat Pengajuan%'".($userInfo->id_position == 3 ? " OR email.subject LIKE 'Surat Penerimaan%'" : "").") AND";
            $sql = $sql."WHERE 1=1 AND";
            if($userInfo->id_division != "DK"){
                // $sql = $sql." (".($userInfo->id_position == 3 ? "emp" : "emp2").".pic = '$userInfo->noreg'";
                if($userInfo->id_position == 2){
                    // $sql = $sql." OR emp.pic = '$userInfo->noreg') AND";
                    $sql = $sql." (emp2.pic = '$userInfo->noreg' OR emp.pic = '$userInfo->noreg') AND";
                }
                // else{
                //     $sql = $sql.") AND";
                // }
            }
            // $sql = $sql." 
            //     JOIN tb_t_pengajuan_cuti cuti ON cuti.noreg = email.sender 
            //     WHERE emp.pic = '$noreg' AND 
            //           cuti.nomor_cuti = COALESCE(".($params == null ? 'null' : "'$params'").", cuti.nomor_cuti)
            // ";
        }else{
            $sql = $sql." WHERE email.subject NOT LIKE 'Surat Pengajuan%' AND";
        }
        $sql = $sql." 
            email.receiver = '$userInfo->noreg' AND
            email.id = COALESCE(".($id_email == null ? 'null' : "'$id_email'").", email.id) AND
            cuti.nomor_cuti = COALESCE(".($params == null ? 'null' : "'$params'").", cuti.nomor_cuti) 
            ORDER BY email.receive_dt DESC
        ";
        $query = $this->db->query($sql);
        return $query->result_object();
    }

    public function getCutiInfo($id_email){
        $sql = "
            SELECT emp.division, emp.pic, cuti.nomor_cuti, emp.noreg, email.id id_email
            FROM tb_r_employee emp
            JOIN tb_t_pengajuan_cuti cuti ON cuti.noreg = emp.noreg
            JOIN tb_r_email email ON cuti.id = email.id_cuti
            WHERE email.id = '$id_email'
        ";
        $query = $this->db->query($sql);
        return $query->row_object();
    }

    public function updateReadStatus($message){
        $sql = "
            UPDATE tb_r_email email
            JOIN tb_t_pengajuan_cuti cuti ON cuti.id = email.id_cuti
            SET email.read_status = 1, email.updated_by = '".$this->session->userdata('Username')."', email.updated_dt = '".date('Y-m-d H:i:s')."'
            WHERE email.id = '".$message[0]->id_email."' and email.subject = '".$message[0]->subject."' and email.read_status = 0
        ";
        // // ".($userInfo->id_position == 4 ? '' : "JOIN tb_t_pengajuan_cuti cuti ON cuti.noreg = email.SENDER")."
        // if($userInfo->id_position == 4){
        //     $sql = $sql."WHERE email.sender = '$noreg'";
        // }else{
        //     // $sql = $sql."WHERE cuti.noreg = '$noreg'";
        //     $sql = $sql."WHERE email.id = '".$message[0]->id_email."'";
        // }
        // $sql = $sql." and email.subject = '".$message[0]->subject."'";
        $this->db->query($sql);
    }

    public function getApprovalDesc($id){
        $this->db->select('description');
        $this->db->from('tb_m_approval');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_object();
    }

    public function getReceiverInfo($nomorCuti, $firstSender){
        $sql = "
            SELECT 
                emp.email, emp.noreg, emp.name, cuti.created_dt, cuti.id id_cuti,
                emp.division, cuti.alasan, emp2.name pic_name, emp2.noreg pic_noreg,
                divs.description division_name, occ.position, cuti.start_dt, cuti.until_dt,
                email.subject, email.message
            FROM tb_t_pengajuan_cuti cuti
            JOIN tb_r_employee emp 
                ON cuti.noreg = emp.noreg
            JOIN tb_r_employee emp2 
                ON emp.pic = emp2.noreg
            JOIN tb_m_division divs 
                ON emp.division = divs.id
            JOIN tb_m_occupation occ 
                ON emp2.position = occ.id
            JOIN tb_r_email email 
                ON cuti.id = email.id_cuti
            WHERE cuti.nomor_cuti = '$nomorCuti' AND is_approve = 2 AND email.sender = '$firstSender'
        ";
        $query = $this->db->query($sql);
        return $query->row_object();
    }

    // public function updateStatusApprove($data, $id){
    //     $dataUpdate = array_keys($data);
    //     $sql = "
    //         UPDATE tb_t_pengajuan_cuti
    //         SET ".$dataUpdate[0]." = ".$data[$dataUpdate[0]].", ".$dataUpdate[1]." = ".$data[$dataUpdate[1]].",
    //             updated_by = '".$this->session->userdata('Username')."', updated_dt = '".date('Y-m-d h:i:s')."'
    //         where nomor_cuti = '$id' AND is_approve = 2 
    //     ";
    //     $query = $this->db->query($sql);
    //     return $query;
    // }

    public function getPicEmail($pic_noreg){
        $this->db->select('emp2.email, emp2.noreg');
        $this->db->from('tb_r_employee emp');
        $this->db->join('tb_r_employee emp2', 'emp.pic = emp2.noreg');
        $this->db->where('emp.noreg', $pic_noreg);
        $query = $this->db->get();
        return $query->row_object();
    }
}
?>