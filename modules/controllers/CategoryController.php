<?php
namespace app\modules\controllers;

use yii\web\Controller;
use Yii;

use app\models\Category;

class CategoryController extends Controller
{
    //分类列表
    public function actionList()
    {
        $model = new Category();
        $cates = $model->getTreeList();

        $this->layout = "layout1";
        return $this->render("cates", ['cates' => $cates]);
    }

    //添加分类
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

    /**
     * 编辑分类
     */
    public function actionMod()
    {
        //获取目标分类信息
        $cateid = Yii::$app->request->get("cateid");
        $model = Category::find()->where(
            'cateid = :id', [':id' => $cateid]
        )->one();
        $list = $model->getOptions();

        //修改操作
        if ( Yii::$app->request->isPost ) {
            $post = Yii::$app->request->post();

            //判断是否修改成功 ? 输出成功信息 :
            if ( $model->load($post) && $model->save() ) {
                Yii::$app->session->setFlash("info", "修改成功");
            }
        }

        $this->layout = "layout1";
        return $this->render("add", ['model' =>$model, 'list' => $list]);
    }

    /**
     * 删除分类
     */
    public function actionDel()
    {
        //捕获错误信息
        try {
            //获取目标分类信息
            $cateid = Yii::$app->request->get("cateid");

            //分类ID是否为空？ 抛出错误信息 :
            if (empty($cateid)) {
                throw new \Exception("参数错误");
            }

            //该分类是否有子分类？ 抛出错误信息 :
            $data = Category::find()->where(
                'parentid = :pid', [':pid' => $cateid]
            )->one();
            if ( $data ) {
                throw new \Exception("该分类下有子分类，不能删除");
            }

            //判断是否删除成功？ : 抛出错误信息
            if ( ! Category::deleteAll('cateid = :id', [':id' => $cateid]) ) {
                throw new \Exceptioin("删除失败");
            }
        } catch ( \Exception $e ) {
            //输出错误信息
            Yii::$app->session->setFlash("info", $e->getMessage());
        }

        //删除成功，返回分类列表页
        return $this->redirect(['category/list']);
    }
}