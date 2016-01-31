<?php
namespace Home\Controller;
use Think\Controller;
class XijuController extends HeadController {
    public function index($table = 'xiju'){
        R('Store/index',array($table));
    }

    public function xijuAdd($table = 'xiju', $width='', $height=''){
        R('Store/storeAdd',array($table, $width = 184, $height= 234));
    }

    public function checkTitle($table = 'xiju'){
        R('Store/checkTitle',array($table));
    }

    public function modify($table = 'xiju'){
        R('Store/modify',array($table));
    }

    public function updateXiju($table = 'xiju', $width='', $height=''){
        R('Store/updateStroe',array($table, $width = 184, $height= 234));
    }

    public function write(){
        R('Store/write');
    }

    public function detail($table='xiju'){
          R('Store/detail',array($table));
    }

    public function xijuDel($table='xiju'){
        R('Store/storeDel',array($table));
    }


}