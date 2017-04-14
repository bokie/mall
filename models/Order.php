<?php
/**
 * 订单数据表
 */

namespace app\models;

use yii\db\ActiveRecord;

use app\models\OrderDetail;
use app\models\Product;
use app\models\Category;

class Order extends ActiveRecord
{
    // 定义订单状态码
    const CREATEORDER = 0;
    const CHECKORDER = 100;
    const PAYFAILED = 201;
    const PAYSUCCESS = 202;
    const SENDED = 220;
    const RECIEVED = 260;

    // 定义查询数据名称字段(其他数据表字段)
    public $products;
    public $zhstatus;
    public $username;
    public $address;

    public static function tableName()
    {
        return "{{%order}}";
    }

    public function rules()
    {
        return [
            [['userid', 'status'], 'required', 'on' => ['add']],
            [['addressid', 'expressid', 'amount', 'status'], 'required', 'on' => ['update']],
            ['expressno', 'required', 'message' => '请输入快递单号', 'on' => 'send'],
            ['createtime', 'safe', 'on' => ['add']],
        ];
    }

    public static $status = [ // 用户订单状态码标识
        self::CREATEORDER => '订单初始化',
        self::CHECKORDER => '待支付',
        self::PAYFAILED => '支付失败',
        self::PAYSUCCESS => '等待发货',
        self::SENDED => '已发货',
        self::RECIEVED => '订单完成',
    ];

    public static function getDetail( $orders )
    {
        foreach ( $orders as $order ) {
            $order = self::getData($order);
        }
        return $orders;
    }

    /**
     * 多表联合查询用户订单数据（后台订单管理）
     * @param $order
     * @return mixed
     */
    public static function getData( $order )
    {
        // 查询订单详情
        $details = OrderDetail::find()->where(
            'orderid = :oid', [':oid' => $order->orderid]
        )->all();
        // 查询订单商品数据
        $products = [];
        foreach ( $details as $detail ) {
            $product = Product::find()->where(
                'productid = :pid', [':pid' => $detail->productid]
            )->one();
            if ( empty($product) ) { // 查询结果为空执行下一次循环
                continue;
            }
            $product->num = $detail->productnum; // 将订单商品数量覆盖库存数量，便于页面数据显示
            $products = $product;
        }
        $order->products[] = $products;
        // 查询订单用户数据
        $user = User::find()->where(
            'userid = :uid', [':uid' => $order->userid]
        )->one();
        if ( ! empty($user) ) {
            $order->username = $user->username;
        }
        $order->address = Address::find()->where(
            'addressid = :aid', [':aid' => $order->addressid]
        )->one();
        if ( empty($order->address) ) {
            $order->address = "";
        } else {
            $order->address = $order->address->address;
        }
        $order->zhstatus = self::$status[$order->status];

        var_dump($order);

        return $order;

    }

    /**
     * 查询用户订单数据（用户订单列表页）
     * @param $userid
     * @return array|ActiveRecord[]
     */
    public static function getProducts($userid)
    {
        // 查询用户所有订单
        $orders = self::find()->where(
            'status > 0 and userid = :uid',
            [':uid' => $userid]
        )->orderBy('createtime desc')->all();

        // 遍历订单取商品数据
        foreach ( $orders as $order ) {
            $details = OrderDetail::find()->where(
                'orderid = :oid',
                [':oid' => $order->orderid]
            )->all();
            $products = [];
            foreach ( $details as $detail ) {
                $product = Product::find()->where(
                    'productid = :pid',
                    [':pid' => $detail->productid]
                )->one();
                if ( empty($product) ) {
                    continue;
                }
                $product->num = $detail->productnum;
                $product->price = $detail->price;
                $product->cate = Category::find()->where(
                    'cateid = :cid',
                    [':cid' => $product->cateid ]
                )->one()->title;
                $products[] = $product;
            }

            $order->zhstatus = self::$status[$order->status]; // 订单状态中文信息
            $order->products = $products;
        }

        return $orders;

    }

}