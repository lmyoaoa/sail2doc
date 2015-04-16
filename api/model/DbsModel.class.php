<?php

class DbsModel extends Model {

    protected function _init() {
        $this->dbName = MysqlConf::MASTER;
        $this->tableName = 'dbs';
        $this->MasterConf = MysqlConf::Master();
        $this->SlaveConf = MysqlConf::Slave();
    }

}

