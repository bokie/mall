<?php

namespace app\models;

use yii\db\ActiveRecord;
use Yii;
use yii\helpers\ArrayHelper;

class Category extends ActiveRecord
{
    //指定表名
    public static function tableName()
    {
        return "{{%category}}";
    }

    //设置表单字段标签名称
    public function attributeLabels()
    {
        return [
            'parentid' => '上级分类',
            'title' => '分类名称',
        ];
    }

    //设置数据验证规则
    public function rules()
    {
        return [
            [
                'parentid', 'required', 'message' => '上级分类不能为空'
            ],
            [
                'title', 'required', 'message' => '分类名称不能为空'
            ],
            [
                'createtime', 'safe'
            ],
        ];
    }

    //添加分类方法
    public function add($data)
    {
        $data['Category']['createtime'] = time(); //需添加规则才能保存？ 要添加表名 表名首字母要大写
        if ( $this->load($data) && $this->save() ) {
            return true;
        }
        return false;
    }

    //查询分类
    public function getData()
    {
        $cates = self::find()->all();

        //把数据查询结果（对象）转换为数组
        $cates = ArrayHelper::toArray($cates);
        return $cates;
    }

    //生成分类树
    public function getTree($cates, $pid = 0)
    {
        $tree = [];
        foreach ($cates as $cate) {
            if ( $cate['parentid'] == $pid ) {
                $tree[] = $cate;
                $tree = array_merge($tree, $this->getTree($cates, $cate['cateid']));
            }
        }

        return $tree;
    }

    //添加分类前缀
    public function setPrefix($data, $prefix = "|-----")
    {
        $tree = [];
        $num = 1;
        $prefix = [
            0 => 1,
        ];
        while($val = current($data)) {
            $key = key($data);
            if ($key > 0) {
                if () {

                }
            }
        }
    }

}