<?php
// +----------------------------------------------------------------------
// | RXThinkCMF框架 [ RXThinkCMF ]
// +----------------------------------------------------------------------
// | 版权所有 2017~2020 南京RXThinkCMF研发中心
// +----------------------------------------------------------------------
// | 官方网站: http://www.rxthink.cn
// +----------------------------------------------------------------------
// | Author: 牧羊人 <1175401194@qq.com>
// +----------------------------------------------------------------------

// +----------------------------------------------------------------------
// | 中间件配置
// +----------------------------------------------------------------------
return [
    // 默认中间件命名空间
    'default_namespace' => 'app\\http\\middleware\\',
    app\http\middleware\InAppCheck::class,
];
