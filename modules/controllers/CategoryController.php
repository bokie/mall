<?php
namespace app\modules\controllers;

use yii\web\Controller;
use Yii;

use app\models\Category;

class CategoryController extends Controller
{
    public function actionList()
    {
        $this->layout = "layout1";
        return $this->render("cates");
    }

    public function actionAdd()
    {
        $model = new Category();
        if ( Yii::$app->request->isPost ) {
            $post = Yii::$app->request->post();
            if ( $model->add($post) ) {
                Yii::$app->session->setFlash("info", "添加成功");
            }
        }

        //分类数据调试信息
//        $cates = $model->getData();
//        var_dump($cates);
//        $tree = $model->getTree($cates);
//        var_dump($tree);

        //获得分类
        $list = $model->getOptions();

        $this->layout = "layout1";
        return $this->render("add", ['list' => $list, 'model' => $model]);
    }
}