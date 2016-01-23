<?php
namespace Home\Controller;
use Think\Controller;


class UserController extends Controller {
    private $_member_list = null;
    private $_dianmian = null;
    private $_marry = null;
    //控制器初始化方法
    public function _initialize(){
        //parent::_initialize();
        $this->_member_list = M('member_list');
        $this->_dianmian = M('dianmian');
        $this->_happy = M('happy');
        $this->_marry = M('marry');
        $this->_car = M('car');
       // $this->header();

    }
    public function writeInfo(){
        $user_name = session('account');
        $condition['user_name']= $user_name;
        $count_dm      = $this->_dianmian->where($condition)->count('id');// 查询满足要求的总记录数
        $count_car      = $this->_happy->where($condition)->count('id');// 查询满足要求的总记录数
        $count_hp      = $this->_happy->where($condition)->count('id');// 查询满足要求的总记录数
        $count_mr      = $this->_marry->where($condition)->count('id');// 查询满足要求的总记录数
        $count = M()->field('id')
            ->table('mr_dianmian')->where($condition)
            ->union(array("SELECT count(id) FROM mr_happy where user_name ='$user_name'", "SELECT count(id) FROM mr_car where user_name ='$user_name'", "SELECT count(id)  FROM mr_marry where user_name ='$user_name'"),true)
            ->select();
        //echo M()->_sql();
        //var_dump(count($count));
        //$count      = $count_dm + $count_hp  + $count_car + $count_mr;// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,3);// 实例化分页类 传入总记录数和每页显示的记录数
        //$show       = $Page->show();// 分页显示输出
        $list_dm = $this->_dianmian->where(array('user_name'=>$user_name))->order('add_time desc')->field('id,title,category,area,sub_cateid,status,expire,add_time,dianmian')->select();
        $list_hp = $this->_happy->where(array('user_name'=>$user_name)) ->order('add_time desc')->field('id,title,object,area,status,expire,add_time,happy')->select();
        $list_car = $this->_car->where(array('user_name'=>$user_name)) ->order('add_time desc')->field('id,title,manage,area,status,expire,add_time,car')->select();
        $list_mr = $this->_marry->where(array('user_name'=>$user_name)) ->order('add_time desc')->field('id,title,object,area,status,expire,add_time,marry')->select();
        $list = array_merge($list_dm,$list_hp,$list_car,$list_mr);
        $this->assign('count',$count);// 赋值数据集
        $this->assign('list',$list);// 赋值数据集
       // $this->assign('page',$show);// 赋值分页输出
        $this->display('write-infos');
    }
    public function member(){
        $name = session('account');
        if (!isset($name)) {
            $this->redirect('User/login');
        }
        $pic = $this->_member_list->where("member_list_username='{$name}'")->getField('member_list_photo');
        if(!$pic){
            $pic = 'default.jpg';
            $this->assign('pic',$pic);
        }else{
            $this->assign('pic',$pic);
        }
        $province = M('Region')->where ( array('pid'=>1) )->select ();
        $user_name = session('account');
        $member_list_edit = $this->_member_list->where(array('member_list_username'=>$user_name))->find();
        $this->assign('list',$member_list_edit);
        $this->assign('member_list_edit',$member_list_edit);
        $this->assign('province',$province);
        $this->display('member');
    }
    public function updateMember(){
        header("Content-Type:text/html; charset=utf-8");
        $sl_data = $_POST;
        $sl_data['member_list_addtime']=time();
        $sl_data['member_list_ip']=get_client_ip();
        $data = $this->_member_list->where(array('member_list_username' => session('account')))->save($sl_data);
        if($data){
            $this->success('更新成功',U('User/member'),1);
        }else{
            $this->error('数据更新失败，请稍后重试');
        }
    }
    public function updatePwd(){
        header("Content-Type:text/html; charset=utf-8");
        $user_name = session('account');
        $pwd = md5(I('member_list_pwd'));
        $new_pwd = md5(I('member_list_newpwd'));
        $pwd_data = $this->_member_list->where(array('member_list_username' => $user_name))->getField('member_list_pwd');
        if($pwd !== $pwd_data){
            $this->error('原密码错误，请稍后重试');
        }
        if ($new_pwd !== md5(I('member_list_repwd'))) {
            $this->error('两次密码不一样，请重新输入');
        }
        $sl_data['member_list_pwd'] = $new_pwd;
        $data = $this->_member_list->where(array('member_list_username' => $user_name))->save($sl_data);
        if($data){
            $this->success('修改成功',U('User/modify-pwd'),1);
        }else{
            $this->error('修改失败，请稍后重试');
        }

    }
    public function doLogin(){
        header("Content-Type:text/html; charset=utf-8");
        $auto = $_POST['auto_login'];
        if(isset($auto)){
            setcookie('user','bai',time()*60*60*24*7);//7天后过期
        }else{
            setcookie('user','bai',time()*60*60*24*3);//1小时后过期
        }
//        setcookie("account", $auto, time() + 3600*7);
        $username = $_POST['member_username'];
        $pwd = md5($_POST['member_pwd']);
        $update_logintime['member_list_logintime'] = time();
        $list1 = $this->_member_list->where(array('member_list_username' => $username, 'member_list_pwd' => $pwd))->find();
        $list2 = $this->_member_list->where(array('member_list_tel' => $username, 'member_list_pwd' => $pwd))->find();
        $list3 = $this->_member_list->where(array('member_list_email' => $username, 'member_list_pwd' => $pwd))->find();
        if($list1){
            if(!($list1['member_list_status']) == 1){
//                echo "<script>alert('账号还没激活，请及时激活！');</script>";
                $this->error('账号还没激活，请及时激活！');
            }else{
                session('account', $list1['member_list_username']);
                session('member_list_logintime', $list1['member_list_logintime']);
            }

        }else if($list2){
            if(!($list2['member_list_status']) == 1){
                $this->error('账号还没激活，请及时激活！');
            }else{
                session('account', $list2['member_list_username']);
                session('member_list_logintime', $list2['member_list_logintime']);
            }
        }else if($list3){
            if(!($list3['member_list_status']) == 1){
                $this->error('账号还没激活，请及时激活或者联系管理员！');
            }else{
                session('account', $list3['member_list_username']);
                session('member_list_logintime', $list3['member_list_logintime']);
            }
        }else{
            $this->error('登录失败，请重试');
        }
        $dest_url = $_POST['log_referer'];
        $str = explode('/', $dest_url);
        if(in_array('registerAdd.html', $str)){
            $dest_url = __APP__."/Home/User/member";
        }
        $dest_url = empty($dest_url)? __APP__."/Home/User/member" : $dest_url;
        $tager = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME'];
        if ($dest_url == $tager) {
            redirect($tager);
        }else{
            redirect($dest_url);
        }
    }

