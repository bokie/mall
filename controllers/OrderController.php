<?php

namespace app\controllers;

use app\controllers\CommonController;
use app\models\Address;
use app\models\Cart;
use app\models\Order;
use app\models\OrderDetail;
use app\models\Product;
use app\models\User;
use Yii;

class OrderController extends CommonController
{
    public function actionIndex()
    {
        $this->layout = "layout2";
        return $this->render("index");
    }

    /**
     * 用户购物车结算，初始化订单数据
     * @return
     */
    public function actionAdd()
    {
        //打印post数据
//        var_dump($_POST);

        //判断用户是否登录
        if ( Yii::$app->session['isLogin'] != 1 ) {
            return $this->redirect(['member/auth']);
        }

        // 开始一个数据库事务
        $transaction = Yii::$app->db->beginTransaction();

        try {
            //处理POST提交数据
            if ( Yii::$app->request->isPost ) {
                $post = Yii::$app->request->post();

                // 实例化一个订单数据模型
                $ordermodel = new Order;
                $ordermodel->scenario = "add";

                // 获取当前用户数据
                $usermodel = User::find()->where(
                    'username = :uname or useremail = :email',
                    [':uname' => Yii::$app->session['loginname'],
                        ':email' => Yii::$app->session['loginname']]
                )->one();
                if ( !$usermodel ) { // 查询不到当前用户，抛出异常
                    throw new \Exception;
                }
                $userid = $usermodel->userid; // 获取当前用户ID

                // 生成用户订单数据
                $ordermodel->userid = $userid;
                $ordermodel->status = Order::CHECKORDER; // 设置订单状态Order::CREATEORDER 200
                $ordermodel->createtime = time();

                //保存订单数据
                if ( ! $ordermodel->save() ) { // 存储失败抛出异常
                    throw new \Exception;
                }

                //生成订单详情数据
                $orderid = $ordermodel->getPrimaryKey();
                foreach ( $post['OrderDetail'] as $product ) {
                    $model = new OrderDetail;
                    $product['orderid'] = $orderid;
                    $product['createtime'] = time();
                    $data['OrderDetail'] = $product;

                    // 写入数据
                    if ( ! $model->add($data) ) {
                        throw new \Exception();
                    }

                    // 删除当前用户购物车数据
                    Cart::deleteAll('productid = :pid', [':pid' => $product['productid']]);

                    // 商品库存数量更新
                    Product::updateAllCounters(['num' => -$product['productnum']],
                        'productid = :pid', ['pid' => $product['productid']]
                        );

                }

                // 事务提交
                $transaction->commit();

            }
        } catch ( \Exception $e ) { // 捕获异常
            $transaction->rollBack(); //回滚数据
            return $this->redirect(['index/index']);
        }

        // 事务执行成功，跳转至订单确认页面
        $this->redirect(['order/check', 'orderid' => $orderid]);
    }

    /**
     * 处理用户提交订单数据
     * @return string|\yii\web\Response
     */
    public function actionCheck()
    {
        // 判断用户是否登录
        if ( Yii::$app->session['isLogin'] != 1 ) {
            return $this->redirect(['member/auth']);
        }

        // 获取订单初始数据
        $orderid = Yii::$app->request->get("orderid");
        $status = Order::find()->where(
            'orderid = :oid', [':oid' => $orderid ]
        )->one()->status;  //查询订单状态
        if ( $status != Order::CHECKORDER && Order::CHECKORDER ) { // 判断是否已经生成订单
            return $this->redirect(['order/index']);
        }

        // 获取用户数据
        $loginname = Yii::$app->session['loginname'];
        $userid = User::find()->where(
            'username = :name or useremail = :email',
            [':name' => $loginname,':email' => $loginname]
        )->one()->userid;
        $addresses = Address::find()->where(
            'userid = :uid',
            [':uid' => $userid]
        )->asArray()->all();

        // 查询订单数据
        $details = OrderDetail::find()->where(
            'orderid = :oid',
            [':oid' => $orderid]
        )->asArray()->all(); // 查询订单详细数据
        $data = [];
        foreach ( $details as $detail) { // 遍历订单详情数据获取订单中每条商品信息
            $model = Product::find()->where(
                'productid = :pid', [':pid' => $detail['productid']]
            )->one();
            $detail['title'] = $model->title;
            $detail['cover'] = $model->cover;
            $data[] = $detail;
        }

        // 设置快递数据
        $express = Yii::$app->params['express'];
        $expressPrice = Yii::$app->params['expressPrice'];


        $this->layout = "layout1";
        return $this->render("check", ['products' => $data, 'addresses' => $addresses,
            'express' => $express, 'expressPrice' => $expressPrice]);
    }

    /**
     * 用户确认订单， 更新用户订单数据
     */
    public function actionConfirm()
    {
        var_dump($_POST);
    }


}