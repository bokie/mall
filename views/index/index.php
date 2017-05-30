
<!-- @slider 轮播组件 -->
<div class="m-slider">
    <div class="g-container">
    <a href="<?php echo yii\helpers\Url::to(['product/detail', 'productid' => '7']); ?>">
        <img src="assets/app/image/banner01.png" alt="">
    </a>
    </div>
</div>
<!-- @slider end -->


<!-- @main 首页主要内容 -->
<main>
    <div class="g-container">

        <div class="m-recommend">
            <div class="recommend-tab">
                <span class="tab-name">推荐商品</span>
                <span class="g-right"><a href="">查看更多>>></a></span>
            </div>
            <div class="m-goods-list f-clearfix">

                <?php foreach( $data['reco'] as $pro ) : ?>
                    <div class="m-goods-item">
                        <a href="<?php echo \yii\helpers\Url::to(['product/detail', 'productid' => $pro->productid]); ?>">
                            <!-- <span class="label">推荐商品</span> -->
                            <div class="item-img">

                                <img src="<?php echo $pro->cover; ?>-covermiddle" alt="<?php echo $pro->title ?>">
                                
                            </div>
                            <div class="item-info">
                                <div class="item-info-title g-left"><span class="txt"><?php echo $pro->title; ?></span></div>
                                <div class="item-info-price g-right"><span>￥</span><span><?php echo $pro->price; ?></span></div>
                            </div>
                        </a>
                    </div>
                <?php endforeach;?>

            </div>
        </div>
    </div>

</main>
    <!-- @main end -->