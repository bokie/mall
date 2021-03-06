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
        // 判断用户是否登录
        if ( Yii::$app->session['isLogin'] != 1 ) {
            return $this->redirect(['user/login']);
        }

        // 获取用户信息
        $loginname = Yii::$app->session['loginname'];
        $userid = User::find()->where(
            'username = :uname or useremail = :email',
            [':uname' => $loginname, ':email' => $loginname]
            )->one()->userid;

        // 查询用户订单信息
        $orders = Order::getProducts($userid);
        // var_dump($orders); // 调试信息

        $this->layout = "layoutIndex";
        return $this->render("index", ['orders' => $orders]);
    }

    /**
     * 用户购物车结算，初始化订单数据
     * @return
     */
    public function actionAdd()
    {
        //打印post数据
       /*var_dump($_POST);
       exit();*/

        //判断用户是否登录
       if ( Yii::$app->session['isLogin'] != 1 ) {
        return $this->redirect(['user/login']);
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
                'useremail = :email',
                [':email' => Yii::$app->session['loginname']]
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
            return $this->redirect(['user/login']);
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

        // var_dump($data);
        // var_dump($addresses);

        $this->layout = false;
        return $this->render("check", ['products' => $data, 'addresses' => $addresses]);
    }

    /**
     * 用户确认订单， 更新用户订单数据 (addressid, expressid, status, amount(orderid, userid))
     */
    public function actionConfirm()
    {
        // var_dump($_POST);
        // exit();

        try {
            // 判断用户是否登录
            if ( Yii::$app->session['isLogin'] != 1 ) {
                return $this->redirect(['user/login']);
            }

            // 验证是否为POST提交
            if ( ! Yii::$app->request->isPost ) {
                throw new \Exception();
            }
            $post = Yii::$app->request->post();
            $orderid = $post['orderid'];

            // 查询用户数据
            $loginname = Yii::$app->session['loginname'];
            $usermodel = User::find()->where(
                'username = :name or useremail = :email',
                [':name' => $loginname, ':email' =>$loginname]
                )->one();
            if ( ! $usermodel ) { // 用户查询数据为空，抛出异常
                throw new \Exception();
            }
            $userid = $usermodel->userid;


            //查询订单数据
            $model = Order::find()->where(
                'orderid = :oid and userid = :uid',
                [':oid' => $post['orderid'], ':uid' => $userid]
                )->one();
            if ( ! $model ) { // 订单查询数据为空，抛出异常
                throw new \Exception();
            }

            // 更新数据操作
            $model->scenario = "update";
            $post['status'] = Order::CHECKORDER;
            $details = OrderDetail::find()->where(
                'orderid = :oid',
                [':oid' => $post['orderid']]
                )->all();
            // 计算订单商品总价
            $amount = 0;
            foreach ( $details as $detail ) { // 查询订单中每条商品数据
                $amount += ($detail->productnum * $detail->price);
            }
            if ( $amount <= 0 ) { // 订单总额数据错误，抛出异常
                throw new \Exception();
            }
            // 快递价格
            // $expressPrice = Yii::$app->params['expressPrice'][$post['expressid']];
            // if ( $expressPrice < 0 ) {
            //     throw new \Exception();
            // }
            // $amount += $expressPrice;
            $post['amount'] =$amount;

            // 数据库数据存储
            $data['Order'] = $post;
            if ( empty($post['adressid']) ) { //判断用户地址数据是否为空
               // TODO
            }
            if ( $model->load($data) && $model->save() ) { //判断订单数据是否更新成功
                // print "订单已更新";
                $this->layout = false;
                return $this->render('pay', ['orderid' => $orderid]);
            }


        } catch (\Exception $e) {
            $this->redirect(['index/index']);
        }

    }

     /**
     * 用户支付订单
     */
     public function actionPay()
     {
        // 判断用户是否登录
        if ( Yii::$app->session['isLogin'] != 1 ) {
            return $this->redirect(['user/login']);
        }

        $post = Yii::$app->request->post();
        var_dump( $post );



        // 查询当前用户id
        $userid = User::find()->where(
            'useremail = :name',
            [':name' => Yii::$app->session['loginname']]
            )->one()->userid;

        // 查询订单数据
        $model = Order::find()->where(
            'orderid = :oid and userid = :uid',
            [':oid' => $post['orderid'], ':uid' => $userid]
            )->one();
        if ( ! $model ) { // 订单查询数据为空，抛出异常
            throw new \Exception();
        }

        // 更新订单状态
        $model->scenario = "statusUpdate";

        $post['status'] = Order::PAYSUCCESS;
        $data['Order'] = $post;

        if ( $model->load($data) && $model->save() ) { //判断订单数据是否更新成功
            print "订单已更新";
                // $this->layout = false;
                // return $this->render('pay', ['orderid' => $orderid]);
        }

        $this->redirect(['order/index']);

        // 验证是否POST提交
        // if ( ! Yii::$app->request->isPost ) {
        //     throw new \Exception();
        // }

    }

    /**
     * 用户订单确认收货操作
     * @return \yii\web\Response
     */
    public function actionReceived()
    {
        // 获取订单信息
        $orderid = Yii::$app->request->get('orderid');
        $order = Order::find()->where(
            'orderid = :oid',
            [':oid' => $orderid]
            )->one();

        // 更改订单状态
        if ( ! empty($order) && $order->status == Order::SENDED ) {
            $order->status = Order::RECIEVED;
            $order->save();
        }

        return $this->redirect(['order/index']);
    }


}