<?php
/**
 * @desc 用户接口
 */
class UserInterface {

    protected static $dbs;

    /**
     * @desc 根据用户名获得用户信息
     * @author lmyoaoa
     * @return array
     */
    public static function getInfo($username) {
        $mod = new UsersModel();
        $info = $mod->getOne('*', array(
            array('username', '=', $username),
        ));
        return $info;
    }

}


