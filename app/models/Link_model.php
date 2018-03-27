<?php 
class Link_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        
        $this->load->database();
        $this->load->helper('url');
        // Your own constructor code
    }

    
    /**
     * link列表显示数据
     */
    public function get_link_list()
    {
//         $sql = "select link.*, cate.title as cate_title from link left join cate on link.pid = cate.id order by link.sort desc";
//         $query = $this->db->query($sql);
        //原生和查询构造器两种方式均可
        $query = $this->db->select('link.*, cate.title as cate_title')->from('link')->join('cate', 'link.pid = cate.id')->order_by('sort', 'desc')->get();
        return $query->result();
    }
    
    /**
     * link查询edit页面数据
     * @param unknown $id
     */
    public function link_edit($id)
    {
        $query = $this->db->get_where('link', ['id' => $id]);
        return $query->result_array();
    }
    
    /**
     * link数据修改
     */
    public function link_updates()
    {
        $update_data = [
            'title' => $this->input->post('title'),
            'sort'  => $this->input->post('sort'),
            'desc'  => $this->input->post('desc'),
        ];
        
        return $this->db->update('link', $update_data, ['id' => $this->input->post('id')]);
    }
    
    /**
     * link数据添加
     */
    public function link_adds()
    {
        $add_data = [
            'title' => $this->input->post('title'),
            'url'   => $this->input->post('url'),
            'sort'  => $this->input->post('sort'),
            'pid'   => $this->input->post('pid'),
            'desc'  => $this->input->post('desc'),
//             'time'  => time(),
        ];
        
        return $this->db->insert('link', $add_data);
    }
    
    /**
     * link数据删除 TODO软删除
     * @param unknown $id
     */
    public function link_deletes($id)
    {
        return $this->db->delete('link', ['id' => $id]);
    }
    
    /**
     * 栏目list
     */
    public function cate_list()
    {
        $query = $this->db->select('id, title')->get('cate');
        return $query->result();
    }

}


?>