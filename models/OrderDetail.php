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

    public function rules()
    {
        return [
            [['productid', 'productnum', 'price', 'orderid', 'createtime'],'required'],
        ];
    }

    /**
     * @param $data OrderDetail 订单详情数据
     * @return bool
     */
    public function add( $data )
    {
        if ( $this->load($data) && $this->save() ) {
            return true;
        }
        return false;
    }
}