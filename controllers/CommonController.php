<?php
namespace app\controllers;

use yii\web\Controller;
use app\models\Product;
use app\models\Category;
use Yii;
use app\models\User;
use app\models\Cart;

class CommonController extends Controller
{
    /**
     * 初始化
     */
    public function init()
    {
        //调试信息，打印session
        // session_start();
        // var_dump($_SESSION);



        //获取菜单数据
    	$menu = Category::getMenu();
    	

        //设置全局参数 ？
    	$this->view->params['menu'] = $menu;

        // 判断用户是否登录, 获取用户数据
    	if ( Yii::$app->session['isLogin'] == 1 ) {
    		$loginname = Yii::$app->session['loginname'];
    		$userid = User::find()->where(
    			'username = :uname or useremail = :email',
    			[':uname' => $loginname, ':email' => $loginname]
    			)->one()->userid;
    		$cartNum = Cart::getNum( $userid );
    	} else {
    		$cartNum = '0';
    	}

        // 获取用户信息

    	$this->view->params['cartnum'] = $cartNum;

    	$data = [];
    	$data['products'] = [];
    }
}