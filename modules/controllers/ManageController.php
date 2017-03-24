<?php
namespace app\modules\controllers;

use app\modules\models\Admin;
use yii\web\Controller;
use Yii;

class ManageController extends Controller
{
    public function actionMailchangepass()
    {
        //接收参数
        $time = Yii::$app->request->get("timestamp");
        $adminuser = Yii::$app->request->get("adminuser");
        $token = Yii::$app->request->get("token");

        //验证
        $model = new Admin;
        $myToken = $model->createToken($adminuser, $time);
        if ($token != $myToken) {
            $this->redirect(['public/login']);
            Yii::$app->end();
        }

        //超时验证
        if(time() - $time > 300) {
            $this->redirect(['public/login']);
            Yii::$app->end();
        }

        $model->adminuser = $adminuser;
        $this->layout = false;
        return $this->render("mailchangepass", ['model' => $model]);


    }
}