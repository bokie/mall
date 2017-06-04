<?php
/**
 * OrederController 用户订单管理
 */
namespace app\modules\controllers;

use Yii;
use app\models\Order;
use app\modules\controllers\CommonController;
use yii\data\Pagination;

class OrderController extends CommonController
{
    /**
     * 查询订单列表
     * @return string
     */
    public function actionList()
    {
        // 查询订单
        $model = Order::find();

        // 数据分页
        $count = $model->count();
        $pageSize = Yii::$app->params['pageSize']['order']; // 获取分页大小参数
        $pager = new Pagination(['totalCount' => $count, 'pageSize' => $pageSize]);

        // 获取订单数据
        $data = $model->offset($pager->offset)->limit($pager->limit)->all();
        $data = Order::getDetail($data);

        var_dump( $data );
        

        $this->layout = "layout1";
        return $this->render('list', ['pager' => $pager, 'orders' => $data]);
    }

    /**
     * 查询订单详情
     * @return string
     */
    public function actionDetail()
    {
        // 获取传递参数 orderid
        $orderid = (int)Yii::$app->request->get('orderid');
        $order = Order::find()->where(
            'orderid = :oid', [':oid' => $orderid]
        )->one();
        $data = Order::getData($order);


        $this->layout = "layout1";
        return $this->render('detail', ['order' => $data]);
    }

    public function actionSend()
    {
        // 获取订单id
        $orderid = Yii::$app->request->get("orderid");

        // 查询订单
        $model = Order::find()->where(
            'orderid = :id', [':id' => $orderid]
        )->one();

        // 更新订单状态
        $model->scenario = "send";
        if ( Yii::$app->request->isPost ) {
            $post = Yii::$app->request->post();
            $model->status = Order::SENDED;
            if ( $model->load($post) && $model->save() ) {
                Yii::$app->session->setFlash('info', '发货成功');
            }
        }

        $this->layout = "layout1";
        return $this->render('send', ['model' => $model]);
    }



}