    public function register(){
        $this->display('register');
    }
    public function registerAdd(){
        header("Content-TypeD:text/html; charset=utf-8");
        $username = I('member_list_username');
        $pwd=md5(I('member_list_pwd'));
        $data = $this->_member_list -> create();
        $data['member_list_addtime'] = time();
        $data['member_list_logintime'] = time();
        $data['member_list_status'] = 0;
        $data['member_list_pwd'] = $pwd;
        $data['member_list_sex'] = 3;
        $data['member_list_ip'] = get_client_ip();
        $data['member_list_groupid'] = 1;
        $list = $this->_member_list -> add($data);
        if($list){
            $this->success('注册成功',U("Home/User/register"),1);exit;
            $list = $this->_member_list->where("member_list_username='$username'")->find();
            session('account',$list['member_list_username']);
            session('member_list_logintime',$list['member_list_logintime']);
            $id=$list['member_list_id'];
            //定义激活地址
            $url = "http://".$_SERVER['HTTP_HOST'].U('User/active',array('id'=>$id));
            //获取的邮箱 匹配数据库的地址
            $email = $_POST['member_list_email'];
            preg_match('/@(\w+)\./', $email,$matches);//qq 163,yeah
            $address = M('email')->where('name='."'$matches[1]'")->getField('url');
            //发送邮件 引入邮件扩展类
            Vendor('PHPMailer.PHPMailerAutoload');
            $mail = new \PHPMailer(); //实例化
            /*服务器相关信息*/
            $mail->isSMTP();                                      // 设置 mailer 使用 SMTP
            $mail->Host = 'smtp.163.com';  // 指定 主要 和 备用 SMTP 主机,多个用；隔开
            $mail->SMTPAuth = true;                               // 是否开启 SMTP 认证
            $mail->Username = 'xiexinweixin@163.com';                 // SMTP 用户名
            $mail->Password = 'xiexinwei';                           // SMTP 密码
            /*发件人和收件人信息*/
            $mail->From = 'xiexinweixin@163.com';                     //发件人邮箱
            $mail->FromName = '雷州半岛网欢迎您';
            $mail->addAddress($email);               // 收件人姓名可选
            $mail->isHTML(true);                                  // 设置email格式是否是HTML
            $mail->CharSet = "utf-8";			    			  //编码
            $mail->Subject = "邮箱认证，请激活";           								   //主题
            //$a = date('YmdHis',time()).md5(mt_rand(0,99999));
            //$mail->Body    = "[雷州半岛网]请点击以下链接来激活<br><a href='{$url}'></a>";   //内容
            $mail->Body    = "请点击以下链接来激活完成注册<br><a href='{$url}'>".urlencode($url)."</a>";   //内容
            if(!$mail->send()) {
                $this->error('邮件发送失败，稍后重试: '. $mail->ErrorInfo,'',3);
            } else {
                $this->success('邮箱已发送请注意查收,激活后请刷新页面',U("Home/User/login"),3);
            }
        }else{
            $this->error('系统繁忙，请稍后重试');
        }
    }

