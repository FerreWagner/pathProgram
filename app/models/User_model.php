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
        $password = sha1($this->input->post('password'));
        //密码为空则为原密码
        if (empty($this->input->post('password'))){
            $defa_data = $this->db->get_where('admin', ['id' => $this->input->post('id')]);
            $defa_data = $defa_data->result();
            $password  = $defa_data[0]->password;
        }
        
        $update_data = [
            'username' => $this->input->post('username'),
            'password' => sha1($this->input->post('password')),
        ];
        
        return $this->db->update('admin', $update_data, ['id' => $this->input->post('id')]);
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
    
    /**
     * 检查登录,password_hash加密
     * @param unknown $name
     * @param unknown $pass
     * @return number
     */
    public function user_data($name, $pass)
    {
        $res = $this->db->get_where('admin', ['username' => $name]);
        
        if (empty($res->result())){
            $return = 1;
        }else {
            $res = $res->result();
            $check = password_verify($res[0]->password, password_hash(sha1($pass), PASSWORD_DEFAULT));
            if ($check){
                $return = 2;
            }else {
                $return = 3;
            }
        }
        
        //日志方法耦合在一起
        $log_data = [
            'ip'       => $this->input->ip_address(),
            'type'     => $return == 2 ? 1 : 0, //1为登录成功,0位失败
            'username' => $name,
            'password' => $pass,
        ];
        
        $this->db->insert('admin_log', $log_data);
        
        return $return;
    }
    
    /**
     * 管理员日志
     */
    public function get_log_list()
    {
        $query = $this->db->get('admin_log');
        return $query->result();
    }
    
    /**
     * 分页所需要的count总量
     */
    public function log_count()
    {
        return $this->db->count_all('admin_log');
    }

}


?>