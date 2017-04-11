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

        $this->layout = "layout1";
        return $this->render('list', ['pager' => $pager, 'orders' => $data]);
    }

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

}