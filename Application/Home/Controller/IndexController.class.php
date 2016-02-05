<?php
namespace Home\Controller;
use Think\Controller;

class IndexController extends HeadController {
    private $_column = null;
    private $_dianmian = null;
    //控制器初始化方法
    public function _initialize(){
        parent::_initialize();
        $this->_column = M('column');
        $this->_dianmian = M('dianmian');
        $this->_friend = M('plug_link');

    }
    public function index(){
        $list =  $this->_dianmian->order('add_time')->field("id,title,describe,pic")->limit(8)->select();
        $link =  $this->_friend->order('plug_link_id')->field("plug_link_id,plug_link_name,plug_link_url")->select();
        $dpcolumn = $this->_column->where(array('column_leftid' => 2))->order("c_id asc")->field("c_id,column_name,column_leftid")->select();//店铺大全
        $xqscolumn = $this->_column->where(array('column_leftid' => 4))->order("c_id asc")->field("c_id,column_name,column_leftid")->select();//喜庆
        $qccolumn = $this->_column->where(array('column_leftid' => 5))->order("c_id asc")->field("c_id,column_name,column_leftid")->select();//汽车
        $xqcolumn = $this->_column->where(array('column_leftid' => 6))->order("c_id asc")->field("c_id,column_name,column_leftid")->select();//相亲
        $fzcolumn = $this->_column->where(array('column_leftid' => 7))->order("c_id asc")->field("c_id,column_name,column_leftid")->select();//房子
        $dqcolumn = $this->_column->where(array('column_leftid' => 8))->order("c_id asc")->field("c_id,column_name,column_leftid")->select();//电器
        $hxcolumn = $this->_column->where(array('column_leftid' => 9))->order("c_id asc")->field("c_id,column_name,column_leftid")->select();//海鲜
        $mscolumn = $this->_column->where(array('column_leftid' => 11))->order("c_id asc")->field("c_id,column_name,column_leftid")->select();//美食
        $nycolumn = $this->_column->where(array('column_leftid' => 12))->order("c_id asc")->field("c_id,column_name,column_leftid")->select();//农业
        $jycolumn = $this->_column->where(array('column_leftid' => 13))->order("c_id asc")->field("c_id,column_name,column_leftid")->select();//教育
        $zpcolumn = $this->_column->where(array('column_leftid' => 163))->order("c_id asc")->field("c_id,column_name,column_leftid")->select();//招聘
        $cjcolumn = $this->_column->where(array('column_leftid' => 31))->order("c_id asc")->field("c_id,column_name,column_leftid")->select();//厂家/批发/代理商
        $jjcolumn = $this->_column->where(array('column_leftid' => 15))->order("c_id asc")->field("c_id,column_name,column_leftid")->select();//家居
        $lzjcolumn = $this->_column->where(array('column_leftid' => 154))->order("c_id asc")->field("c_id,column_name,column_leftid")->select();//雷州剧
        //var_dump($sub_column);
        $this->assign("dlist",$list);
        $this->assign("link",$link);
        $this->assign("dpcolumn",$dpcolumn);
        $this->assign("xqscolumn",$xqscolumn);
        $this->assign("qccolumn",$qccolumn);
        $this->assign("xqcolumn",$xqcolumn);
        $this->assign("fzcolumn",$fzcolumn);
        $this->assign("dqcolumn",$dqcolumn);
        $this->assign("hxcolumn",$hxcolumn);
        $this->assign("mscolumn",$mscolumn);
        $this->assign("nycolumn",$nycolumn);
        $this->assign("jycolumn",$jycolumn);
        $this->assign("zpcolumn",$zpcolumn);
        $this->assign("cjcolumn",$cjcolumn);
        $this->assign("jjcolumn",$jjcolumn);
        $this->assign("lzjcolumn",$lzjcolumn);
		$this->display();
    }

}