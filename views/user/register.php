<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>注册</title>
	<link rel="stylesheet" href="assets/app/css/style.css">
	<link rel="stylesheet" type="text/css" href="assets/app/css/register.css">
</head>
<body>

	<!-- @header 页头 -->
	<header>
		<div class="m-nav-register">
			<div class="g-container">
				<div class="g-left">
					<p class="info">欢迎注册</p>
				</div>
				<div class="g-right">
					<a href="<?php echo \yii\helpers\Url::to(['user/login']); ?>" class="login">已有账号，去登录 ></a>
				</div>
			</div>
		</div>
	</header>
	<!-- @header end -->

	<!-- @main 注册内容区域 -->
	<main>
		<div class="g-container">
			<div class="m-register-area">
				<div class="register-wrap">
					<?php
					if (Yii::$app->session->hasFlash('info')) {
						echo Yii::$app->session->getFlash('info');
					}
					// var_dump( $_SESSION );
					?>
					<?php $form = ActiveForm::begin([
						'action' => ['user/register']
						]); ?>
						<div class="input-box">
							<?php echo $form->field( $model, 'useremail' )->textInput(['id' => 'j-acctInfo', 'placeholder' => '请填写您常用的邮箱账号']); ?>
							<div class="info">
								<p class="j-acctInfo" style="display: none;"></p>
							</div>
						</div>


						<div class="input-box">
							<?php echo $form->field( $model, 'userpass' )->passwordInput(['id' => 'j-acctInfo', 'placeholder' => '请输入6-16位密码']); ?>
							<!-- <label for="" class="">输入密码：</label>
							<input id="j-passInput-reg" type="password" class="" placeholder="请输入6-16位密码"> -->
							<div class="info">
								<p class="j-passInfo"></p>
							</div>
						</div>


						<div class="input-box">
							<?php echo $form->field( $model, 'repass' )->passwordInput(['id' => 'j-acctInfo', 'placeholder' => '请再输入一次您的密码']); ?>
							<!-- <label for="" class="">确认密码：</label>
							<input id="j-passInput-2nd" type="password" class="" placeholder="请再输入一次您的密码(这个有必要吗？)"> -->
							<div class="info">
								<p class="j-pass2ndInfo" style="display: none;"></p>
							</div>
						</div>

						<div class="input-box" style="visibility: hidden;">
							<label for="" class="">验证码：</label>
							<input type="text" class="">
							<div class="info">
								<p class="" style="display: none;"></p>
							</div>
						</div>

						<div class="submit-box">
							<button class="w-button-primary">注 册</button>
						</div>
						<?php ActiveForm::end(); ?>			
					</div>
				</div>
			</div>
		</main>
		<!-- @main end -->

		<!-- <script src="assets/app/js/lib/jquery-3.1.0.js"></script>
		<script src="assets/app/js/register.js"></script> -->
	</body>
	</html>