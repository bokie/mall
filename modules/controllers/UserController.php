<?php

namespace app\modules\controllers;

use yii\web\Controller;
use app\modules\controllers\CommonController;
use app\models\User;
use app\models\Profile;
use yii\data\Pagination;
use Yii;

class UserController extends CommonController
{
    public function actionUsers()
    {
        $model = User::find()->joinWith("profile");
        $count = $model->count();
        $pageSize = Yii::$app->params['pageSize']['user']; //引用params参数配置文件中预设的参数
        $pager = new Pagination(['totalCount' => $count, 'pageSize' => $pageSize]);
        $users = $model->offset($pager->offset)->limit($pager->limit)->all();

        $this->layout = "layout1";
        return $this->render("users", ['users' => $users, 'pager' =>$pager]);
    }

    public function actionReg()
    {
        $model = new User;
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            if ($model->reg($post)) {
                Yii::$app->session->setFlash("info", "添加成功");
            }
        }

        //添加成功后置空输入框
        $model->userpass = "";
        $model->repass = "";

        $this->layout = "layout1";
        return $this->render("reg", ['model' => $model]);
    }
}