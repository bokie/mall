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
        if ($this->load($data) && $this->save()) {
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
            if ($cate['parentid'] == $pid) {
                $tree[] = $cate;
                $tree = array_merge($tree, $this->getTree($cates, $cate['cateid']));
            }
        }

        return $tree;
    }

    //添加分类前缀
    public function setPrefix($data, $p = "|-----")
    {
        $tree = [];
        $num = 1;  //添加前缀的数量
        $prefix = [0 => 1];// 默认添加一个前缀

        while ( $val = current($data) ) {
            $key = key($data);
            if ( $key > 0 ) {
                if ( $data[$key - 1]['parentid'] != $val['parentid'] ) {
                    $num++;
                }
            }
            if ( array_key_exists($val['parentid'], $prefix) ) {
                $num = $prefix[$val['parentid']];
            }

            $val['title'] = str_repeat($p, $num).$val['title'];
            $prefix[$val['parentid']] = $num;
            $tree[] = $val;
            next($data);
        }

        return $tree;
    }

    //获得优化好的分类树（用于 $list 下拉列表）
    public function getOptions()
    {
        $data = $this->getData();
        $tree = $this->getTree($data);
        $tree = $this->setPrefix($tree);
        $options = ['添加到一级分类目录'];

        foreach ( $tree as $cate ) {
            $options[$cate['cateid']] = $cate['title'];
        }

        return $options;

    }

    //获取分类列表
    public function getTreeList()
    {
        $data = $this->getData();
        $tree = $this->getTree($data);
        return $tree = $this->setPrefix($tree);
    }
}