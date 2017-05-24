<?php
/**
 * 用户收货地址操作
 */

namespace app\controllers;

use app\controllers\CommonController;
use app\models\Address;
use app\models\User;
use Yii;

class AddressController extends CommonController
{
    /**
     * 添加用户收货地址
     * @return
     */
    public function actionAdd()
    {

        var_dump($_POST);

        // 判断用户是否登录
        if ( Yii::$app->session['isLogin'] != 1 ) {
            return $this->redirect(['member/auth']);
        }

        // 查询用户信息
        $loginname = Yii::$app->session['loginname'];
        $userid = User::find()->where(
            'useremail = :email',
            [':email' => $loginname]
        )->one()->userid;

        // 更新用户收货地址信息
        if ( Yii::$app->request->isPost ) {
            $post = Yii::$app->request->post();
            $post['userid'] = $userid;
            $data['Address'] = $post;
            $model = new Address();
            $model->load($data);
            $model->save();
        }

        return $this->redirect($_SERVER['HTTP_REFERER']);

    }

    public function actionDel()
    {
        // 判断用户是否登录
        if ( Yii::$app->session['isLogin'] != 1 ) {
            return $this->redirect(['member/auth']);
        }

        // 查询用户信息
        $loginname = Yii::$app->session['loginname'];
        $userid = User::find()->where(
            'username = :name or useremail = :email',
            [':name' => $loginname, ':email' => $loginname]
        )->one()->userid;

        // 删除用户收货地址数据
        $addressid = Yii::$app->request->get("addressid");
        //判断该收货地址数据是否存在
        if ( ! Address::find()->where(
            'userid = :uid and addressid = :aid',
            [':uid' => $userid, ':aid' => $addressid]
        )->one() ) {
            return $this->redirect($_SERVER['HTTP_REFERER']);
        }
        Address::deleteAll('addressid = :aid', [':aid' => $addressid]);

        return $this->redirect($_SERVER['HTTP_REFERER']);

    }
}