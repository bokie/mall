<?php

namespace app\controllers;

use yii\web\Controller;
use app\controllers\CommonController;
use Yii;
use app\models\Product;

class ProductController extends CommonController
{
    //禁用模板的头部和脚部
    //    public $layout = false;
    public function actionIndex()
    {
        //获取页面传递的数据
        $cid = Yii::$app->request->get("cateid");

        //获取商品数据
        $where = "cateid = :cid and ison = '1'";
        $params = [':cid' => $cid];
        $all = Product::find()->where(
            $where, $params
        )->asArray()->all();
        $reco = Product::find()->where(
            $where . 'and isreco = \'1\'', $params
    )->orderBy("createtime desc")->limit(5)->asArray()->all();

        $this->layout = "layout2";
        // 加载模板 views/product/index
        return $this->render("index", ['all' => $all, 'reco' => $reco]);
    }

    //商品详情页
    public function actionDetail()
    {
        //获取页面传递的商品id参数
        $productid = Yii::$app->request->get("productid");

        //获取商品数据
        $product = Product::find()->where(
            "productid = :id", [':id' => $productid]
        )->asArray()->one();
        $data['all'] = Product::find()->where(
            'ison = "1"'
        )->orderBy("createtime desc")->limit(7)->all();

        $this->layout = "layout2";
        return $this->render("detail", ['product' => $product]);
    }
}