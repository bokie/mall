<?php
namespace app\modules\controllers;

use yii\web\Controller;
use app\models\Product;
use app\models\Category;
use crazyfd\qiniu;
use Yii;
use yii\data\Pagination;


class ProductController extends Controller
{
    /**
     * 查看商品列表
     */
    public function actionList()
    {
        //查询数据
        $model = Product::find();
        //数据分页
        $count = $model->count();
        $pagesize = Yii::$app->params['pageSize']['product']; // app\config\params 配置文件中配置相关参数
        $pager = new Pagination(['totalCount' => $count, 'pageSize' => $pagesize]);
        $products = $model->offset($pager->offset)->limit($pager->limit)->all();

        $this->layout = "layout1";
        return $this->render("list", ['products' => $products, 'pager' => $pager]);
    }

    /**
     * 添加商品信息
     */
    public function actionAdd()
    {
        //查询数据
        $model = new Product;
        $cate = new Category;
        $list = $cate->getOptions();
        unset($list[0]); //销毁变量：“添加一级分类目录”

        $this->layout = "layout1";
        return $this->render("add", ['model' => $model, 'opts' => $list]);
    }
}