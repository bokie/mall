	<!-- @main 个人中心个人信息主要内容 -->
	<main class="g-personal f-clearfix">
		<div class="g-container">

			<aside class="m-sidebar">
				<div class="header">
					<p>个人中心</p>
				</div>
				<div class="nav">
					<ul>
						<li class="nav-item">
							<a href="<?php echo yii\helpers\Url::to( ['order/index'] ); ?>">我的订单</a>
						</li>
						<li class="nav-item z-active">
							<a href="javascript:;">个人信息</a>
						</li>
					</ul>
				</div>
			</aside>

			<section class="m-personal-info">
				<div class="header">
					<p>个人信息</p>
				</div>

				<div class="personal-info f-clearfix">
					<div class="avatar">
						<img src="" alt="">

						<a class="change" href="javascript:;">更换头像</a>
					</div>

					<div class="info">
						<form action="">
							<div class="info-item">
								<span>邮箱</span>
								<input type="text">
							</div>
							<div class="info-item">
								<span>昵称</span>
								<input type="text">
							</div>
							<div class="info-item">
								<span>性别</span>
								<div class="w-radio-group">
									<input type="radio" value="">
								</div>
								<div class="w-radio-group">
									<input type="radio" value="">
								</div>
							</div>
							<div class="info-item">
								<span>年龄</span>
								<input type="text">
							</div>
							<button class="w-button-sm">保存</button>
						</form>
					</div>


				</div>



			</section>

		</div>

	</main>
	<!-- @main end -->