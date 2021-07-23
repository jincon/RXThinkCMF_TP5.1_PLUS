<?php

// 注册中间件
return [
    app\http\middleware\AuthCheck::class,
    app\http\middleware\CheckLogin::class,
];