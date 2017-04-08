<?php
/**
 * 订单详情数据
 */

namespace app\models;

use yii\db\ActiveRecord;

class OrderDetail extends ActiveRecord
{
    public static function tableName()
    {
        return "{{%order_detail}}";
    }
}