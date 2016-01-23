<?php
namespace Home\Controller;
use Think\Controller;
class FreeController extends Controller {
    private $_column = null;
    private $_dianmian = null;
    private $_marr = null;
    //控制器初始化方法
    public function _initialize(){
        //parent::_initialize();
        $this->_column = M('column');
        $this->_dianmian = M('dianmian');
        $this->_marry = M('marry');
        // $this->header();

    }
    public function index($module = CONTROLLER_NAME){
        $lz_area = array('海康城区','附城','白沙','沈塘','客路','杨家','唐家','纪家','企水','东里','乌石','南兴','松竹','雷高','龙门','英利','北和','调风','覃斗','徐闻','其它');
        $xl_area = array('海康城区','乡镇','农村','其他');
        $xl_areas = array('海康','湛江','徐闻','城月','遂溪','附城','白沙','东里','雷高','龙门','其他');
        if($module == 'Free'){
           $c_id = 2;
        }
        $cid = (I('cid') ? I('cid') : $c_id);
        if(!empty($cid)){//获取地区
            $cid = $cid ? $cid : $c_id ;
            $conditon[] = "column_leftid = '$cid'";
        }
        $data = $this->_column->where(array('column_name' => I('bl')))->find();
        $list = $this->_column->where($conditon)->order('c_id')->select();
        //echo M()->_sql();
        $sub_column = $this->_column->where(array('column_leftid' => $data['c_id']))->select();
        $this->assign('lz_area',$lz_area);
        $this->assign('xl_area',$xl_area);
        $this->assign('xl_areas',$xl_areas);
        $this->assign('sub_column',$sub_column);
        $this->assign('list', $list);
        $this->display();
    }

}