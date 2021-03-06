<?php

class DocumentsInterface {

    /**
     * @desc 添加一条文档记录
     * @author lmyoaoa
     * @param array $data post过来的信息
     * @return int 自增主键id
     */
    public static function add($data) {
        $arr = self::formatData($data);
        $mod = new DocumentsModel();
        $id = $mod->add($arr, true);
        return $id;
    }

    public static function edit($id, $data) {
        $arr = self::formatData($data);
        $mod = new DocumentsModel();
        return $mod->update(array(
        array('id', '=', $id)
        ), $arr);
    }

    /**
     * @desc 获取文档详情
     * @author lmyoaoa
     * @param int $id 文档id
     * @param bool $isOrigin 是否返回原始数据(即数据表如car.car_sale是否需要转换成详细字段说明合并到ret_demo字段，默认会整合)
     */
    public static function getInfo($id, $isOrigin=true) {
        $mod = new DocumentsModel();
        $info = $mod->getOne('*', array(
            array('id', '=', $id),
        ));
        if( !empty($info) ) {
            $info['params'] = json_decode($info['params'], true);
            $info['ret'] = json_decode($info['ret'], true);
            $info['tables'] = json_decode($info['tables'], true);
            if( !empty($info['tables']) && $isOrigin ) {
                $info['ret'] = self::mergeReturn($info['tables'], $info['ret']);
            }
        }
        return $info;
    }

    /**
     * @desc 获取文档列表
     * @author lmyoaoa
     */
    public static function getListAll() {
        $mod = new DocumentsModel();
        $list = $mod->getRows('*', array(), 1, 1000);
        $list = $list['rows'];
        foreach( $list as $k => $info ) {
            $list[$k]['params'] = json_decode($info['params'], true);
            $list[$k]['ret'] = json_decode($info['ret'], true);
        }
        return $list;
    }

    /**
     * @desc 按分类获取文档列表
     * @author lmyoaoa
     */
    public static function getListByCat($catId) {
        $mod = new DocumentsModel();
        if( is_array($catId) ) {
            $list = $mod->getRows('*', array(
                array('cat_id', 'in', $catId)
            ), 1, 200);
        }else{
            $list = $mod->getRows('*', array(
                array('cat_id', '=', $catId)
            ), 1, 200);
        }
        $list = $list['rows'];
        foreach( $list as $k => $info ) {
            $list[$k]['params'] = json_decode($info['params'], true);
            $list[$k]['ret'] = json_decode($info['ret'], true);
        }
        return $list;
    }

    public static function formatReadType($list) {
        $arr = $cat = $ret = array();
        foreach( $list as $v ) {
            $arr[$v['cat_id']][] = $v;
            $cat[$v['cat_id']] = CategoryInterface::getInfo($v['cat_id']);
        }

        foreach( $arr as $catId => $v ) {
            foreach( $v as $v2 ) {
                $ret[$catId][$v2['read_type']][] = $v2;
            }
        }
        return array(
            'list' => $ret,
            'cat' => $cat,
        );
    }

    protected static function formatData($data) {
        $array = array(
            'title' => $data['title'],
            'url' => $data['url'],
            'type' => $data['type'],
            'is_login' => $data['is_login'],
            'ret_demo' => $data['desc'],
            'tables' => json_encode($data['table']),
        );
        if( isset($data['read_type']) ) {
            $array['read_type'] = $data['read_type'];
        }
        if( isset($data['cat_id']) ) {
            $array['cat_id'] = $data['cat_id'];
        }

        //格式化参数
        $arr = array();
        foreach( $data['param']['name'] as $k => $v ) {
            if( $v == '' ) continue;
            $arr[] = array(
                'name' => $v,
                'need' => intval($data['param']['need'][$k]),
                'type' => $data['param']['type'][$k],
                'desc' => $data['param']['desc'][$k],
            );
        }
        $array['params'] = json_encode($arr);

        //格式化返回字段说明
        $arr = array();
        foreach( $data['ret']['name'] as $k => $v ) {
            if( $v == '' ) continue;
            $arr[] = array(
                'name' => $v,
                'type' => $data['ret']['type'][$k],
                'desc' => $data['ret']['desc'][$k],
            );
        }

        //对数据表进行解析处理，假如表结构发生更改，则会导致bug，不对表结构进行预处理
        /*
        if( !empty($data['table']) ) {
            foreach( $data['table'] as $v ) {
                $fields = DbsInterface::getFields($v);

                foreach( $fields as $v ) {
                    $arr[] = array(
                        'name' => $v['Field'],
                        'type' => $v['Type'],
                        'desc' => $v['Comment'],
                    );
                }
            }
        }
        */
        $array['ret'] = json_encode($arr);

        return $array;
    }

    /**
     * @desc 合并表结构与返回字段说明数组
     */
    public static function mergeReturn($tables, $ret) {
        $arr = array();
        if( !empty($tables) && is_array($tables) ) {
            foreach( $tables as $v ) {
                $fields = DbsInterface::getFields($v);

                foreach( $fields as $v ) {
                    $arr[] = array(
                        'name' => $v['Field'],
                        'type' => $v['Type'],
                        'desc' => $v['Comment'],
                    );
                }
            }
        }
        $arr = array_merge($arr, $ret);
        return $arr;
    }

}

