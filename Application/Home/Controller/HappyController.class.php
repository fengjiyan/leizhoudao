<?php
namespace Home\Controller;
use Think\Controller;
class HappyController extends Controller {
    public function index($table = 'happy'){
        R('Store/index',array($table));
    }

    public function happyAdd($table = 'happy', $width='', $height=''){
        R('Store/storeAdd',array($table, $width = 210, $height= 160));
    }

    public function checkTitle($table = 'happy'){
        R('Store/checkTitle',array($table));
    }

    public function modify($table = 'happy'){
        R('Store/modify',array($table));
    }

    public function updateHappy($table = 'happy', $width='', $height=''){
        R('Store/updateStroe',array($table, $width = 210, $height= 160));
    }

    public function detail($table='happy'){
          R('Store/detail',array($table));
    }

    public function happyDel($table='happy'){
        R('Store/storeDel',array($table));
    }

    public function write(){
        R('Store/write');
    }
}