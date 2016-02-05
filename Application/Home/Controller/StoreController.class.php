<?php
namespace Home\Controller;
use Think\Controller;
class StoreController extends HeadController {
    private $_column = null;
    //控制器初始化方法
    public function _initialize(){
        parent::_initialize();
        $this->_column = M('column');
       // $this->head();

    }
    public function index($table = 'dianmian', $module = CONTROLLER_NAME){
        switch($module){
            case 'Happy'  : $bf = '喜庆';break;
            case 'Car'  : $bf = '汽车';break;
            case 'House'  : $bf = '房子';break;
            case 'Dianqi' : $bf = '电器';break;
            case 'Sea'    : $bf = '海鲜';break;
            case 'Food'   : $bf = '美食';break;
            case 'Farm'   : $bf = '农业';break;
            case 'Edu'    : $bf = '教育';break;
            case 'Recruit': $bf = '招聘';break;
            case 'Chang'  : $bf = '厂|批发|代';break;
            case 'Jiaju'  : $bf = '家居';break;
            case 'Xiju'   : $bf = '雷州剧';break;
        }
        // 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
        $bf =I('bf') ? I('bf') : $bf ;
        $data = $this->_column->where(array('column_name' => $bf))->find();
        $sub_column = $this->_column->where(array('column_leftid' => $data['c_id']))->select();
        $column =  $this->_column->where(array('column_leftid' => 2))->order('c_id')->select();
        $this->assign('sub_column',$sub_column);
        $this->assign('column',$column);// 赋值数据集

        $dq = I('dq');//喜庆地区
        $ars = I('ars');//对象范围
        $bfs = I('bfs');//地区
        $xfs = I('xfs');//年龄
        $tms = I('tms');//时间

        $ar = I('ar');//地区
        $bf = I('bf');//大分类
        $xf = I('xf');//小分类
        $ty = I('ty');//类型
        $tp = I('tp');//类型
        $tys = I('tys');//类型
        $tm = I('tm');//有效时间

        if(!empty($ar)){//获取地区
            $ar = $ar ? $ar : '' ;
            $conditon[] = "area = '$ar'";
        }
        if(!empty($bf)){//店铺获取大分类
            $bf = $bf ? $bf : '' ;
            $conditon[] = "category = '$bf'";
        }
        if(!empty($xf)){//店铺获取小分类
            $xf = $xf ? $xf : '' ;
            $conditon[] = "sub_cateid = '$xf'";
        }
        if(!empty($ty)){//获取类型
            $ty = $ty ? $ty : '' ;
            $conditon[] = "identity = '$ty'";
        }
        if(!empty($tys)){//获取类型
            $tys = $tys ? $tys : '' ;
            $conditon[] = "manage = '$tys'";
        }
        if(!empty($tp)){//获取类型
            $tp = $tp ? $tp : '' ;
            $conditon[] = "type = '$tp'";
        }
        switch ($tm) { //获取时间
            case '7天':
                $conditon[]='expire = '.(time()-7*24*3600);
                break;
            case '15天':
                $conditon[]='expire = '.(time()-15*24*3600);
                break;
            case '30天':
                $conditon[]='expire = '.(time()-30*24*3600);
                break;
            case '60天':
                $conditon[]='expire = '.(time()-60*24*3600);
                break;
            case '90天':
                $conditon[]='expire = '.(time()-90*24*3600);
                break;
            case '180天':
                $conditon[]='expire = '.(time()-180*24*3600);
                break;
            case '长期':
                $conditon[]='expire = '.(time()-240*24*3600);
                break;
        }

        //相亲部分
        if(!empty($ars)){
            $ars = $ars ? $ars : '' ;//对象范围
            $conditon[] = "object = '$ars'";
        }
        if(!empty($bfs)){//地区
            $bfs = $bfs ? $bfs : '' ;
            $conditon[] = "area = '$bfs'";
        }
        switch ($xfs) { //获取年龄
            case '22岁以下':
                $conditon[]='age <= 22';
                break;
            case '23岁-30岁':
                $conditon[]='age between 23 and 30';
                break;
            case '30岁-40岁':
                $conditon[]='age between 30 and 40';
                break;
            case '40岁以上':
                $conditon[]='age > 40';
                break;
        }

        //获取年龄
        $day7  = 7 * 24 * 3600 + time();
        $day15 = 15 * 15 * 3600 + time();
        $day30 = 30 * 30 * 3600 + time();
        $day60 = 60 * 30 * 3600 + time();
        $day90 = 90 * 30 * 3600 + time();
        $day180 = 180 * 30 * 3600 + time();
        switch ($tm) {
            case '7天以下':
                $conditon[]="expire <= $day7";
                break;
            case '15天-30天':
                $conditon[]="expire between $day15 and $day30";
                break;
            case '30天-60天':
                $conditon[]="expire between $day30 and $day60";
                break;
            case '60天-90天':
                $conditon[]="expire between $day60 and $day90";
                break;
            case '长期':
                $conditon[]="expire >= $day180";
                break;
        }
        switch ($tms) {
            case '7天以下':
                $conditon[]="expire <= $day7";
                break;
            case '15天-30天':
                $conditon[]="expire between $day15 and $day30";
                break;
            case '30天-60天':
                $conditon[]="expire between $day30 and $day60";
                break;
            case '60天-90天':
                $conditon[]="expire between $day60 and $day90";
                break;
            case '长期':
                $conditon[]="expire >= $day180";
                break;
        }
        $count      = M("$table")->where($conditon)->count();// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数
        //分页跳转的时候保证查询条件
        foreach($conditon as $key=>$val) {
            $Page->parameter[$key]   =   urlencode($val);
        }
        $show       = $Page->show();// 分页显示输出
        $list = M("$table")->where($conditon)->order('add_time desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        //echo M()->_sql();
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('count',$count);// 赋值分页输出
        $this->display();
    }

    public  function change(){
        $bigid = $_GET["bigname"];
        $data = $this->_column->where(array('column_name' => $bigid))->find();
        if($data){
            $q = $this->_column->where(array('column_leftid' => $data['c_id']))->select();
            foreach($q as $key => $val){
                $select[] =  array('column_name' => $val['column_name']);
            }
            echo json_encode($select);
        }
    }

    public function write(){
        $cid = I('cid') ? I('cid') : 2;
        $column =  $this->_column->where(array('column_leftid' => $cid))->order('c_id')->select();
        //var_dump($column);
        $this->assign('list',$column);// 赋值数据集
        $this->display('write');
    }

    //店铺添加
    public function storeAdd($table ='dianmian',$width = 260,$height = 200){
        $file=I('file0');
        //获取图片上传后路径
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     1200000 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $root = $upload->rootPath  =     '/Public/Uploads/'; // 设置附件上传根目录
       // $upload->savePath =  'store';// 设置附件上传目录
        $upload->saveRule  =     'time';
        $info   =   $upload->upload();
        if($info) {
            $img_url=$root.$info[file0][savepath].$info[file0][savename];//如果上传成功则完成路径拼接
            $image = new \Think\Image(\Think\Image::IMAGE_GD,$img_url); // GD库
            $image->thumb($width, $height, \Think\Image::IMAGE_THUMB_CENTER)->water('./Public/assets/img/water.png',\Think\Image::IMAGE_WATER_SOUTHEAST)->save($root.$info[file0][savepath].$info[file0][savename]);

        }elseif(!$file){
            $img_url='Public/img/no_img.jpg';//否则如果字段为空，表示没有上传任何文件，赋值空
        }else{
            $this->error($upload->getError());//否则就是上传错误，显示错误原因
        }
        $data = M("$table") -> create();
        switch(I('expire')){
            case '7天':
                $data['expire'] = time() + 7*24*60*60;
                break;
            case '15天':
                $data['expire'] = time() + 15*24*60*60;
                break;
            case '1个月':
                $data['expire'] = time() + 30*24*60*60;
                break;
            case '2个月':
                $data['expire'] = time() + 60*24*60*60;
                break;
            case '3个月':
                $data['expire'] = time() + 90*24*60*60;
                break;
            case '6个月':
                $data['expire'] = time() + 180*24*60*60;
                break;
            case '长期':
                $data['expire'] = time() + 240*24*60*60;
                break;
        }
        if(I('sub_cateid')){
           $type = I('sub_cateid');
        }
        if(I('object')){
            $type = I('object');
        }
        $data['add_time'] = time();
        $data['update_time'] = time();
        $data['submit_ip'] = get_client_ip();
        $data['pic'] = $img_url;
        $data['user_name'] = session('account');
        $data['type'] = $type;
        $list = M("$table") -> add($data);
        if($list ){
            R('Public/index',array($list));
        }else{
            $this->error('系统繁忙，请稍后重试');
        }
    }

    public function checkTitle($table = 'dianmian'){
        $title = I('title');
        $condition['title'] = $title;
        $list_title  = M("$table")->where($condition)->getField('title');
        $valid = true;
        if ($title == $list_title) {
            $valid = false;
            echo json_encode(array(
                'valid' => $valid,
            ));
        }else{
            echo json_encode(array(
                'valid' => $valid,
            ));
        }
    }

    public function modify($table = 'dianmian',$module = CONTROLLER_NAME){
        switch($module){
            case 'Happy' : $bf = '喜庆';break;
            case 'Car' : $bf = '汽车';break;
            case 'Marry' : $bf = '相亲';break;
            case 'Dianqi' : $bf = '电器';break;
            case 'Sea' : $bf = '海鲜';break;
            case 'Food' : $bf = '美食';break;
            case 'Farm' : $bf = '农业';break;
            case 'Edu' : $bf = '教育';break;
            case 'House' : $bf = '房子';break;
            case 'Recruit' : $bf = '招聘';break;
            case 'Chang' : $bf = '厂家|批发|代理商';break;
            case 'Jiaju' : $bf = '家居';break;
            case 'Xiju' : $bf = '雷州剧';break;
        }
        // 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
        $bf =I('bf') ? I('bf') : $bf ;
        $data = $this->_column->where(array('column_name' => $bf))->find();
        $cid = $data['c_id'] ? $data['c_id'] : 2 ;
        $condition['user_name']= session('account');
        $condition['id']= I('id');
        $all = $this->_column->where(array('column_leftid' => $cid))->order('c_id')->select();//全部栏目表
        $list = M("$table")->where($condition)->find();//铺面发布表
        $this->assign('all', $all);
        $this->assign('list', $list);
        $this->display('modify');
    }

    public function updateStroe($table = 'dianmian', $width = 210, $height = 160){
        header("Content-Type:text/html; charset=utf-8");
        $user_name = session('account');
        $id = I('id');
        $file=I('file0');
        //获取图片上传后路径
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     1200000 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $root = $upload->rootPath  =     '/Public/Uploads/'; // 设置附件上传根目录
        // $upload->savePath =  'store';// 设置附件上传目录
        $upload->saveRule  =     'time';
        $info   =   $upload->upload();
        $list = M("$table")->where(array('user_name' => $user_name, 'id' => $id))->find();
        if($info) {
            if($list){
                $filename = $list['pic'];
                if(is_file($filename)){//判断是否是文件，否则报错
                    unlink($filename);
                }
            }
            $img_url=$root.$info[file0][savepath].$info[file0][savename];//如果上传成功则完成路径拼接
            $image = new \Think\Image(\Think\Image::IMAGE_GD,$img_url); // GD库
            $image->thumb($width, $height, \Think\Image::IMAGE_THUMB_CENTER)->water('./Public/assets/img/water.png',\Think\Image::IMAGE_WATER_SOUTHEAST)->save($root.$info[file0][savepath].$info[file0][savename]);

        }elseif(!$file){
            $img_url=$list['pic'];//否则如果字段为空，表示没有上传任何文件，赋值空
        }else{
            $this->error($upload->getError());//否则就是上传错误，显示错误原因
        }
        $sl_data= M("$table") -> create();
        switch(I('expire')){
            case '7天':
                $sl_data['expire'] = time() + 7*24*60*60;
                break;
            case '15天':
                $sl_data['expire'] = time() + 15*24*60*60;
                break;
            case '1个月':
                $sl_data['expire'] = time() + 30*24*60*60;
                break;
            case '2个月':
                $sl_data['expire'] = time() + 60*24*60*60;
                break;
            case '3个月':
                $sl_data['expire'] = time() + 90*24*60*60;
                break;
            case '6个月':
                $sl_data['expire'] = time() + 180*24*60*60;
                break;
            case '长期':
                $sl_data['expire'] = time() + 240*24*60*60;
                break;
        }
        if(I('sub_cateid')){
            $type = I('sub_cateid');
        }
        if(I('object')){
            $type = I('object');
        }
        $sl_data['pic']=$img_url;
        $sl_data['update_time']=time();
        $sl_data['update_ip']=get_client_ip();
        $sl_data['type']=$type;
        $data = M("$table")->where(array('user_name' => $user_name, 'id' => $id))->save($sl_data);
        if($data){
            R('Public/index',array($id));
        }else{
            $this->error('系统繁忙，请稍后重试');
        }
    }

    public function detail($table='dianmian'){
        $id = I('id');
        $list = M("$table")->where(array('id' => $id))->find();
        $count = M("say")->where(array('article_id' => $id))->count('id');// 查询满足要求的总记录数
        $say = M("say")->where(array('article_id' => $id, 'article_title'=>$list['title']))->select();
        if($table=='farm' || $table=='recruit' || $table=='chang'){
            $rand = M("$table")->limit(8)->order('rand()')->select();
        }else{
            $rand = M("$table")->limit(4)->order('rand()')->select();
        }
        M("$table")->where(array('id'=>$id))->setInc('hits',1);
        $this->assign('count', $count);
        $this->assign('say', $say);
        $this->assign('list', $list);
        $this->assign('rand', $rand);
        $this->display('detail');
    }

    public function storeDel($table='dianmian'){
        $id = $_GET['id'];
        $list = M("$table")->where(array('id='.$id))->delete();
        if($list){

            $this->redirect('Home/User/writeInfo');
        }else{
            $this->error('系统繁忙，请稍后重试');
        }
    }

}