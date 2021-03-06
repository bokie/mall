<?php
use yii\bootstrap\ActiveForm;
?>

<!-- @main 商品详情 -->
<main class="g-goods-detail">
    <div class="g-container">
        <div class="m-crumb">
            <span>首页></span><span><?php echo $cateTitle; ?>></span><span><?php echo $product['title'] ?></span>
        </div>
        <div class="m-detail-header">
            <div class="slide">
                <div class="view">
                    <img src="<?php echo $product['cover'];?>-coverbig" alt="<?php echo $product['title']; ?>">
                </div>
                <div class="list">
                    <ul>
                        <?php foreach ( (array)json_decode( $product['pics'], true ) as $k=>$pic ) : ?>
                            <li>
                                <a href="javascript:;">
                                <img src="<?php echo $pic; ?>-coversmall" alt="">
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>

            <div class="info">
                <?php $form = ActiveForm::begin([
                    'action' => yii\helpers\Url::to(['cart/add']),
                    ]); ?>
                    <div class="intro">
                        <h2 class="title"><?php echo $product['title']; ?></h2>
                        <p class="desc"><?php echo $product['descr']; ?></p>
                    </div>
                    <div class="price">
                        <div class="price-box">
                            <label class="label">售价</label>
                            <span class="rmb">￥</span>
                            <span class="count"><?php echo $product['price']; ?></span>
                        </div>
                        <div class="agefor">
                            <span class="label">适用年龄</span>
                            <span class="age">各年龄段适用</span>
                        </div>
                    </div>

                    <div class="params">

                        <div class="param color f-clearfix">
                            <label class="label g-left">颜色</label>
                            <ul class="tabs">
                                <li class="tab-item"><a href="javascript:;">红色</a></li>
                                <li class="tab-item"><a href="javascript:;">绿色</a></li>
                                <li class="tab-item"><a href="javascript:;">蓝色</a></li>
                            </ul>
                        </div>

                        <div class="param color f-clearfix">
                            <label class="label g-left">尺寸</label>
                            <ul class="tabs">
                                <li class="tab-item"><a href="javascript:;">S</a></li>
                                <li class="tab-item"><a href="javascript:;">M</a></li>
                                <li class="tab-item"><a href="javascript:;">L</a></li>
                            </ul>
                        </div>

                    </div>

                    <div class="number">
                        <label class="label g-left">数量</label>
                        <div class="j-">
                            <div class="u-select-num g-left">
                                <a id="j-numMinus" href="javascript:;" class="minus">-</a>
                                <input name="productnum" id="j-selectedNum" value="1" type="text"> <a id="j-numPlus" href="javascript:;" class="plus">+</a> 
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="price"
                    value="<?php echo $product['issale'] == '1' 
                    ? $product['saleprice'] 
                    : $product['price']; ?>"
                    >

                    <input type="hidden" name="productid" value="<?php echo $product['productid']; ?>">

                    <div class="btn" style="text-align: center;padding-right: 10px;">
                        <button class="w-button-primary">加入购物车</button>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>

            <div class="m-detail-main">
                <ul id="j-tabNav" class="tab-nav">
                    <li class="tab-nav-item z-active-bg"><a href="javascript:;">商品详情</a></li>
                    <li class="tab-nav-item"><a href="javascript:;">商品评论(<span><?php echo $commentsNum; ?></span>)</a></li>
                </ul>
                <div class="tab-content">
                    <!-- 商品详情内容 -->
                    <div class="m-detail-content j-tabItem">
                        <?php echo $product['detail']; ?>
                    </div>
                    <!-- / 商品详情内容 -->

                    <!-- 商品评论内容 -->
                    <div class="m-comment-content j-tabItem" style="display: none;">
                        <ul>
                        <?php foreach ( $comments as $comment ) : ?>
                            <li class="comment-item">
                                <div class="user-info g-left">
                                    <div class="avatar"><img src="" alt=""></div>
                                    <div class="usrname">bokie</div>
                                </div>
                                <div class="slide">
                                    <div class="content"><?php echo $comment['content']; ?></div>
                                    <div class="info">
                                        <div class="goods-info g-left">
                                            <span>已购买</span>
                                            <span><?php echo $product['title']; ?></span>
                                        </div>
                                        <div class="comment-time g-right">
                                            <?php echo date( 'Y-m-d', $comment['createtime']); ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            </li>

                        </ul>
                    </div>
                    <!-- / 商品评论内容 -->
                </div>
                .

            </div>

        </div>

    </main>
    <!-- @main end -->

    <script src="assets/app/js/lib/jquery-3.1.0.js"></script>
    <script src="assets/app/js/detail.js"></script>
