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
        session_start();
        var_dump($_SESSION);



        //获取菜单数据
        $menu = Category::getMenu();

        //设置全局参数 ？
        $this->view->params['menu'] = $menu;

        $data = [];
        $data['products'] = [];
        //商品总价
        $total = 0;

    }
}