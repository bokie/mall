<?php
namespace app\modules\controllers;

use yii\web\Controller;
use app\models\Product;
use app\models\Category;
use crazyfd\qiniu\Qiniu;
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
     * @return string
     */
    public function actionAdd()
    {
        //查询数据
        $model = new Product;
        $cate = new Category;
        $list = $cate->getOptions();
        unset($list[0]); //销毁变量：“添加一级分类目录”

        //添加商品表单提交处理
        if ( Yii::$app->request->isPost ) {
            $post = Yii::$app->request->post();

            //处理上传的图片
            //上传图片至七牛
            $pics = $this->upload();

            if ( ! $pics ) { //图片为空
                $model->addError("cover", "封面不能为空");
            } else {
                $post['Product']['cover'] = $pics['cover'];
                $post['Product']['pics'] = $pics['pics'];
            }

            //写入数据库
            if ( $pics && $model->add($post) ) {
                Yii::$app->session->setFlash("info", "添加成功");
            } else {
                Yii::$app->session->setFlash("info", "添加失败");
            }
        }


        $this->layout = "layout1";
        return $this->render("add", ['model' => $model, 'opts' => $list]);
    }

    /**
     * 上传图片至七牛
     * @return bool
     */
    private function upload()
    {
        //判断是否有图片
        if ( $_FILES['Product']['error']['cover'] > 0 ) {
            return false;
        }

        //调用七牛SDK上传图片
        $qiniu = new Qiniu(Product::AK, Product::SK, Product::DOMAIN, Product::BUCKET);
        $key = uniqid(); // 命名图片文件，生成一个唯一id
        $qiniu->uploadFile($_FILES['Product']['tmp_name']['cover'], $key);
        $cover = $qiniu->getLink($key); //获取上传的图片的资源获取连接
        $pics = [];

        foreach ( $_FILES['Product']['tmp_name']['pics'] as $k => $file ) {
            if ( $_FILES['Product']['error']['pics'][$k] > 0 ) {
                continue;
            }
            $key = uniqid();
            $qiniu->uploadFile($file, $key);
            $pics[$key] = $qiniu->getLink($key);
        }

        return ['cover' => $cover, 'pics' => json_encode($pics)];
    }

    /**
     * 编辑商品信息
     */
    public function actionMod()
    {
        //获取分类树
        $cate = new Category;
        $list = $cate->getOptions();
        unset($list[0]); //删除“添加顶级分类”

        //获取页面传递参数
        $productid = Yii::$app->request->get("productid");
        $model = Product::find()->where(
            "productid = :id", [':id' => $productid]
        )->one();

        //处理表单提交，修改商品新消息
        if ( Yii::$app->request->isPost ) {
            $post = Yii::$app->request->post();
            $qiniu = new Qiniu(Product::AK, Product::SK, Product::DOMAIN, Product::BUCKET);
            $post['Product']['cover'] = $model->cover;

            //上传封面图片
            if ( $_FILES['Product']['error']['cover'] == 0 ) {
                $key = uniqid();
                $qiniu->uploadFile($_FILES['Product']['tmp_name']['cover'], $key);
                $post['Product']['cover'] = $qiniu->getLink($key);
                $qiniu->delete(basename($model->cover));

            }

            //上传介绍图片
            $pics = [];
            foreach ( $_FILES['Product']['tmp_name']['pics'] as $k =>$file ) {
                if ( $_FILES['Product']['error']['pics'][$k] > 0 ) {
                    continue;
                }
                $key = uniqid();
                $qiniu->uploadFile($file, $key);
                $pics[$key] = $qiniu->getLink($key);
            }
            $post['Product']['pics'] = json_encode(
                array_merge((array)json_decode($model->pics, true), $pics)
            );

            //写入数据库并判断是否成功
            if ( $model->load($post) && $model->save() ) {
                Yii::$app->session->setFlash("info", "修改成功");
            } else {
                Yii::$app->session->setFlash("info", "修改失败");
            }
        }

        $this->layout = "layout1";
        return $this->render("add", ['model' => $model, 'opts' => $list]);
    }

    /**
     * 删除商品信息
     */
    public function actionDel()
    {
        //获取传递参数
        $productid = Yii::$app->request->get("productid");

        $model = Product::find()->where(
            "productid = :pid", [':pid' => $productid]
        )->one();

        //删除存储的图片
        $key = basename($model->cover);
        $qiniu = new Qiniu(Product::AK, Product::SK, Product::DOMAIN, Product::BUCKET);
        $qiniu->delete($key);
        $pics = json_decode($model->pics, true);
        foreach ( $pics as $key => $file ) {
            $qiniu->delete($key);
        }

        //删除数据库中的商品信息
        Product::deleteAll(
            "productid = :pid", [':pid' => $productid]
        );

        return $this->redirect(['product/list']);
    }

    /**
     * 删除商品图片
     */
    public function actionRemovepic()
    {
        //获取传递参数
        $key = Yii::$app->request->get("key");
        $productid = Yii::$app->request->get("productid");

        $model = Product::find()->where(
            "productid = :id", [':id' => $productid]
        )->one();

        //删除存储的图片
        $qiniu = new Qiniu(Product::AK, Product::SK, Product::DOMAIN, Product::BUCKET);
        $qiniu->delete($key);

        //删除数据库中的图片
        $pics = json_decode($model->pics, true);
        unset($pics[$key]);

        //修改数据库
        Product::updateAll(
            ['pics' => json_encode($pics)],
            "productid = :pid", [':pid' => $productid]
        );

        //跳转回页面
        return $this->redirect(['product/mod', "productid" => $productid]);
    }
}