<?php

class DocumentsModel extends Model {

    /*
    public function __construct() {
        parent::__construct();
    }
     */

    protected function _init() {
        $this->dbName = MysqlConf::MASTER;
        $this->tableName = 'documents';
        $this->MasterConf = MysqlConf::Master();
        $this->SlaveConf = MysqlConf::Slave();
    }

}

