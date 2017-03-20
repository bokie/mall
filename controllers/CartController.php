<?php

namespace app\controllers;

use yii\web\Controller;

class CartController extends Controller
{
    public function actionIndex()
    {
        //指定使用的布局文件 带商品分类的layout2
        $this->layout = "layout1";
        // views/cart/index.php
        return $this->render("index");
    }
}