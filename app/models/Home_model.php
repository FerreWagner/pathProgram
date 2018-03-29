<?php 
class Home_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        
        $this->load->database();
        $this->load->helper('url');
        // Your own constructor code
    }

    /**
     * 得到所有cate(object)
     */
    public function get_cate()
    {
        $id_obj = $this->db->select('id, title')->get('cate');
        return $id_obj->result();
    }
    
    public function get_link($cate_id)
    {
        $query = $this->db->select('title, url, desc')->get_where('link', ['pid' => $cate_id]);
        return $query->result();
    }

}


?>