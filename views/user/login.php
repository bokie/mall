<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>

<!-- @main 登录页主要内容 -->
<main>
	<div class="g-bd">
		<div class="m-bg">
			<div class="g-container">
				<div class="m-login-area">
					<div class="login-wrap">
						<div class="login-title">
							<p>欢迎回来，请登录</p>
						</div>
						<div id="account-box" class="login-form">
							<?php $form = ActiveForm::begin(); ?>
							<?php
							if (Yii::$app->session->hasFlash('info')) {
								echo Yii::$app->session->getFlash('info');
							}
							?>
							<div class="input-box">
								<div class="u-logo">
									<i class="iconfont icon-user"></i>
								</div>
								<div class="u-input">
									<?php echo $form->field( $model, 'useremail')->textInput(['id' => 'j-acctInfo', 'placeholder' => '请填写您的邮箱账号']); ?>
											<!-- <label for=""></label>
											<input id="j-acctInput" type="text" placeholder="请填写您的邮箱账号" > -->
										</div>
									</div>

									<div class="input-box">
										<div class="u-logo">
											<i class="iconfont icon-password"></i>
										</div>
										<div class="u-input">
											<?php echo $form->field( $model, 'userpass')->passwordInput(['id' => 'j-acctInfo', 'placeholder' => '请输入密码']); ?>
											<!-- <label for=""></label>
											<input id="j-passInput" type="password" placeholder="请输入密码"> -->
										</div>
									</div>

									<div id="j-errMsg" class="error_msg" style="display: none;"></div>

									<div class="login-box">
										<button type="submit" class="u-btn-login">登 录</a>
										</div>
										<?php ActiveForm::end(); ?>

										<div class="m-unlogin">
											<a href="" class="get-password">找回密码</a>
											<a href="<?php echo \yii\helpers\Url::to(['user/register']); ?>" class="register">去注册</a>
										</div>

										<div class="split"></div>

										<a class="login-weibo">
											<i class="iconfont icon-weibo"></i>
											使用微博账号登录
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</main>
	<!-- @main end -->