<?php
namespace app\modules\controllers;

use app\modules\models\Admin;
use yii\web\Controller;
use yii\data\Pagination;
use Yii;

class ManageController extends Controller
{
    public function actionManagers()  //管理员列表
    {
        $this->layout = "layout1";
        //分页处理
        $model = Admin::find();
        $count = $model->count();
        $pageSize = Yii::$app->params['pageSize']['manage']; //调用配置文件中参数配置中的pageSize
        $pager = new Pagination(['totalCount' => $count, 'pageSize' => $pageSize]);
        $managers = $model->offset($pager->offset)->limit($pager->limit)->all();
        //        $managers = Admin::find()->all();
        return $this->render("managers", ['managers' => $managers, 'pager' => $pager]);
    }

    public function actionReg() //管理员注册
    {
        $model = new Admin;
        //表单提交事件的处理
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            if ($model->reg($post)) {
                Yii::$app->session->setFlash('info', '添加成功');
            } else {
                Yii::$app->session->setFlash('info', '添加失败');
            }
        }
        //添加成功后重置输入框
        $model->adminpass = '';
        $model->repass = '';

        $this->layout = "layout1";
        return $this->render("reg", ['model' => $model]);
    }

    public function actionDel()  //删除管理员账号
    {
        $adminid = (int)Yii::$app->request->get("adminid");
        if (empty($adminid)) {
            $this->redirect(['manage/managers']);
        }

        $model = new Admin;
        if ($model->deleteAll('adminid = :id', [':id' => $adminid])) {
            Yii::$app->session->setFlash("info", "删除成功");
            $this->redirect(['manage/managers']);
        }
    }

    public function actionChangepass()  //修改管理员密码
    {
        $model = Admin::find()->where("adminuser = :user",
            [':user' => Yii::$app->session['admin']['adminuser']])->one();
        $model->adminpass = "";
        $model->repass = "";
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            if ($model->changepass($post)) {
                Yii::$app->session->setFlash("info", "修改成功");
            } else {
                Yii::$app->session->setFlash("info", "修改失败");
            }
        }

        $this->layout = "layout1";
        return $this->render("changepass", ['model' => $model]);
    }

    public function actionUpdateinfo()
    {
        $model = Admin::find()->where('adminuser = :user',
            [':user' => Yii::$app->session['admin']['adminuser']])->one();
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            if ($model->changeemail($post)) {
                Yii::$app->session->setFlash('info', '修改成功');
            } else {
                Yii::$app->session->setFlash("info", "修改失败");
            }
        }

        $model->adminpass = "";
        $this->layout = "layout1";
        return $this->render('updateinfo', ['model' => $model]);
    }

/*    public function actionMailchangepass()  //使用邮件找回密码
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
        if (time() - $time > 300) {
            $this->redirect(['public/login']);
            Yii::$app->end();
        }

        $model->adminuser = $adminuser;
        $this->layout = false;
        return $this->render("mailchangepass", ['model' => $model]);
    }*/
}