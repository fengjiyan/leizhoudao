<?php
namespace Home\Controller;
use Think\Controller;
class SeaController extends Controller {
    public function index($table = 'sea'){
        R('Store/index',array($table));
    }

    public function seaAdd($table = 'sea', $width='', $height=''){
        R('Store/storeAdd',array($table, $width = 184, $height= 234));
    }

    public function checkTitle($table = 'sea'){
        R('Store/checkTitle',array($table));
    }

    public function modify($table = 'sea'){
        R('Store/modify',array($table));
    }

    public function updateSea($table = 'sea', $width='', $height=''){
        R('Store/updateStroe',array($table, $width = 184, $height= 234));
    }
    public function write(){
        R('Store/write');
    }
    public function detail($table='sea'){
          R('Store/detail',array($table));
    }

    public function seaDel($table='sea'){
        R('Store/storeDel',array($table));
    }


}