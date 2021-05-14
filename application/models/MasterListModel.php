<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MasterListModel extends CI_Model {
    var $table = 'tb_m_list';
    var $column_order = array(null, 'TITLE','DESCRIPTION','CREATED_DT'); 
    var $column_search = array('TITLE','DESCRIPTION');  
    var $order = array('id' => 'desc');

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query()
    {
         
        $this->db->from($this->table);
 
        $i = 0;
     
        foreach ($this->column_search as $item)
        {
            if($_POST['search']['value'])
            {
                 
                if($i===0) 
                {
                    $this->db->group_start(); 
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) 
                    $this->db->group_end();
            }
            $i++;
        }
         
        if(isset($_POST['order'])) 
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function insertIntoTableDestination($table, $data){
        $this->db->trans_start();
        $this->db->trans_strict(true);

        $forTblList = array(
            "TITLE"       => $data["TITLE"],
            "DESCRIPTION" => $data["DESCRIPTION"]
        );
        $this->db->insert($table[0], $forTblList);
        $id_list = $this->db->insert_id();

        if($this->db->affected_rows() != 0){
            foreach($data["listDetail"] as $subDetail){
                $subDetail["ID_LIST"] = $id_list;
                $this->db->insert($table[1], $subDetail);

                if($this->db->trans_status() === FALSE){
                    $this->db->trans_rollback();
                    return false;
                }
            }
        }
        $this->db->trans_commit();
        return true;
    }

    public function getById($id){
        $returnData = array(
            "ID"          => null,
            "TITLE"       => null,
            "DESCRIPTION" => null,
            "listDetail"  => []
        );
        $query = $this->db->get_where("tb_m_list", array("ID" => $id));
        if($query->num_rows() != 0){
            $result =  $query->row();
            $returnData["TITLE"]       = $result->TITLE;
            $returnData["DESCRIPTION"] = $result->DESCRIPTION;
            $returnData["ID"]          = $result->ID;
            
            $query = $this->db->get_where("tb_m_sublist", array("ID_LIST" => $id));
            if($query->num_rows() != 0){
                $returnData["listDetail"] =  $query->result_object();
            }
        }
        return $returnData;
    }

    public function updateIntoTableDestination($table, $data){
        $this->db->trans_start();
        $this->db->trans_strict(true);

        $forTbListUpdate = array(
            "TITLE"       => $data["TITLE"],
            "DESCRIPTION" => $data["DESCRIPTION"],
            "CHANGED_DT"  => date("Y/m/d h:m:s"),
            "CHANGED_BY"  => "ADMIN"
        );

        $this->db->where("ID", $data["ID"]);
        $this->db->update("tb_m_list", $forTbListUpdate);
        if($this->db->affected_rows() != 0){
            $idSubList = array();
            foreach($data["listDetail"] as $i){
                array_push($idSubList, $i["ID"]);
            }
            $queryString = "DELETE FROM tb_m_sublist WHERE ID_LIST = ? AND ID NOT IN ?";
            $this->db->query($queryString, array($data["ID"], $idSubList));

            foreach($data["listDetail"] as $subDetail){
                $forTbSubList = array(
                    "ID_LIST"     => $data["ID"],
                    "DESCRIPTION" => $subDetail["DESCRIPTION"],
                    "CHANGED_DT"  => date("Y/m/d h:m:s"),
                    "CHANGED_BY"  => "ADMIN"
                );

                if(strlen($subDetail["ID"]) == 0){
                    $this->db->insert($table[1], $forTbSubList);
                }else{
                    $this->db->where("ID", $subDetail["ID"]);
                    $this->db->update("tb_m_sublist", $forTbSubList);
                }

                if($this->db->trans_status() === FALSE){
                    $this->db->trans_rollback();
                    return false;
                }
            }
        }
        $this->db->trans_commit();
        return true;
    }

    public function deleteFromTableDestination($table, $ID){
        $this->db->trans_start();
        $this->db->trans_strict(true);

        $this->db->where("ID_LIST", $ID);
        $this->db->delete($table[1]);
        $affectedRows = $this->db->affected_rows();

        if($affectedRows != 0){
            $this->db->where("ID", $ID);
            $this->db->delete($table[0]);

            if($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                return false;
            }
        }
        $this->db->trans_commit();
        return true;
    }
}