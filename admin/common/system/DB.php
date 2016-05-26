<?php

class DB
{
    const DB_HOST     = '127.0.0.1';
    const DB_USERNAME = 'root';
    const DB_PASSWORD = '33';
    const DB_NAME     = 'softacad';

    private $connection;

    public function __construct()
    {
        $connection = mysqli_connect(
            self::DB_HOST,
            self::DB_USERNAME,
            self::DB_PASSWORD,
            self::DB_NAME
        );

        $this->connection = $connection;
    }


    public function get($table, $where = array())
    {
        $sql = "SELECT * FROM {$table}";

        if (!empty($where)) {
            $sql.= " WHERE 1 ";
            foreach ($where as $key => $value) {
                $sql.= " AND {$key} = '{$value}' ";
            }
        }

        $result = mysqli_query($this->connection, $sql);

        $array = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $array[] = $row;
        }
        die(mysqli_error($this->connection));
        return $array;
    }

    public function insert($table, $data)
    {
        $sql = "INSERT INTO {$table} SET ";
        $i = 0;
        $count = count($data);
        foreach ($data as $key => $value) {
            ++$i;
            if ($i == $count) {
                $sql.= " {$key} = '{$value}'";
            } else {
                $sql.= " {$key} = '{$value}',";
            }
        }

        mysqli_query($this->connection, $sql);
    }
}