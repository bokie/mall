<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>首页</title>
	<link rel="stylesheet" href="assets/app/css/style.css">
	<link rel="stylesheet" href="assets/app/css/common.css">
	<link rel="stylesheet" href="assets/app/css/index.css">
	<link rel="stylesheet" href="assets/app/css/login.css">
	<link rel="stylesheet" href="assets/app/css/list.css">
	<link rel="stylesheet" href="assets/app/css/detail.css">
	<link rel="stylesheet" href="assets/app/css/cart.css">

</head>
<body>
	<!-- @header 页头 ( 导航 ) -->
	<header>
		<div class="m-nav-site">
			<div class="g-container">
				<div class="g-left">
					<p class="declare">baby muh~</p>
				</div>
				<div class="g-right">
					<?php if ( \Yii::$app->session['isLogin'] == 1 ) : ?>
						<div class="welcome">你好啊，<span><?php echo \Yii::$app->session['loginname']; ?></span></div>
						<div><a href="<?php echo \yii\helpers\Url::to(['user/logout']); ?>">退出</a></div>
						<div class="split"></div>
						<div><a href="#" class="user-order">我的订单</a></div>
					<?php else: ?>
						<div>
							<a href="<?php echo \yii\helpers\Url::to(['user/login']); ?>" class="login">登录</a>
						</div>
						<div>
							<a href="<?php echo \yii\helpers\Url::to(['user/register']); ?>" class="register">注册</a>
						</div>
					<?php endif; ?>
					<div class="split"></div>
				</div>
			</div>
		</div>
		<div class="m-tab-main">
			<div class="g-container">
				<div class="tool-bar">
					<a href="<?php echo yii\helpers\Url::to( ['cart/index'] ); ?>" class="m-cart">
						<i id="j-iconCart" class="iconfont icon-shopcar"></i>
						<span id="j-cartNum" class="cart-num">9</span>
					</a>
					<div class="m-search">
						<input type="text" class="w-search-input" placeholder="搜索">
						<i class="iconfont icon-search"></i>
					</div>
				</div>
			</div>
		</div>
		<div class="m-nav-main">
			<nav class="g-container">
				<ul class="tab-nav">
					<li class="nav-item"><a href="<?php echo yii\helpers\Url::to(['index/index']); ?>" class="top-level">首页</a></li>
					<?php foreach( $this->params['menu'] as $top ) :?>
						<li class="nav-item"><a href="<?php echo yii\helpers\Url::to(['product/index', 'cateid' => $top['cateid']]) ?>" class="top-level"><?php echo $top['title'] ?></a></li>
					<?php endforeach; ?>

				</ul>
				<div class="split"></div>
				<ul class="tab-nav-age">
					<li class="nav-item"><a href="" class="top-level">0-1岁</a></li>
					<li class="nav-item"><a href="" class="top-level">1-3岁</a></li>
					<li class="nav-item"><a href="" class="top-level">3-6岁</a></li>
				</ul>
			</nav>
		</div>
	</header>
	<!-- @header end -->

	<?php echo $content; ?>

	<!-- @footer 页脚 -->
	<footer>

	</footer>
	<!-- @footer end -->
	<script src="assets/app/js/lib/jquery-3.1.0.js"></script>
	<script src="assets/app/js/login.js"></script>
	<script src="assets/app/js/register.js"></script>
</body>
</html>