 <?php
 use yii\bootstrap\ActiveForm;
 ?>

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
            <a href="<?php echo yii\helpers\Url::to(['order/index']); ?>">我的订单</a>
          </li>
          <li class="nav-item">
            <a href="<?php echo yii\helpers\Url::to(['user/info']); ?>">个人信息</a>            
          </li>
        </ul>
      </div>
    </aside>

    <section class="m-product-comment">
      <div class="header">
        <p>评论商品</p>
      </div>

      <div class="m-tocomment-item">

        <?php $form = ActiveForm::begin([
          'action' => yii\helpers\Url::to(['product/addcomment'])
          ]); ?>

          <p class="title">
            <?php echo $product['title']; ?>
          </p>

          <input type="hidden" name="Comment[productid]" value="<?php echo $product['productid']; ?>">
          
          <div class="item-content f-clearfix">
            <div class="img">
              <img src="<?php echo $product['cover']; ?>-coversmall" alt="<?php echo $product['title']; ?>">
            </div>
            <textarea  name="Comment[content]" class="input-box" placeholder="这个商品怎么样？跟大家说说吧"></textarea> 
          </div>

          <div class="comment-submit f-clearfix">
            <button class="button w-button-primary" type="submit">
              评 论
            </button>
          </div>

          <?php ActiveForm::end(); ?>

        </div>



      </section>

    </div>

  </main>
  <!-- @main end -->