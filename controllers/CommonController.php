<?php
namespace app\controllers;

use yii\web\Controller;
use app\models\Product;
use app\models\Category;

class CommonController extends Controller
{
    /**
     * 初始化
     */
    public function init()
    {
        //获取菜单数据
        $menu = Category::getMenu();

        //设置全局参数 ？
        $this->view->params['menu'] = $menu;

        $data = [];
        $data['products'] = [];
        $total = 0;

    }
}