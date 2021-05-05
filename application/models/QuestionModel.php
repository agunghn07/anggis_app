<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class QuestionModel extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getQuestionByAssignment($id_assignment,$assignment_order = NULL) {
        $this->db->where('assignment_question.id_assignment', $id_assignment);
        if ($assignment_order) {
            $this->db->order_by('assignment_question.id_aquestion', 'random');
        }
        $this->db->where('assignment_question.val_hide', 0);
        $this->db->join('ms_question', 'assignment_question.id_question = ms_question.id_question', 'left');
        return $this->db->get('assignment_question')->result_object();
    }

    public function getOptionByQuestion($id_question){
        $this->db->where('id_question', $id_question);
        $this->db->where('option_hide', 0);
        return $this->db->get('question_option')->result_object();
    }

    public function getOptionById($id_option){
        $this->db->where('id_option', $id_option);
        return $this->db->get('question_option')->row_object();
    }

    public function getQuestionById($id_question){
        $this->db->where('id_question', $id_question);
        return $this->db->get('ms_question')->row_object();
    }

    public function insertQuestion($dataQuestion){
        $this->db->insert('ms_question', $dataQuestion);
        return $this->db->insert_id();
    }

    public function insertOption($answer){
        return $this->db->insert('question_option', $answer);
    }

    public function insertAssignmentQuestion($assignmentQuestion){
        return $this->db->insert('assignment_question', $assignmentQuestion);
    }

    public function checkAnswerTrue($id_option, $id_question){
        $this->db->where('id_option', $id_option);
        $this->db->where('id_question', $id_question);
        $this->db->where('option_true', 1);
        return $this->db->get('question_option')->row_object();
    }

    public function updateQuestion($dataQuestion){
        $this->db->where('id_question', $dataQuestion['id_question']);
        return $this->db->update('ms_question', $dataQuestion);
    }

    public function updateOption($data) {
        $this->db->where('id_option', $data['id_option']);
        return $this->db->update('question_option', $data);
    }

    public function deleteQuestionById($id_question){
        $this->db->delete('ms_question', array('id_question' => $id_question));
    }
}