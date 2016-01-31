<?php
namespace Home\Controller;
use Think\Controller;
class MarryController extends HeadController {
    public function index($table = 'marry'){
        R('Store/index',array($table));
    }

    public function marryAdd($table = 'marry', $width='', $height=''){
        R('Store/storeAdd',array($table, $width = 184, $height= 234));
    }

    public function checkTitle($table = 'marry'){
        R('Store/checkTitle',array($table));
    }

    public function modify($table = 'marry'){
        R('Store/modify',array($table));
    }

    public function updateMarry($table = 'marry', $width='', $height=''){
        R('Store/updateStroe',array($table, $width = 184, $height= 234));
    }

    public function detail($table='marry'){
          R('Store/detail',array($table));
    }

    public function marryDel($table='marry'){
        R('Store/storeDel',array($table));
    }


}