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
    public function get_log_list($curr_num, $add_row)
    {
        //$this->db->last_query() 打印执行的最后一条sql
        if ($curr_num == 1){
            $query = $this->db->limit($add_row)->get('admin_log');
        }else {
            $query = $this->db->limit($add_row, $curr_num)->get('admin_log');
        }
        //TODO TIPS:CI中的limit与原生sql的limit相反
        return $query->result();
    }
    
    /**
     * 分页所需要的count总量
     */
    public function log_count()
    {
        return $this->db->count_all('admin_log');
    }
    
//-------------------------以下为前台用户数据处理,因项目大小统一在User_model中-----------------------------------------------------
    
    /**
     * 用户流量数据
     * @return NULL[]
     */
    public function user_type()
    {
        $data = [];
        $data['chrome']  = $this->db->or_where('type', 'chrome')->or_where('type', '360se')->get('tourist');
        $data['opera']   = $this->db->or_where('type', 'opera')->or_where('type', 'safari')->get('tourist');
        $data['firefox'] = $this->db->where('type', 'firefox')->get('tourist');
        $data['ie']      = $this->user_log_count() - count($data['chrome']->result()) - count($data['opera']->result()) - count($data['firefox']->result());
        
        $data['chrome']  = count($data['chrome']->result());
        $data['opera']   = count($data['opera']->result());
        $data['firefox'] = count($data['firefox']->result());
        return $data;
    }
    
    /**
     * 过去10条数据
     */
    public function user_new()
    {
        $query = $this->db->limit(10)->order_by('id', 'desc')->get('tourist');
        return $query->result();
    }
    
    /**
     * 用户流量聚合
     */
    public function user_log_count()
    {
        return $this->db->count_all('tourist');
    }

}


?>