    //接受邮箱验证
    public function active(){
        header("Content-type:text/html;charset=utf-8");
        //接收id
        $id = $_GET['id'];
        //判读是否有存在该用户
        $data = $this->_member_list->where("member_list_id='{$id}'")->find();
        if(!$data){
            $this->redirect('User/register',array(),2,'激活失败，不存在该用户,正在跳转到注册页面,请稍后...');
        }
        //判断该用户是否已经激活
        if($data['status'] == 1){
            echo "<script>alert('恭喜你，激活成功！');window.close();</script>";
            exit;
        }
        //执行修改
        if($this->_member_list->where("member_list_id='$id'")->setField('member_list_status',1)){
            echo "<script>alert('恭喜你，激活成功！');window.close();</script>";
        }else{
            //$this->success('内部错误',U("User/register"),2);
            $this->redirect('User/register',array(),2,'内部错误,正在跳转到注册页面,请稍后...');
        }
    }

    public function checkUsername(){
        $username = I('member_list_username');
        $condition['member_list_username'] = $username;
        $name  = $this->_member_list->where($condition)->getField('member_list_username');
        $valid = true;
        if ($name == $username) {
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
    public function checkEmail(){
        $email = I('member_list_email');
        $condition['member_list_email'] = $email;
        $list_email  = $this->_member_list->where($condition)->getField('member_list_email');
        $valid = true;
        if ($email == $list_email) {
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
    public function registersuccess()
    {
        $name = session('account');
        if (!isset($name)) {
            $this->redirect('User/login');
        }
        $this->display('registersuccess');
    }
    public  function photo(){
        $name = session('account');
        $pic = $this->_member_list->where("member_list_username='{$name}'")->getField('member_list_photo');
        if(!$pic){
            $pic = 'default.jpg';
            $this->assign('pic',$pic);
        }else{
            $this->assign('pic',$pic);
        }
        $list = $this->_member_list->where("member_list_username='{$name}'")->find();
        $this->assign('list',$list);
        $this->display('photo');
    }
    // 上传图片头像处理表单数据
    public function upfile() {
        $path = "./Public/Uploads/User-photo/";
        $file_src = "src.jpg";
        $filename162 = time().".jpg";
        $filename48 ='48'. time().".jpg";
        $src=base64_decode($_POST['pic']);
        $pic1=base64_decode($_POST['pic1']);
        $pic2=base64_decode($_POST['pic2']);
        if($src) {
            file_put_contents($file_src,$src);
        }
        file_put_contents($path.$filename162,$pic1);
        file_put_contents($path.$filename48,$pic2);
        $name = session('account');
        $data['member_list_photo'] = $filename162;
        $v = $this->_member_list->where(array("member_list_username" => $name))->find();
        $filename=$path.$v['member_list_photo'];//大图片缩略图


        $thum_mdpic=$path.'48'.$v['member_list_photo'];//中图片缩略图
        if(is_file($filename) && is_file($thum_mdpic)){//判断是否是文件，否则报错
            unlink($filename);
            unlink($thum_mdpic);
        }
        $this->_member_list->where("member_list_username='{$name}'")->save($data);
        $rs['status'] = $filename162;
        echo json_encode($rs);

    }

    public function forgetOk(){
        $email = $_POST['member_username'];
        $list = $this->_member_list->where(array('member_list_email' => $email))->find();
        if($list) {
            session('account', $list['member_list_username']);
            session('member_list_logintime', $list['member_list_logintime']);
            $id = $list['member_list_id'];
            //定义激活地址
            $url = "http://" . $_SERVER['HTTP_HOST'] . U('User/pwd-reset', array('id' => $id));
            //获取的邮箱 匹配数据库的地址
            preg_match('/@(\w+)\./', $email, $matches);//qq 163,yeah
            $address = M('email')->where('name=' . "'$matches[1]'")->getField('url');
            //发送邮件 引入邮件扩展类
            Vendor('PHPMailer.PHPMailerAutoload');
            $mail = new \PHPMailer(); //实例化
            /*服务器相关信息*/
            $mail->isSMTP();                                      // 设置 mailer 使用 SMTP
            $mail->Host = 'smtp.163.com';  // 指定 主要 和 备用 SMTP 主机,多个用；隔开
            $mail->SMTPAuth = true;                               // 是否开启 SMTP 认证
            $mail->Username = 'xiexinweixin@163.com';                 // SMTP 用户名
            $mail->Password = 'xiexinwei';                           // SMTP 密码
            /*发件人和收件人信息*/
            $mail->From = 'xiexinweixin@163.com';                     //发件人邮箱
            $mail->FromName = '雷州半岛网欢迎您';
            $mail->addAddress($email);               // 收件人姓名可选
            $mail->isHTML(true);                                  // 设置email格式是否是HTML
            $mail->CharSet = "utf-8";                              //编码
            $mail->Subject = "邮箱认证，请重新设置";                                           //主题
            $mail->Body = "请点击以下链接来重新设置密码<br><a href='{$url}'>" . urlencode($url) . "</a>";   //内容
            if (!$mail->send()) {
                $this->error('邮件发送失败，稍后重试: ' . $mail->ErrorInfo, '', 3);
            } else {
                $this->success('邮箱已发送请注意查收,激活后请刷新页面', U("Home/User/login"), 3);
            }

        }else{
            $this->error('对不起，没有这个邮箱，请重试');
        }

    }
    public function pwdReset(){
        header("Content-Type:text/html; charset=utf-8");
        $user_name = session('account');
        $sl_data['member_list_pwd'] = md5(I('member_list_pwd'));
        $data = $this->_member_list->where(array('member_list_username' => $user_name))->save($sl_data);
        if(!$data){
            echo "<script>alert('恭喜你，密码修改成功！');</script>";
            $this->redirect('User/member');
//            $this->redirect('User/member',array(),2,'正在跳转到会员中心,请稍后...');
        }else{
            $this->error('修改失败，请稍后重试');
        }
    }

    public function storeDel(){
        $condition['user_name']= session('account');
        $condition['id']= I('store_id');
        $list = $this->_dianmian->where($condition)->delete();
        if($list > 0){
            $this->redirect('User/writeInfo');
        }else{
            $this->error('系统繁忙，请重试');
        }
    }

    public function outLogin(){
        session('account',null); // 删除name
        $this->redirect('User/login');
    }


}