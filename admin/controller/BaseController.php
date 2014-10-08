<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BaseController
 *
 * @author koudejian
 */
class BaseController {
    //参数
    public $args = null;
    
    /**
     * 初始化参数数组
     * @param type $arrs
     */
    public function __construct($arrs){
        $this->args = $arrs;
    }
    
    
}
