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
    
    /**
     * 据cate_id的link数据集合
     * @param unknown $cate_id
     */
    public function get_link($cate_id)
    {
        $query = $this->db->select('title, url, desc')->get_where('link', ['pid' => $cate_id]);
        return $query->result();
    }
    
    /**
     * 用户流量处理
     */
    public function tourist_add()
    {
        date_default_timezone_set("Asia/Shanghai"); //时区设置
        
        $res = $this->db->select('time')->limit(1)->order_by('id', 'desc')->get_where('tourist', ['ip' => $this->input->ip_address()]);
        $res_data = $res->result();
        
        //sina地理位置接口
        $area      = file_get_contents("http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=json&ip={$this->input->ip_address()}");
        $arr_data  = json_decode($area, true);
        $error     = json_last_error();
        
        if ((time() - strtotime($res_data[0]->time)) > 30){
            //json是否存在错误
            if (!empty($error)) {
                $see = [
                    'type'     => $this->getBrowser(),
                    'ip'       => $this->input->ip_address(),
                    'country'  => '',
                    'province' => '',
                    'city'     => '',
                ];
            }else {
                $see = [
                    'type'     => $this->getBrowser(),
                    'ip'       => $this->input->ip_address(),
                    'country'  => $arr_data['country'],
                    'province' => $arr_data['province'],
                    'city'     => $arr_data['city'],
                ];
            }
            $this->db->insert('tourist', $see);
        }
        
    }
    
    /**
     * 浏览器处理
     * @return string
     */
    public function getBrowser()
    {
    
        switch ($_SERVER['HTTP_USER_AGENT'])
        {
            case null:
                return 'machine';
                break;
    
            case false !== strpos($_SERVER['HTTP_USER_AGENT'],'MSIE 9.0'):
                return 'ie9';
                break;
    
            case false !== strpos($_SERVER['HTTP_USER_AGENT'],'MSIE 8.0'):
                return 'ie8';
                break;
    
            case false !== strpos($_SERVER['HTTP_USER_AGENT'],'MSIE 7.0'):
                return 'ie7';
                break;
    
            case false !== strpos($_SERVER['HTTP_USER_AGENT'],'MSIE 6.0'):
                return 'ie6';
                break;
    
            case false !== strpos($_SERVER['HTTP_USER_AGENT'],'Firefox'):
                return 'fox';
                break;
    
            case false !== strpos($_SERVER['HTTP_USER_AGENT'],'Chrome'):
                return 'chrome';
                break;
    
            case false !== strpos($_SERVER['HTTP_USER_AGENT'],'Safari'):
                return 'safari';
                break;
    
            case false !== strpos($_SERVER['HTTP_USER_AGENT'],'Opera'):
                return 'opera';
                break;
    
            case false !== strpos($_SERVER['HTTP_USER_AGENT'],'360SE'):
                return '360se';
                break;
    
            default:
                return 'notidentify';
                break;
    
        }
    
    }

}


?>