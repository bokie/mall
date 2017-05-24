<?php
/**
 * 用户收货地址数据
 */

namespace app\models;

use yii\db\ActiveRecord;

class Address extends ActiveRecord
{
    public static function tableName()
    {
        return "{{%address}}";
    }

    public function rules()
    {
        return [
            [['userid', 'name', 'address', 'telephone'], 'required'],
            [['createtime', 'company', 'postcode', 'email'],'safe'],
        ];
    }
}