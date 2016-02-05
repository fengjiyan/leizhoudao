<?php
namespace Home\Controller;
use Think\Controller;


class UserController extends HeadController {
    private $_member_list = null;
    private $_dianmian = null;
    private $_happy = null;
    private $_marry = null;
    private $_house = null;
    private $_car = null;
    private $_dianqi = null;
    private $_sea = null;
    private $_food = null;
    private $_farm = null;
    private $_edu = null;
    private $_recruit = null;
    private $_chang = null;
    private $_jiaju = null;
    private $_xiju = null;
    //控制器初始化方法
    public function _initialize(){
        parent::_initialize();
        $this->_member_list = M('member_list');
        $this->_dianmian = M('dianmian');
        $this->_happy = M('happy');
        $this->_car = M('car');
        $this->_marry = M('marry');
        $this->_house = M('house');
        $this->_dianqi = M('dianqi');
        $this->_sea = M('sea');
        $this->_food = M('food');
        $this->_farm = M('farm');
        $this->_edu = M('edu');
        $this->_recruit = M('recruit');
        $this->_chang = M('chang');
        $this->_jiaju = M('jiaju');
        $this->_xiju = M('xiju');
       // $this->header();

    }
    public function writeInfo(){
        $user_name = session('account');
        $condition['user_name']= $user_name;
        $count=M()->query("SELECT count(id) as count FROM(SELECT 1 AS union_type,c.id,c.user_name FROM mr_dianmian c UNION SELECT 2,dhy.id,dhy.user_name FROM mr_happy dhy UNION SELECT 3,h.id,h.user_name FROM mr_car h UNION SELECT 4,ma.id,ma.user_name FROM mr_marry ma UNION SELECT 5,ho.id,ho.user_name FROM mr_house ho UNION SELECT 6,dq.id,dq.user_name FROM mr_dianqi dq UNION SELECT 7,se.id,se.user_name FROM mr_sea se UNION SELECT 8,fo.id,fo.user_name FROM mr_food fo UNION SELECT 9,fa.id,fa.user_name FROM mr_farm fa UNION SELECT 10,ed.id,ed.user_name FROM mr_edu ed UNION SELECT 11,ri.id,ri.user_name FROM mr_recruit ri UNION SELECT 12,ch.id,ch.user_name FROM mr_chang ch UNION SELECT 13,ji.id,ji.user_name FROM mr_jiaju ji UNION SELECT 14,xj.id,xj.user_name FROM mr_xiju xj) ta
WHERE ta.user_name = '$user_name'");
        //$Page       = new \Think\Page($count,4);;
        //$show       = $Page->show();// 分页显示输出
        $list=M()->query("SELECT union_type,id,title,add_time,user_name,area,status,expire,type FROM(SELECT 1 AS union_type,c.id,c.title,c.add_time,c.user_name,c.area,c.status,c.expire,c.type FROM mr_dianmian c UNION SELECT 2,dhy.id,dhy.title,dhy.add_time,dhy.user_name,dhy.area,dhy.status,dhy.expire,dhy.type FROM mr_happy dhy UNION SELECT 3,h.id,h.title,h.add_time,h.user_name,h.area,h.status,h.expire,h.type FROM mr_car h UNION SELECT 4,ma.id,ma.title,ma.add_time,ma.user_name,ma.area,ma.status,ma.expire,ma.type FROM mr_marry ma UNION SELECT 5,ho.id,ho.title,ho.add_time,ho.user_name,ho.area,ho.status,ho.expire,ho.type FROM mr_house ho UNION SELECT 6,dq.id,dq.title,dq.add_time,dq.user_name,dq.area,dq.status,dq.expire,dq.type FROM mr_dianqi dq UNION SELECT 7,se.id,se.title,se.add_time,se.user_name,se.area,se.status,se.expire,se.type FROM mr_sea se UNION SELECT 8,fo.id,fo.title,fo.add_time,fo.user_name,fo.area,fo.status,fo.expire,fo.type FROM mr_food fo UNION SELECT 9,fa.id,fa.title,fa.add_time,fa.user_name,fa.area,fa.status,fa.expire,fa.type FROM mr_farm fa UNION SELECT 10,ed.id,ed.title,ed.add_time,ed.user_name,ed.area,ed.status,ed.expire,ed.type FROM mr_edu ed UNION SELECT 11,ri.id,ri.title,ri.add_time,ri.user_name,ri.area,ri.status,ri.expire,ri.type FROM mr_recruit ri UNION SELECT 12,ch.id,ch.title,ch.add_time,ch.user_name,ch.area,ch.status,ch.expire,ch.type FROM mr_chang ch UNION SELECT 13,ji.id,ji.title,ji.add_time,ji.user_name,ji.area,ji.status,ji.expire,ji.type FROM mr_jiaju ji UNION SELECT 14,xj.id,xj.title,xj.add_time,xj.user_name,xj.area,xj.status,xj.expire,xj.type FROM mr_xiju xj) ta
WHERE ta.user_name = '$user_name' ORDER BY ta.add_time desc");
        $this->assign('count',$count);// 赋值数据集
        $this->assign('list',$list);// 赋值数据集
       // $this->assign('page',$show);// 赋值分页输出
        $this->display('write-infos');
    }
    public static function merge($a='', $b=''){
        $args = func_get_args();
        $res = array_shift($args);
        while (!empty($args)) {
            $next = array_shift($args);
            foreach ($next as $k => $v) {
                if (is_int($k)) {
                    if (isset($res[$k])) {
                        $res[] = $v;
                    } else {
                        $res[$k] = $v;
                    }
                } elseif (is_array($v) && isset($res[$k]) && is_array($res[$k])) {
                    $res[$k] = self::merge($res[$k], $v);
                } else {
                    $res[$k] = $v;
                }
            }
        }
        return $res;
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
        $sl_data = $this->_member_list->creat();
        //$sl_data = $_POST;
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

    public function mySay(){
       $user_name = session('account');
        $count = M("say")->where(array('user_name' => $user_name))->count('id');// 查询满足要求的总记录数
        $list = M("say")->where(array('user_name' => $user_name))->select();
        $this->assign('count',$count);
        $this->assign('list',$list);
        $this->display('my-say');
    }
    public function doLogin(){
        header("Content-Type:text/html; charset=utf-8");
        $auto = $_POST['auto_login'];
        if(isset($auto)){
            setcookie('user','bai',time() + 60*60*24*30);//30天后过期
        }else{
            setcookie('user','bai',time() + 60*60*24);//1小时后过期
        }
        $username = $_POST['member_username'];
        $pwd = md5($_POST['member_pwd']);
        $update_logintime['member_list_logintime'] = time();
        $list1 = $this->_member_list->where(array('member_list_username' => $username, 'member_list_pwd' => $pwd))->find();//用户名
        $list2 = $this->_member_list->where(array('member_list_tel' => $username, 'member_list_pwd' => $pwd))->find();//电话号码
        $list3 = $this->_member_list->where(array('member_list_email' => $username, 'member_list_pwd' => $pwd))->find();//邮箱
        if($list1){
            if(!($list1['member_list_status']) == 1){
                //echo "<script>alert('账号还没激活，请及时激活！');</script>";
                $this->error('账号还没激活，请及时激活或者联系管理员');
            }else{
                session('account', $list1['member_list_username']);
                session('member_list_logintime', $list1['member_list_logintime']);
            }

        }else if($list2){
            if(!($list2['member_list_status']) == 1){
                $this->error('账号还没激活，请及时激活或者联系管理员');
            }else{
                session('account', $list2['member_list_username']);
                session('member_list_logintime', $list2['member_list_logintime']);
            }
        }else if($list3){
            if(!($list3['member_list_status']) == 1){
                $this->error('账号还没激活，请及时激活或者联系管理员');
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
            $dest_url = __APP__."/User/member";
        }
        $dest_url = empty($dest_url)? __APP__."/User/member" : $dest_url;
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
            $this->success('注册成功',U("User/register"),1);exit;
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
                $this->success('邮箱已发送请注意查收,激活后请刷新页面',U("User/login"),3);
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
                $this->success('邮箱已发送请注意查收,激活后请刷新页面', U("User/login"), 3);
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