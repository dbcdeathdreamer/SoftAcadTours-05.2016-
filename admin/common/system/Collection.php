<?php

class Collection {
    private $db = null;

    public function __construct()
    {
       $this->db = Database::getInstance();
    }

    public function get($table, $where = array(), $limit = -1, $offset = 0)
    {
        $sql = "SELECT * FROM {$table}";

        if (!empty($where)) {
            $sql.= " WHERE 1 ";
            foreach ($where as $key => $value) {
                $sql.= " AND  {$key} = '{$value}' ";
            }
        }

        if($limit > -1 && $offset > 0) {
            $sql .= " LIMIT {$limit} , {$offset} ";
        }


        $result = $this->db->query($sql);

        if (!$result) {
            $this->db->error();
        }

        $array = array();
        while ($row = $this->db->translate($result)) {
            $array[] = $row;
        }

        return $array;
    }

}