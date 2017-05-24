<?php 
use yii\bootstrap\ActiveForm;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>订单结算</title>
    <link rel="stylesheet" href="assets/app/css/style.css">
    <link rel="stylesheet" href="assets/app/css/common.css">
    <link rel="stylesheet" href="assets/app/css/count.css">
</head>
<body>

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
                订单结算
            </div>

            <div class="m-address-select">
                <div class="header">
                    选择收货地址
                </div>
                <div class="new-address">
                    <a id="j-newAddress" href="javascript:;">+ 新建收货地址</a>
                    <div id="j-addressForm" class="content f-clearfix" style="display: none;">

                        <?php ActiveForm::begin([
                            'action' => ['address/add'],
                            ]); ?>
                            <div class="box name-box g-left">
                                <label>收货人姓名</label>
                                <input type="text" name="name" placeholder="请输入收货人姓名">
                            </div>
                            <div class="box tel-box g-left">
                                <label>联系电话</label>
                                <input type="text" name="telephone" placeholder="填写您的手机号码">
                            </div>
                            <div class="box address-box g-left">
                                <label>收货地址</label>
                                <input type="text" name="address" placeholder="请输入详细的收货地址">
                            </div>
                            <div class="option g-right f-clearfix">
                                <button type="submit" class="w-button-sm g-left">添 加</button>
                                <a class="cancel g-left j-cancel" href="javascript:;">取消</a>
                            </div>
                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                    <div class="my-address">

                        <?php foreach ( $addresses as $key => $address ) : ?>
                            <input class="j-radio j-address" type="radio" name="address"
                            value="<?php echo $address['addressid']; ?>"
                            >
                            <a href="javascript:;">
                                <?php echo $address['name'] . " ". $address['telephone'] . " " . $address['address']; ?>
                            </a>
                        <?php endforeach; ?>

                    </div>
                </div>

                <?php ActiveForm::begin([
                    'action'  => ['order/confirm'],
                    'options' => ['id' => 'orderConfirm'],
                    ]); ?>

                    <div class="m-order-check">
                        <div class="header">
                            订单详情
                        </div>
                        <div class="content">

                            <?php $total = 0; ?>

                            <?php foreach ( $products as $product ) : ?>
                                <div class="content-item f-clearfix">
                                    <div class="img g-left">
                                        <img src="<?php echo $product['cover']; ?>-coversmall" alt="<?php echo $product['title'];?>">
                                    </div>
                                    <span class="title g-left"><?php echo $product['title']; ?></span>
                                    <span class="num g-left"><span>x </span><?php echo $product['productnum']; ?></span>
                                    <span class="price g-left"><?php echo $product['price']; ?></span>
                                </div>

                                <?php $total += $product['price'] * $product['productnum']; ?>

                            <?php endforeach; ?>

                            <div class="count">
                                <span>总计:</span>
                                <span class="price">￥<span class="num"><?php echo number_format( $total,2 ); ?></span></span>
                            </div>
                        </div>
                    </div>

                    <div class="split-line"></div>

                    <div class="m-order-confirm g-right">
                        <span class="tip">
                            订单确认好了，
                        </span>
                        <button class="w-button-primary" type="submit">
                            去 支 付
                        </button>
                    </div>

                    <input type="hidden" id="j-addressId" name="addressid" value="">
                    <input type="hidden"  name="orderid"
                      value="<?php echo (int)\Yii::$app->request->get('orderid'); ?>" >

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