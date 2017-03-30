<?php
namespace app\controllers;

use yii\web\Controller;
use app\models\User;
use Yii;

class MemberController extends Controller
{
    public function actionAuth()
    {
        $model = new User;

        //表单提交方法
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            if ($model->login($post)) {
                $url = Yii::$app->session->getFlash("referrer");
                $this->redirect($url);
            }
        }

        //使用指定的布局文件 带商品分类的layout2
        $this->layout = "layout2";
        return $this->render("auth", ['model' => $model]);
    }
}