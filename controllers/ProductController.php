<?php

namespace app\controllers;

use yii\web\Controller;
use app\controllers\CommonController;
use Yii;
use yii\data\Sort;
use yii\helpers\Inflector;
use app\models\Product;
use app\models\Comment;
use app\models\Category;
use app\models\User;

class ProductController extends CommonController
{
    //禁用模板的头部和脚部
    //    public $layout = false;
    public function actionIndex()
    {
        //获取页面传递的数据
        $cid = Yii::$app->request->get("cateid");

        // 获取分类名称
        $cateTitle = Category::find()->where(
            'cateid = :cid',
            [':cid' => $cid]
            )->one()->title;

        // 排序
        $sort = new Sort([
            'attributes' => [
              'price' => [
                'asc' => [ 'price' => SORT_ASC ],
                'desc' => [ 'price' => SORT_DESC ],
                'default' => SORT_DESC,
                'label' => Inflector::camel2words( '价格' ),
              ],
            ],
            ]);

        //获取商品数据
        $where = "cateid = :cid and ison = '1'";
        $params = [':cid' => $cid];
        $all = Product::find()->where(
            $where, $params
            )->orderBy( $sort->orders )->asArray()->all();
        // var_dump($all);
        $reco = Product::find()->where(
            $where . 'and isreco = \'1\'', $params
            )->orderBy("createtime desc")->limit(5)->asArray()->all();

        
        
        // 加载模板 views/product/index
        $this->layout = "layoutIndex";
        return $this->render("index", ['all' => $all, 'cateTitle' => $cateTitle, 'reco' => $reco, 'sort' => $sort]);
    }

    //商品详情页
    public function actionDetail()
    {
        //获取页面传递的商品id参数
        $productid = Yii::$app->request->get("productid");

        //获取商品数据
        $product = Product::find()->where(
            "productid = :id", [':id' => $productid]
            )->asArray()->one();

        $cid = $product['cateid'];

        // 获取分类名称
        $cateTitle = Category::find()->where(
            'cateid = :cid',
            [':cid' => $cid]
            )->one()->title;

        // 查询商品评论数据
        $comments = Comment::find()->where(
            'productid = :id',
            [':id' => $productid]
            )->asArray()->all();
        $commentsNum = Comment::find()->where(
            'productid = :id',
            [':id' => $productid]
            )->count();

        // var_dump($comments);
        // var_dump($product);

        $this->layout = "layoutIndex";
        return $this->render("detail", ['product' => $product, 'comments' => $comments, 'commentsNum' => $commentsNum, 'cateTitle' => $cateTitle]);
    }

    public function actionSearch()
    {
        $keyword = Yii::$app->request->get('keyword');
        
        // 排序
        $sort = new Sort([
            'attributes' => [
              'price' => [
                'asc' => [ 'price' => SORT_ASC ],
                'desc' => [ 'price' => SORT_DESC ],
                'default' => SORT_DESC,
                'label' => Inflector::camel2words( '价格' ),
              ],
            ],
            ]);

        // var_dump( $keyword );

        if ( ! $keyword == '' ) {
            $key = '%' . $keyword . '%';
        } else {
            $key = $keyword;
        }

        $all = Product::find()->where(
            'title like :keyword',
            [':keyword' => $key ]
            )->orderBy( $sort->orders )->asArray()->all();
        

        // var_dump( $all );

        $this->layout = "layoutIndex";
        return $this->render( 'index', ['all' => $all, 'sort' => $sort , 'keyword' => $keyword]);
    }

    /**
     * 商品评论
    */
    public function actionComment()
    {
        $model = new Comment;

        $productid = Yii::$app->request->get( 'productid' );

        $product = Product::find()->where(
            'productid = :id',
            ['id' => $productid]
            )->asArray()->one();

        // var_dump($product);
        // exit();

        $this->layout = "layoutIndex";
        return $this->render( 'comment', ['product' => $product, 'model' => $model] );
    }

    public function actionAddcomment()
    {
        // 获取当前登录用户userid
        $userid = User::find()->where(
            'useremail = :name', [':name' => Yii::$app->session['loginname']]
        )->one()->userid;

         // 验证是否为POST提交
        if ( ! Yii::$app->request->isPost ) {
            throw new \Exception();
        }
        $post = Yii::$app->request->post();
        $post['Comment']['createtime'] = time();
        $post['Comment']['userid'] = $userid;

        var_dump($post);

        // 数据库存储
        $model = new Comment;
        $model->load($post);
        $model->save();
        // Cart::updateAll(['productnum' => $productnum], 'cartid = :cid', [':cid' => $cartid]);
        $this->redirect(['order/index']);

    }
}