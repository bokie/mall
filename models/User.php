<?php
namespace app\models;

use yii\db\ActiveRecord;
use Yii;

class User extends ActiveRecord
{
    public $repass;
    public $loginname;
    public $rememberMe = true;

    public static function tableName()
    {
        return "{{%user}}";
    }


    //数据验证规则
    public function rules()
    {
        return [
            [
                'useremail', 'required', 'message' => '登录用户名不能为空',
                'on' => ['login']
            ],
            [
                'username', 'required', 'message' => '用户名不能为空',
                'on' => ['reg']
            ],
            [
                'username', 'unique', 'message' => '该用户已被注册',
                'on' => ['reg']
            ],
            [
                'useremail', 'required', 'message' => '电子邮箱不能为空',
                'on' => ['reg', 'register']
            ],
            [
                'useremail', 'unique', 'message' => '该电子邮箱已被注册',
                'on' => ['reg', 'register']
            ],
            [
                'userpass', 'required', 'message' => '用户密码不能为空',
                'on' => ['reg', 'register', 'login']
            ],
            [
                'repass', 'required', 'message' => '确认密码不能为空',
                'on' => ['reg', 'register']
            ],
            [
                'repass', 'compare', 'compareAttribute' => 'userpass',
                'message' => '两次密码输入不一致',
                'on' => ['reg', 'register']
            ],
            [
                'userpass', 'validatePass',
                'on' => ['login']
            ],

        ];
    }

    //验证用户登录数据
    public function validatePass()
    {
        if ( ! $this->hasErrors() ) {
            $data = self::find()->where(
                "useremail = :loginname and userpass = :pass", [
                    ':loginname' => $this->useremail,
                    ':pass' => md5($this->userpass)
                ]
            )->one();

            //查询结果判断
            if (is_null($data)) {
                $this->addError("userpass", "用户名或密码错误");
            }
        }
    }

    //设置表单标签名称
    public function attributeLabels()
    {
        return [
            'username' => '用户名',
            'userpass' => '用户密码',
            'repass' => '确认密码',
            'useremail' => '邮箱账号',
            'loginname' => '用户名/电子邮箱',
        ];
    }

    public function reg($data, $scenario = 'reg')
    {
        $this->scenario = $scenario;

        if ($this->load($data) && $this->validate()) {
            $this->createtime = time();
            $this->userpass = md5($this->userpass);
            if ($this->save(false)) {
                return true;
            }
            return false;
        }
        return false;
    }

    //登录方法
    public function login($data)
    {
        $this->scenario = "login";
        if ($this->load($data) && $this->validate()) {
            $lifetime = $this->rememberMe ? 24*3600 : 0; //如果保存登录状态session有效时间一天
            $session = Yii::$app->session;
            session_set_cookie_params($lifetime);
            $session['loginname'] = $this->useremail;
            $session['isLogin'] = 1;
            return (bool)$session['isLogin'];
        }
    }

    public function getProfile()
    {
        return $this->hasOne(Profile::className(), ['userid' => 'userid']);
    }

}