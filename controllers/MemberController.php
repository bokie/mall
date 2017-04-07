<?php
namespace app\controllers;

use app\controllers\CommonController;
use app\models\User;
use Yii;

class MemberController extends CommonController
{
    public function actionAuth()
    {
        //获取入口地址
        if (Yii::$app->request->isGet) {
            $url = Yii::$app->request->referrer;
            if (empty($url)) {
                $url = "/";
            }
            Yii::$app->session->setflash("referrer", $url);
        }

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