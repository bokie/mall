<?php

return [
    'adminEmail' => 'admin@example.com',
    'pageSize' => [
        'manage' => 10, //设置管理员列表分页组件中每页显示的条目数量
        'user' => 10, //设置用户管理列表分页组件每页显示的条目数量
        'product' => 10, //设置商品列表分页组件每页显示的条目数量
        'order' => 10, //设置订单管理列表分页组件每页显示的条目数量
    ],
    'defaultValue' => [
        'avatar' => 'assets/admin/img/contact-img.png',    //设置默认用户头像
    ],
    'express' => [
        1 => '中通快递',
        2 => '顺丰快递'
    ],
    'expressPrice' => [
        1 => 15,
        2 => 20
    ],
];
