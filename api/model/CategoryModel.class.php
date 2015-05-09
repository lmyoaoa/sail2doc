<?php

class CategoryModel extends Model {

    protected function _init() {
        $this->dbName = MysqlConf::MASTER;
        $this->tableName = 'category';
        $this->MasterConf = MysqlConf::Master();
        $this->SlaveConf = MysqlConf::Slave();
    }

}


