<?php

namespace app\controllers;

use app\controllers\CommonController;
use app\models\Order;
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

        // ?? to comment
        $transaction = Yii::$app->db->beginTransaction();

        try {
            //处理POST提交数据
            if ( Yii::$app->request->isPost ) {
                $post = Yii::$app->request->post();

                // 实例化一个订单数据模型
                $ordermodel = new Order();
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

            }
        } catch ( \Exception $e ) {

        }

//        $this->redirect(['order/check']);
    }
}