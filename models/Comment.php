<?php
namespace app\models;

use yii\db\ActiveRecord;
use Yii;

class Comment extends ActiveRecord
{
    public static function tableName()
    {
        return "{{%comment}}";
    }

    public function rules()
    {
        return [
            [['productid', 'userid', 'content'], 'required'],
            ['createtime', 'safe']
        ];
    }

    public static function getNum( $productid )
    {
        $num = self::find()->where(
            'productid = :pid',
            [':pid' => $productid]
            )->count();

        return $num;
    }
}