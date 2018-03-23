<?php 
class Cate_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        
        $this->load->helper('url');
        
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
    
    /**
     * cate列表显示数据
     */
    public function get_cate_list()
    {
        $query = $this->db->order_by('sort')->get('cate');
        return $query->result();
    }
    
    /**
     * cate查询edit页面数据
     * @param unknown $id
     */
    public function cate_edit($id)
    {
        $query = $this->db->get_where('cate', ['id' => $id]);
        return $query->result_array();
    }
    
    /**
     * cate数据修改
     */
    public function cate_updates()
    {
        $update_data = [
            'name' => $this->input->post('name'),
            'sort' => $this->input->post('sort'),
            'desc' => $this->input->post('desc'),
        ];
        
        return $this->db->update('cate', $update_data, ['id' => $this->input->post('id')]);
    }

}


?>