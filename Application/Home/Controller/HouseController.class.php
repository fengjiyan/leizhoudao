<?php
namespace Home\Controller;
use Think\Controller;
class HouseController extends HeadController {
    public function index($table = 'house'){
        R('Store/index',array($table));
    }

    public function houseAdd($table = 'house', $width='', $height=''){
        R('Store/storeAdd',array($table, $width = 184, $height= 234));
    }

    public function checkTitle($table = 'house'){
        R('Store/checkTitle',array($table));
    }

    public function modify($table = 'house'){
        R('Store/modify',array($table));
    }
    public function write(){
        R('Store/write');
    }
    public function updateHouse($table = 'house', $width='', $height=''){
        R('Store/updateStroe',array($table, $width = 184, $height= 234));
    }

    public function detail($table='house'){
          R('Store/detail',array($table));
    }

    public function houseDel($table='house'){
        R('Store/houseDel',array($table));
    }


}