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

use app\admin\model\Dep;
use app\common\service\BaseService;

/**
 * 部门管理-服务类
 * @author 牧羊人
 * @since 2020/7/10
 * Class DepService
 * @package app\admin\service
 */
class DepService extends BaseService
{
    /**
     * 初始化
     * @author 牧羊人
     * @since 2020/7/10
     */
    public function initialize()
    {
        parent::initialize();
        $this->model = new Dep();
    }

    /**
     * 获取部门数据列表
     * @return array
     * @since 2021/1/30
     * @author 牧羊人
     */
    public function getList()
    {
        $param = request()->param();
        // 查询条件
        $map = [];
        // 部门名称
        $name = getter($param, "name");
        if ($name) {
            $map[] = ['name', 'like', "%{$name}%"];
        }
        $list = $this->model->getList($map, "sort asc");
        return message("操作成功", true, $list);
    }

}
