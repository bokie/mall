<?php
use yii\bootstrap\ActiveForm;
?>
<!-- @main 购物车主要内容 -->
<main class="g-cart">
    <div class="g-container">
        <div class="m-cart-main">

            <?php $form = ActiveForm::begin([
                'action' => yii\helpers\Url::to( ['order/add'] ),
                ]); ?>

                <!-- 购物车头部区块 -->
                <div class="cart-header f-clearfix">
                    <div class="w w1">
                        <div class="w-chkbox">
                            <input type="checkbox">
                        </div>
                        <span>全选</span>
                    </div>

                    <div class="w w2">

                    </div>

                    <div class="w w5">
                        <span>商品信息</span>
                    </div>

                    <div class="w w3">
                        <span>单价</span>
                    </div>

                    <div class="w w4">
                        <span>数量</span>
                    </div>

                    <div class="w w4">
                        <span>小计</span>
                    </div>

                    <div class="w w1">

                    </div>
                </div>
                <!-- / 购物车头部区块 -->

                <!-- 购物车商品列表区块 -->
                <div class="cart-group">

                    <?php $total = 0; ?>

                    <?php foreach( (array)$data as $k=>$product ) : ?>
                        <input type="hidden" name="OrderDetail[<?php echo $k; ?>][productid]"
                          value="<?php echo $product['productid']; ?>">
                        <input type="hidden" name="OrderDetail[<?php echo $k; ?>][price]"
                          value="<?php echo $product['price']; ?>">
                        <input type="hidden" name="OrderDetail[<?php echo $k; ?>][productnum]"
                          value="<?php echo $product['productnum']; ?>">

                        <div class="cart-item f-clearfix">
                            <div class="w w1 item-checked">
                                <div class="w-chkbox">
                                    <input type="checkbox">
                                </div>
                            </div>

                            <div class="w w2 itme-img">
                                <div class="img">
                                <a href="<?php echo yii\helpers\Url::to( ['product/detail',
                                  'productid' => $product['productid']] ); ?>"
                                  title="<?php echo $product['title']; ?>">
                                    <img src="<?php echo $product['cover']; ?>-coversmall" alt="">
                                </a>
                                </div>
                            </div>

                            <div class="w w5 item-info">
                            <a href="<?php echo yii\helpers\Url::to( ['product/detail',
                              'productid' => $product['productid']] ); ?>">
                                    <span><?php echo $product['title']; ?></span>
                                </a>
                            </div>

                            <div class="w w3 item-price">
                                <span><?php echo $product['price']; ?></span>
                            </div>

                            <div class="w w4 item-num">
                                <div class="u-select-num g-left">
                                    <a href="javascript:;" class="minus j-numMinus">-</a>
                                    <input name="productnum" id="<?php echo $product['cartid'];?>"
                                    value="<?php echo $product['productnum']; ?>" 
                                    class="j-selectedNum" type="text"> 
                                    <a href="javascript:;" class="plus j-numPlus">+</a> 
                                </div>
                            </div>

                            <div class="w w4 item-count">
                                <span>
                                    <?php
                                    $count = $product['price'] * $product['productnum'];
                                    echo number_format( $count, 2 );
                                    ?>
                                </span>
                            </div>

                            <div class="w w1 item-del">
                                <a class="del" href="<?php echo yii\helpers\Url::to( ['cart/del',
                                  'cartid' => $product['cartid'] ] ); ?>" title="删除该商品">
                                  x
                                </a>
                            </div>
                        </div>
                        <?php $total += $product['price'] * $product['productnum']; ?>
                    <?php endforeach; ?>

                </div>
                <!-- / 购物车商品列表区块 -->

                <!-- 购物车结算区块 -->
                <div class="cart-total f-clearfix">
                    <div class="g-left">
                        <p class="info">我的购物车</p>
                    </div>
                    <div class="g-right">
                        <div class="count g-left">
                            <span class="label">商品合计：</span><span style="color: #db4d6d;">￥</span><span class="price"><?php echo number_format( $total, 2 ); ?></span>
                        </div>
                        <div class="btn">
                            <button type="submit" class="w-button-primary">去 结 算</button>
                        </div>
                    </div>
                </div>
                <!-- / 购物车结算区块 -->

                <?php ActiveForm::end(); ?>

            </div>
        </div>      
    </main>
    <!-- @main end -->
