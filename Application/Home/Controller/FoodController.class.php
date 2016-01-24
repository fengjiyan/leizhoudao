<?php
namespace Home\Controller;
use Think\Controller;
class FoodController extends Controller {
    public function index($table = 'food'){
        R('Store/index',array($table));
    }

    public function foodAdd($table = 'food', $width='', $height=''){
        R('Store/storeAdd',array($table, $width = 184, $height= 234));
    }

    public function checkTitle($table = 'food'){
        R('Store/checkTitle',array($table));
    }

    public function modify($table = 'food'){
        R('Store/modify',array($table));
    }

    public function updateFood($table = 'food', $width='', $height=''){
        R('Store/updateStroe',array($table, $width = 184, $height= 234));
    }
    public function write(){
        R('Store/write');
    }
    public function detail($table='food'){
          R('Store/detail',array($table));
    }

    public function foodDel($table='food'){
        R('Store/storeDel',array($table));
    }


}