<?php
namespace Home\Controller;
use Think\Controller;
class HeadController extends Controller {
    public function _initialize(){
        $this->_column = M('column');
        $this->_dianmian = M('dianmian');
        $this->_happy = M('happy');
        $this->_car = M('car');
        $list_top=M()->query("SELECT union_type,id,title,add_time FROM(SELECT 1 AS union_type,c.id,c.title,c.add_time,c.attr FROM mr_dianmian c UNION SELECT 2,dhy.id,dhy.title,dhy.add_time,dhy.attr FROM mr_happy dhy UNION SELECT 3,h.id,h.title,h.add_time,h.attr FROM mr_car h UNION SELECT 4,ma.id,ma.title,ma.add_time,ma.attr FROM mr_marry ma UNION SELECT 5,ho.id,ho.title,ho.add_time,ho.attr FROM mr_house ho UNION SELECT 6,dq.id,dq.title,dq.add_time,dq.attr FROM mr_dianqi dq UNION SELECT 7,se.id,se.title,se.add_time,se.attr FROM mr_sea se UNION SELECT 8,fo.id,fo.title,fo.add_time,fo.attr FROM mr_food fo UNION SELECT 9,fa.id,fa.title,fa.add_time,fa.attr FROM mr_farm fa UNION SELECT 10,ed.id,ed.title,ed.add_time,ed.attr FROM mr_edu ed UNION SELECT 11,ri.id,ri.title,ri.add_time,ri.attr FROM mr_recruit ri UNION SELECT 12,ch.id,ch.title,ch.add_time,ch.attr FROM mr_chang ch UNION SELECT 13,ji.id,ji.title,ji.add_time,ji.attr FROM mr_jiaju ji UNION SELECT 14,xj.id,xj.title,xj.add_time,xj.attr FROM mr_xiju xj) ta
WHERE ta.attr = 1 ORDER BY ta.add_time desc LIMIT 10");
        $list_new=M()->query("SELECT union_type,id,title,add_time FROM(SELECT 1 AS union_type,c.id,c.title,c.add_time,c.attr FROM mr_dianmian c UNION SELECT 2,dhy.id,dhy.title,dhy.add_time,dhy.attr FROM mr_happy dhy UNION SELECT 3,h.id,h.title,h.add_time,h.attr FROM mr_car h UNION SELECT 4,ma.id,ma.title,ma.add_time,ma.attr FROM mr_marry ma UNION SELECT 5,ho.id,ho.title,ho.add_time,ho.attr FROM mr_house ho UNION SELECT 6,dq.id,dq.title,dq.add_time,dq.attr FROM mr_dianqi dq UNION SELECT 7,se.id,se.title,se.add_time,se.attr FROM mr_sea se UNION SELECT 8,fo.id,fo.title,fo.add_time,fo.attr FROM mr_food fo UNION SELECT 9,fa.id,fa.title,fa.add_time,fa.attr FROM mr_farm fa UNION SELECT 10,ed.id,ed.title,ed.add_time,ed.attr FROM mr_edu ed UNION SELECT 11,ri.id,ri.title,ri.add_time,ri.attr FROM mr_recruit ri UNION SELECT 12,ch.id,ch.title,ch.add_time,ch.attr FROM mr_chang ch UNION SELECT 13,ji.id,ji.title,ji.add_time,ji.attr FROM mr_jiaju ji UNION SELECT 14,xj.id,xj.title,xj.add_time,xj.attr FROM mr_xiju xj) tas
 ORDER BY tas.add_time desc LIMIT 10");
        $this->assign("listvo",$list_top);
        $this->assign("listnew",$list_new);
        $search_column =  $this->_column->where(array('column_leftid' => 1))->order('c_id')->select();
        $this->assign('search_column',$search_column);// 赋值数据集

        $sys=M('sys')->where(array('sys_id'=>1))->find();
        $this->assign('sys',$sys);

    }

    public function  search(){
        $type = I('type');
        $name = I('name');
        $table = empty($type) ? 'dianmian' : $type;
        $search_arr = array("like", "%".$name."%");
        switch($type){
            case '店铺大全': $table = 'dianmian'; $conditon['title'] = $search_arr;break;
            case '喜庆': $table = 'happy'; $conditon['title'] = $search_arr;break;
            case '汽车': $table = 'car'; $conditon['title'] = $search_arr;break;
            case '相亲': $table = 'marry'; $conditon['title'] = $search_arr;break;
            case '房子': $table = 'house'; $conditon['title'] = $search_arr;break;
            case '电器': $table = 'dianqi'; $conditon['title'] = $search_arr;break;
            case '海鲜': $table = 'sea'; $conditon['title'] = $search_arr;break;
            case '美食': $table = 'food'; $conditon['title'] = $search_arr;break;
            case '农业': $table = 'farm'; $conditon['title'] = $search_arr;break;
            case '教育': $table = 'edu'; $conditon['title'] = $search_arr;break;
            case '招聘': $table = 'recruit'; $conditon['title'] = $search_arr;break;
            case '厂|批发|代': $table = 'chang'; $conditon['title'] = $search_arr;break;
            case '家居': $table = 'jiaju'; $conditon['title'] = $search_arr;break;
            case '雷州剧': $table = 'xiju'; $conditon['title'] = $search_arr;break;
//            case '七星彩梦册': $table = 'qixingcai'; $conditon['title'] = $search_arr;break;
        }
        $count      = M("$table")->where($conditon)->count();// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数
        //分页跳转的时候保证查询条件
        foreach($conditon as $key=>$val) {
            $Page->parameter[$key]   =   urlencode($val);
        }
        $show       = $Page->show();// 分页显示输出
        $list = M("$table")->where($conditon)->order('add_time desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        //$a = "<b style='color:red'>".$_GET['name']."</b>";
        //echo str_replace($_POST['text'],$a,$list['title']);
        //echo M()->_sql();
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('count',$count);// 赋值分页输出
        $this->display('public/search');
    }

    public  function sayAdd(){
        $name = session('account');
        $id = I('id');
        $article_title = I("article_title");
        $href = "/".I("href").".html";
        $condition['user_name'] = $name;
        $condition['article_id'] = $id;
        $user = M('member_list')->where("member_list_username="."'$name'")->find();
        $list = M('say')->where($condition)->find();
        if($list){
            $this->success('你评论过了,不能再评，谢谢!');
        }
        if (!IS_AJAX){
            $this->error('提交方式不正确');
        }else{
            $sl_data=array(
                'href'=>$href,
                'article_title'=>$article_title,
                'user_name'=>$name,
                'photo'=>$user['member_list_photo'],
                'article_id'=>$id,
                'content'=>I('content'),
                'add_time'=>time(),
                'ip'=>get_client_ip(),
            );
            M('say')->add($sl_data);
            $this->success('恭喜你，评论成功');
        }
    }

    public function help(){
        $id = I('id');
        $list = M("news")->where(array('n_id'=>$id))->select();
        foreach($list as $list){}
        $this->assign("list", $list);
        $this->display('public/help');
    }


}