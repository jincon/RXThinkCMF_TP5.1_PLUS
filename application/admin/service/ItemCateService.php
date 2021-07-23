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

namespace app\admin\service;

use app\admin\model\ItemCate;
use app\common\service\BaseService;

/**
 * 栏目管理-服务类
 * @author 牧羊人
 * @since 2020/7/10
 * Class ItemCateService
 * @package app\admin\service
 */
class ItemCateService extends BaseService
{
    /**
     * 初始化模型
     * @author 牧羊人
     * @date 2019/5/5
     */
    public function initialize()
    {
        parent::initialize();
        $this->model = new ItemCate();
    }

    /**
     * 获取数据列表
     * @return array
     * @since 2021/1/30
     * @author 牧羊人
     */
    public function getList()
    {
        $param = request()->param();
        // 上级ID
        $pid = getter($param, "pid", 0);
        // 查询条件
        $map = [
            ['pid', '=', $pid],
        ];
        // 栏目名称
        $name = getter($param, "name");
        if ($name) {
            $map[] = ['name', 'like', "%{$name}%"];
        }
        $list = $this->model->getList($map, "sort asc");
        if (!empty($list)) {
            foreach ($list as &$val) {
                $val['haveChild'] = true;
            }
        }
        return message("操作成功", true, $list);
    }

    /**
     * 添加或编辑
     * @return array
     * @since 2020/7/10
     * @author 牧羊人
     */
    public function edit()
    {
        // 参数
        $data = request()->param();
        // 是否有封面
        $is_cover = $data['is_cover'];
        // 封面地址
        $cover = trim($data['cover']);
        //封面验证
        if ($is_cover == 1 && !$data['id'] && !$cover) {
            return message('请上传栏目封面', false);
        }
        if ($is_cover == 1) {
            if (strpos($cover, "temp")) {
                $data['cover'] = save_image($cover, 'itemcate');
            }
        } elseif ($is_cover == 2) {
            $data['cover'] = '';
        }
        return parent::edit($data);
    }
}
