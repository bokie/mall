<?php
namespace app\controllers;

use app\controllers\CommonController;
use app\models\User;
use Yii;

class UserController extends CommonController
{
    public function actionLogin()
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
            var_dump( $post );
            if ($model->login($post)) {
                $url = Yii::$app->session->getFlash("referrer");
                
                $this->redirect($url);
            }
        }

        //使用指定的布局文件 带商品分类的layout2
        $this->layout = "layoutIndex";
        return $this->render("login", ['model' => $model]);
    }

    public function actionLogout()
    {
        Yii::$app->session->remove( 'loginname' );
        Yii::$app->session->remove( 'isLogin' );
        if ( ! isset( Yii::$app->session['isLogin'] ) ) {
            return $this->goBack( Yii::$app->request->referrer );
        }

    }

    public function actionRegister()
    {
        $model = new User;

        if ( Yii::$app->request->isPost ) {
            $post = Yii::$app->request->post();
            // var_dump( $post );
            if ( $model->reg( $post, 'register' ) ) {
                Yii::$app->session->setFlash( 'info', '注册成功' );

            }
        }

        $this->layout = false;
        return $this->render("register", ['model' => $model]);
    }
}