<?php
namespace app\controllers;

use yii\web\Controller;

class MemberController extends Controller
{
    public function actionAuth()
    {
        //使用指定的布局文件 带商品分类的layout2
        $this->layout = "layout2";
        return $this->render("auth");
    }
}