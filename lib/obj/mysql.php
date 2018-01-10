<?php

namespace lib\obj;

require_once COMPOSER_SCRIPT_PATH . '/vendor/joshcam/mysqli-database-class/MysqliDb.php';

class mysql extends \MysqliDb {

    protected $db;
    protected $table;
    // protected $prefix;
    protected $host;
    protected $dbname;
    protected $user;
    protected $password;
    protected $port;
    protected $charset;

    public function __construct($table) {
        $this->table = $table;

        $this->host = config('mysql')['host'];
        $this->dbname = config('mysql')['dbname'];
        $this->user = config('mysql')['user'];
        $this->password = config('mysql')['password'];
        $this->port = config('mysql')['port'];
        $this->charset = config('mysql')['charset'];
        parent::__construct(
            $this->host,
            $this->user,
            $this->password,
            $this->dbname,
            $this->port,
            $this->charset
        );
        $this->autoReconnect = true;
        $this->db = self::getInstance();
    }

    public function select() {
        return $this->get($this->table);
    }
}