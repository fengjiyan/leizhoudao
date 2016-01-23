<?php
return array(
    //分组设置
        'APP_GROUP_LIST' => 'Home,Admin', //项目分组设定
        'DEFAULT_GROUP'  => 'Admin', //默认分组
        'URL_MODEL' => 2,
        'DB_TYPE'   => 'mysql', // 数据库类型
        'DB_HOST'   => 'localhost', // 数据库连接地址
        'DB_NAME'   => 'slackck', // 数据库名
        'DB_USER'   => 'root', // 数据库用户名
        'DB_PWD'    => '', // 数据库密码
        'DB_PORT'   => 3306, // 数据库端口
        'DB_PREFIX' => 'mr_', // 数据库前缀
        'DB_CHARSET'=> 'utf8', // 数据库编码
        'DB_DEBUG'  =>  TRUE, // 是否开启调试模式
        'DB_LIKE_FIELDS'=>'news_title|news_content|news_flag|news_open',//自动模糊查询字段
        'LOAD_EXT_CONFIG' => 'sdk_config',//扩展第三方登录配置文件


            'DB_PATH_NAME'=> 'Data',        //备份目录名称,主要是为了创建备份目录
            'DB_PATH'     => './Public/Data/',     //数据库备份路径必须以 / 结尾；
            'DB_PART'     => '20971520',  //该值用于限制压缩后的分卷最大长度。单位：B；建议设置20M
            'DB_COMPRESS' => '1',         //压缩备份文件需要PHP环境支持gzopen,gzwrite函数        0:不压缩 1:启用压缩
            'DB_LEVEL'    => '9',         //压缩级别   1:普通   4:一般   9:最高

           'MAIL_CHARSET' =>'utf-8',//设置邮件编码
           'MAIL_ISHTML' =>TRUE, // 是否HTML格式邮件

        'AUTH_CONFIG' => array(
        'AUTH_ON' => true, //是否开启权限
        'AUTH_TYPE' => 1, //
        'AUTH_GROUP' => 'mr_auth_group', //用户组
        'AUTH_GROUP_ACCESS' => 'mr_auth_group_access', //用户组规则
        'AUTH_RULE' => 'mr_auth_rule', //规则中间表
        'AUTH_USER' => 'mr_admin'// 管理员表
		),
		
		/*自定义文件，用于下拉菜单*/
		'lz_area' => array('海康城区','附城','白沙','沈塘','客路','杨家','唐家','纪家','企水','东里','乌石','南兴','松竹','雷高','龙门','英利','北和','调风','覃斗','徐闻','其它'),
		'room_type' => array('个人','商家','公司','代理商','其他'),
		'w_time' => array('7天以下','15天-30天','30天-60天','60天-90天','长期'),
		'expire_time' => array('7天','15天','1个月','2个月','3个月','6个月','长期'),
		'marry_range' => array('帅哥','美女'),
		'marry_area' => array('海康城区','乡镇','农村','其他'),
		'marry_age' => array('22岁以下','23岁-30岁','30岁-40岁','40岁以上'),
		'good_type' => array('全新','良好','一般','旧','配套家具','没专修'),
		'funrniture' => array('一房一厅','二房一厅','三房一厅','别墅','店面','其他'),
		'marry_type' => array('新娘','新郎','其他'),	
		'business' => array('个人','企业','公司','铺面','其他'),	
		'education_req' => array('大专','研究生','本科','高中或以下','初中','小学'),
		'work_property' => array('私营','国企','外企','政府部门','其他'),
		'sale_type' => array('出售','求购','其他'),	
		'edu' => array('大专','本科','研究生','高中','初中以下'),	
		'work_property' => array('全职','专职','兼职','其他'),	
		'property' => array('邮政','工商银行','农业银行','广东信用社'),	
		'new_old' => array('全新','九成新','八成新','七成新','六成新','五成新','一般','旧','其他'),	
		'sign'=>array('白羊','座金','牛座','双子座','巨蟹座','狮子座','处女座','天秤座','天蝎座','射手座','摩羯座','水瓶座','双鱼座','其他星座'),
		'car_type' => array('汽车','货车','其他'),	
		'car_attr' => array('坐铺','卧铺','其他'),	
		'car_extent' => array('个人','公司','雷州总站','上坡总站','其他'),
		'range' => array('个人','企业','直销商','代理商','其他')
		
        
);