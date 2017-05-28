
<!-- @main 个人中心主要内容 -->
<main class="g-personal f-clearfix">
  <div class="g-container">

    <aside class="m-sidebar">
      <div class="header">
        <p>个人中心</p>
      </div>
      <div class="nav">
        <ul>
          <li class="nav-item z-active">
            <a href="javascript:;">我的订单</a>
          </li>
          <li class="nav-item">
          <a href="<?php echo yii\helpers\Url::to(['user/info']); ?>">个人信息</a>
          </li>
        </ul>
      </div>
    </aside>

    <section class="m-order-list">
      <div class="header">
        <p>全部订单</p>
      </div>

      <div class="order-list">

        <?php foreach ( $orders as $order ) : ?>

          <!-- 订单项 -->
          <div class="m-order-item">

            <div class="order-item-header f-clearfix">
              <div class="w w1 date"><?php echo date( 'Y-m-d', $order->createtime ); ?></div>
              <div class="w w2 order-id">
                <span>订单号：</span>
                <span><?php echo $order->orderid; ?></span>
              </div>
              <div class="w w3 order-price">
                <span>订单总价：</span>
                <span class="total-price"><?php echo $order->amount; ?></span>
              </div>
              <div class="order-status">

                <?php if ( $order->status == 100 ) : ?>
                  <span class="describe">订单待支付，</span>
                  <a class="action" href="<?php echo yii\helpers\Url::to(['order/check', 'orderid' => $order->orderid]); ?>">立即支付</a>
                <?php elseif ( $order->status == 220 ) : ?>
                  <span class="describe">订单已发货，</span>
                  <a class="action" href="<?php echo yii\helpers\Url::to([
                    'order/received',
                    'orderid' => $order->orderid
                  ]); ?>">确认收货</a>
                <?php elseif ( $order->status == 202 ) : ?>
                  <span class="payed">订单已支付，等待发货</span>
                <?php elseif ( $order->status == 260 ) : ?>
                  <span class="completed">订单已完成</span>
                <?php endif; ?>

              </div>
            </div>

            <!-- 订单商品列表 -->       
            <div class="product-list">

              <?php foreach ( $order->products as $product ) : ?>
                <!-- 订单商品列表项 -->
                <div class="m-product-item">
                  <div class="w img">
                    <a href="<?php echo yii\helpers\Url::to(['product/detail', 'productid' => $product->productid]); ?>">
                      <img src="<?php echo $product->cover; ?>-coversmall" alt="">
                    </a>
                  </div>
                  <div class="w w2 title">
                    <a href="<?php echo yii\helpers\Url::to(['product/detail', 'productid' => $product->productid]); ?>"><?php echo $product->title; ?></a>
                  </div>
                  <div class="w w3 price">
                    <span><?php echo $product->price; ?></span>
                  </div>
                  <div class="w w3 num">
                    <span>x </span>
                    <span><?php echo $product->num; ?></span>
                  </div>
                  <div class="option">

                    <?php if ( $order->status == 260 ) : ?>
                      <a href="<?php echo yii\helpers\Url::to(['product/comment', 'productid' => $product->productid]); ?>">评价商品</a>
                    <?php endif; ?>
                  </div>
                </div>
                <!-- / 订单商品列表项 -->
              <?php endforeach; ?>

            </div>
            <!-- / 订单商品列表 -->

          </div>
          <!-- / 订单项 -->

        <?php endforeach; ?>

      </div>

    </section>

  </div>

</main>
<!-- @main end -->
