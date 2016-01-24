<?php
namespace Home\Controller;
use Think\Controller;
class ChangController extends Controller {
    public function index($table = 'chang'){
        R('Store/index',array($table));
    }

    public function changAdd($table = 'chang', $width='', $height=''){
        R('Store/storeAdd',array($table, $width = 184, $height= 234));
    }

    public function checkTitle($table = 'chang'){
        R('Store/checkTitle',array($table));
    }

    public function modify($table = 'chang'){
        R('Store/modify',array($table));
    }

    public function updateChang($table = 'chang', $width='', $height=''){
        R('Store/updateStroe',array($table, $width = 184, $height= 234));
    }

    public function write(){
        R('Store/write');
    }

    public function detail($table='chang'){
          R('Store/detail',array($table));
    }

    public function changDel($table='chang'){
        R('Store/storeDel',array($table));
    }


}