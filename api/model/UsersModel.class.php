<?php

class UsersModel extends Model {

    protected function _init() {
        $this->dbName = MysqlConf::MASTER;
        $this->tableName = 'users';
        $this->MasterConf = MysqlConf::Master();
        $this->SlaveConf = MysqlConf::Slave();
    }

}



