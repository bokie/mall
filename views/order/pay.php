<?php 
use yii\bootstrap\ActiveForm;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>订单支付</title>
    <link rel="stylesheet" href="assets/app/css/style.css">
    <link rel="stylesheet" href="assets/app/css/common.css">
    <link rel="stylesheet" href="assets/app/css/count.css">
</head>
<body>

<?php var_dump($orderid); ?>

    <!-- 结算页页头 @header -->
    <header>
        <div class="m-nav-site">
            <div class="g-container">
                <div class="g-left declare">
                    Baby muh~
                </div>
            </div>
        </div>
        <div class="g-container f-clearfix">
            <div class="m-step-nav g-right">
            </div>
        </div>
    </header>
    <!-- @header end -->

    <!-- 结算页主要部分 @main -->
    <main class="m-count-main">
        <div class="g-container">

            <div class="m-count-header">
                订单支付
            </div>

            <?php ActiveForm::begin([
                'action' => ['order/pay'],
            ]); ?>
            <input type="hidden" name="orderid" 
              value="<?php echo $orderid; ?>">
            <button type="submit" class="w-button-primary">立即支付</button>
            <?php ActiveForm::end(); ?>

        </div>
    </main>
    <!-- @main end -->

    <footer class="g-footer">
        <div class="g-container">
            <span class="copyright">&copy; 2017 bokie.me</span>
            <span>本科毕业设计作品</span>
        </div>
    </footer>

    <script src="assets/app/js/lib/jquery-3.1.0.js"></script>
    <script src="assets/app/js/count.js"></script>


</body>
</html>