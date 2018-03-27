<?php

//表单验证规则，当使用run()方法时，自动调用
//TIPS：还可携程某组的调用规则等来使用对应的组

$config = array(
    array(
        'field' => 'title', 
        'label' => '标题', 
        'rules' => 'required|is_unique[link.title]',
    ),
    array(
        'field' => 'url',
        'label' => '链接', 
        'rules' => 'required|is_unique[link.url]|valid_url'
    ),
    array(
        'field' => 'sort',  
        'label' => '排序', 
        'rules' => 'required'
    ),
    array(
        'field' => 'pid',   
        'label' => '分类', 
        'rules' => 'required'
    )
);