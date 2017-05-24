<?php
namespace app\models;

use yii\db\ActiveRecord;
use Yii;

class Cart extends ActiveRecord
{
    public static function tableName()
    {
        return "{{%cart}}";
    }

    public function rules()
    {
        return [
            [['productid', 'productnum', 'userid', 'price'], 'required'],
            ['createtime', 'safe']
        ];
    }

    public static function getNum( $userid )
    {
        $num = self::find()->where(
            'userid = :uid',
            [':uid' => $userid]
            )->count();

        return $num;
    }
}