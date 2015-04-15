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

    public static function getInfo($id) {
        $mod = new DocumentsModel();
        $info = $mod->getOne('*', array(
            array('id', '=', $id),
        ));
        if( !empty($info) ) {
            $info['params'] = json_decode($info['params'], true);
            $info['ret'] = json_decode($info['ret'], true);
        }
        return $info;
    }

    protected static function formatData($data) {
        $array = array(
            'title' => $data['title'],
            'url' => $data['url'],
            'type' => $data['type'],
            'ret_demo' => $data['desc'],
        );

        //格式化参数
        $arr = array();
        foreach( $data['param']['name'] as $k => $v ) {
            if( $v == '' ) continue;
            $arr[] = array(
                'name' => $v,
                'need' => $data['param']['need'][$k],
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
        $array['ret'] = json_encode($arr);

        return $array;
    }
}

