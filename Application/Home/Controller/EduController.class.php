<?php
namespace Home\Controller;
use Think\Controller;
class EduController extends HeadController {
    public function index($table = 'edu'){
        R('Store/index',array($table));
    }

    public function eduAdd($table = 'edu', $width='', $height=''){
        R('Store/storeAdd',array($table, $width = 184, $height= 234));
    }

    public function checkTitle($table = 'edu'){
        R('Store/checkTitle',array($table));
    }

    public function modify($table = 'edu'){
        R('Store/modify',array($table));
    }

    public function updateEdu($table = 'edu', $width='', $height=''){
        R('Store/updateStroe',array($table, $width = 184, $height= 234));
    }
    public function write(){
        R('Store/write');
    }
    public function detail($table='edu'){
          R('Store/detail',array($table));
    }

    public function eduDel($table='edu'){
        R('Store/storeDel',array($table));
    }


}