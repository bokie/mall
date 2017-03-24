<p> 用户： <?php echo $adminuser; ?></p>

<?php $url = Yii::$app->urlManager->createAbsoluteUrl(['admin/manage/mailchangepass',
    'timestamp' => $time, 'adminuser' => $adminuser, 'token' => $token]); ?>

<a href="<?php echo $url; ?>"> 找回密码的链接 </a>
