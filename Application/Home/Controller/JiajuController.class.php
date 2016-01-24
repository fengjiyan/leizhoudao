<?php
namespace Home\Controller;
use Think\Controller;
class JiajuController extends Controller {
    public function index($table = 'jiaju'){
        R('Store/index',array($table));
    }

    public function jiajuAdd($table = 'jiaju', $width='', $height=''){
        R('Store/storeAdd',array($table, $width = 184, $height= 234));
    }

    public function checkTitle($table = 'jiaju'){
        R('Store/checkTitle',array($table));
    }

    public function modify($table = 'jiaju'){
        R('Store/modify',array($table));
    }

    public function updateJiaju($table = 'jiaju', $width='', $height=''){
        R('Store/updateStroe',array($table, $width = 184, $height= 234));
    }

    public function detail($table='jiaju'){
          R('Store/detail',array($table));
    }

    public function write(){
        R('Store/write');
    }

    public function jiajuDel($table='jiaju'){
        R('Store/storeDel',array($table));
    }


}