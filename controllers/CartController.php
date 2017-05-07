<?php

namespace app\controllers;

use app\controllers\CommonController;
use app\models\Cart;
use app\models\Product;
use app\models\User;
use Yii;

class CartController extends CommonController
{
    public function actionIndex()
    {
        //判断用户是否登录
        if ( Yii::$app->session['isLogin'] != 1 ) {
            return $this->redirect(['user/login']);
        }

        // 获取当前登录用户的userid
        $userid = User::find()->where(
            'useremail = :name', [':name' => Yii::$app->session['loginname']]
        )->one()->userid;

        // 获取当前用户的购物车数据
        $cart = Cart::find()->where(
            'userid = :uid', [':uid' => $userid]
        )->asArray()->all();

        var_dump($cart);

        // 取商品数据
        $data = [];
        foreach ( $cart as $k => $pro ) {
            $product = Product::find()->where(
                'productid = :pid', [':pid' => $pro['productid']]
            )->one();
            $data[$k]['cover'] = $product->cover;
            $data[$k]['title'] = $product->title;
            $data[$k]['productnum'] = $pro['productnum'];
            $data[$k]['price'] = $pro['price'];
            $data[$k]['productid'] = $pro['productid'];
            $data[$k]['cartid'] = $pro['cartid'];
        }

        var_dump($data);

        //指定使用的布局文件 带商品分类的layout2
        $this->layout = "layoutIndex";
        // views/cart/index.php
        return $this->render("index", ['data' => $data]);
    }

    /**
     * 添加商品至购物车
     */
    public function actionAdd()
    {
        // var_dump($_POST);

        // 判断用户是否登录
        if ( Yii::$app->session['isLogin'] != 1 ) {
            return $this->redirect(['user/login']);
        }

        // 获取当前登录用户userid
        $userid = User::find()->where(
            'useremail = :name', [':name' => Yii::$app->session['loginname']]
        )->one()->userid;

        // 获取post数据
        if ( Yii::$app->request->isPost ) {
            $post = Yii::$app->request->post();
            var_dump($post);
            $num = Yii::$app->request->post()['productnum'];
            $data['Cart'] = $post;
            $data['Cart']['userid'] = $userid;
        }

        // 判断当前用户购物车是否已有该商品数据
        if ( ! $model = Cart::find()->where(
            'productid = :pid and userid = :uid',
            [':pid' => $data['Cart']['productid'], ':uid' => $data['Cart']['userid']]
        )->one() ) {
            $model = new Cart();
        } else {
            $data['Cart']['productnum'] = $model->productnum + $num;
        }

        // 写数据库
        $data['Cart']['createtime'] = time();
        $model->load($data);
        $model->save();

        // 跳转到购物车页面
        return $this->redirect(['cart/index']);

    }

    /**
     * @return \yii\web\Response 跳转回购物车页面
     */
    public function actionDel()
    {
        $cartid = Yii::$app->request->get("cartid");
        Cart::deleteAll('cartid = :cid', [':cid' => $cartid]);
        return $this->redirect(['cart/index']);
    }

}