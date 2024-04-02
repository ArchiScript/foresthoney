<?php

class Connection
{

    private $link;

    public function __construct()
    {
        $this->connect();
    }
    private function connect()
    {
        $config = [

            'host'     => 'localhost',
            'db_name'  => 'db-foresthoney',
            'username' => 'root',
            'password' => '',
            'charset'  => 'utf8',
        ];

        $dsn        = 'mysql:host=' . $config['host'] . ';dbname=' . $config['db_name'] . ';charset=' . $config['charset'];
        $this->link = new PDO($dsn, $config['username'], $config['password']);
        $this->link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    public function execute($sql)
    {
        $sth = $this->link->prepare($sql);
        return $sth->execute();
    }
    public function query($sql)
    {

        $sth = $this->link->prepare($sql);
        $sth->execute();

        $result = $sth->fetchAll(PDO::FETCH_ASSOC);

        if ($result === false) {

            return [];

        }
        return $result;
    }

    // rowCount может не работать для SELECT
    public function rowCount($sql)
    {
        $sth = $this->link->prepare($sql);
        $sth->execute();

        $check = $sth->rowCount();

        if ($check > 0) {

            return $check;
        } else {return false;}

    }

    public function fetchCol($sql)
    {
        $sth = $this->link->prepare($sql);
        $sth->execute();
        return $sth->fetchColumn();
    }

    public function fetchItemArray($sql)
    {
        $sth = $this->link->prepare($sql);
        $sth->execute();
        $result    = $sth->fetchAll(PDO::FETCH_ASSOC);
        $itemArray = [];
        foreach ($result as $arr => $items) {
            foreach ($items as $user => $value) {
                $itemArray[$user] = $value;
            }
        }
        return $itemArray;
    }
    public function fetch($sql)
    {
        $sth = $this->link->prepare($sql);
        $sth->execute();
        $result = $sth->fetch();
        return $result;
    }
    public function queryObj($sql)
    {
        $sth = $this->link->prepare($sql);
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_OBJ);
        if ($result === false) {
            return [];
        }
        return $result;
    }
    public function queryArray($sql)
    {
        $sth = $this->link->prepare($sql);
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        if ($result === false) {
            return [];
        }
        
        /// Start an array with 1
        $start_with_1 = array_combine(range(1, count($result)), array_values($result));
        return $start_with_1;
        return $result;
        
    }

}