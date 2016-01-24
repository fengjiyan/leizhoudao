<?php
namespace Home\Controller;
use Think\Controller;
class DianqiController extends Controller {
    public function index($table = 'dianqi'){
        R('Store/index',array($table));
    }

    public function dianqiAdd($table = 'dianqi', $width='', $height=''){
        R('Store/storeAdd',array($table, $width = 184, $height= 234));
    }

    public function checkTitle($table = 'dianqi'){
        R('Store/checkTitle',array($table));
    }

    public function modify($table = 'dianqi'){
        R('Store/modify',array($table));
    }

    public function updateDianqi($table = 'dianqi', $width='', $height=''){
        R('Store/updateStroe',array($table, $width = 184, $height= 234));
    }
    public function write(){
        R('Store/write');
    }
    public function detail($table='dianqi'){
          R('Store/detail',array($table));
    }

    public function dianqiDel($table='dianqi'){
        R('Store/storeDel',array($table));
    }


}