<?php 
class Cate_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        
        $this->load->database();
        $this->load->helper('url');
        // Your own constructor code
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