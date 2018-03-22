<?php 
class Cate_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        // Your own constructor code
    }
    public function get_last_ten_entries()
    {
        $query = $this->db->get('entries', 10);
        return $query->result();
    }

    public function insert_entry()
    {
        $this->title    = $_POST['title']; // please read the below note
        $this->content  = $_POST['content'];
        $this->date = time();

        $this->db->insert('entries', $this);
    }

    public function update_entry()
    {
        $this->title    = $_POST['title'];
        $this->content  = $_POST['content'];
        $this->date = time();

        $this->db->update('entries', $this, array('id' => $_POST['id']));
    }
    
    
    public function get_cate_list()
    {
        $query = $this->db->get('cate');
        return $query->result();
    }

}


?>