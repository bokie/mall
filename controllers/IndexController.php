<?php

namespace app\controllers;

use yii\web\Controller;

class IndexController extends Controller
{
    public function actionIndex()
{
    //禁用默认的模板的头部和脚部
    //    $this->layout = false;
    //也可以通过return $this->renderPartial("index");实现
    //指定使用的布局文件
    $this->layout = "layout1";
    return $this->render("index");
}
}