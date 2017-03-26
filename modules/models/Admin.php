<?php

namespace app\modules\models;

use yii\db\ActiveRecord;
use Yii;

class Admin extends ActiveRecord
{
    public $rememberMe = true;
    public $repass; //新密码

    public static function tableName()
    {
        return "{{%admin}}";
    }

    //创建新用户页面label名称
    public function attributeLabels()
    {
        return [
            'adminuser' => '管理员账号',
            'adminemail' => '管理员邮箱',
            'adminpass' => '密码',
            'repass' => '确认密码',
        ];
    }

    //数据验证规则
    public function rules()
    {
        return [
            [
                'adminuser', 'required', 'message' => '管理员账号不能为空',
                'on' => ['login', 'adminadd', 'changemail', 'changepass']
            ],
            [
                'adminpass', 'required', 'message' => '管理员密码不能为空',
                'on' => ['login', 'adminadd', 'changemail', 'changepass']
            ],
            [
                'rememberMe', 'boolean',
                'on' => 'login'
            ],
            [
                'adminpass', 'validatePass',
                'on' => ['login', 'changemail'],
            ],
            [
                'adminemail', 'required', 'message' => '电子邮箱不能为空',
                'on' => ['adminadd', 'changemail']
            ],
            [
                'adminemail', 'email', 'message' => '电子邮箱格式不正确',
                'on' => ['adminadd', 'changemail']
            ],
            [
                'adminemail', 'unique', 'message' => '该电子邮箱已被注册',
                'on' => ['adminadd', 'changemail', 'changemail']
            ],
            [
                'adminuser', 'unique', 'message' => '该账号已被注册',
                'on' => ['adminadd']
            ],
            [
                'adminemail', 'validateEmail',
                'on' => 'seekpass'
            ],
            [
                'repass', 'required', 'message' => '确认密码不能为空',
                'on' => ['adminadd', 'changepass']
            ],
            [
                'repass', 'compare', 'compareAttribute' => 'adminpass',
                'message' => '两次密码输入不一致', 'on' => ['adminadd', 'changepass']
            ],
        ];
    }

    public function validatePass()
    {
        if (!$this->hasErrors()) {
            $data = self::find()->where('adminuser = :user and adminpass = :pass',
                [":user" => $this->adminuser, ":pass" => md5($this->adminpass)])->one();
            if (is_null($data)) {
                $this->addError("adminpass", "用户名或密码错误");
            }
        }
    }

    public function validateEmail()
    {
        if (!$this->hasErrors()) {
            $data = self::find()->where('adminuser = :user and adminemail = :email',
                [':user' => $this->adminuser, ':email' => $this->adminemail])->one();
            if (is_null($data)) {
                $this->addError("adminemail", "管理员电子邮箱不匹配");
            }
        }
    }

    public function login($data)
    {
        $this->scenario = "login";
        if ($this->load($data) && $this->validate()) {
            //登录事件
            $lifetime = $this->rememberMe ? 24*3600 : 0;
            $session = Yii::$app->session;
            session_set_cookie_params($lifetime);
            $session['admin'] = [
                'adminuser' => $this->adminuser,
                'isLogin' => 1,
            ];
            $this->updateAll(['logintime' => time(),
                'loginip' => ip2long(Yii::$app->request->userIP)],
                'adminuser = :user', [':user' => $this->adminuser]);
            return (bool)$session['admin']['isLogin'];
        }
        return false;
    }

    //找回密码
    public function seekPass($data)
    {
        $this->scenario = "seekpass";
        if ($this->load($data) && $this->validate()) {

            $time = $time();
            $token = $this->createToken($data['Admin']['adminuser'], $time);

            //发送邮件
            $mailer = Yii::$app->mailer->compose('seekpass',
                ['adminuser' => $data['Admin']['adminuser'], 'time' => $time,
                'token' => $token]);//邮件模板内容在 mail/layouts 目录下
            $mailer->setForm("test@test.com");
            $mailer->setTo($data['Admin']['adminemail']);
            $mailer->setSubject("找回密码");
            if ($mailer->send()) {
                return true;
            }
        }
        return false;
    }

    //生成找回密码的token
    public function createToken($adminuser, $time)
    {
        return md5(md5($adminuser) . base64_encode(Yii::$app->request->userIP) . md5($time));
    }

    //注册管理员账号
    public function reg($data)
    {
        $this->scenario = "adminadd";
        if ($this->load($data) && $this->validate()) { //save()方法： new ?  添加 : 更新
            $this->adminpass = md5($this->adminpass);
            if ($this->save(false)) {
                return true;
            }
            return false;
        }
        return false;
    }

    //修改当前登录账号邮箱
    public function changeemail($data)
    {
        $this->scenario = "changemail";
        if ($this->load($data) && $this->validate()) {
            return (bool)$this->updateAll(['adminemail' => $this->adminemail],
                'adminuser = :user', [':user' => $this->adminuser]);
        }
        return false;
    }

    //修改当前登录账号密码
    public function changepass($data)
    {
        $this->scenario = "changepass";
        if ($this->load($data) && $this->validate()) {
            return (bool)$this->updateAll(['adminpass' => md5($this->adminpass)],
                'adminuser = :user', [':user' => $this->adminuser]);
        }
        return false;
    }

}