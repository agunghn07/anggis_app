<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MainMenuModel extends CI_Model {
    var $table = 'tb_r_babp';
    var $column_order = array('NO_BABP', 'TANGGAL_BABP','CREATED_DT'); 
    var $column_search = array('NO_BABP');  
    var $order = array('CREATED_DT' => 'desc');

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

    public function getcountAllSubist(){
        $query = $this->db->get("tb_m_sublist");
        return $query->num_rows();
    }

    public function getCheckedList($no_babp){
        $query = $this->db->where("ID_BABP", $no_babp)->get("tb_r_checklist");
        return $query->num_rows();
    }

    public function getDataChecklist(){
        $returnData = array();
        $initData = array(
            "ID"          => null,
            "TITLE"       => null,
            "DESCRIPTION" => null,
            "listDetail"  => []
        );
        $list = $this->db->get("tb_m_list");
        foreach($list->result_object() as $l){
            $initData["ID"]          = $l->ID;
            $initData["TITLE"]       = $l->TITLE;
            $initData["DESCRIPTION"] = $l->DESCRIPTION;
            $initData["listDetail"]  = $this->db->where("ID_LIST", $l->ID)->get("tb_m_sublist")->result_object();

            array_push($returnData, $initData);
        }
        return $returnData;
    }

    public function saveChecklistData($data){
        $this->db->trans_start();
        $this->db->trans_strict(true);

        $returnValue = ["bool" => true, "ID_NOTE" => null, "checkList" => array()];
        $dataNote = array(
            "ID"      => $data["ID"],
            "ID_LIST" => $data["ID_LIST"],
            "ID_BABP" => $data["ID_BABP"],
            "NOTE"    => $data["NOTE"] 
        );

        if(strlen($dataNote["ID"]) == 0){
            $this->db->insert("tb_r_note", $dataNote);
            $returnValue["ID_NOTE"] = $this->db->insert_id();
        }else{
            $this->db->where(array("ID" => $dataNote["ID"], "ID_LIST" => $dataNote["ID_LIST"], "ID_BABP" => $dataNote["ID_BABP"]));
            $this->db->update("tb_r_note", $dataNote);
            $returnValue["ID_NOTE"] = $dataNote["ID"];
        }
        
        if(array_key_exists("checkList", $data)){
            $idSubList = array();
            foreach($data["checkList"] as $i){
                $temp = array(
                    "ID"         => $i["ID"],
                    "ID_SUBLIST" => $i["ID_SUBLIST"]
                );
                array_push($idSubList, $temp);
            }

            $notInChecked = array();
            foreach($idSubList as $j){
                array_push($notInChecked, $j["ID_SUBLIST"]);
            }
            $queryString = "DELETE FROM tb_r_checklist WHERE ID_LIST = ? AND ID_BABP = ? AND ID_SUBLIST NOT IN ?";
            $this->db->query($queryString, array($dataNote["ID_LIST"], $dataNote["ID_BABP"],  $notInChecked));

            $index = 0;
            foreach($data["checkList"] as $k){
                if(strlen($k["ID"]) == 0){
                    $this->db->insert("tb_r_checklist", $k);
                    $idSubList[$index]["ID"] = $this->db->insert_id();
                }else{
                    $this->db->where(array("ID" => $k["ID"], "ID_LIST" => $k["ID_LIST"], "ID_BABP" => $k["ID_BABP"], "ID_SUBLIST" => $k["ID_SUBLIST"]));
                    $this->db->update("tb_r_checklist", $k); 
                }
                $index++;
            }
            $returnValue["checkList"] = $idSubList;
        }else{
            $this->db->delete("tb_r_checklist", array("ID_LIST" => $dataNote["ID_LIST"], "ID_BABP" => $dataNote["ID_BABP"]));
        }

        if($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $returnValue["bool"] = false;
            return $returnValue;
        }
        
        $this->db->trans_commit();
        return $returnValue;
    }

    public function getCheckById($id){
        $returnData = array("FLAG" => null, "list" => array());
        $tempData = array(
            "ID"        => null,
            "NOTE"      => null,
            "checkList" => []
        );
        $returnData["FLAG"] = $this->db->select("FLAG")->where("NO_BABP", $id)->get("tb_r_babp")->row()->FLAG;

        $query = $this->db->get_where("tb_r_note", array("ID_BABP" => $id));
        if($query->num_rows() != 0){
            $result = $query->result_object();
            foreach($result as $r){
                $tempData["ID"] = $r->ID;
                $tempData["NOTE"] = $r->NOTE;

                $tempData["checkList"] = $this->db->get_where(
                    "tb_r_checklist", array("ID_BABP" => $r->ID_BABP, "ID_LIST" => $r->ID_LIST)
                )->result_object();

                array_push($returnData["list"], $tempData);
            }
        }
        return $returnData;
    }

    public function insertDataBabp($data){
        $this->db->trans_start();
        $this->db->trans_strict(true);

        $this->db->insert("tb_r_babp", $data);

        if($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            return false;
        }

        $this->db->trans_commit();
        return true;
    }

    public function checkExistingBabp($no_babp){
        $exists = false;
        $query = $this->db->get_where("tb_r_babp", array("NO_BABP" => $no_babp));
        if($query->num_rows() != 0){
            $exists = true;
        }
        return $exists;
    }

    public function deleteData($table, $id){
        $this->db->trans_start();
        $this->db->trans_strict(true);

        for($i = 0; $i < count($table); $i++){
            $whereClause = $i != 2 ? "ID_BABP" : "NO_BABP";
            $this->db->where($whereClause, $id);
            $this->db->delete($table[$i]);
        }
        
        if($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            return false;
        }
       
        $this->db->trans_commit();
        return true;
    }

    public function close($id){
        $this->db->trans_start();
        $this->db->trans_strict(true);

        $this->db->set("FLAG", 1)->where("NO_BABP", $id)->update("tb_r_babp");

        if($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            return false;
        }

        $this->db->trans_commit();
        return true;
    }
}