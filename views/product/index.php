<!-- @main list 商品列表 -->
<main class="g-goods-list">
    <div class="g-container">
        <?php if ( isset( $keyword ) ) : ?>
            <div class="m-crumb">首页>搜索结果><span><?php echo $keyword; ?></span></div>
        <?php else : ?>
            <div class="m-crumb">首页>衣着</span></div>        
        <?php endif; ?>
        <div class="m-goods-filter">

        </div>
        <div class="m-goods-order">
            <span>排序 :</span>
            <span class="f-active default-order">默认</span>
            <span class="price-order increase-order">价格</span>
        </div>
        <div class="m-goods-list f-clearfix">

            <?php foreach( $all as $pro ) : ?>
                <div class="m-goods-item">
                    <a href="<?php echo \yii\helpers\Url::to(['product/detail', 'productid' => $pro['productid']]); ?>">
                        <span class="label">推荐商品</span>
                        <div class="item-img">
                            <img src="<?php echo $pro['cover']; ?>-covermiddle" alt="<?php echo $pro['title']; ?>">
                        </div>
                        <div class="item-info">
                            <div class="item-info-title g-left"><span class="txt"><?php echo $pro['title']; ?></span></div>
                            <div class="item-info-price g-right"><span>￥</span><span><?php echo $pro['price']; ?></span></div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
</main>
    <!-- @main end -->