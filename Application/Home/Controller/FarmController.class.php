<?php
namespace Home\Controller;
use Think\Controller;
class FarmController extends HeadController {
    public function index($table = 'farm'){
        R('Store/index',array($table));
    }

    public function farmAdd($table = 'farm', $width='', $height=''){
        R('Store/storeAdd',array($table, $width = 184, $height= 234));
    }

    public function checkTitle($table = 'farm'){
        R('Store/checkTitle',array($table));
    }

    public function modify($table = 'farm'){
        R('Store/modify',array($table));
    }

    public function updateFarm($table = 'farm', $width='', $height=''){
        R('Store/updateStroe',array($table, $width = 184, $height= 234));
    }
    public function write(){
        R('Store/write');
    }
    public function detail($table='farm'){
          R('Store/detail',array($table));
    }

    public function farmDel($table='farm'){
        R('Store/storeDel',array($table));
    }


}