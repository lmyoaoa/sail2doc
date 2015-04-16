<?php

class DbsInterface {

    protected static $dbs;

    /**
     * @desc 获取文档详情
     * @author lmyoaoa
     * @param int $id 文档id
     */
    public static function search($dbname) {
        $mod = new DbsModel();
        $info = $mod->getOne('*', array(
            array('dbname', '=', $dbname),
        ));
        return $info;
    }

    /**
     * @desc 获取表结构
     * @author lmyoaoa
     * @param string $string 库表字符串，如car.car_sale
     */
    public static function getFields($string) {
        list($tmpDb, $tmpTable) = $v = explode('.', $string);
        if( count($v) == 2 ) {
            $info = self::search($tmpDb);

            $key = $tmpDb . '_' . $tmpTable;
            if( !isset(self::$dbs[$key]) ) {
                self::$dbs[$key] = new Mysql(array(
                    'host'=>$info['ip'],
                    'port'=>$info['port'],
                    'dbUser'=> $info['dbuser'],
                    'dbPasswd'=> $info['dbpwd'],
                ), $tmpDb, $tmpTable);
            }
            $fields = self::$dbs[$key]->getFields($tmpTable, true);
            return $fields;
        }
        return array();
    }

}
