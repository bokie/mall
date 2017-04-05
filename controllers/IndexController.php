<?php

namespace app\controllers;

use app\controllers\CommonController;
use app\models\Product;

class IndexController extends CommonController
{
    public function actionIndex()
    {
        //获取商品数据
        $data['all'] = Product::find()->where(
            'ison = "1"'
        )->orderBy('createtime desc')->limit(7)->all();
        $data['isreco'] = Product::find()->where(
            'isreco = "1"'
        )->orderBy('createtime desc')->limit(7)->all();

        //禁用默认的模板的头部和脚部
        //    $this->layout = false;
        //也可以通过return $this->renderPartial("index");实现
        //指定使用的布局文件
        $this->layout = "layout1";
        return $this->render("index", ['data' => $data]);
    }
}