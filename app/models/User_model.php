<?php 
class User_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        
        $this->load->database();
        $this->load->helper('url');
        // Your own constructor code
    }

    
    /**
     * user列表显示数据
     */
    public function get_user_list()
    {
        $query = $this->db->get('admin');
        return $query->result();
    }
    
    /**
     * user查询edit页面数据
     * @param unknown $id
     */
    public function user_edit($id)
    {
        $query = $this->db->get_where('admin', ['id' => $id]);
        return $query->result_array();
    }
    
    /**
     * user数据修改
     */
    public function user_updates()
    {
        $update_data = [
            'title' => $this->input->post('title'),
            'sort'  => $this->input->post('sort'),
            'desc'  => $this->input->post('desc'),
        ];
        
        return $this->db->update('user', $update_data, ['id' => $this->input->post('id')]);
    }
    
    /**
     * user数据添加
     */
    public function user_adds()
    {
        $add_data = [
            'username' => $this->input->post('username'),
            'password' => sha1($this->input->post('password')),
        ];
        
        return $this->db->insert('admin', $add_data);
    }
    
    /**
     * user数据删除 TODO软删除
     * @param unknown $id
     */
    public function user_deletes($id)
    {
        return $this->db->delete('admin', ['id' => $id]);
    }

}


?>