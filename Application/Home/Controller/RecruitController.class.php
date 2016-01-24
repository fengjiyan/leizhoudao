<?php
namespace Home\Controller;
use Think\Controller;
class RecruitController extends Controller {
    public function index($table = 'recruit'){
        R('Store/index',array($table));
    }

    public function recruitAdd($table = 'recruit', $width='', $height=''){
        R('Store/storeAdd',array($table, $width = 184, $height= 234));
    }

    public function checkTitle($table = 'recruit'){
        R('Store/checkTitle',array($table));
    }

    public function modify($table = 'recruit'){
        R('Store/modify',array($table));
    }

    public function updateRecruit($table = 'recruit', $width='', $height=''){
        R('Store/updateStroe',array($table, $width = 184, $height= 234));
    }
    public function write(){
        R('Store/write');
    }
    public function detail($table='recruit'){
          R('Store/detail',array($table));
    }

    public function recruitDel($table='recruit'){
        R('Store/storeDel',array($table));
    }


}