<?php
namespace app\models;

use yii\db\ActiveRecord;

class Product extends ActiveRecord
{
    //定义七牛 token
    const AK = "q3wWTNBixwViDk6aqiwGCDi5wY3CO50dqt-JH-tU";
    const SK = "JwgK_C3qalMRsmDg9KH1lb4HxnGupuIf2sF7U88l";
    const DOMAIN = "http://onu36t5vy.bkt.clouddn.com";
    const BUCKET = "mall";


    public static function tableName()
    {
        return "{{%product}}";
    }

    /**
     * 设置属性标签名称
     */
    public function attributeLabels()
    {
        return [
            'cateid' => '分类名称',
            'title'  => '商品名称',
            'descr'  => '商品描述',
            'price'  => '商品价格',
            'ishot'  => '是否热卖',
            'issale' => '是否促销',
            'saleprice' => '促销价格',
            'num'    => '库存',
            'cover'  => '图片封面',
            'pics'   => '商品图片',
            'ison'   => '是否上架',
            'isreco'   => '是否推荐',
        ];
    }

    /**
     * 数据验证规则
     * @return array
     */
    public function rules()
    {
        return [
            [
                'title', 'required', 'message' => '标题不能为空'
            ],
            [
                'descr', 'required', 'message' => '描述不能为空'
            ],
            [
                'cateid', 'required', 'message' => '分类不能为空'
            ],
            [
                'price', 'required', 'message' => '单价不能为空'
            ],
            [
                ['price','saleprice'], 'number', 'min' => 0.01, 'message' => '价格必须是数字'
            ],
            [
                'num', 'integer', 'min' => 0, 'message' => '库存必须是数字'
            ],
            [
                ['issale','ishot', 'pics'],'safe'
            ],
            [
                ['cover'], 'required'
            ],
        ];
    }

    /**
     * 添加商品信息，数据库写入
     * @param $data  Product 提交的商品数据信息
     */
    public function add($data)
    {
        //验证数据后写入
        if ( $this->load($data) && $this->save() ) {
            return true;
        }

        return false;
    }
}