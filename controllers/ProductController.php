<?php

namespace app\controllers;

use yii\web\Controller;

class ProductController extends Controller
{
    //禁用模板的头部和脚部
    //    public $layout = false;
    public function actionIndex()
    {
        $this->layout = "layout2";
        // 加载模板 views/product/index
        return $this->render("index");
    }

    //商品详情页
    public function actionDetail()
    {
        $this->layout = "layout2";
        return $this->render("detail");
    }
}