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

use app\admin\model\Role as AdminRoleModel;
use app\common\model\BaseModel;

/**
 * 权限-模型
 * @author 牧羊人
 * @since 2020/7/10
 * Class AdminRom
 * @package app\admin\model
 */
class AdminRom extends BaseModel
{
    // 设置数据表名
    protected $name = 'admin_rom';

    /**
     * 获取权限菜单列表
     * @param $roleIds 角色ID
     * @param $adminId 用户ID
     * @param $type 类型
     * @param $pid 上级ID
     * @return array|array[]|\array[][]
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * @author 牧羊人
     * @since 2021/1/30
     */
    public function getPermissionMenu($roleIds, $adminId, $type, $pid)
    {
        $map = [];
        if ($roleIds) {
            $map1 = [
                ['r.type', '=', 1],
                ['r.type_id', 'in', $roleIds],
            ];
            $map[] = $map1;
        }
        $map2 = [
            ['r.type', '=', 2],
            ['r.type_id', '=', $adminId],
        ];
        $map[] = $map2;
        $menuMod = new Menu();
        $menuList = $menuMod->alias('m')
            ->join(DB_PREFIX . 'admin_rom r', 'r.menu_id=m.id')
            ->distinct(true)
            ->where(function ($query) use ($map) {
                $query->whereOr($map);
            })
            ->where('m.type', '=', $type)
            ->where('m.pid', '=', $pid)
            ->where('m.status', '=', 1)
            ->where('m.mark', '=', 1)
            ->order('m.pid ASC,m.sort ASC')
            ->field('m.*')
            ->select()->toArray();
        if (!empty($menuList)) {
            $type += 1;
            if ($type <= 4) {
                foreach ($menuList as &$val) {
                    $childList = $this->getPermissionMenu($roleIds, $adminId, $type, $val['id']);
                    if (is_array($childList) && !empty($childList)) {
                        $val['children'] = $childList;
                    }
                }
            }
        }
        return $menuList;
    }

    /**
     * 获取权限节点
     * @param $roleIds 角色ID
     * @param $adminId 用户ID
     * @return array
     * @author 牧羊人
     * @since 2021/1/30
     */
    public function getPermissionFuncList($roleIds, $adminId)
    {
        $map = [];
        if ($roleIds) {
            $map1 = [
                ['r.type', '=', 1],
                ['r.type_id', 'in', $roleIds],
            ];
            $map[] = $map1;
        }
        $map2 = [
            ['r.type', '=', 2],
            ['r.type_id', '=', $adminId],
        ];
        $map[] = $map2;
        $menuMod = new Menu();
        $funcList = $menuMod->alias('m')
            ->join(DB_PREFIX . 'admin_rom r', 'r.menu_id=m.id')
            ->distinct(true)
            ->where(function ($query) use ($map) {
                $query->whereOr($map);
            })
            ->where('m.type', '=', 4)
            ->where('m.status', '=', 1)
            ->where('m.mark', '=', 1)
            ->order('m.pid ASC,m.sort ASC')
            ->column('m.permission');
        return $funcList;
    }

}
