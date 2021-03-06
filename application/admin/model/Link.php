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

namespace app\admin\model;

use app\common\model\BaseModel;

/**
 * 友情链接-模型
 * @author 牧羊人
 * @since 2020/7/10
 * Class Link
 * @package app\admin\model
 */
class Link extends BaseModel
{
    // 设置数据表名
    protected $name = 'link';

    /**
     * 获取缓存信息
     * @param int $id 记录ID
     * @return \app\common\model\数据信息|mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * @since 2020/7/10
     * @author 牧羊人
     */
    public function getInfo($id=0)
    {
        $info = parent::getInfo($id);
        if ($info) {
            // 友链图片
            if ($info['image']) {
                $info['image_url'] = get_image_url($info['image']);
            }

            // 使用平台
            if ($info['platform']) {
                $info['platform_name'] = config('admin.link_platform')[$info['platform']];
            }

            // 友链形式
            if ($info['form']) {
                $info['form_name'] = config('admin.link_form')[$info['form']];
            }
        }
        return $info;
    }
}
