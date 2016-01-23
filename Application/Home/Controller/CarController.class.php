<?php
namespace Home\Controller;
use Think\Controller;
class CarController extends Controller {
    public function index($table = 'car'){
        R('Store/index',array($table));
    }

    public function carAdd($table = 'car', $width='', $height=''){
        R('Store/storeAdd',array($table, $width = 184, $height= 234));
    }

    public function checkTitle($table = 'car'){
        R('Store/checkTitle',array($table));
    }

    public function modify($table = 'car'){
        R('Store/modify',array($table));
    }

    public function updatecar($table = 'car', $width='', $height=''){
        R('Store/updateStroe',array($table, $width = 184, $height= 234));
    }

    public function detail($table='car'){
          R('Store/detail',array($table));
    }

    public function carDel($table='car'){
        R('Store/storeDel',array($table));
    }


}