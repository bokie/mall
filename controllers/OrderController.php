<?php

namespace app\controllers;

use app\controllers\CommonController;
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

    public function actionCheck()
    {

        $this->layout = "layout1";
        return $this->render("check");
    }

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
}