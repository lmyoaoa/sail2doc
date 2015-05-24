<?php
/**
 * @desc 分类接口
 */
class CategoryInterface {

    protected static $dbs;

    public static function add($data) {
        $arr = array(
            'title' => $data['title'],
            'pid' => $data['pid'],
            'create_time' => time(),
            'update_time' => time(),
        );
        $mod = new CategoryModel();
        $id = $mod->add($arr, true);
        return $id;
    }

    /**
     * @desc 获得所有分类树
     * @author lmyoaoa
     * @return array
     */
    public static function getTree() {
        $mod = new CategoryModel();
        $list = $mod->getRows('*', array(), 1, 500);
        $tree = array();
        foreach( $list['rows'] as $v ) {
            if( $v['pid'] == 0 ) {
                $tree[$v['id']]['data'] = $v;
                $tree[$v['id']]['list'] = array();
            }else{
                $tree[$v['pid']]['list'][] = $v;
            }
        }
        return $tree;
    }

    public static function getInfo($id) {
        $mod = new CategoryModel();
        $info = $mod->getOne('*', array(
            array('id', '=', $id),
        ));
        return $info;
    }

    public static function getChild($id) {
        $mod = new CategoryModel();
        $list = $mod->getRows('*', array(
            array('pid', '=', $id),
        ), 1, 500);
        return $list;
    }
}

